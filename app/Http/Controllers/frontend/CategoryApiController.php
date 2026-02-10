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

    // public function show($id)
    // {
    //     $category = Category::with("media", "children.items", "items.addonGroups")->where('id', $id)->first();
    //     if (!$category) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Category not found',
    //             'data' => null
    //         ]);
    //     }
    //     $category->image_url = $category->getFirstMediaUrl('category');
    //     unset($category->media);
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Category fetched successfully',
    //         'data' => $category
    //     ]);
    // }


    public function show($id)
    {
        $category = Category::with([
            'children.items.sizes',
            'children.items.media',
            'items.sizes',
            'items.media',
            'items.addonGroups.addonCategory',
            'items.addonGroups.items.addonItem'
        ])->where('id', $id)->first();

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
                'data' => null
            ], 404);
        }

        // Transform category data
        $category->makeHidden(['created_at', 'updated_at', 'deleted_at', 'sort_order', 'media']);
        $category->image_url = $category->getFirstMediaUrl('category');

        // Transform children
        if ($category->children) {
            $category->children->each(function ($child) {
                $child->makeHidden(['created_at', 'updated_at', 'deleted_at', 'parent_id', 'level', 'sort_order', 'image']);

                // Transform items in children
                if ($child->items) {
                    $child->items->each(function ($item) {
                        $this->transformItem($item);
                    });
                }
            });
        }

        // Transform items
        if ($category->items) {
            $category->items->each(function ($item) {
                $this->transformItem($item);
            });
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Category fetched successfully',
            'data' => $category
        ]);
    }

    private function transformItem($item)
    {
        $item->makeHidden([
            'created_at',
            'updated_at',
            'deleted_at',
            'sort_order',
            'is_taxable',
            'is_discountable',
            'short_description',
            'label',
            'pivot'
        ]);

        // Transform sizes
        if ($item->sizes) {
            $item->sizes->each(function ($size) {
                $size->makeHidden([
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'item_id',
                    'discount',
                    'discount_type',
                    'size_image'
                ]);
            });
        }

        // Transform media
        if ($item->media) {
            $item->media = $item->media->map(function ($media) {
                unset($item->media);
                return [
                    'id' => $media->id,
                    'url' => $media->original_url,
                    'name' => $media->name
                ];
            });
        }

        // Transform addon groups - FLATTENED
        if ($item->addonGroups) {
            $item->addonGroups = $item->addonGroups->map(function ($group) {
                // Flatten addon_category into the group
                $flatGroup = [
                    'id' => $group->id,
                    'selection_type' => $group->selection_type,
                    'min_qty' => $group->min_qty,
                    'max_qty' => $group->max_qty,
                    'is_required' => $group->is_required,
                    'is_active' => $group->is_active,
                    'addon_category_id' => $group->addonCategory->id ?? null,
                    'addon_category_name' => $group->addonCategory->name ?? null,
                ];

                // Transform addon items
                if ($group->items) {
                    $flatGroup['items'] = $group->items->map(function ($groupItem) {
                        return [
                            'id' => $groupItem->id,
                            'addon_item_id' => $groupItem->addon_item_id,
                            'price' => $groupItem->price,
                            'is_active' => $groupItem->is_active,
                            'addon_item' => $groupItem->addonItem ? [
                                'id' => $groupItem->addonItem->id,
                                'uuid' => $groupItem->addonItem->uuid,
                                'name' => $groupItem->addonItem->name,
                                'slug' => $groupItem->addonItem->slug,
                                'description' => $groupItem->addonItem->description,
                                'price' => $groupItem->addonItem->price,
                                'is_active' => $groupItem->addonItem->is_active,
                            ] : null
                        ];
                    });
                }

                return $flatGroup;
            });
        }
    }
}
