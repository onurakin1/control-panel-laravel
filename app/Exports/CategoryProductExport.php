<?php

namespace App\Exports;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryProductExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductCategory::all();
    }

    public function title(): string
    {
        return 'Category'; // Sheet adı
    }

    public function headings(): array
    {
        return [
            'ID',
            'Group',
            'Parent ID',
            'Image',
            'Sort Order'
        ];
    }
}
