<?php

namespace App\Livewire\Admin\Season;

use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SeasonManagement extends Component
{
    public $user;

    public $current_season;
    public $name;
    public $start_date;
    public $end_date;
    public $description;
    public $up_name;
    public $up_start_date;
    public $up_end_date;
    public $up_description;

    public function addNewseason()
    {
        
        if( ! $this->user->can('season_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:today', 'after:start_date'],
            'description' => ['nullable'],
        ]);

        //dd([$this->start_date, $this->end_date]);

        $check = Season::where('end_date', '>=', $this->start_date)->exists();
        if( $check ){
            return $this->dispatch('makeAction', type: 'error', title: __('Ok'), msg: 'لا يمكن أن يبدأ موسم قبل انتهاء موسم آخر!');
        }
        Season::create([
            'name'=> $this->name,
            'start_date'=> $this->start_date,
            'end_date'=> $this->end_date,
            'description'=> $this->description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء موسم الحج بنجاح!');
        $this->reset('name', 'start_date', 'end_date', 'description');
        
    }

    public function active_season(  $season_id ){

        $season = Season::where(['id'=> $season_id])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج هذا!');
        }

        $this->current_season = $season;   
        $this->up_name = $season->name;
        $this->up_start_date = $season->start_date;
        $this->up_end_date = $season->end_date;
        $this->up_description = $season->description;     
    }

    public function confirm_edit( $season_id )
    {
        if( ! $this->user->can('season_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_season($season_id);

        if( $this->current_season && $this->current_season->id == $season_id ){
            return $this->dispatch('showEditSeasonModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateSeason()
    {
        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],
            'up_description' => ['nullable'],
        ]);


        $this->current_season->update([
            'name'=> $this->up_name,
            'description'=> $this->up_description,
        ]);

        $this->dispatch('refreshDatatable');
        $this->reset('current_season', 'up_name', 'up_start_date', 'up_end_date', 'up_description');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
    }

    public function confirm_delete( $season_id )
    {
        if( ! $this->user->can('season_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_season($season_id);

        if( $this->current_season && $this->current_season->id == $season_id ){
            return $this->dispatch('deleteSeasonConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_season->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_season()
    {
        $this->current_season->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_season', 'up_name', 'up_start_date', 'up_end_date', 'up_description');
        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف موسم الحج بنجاح!');
    }


    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.admin.season.season-management');
    }
}
