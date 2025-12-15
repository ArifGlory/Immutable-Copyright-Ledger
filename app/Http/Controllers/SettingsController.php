<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$settings = Settings::all();
        $settings = Settings::pluck('setting_val', 'setting_var');

        return view('settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');

        // Iterasi setiap item dalam data
        foreach ($data as $key => $value) {
            Settings::updateOrCreate(
                ['setting_var' => $key], // Kondisi pencarian
                ['setting_val' => $value] // Data yang akan diupdate
            );
        }

        return ResponseJson(null,true,"Berhasil menyimpan perubahan setting",200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settings $settings)
    {
        //
    }

    /*
   * Function below is used for API
  */


}
