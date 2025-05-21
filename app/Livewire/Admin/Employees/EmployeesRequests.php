<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employe;
use App\Models\EmployesJob;
use App\Models\EmploymentApplication;
use App\Models\Nationality;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeesRequests extends Component
{

    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;

    public $current_employe;

    public $user;
    public $jobs;

    public $name;
    public $age;
    public $nationality;
    public $phone;
    public $years_experience;
    public $job_id;
    public $worked_here_before;
    public $content;

    public $delete_type;
    public $nationalities = [];

    public function active_employe(  $employe_id ){

        $employe = EmploymentApplication::where(['id'=> $employe_id])->first();        
        if( ! $employe ){
            $this->current_employe = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على الموظف!');
        }

        $this->current_employe = $employe;

        $this->name = $employe->name;
        $this->age = $employe->age;
        $this->nationality = $employe->nationality;
        $this->phone = $employe->phone;
        $this->years_experience = $employe->years_experience;
        $this->job_id = $employe->job_id;
        $this->worked_here_before = $employe->worked_here_before;
        $this->content = $employe->content;
    }

    public function confirm_edit( $employe_id )
    {
        if( ! $this->user->can('employees_update') ){
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
        
        if( ! $this->user->can('employees_delete') ){
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
            'name',
            'age',
            'nationality',
            'phone',
            'years_experience',
            'job_id',
            'worked_here_before',
            'content'
        );

        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
    }

    public function updateEmployeRequest()
    {
        if( ! $this->user->can('employees_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'age' => ['required', 'integer', 'between:15,100'],
            'nationality' => ['required', 'exists:nationalities,slug'],
            'phone' => ['required', 'numeric', 'digits_between:8,20'],
            'job_id' => ['required', 'exists:employes_jobs,id'],
        ]);

        $employe = Employe::create([
            'name'=> $this->name,
            'nationality'=> $this->nationality,
            'phone'=> $this->phone,
            'phone2'=> $this->phone,
            'job_id'=> $this->job_id,
            'season_id'=> $this->current_season->id,
        ]);

        if( !$employe ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('لم نتمكن من تنفيذ طلبك، الرجاء المحاولة مرة أخرى.'));
        }

        $this->current_employe->delete();

        $this->dispatch('refreshDatatable');

        return $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم قبول الطلب والإضافة للموظفين بنجاح.');

    }

    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
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

        $this->jobs = EmployesJob::all();
        $this->nationalities = Nationality::get();

    }

    public function render()
    {
        return view('livewire.admin.employees.employees-requests');
    }
}
