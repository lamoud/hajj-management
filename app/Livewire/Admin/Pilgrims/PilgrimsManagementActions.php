<?php

namespace App\Livewire\Admin\Pilgrims;

use App\Models\Bus;
use App\Models\Camp;
use App\Models\Pilgrim;
use App\Models\Season;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PilgrimsManagementActions extends Component
{
    public $seasons;
    public $season_name = 'غير معروف';
    public $current_season;
    public $user;
    public $buses;
    public $camps;
    public $units;
    public $agencys;

    public $pilgrims_search;
    public $pilgrim;

    public $actions = 'accommodation';
    public $camp_id;
    public $unit_id;
    public $bus_id;

    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
    }

    // public function updatedActionsh()
    // {
    //     switch ($this->actions) {
    //         case 'accommodation':
    //             # code...
    //             break;
            
    //         default:
    //             # code...
    //             break;
    //     }
    // }

    public function updatedPilgrimsSearch()
    {
        $this->searchPilgrim();
    }

    public function searchPilgrim()
    {
        if ($this->pilgrims_search) {
            $this->pilgrim = Pilgrim::where('season_id', $this->current_season->id)
                ->where(function($query) {
                    $query->where('name', 'like', '%' . $this->pilgrims_search . '%')
                            ->orWhere('number', 'like', '%' . $this->pilgrims_search . '%')
                            ->orWhere('national_id', 'like', '%' . $this->pilgrims_search . '%');
                })
            ->first();
        } else {
            $this->pilgrim = null;
        }
    }

    public function updateCamp($input)
    {
        
        $this->units = Unit::where('camp_id', $this->$input)->get();
        $this->unit_id = null;
        
        
    }

    public function mount()
    {
        $this->user = Auth::user();

        $now = now();

        $date = Season::whereDate('start_date', '<=', $now)
        ->whereDate('end_date', '>=', $now)
        ->first();

        if( $date ){
            $this->active_season( $date->id, $date->slug);
        }else{
            $date = Season::whereDate('start_date', '>', $now)
            ->orderBy('start_date', 'asc')
            ->first();
        }

        if( $date ){
            $this->active_season( $date->id, $date->slug);
        }

        $this->camps = Camp::where('season_id', $this->current_season->id ?? null)->get();
        $this->buses = Bus::where('season_id', $this->current_season->id ?? null)->get();

    }
    public function render()
    {
        return view('livewire.admin.pilgrims.pilgrims-management-actions');
    }
}
