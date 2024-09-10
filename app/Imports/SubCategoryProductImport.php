<?php

namespace App\Imports;

use App\Models\ProductCategory;
use App\Models\ProductCategoryDescription;
use App\Models\BranchToCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class SubCategoryProductImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
    
            $productCategory = ProductCategory::create([
                'category_id' => $row[0],
                'image' => $row[9],
                'group_id' => $row[8],
                'parent_id' => $row[1],
                'sort_order' => $row[10],
                'date_added' => Carbon::now()->format('Y-m-d'),
            ]);

            $productToBranchPrice = BranchToCategory::create([
                'branch_id' => $row[11],
                'category_id' => $productCategory->category_id,
                'sort_order' => $row[10]
            ]);

            $descriptions = [
                ['name' => $row[2], 'language_id' => $row[3]],
                ['name' => $row[4], 'language_id' => $row[5]], 
                ['name' => $row[6], 'language_id' => $row[7]], 
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