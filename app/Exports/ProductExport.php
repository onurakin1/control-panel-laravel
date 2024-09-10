<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Product;
use App\Models\ProductDescription;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function title(): string
    {
        return 'Products'; // Sheet adı
    }

    public function headings(): array
    {
        return [
            'ID',
            'Product ID',
            'Integration ID',
            'Image',
            'Video',
            'Is New Product',
            'Sort Order',
            'Clicked Count'
        ];
    }
}
