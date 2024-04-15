<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name',
    //         ],
    //     ];
    // }

    public function pilgrims()
    {
        return $this->hasMany(Pilgrim::class, 'agency_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

}
