<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories =  Category::with('children')->orderBy('sort_order', 'asc')->get()
            ->map(function ($category) {

                // Cache the image URL for each category
                $image_url = Cache::remember("category_image_{$category->id}", 3600, function () use ($category) {
                    return $category->getFirstMediaUrl('category');
                });

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'sort_order' => $category->sort_order,
                    'image_url' => $image_url,
                    'children' => $category->children->map(function ($child) {
                        $child_image_url = Cache::remember("category_image_{$child->id}", 3600, function () use ($child) {
                            return $child->getFirstMediaUrl('category');
                        });

                        return [
                            'id' => $child->id,
                            'name' => $child->name,
                            'sort_order' => $child->sort_order,
                            'image_url' => $child_image_url,
                        ];
                    })->toArray(),
                ];
            })->toArray();

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
