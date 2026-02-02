<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SmtpController extends Controller
{
    public function index()
    {
        $smtpSetting = SmtpSetting::first();
        return view('admin.smtp.index', compact('smtpSetting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mailer' => 'required',
            'host' => 'required',
            'username' => 'required',
            'password' => 'required',
            'port' => 'required',
            'encryption' => 'required',
            'from_address' => 'required',
            'from_name' => 'required',
        ]);

        $smtpSetting = SmtpSetting::first();
        if ($smtpSetting) {
            $smtpSetting->update($request->all());
        } else {
            SmtpSetting::create($request->all());
        }

        session()->flash('success', 'SMTP settings updated successfully');
        return redirect()->route('admin.smtp.index');
    }
}
