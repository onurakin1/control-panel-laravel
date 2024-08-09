<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class ProductCategoryDescription extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_category_description";
    protected $fillable = ["language_id", "category_id", "name"];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'category_id');
    }
}
