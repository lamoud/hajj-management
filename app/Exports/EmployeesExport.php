<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $employees;

    public function __construct(array $employees)
    {
        $this->employees = $employees;
    }

    public function collection()
    {
        return Employe::whereIn('id', $this->employees)->get();
    }
}
