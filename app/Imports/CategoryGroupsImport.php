<?php

namespace App\Imports;

use App\Models\CategoryMenu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class CategoryGroupsImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
      
        $descriptions = [
            ['name' => $row[2], 'language_id' => $row[3]],
            ['name' => $row[4], 'language_id' => $row[5]], 
            ['name' => $row[6], 'language_id' => $row[7]], 
        ];

        foreach ($descriptions as $description) {
            CategoryMenu::create([
                'parent_id' => $row[0], 
                'branch_id' => $row[8], 
                'image' => $row[1],
                'created_date' => Carbon::now()->format('Y-m-d'), 
                'name' => $description['name'],
                'language_id' => $description['language_id'], 
            ]);
        }


        return null;
    }

    public function startRow(): int
    {
        return 2;  
    }
}
