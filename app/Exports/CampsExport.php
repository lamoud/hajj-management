<?php

namespace App\Exports;

use App\Models\Camp;
use Maatwebsite\Excel\Concerns\FromCollection;

class CampsExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $camps;

    public function __construct(array $camps)
    {
        $this->camps = $camps;
    }

    public function collection()
    {
        return Camp::whereIn('id', $this->camps)->get();
    }
}
