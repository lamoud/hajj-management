<?php

namespace App\Livewire\Admin\Employees;

use App\Models\EmployesJob;
use App\Models\employesJobsCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeePositions extends Component
{
    public $categories;

    public $user;

    public $current_position;
    public $name;
    public $category_id;
    public $content;

    public $up_name;
    public $up_category_id;
    public $up_content;

    public function active_position(  $position_id ){

        $position = EmployesJob::where(['id'=> $position_id])->first();        
        if( ! $position ){
            $this->current_position = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على الوظيفة!');
        }

        $this->current_position = $position;

        $this->up_name = $position->name;
        $this->up_category_id = $position->category_id;
        $this->up_content = $position->content;
    }

    public function confirm_edit( $position_id )
    {
        if( ! $this->user->can('employee_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_position($position_id);

        if( $this->current_position && $this->current_position->id == $position_id ){
            return $this->dispatch('showEditPositionModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function addNewPosition()
    {
        // if( ! $this->user->can('employee_add') ){
        //     return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        // }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'category_id' => ['nullable', 'exists:employes_jobs_categories,id'],
            'content' => ['nullable'],
        ]);

        EmployesJob::create([
            'name'=> $this->name,
            'category_id'=> $this->category_id,
            'content'=> $this->content,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء المسمى الوظيفي بنجاح!');
        $this->reset('name', 'category_id', 'content');
    }

    public function updatePosition()
    {
        if( ! $this->user->can('employee_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_category_id' => ['nullable', 'exists:employes_jobs_categories,id'],
            'up_content' => ['nullable'],
        ]);

        $this->current_position->update([
            'name'=> $this->up_name,
            'category_id'=> $this->up_category_id,
            'content'=> $this->up_content,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم تعديل المسمى الوظيفي بنجاح!');
        $this->reset('current_position', 'up_name', 'up_category_id', 'up_content');
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->categories = employesJobsCategory::all();
    }

    public function render()
    {
        return view('livewire.admin.employees.employee-positions');
    }
}
