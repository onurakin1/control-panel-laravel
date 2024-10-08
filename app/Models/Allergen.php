<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_allergen";
    protected $primaryKey = 'id';
    protected $fillable = ["allergen_id", "image", "sort_order", "date_added", "visible"];

}
