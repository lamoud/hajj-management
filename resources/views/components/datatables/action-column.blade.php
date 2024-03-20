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
        <form
            action="{{ $deleteLink }}"
            class="d-inline"
            method="POST"
            x-data
            @submit.prevent="if (confirm('Are you sure you want to delete this user?')) $el.submit()"
        >
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-link">
                <i class="fa fa-solid fa-trash"></i>
            </button>
        </form>
    @endif
    
</div>