<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductCategoryDescription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategory = ProductCategory::join('tbl_product_category_description', 'tbl_product_category.category_id', '=', 'tbl_product_category_description.category_id')
            ->select('tbl_product_category.*', 'tbl_product_category_description.name as category_name')
            ->where('parent_id', 0)
            ->get();

        foreach ($productCategory as $category) {
            $category->child = ProductCategory::join('tbl_product_category_description', 'tbl_product_category.category_id', '=', 'tbl_product_category_description.category_id')
                ->select('tbl_product_category.*', 'tbl_product_category_description.name as category_name')
                ->where('parent_id', $category->category_id)->get();
        }

        return response()->json($productCategory);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'group_id' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'is_new_category' => 'required|boolean',
            'clicked_count' => 'nullable|integer',
            'date_added' => 'nullable|date',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            'descriptions' => 'required|array',
            'descriptions.*.language_id' => 'required|integer',
            'descriptions.*.name' => 'required|string'
        ]);
        $today = Carbon::today();
        // Create the product category
        $productCategory = ProductCategory::create([
            'group_id' => $request->group_id,
            'parent_id' => $request->parent_id,
            'image' => $request->image,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'is_new_category' => $request->is_new_category,
            'clicked_count' => $request->clicked_count,
            'date_added' => $today, // Set today's date
            'created_at' => $today, // Set today's date
            'updated_at' => $today // Set today's date
        ]);

        // Create the related descriptions
        foreach ($request->descriptions as $description) {
            $productCategory->descriptions =  ProductCategoryDescription::create([
                'category_id' => $productCategory->category_id,
                'language_id' => $description['language_id'],
                'name' => $description['name']
            ]);
        };


        $productCategories = ProductCategory::where('group_id', $productCategory->group_id)
            ->where('parent_id', 0)
            ->join('tbl_product_category_description', 'tbl_product_category.category_id', '=', 'tbl_product_category_description.category_id')
            ->select('tbl_product_category.*', 'tbl_product_category_description.name as category_name')
            ->get();

        foreach ($productCategories as $category) {
            $category->child = ProductCategory::join('tbl_product_category_description', 'tbl_product_category.category_id', '=', 'tbl_product_category_description.category_id')
                ->select('tbl_product_category.*', 'tbl_product_category_description.name as category_name')
                ->where('parent_id', $category->category_id)->get();
        }

        return response()->json($productCategories);
    }


    /**
     * Display the specified resource.
     */
    public function show($group_id)
    {
        $productCategories = ProductCategory::where('group_id', $group_id)
            ->where('parent_id', 0)
            ->join('tbl_product_category_description', 'tbl_product_category.category_id', '=', 'tbl_product_category_description.category_id')
            ->join('tbl_branch_to_category', 'tbl_product_category.category_id', '=', 'tbl_branch_to_category.category_id')
            // ->select('tbl_product_category.*', 'tbl_product_category_description.name as category_name')
            ->get();

        foreach ($productCategories as $category) {
            $category->child = ProductCategory::join('tbl_product_category_description', 'tbl_product_category.category_id', '=', 'tbl_product_category_description.category_id')
            ->join('tbl_branch_to_category', 'tbl_product_category.category_id', '=', 'tbl_branch_to_category.category_id')
                // ->select('tbl_product_category.*', 'tbl_product_category_description.name as category_name')
                ->where('parent_id', $category->category_id)->get();
        }
        return response()->json($productCategories);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        // Gelen verileri loglayın
        Log::info('Received data:', $request->all());

        $updatedCategories = [];

        foreach ($request->all() as $categoryData) {
            Log::info('Processing category with ID:', ['category_id' => $categoryData['category_id']]);

            $productCategory = ProductCategory::find($categoryData['category_id']);

            if (!$productCategory) {
                Log::warning('No product category found for ID:', ['category_id' => $categoryData['category_id']]);
                continue;
            }

            // Ana kategori güncellemesi
            $productCategory->update([
                'group_id' => $categoryData['group_id'],
                'parent_id' => $categoryData['parent_id'],
                'image' => $categoryData['image'],
                'description' => $categoryData['description'],
                'sort_order' => $categoryData['sort_order'],
                'is_new_category' => $categoryData['is_new_category'],
                'clicked_count' => $categoryData['clicked_count'],
                'date_added' => $categoryData['date_added'],
                'created_at' => $categoryData['created_at'],
                'updated_at' => $categoryData['updated_at'],
                'visible' => $categoryData['visible']
            ]);

            // Ana kategori açıklaması güncellemesi
            $description = ProductCategoryDescription::where('category_id', $categoryData['category_id'])->first();
            if ($description) {
                $description->update([
                    'name' => $categoryData['name']
                ]);
            } else {
                ProductCategoryDescription::create([
                    'category_id' => $categoryData['category_id'],
                    'name' => $categoryData['name']
                ]);
            }

            $updatedCategory = $productCategory;




            $updatedCategories[] = $updatedCategory;
        }

        return response()->json(['message' => 'Categories updated successfully.', 'data' => $updatedCategories]);
    }


    public function updateAll(Request $request)
    {
        // Gelen veriyi al ve logla
        $categoryData = $request->all();
        Log::info('Received data:', $categoryData);
    
        // Kategori verisini işleyin
        Log::info('Processing category with ID:', ['category_id' => $categoryData['category_id']]);
    
        $productCategory = ProductCategory::find($categoryData['category_id']);
    
        if (!$productCategory) {
            Log::warning('No product category found for ID:', ['category_id' => $categoryData['category_id']]);
            return response()->json(['message' => 'No product category found for given ID.'], 404);
        }
    
        // Ana kategori güncellemesi
        $productCategory->update([
            'group_id' => $categoryData['group_id'],
            'parent_id' => $categoryData['parent_id'],
            'image' => $categoryData['image'],
            'description' => $categoryData['description'],
            'sort_order' => $categoryData['sort_order'],
            'is_new_category' => $categoryData['is_new_category'],
            'clicked_count' => $categoryData['clicked_count'],
            'date_added' => $categoryData['date_added'],
            'created_at' => $categoryData['created_at'],
            'updated_at' => $categoryData['updated_at'],
            'visible' => $categoryData['visible']
        ]);
    
        // Ana kategori açıklaması güncellemesi
        $description = ProductCategoryDescription::where('category_id', $categoryData['category_id'])->first();
        if ($description) {
            $description->update([
                'name' => $categoryData['name']
            ]);
        } else {
            $description = ProductCategoryDescription::create([
                'category_id' => $categoryData['category_id'],
                'name' => $categoryData['name']
            ]);
        }
    
        // Güncellenmiş kategori verisini döndür
        $updatedCategory = ProductCategory::with('descriptions')->find($categoryData['category_id']);
    
        return response()->json(['message' => 'Category updated successfully.', 'data' => $updatedCategory]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        // delete related descriptions
        $productCategory->descriptions()->delete();

        // delete the product category itself
        $productCategory->delete();

        return response()->json(['message' => 'Product category and its descriptions deleted successfully.']);
    }
}
