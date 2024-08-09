<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBranch extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_branch";
    protected $primaryKey = 'branch_id';
    protected $fillable = ["branch_group_id", "branch_name", "branch_name_summary", "branch_price_type", "branch_default_language_id", "branch_city", "branch_address", "branch_phone", "branch_fax", "branch_mail", "branch_progress_image", "branch_logo", "qr_menu_logo", "branch_color_code", "branch_lat", "branch_lng", "branch_username", "branch_pass", "sms_verification", "force_field_status", "qr_code_content", "date_added", "visible"];
}
