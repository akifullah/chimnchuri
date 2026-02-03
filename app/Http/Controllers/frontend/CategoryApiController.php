<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::with("media", "children")->orderBy('sort_order', 'asc')->get();
        $categories->each(function ($category) {
            $category->image_url = $category->getFirstMediaUrl('category');
            unset($category->media);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Categories fetched successfully',
            'data' => $categories
        ]);
    }

    public function show($id)
    {
        $category = Category::with("media", "children.items", "items")->where('id', $id)->first();
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
                'data' => null
            ]);
        }
        $category->image_url = $category->getFirstMediaUrl('category');
        unset($category->media);
        return response()->json([
            'status' => 'success',
            'message' => 'Category fetched successfully',
            'data' => $category
        ]);
    }
}
