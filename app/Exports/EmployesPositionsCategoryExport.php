<?php

namespace App\Exports;

use App\Models\Employe;
use App\Models\employesJobsCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployesPositionsCategoryExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function collection()
    {
        return employesJobsCategory::whereIn('id', $this->categories)->get();
    }
}
