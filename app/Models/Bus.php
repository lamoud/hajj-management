<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    public function pilgrims()
{
    return $this->hasMany(Pilgrim::class, 'bus_id');
}

}
