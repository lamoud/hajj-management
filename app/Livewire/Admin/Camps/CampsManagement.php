<?php

namespace App\Livewire\Admin\Camps;

use App\Models\Camp;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CampsManagement extends Component
{

    public $seasons;
    public $season_name = 'غير معروف';
    public $status;
    public $current_season;
    public $user;

    public $name;
    public $description;

    public $selectedCamp;
    public $current_camp;
    public $up_name;
    public $up_season_name;
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
        
    public function active_camp(  $camp_id ){

        $camp = Camp::where(['id'=> $camp_id])->first();        
        if( ! $camp ){
            $this->current_camp = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على المخيم!');
        }

        $this->current_camp = $camp;
        $this->up_name = $camp->name;
        $this->up_description = $camp->description;
        $this->up_season_name = $camp->season->name ?? 'غير معروف';
        
    }

    public function addNewCamp()
    {
        
        if( ! $this->user->can('camps_add') ){
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

        Camp::create([
            'name'=> $this->name,
            'season_id'=> $this->current_season->id,
            'description'=> $this->description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الجهة بنجاح!');
        $this->reset('name', 'description');
        
    }

    // public function editCamp($id)
    // {

    //     $camp = Camp::where('id', $id)->first();

    //     if( ! $camp ){

    //         return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('لم يتم العثور على الجهة، أو ربما تم حذفها.'));
        
    //     }

    //     $this->selectedCamp = $camp;
    //     $this->up_name = $camp['name'];
    //     $this->up_season_name = $camp->season->name ?? 'غير معروف';
    //     $this->up_description = $camp['description'];

    //     return $this->dispatch('showEditCampModal');

    // }

    // public function updateCamp()
    // {
    //     if( ! $this->user->can('camp_update') ){
    //         return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
    //     }

    //     $this->validate([
    //         'up_name' => ['required', 'string', 'min:3', 'max:100'],
    //         'up_description' => ['nullable'],
    //     ]);

    //     $this->selectedCamp->update([
    //         'name'=> $this->up_name,
    //         'description'=> $this->up_description,
    //     ]);

    //     $this->dispatch('refreshDatatable');
    //     $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التغييرات بنجاح!');
    //     $this->reset('up_name', 'up_description');
        
    // }

    public function confirm_edit( $camp_id )
    {
        if( ! $this->user->can('camps_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_camp($camp_id);

        if( $this->current_camp && $this->current_camp->id == $camp_id ){
            return $this->dispatch('showEditCampModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateCamp()
    {
        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_description' => ['nullable'],
        ]);


        $this->current_camp->update([
            'name'=> $this->up_name,
            'description'=> $this->up_description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->reset('current_camp', 'up_name', 'up_description', 'up_season_name');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
    }

    public function confirm_delete( $camp_id )
    {
        if( ! $this->user->can('camps_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_camp($camp_id);

        if( $this->current_camp && $this->current_camp->id == $camp_id ){
            return $this->dispatch('deleteCampConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_camp->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_camp()
    {
        $this->current_camp->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_camp', 'up_name', 'up_description', 'up_season_name');
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
    }

    public function render()
    {
        return view('livewire.admin.camps.camps-management');
    }
}
