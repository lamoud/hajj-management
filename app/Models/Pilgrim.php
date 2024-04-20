<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilgrim extends Model
{
    use HasFactory;
    protected $guarded = [];
    
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
