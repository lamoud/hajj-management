<?php

namespace App\Livewire\Admin\Pilgrims;

use App\Models\Agency;
use App\Models\Camp;
use App\Models\Nationality;
use App\Models\Pilgrim;
use App\Models\Season;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PilgrimsManagement extends Component
{
    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;
    public $user;
    public $camps;
    public $units;
    public $nationalities;
    public $agencys;

    public $name;
    public $pilgrim_number;
    public $national_id;
    public $nationality;
    public $gender;
    public $camp_id;
    public $unit_id;
    public $arrival_type;
    public $agency_id;
    public $phone;
    public $season_id;

    public $up_name;
    public $up_pilgrim_number;
    public $up_national_id;
    public $up_nationality;
    public $up_gender;
    public $up_camp_id;
    public $up_unit_id;
    public $up_arrival_type;
    public $up_agency_id;
    public $up_phone;

    public $selectedPilgrim;
    public $current_pilgrim;
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
    
    public function active_pilgrim(  $pilgrim_id ){

        $pilgrim = Pilgrim::where(['id'=> $pilgrim_id])->first();        
        if( ! $pilgrim ){
            $this->current_pilgrim = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على المخيم!');
        }

        $this->current_pilgrim = $pilgrim;

        $this->up_name = $pilgrim->name;
        $this->up_pilgrim_number = $pilgrim->pilgrim_number;
        $this->up_national_id = $pilgrim->national_id;
        $this->up_nationality = $pilgrim->nationality;
        $this->up_gender = $pilgrim->gender;
        $this->up_camp_id = $pilgrim->camp_id;
        $this->updateCamp('up_camp_id');
        $this->up_arrival_type = $pilgrim->arrival_type;
        $this->up_agency_id = $pilgrim->agency_id;
        $this->up_phone = $pilgrim->phone;
        $this->up_unit_id = $pilgrim->unit_id;
        
        
    }

    public function addNewPilgrim()
    {
        
        if( ! $this->user->can('pilgrims_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'pilgrim_number' => ['required', 'numeric', 'digits_between:1,15'],
            'national_id' => ['required', 'numeric', 'digits_between:10,11'],
            'nationality' => ['required', 'exists:nationalities,slug'],
            'gender' => ['required', 'in:male,female'],
            'camp_id' => ['required', 'exists:camps,id'],
            'unit_id' => ['required', 'exists:units,id', function ($attribute, $value, $fail) {
                if (!empty($this->camp_id)) {
                    $unit = Unit::
                                where('id', $value)
                                ->where('camp_id', $this->camp_id ?? 0)
                                ->first();
                    if (!$unit) {
                        $fail('The selected :attribute is invalid.');
                        return;
                    }
                        
                    if ($unit->capacity <= $unit->pilgrims->count()) {
                        $fail('اكتمل العدد في هذه الوحدة.');
                    }
                
                }else{
                    $fail('The selected :attribute is invalid.');
                }
            }],
            'arrival_type' => ['required', 'in:internal,external'],
            'agency_id' => ['required', 'exists:agencies,id'],
            'phone' => ['required', 'numeric', 'digits_between:8,20'],
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

        Pilgrim::create([
            'name'=> $this->name,
            'pilgrim_number'=> $this->pilgrim_number,
            'national_id'=> $this->national_id,
            'nationality'=> $this->nationality,
            'gender'=> $this->gender,
            'camp_id'=> $this->camp_id,
            'unit_id'=> $this->unit_id,
            'arrival_type'=> $this->arrival_type,
            'agency_id'=> $this->agency_id,
            'phone'=> $this->phone,
            'season_id'=> $this->current_season->id,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إضافة الحاج بنجاح!');
        $this->reset(
            'name',
            'pilgrim_number',
            'national_id',
            'nationality',
            'gender',
            'camp_id',
            'unit_id',
            'arrival_type',
            'agency_id',
            'phone',
            'season_id'
        );
        
    }

    public function confirm_edit( $pilgrim_id )
    {
        if( ! $this->user->can('pilgrims_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_pilgrim($pilgrim_id);

        if( $this->current_pilgrim && $this->current_pilgrim->id == $pilgrim_id ){
            return $this->dispatch('showEditPilgrimModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updatePilgrim()
    {
        if( ! $this->user->can('pilgrims_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_pilgrim_number' => ['required', 'numeric', 'digits_between:1,15'],
            'up_national_id' => ['required', 'numeric', 'digits_between:8,20'],
            'up_nationality' => ['required', 'exists:nationalities,slug'],
            'up_gender' => ['required', 'in:male,female'],
            'up_camp_id' => ['required', 'exists:camps,id'],
            'up_unit_id' => ['required', 'exists:units,id', function ($attribute, $value, $fail) {
                if (!empty($this->up_camp_id)) {
                    $unit = Unit::
                                where('id', $value)
                                ->where('camp_id', $this->up_camp_id ?? 0)
                                ->first();
                    if (!$unit) {
                        $fail('The selected :attribute is invalid.');
                        return;
                    }
                        
                    if ($unit->capacity <= $unit->pilgrims->count() && $this->current_pilgrim->unit_id != $value ) {
                        $fail('اكتمل العدد في هذه الوحدة.');
                    }
                
                }else{
                    $fail('The selected :attribute is invalid.');
                }
            }],
            'up_arrival_type' => ['required', 'in:internal,external'],
            'up_agency_id' => ['required', 'exists:agencies,id'],
            'up_phone' => ['required', 'numeric', 'digits_between:8,20']           
        ]);

        $this->current_pilgrim->update([
            'name'=> $this->up_name,
            'pilgrim_number'=> $this->up_pilgrim_number,
            'national_id'=> $this->up_national_id,
            'nationality'=> $this->up_nationality,
            'gender'=> $this->up_gender,
            'camp_id'=> $this->up_camp_id,
            'unit_id'=> $this->up_unit_id,
            'arrival_type'=> $this->up_arrival_type,
            'agency_id'=> $this->up_agency_id,
            'phone'=> $this->up_phone,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
        $this->reset(
            'up_name',
            'up_pilgrim_number',
            'up_national_id',
            'up_nationality',
            'up_gender',
            'up_camp_id',
            'up_unit_id',
            'up_arrival_type',
            'up_agency_id',
            'up_phone',
        );
    }

    public function confirm_delete( $pilgrim_id )
    {
        if( ! $this->user->can('pilgrims_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_pilgrim($pilgrim_id);

        if( $this->current_pilgrim && $this->current_pilgrim->id == $pilgrim_id ){
            return $this->dispatch('deletePilgrimConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_pilgrim->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_pilgrim()
    {
        $this->current_pilgrim->delete();
        $this->dispatch('refreshDatatable');
        $this->reset(
            'up_name',
            'up_pilgrim_number',
            'up_national_id',
            'up_nationality',
            'up_gender',
            'up_camp_id',
            'up_unit_id',
            'up_arrival_type',
            'up_agency_id',
            'up_phone',
        );        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
    }

    public function updateCamp($input)
    {
        
        $this->units = Unit::where('camp_id', $this->$input)->get();
        $this->unit_id = '0';
        
        if( $input == 'up_camp_id' ){
            $this->up_unit_id = $this->current_pilgrim->unit_id;
        }
        
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
        $this->camps = Camp::where('season_id', $this->current_season->id ?? null)->get();
        $this->updateCamp('unit_id');
        //$this->units = Unit::where('season_id', $this->current_season->id ?? null)->get();
        $this->agencys = Agency::where('season_id', $this->current_season->id ?? null)->get();
        $this->nationalities = Nationality::get();
    }

    public function render()
    {
        return view('livewire.admin.pilgrims.pilgrims-management');
    }
}
