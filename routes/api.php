<?php

use App\Http\Controllers\AllergenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GroupBranchController;
use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDescriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplateSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);
Route::apiResource('group-branch', GroupBranchController::class);
Route::apiResource('category', CategoryMenuController::class);
Route::apiResource('product-category', ProductCategoryController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('product-description', ProductDescriptionController::class);
Route::apiResource('allergen', AllergenController::class);
Route::apiResource('template', TemplateSettingController::class);


Route::get('/export', [UserController::class, 'export']);
Route::post('/import', [UserController::class, 'import']);
// Route::get('product-category', [ProductCategoryController::class, 'index']);
// Route::get('product-category/{group_id}', [ProductCategoryController::class, 'show']);
// Route::post('product-category', [ProductCategoryController::class, 'store']);
// Route::delete('product-category/{productCategory}', [ProductCategoryController::class, 'destroy']);
// Route::put('product-category', [ProductCategoryController::class, 'update']);
Route::get('/', function(){
    return 'API';
});