<?php

namespace App\Imports;

use App\Models\CategoryMenu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class CategoryProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new CategoryMenu([
            'name' => $row['name'],        // Başlık satırına göre çek
            'image' => $row['image'],      // Başlık satırına göre çek
            'branch_id' => $row['branch_id'], // Başlık satırına göre çek
            'created_date' => !empty($row['created_date']) ? $row['created_date'] : Carbon::now()->format('Y-m-d'),
            'language_id' => $row['language_id'], 
            'parent_id' => $row['parent_id'], 
        ]);
    }
}