<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\CategoryProductExport;
use App\Exports\ProductExport;

class MultiSheetExport  implements WithMultipleSheets
{
    /**
    * @return array
    */
    public function sheets(): array
    {
        return [
            new CategoryProductExport(),  // İlk sayfa
            new ProductExport(),     // İkinci sayfa
        ];
    }
}