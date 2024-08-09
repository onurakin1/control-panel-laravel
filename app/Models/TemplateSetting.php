<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSetting extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_template_settings";
    protected $primaryKey = 'id';
    protected $fillable = ['color', 'logo', 'name', 'banner', 'languages', 'layout', 'size'];
}
