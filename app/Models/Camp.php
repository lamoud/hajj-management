<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'coordinates', 'season_id', 'description'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
