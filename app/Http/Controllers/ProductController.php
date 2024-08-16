<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\AllergenToProduct;
use Illuminate\Http\Request;
use App\Models\CategoryToProduct;
use App\Models\ProductDescription;
use App\Models\ProductToAllergen;
use App\Models\BranchToProduct;
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
            'desc' => $request['desc'],
            'language_id' => $request['language_id']
        ]);

        $categoryToProduct = CategoryToProduct::create([
            'category_id' =>  $request['category_id'],
            'product_id' => $product->product_id

        ]);

        $productToAllergen = ProductToAllergen::create([
            'product_id' => $product->product_id,
            'allergen_id' => $request['allergen_id']
        ]);

        $productToBranch = BranchToProduct::create([
            'product_id' => $product->product_id,
            'branch_id' => $request['branch_id'],
            'date_added' => $today,
            'image' => $request['image'],
            'is_new_product' => $request['is_new_product'],
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

    
        $productIds = $categoryGroups->pluck('product_id')->toArray();

        $allergens = AllergenToProduct::whereIn('tbl_product_to_allergen.product_id', $productIds)
            ->join('tbl_product_allergen_description', 'tbl_product_to_allergen.allergen_id', '=', 'tbl_product_allergen_description.allergen_id')
            ->select('tbl_product_to_allergen.product_id', 'tbl_product_to_allergen.allergen_id', 'tbl_product_allergen_description.name', 'tbl_product_allergen_description.language_id')
            ->get();

        $allergensGrouped = $allergens->groupBy('product_id');


        $categoryGroups->transform(function ($item) use ($allergensGrouped) {
            $item->allergens = $allergensGrouped->get($item->product_id, []); // Eğer allergen yoksa boş array dönecek
            return $item;
        });


        return response()->json($categoryGroups);
    }

    public function update(Request $request, $id)
    {
        $today = Carbon::today();


        $product = Product::findOrFail($id);


        $product->update([
            'image' => $request['image'],
            'video' => $request['video'],
            'is_new_product' => $request['is_new_product'],
            'sort_order' => $request['sort_order'],
            'updated_at' => $today
        ]);


        $productDescription = ProductDescription::where('product_id', $product->product_id)->first();
        if ($productDescription) {
            $productDescription->update([
                'name' => $request['name'],
                'desc' => $request['desc'],
            ]);
        }

        $categoryToProduct = CategoryToProduct::where('product_id', $product->product_id)->first();
        if ($categoryToProduct) {
            $categoryToProduct->update([
                'category_id' => $request['category_id']
            ]);
        }

        if ($request->has('allergens') && is_array($request->allergens)) {
        
            ProductToAllergen::where('product_id', $product->product_id)->delete();
    
        
            foreach ($request->allergens as $allergen_id) {
                ProductToAllergen::create([
                    'product_id' => $product->product_id,
                    'allergen_id' => $allergen_id
                ]);
            }
        }

        $productToBranch = BranchToProduct::where('product_id', $product->product_id)->first();
        if ($productToBranch) {
            $productToBranch->update([
                'branch_id' => $request['branch_id']
            ]);
        }

        $updatedCategory = Product::with('products')->find($request['category_id']);
        return $updatedCategory;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
