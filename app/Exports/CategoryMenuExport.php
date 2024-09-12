<?php

namespace App\Exports;

use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class CategoryMenuExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tbl_category_groups as cg')
            ->select('cg.id', 'cg.name', 'cg.image', 'cg.branch_id', 'cg.language_id', 'cg.parent_id')
            ->get();
    }

    public function title(): string
    {
        return 'Menus'; // Sheet name
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Image',
            'Branch ID',
            'Language ID',
            'Parent ID'

   
        ];
    }
}
