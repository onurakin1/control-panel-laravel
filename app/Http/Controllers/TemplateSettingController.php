<?php

namespace App\Http\Controllers;

use App\Models\TemplateSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTemplateSettingRequest;
use App\Models\Company;

class TemplateSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TemplateSetting::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $templateSetting = TemplateSetting::create([
            'color' => json_encode($request['color']), // Store as JSON if needed
        
            'name' => $request['name'],
            'banner' => $request['banner'],
            'languages' => json_encode($request['languages']), // Store as JSON if needed
            'layout' => $request['layout'],
            'size' => $request['size'],
            'user_id'=> $request['user_id']
        ]);

        $company = Company::create([
            'company_name' => $request['company_name'],
            'logo'=> $request['logo'],
            'user_id'=> $request['user_id']
        ]);
    
   
        return response()->json([
            'template_setting' => $templateSetting,
            'company' => $company
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $templateSetting = TemplateSetting::where('id', $id)
            ->get();

        return response()->json($templateSetting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $templateSetting = TemplateSetting::findOrFail($id);
        $templateSetting->update($request->all());
        return response()->json($templateSetting);


        // $validatedData = $request->validate([
        //     'color' => 'required|array',
        //     'color.*.name' => 'required|string',
        //     'color.*.value' => 'required|string',
        //     'logo' => 'required|string',
        //     'name' => 'required|string',
        //     'banner' => 'required|string',
        //     'languages' => 'required|array',
        //     'languages.*' => 'required|string',
        //     'layout' => 'required|string',
        //     'size' => 'required|string',
        // ]);

        // $templateSetting->update($validatedData);

        // return $templateSetting;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemplateSetting $templateSetting)
    {
        //
    }
}
