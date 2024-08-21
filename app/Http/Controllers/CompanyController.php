<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;



class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'company_name' => 'required|max:255',
            'logo' => 'required',
            'user_id' => 'required'
        ]);

        $company = Company::create($fields);

        return $company;
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $company = Company::where('user_id', $user_id)
            ->get();

        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());
        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
