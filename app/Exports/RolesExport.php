<?php

namespace App\Exports;

use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\FromCollection;

class RolesExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $roles;

    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    public function collection()
    {
        return Role::whereIn('id', $this->roles)->get();
    }
}
