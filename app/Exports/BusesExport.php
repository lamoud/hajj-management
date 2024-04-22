<?php

namespace App\Exports;

use App\Models\Bus;
use Maatwebsite\Excel\Concerns\FromCollection;

class BusesExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $buses;

    public function __construct(array $buses)
    {
        $this->buses = $buses;
    }

    public function collection()
    {
        return Bus::whereIn('id', $this->buses)->get();
    }
}
