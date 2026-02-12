<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderTimelineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with("items", "user")->orderBy("created_at", "desc")->paginate(10);
        return view('admin.orders.list', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with("items.item.media", "items.addons", "timelines", "user")->findOrFail($id);
        return view('admin.orders.detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order_status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                "errors" => $validator->errors()
            ]);
        }

        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $request->order_status
        ]);
        OrderTimelineService::add(
            $order->id,
            'Order Status Updated',
            'Order status updated to ' . $request->order_status,
            $request->order_status
        );
        session()->flash('success', 'Order status updated successfully');
        return redirect()->back();
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Order status updated successfully',
        //     'data' => $order
        // ]);
    }
}
