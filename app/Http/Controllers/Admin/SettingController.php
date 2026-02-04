<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {

        $settings = Setting::first();

        return view("admin.settings.general_settings", compact("settings"));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "restaurant_name" => "required",
            "phone" => "required|numeric",
            "email" => "nullable|string|email",
            "address" => "nullable|string",
            "city" => "nullable|string",
            "postcode" => "nullable|numeric",
            "state" => "nullable|string",
            "country" => "nullable|string",
            "currency_code" => "nullable|string",
            "currency_symbol" => "nullable|string",
            "tax_percentage" => "nullable|numeric",
            "delivery_charge" => "nullable|numeric",
            "min_order_amount" => "nullable|numeric",
            "is_delivery_enabled" => "nullable|boolean",
            "is_pickup_enabled" => "nullable|boolean",
            "is_cod_enabled" => "nullable|boolean",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $setting = Setting::first();
        if ($setting) {
            $setting->update($request->all());
        } else {
            Setting::create($request->all());
        }

        return redirect()->back()->with("success", "Settings updated successfully");
    }


    public function workingHours()
    {
        $workingHours = WorkingHour::all();
        return view("admin.settings.working-hours", compact("workingHours"));
    }

    public function updateWorkingHours(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "working_hours" => "required|array",
            "working_hours.*.day" => "required",
            "working_hours.*.open_time" => "required",
            "working_hours.*.close_time" => "required",
            "working_hours.*.is_closed" => "required|boolean",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $workingHours = $request->working_hours;
        foreach ($workingHours as $workingHour) {
            WorkingHour::updateOrCreate(
                ["day" => $workingHour["day"]],
                [
                    "open_time" => $workingHour["open_time"],
                    "close_time" => $workingHour["close_time"],
                    "is_closed" => $workingHour["is_closed"],
                ]
            );
        }

        return redirect()->back()->with("success", "Working hours updated successfully");
    }
}
