<?php

namespace App\Livewire\Admin\Agency;

use App\Models\Agency;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgencyManagement extends Component
{
    public $user;

    public $name;
    public $description;

    public $selectedAgency;
    public $up_name;
    public $up_description;
    public $showEditModal = false;


    protected $listeners = ['editAgency'];

    public function addNewAgency()
    {
        
        if( ! $this->user->can('agency_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['nullable'],
        ]);

        Agency::create([
            'name'=> $this->name,
            'description'=> $this->description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الجهة بنجاح!');
        $this->reset('name', 'description');
        


    }

    public function editAgency($id)
    {

        $agency = Agency::where('id', $id)->first();

        if( ! $agency ){

            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('لم يتم العثور على الجهة، أو ربما تم حذفها.'));
        
        }

        $this->selectedAgency = $agency;
        $this->up_name = $agency['name'];
        $this->up_description = $agency['description'];

        return $this->dispatch('showEditAgencyModal');

    }

    public function updateAgency()
    {
        if( ! $this->user->can('agency_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_description' => ['nullable'],
        ]);

        $this->selectedAgency->update([
            'name'=> $this->up_name,
            'description'=> $this->up_description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التغييرات بنجاح!');
        $this->reset('up_name', 'up_description');
        
    }
    
    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.admin.agency.agency-management');
    }
}
