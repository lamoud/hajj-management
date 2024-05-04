<?php

namespace App\Livewire\Admin\Units;

use App\Models\BedType;
use App\Models\Camp;
use App\Models\Season;
use App\Models\Unit;
use App\Models\UnitType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UnitsManagement extends Component
{
    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;
    public $user;
    public $bedTypes;
    public $unitTypes;
    public $camps;

    public $name;
    public $unit_size;
    public $bed_type;
    public $unit_type;
    public $unit_accommodation;
    public $camp_id;

    public $selectedUnit;
    public $current_unit;
    public $up_name;
    public $up_unit_size;
    public $up_bed_type;
    public $up_unit_type;
    public $up_unit_accommodation;
    public $up_camp_id;
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
    
    public function active_unit(  $unit_id ){

        $unit = Unit::where(['id'=> $unit_id])->first();        
        if( ! $unit ){
            $this->current_unit = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على المخيم!');
        }

        $this->current_unit = $unit;

        $this->up_name = $unit->name;
        $this->up_unit_size = $unit->size;
        $this->up_bed_type = $unit->bed_type;
        $this->up_unit_type = $unit->unit_type;
        $this->up_unit_accommodation = $unit->capacity;
        $this->up_camp_id = $unit->camp_id;
        
    }

    public function addNewUnit()
    {
        
        if( ! $this->user->can('units_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }


        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', Rule::unique('units', 'name')->where(function ($query) {
                    return $query->where('season_id', $this->current_season->id);
                }),
            ],
            'unit_size' => ['required'],
            'bed_type' => ['required', 'exists:bed_types,id'],
            'unit_type' => ['required', 'exists:unit_types,id'],
            'unit_accommodation' => ['required', 'numeric', 'min:1', 'max:50'],
            'camp_id' => ['required', 'exists:camps,id'],
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
        ]);

        Unit::create([
            'name'=> $this->name,
            'size'=> $this->unit_size,
            'bed_type'=> $this->bed_type,
            'unit_type'=> $this->unit_type,
            'capacity'=> $this->unit_accommodation,
            'camp_id'=> $this->camp_id,
            'season_id'=> $this->current_season->id,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الخيمة (الوحدة) بنجاح!');
        $this->reset('name', 'bed_type', 'unit_type', 'unit_accommodation', 'camp_id');
        
    }

    public function confirm_edit( $unit_id )
    {
        if( ! $this->user->can('units_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_unit($unit_id);

        if( $this->current_unit && $this->current_unit->id == $unit_id ){
            return $this->dispatch('showEditUnitModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateUnit()
    {
        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_unit_size' => ['required'],
            'up_bed_type' => ['required', 'exists:bed_types,id'],
            'up_unit_type' => ['required', 'exists:unit_types,id'],
            'up_unit_accommodation' => ['required', 'numeric', 'min:1', 'max:50'],
            'up_camp_id' => ['required', 'exists:camps,id'], 
        ]);


        $this->current_unit->update([
            'name'=> $this->up_name,
            'size'=> $this->up_unit_size,
            'bed_type'=> $this->up_bed_type,
            'unit_type'=> $this->up_unit_type,
            'capacity'=> $this->up_unit_accommodation,
            'camp_id'=> $this->up_camp_id
        ]);

        $this->dispatch('refreshDatatable');
        $this->reset('up_name', 'up_bed_type', 'up_unit_type', 'up_unit_accommodation', 'up_camp_id');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
    }

    public function confirm_delete( $unit_id )
    {
        if( ! $this->user->can('units_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_unit($unit_id);

        if( $this->current_unit && $this->current_unit->id == $unit_id ){
            return $this->dispatch('deleteUnitConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_unit->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_unit()
    {
        $this->current_unit->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_unit', 'up_name', 'up_description', 'up_season_name');
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

        $this->bedTypes = BedType::get();
        $this->unitTypes = UnitType::get();
        $this->camps = Camp::where('season_id', $this->current_season->id ?? null)->get();
    }

    public function render()
    {
        return view('livewire.admin.units.units-management');
    }
}
