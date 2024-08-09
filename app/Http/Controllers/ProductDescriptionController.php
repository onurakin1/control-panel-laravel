<?php

namespace App\Http\Controllers;

use App\Models\ProductDescription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        $productDescription = ProductDescription::where('tbl_product_description.product_id', $productId)
        ->join('tbl_product_price', 'tbl_product_description.product_id', '=', 'tbl_product_price.product_id')
        ->join('tbl_product', 'tbl_product_description.product_id', '=', 'tbl_product.product_id')
            ->get();

        return response()->json($productDescription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductDescription $desc) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDescription $desc) {}
}
