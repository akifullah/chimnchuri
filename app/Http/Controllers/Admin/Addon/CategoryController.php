<?php

namespace App\Http\Controllers\Admin\Addon;

use App\Http\Controllers\Controller;
use App\Services\Api\V1\Admin\AddonCategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected AddonCategoryService $addonCategoryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->addonCategoryService->getAll();
        return view("admin.addon-categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.addon-categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = $this->addonCategoryService->create($request->all());
        if ($category) {
            return redirect()->route('admin.addon-categories.index')->with('success', 'Addon Category created successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->addonCategoryService->getById($id);
        return view("admin.addon-categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = $this->addonCategoryService->update($id, $request->all());
        if ($category) {
            return redirect()->route('admin.addon-categories.index')->with('success', 'Addon Category updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->addonCategoryService->delete($id);
        return redirect()->route('admin.addon-categories.index')->with('success', 'Addon Category deleted successfully.');
    }
}
