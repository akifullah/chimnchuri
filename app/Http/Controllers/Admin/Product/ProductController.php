<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\ItemStoreRequest;
use App\Models\Category;
use App\Models\Item;
use App\Services\Api\V1\Admin\ItemService;
use Illuminate\Http\Request;

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
}
