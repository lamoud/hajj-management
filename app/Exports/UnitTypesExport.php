<?php

namespace App\Exports;

use App\Models\UnitType;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnitTypesExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $types;

    public function __construct(array $types)
    {
        $this->types = $types;
    }

    public function collection()
    {
        return UnitType::whereIn('id', $this->types)->get();
    }
}
