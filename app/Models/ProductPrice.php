<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_price";
    protected $primaryKey = 'id';
    protected $fillable = ["product_id", "branch_id", "price", "date_added", "date_modified"];

}
