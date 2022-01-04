<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsCreateRequest;
use App\Http\Requests\SettingsUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::paginate(10);
        return view('settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingsCreateRequest $request)
    {
        $value = $request->input('value');
        Setting::create([
            'key' => $request->input('key'), 
            'type' => $request->input('type'), 
            'value' => is_array($value) ? implode(",", $value) : $value 
        ]);
        return redirect()->route('settings.index')->with('success','Setting added successfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsUpdateRequest $request, Setting $setting)
    {
        $value = $setting->type == "multi-select" ? implode(",", $request->input('value')) : $request->input('value');
        $setting->update([
            'key' => $request->input('key'),
            'value' => $value
        ]);
        return redirect()->route('settings.index')->with('success','Settings updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
