<?php

namespace App\Livewire\Admin\Units;

use App\Models\UnitType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UnitsManagementType extends Component
{
    public $user;

    public $name;
    public $description;

    public $selectedUnit;
    public $current_unit;
    public $up_name;
    public $up_description;
    public $showEditModal = false;
    
    public function active_unitType(  $unitType_id ){

        $unit = UnitType::where(['id'=> $unitType_id])->first();        
        if( ! $unit ){
            $this->current_unit = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على نوع الخيمة!');
        }

        $this->current_unit = $unit;

        $this->up_name = $unit->name;
        $this->up_description = $unit->description;
        
    }

    public function addNewUnitType()
    {
        
        if( ! $this->user->can('units_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }


        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', Rule::unique('unit_types', 'name')],            
        ]);

        UnitType::create([
            'name'=> $this->name,
            'description'=> $this->description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء نوع الخيمة بنجاح!');
        $this->reset('name', 'description');
        
    }

    public function confirm_edit( $unitType_id )
    {
        if( ! $this->user->can('units_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_unitType($unitType_id);

        if( $this->current_unit && $this->current_unit->id == $unitType_id ){
            return $this->dispatch('showEditUnitTypeModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateUnitType()
    {
        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
        ]);


        $this->current_unit->update([
            'name'=> $this->up_name,
            'description'=> $this->up_description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->reset('up_name', 'up_description');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
    }

    public function confirm_delete( $unitType_id )
    {
        if( ! $this->user->can('units_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_unitType($unitType_id);

        if( $this->current_unit && $this->current_unit->id == $unitType_id ){
            return $this->dispatch('deleteUnitTypeConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_unit->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_unit()
    {
        $this->current_unit->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_unit', 'up_name', 'up_description');
        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف نوع الخيمة بنجاح!');
    }

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.admin.units.units-management-type');
    }
}
