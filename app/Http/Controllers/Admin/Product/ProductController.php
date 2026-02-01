<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\ItemStoreRequest;
use App\Models\Category;
use App\Models\Item;
use App\Services\Api\V1\Admin\ItemService;
use Illuminate\Http\Request;
use App\Models\AddonCategory;
use App\Models\AddonItem;
use App\Models\AddonGroup;
use App\Models\AddonGroupItem;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        protected ItemService $itemService
    ) {}
    public function index()
    {
        $products = $this->itemService->getAllItems();
        $data["products"] = $products->load("media", "categories_relation");
        // return $data;
        return view("admin.products.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.products.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $request)
    {
        $products = $this->itemService->store($request->all());

        session()->flash('success', 'Product created successfully.');

        return $products;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Item::with(["sizes", "media"])->find($id);
        $data["product"] = $product->load("categories_relation");
        $data["categories"] = Category::all();
        return view("admin.products.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = $this->itemService->updateItem($id, $request->all());
        session()->flash('success', 'Product updated successfully.');
        return $products;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = $this->itemService->deleteItem($id);
        session()->flash('success', 'Product deleted successfully.');
        return redirect()->route('products.index');
    }

    public function assignAddons($product)
    {
        $product = Item::with(['addonGroups.items'])->findOrFail($product);
        $addonItems = AddonItem::get();
        $addonCategories = AddonCategory::get();
        return view('admin.products.assign-addons', compact('product', 'addonItems', 'addonCategories'));
    }

    public function storeAssignedAddons(Request $request, $product)
    {
        $request->validate([
            'addon_groups' => 'array',
        ]);

        $item = Item::findOrFail($product);

        DB::transaction(function () use ($item, $request) {

            $item->addonGroups()->forceDelete();

            if ($request->has('addon_groups')) {
                foreach ($request->addon_groups as $groupData) {

                    if (!isset($groupData['addon_category_id'])) continue;

                    $group = $item->addonGroups()->create([
                        'addon_category_id' => $groupData['addon_category_id'],
                        'selection_type' => $groupData['selection_type'] ?? 'multiple',
                        'min_qty' => $groupData['min_qty'] ?? null,
                        'max_qty' => $groupData['max_qty'] ?? null,
                        'is_required' => isset($groupData['is_required']) ? 1 : 0,
                        'sort_order' => $groupData['sort_order'] ?? 0,
                    ]);

                    if (isset($groupData['items']) && is_array($groupData['items'])) {
                        foreach ($groupData['items'] as $itemId => $itemData) {
                            if (!isset($itemData['selected'])) continue;

                            $group->items()->create([
                                'addon_item_id' => $itemId,
                                'price' => $itemData['price'] ?? null,
                                'sort_order' => $itemData['sort_order'] ?? 0,
                            ]);
                        }
                    }
                }
            }
        });

        session()->flash('success', 'Addons assigned successfully.');
        return redirect()->back();
    }
}
