<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSize;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAddon;
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
        // return response()->json($request->input());


        // dd($request->all());
        // 1. Validate the request (address, cart items, etc.)

        $subTotal = 0;

        // 2. Create the Order in your DB
        $order = Order::create([
            'user_id' => Auth::user()?->id ?? null,
            'uuid' => Str::uuid()->toString(),
            'order_number' => 'ORD-' . time(),

            'customer_name' => $request?->full_name ?? "Akif",
            'customer_phone' => $request?->phone ?? "0318978978",
            'customer_email' => $request?->email ?? "akifullah@gmail.com",
            'delivery_address' => $request?->street_address ?? "My addresss",
            'payment_method' => $request?->payment_method ?? "cod",
            'payment_status' => 'pending',
            'order_status' => 'pending'
        ]);

        foreach ($request->items as $cartItem) {
            // logger()->info($cartItem["name"]);
            $item = Item::findOrFail($cartItem["productId"]);
            $size = ItemSize::findOrFail($cartItem["selectedSize"]["id"]);

            $price = $size->price;
            $quantity = $cartItem["quantity"];

            $total = $price * $quantity;

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

            if ($cartItem["selectedAddons"]) {
                foreach ($cartItem["selectedAddons"] as $addon) {
                    $subItem = OrderItemAddon::create([
                        'order_item_id' => $order_item->id,
                        'addon_id' => $addon["id"],
                        'category_name' => $addon["category"],
                        'name' => $addon["name"],
                        'price' => $addon["price"],
                        'quantity' => $addon["qty"],
                        'total' => $addon["price"] * $addon["qty"]
                    ]);

                    $subTotal += ($subItem->price * $subItem->quantity);
                }
            }
        }


        // foreach ($request->items as $cartItem) {

        //     $item = Item::findOrFail($cartItem->productId);

        //     $size = ItemSize::findOrFail($cartItem->selectedSize->id);

        //     $price = $size->price;
        //     $quantity = $cartItem->quantity;

        //     $total = $price * $quantity;

        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'item_id' => $item->id,
        //         'size_id' => $size->id,

        //         'item_name' => $item->name,
        //         'size_name' => $size->name,

        //         'price' => $price,
        //         'quantity' => $quantity,
        //         'total' => $total
        //     ]);

        //     $subTotal += $total;
        // }

        $grandTotal = $subTotal;

        $order->update([
            'sub_total' => $subTotal,
            'grand_total' => $grandTotal
        ]);

        if ($request?->payment_method) {
            // 3. Create Stripe Payment Intent
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $request?->amount * 100, // Convert to cents
                'currency' => 'usd',
                'metadata' => [
                    'order_id' => $order->id // Link the order ID for webhooks later
                ]
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'orderId' => $order->id
            ]);
        }

        return response()->json([
            'orderId' => $order->id
        ]);
    }
}
