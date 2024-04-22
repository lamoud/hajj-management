<?php

namespace App\Livewire\Admin\Buses;

use App\Models\Bus;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BusesManagement extends Component
{
    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;
    public $user;

    public $name;
    public $board_number;
    public $declaration;
    public $capacity;
    public $description;

    public $selectedBus;
    public $current_bus;
    public $up_name;
    public $up_board_number;
    public $up_declaration;
    public $up_capacity;
    public $up_description;
    public $up_season_name;
    public $showEditModal = false;
    
        
    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
    }
    
    public function active_bus(  $bus_id ){

        $bus = Bus::where(['id'=> $bus_id])->first();        
        if( ! $bus ){
            $this->current_bus = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على المخيم!');
        }

        $this->current_bus = $bus;
        $this->up_name = $bus->name;
        $this->up_board_number = $bus->number;
        $this->up_declaration = $bus->declaration;
        $this->up_capacity = $bus->capacity;
        $this->up_description = $bus->description;
        $this->up_season_name = $bus->season->name ?? 'غير معروف';
        
    }

    public function addNewBus()
    {
        
        if( ! $this->user->can('buses_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name'  => ['required', 'string', 'min:3', 'max:100',
                Rule::unique('buses', 'name')->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],
            'board_number' => ['required', 'string', 'min:3', 'max:100',
                Rule::unique('buses', 'number')->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],
            'declaration' => ['required', 'string', 'min:3', 'max:100',
                Rule::unique('buses', 'declaration')->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],
            'capacity' => ['required', 'numeric', 'min:1', 'max:50'],
            'season_name' => ['required', function ($attribute, $value, $fail) {
                if (!empty($this->current_season)) {
                    $exists = Season::
                                where('name', $value)
                                ->where('id', $this->current_season->id ?? 0)
                                ->exists();
                    if (!$exists) {
                        $fail('The selected :attribute is invalid.');
                    }
                }else{
                    $fail('The selected :attribute is invalid.');
                }
            }],            
            'description' => ['nullable'],
        ]);

        Bus::create([
            'name'=> $this->name,
            'number'=> $this->board_number,
            'declaration'=> $this->declaration,
            'capacity'=> $this->capacity,
            'season_id'=> $this->current_season->id,
            'description'=> $this->description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إضافة الباص بنجاح!');
        $this->reset('name', 'board_number', 'declaration', 'capacity', 'description');
        
    }
    public function confirm_edit( $bus_id )
    {
        if( ! $this->user->can('buses_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_bus($bus_id);

        if( $this->current_bus && $this->current_bus->id == $bus_id ){
            return $this->dispatch('showEditBusModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateBus()
    {

        $this->validate([
            'up_name'  => ['required', 'string', 'min:3', 'max:100',
                Rule::unique('buses', 'name')->ignore($this->current_bus->id)->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],
            'up_board_number' => ['required', 'string', 'min:3', 'max:100',
                Rule::unique('buses', 'number')->ignore($this->current_bus->id)->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],        
            'up_declaration' => ['required', 'string', 'min:3', 'max:100',
                Rule::unique('buses', 'declaration')->ignore($this->current_bus->id)->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],
            'up_capacity' => ['required', 'numeric', 'min:1', 'max:50'],           
            'up_description' => ['nullable'],
        ]);

        $this->current_bus->update([
            'name'=> $this->up_name,
            'number'=> $this->up_board_number,
            'declaration'=> $this->up_declaration,
            'capacity'=> $this->up_capacity,
            'description'=> $this->up_description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إضافة التعديلات بنجاح!');
        $this->reset('up_name', 'up_board_number', 'up_declaration', 'up_capacity', 'up_description');
    }

    public function confirm_delete( $bus_id )
    {
        if( ! $this->user->can('buses_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_bus($bus_id);

        if( $this->current_bus && $this->current_bus->id == $bus_id ){
            return $this->dispatch('deleteBusConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_bus->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_bus()
    {
        $this->current_bus->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_bus', 'up_name', 'up_description', 'up_season_name');
        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
    }

    public function mount()
    {
        $this->user = Auth::user();

        $this->seasons = Season::get();
        $this->status ='upcoming';

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
    }
    public function render()
    {
        return view('livewire.admin.buses.buses-management');
    }
}
