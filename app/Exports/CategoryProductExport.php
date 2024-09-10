<?php

namespace App\Exports;

use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class CategoryProductExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tbl_product_category as pc')
            ->leftJoin('tbl_product_category_description as pcd', 'pc.category_id', '=', 'pcd.category_id')
            ->select('pc.category_id', 'pc.group_id', 'pc.parent_id', 'pc.image', 'pc.sort_order', 'pcd.name', 'pcd.language_id')
            ->get();
    }

    public function title(): string
    {
        return 'Category'; // Sheet name
    }

    public function headings(): array
    {
        return [
            'ID',
            'Group',
            'Parent ID',
            'Image',
            'Sort Order',
            'Name',
            'Language ID'
        ];
    }
}
