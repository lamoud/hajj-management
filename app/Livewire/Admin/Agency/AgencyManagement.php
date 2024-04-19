<?php

namespace App\Livewire\Admin\Agency;

use App\Models\Agency;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgencyManagement extends Component
{
    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;
    public $user;

    public $name;
    public $size;
    public $description;

    public $selectedAgency;
    public $up_name;
    public $up_size;
    public $up_season_name;
    public $up_description;
    public $showEditModal = false;


    protected $listeners = ['editAgency'];

    
    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
    }

    public function addNewAgency()
    {
        
        if( ! $this->user->can('agency_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
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
            'description' => ['nullable'],
        ]);

        Agency::create([
            'name'=> $this->name,
            'season_id'=> $this->current_season->id,
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
        $this->up_season_name = $agency->season->name ?? 'غير معروف';
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

        // $dd_d = Agency::first();

        // dd($dd_d->alam_alheg->name);
    }

    public function render()
    {
        return view('livewire.admin.agency.agency-management');
    }
}
