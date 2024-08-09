<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductDescription extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_description";
    protected $fillable = ["language_id", "product_id", "name", "desc"];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
