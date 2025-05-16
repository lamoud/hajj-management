<?php

namespace App\Livewire\Admin\Employees;

use App\Models\employesJobsCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeePositionsCategories extends Component
{
    public $user;

    public $current_category;
    public $name;
    public $content;

    public $up_name;
    public $up_content;

    public function active_category(  $category_id ){

        $category = employesJobsCategory::where(['id'=> $category_id])->first();        
        if( ! $category ){
            $this->current_category = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على التصنيف!');
        }

        $this->current_category = $category;

        $this->up_name = $category->name;
        $this->up_content = $category->content;
    }

    public function confirm_edit( $category_id )
    {
        if( ! $this->user->can('employee_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_category($category_id);

        if( $this->current_category && $this->current_category->id == $category_id ){
            return $this->dispatch('showEditCategoryModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function addNewCategory()
    {
        // if( ! $this->user->can('employee_add') ){
        //     return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        // }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'content' => ['nullable'],
        ]);

        employesJobsCategory::create([
            'name'=> $this->name,
            'content'=> $this->content,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء التصنيف بنجاح!');
        $this->reset('name', 'content');
    }

    public function updateCategory()
    {
        if( ! $this->user->can('employee_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_content' => ['nullable'],
        ]);

        $this->current_category->update([
            'name'=> $this->up_name,
            'content'=> $this->up_content,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم تعديل المسمى الوظيفي بنجاح!');
        $this->reset('current_category', 'up_name', 'up_content');
    }

    public function mount()
    {
        $this->user = Auth::user();
    }


    public function render()
    {
        return view('livewire.admin.employees.employee-positions-categories');
    }
}
