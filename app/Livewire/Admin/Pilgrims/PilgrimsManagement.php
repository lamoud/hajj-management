<?php

namespace App\Livewire\Admin\Pilgrims;

use App\Exports\PilgrimsExport;
use App\Imports\PilgrimsImport;
use App\Models\Agency;
use App\Models\Camp;
use App\Models\Nationality;
use App\Models\Pilgrim;
use App\Models\Season;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class PilgrimsManagement extends Component
{
    use WithFileUploads;

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
    public $pilgrim_declaration;
    public $national_id;
    public $nationality;
    public $gender;
    public $camp_id;
    public $unit_id;
    public $arrival_type;
    public $agency_id;
    public $phone;
    public $phone2;
    public $season_id;

    public $up_name;
    public $up_pilgrim_number;
    public $up_pilgrim_declaration;
    public $up_national_id;
    public $up_nationality;
    public $up_gender;
    public $up_camp_id;
    public $up_unit_id;
    public $up_arrival_type;
    public $up_agency_id;
    public $up_phone;
    public $up_phone2;
    
    public $up_swap_name;
    public $up_swap_number;
    public $up_swap_national_id;
    public $up_swap_camp_id;
    public $up_swap_unit_id;


    public $selectedPilgrim;
    public $current_pilgrim;
    public $showEditModal = false;

    public $import_file;
    public $swap_search;
    public $swap_with = [];
    public $swaps = [];
    public $current_swaps;
    
    
    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
    }

    public function swapSearchChanged()
    {
        $this->validate([
            'swap_search' => 'required|string|max:255', // التأكد من صحة الإدخال
        ]);
    
        $this->swaps = Pilgrim::where('season_id', $this->current_season->id)
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->swap_search . '%')
                    ->orWhere('number', 'like', '%' . $this->swap_search . '%')
                    ->orWhere('national_id', 'like', '%' . $this->swap_search . '%');
            })
            ->take(5)
        ->get();
    }

    public function swapWithChanged()
    {
        $this->current_swaps = Pilgrim::where(['id'=> $this->swap_with, 'season_id'=> $this->current_season->id])->first();
        
        if( ! $this->current_swaps ){
            $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على حجاج');
        }

        //$this->units = Unit::where('camp_id', $this->current_swaps->camp_id)->get();
        $this->up_swap_name = $this->current_swaps->name;
        $this->up_swap_number = $this->current_swaps->number;
        $this->up_swap_national_id = $this->current_swaps->national_id;
        $this->up_swap_camp_id = $this->current_swaps->camp_id ??  '';
        $this->up_swap_unit_id = $this->current_swaps->unit->name ?? '';

    }
    
    public function active_pilgrim(  $pilgrim_id ){

        $pilgrim = Pilgrim::where(['id'=> $pilgrim_id])->first();        
        if( ! $pilgrim ){
            $this->current_pilgrim = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على المخيم!');
        }

        $this->current_pilgrim = $pilgrim;

        $this->up_name = $pilgrim->name;
        $this->up_pilgrim_number = $pilgrim->number;
        $this->up_pilgrim_declaration = $pilgrim->declaration;
        $this->up_national_id = $pilgrim->national_id;
        $this->up_nationality = $pilgrim->nationality;
        $this->up_gender = $pilgrim->gender;
        $this->up_camp_id = $pilgrim->camp_id;
        $this->updateCamp('up_camp_id');
        $this->up_arrival_type = $pilgrim->arrival_type;
        $this->up_agency_id = $pilgrim->agency_id;
        $this->up_phone = $pilgrim->phone;
        $this->up_phone2 = $pilgrim->phone2;
        $this->up_unit_id = $pilgrim->unit_id;
        
        
    }

    public function importFile()
    {
        if (!$this->user->can('pilgrims_add')) {
            return $this->dispatch('makeAction', ['type' => 'error', 'title' => __('Oops'), 'msg' => __('Sorry! You are not authorized to perform this action.')]);
        }

        $this->validate([
            'import_file' => 'required|mimes:xlsx,csv,txt', // يمكنك تعديل أنواع الملفات المقبولة حسب احتياجاتك
        ]);

        $file = $this->import_file->storeAs('temp', 'pilgrims.xlsx');

        Excel::import(new PilgrimsImport, $file);
        \Storage::delete($file);
        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إستراد الحجاج من الملف بنجاح بنجاح!');
    }

    public function exportAll()
    {
        try {
            return Excel::download(new PilgrimsExport(), 'pilgrims.xlsx');
    
        } catch (\Exception $e) {
            // Handle any exceptions and return with an error message
            return $this->dispatch('makeAction', ['type' => 'error', 'title' => __('Oops'), 'msg' => 'عفواً، لم نتمكن من تصدير الحجاج برجاء المحاولة بعد قليل']);;
        }
    }

    public function addNewPilgrim()
    {
        
        if( ! $this->user->can('pilgrims_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'pilgrim_number' => ['nullable', 'numeric', 'digits_between:1,15'],
            'pilgrim_declaration' => ['nullable', 'numeric', 'digits_between:1,15'],
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
                        
                    if ($unit->capacity <= $unit->pilgrims->count()) {
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

        Pilgrim::create([
            'name'=> $this->name,
            'number'=> $this->pilgrim_number,
            'declaration'=> $this->pilgrim_declaration,
            'national_id'=> $this->national_id,
            'nationality'=> $this->nationality,
            'gender'=> $this->gender,
            'camp_id'=> $this->camp_id,
            'unit_id'=> $this->unit_id,
            'arrival_type'=> $this->arrival_type,
            'agency_id'=> $this->agency_id,
            'phone'=> $this->phone,
            'phone2'=> $this->phone,
            'season_id'=> $this->current_season->id,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إضافة الحاج بنجاح!');
        $this->reset(
            'name',
            'pilgrim_number',
            'pilgrim_declaration',
            'national_id',
            'nationality',
            'gender',
            'camp_id',
            'unit_id',
            'arrival_type',
            'agency_id',
            'phone',
            'phone2',
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
            'up_pilgrim_number' => ['nullable', 'numeric', 'digits_between:1,15'],
            'up_pilgrim_declaration' => ['nullable', 'numeric', 'digits_between:1,15'],
            'up_national_id' => ['nullable', 'numeric', 'digits_between:8,20'],
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
                        
                    if ($unit->capacity <= $unit->pilgrims->count() && $this->current_pilgrim->unit_id != $value ) {
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

        $this->current_pilgrim->update([
            'name'=> $this->up_name,
            'number'=> $this->up_pilgrim_number,
            'declaration'=> $this->up_pilgrim_declaration,
            'national_id'=> $this->up_national_id,
            'nationality'=> $this->up_nationality,
            'gender'=> $this->up_gender,
            'camp_id'=> $this->up_camp_id,
            'unit_id'=> $this->up_unit_id,
            'arrival_type'=> $this->up_arrival_type,
            'agency_id'=> $this->up_agency_id,
            'phone'=> $this->up_phone,
            'phone2'=> $this->up_phone2,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
        $this->reset(
            'up_name',
            'up_pilgrim_number',
            'up_pilgrim_declaration',
            'up_national_id',
            'up_nationality',
            'up_gender',
            'up_camp_id',
            'up_unit_id',
            'up_arrival_type',
            'up_agency_id',
            'up_phone',
            'up_phone2',
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

    public function confirm_swap( $pilgrim_id )
    {
        if( ! $this->user->can('pilgrims_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_pilgrim($pilgrim_id);

        if( $this->current_pilgrim && $this->current_pilgrim->id == $pilgrim_id ){
            return $this->dispatch('swapPilgrimConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_pilgrim->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function swap_current_pilgrim()
    {
        //$this->current_pilgrim->delete();

        if( $this->current_pilgrim->camp_id && $this->current_pilgrim->camp_id === $this->current_swaps->camp_id ){

            if ( $this->current_pilgrim->unit_id && $this->current_swaps->unit_id ) {
                
                $this->current_pilgrim->update([

                    'unit_id' => $this->current_swaps->unit_id

                ]);

                $this->current_swaps->update([

                    'unit_id' => $this->up_unit_id

                ]);

            }else{
                return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'يجب أن يكون كلا الحاجين ينتمون إلى خيمة (وحدة).');
            }

        }else{
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'يجب أن يكون كلا الحاجين في نفس المخيم.');
        }

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
        );

        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم التبديل بنجاح!');
    }

    public function updateCamp($input)
    {
        
        $this->units = Unit::where('camp_id', $this->$input)->get();
        $this->unit_id = null;
        
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
