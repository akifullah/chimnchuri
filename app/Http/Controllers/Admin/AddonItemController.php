<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\AddonItemStoreRequest;
use App\Http\Requests\Api\V1\Admin\AddonItemUpdateRequest;
use App\Models\AddonItem;
use App\Services\Api\V1\Admin\AddonItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\session;

class AddonItemController extends Controller
{

    protected AddonItemService $addonItemService;
    public function __construct(AddonItemService $addonItemService)
    {
        $this->addonItemService = $addonItemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addonItems = $this->addonItemService->getAll();


        return view("admin.addon-items.index", get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.addon-items.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddonItemStoreRequest $request)
    {
        $addonItem = $this->addonItemService->create($request->validated());
        Session::flash('success', 'Addon item created successfully.');
        return view("admin.addon-items.create");
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
        $addonItem = $this->addonItemService->getById($id);
        if (!$addonItem) {
            return redirect()->route("admin.addon-items.index")->with("error", "Addon item not found.");
        }
        return view("admin.addon-items.edit", get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddonItemUpdateRequest $request, string $id)
    {
        $addonItem = $this->addonItemService->update($id, $request->validated());
        Session::flash('success', 'Addon item updated successfully.');
        return redirect()->route("admin.addon-items.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->addonItemService->delete($id);
        return redirect()->route("admin.addon-items.index")->with("success", "Addon item deleted successfully.");
    }
}
