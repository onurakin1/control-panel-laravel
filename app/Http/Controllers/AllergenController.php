<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllergenRequest;
use App\Http\Requests\UpdateAllergenRequest;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryGroups = Allergen::join('tbl_product_allergen_description', 'tbl_product_allergen.allergen_id', '=', 'tbl_product_allergen_description.allergen_id')
            ->get();

        return response()->json($categoryGroups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergen $allergen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergenRequest $request, Allergen $allergen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergen $allergen)
    {
        //
    }
}
