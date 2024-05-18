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

    public function __construct(array $units = null)
    {
        $this->units = $units;
    }

    public function collection()
    {
        if( $this->units ){
            return Pilgrim::whereIn('unit_id', $this->units)->get();
        }else{
            return Pilgrim::all();
        }
    }
}
