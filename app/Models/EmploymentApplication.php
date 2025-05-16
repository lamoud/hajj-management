<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentApplication extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    public function position()
    {
        return $this->belongsTo(EmployesJob::class, 'job_id');
    }
    
}
