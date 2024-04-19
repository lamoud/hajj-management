<?php

namespace App\Exports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnitsExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $units;

    public function __construct(array $units)
    {
        $this->units = $units;
    }

    public function collection()
    {
        return Unit::whereIn('id', $this->units)->get();
    }
}
