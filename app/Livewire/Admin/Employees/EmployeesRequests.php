<?php

namespace App\Livewire\Admin\Employees;

use App\Models\EmploymentApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeesRequests extends Component
{
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
        // if( ! $this->user->can('employee_update') ){
        //     return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        // }

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

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.admin.employees.employees-requests');
    }
}
