<?php

namespace App\Livewire\Admin\Roles;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesManagement extends Component
{
    public $user;

    public $name;
    public $en_name;
    public $uuid;
    public $content;

    public $selectedRole;
    public $current_role;
    public $up_name;
    public $up_en_name;
    public $up_uuid;
    public $up_content;
    public $showEditModal = false;
    
    public $per_name = [];
    public $main = ['super_admin', 'admin', 'editor', 'author', 'user'];

    public function active_role(  $role_id ){

        $role = Role::where(['id'=> $role_id])->first();        
        if( ! $role ){
            $this->current_role = null;
            return  $this->dispatch('makeAction', type: 'error', title: __('Error'), msg: 'لم يتم العثور على الوظيفة!');
        }

        $this->current_role = $role;
        $this->per_name = $role->permissions->pluck('name');

        $this->up_name = $role->display_name;
        $this->up_en_name = $role->display_name_en;
        $this->up_uuid = $role->name;
        $this->up_content = $role->content;
        
    }

    public function addNewRole()
    {
        
        if( ! $this->user->can('roles_add') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],        
            'en_name' => ['required', 'string', 'min:3', 'max:100'],       
            'uuid' => ['required', 'string', 'min:3', 'max:100', 'unique:roles,name'],        
            'content' => ['nullable', 'string', 'max:5000'],        
        ]);

        $role = Role::create([
            'display_name'=> $this->name,
            'display_name_en'=> $this->en_name,
            'name'=> $this->uuid,
            'content'=> $this->content,
            'guard_name'=>'web'
        ]);

        $role->syncPermissions($this->per_name);

        $this->dispatch('refreshDatatable');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم إنشاء الوظيفة بنجاح!');
        $this->reset('name', 'en_name', 'uuid', 'content');
        
    }

    public function confirm_edit( $role_id )
    {
        if( ! $this->user->can('roles_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_role($role_id);

        if( $this->current_role && $this->current_role->id == $role_id ){
            return $this->dispatch('showEditRoleModal');
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function updateRole()
    {
        if( ! $this->user->can('roles_update') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }
        
        if( in_array($this->current_role->name, $this->main) ){
            return  $this->dispatch('RoleAction', type: 'error', title: __('Error'), msg: 'لا يمكن تعديل الصلاحيات الأساسية في النظام!');
        }

        $this->validate([
            'up_name' => ['required', 'string', 'min:3', 'max:100'],        
            'up_en_name' => ['required', 'string', 'min:3', 'max:100'],       
            'up_content' => ['nullable', 'string', 'max:5000'],        
        ]);

        $this->current_role->update([
            'display_name'=> $this->up_name,
            'display_name_en'=> $this->up_en_name,
            'content'=> $this->up_content,
        ]);

        $this->current_role->syncPermissions($this->per_name);

        $this->dispatch('refreshDatatable');
        $this->reset('name', 'en_name', 'uuid', 'content');
        $this->dispatch('makeAction', type: 'success', title: __('Ok'), msg: 'تم حفظ التعديلات بنجاح!');
    }

    public function confirm_delete( $role_id )
    {
        if( ! $this->user->can('roles_delete') ){
            return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: __('Sorry! You are not authorized to perform this action.'));
        }

        $this->active_role($role_id);

        if( $this->current_role && $this->current_role->id == $role_id ){
            return $this->dispatch('deleteRoleConfirm', type: 'question', msg: 'هل أنت متأكد من رغبتك في حذف: '.$this->current_role->name);
        }

        return $this->dispatch('makeAction', type: 'error', title: __('Oops'), msg: 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل.');
    }

    public function delete_current_role()
    {
        $this->current_role->delete();
        $this->dispatch('refreshDatatable');
        $this->reset('current_role', 'up_name');
        return  $this->dispatch('makeAction', type: 'success', title: __('Success'), msg: 'تم حذف المخيم بنجاح!');
    }

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.admin.roles.roles-management',
            [
                'permission'=> Permission::orderBy('name', 'DESC')->get(),
            ]
        );
    }
}
