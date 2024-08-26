<?php

use App\Http\Controllers\AllergenController;
use App\Http\Controllers\GroupBranchController;
use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDescriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplateSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('group-branch', GroupBranchController::class);
Route::apiResource('category', CategoryMenuController::class);
Route::apiResource('product-category', ProductCategoryController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('product-description', ProductDescriptionController::class);
Route::apiResource('allergen', AllergenController::class);
Route::apiResource('template', TemplateSettingController::class);
Route::apiResource('company', CompanyController::class);
Route::apiResource('user', UserController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/upload', [FileUploadController::class, 'uploadFile']);
// Route::get('product-category', [ProductCategoryController::class, 'index']);
// Route::get('product-category/{group_id}', [ProductCategoryController::class, 'show']);
// Route::post('product-category', [ProductCategoryController::class, 'store']);
// Route::delete('product-category/{productCategory}', [ProductCategoryController::class, 'destroy']);
// Route::put('product-category', [ProductCategoryController::class, 'update']);
Route::get('/', function(){
    return 'API';
});