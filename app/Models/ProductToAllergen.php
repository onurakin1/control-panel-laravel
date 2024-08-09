<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductToAllergen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_to_allergen";
    protected $fillable = ["product_id", "allergen_id"];

    public function category()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
