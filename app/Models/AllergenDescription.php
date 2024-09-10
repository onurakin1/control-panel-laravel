<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllergenDescription extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_product_allergen_description";
    protected $primaryKey = 'id';
    protected $fillable = ["allergen_id", "language_id", "name"];

}
