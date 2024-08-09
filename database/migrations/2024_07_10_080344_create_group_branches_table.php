<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group_branches', function (Blueprint $table) {
            $table->branch_id(); 
            $table->unsignedBigInteger('branch_group_id')->default(1);
            $table->string('branch_name'); 
            $table->string('branch_name_summary'); 
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_branches');
    }
};