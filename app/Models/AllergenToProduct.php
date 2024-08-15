<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class AllergenToProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_to_allergen";
    protected $fillable = ["allergen_id", "product_id"];

    public function allergen()
    {
        return $this->belongsTo(Product::class, 'allergen_id');
    }
}
