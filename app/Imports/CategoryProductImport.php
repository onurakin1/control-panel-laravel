<?php

namespace App\Imports;

use App\Models\ProductCategory;
use App\Models\ProductCategoryDescription;
use App\Models\BranchToCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class CategoryProductImport implements ToModel, WithStartRow
{
    // Sınıf düzeyinde bir statik değişken tanımlıyoruz
    public static $lastCategoryId;

    public function model(array $row)
    {
     
        $productCategory = ProductCategory::create([
            'category_id' => $row[0],
            'image' => $row[8],
            'group_id' => $row[7],
            'parent_id' =>0,
            'sort_order' => $row[9],
            'date_added' => Carbon::now()->format('Y-m-d'),
        ]);

        $productToBranchPrice = BranchToCategory::create([
            'branch_id' => $row[10],
            'category_id' => $productCategory->category_id,
            'sort_order' => $row[9],
            'date_added' => Carbon::now()->format('Y-m-d'),
            'date_modified' => Carbon::now()->format('Y-m-d')
        ]);

        $descriptions = [
            ['name' => $row[1], 'language_id' => $row[2]],
            ['name' => $row[3], 'language_id' => $row[4]], 
            ['name' => $row[5], 'language_id' => $row[6]], 
        ];

        foreach ($descriptions as $description) {
            ProductCategoryDescription::create([
                'category_id' => $productCategory->category_id, 
                'name' => $description['name'],
                'language_id' => $description['language_id'],
            ]);
        }

        return $productCategory;
    }

    public function startRow(): int
    {
        return 2;  
    }
}
