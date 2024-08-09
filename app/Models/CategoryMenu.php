<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMenu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_category_groups";
    protected $primaryKey = 'id';
    protected $fillable = ["name", "image", "branch_id", "created_date"];
}
