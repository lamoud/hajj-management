<div>
    @isset ( $viewLink )
        <a href="{{ $viewLink }}"><i class="fa fa-solid fa-eye me-2"></i></a>
    @endif
 
    @isset ( $editLink )
        <a href="javascript:void(0)" wire:click="startEdit({{ $editLink }})"
            wire:loading.attr="disabled" 
            wire:target="startEdit({{ $editLink }})">
            <i class="fa fa-solid fa-edit me-2" wire:loading.remove wire:target="startEdit({{ $editLink }})"></i>
            <i class="fa fa-spinner fa-spin" wire:loading wire:target="startEdit({{ $editLink }})"></i>
        </a>
    @endif
 
    @isset ( $deleteLink )
        <a href="javascript:void(0)" wire:click="startDelete({{ $deleteLink }})"
            wire:loading.attr="disabled" 
            wire:target="startDelete({{ $deleteLink }})">
            <i class="fa fa-solid fa-trash me-2" wire:loading.remove wire:target="startDelete({{ $deleteLink }})"></i>
            <i class="fa fa-spinner fa-spin" wire:loading wire:target="startDelete({{ $deleteLink }})"></i>
        </a>
    @endif
    
</div>