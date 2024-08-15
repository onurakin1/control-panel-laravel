<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class BranchToProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_branch_to_product";
    protected $fillable = ["branch_id", "product_id", "image", "is_new_product", "clicked_count", "sort_order", "date_added", "date_modified", "visible"];

    public function category()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
