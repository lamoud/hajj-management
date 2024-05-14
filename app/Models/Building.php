<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
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

    public function pilgrims()
    {
        return $this->hasMany(Pilgrim::class, 'camp_id');
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'camp_id');
    }
}
