<?php

namespace App\Imports;

use App\Models\ProductDescription;
use App\Models\Product;
use App\Models\CategoryToProduct;
use App\Models\ProductPrice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class ProductImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {

        if (empty($row[1])) {
  
            return null;  
        }

            $productCategory = Product::create([
                'product_id' => $row[0],
                'image' => $row[11],
                'sort_order' => $row[13],
            ]);
            $categoryToProduct = CategoryToProduct::create([
                'category_id' => $row[1],
                'product_id' => $productCategory->product_id
            ]);

            $productToBranchPrice = ProductPrice::create([
                'branch_id' => $row[14],
                'product_id' => $productCategory->product_id,
                'price' => $row[12],
                'date_added' => Carbon::now()->format('Y-m-d'),
            ]);
            $descriptions = [
                ['name' => $row[2], 'desc' => $row[3], 'language_id' => $row[4]],
                ['name' => $row[5], 'desc' => $row[6], 'language_id' => $row[7]],
                ['name' => $row[8], 'desc' => $row[9], 'language_id' => $row[10]],
            ];

            foreach ($descriptions as $description) {
                if (!empty($description['name']) && !empty($description['desc'])) {
                    ProductDescription::create([
                        'product_id' => $productCategory->product_id,
                        'name' => $description['name'],
                        'desc' => $description['desc'],
                        'language_id' => $description['language_id'],
                    ]);
                }
            }
        



        return $productCategory;
    }



    public function startRow(): int
    {
        return 2;
    }
}
