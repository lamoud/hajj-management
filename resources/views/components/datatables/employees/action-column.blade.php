<div>
    @isset ( $editLink )
        <a href="javascript:void(0)" wire:click="startEdit({{ $editLink }})"
            wire:loading.attr="disabled" 
            wire:target="startEdit({{ $editLink }})"
            title="تعديل & تسكين">
            <i class="fa fa-solid fa-edit me-2" wire:loading.remove wire:target="startEdit({{ $editLink }})"></i>
            <i class="fa fa-spinner fa-spin" wire:loading wire:target="startEdit({{ $editLink }})"></i>
        </a>
    @endif
 
    @isset ( $deleteLink )
        <a href="javascript:void(0)" wire:click="startDelete({{ $deleteLink }}, 'arch')"
            wire:loading.attr="disabled" 
            wire:target="startDelete({{ $deleteLink }}, 'arch')"
            title="أرشفة بيانات الموظف">
            <i class="fa-solid fa fa-file-archive-o	 me-2" wire:loading.remove wire:target="startDelete({{ $deleteLink }}, 'arch')"></i>
            <i class="fa fa-spinner fa-spin" wire:loading wire:target="startDelete({{ $deleteLink }}, 'arch')"></i>
        </a>
        <a href="javascript:void(0)" wire:click="startDelete({{ $deleteLink }})"
            wire:loading.attr="disabled" 
            wire:target="startDelete({{ $deleteLink }})"
            title="حذف بشكل نهائي">
            <i class="fa fa-solid fa-trash me-2" wire:loading.remove wire:target="startDelete({{ $deleteLink }})"></i>
            <i class="fa fa-spinner fa-spin" wire:loading wire:target="startDelete({{ $deleteLink }})"></i>
        </a>
    @endif
    
</div>