<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryToProduct;
use App\Models\ProductToAllergen;
use App\Models\ProductDescription;
class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product";
    protected $primaryKey = 'id';
    protected $fillable = ["product_id", "image", "video", "is_new_product", "sort_order", "date_added", "created_at"];

    public function products()
    {
        return $this->hasMany(CategoryToProduct::class, 'category_id');
    }

    public function allergens()
    {
        return $this->hasMany(ProductToAllergen::class, 'allergen_id');
    }

    public function productDescriptions()
    {
        return $this->hasMany(ProductDescription::class, 'product_id');
    }
}
