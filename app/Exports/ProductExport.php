<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tbl_product as p')
            ->leftJoin('tbl_product_description as pd', 'p.product_id', '=', 'pd.product_id')
            ->leftJoin('tbl_product_price as pc', 'p.product_id', '=', 'pc.product_id')
            ->select('p.product_id', 'p.integration_id', 'p.image', 'p.sort_order', 'p.clicked_count', 'pd.name', 'pd.desc', 'pd.language_id', 'pc.branch_id', 'pc.price')
            ->get();
    }

    public function title(): string
    {
        return 'Products'; // Sheet adı
    }

    public function headings(): array
    {
        return [
            'Product ID',
            'Integration ID',
            'Image',
            'Sort Order',
            'Clicked Count',
            'Name',
            'Description',
            'Language ID',
            'Branch ID',
            'Price'
        ];
    }
}
