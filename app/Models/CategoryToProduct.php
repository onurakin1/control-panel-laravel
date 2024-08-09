<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CategoryToProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_category_to_product";
    protected $fillable = ["category_id", "product_id"];

    public function category()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
