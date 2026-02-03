<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemSize;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\OrderTimelineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'delivery_address' => 'required',
            'payment_method' => 'required|in:cod,online',

            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.size_id' => 'required|exists:item_sizes,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                "errors" => $validator->errors()
            ]);
        }


        DB::beginTransaction();

        try {

            $subTotal = 0;

            $order = Order::create([
                'uuid' => Str::uuid()->toString(),
                'order_number' => 'ORD-' . time(),

                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'delivery_address' => $request->delivery_address,

                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending'
            ]);

            foreach ($request->items as $cartItem) {

                $item = Item::findOrFail($cartItem['item_id']);

                $size = ItemSize::findOrFail($cartItem['size_id']);

                $price = $size->price;
                $quantity = $cartItem['quantity'];

                $total = $price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'size_id' => $size->id,

                    'item_name' => $item->name,
                    'size_name' => $size->name,

                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $total
                ]);

                $subTotal += $total;
            }

            $grandTotal = $subTotal;

            $order->update([
                'sub_total' => $subTotal,
                'grand_total' => $grandTotal
            ]);

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $grandTotal,
                'status' => 'pending'
            ]);


            DB::commit();

            OrderTimelineService::add(
                $order->id,
                'Order Created',
                'Order has been placed successfully',
                'created'
            );

            if ($request->payment_method == 'online') {

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order created. Proceed to payment gateway',
                    'data' => [
                        'order_id' => $order->id,
                        'amount' => $grandTotal,
                        'payment_url' => url('/payment/checkout/' . $order->id)
                    ]
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully with Cash on Delivery',
                'data' => $order->load('items')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
