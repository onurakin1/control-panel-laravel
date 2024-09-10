<?php

namespace App\Imports;
use App\Models\Allergen;
use App\Models\AllergenDescription;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class AllergenImport implements ToModel, WithStartRow
{


    public function model(array $row)
    {
     
        $allergens = Allergen::create([
            'allergen_id' => $row[0],
            'date_added' => Carbon::now()->format('Y-m-d'),

        ]);

        $descriptions = [
            ['name' => $row[1], 'language_id' => $row[2]],
            ['name' => $row[3], 'language_id' => $row[4]], 
            ['name' => $row[5], 'language_id' => $row[6]], 
        ];

        foreach ($descriptions as $description) {
            AllergenDescription::create([
                'allergen_id' => $allergens->allergen_id, 
                'name' => $description['name'],
                'language_id' => $description['language_id'],
            ]);
        }

        return $allergens;
    }

    public function startRow(): int
    {
        return 2;  
    }
}
