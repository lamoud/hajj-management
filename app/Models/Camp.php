<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    public function pilgrims()
    {
        return $this->hasMany(Pilgrim::class, 'camp_id');
    }
}
