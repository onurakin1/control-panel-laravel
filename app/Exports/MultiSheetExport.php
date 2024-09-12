<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\CategoryProductExport;
use App\Exports\ProductExport;
use App\Exports\CategoryMenuExport;

class MultiSheetExport  implements WithMultipleSheets
{
    /**
    * @return array
    */
    public function sheets(): array
    {
        return [
            new CategoryMenuExport(),
            new CategoryProductExport(),
            new ProductExport(), 
        ];
    }
}