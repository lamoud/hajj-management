<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'contact_number', 'address', 'season_id', 'description'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
