<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pilgrims()
    {
        return $this->hasMany(Pilgrim::class, 'unit_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class, 'bed_type');
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class, 'unit_type');
    }

    public function employees()
    {
        return $this->hasMany(Employe::class, 'unit_id');
    }
}
