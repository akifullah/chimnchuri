<?php

namespace App\Services;

use App\Models\OrderTimeline;
use Illuminate\Support\Facades\Auth;

class OrderTimelineService
{
    public static function add($orderId, $title, $description = null, $type = null)
    {
        OrderTimeline::create([
            'order_id' => $orderId,
            'title' => $title,
            'description' => $description,
            'status_type' => $type,
            'created_by' => Auth::user()->name ?? 'System'
        ]);
    }
}
