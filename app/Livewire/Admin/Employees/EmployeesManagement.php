<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Agency;
use App\Models\Camp;
use App\Models\Employe;
use App\Models\EmployesJob;
use App\Models\Nationality;
use App\Models\Season;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeesManagement extends Component
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
    public $jobs;

    public $name;
    public $employe_number;
    public $employe_declaration;
    public $national_id;
    public $nationality;
    public $gender;
    public $camp_id;
    public $unit_id;
    public $arrival_type;
    public $agency_id;
    public $phone;
    public $phone2;
    public $front_id_card;
    public $back_id_card;
    public $image;
    public $job_id;
    public $season_id;

    public $up_name;
    public $up_employe_number;
    public $up_employe_declaration;
    public $up_national_id;
    public $up_nationality;
    public $up_gender;
    public $up_camp_id;
    public $up_unit_id;
    public $up_arrival_type;
    public $up_agency_id;
    public $up_phone;
    public $up_phone2;
    public $up_front_id_card;
    public $up_back_id_card;
    public $up_image;
    public $up_job_id;

    public $current_employe;
    public $delete_type;
        
    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
    }

    public function updateCamp($input)
    {
        
        $this->units = Unit::where('camp_id', $this->$input)->get();
        $this->unit_id = null;
        
        if( $input == 'up_camp_id' ){
            $this->up_unit_id = $this->current_employe->unit_id;
        }
        
    }

    public function frontBackImageChanged($front, $back, $image)
    {
        $this->front_id_card = $front;
        $this->back_id_card = $back;
        $this->image = $image;
        $this->up_front_id_card = $front;
        $this->up_back_id_card = $back;
        $this->up_image = $image;
    }

    public function active_employe(  $employe_id ){

        $employe = Employe::where(['id'=> $employe_id])->first();        
        if( ! $employe ){
            $this->current_employe = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على الموظف!');
        }

        $this->current_employe = $employe;

        $this->up_name = $employe->name;
        $this->up_employe_number = $employe->number;
        $this->up_employe_declaration = $employe->declaration;
        $this->up_national_id = $employe->national_id;
        $this->up_nationality = $employe->nationality;
        $this->up_gender = $employe->gender;
        $this->up_camp_id = $employe->camp_id;
        $this->updateCamp('up_camp_id');
        $this->up_phone = $employe->phone;
        $this->up_phone2 = $employe->phone2;
        $this->up_front_id_card = $employe->front_id_card;
        $this->up_back_id_card = $employe->back_id_card;
        $this->up_image = $employe->image;
        $this->up_job_id = $employe->job_id;
        $this->up_unit_id = $employe->unit_id;
    }

    public function confirm_edit( $employe_id )
    {
        if( ! $this->user->can('employee_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_employe($employe_id);

        if( $this->current_employe && $this->current_employe->id == $employe_id ){
            return $this->dispatch('showEditEmployeModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }
    
    public function confirm_delete( $employe_id, $type )
    {
        
        if( ! $this->user->can('employee_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_employe($employe_id);

        if( $this->current_employe && $this->current_employe->id == $employe_id ){
            $this->delete_type = $type;
            return $this->dispatch('deleteEmployeConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_employe->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_employe()
    {
        if( $this->delete_type === 'delete' ){
            $this->current_employe->forceDelete();
        }else{
            $this->current_employe->delete();
        }
        
        $this->dispatch('refreshDatatable');

        $this->reset(
            'up_name',
            'up_employe_number',
            'up_employe_declaration',
            'up_national_id',
            'up_nationality',
            'up_gender',
            'up_camp_id',
            'up_unit_id',
            'up_arrival_type',
            'up_agency_id',
            'up_phone',
            'up_phone2',
            'up_front_id_card',
            'up_back_id_card',
            'up_image'
        );

        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
    }

    public function addNewEmploye()
    {
        
        // if( ! $this->user->can('employee_add') ){
        //     return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        // }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'employe_number' => ['nullable', 'numeric', 'digits_between:1,15'],
            'employe_declaration' => ['nullable', 'numeric', 'digits_between:1,15'],
            'national_id' => ['nullable', 'numeric', 'digits_between:10,11'],
            'nationality' => ['nullable', 'exists:nationalities,slug'],
            'gender' => ['nullable', 'in:male,female'],
            'camp_id' => ['nullable', 'exists:camps,id'],
            'unit_id' => ['nullable', 'exists:units,id', function ($attribute, $value, $fail) {
                if (!empty($this->camp_id)) {
                    $unit = Unit::
                                where('id', $value)
                                ->where('camp_id', $this->camp_id ?? 0)
                                ->first();
                    if (!$unit) {
                        $fail('The selected :attribute is invalid.');
                        return;
                    }
                        
                    if ($unit->capacity <= $unit->employees->count()) {
                        $fail('اكتمل العدد في هذه الوحدة.');
                    }
                
                }else{
                    $fail('The selected :attribute is invalid.');
                }
            }],
            'arrival_type' => ['nullable', 'in:internal,external'],
            'agency_id' => ['nullable', 'exists:agencies,id'],
            'phone' => ['nullable', 'numeric', 'digits_between:8,20'],
            'phone2' => ['nullable', 'numeric', 'digits_between:8,20'],
            'season_name' => ['nullable', function ($attribute, $value, $fail) {
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
        
        Employe::create([
            'name'=> $this->name,
            'number'=> $this->employe_number,
            'declaration'=> $this->employe_declaration,
            'national_id'=> $this->national_id,
            'nationality'=> $this->nationality,
            'gender'=> $this->gender,
            'camp_id'=> $this->camp_id,
            'unit_id'=> $this->unit_id,
            'arrival_type'=> $this->arrival_type,
            'agency_id'=> $this->agency_id,
            'phone'=> $this->phone,
            'phone2'=> $this->phone,
            'front_id_card'=> $this->front_id_card,
            'back_id_card'=> $this->back_id_card,
            'image'=> $this->image,
            'job_id'=> $this->job_id,
            'season_id'=> $this->current_season->id,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إضافة الحاج بنجاح!');
        $this->reset(
            'name',
            'employe_number',
            'employe_declaration',
            'national_id',
            'nationality',
            'gender',
            'camp_id',
            'unit_id',
            'arrival_type',
            'agency_id',
            'phone',
            'phone2',
            'front_id_card',
            'back_id_card',
            'image',
            'season_id'
        );
        
    }

    public function updateEmploye()
    {
        
        if( ! $this->user->can('employee_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_employe_number' => ['nullable', 'numeric', 'digits_between:1,15'],
            'up_employe_declaration' => ['nullable', 'numeric', 'digits_between:1,15'],
            'up_national_id' => ['nullable', 'numeric', 'digits_between:10,11'],
            'up_nationality' => ['nullable', 'exists:nationalities,slug'],
            'up_gender' => ['nullable', 'in:male,female'],
            'up_camp_id' => ['nullable', 'exists:camps,id'],
            'up_unit_id' => ['nullable', 'exists:units,id', function ($attribute, $value, $fail) {
                if (!empty($this->up_camp_id)) {
                    $unit = Unit::
                                where('id', $value)
                                ->where('camp_id', $this->up_camp_id ?? 0)
                                ->first();
                    if (!$unit) {
                        $fail('The selected :attribute is invalid.');
                        return;
                    }
                        
                    if ($unit->capacity <= $unit->employees->count()) {
                        $fail('اكتمل العدد في هذه الوحدة.');
                    }
                
                }else{
                    $fail('The selected :attribute is invalid.');
                }
            }],
            'up_arrival_type' => ['nullable', 'in:internal,external'],
            'up_agency_id' => ['nullable', 'exists:agencies,id'],
            'up_phone' => ['nullable', 'numeric', 'digits_between:8,20'],
            'up_phone2' => ['nullable', 'numeric', 'digits_between:8,20'],           
        ]);
        
        $this->current_employe->update([
            'name'=> $this->up_name,
            'number'=> $this->up_employe_number,
            'declaration'=> $this->up_employe_declaration,
            'national_id'=> $this->up_national_id,
            'nationality'=> $this->up_nationality,
            'gender'=> $this->up_gender,
            'camp_id'=> $this->up_camp_id,
            'unit_id'=> $this->up_unit_id,
            'arrival_type'=> $this->up_arrival_type,
            'agency_id'=> $this->up_agency_id,
            'phone'=> $this->up_phone,
            'phone2'=> $this->up_phone,
            'front_id_card'=> $this->up_front_id_card,
            'back_id_card'=> $this->up_back_id_card,
            'image'=> $this->up_image,
            'job_id'=> $this->up_job_id,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حغظ التغييرات بنجاح!');
        $this->reset(
            'up_name',
            'up_employe_number',
            'up_employe_declaration',
            'up_national_id',
            'up_nationality',
            'up_gender',
            'up_camp_id',
            'up_unit_id',
            'up_arrival_type',
            'up_agency_id',
            'up_phone',
            'up_phone2',
            'up_front_id_card',
            'up_back_id_card',
            'up_image'
        );
        
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
        $this->jobs = EmployesJob::all();
        $this->nationalities = Nationality::get();
    }

    public function render()
    {
        return view('livewire.admin.employees.employees-management');
    }
}
