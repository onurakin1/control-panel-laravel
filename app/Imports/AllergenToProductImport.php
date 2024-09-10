<?php

namespace App\Imports;
use App\Models\AllergenToProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class AllergenToProductImport implements ToModel, WithStartRow
{


    public function model(array $row)
    {
     
        $allergens = AllergenToProduct::create([
            'allergen_id' => $row[2],
            'product_id' => $row[0]

        ]);

        return $allergens;
    }

    public function startRow(): int
    {
        return 2;  
    }
}
