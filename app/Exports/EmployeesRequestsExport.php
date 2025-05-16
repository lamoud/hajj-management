<?php

namespace App\Exports;

use App\Models\EmploymentApplication;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesRequestsExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $requests;

    public function __construct(array $requests)
    {
        $this->requests = $requests;
    }

    public function collection()
    {
        return EmploymentApplication::whereIn('id', $this->requests)->get();
    }
}
