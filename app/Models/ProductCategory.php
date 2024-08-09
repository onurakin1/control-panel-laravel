<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategoryDescription;

class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_category";
    protected $primaryKey = 'category_id';
    protected $fillable = ["group_id", "parent_id", "image", "sort_order", "is_new_category", "description", "clicked_count", "date_added", "created_at", "updated_at"];

    public function descriptions()
    {
        return $this->hasMany(ProductCategoryDescription::class, 'category_id', 'category_id');
    }

    public function child()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
