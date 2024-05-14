<?php

namespace App\Livewire\Admin\Buildings;

use App\Models\Building;
use App\Models\Camp;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BuildingsManagement extends Component
{
    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;
    public $user;
    public $camps;

    public $name;
    public $camp_id;
    public $description;

    public $selectedBuilding;
    public $current_Building;
    public $up_name;
    public $up_camp_id;
    public $up_description;
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
    
    public function active_Building(  $Building_id ){

        $Building = Building::where(['id'=> $Building_id, 'type'=> 'mena'])->first();        
        if( ! $Building ){
            $this->current_Building = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على المخيم!');
        }

        $this->current_Building = $Building;
        $this->up_name = $Building->name;
        $this->up_camp_id = $Building->camp_id;
        $this->up_description = $Building->description;
    }

    public function addNewBuilding()
    {
        
        if( ! $this->user->can('building_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'camp_id' => ['required', 'exists:camps,id'],
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

        Building::create([
            'name'=> $this->name,
            'season_id'=> $this->current_season->id,
            'camp_id' => $this->camp_id
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الجهة بنجاح!');
        $this->reset('name', 'camp_id');
        
    }

    public function confirm_edit( $Building_id )
    {
        if( ! $this->user->can('building_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_Building($Building_id);

        if( $this->current_Building && $this->current_Building->id == $Building_id ){
            return $this->dispatch('showEditBuildingModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateBuilding()
    {
        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_camp_id' => ['required', 'exists:camps,id'],
        ]);


        $this->current_Building->update([
            'name'=> $this->up_name,
            'camp_id'=> $this->up_camp_id,
        ]);

        $this->dispatch('refreshDatatable');
        $this->reset('current_Building', 'up_name', 'up_description', 'up_camp_id');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
    }

    public function confirm_delete( $Building_id )
    {
        if( ! $this->user->can('Buildings_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_Building($Building_id);

        if( $this->current_Building && $this->current_Building->id == $Building_id ){
            return $this->dispatch('deleteBuildingConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_Building->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_Building()
    {
        $this->current_Building->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_Building', 'up_name', 'up_description', 'up_season_name');
        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
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
    }
    public function render()
    {
        return view('livewire.admin.buildings.buildings-management');
    }
}
