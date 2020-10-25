<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingValueType;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::all();

        return view('admin.setting.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingTypeRules = collect([
            SettingValueType::StringText => ['nullable', 'string'],
        ]);

        $rules = Setting::all()
            ->mapWithKeys(function (Setting $setting) use ($settingTypeRules) {
                return [$setting->name->value => $settingTypeRules->get($setting->value_type->value, [])];
            })
            ->toArray();

        $data = collect($request->validate($rules));

        $data->each(function ($value, $settingName) {
            $setting = Setting::find($settingName);

            $setting->value = $value;

            $setting->save();
        });

        flash()->success(__('setting.admin.edit.success'));

        return redirect()->route('admin.home.index');
    }
}
