<?php

namespace App\Livewire\Admin\Units;

use App\Models\BedType;
use App\Models\Building;
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
    public $buildings;

    public $name;
    public $unit_size;
    public $bed_type;
    public $single_beds = 2;
    public $double_beds = 0;
    public $unit_type;
    public $unit_accommodation;
    public $camp_id;
    public $building_id;
    public $clone_count;

    public $selectedUnit;
    public $current_unit;
    public $up_name;
    public $up_unit_size;
    public $up_bed_type;
    public $up_single_beds = 2;
    public $up_double_beds = 0;
    public $up_unit_type;
    public $up_unit_accommodation;
    public $up_camp_id;
    public $up_building_id;
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
    
    public function updatedSingleBeds()
    {
        if (!is_numeric($this->single_beds)) {
            $this->single_beds = 0;
        }

        if (!is_numeric($this->double_beds)) {
            $this->double_beds = 0;
        }

        $this->unit_accommodation = ($this->single_beds * 1) + ($this->double_beds * 2);
    }
    
    public function updatedDoubleBeds()
    {

        if (!is_numeric($this->single_beds)) {
            $this->single_beds = 0;
        }

        if (!is_numeric($this->double_beds)) {
            $this->double_beds = 0;
        }

        $this->unit_accommodation = ($this->single_beds * 1) + ($this->double_beds * 2);
    }
    
    public function updatedUpSingleBeds()
    {
        if (!is_numeric($this->up_single_beds)) {
            $this->up_single_beds = 0;
        }

        if (!is_numeric($this->up_double_beds)) {
            $this->up_double_beds = 0;
        }
        $this->up_unit_accommodation = ($this->up_single_beds * 1) + ($this->up_double_beds * 2);
    }
    
    public function updatedUpDoubleBeds()
    {
        if (!is_numeric($this->up_single_beds)) {
            $this->up_single_beds = 0;
        }

        if (!is_numeric($this->up_double_beds)) {
            $this->up_double_beds = 0;
        }
        $this->up_unit_accommodation = ($this->up_single_beds * 1) + ($this->up_double_beds * 2);
    }
    
    public function updatedCampId()
    {
        $this->buildings = Building::where(['camp_id'=>$this->camp_id])->get();
        $this->up_building_id = null;
    }
    
    public function updatedUpCampId()
    {
        $this->buildings = Building::where(['camp_id'=>$this->up_camp_id])->get();
        $this->up_building_id = null;
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
        //$this->up_bed_type = $unit->bed_type;
        $this->up_single_beds = $unit->single_beds;
        $this->up_double_beds = $unit->double_beds;
        $this->up_unit_type = $unit->unit_type;
        $this->up_unit_accommodation = $unit->capacity;
        $this->up_camp_id = $unit->camp_id;
        $this->up_building_id = $unit->building_id;

        $this->buildings = Building::where(['camp_id'=>$unit->camp_id])->get();
        
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
            'single_beds' => ['required', 'min:0'],
            'double_beds' => ['required', 'min:0'],
            'unit_type' => ['required', 'exists:unit_types,id'],
            'unit_accommodation' => ['required', 'numeric', 'min:1', 'max:50'],
            'camp_id' => ['required', 'exists:camps,id'],
            'building_id' => ['nullable', 'exists:buildings,id'],
            'clone_count' => ['nullable', 'max:50'],
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
            'single_beds'=> $this->single_beds,
            'double_beds'=> $this->double_beds,
            'unit_type'=> $this->unit_type,
            'capacity'=> $this->unit_accommodation,
            'camp_id'=> $this->camp_id,
            'season_id'=> $this->current_season->id,
            'building_id'=> $this->building_id ?? null,
        ]);
        
        if ($this->clone_count && is_numeric($this->clone_count) && $this->clone_count > 0) {
            
            $unit = Unit::orderBy('name', 'DESC')->first();
            $unitName = $unit->name;

            for ($i=0; $i < $this->clone_count; $i++) {
                $unitName += 1;

                //dd($unitName);
                $check = Unit::where('name', $unitName)->first();

                if ( ! $check ) {
                    Unit::create([
                        'name'=> $unitName,
                        'size'=> $this->unit_size,
                        'single_beds'=> $this->single_beds,
                        'double_beds'=> $this->double_beds,
                        'unit_type'=> $this->unit_type,
                        'capacity'=> $this->unit_accommodation,
                        'camp_id'=> $this->camp_id,
                        'season_id'=> $this->current_season->id,
                        'building_id'=> $this->building_id ?? null,
                    ]);
                }

            }

        }

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الخيمة (الوحدة) بنجاح!');
        $this->reset(
            'current_unit',
            'name',
            'unit_size',
            'single_beds',
            'double_beds',
            'unit_type',
            'unit_accommodation',
            'camp_id',
            'building_id',
            'clone_count',
            'buildings',
        );
        
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
            'up_single_beds' => ['required', 'min:0'],
            'up_double_beds' => ['required', 'min:0'],
            'up_unit_type' => ['required', 'exists:unit_types,id'],
            'up_unit_accommodation' => ['required', 'numeric', 'min:1', 'max:50'],
            'up_camp_id' => ['required', 'exists:camps,id'], 
            'up_building_id' => ['nullable', 'exists:buildings,id'],
        ]);


        $this->current_unit->update([
            'name'=> $this->up_name,
            'size'=> $this->up_unit_size,
            'single_beds'=> $this->up_single_beds,
            'double_beds'=> $this->up_double_beds,
            'unit_type'=> $this->up_unit_type,
            'capacity'=> $this->up_unit_accommodation,
            'camp_id'=> $this->up_camp_id,
            'building_id'=> $this->up_building_id ?? null,
        ]);

        $this->dispatch('refreshDatatable');
        $this->reset(
            'current_unit',
            'up_name',
            'up_unit_size',
            'up_single_beds',
            'up_double_beds',
            'up_unit_type',
            'up_unit_accommodation',
            'up_camp_id',
            'up_building_id',
            'buildings'
        );
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
        $this->reset(
            'current_unit',
            'up_name',
            'up_unit_size',
            'up_single_beds',
            'up_double_beds',
            'up_unit_type',
            'up_unit_accommodation',
            'up_camp_id',
            'up_building_id',
            'buildings'
        );
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

        $this->unit_accommodation = ($this->single_beds * 1) + ($this->double_beds * 2);
        $this->buildings = Building::where(['camp_id'=>0])->get();
    }

    public function render()
    {
        return view('livewire.admin.units.units-management');
    }
}
