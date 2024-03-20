<?php

namespace App\Exports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\FromCollection;

class agenciesExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $agencies;

    public function __construct(array $agencies)
    {
        $this->agencies = $agencies;
    }

    public function collection()
    {
        //dd($this->agencies);
        return Agency::whereIn('id', $this->agencies)->get();
    }
}
