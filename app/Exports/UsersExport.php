<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return User::whereIn('id', $this->users)->get();
    }
}
