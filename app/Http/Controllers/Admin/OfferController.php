<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::latest()->paginate(10);
        return view("admin.offers.index", compact("offers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.offers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "value" => "required|numeric",
            "type" => "required|in:percentage,fixed",
            "description" => "nullable",
            "minimum_order_amount" => "nullable|numeric",
            "maximum_discount_amount" => "nullable|numeric",
            "start_date" => "required",
            "end_date" => "required",
            "is_active" => "required",

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $offer = Offer::create($request->all());

        return redirect()->route("offers.index")->with("success", "Offer created successfully");
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
        $offer = Offer::findOrFail($id);

        return view("admin.offers.edit", compact("offer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "value" => "required|numeric",
            "type" => "required|in:percentage,fixed",
            "description" => "nullable",
            "minimum_order_amount" => "nullable|numeric",
            "maximum_discount_amount" => "nullable|numeric",
            "start_date" => "required",
            "end_date" => "required",
            "is_active" => "required",

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $offer = Offer::findOrFail($id);
        $offer->update($request->all());

        return redirect()->route("offers.index")->with("success", "Offer updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return redirect()->route("offers.index")->with("success", "Offer deleted successfully");
    }
}
