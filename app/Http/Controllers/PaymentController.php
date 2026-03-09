<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSize;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAddon;
use App\Models\OrderTimeSlot;
use App\Models\Setting;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 2000, // Amount in cents ($20.00)
                'currency' => 'usd',
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function processCheckout(Request $request)
    {
        // return Auth::user();

        // $timeSlot = TimeSlot::find($request?->time_slot_id);



        $setting = Setting::first();
        $subTotal = 0;
        $steakQty = 0;


        $pickupAddress = "";
        if ($request->order_type == "collection") {
            $pickupAddress = "{$setting?->address}, {$setting?->postcode}, {$setting?->city}";
        }


        // 2. Create the Order in your DB
        $order = Order::create([
            'user_id' => $request?->user_id ?? null,
            'uuid' => Str::uuid()->toString(),
            'order_number' => 'ORD-' . time(),

            'customer_name' => $request?->full_name ?? "Akif",
            'customer_phone' => $request?->phone ?? "0318978978",
            'customer_email' => $request?->email ?? "akifullah@gmail.com",
            'delivery_address' => $request?->street_address ?? "My addresss",
            'payment_method' => $request?->payment_method ?? "cod",
            'payment_status' => 'unpaid',
            'order_status' => 'pending',
            'steak_qty' => $steakQty,

            "postal_code" => $request?->postal_code ?? null,
            "city" => $request?->city ?? null,
            "country" => $request?->country ?? null,

            "order_type" => $request?->order_type ?? "delivery",
            "order_date" => $request?->order_date ?? null,
            "delivery_time" => $request?->delivery_time ?? null,
            "pickup_time" => $request?->pickup_time ?? null,
            "pickup_address" => $pickupAddress,
            "order_instruction" => $request?->order_instruction ?? null,
            "car_registration" => $request?->car_registration ?? null,

            // "time_slot_id" => $request?->time_slot_id,
            // "time_slot" => Carbon::parse($timeSlot?->start_time)->format('h:i A') . " - " . Carbon::parse($timeSlot?->end_time)->format('h:i A'),
        ]);

        foreach ($request->items as $cartItem) {

            $order_item =  OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $cartItem["productId"],
                'size_id' => $cartItem["selectedSize"]["id"],

                'item_name' => $cartItem["name"],
                'size_name' => $cartItem["selectedSize"]["name"],

                'price' => $cartItem["selectedSize"]["price"],
                'quantity' => $cartItem["quantity"],
                'total' => $cartItem["itemTotal"]

            ]);
            $subTotal += ($order_item->price * $order_item->quantity);
            $steakQty += $order_item->quantity;

            if ($cartItem["selectedAddons"]) {
                foreach ($cartItem["selectedAddons"] as $addon) {
                    $subItem = OrderItemAddon::create([
                        'order_item_id' => $order_item->id,
                        'addon_id' => $addon["id"],
                        'category_name' => $addon["category"],
                        'name' => $addon["name"],
                        'price' => $addon["price"],
                        'quantity' => $addon["qty"],
                        'total' => $addon["price"] * ($addon["qty"] * $order_item->quantity)
                    ]);

                    $subTotal += ($subItem->price * ($subItem->quantity * $order_item->quantity));
                }
            }
        }


        $taxAmount = 0;
        $tax = $setting->tax_percentage > 0 ? $setting->tax_percentage : null;
        if ($tax) {
            $taxAmount = $subTotal * $setting->tax_percentage / 100;
        }

        $deliveryCharge = 0;
        if ($setting->delivery_charge && $request->order_type == "delivery") {
            $deliveryCharge = $setting->delivery_charge;
        }


        $offer = Offer::where("is_active", 1)->where("end_date", '>=', Carbon::now())->first();

        $discountAmount = 0;

        if ($offer && $offer->type == "percentage") {
            $discountAmount = min(($subTotal * $offer->value / 100), $offer->maximum_discount_amount);
        } else if ($offer && $offer->type == "fixed") {
            $discountAmount = min($offer->value, $offer->maximum_discount_amount);
        }


        $grandTotal = $subTotal + $taxAmount + $deliveryCharge - $discountAmount;

        $order->update([
            "tax_total" => $taxAmount ?? 0,
            "delivery_charges" => $deliveryCharge ?? 0,
            "discount_total" => $discountAmount ?? 0,
            'sub_total' => $subTotal,
            "steak_qty" => $steakQty,
            'grand_total' => $grandTotal
        ]);


        foreach ($request->allocations as $allocation) {
            $slotTime = TimeSlot::find($allocation['slot_id']);

            // if ($slotTime) {
            //     $slotTime->max_capacity = $slotTime->max_capacity - $allocation['quantity'];
            //     $slotTime->save();
            // }

            OrderTimeSlot::create([
                'order_id' => $order->id,
                'time_slot_id' => $slotTime->id,
                'start_time' => $slotTime->start_time,
                'end_time' => $slotTime->end_time,
                'capacity' => $allocation['quantity'],
            ]);
        }

        if ($request?->payment_method == "online") {
            // 3. Create Stripe Payment Intent
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $grandTotal * 100,
                'currency' => $setting->currency_code ?? 'gbp',
                'capture_method' => 'manual',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'order_id' => $order->id
                ]
            ]);

            $order->update([
                'payment_intent_id' => $paymentIntent->id,
            ]);

            return response()->json([
                "success" => true,
                "message" => "Order placed successfully",
                'clientSecret' => $paymentIntent->client_secret,
                'orderId' => $order->id
            ]);
        }

        try {
            \Illuminate\Support\Facades\Mail::to('order@chimnchurri.com')->send(new \App\Mail\AdminOrderPlaced($order));
        } catch (\Exception $e) {
            logger()->error('Failed to send admin order notification email: ' . $e->getMessage());
        }

        return response()->json([
            "success" => true,
            "message" => "Order placed successfully",
            'orderId' => $order->id
        ]);
    }

    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                env('STRIPE_WEBHOOK_SECRET')
            );

            logger()->info('Stripe Webhook Event:  ' . $event);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }


        if ($event->type == 'charge.captured') {
            $paymentIntent = $event->data->object;
            $orderId = $paymentIntent->metadata->order_id;

            $order = Order::with(['items.addons', 'time_slots'])->find($orderId);
            if ($order) {
                $order->update([
                    'payment_status' => 'paid',
                ]);

                // Send confirmation emails for online payments
                try {
                    if ($order->customer_email) {
                        \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderPlaced($order));
                    }
                } catch (\Exception $e) {
                    logger()->error('Failed to send order confirmation email (webhook): ' . $e->getMessage());
                }
            }
        }

        if ($event->type == 'payment_intent.canceled') {
            $paymentIntent = $event->data->object;
            $orderId = $paymentIntent->metadata->order_id;

            $order = Order::find($orderId);
            if ($order) {
                $order->update([
                    'payment_status' => 'cancelled',
                ]);
            }
        }

        return response()->json(['success' => true]);
    }
}
