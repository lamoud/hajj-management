<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employesJobsCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

        
    public function positions()
    {
        return $this->hasMany(EmployesJob::class, 'category_id');
    }
}
