<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ProductImport;
use App\Imports\CategoryProductImport;
use App\Imports\AllergenImport;
use App\Imports\AllergenToProductImport;

class MultiSheetImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'CategoryGroups' => new CategoryGroupsImport(),
            'Category' => new CategoryProductImport(), // Worksheet adını belirtin+
            'Subcategory' => new SubCategoryProductImport(),
            'Products' => new ProductImport(), // Worksheet adını belirtin
            'Allergen' => new AllergenImport(),
            'AllergenToProduct' => new AllergenToProductImport()
        ];
    }
}