<?php

namespace App\Exports;

use App\Models\building;
use Maatwebsite\Excel\Concerns\FromCollection;

class buildingsExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $buildings;

    public function __construct(array $buildings)
    {
        $this->buildings = $buildings;
    }

    public function collection()
    {
        return building::whereIn('id', $this->buildings)->get();
    }
}
