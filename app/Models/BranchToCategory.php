<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class BranchToCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_branch_to_category";
    protected $fillable = ["branch_id", "category_id", "sort_order", "date_added", "visible"];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
