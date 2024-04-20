<?php

namespace App\Exports;

use App\Models\Pilgrim;
use Maatwebsite\Excel\Concerns\FromCollection;

class PilgrimsExport implements FromCollection
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
        return Pilgrim::whereIn('id', $this->units)->get();
    }
}
