<?php

namespace App\Imports;

use App\Models\Pilgrim;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PilgrimsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pilgrim([
            'name'     => $row['name'],
            'number'=> $row['number'] ?? null,
            'declaration'=> $row['declaration'] ?? null,
            'national_id'=> $row['national_id'] ?? null,
            'nationality'=> $row['nationality'] ?? null,
            'gender'=> $row['gender'] ?? null,
            'camp_id'=> $row['camp_id'] ?? null,
            'unit_id'=> $row['unit_id'] ?? null,
            'arrival_type'=> $row['arrival_type'] ?? null,
            'agency_id'=> $row['agency_id'] ?? null,
            'phone'=> $row['phone'] ?? null,
            'phone2'=> $row['phone2'] ?? null,
            'season_id'=> $row['season_id'] ?? null,
            'created_at'=> $row['created_at'] ?? now(),
            'updated_at'=> $row['updated_at'] ?? now(),
        ]);
    }
}
