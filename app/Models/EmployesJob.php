<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployesJob extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(employesJobsCategory::class, 'category_id');
    }
    
    public function employees()
    {
        return $this->hasMany(Employe::class, 'job_id');
    }

}
