<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryToProduct;
use App\Models\ProductDescription;
use App\Models\ProductToAllergen;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $today = Carbon::today();

        $product = Product::create([
            'image' => $request['image'],
            'video' => $request['video'],
            'is_new_product' => $request['is_new_product'],
            'sort_order' => $request['sort_order'],
            'date_added' => $today, // Set today's date
            'created_at' => $today, // Set today's date
            'updated_at' => $today // Set today's date

        ]);

        $productDescription = ProductDescription::create([
            'product_id' => $product->product_id,
            'name' => $request['name'],
            'desc' => $request['desc']
        ]);

        $categoryToProduct = CategoryToProduct::create([
            'category_id' =>  $request['category_id'],
            'product_id' => $product->product_id

        ]);

        $productToAllergen = ProductToAllergen::create([
            'product_id' => $product->product_id,
            'allergen_id' => $request['allergen_id']
        ]);
        $updatedCategory = Product::with('products')->find($request['category_id']);
        return $updatedCategory;
    }

    /**
     * Display the specified resource.
     */
    public function show($category_id)
    {
        $categoryGroups = CategoryToProduct::where('tbl_category_to_product.category_id', $category_id)
            ->join('tbl_product', 'tbl_category_to_product.product_id', '=', 'tbl_product.product_id')
            ->join('tbl_product_description', 'tbl_product.product_id', '=', 'tbl_product_description.product_id')
            ->join('tbl_product_price', 'tbl_product.product_id', '=', 'tbl_product_price.product_id')
            ->get();

        return response()->json($categoryGroups);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
