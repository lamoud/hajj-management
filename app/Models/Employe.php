<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $guarded = [];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
    
    public function position()
    {
        return $this->belongsTo(EmployesJob::class, 'job_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
    
    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
