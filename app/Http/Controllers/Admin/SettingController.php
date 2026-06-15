<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $configs = Setting::pluck('value', 'key')->all();
        return view('admin.settings', compact('configs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'web_name'           => 'required|string|max:255',
            'web_slogan'         => 'nullable|string|max:255',
            'contact_email'      => 'required|email|max:255',
            'whatsapp_number'    => 'required|string|max:50',
            'tel_number'         => 'nullable|string|max:50',
            'dp_percentage'      => 'required|numeric|min:0|max:100',
            'bank_name'          => 'required|string|max:100',
            'bank_account'       => 'required|string|max:100',
            'bank_recipient'     => 'required|string|max:255',
            'sys_status'         => 'required|in:open,closed',
            'sys_closed_message' => 'nullable|string',
            'address'            => 'nullable|string|max:500',
            'instagram_url'      => 'nullable|url|max:255',
            'maps_link'          => 'nullable|string|max:500',
        ]);

        $keys = [
            'web_name',
            'web_slogan',
            'contact_email',
            'whatsapp_number',
            'tel_number',
            'dp_percentage',
            'bank_name',
            'bank_account',
            'bank_recipient',
            'sys_status',
            'sys_closed_message',
            'address',
            'instagram_url',
            'maps_link'
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.settings.index')
                         ->with('success', 'Pengaturan sistem berhasil diperbarui! ⚙️');
    }
}
