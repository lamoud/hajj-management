<div>
    <style>
        .lm-td {
            vertical-align: top !important
        }
        .input-group-append span {
            width: 116px;
        }
        .list-group-item.active {
            background: unset;
            color: #007bff;
            border-color: #007bff;
        }
    </style>

    <div class="my-5 p-2 bg-white">
        <livewire:admin.roles.roles-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-role" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new role') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewRole">
                    <div class="modal-body">

                        <!-- Role name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Role name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Role name') }}" aria-label="{{ __('Role name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <!-- Role en_name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="en_name">{{ __('English name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('English name') }}" aria-label="{{ __('English name') }}" aria-describedby="en_name" wire:model.defer="en_name">
                                
                            </div>
                            @if($errors->has('en_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('en_name') }}</small>
                            @endif
                        </div>
                        <!-- Role uuid -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="uuid">{{ __('UUID') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('UUID') }}" aria-label="{{ __('UUID') }}" aria-describedby="uuid" wire:model.defer="uuid">
                                
                            </div>
                            @if($errors->has('uuid'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('uuid') }}</small>
                            @endif
                        </div>

                        <!-- Role description -->
                        <div class="form-group">
                            <label for="description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="content" rows="3" wire:model.defer="content"></textarea>
                        </div>
                        <!-- Role permission -->
                        <div class="my-2">
                            @forelse ($permission as $per)
                                <div class="list-group-item {{ $current_role && $current_role->hasPermissionTo($per->name) ? 'active' : '' }}">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <input type="checkbox" class="form-check-input" wire:model="per_name" value="{{ $per->name }}">
                                        </div>
                                        <div class="col text-truncate">
                                            <b class="text-reset d-block">{{ $per->display_name }}</b>
                                            <div class="d-block text-secondary text-truncate mt-n1">{{ $per->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                
                            @endforelse
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
        </div>
        </div>
    </div>

    <!-- Modal for Edit Role -->
    <div class="modal modal-blur fade" id="modal-editrole" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new role') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updateRole">
                    <div class="modal-body">
                        <!-- Role name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Role name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Role name') }}" aria-label="{{ __('Role name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>
                        <!-- Role en_name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_en_name">{{ __('English name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('English name') }}" aria-label="{{ __('English name') }}" aria-describedby="up_en_name" wire:model.defer="up_en_name">
                                
                            </div>
                            @if($errors->has('up_en_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_en_name') }}</small>
                            @endif
                        </div>
                        <!-- Role uuid -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_uuid">{{ __('UUID') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('up_UUID') }}" aria-label="{{ __('UUID') }}" aria-describedby="up_uuid" wire:model.defer="up_uuid">
                                
                            </div>
                            @if($errors->has('up_uuid'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_uuid') }}</small>
                            @endif
                        </div>

                        <!-- Role description -->
                        <div class="form-group">
                            <label for="up_description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="up_content" rows="3" wire:model.defer="up_content"></textarea>
                        </div>

                            <!-- Role permission -->
                            <div class="my-2">
                                @forelse ($permission as $per)
                                    <div class="list-group-item {{ $current_role && $current_role->hasPermissionTo($per->name) ? 'active' : '' }}">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <input type="checkbox" class="form-check-input" wire:model="per_name" value="{{ $per->name }}" {{ $current_role && $current_role->hasPermissionTo($per->name) ? 'checked' : '' }} {{ $current_role && in_array($current_role->name, $main) ? 'disabled' : '' }}>
                                            </div>
                                            <div class="col text-truncate">
                                                <b class="text-reset d-block">{{ $per->display_name }}</b>
                                                <div class="d-block text-secondary text-truncate mt-n1">{{ $per->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    
                                @endforelse
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
        </div>
        </div>
    </div>

    <script>
        window.addEventListener('makeAction', event => {

            window["iziToast"][event.detail.type]({
                    title: `${event.detail.title}`,
                    message: `${event.detail.msg}`,
                    position: 'topLeft',
                    rtl: true,
                });

                $('#modal-role').modal('hide');
                $('#modal-editrole').modal('hide');
        })

        window.addEventListener('editRole', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditRoleModal', event => {

            $('#modal-editrole').modal('show');

        })

        window.addEventListener('deleteRole', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteRoleConfirm', event => {

            window["iziToast"][event.detail.type]({
                    // title: `${event.detail.title}`,
                    message: `${event.detail.msg}`,
                    rtl: true,
                    timeout: 20000,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999999999,
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', function (instance, toast) {

                            @this.delete_current_role()
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            
                        }, true],
                        ['<button>NO</button>', function (instance, toast) {
                
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                
                        }],
                    ]
            });

        })

    </script>
</div>
