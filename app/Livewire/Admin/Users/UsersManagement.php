<?php

namespace App\Livewire\Admin\Users;

use App\Models\Season;
use App\Models\User;
use App\Models\UserSeason;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsersManagement extends Component
{
    public $current_season;
    public $season_name = 'غير معروف';
    public $user;

    public $name;
    public $email;
    public $gender;
    public $password;
    public $password_confirmation;
    public $role;
    public $bio;

    public $selectedUser;
    public $current_user;
    public $up_name;
    public $up_email;
    public $up_gender;
    public $up_password;
    public $up_password_confirmation;
    public $up_role;
    public $up_bio;
    public $showEditModal = false;
    
    public $per_name = [];
    public $main = ['super_admin', 'admin', 'editor', 'author', 'user'];

    public function active_season(  $season_id,  $season_slug ){

        $season = Season::where(['id'=> $season_id, 'slug'=> $season_slug])->first();        
        if( ! $season ){
            $this->current_season = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على موسم الحج!');
        }

        $this->current_season = $season;
        $this->season_name = $season->name ?? 'غير معروف';
        
    }

    public function active_user(  $user_id ){

        $user = User::where(['id'=> $user_id])->first();        
        if( ! $user ){
            $this->current_user = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على الوظيفة!');
        }

        $this->current_user = $user;
        $role = $this->current_user->roles->pluck('name')->toArray();

        $this->up_name = $user->name;
        $this->up_email = $user->email;
        $this->up_role = $role[0] ?? 'user';
        
    }

    public function addNewUser()
    {
        
        if( ! $this->user->can('users_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
            'password_confirmation' => ['required', 'string'],
            'role' => ['required', 'string', 'exists:roles,name'],
            'bio' => ['sometimes', 'nullable', 'max:1000'],    
        ]);

        $newUser =  User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'bio'  => $this->bio
        ]);

        $newUser->assignRole($this->role);

        UserSeason::create([
            'user_id' => $newUser->id,
            'season_id' => $this->current_season->id
        ]);

        event(new Registered($newUser));

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الوظيفة بنجاح!');
        $this->reset('name', 'email', 'password', 'password_confirmation','role','bio');
        
    }

    public function confirm_edit( $user_id )
    {
        if( ! $this->user->can('users_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_user($user_id);

        if( $this->current_user && $this->current_user->id == $user_id ){
            return $this->dispatch('showEditUserModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateUser()
    {
        if( ! $this->user->can('users_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }
        
        if( in_array($this->current_user->name, $this->main) ){
            return  $this->dispatch('UserAction', type: 'error', title: __('Error'), msg: 'لا يمكن تعديل الصلاحيات الأساسية في النظام!');
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:50'],
            'up_email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->current_user->id),
            ],            
            'up_password' => ['sometimes', 'nullable', 'min:6'],
            'up_role' => ['required', 'string', 'exists:roles,name'],
            'up_bio' => ['sometimes', 'nullable', 'max:1000'],    
        ]);

        $this->current_user->update([
            'name' => $this->up_name,
            'email' => $this->up_email,
            'password' => $this->up_password ? Hash::make($this->up_password) : $this->current_user->password,
            'bio'  => $this->up_bio
        ]);

        foreach ($this->current_user->roles as $role) {
            $this->current_user->removeRole($role->name);
        }

        $this->current_user->assignRole($this->up_role);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الوظيفة بنجاح!');
        $this->reset('up_name', 'up_email', 'up_password', 'up_password_confirmation','up_role','up_bio');
    }

    public function confirm_delete( $user_id )
    {
        if( ! $this->user->can('users_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_user($user_id);

        if( $this->current_user && $this->current_user->id == $user_id ){
            return $this->dispatch('deleteUserConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_user->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_user()
    {
        $this->current_user->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_user', 'up_name');
        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
    }

    public function mount()
    {
        $this->user = Auth::user();

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
        return view('livewire.admin.users.users-management', [
            'roles'=> Role::orderBy('created_at', 'DESC')->whereNotIn('name', ['super_admin'])->get()
        ]);
    }
}
