<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemApiController extends Controller
{
    public function index()
    {
        $items = Item::with("media")->orderBy('sort_order', 'asc')->get();
        $items->each(function ($item) {
            $item->image_urls = $item->getMedia('images')->map(function ($media) {
                return $media->getUrl();
            });
            unset($item->media);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Items fetched successfully',
            'data' => $items
        ]);
    }

    public function show($id)
    {
        $item = Item::with("sizes", "media", "categories_relation")->where('id', $id)->first();
        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Item not found',
                'data' => null
            ]);
        }
        $item->image_url = $item->getFirstMediaUrl('item');
        $item->image_urls = $item->getMedia('images')->map(function ($media) {
            return $media->getUrl();
        });
        // unset($item->media);
        return response()->json([
            'status' => 'success',
            'message' => 'Item fetched successfully',
            'data' => $item
        ]);
    }
}
