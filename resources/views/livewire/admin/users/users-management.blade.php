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
        <livewire:admin.users.users-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-user" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" user="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new user') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewUser">
                    <div class="modal-body">

                        <!-- User name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" aria-label="{{ __('Name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <!-- User email -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="email">{{ __('Email') }}</span>
                                </div>
                                <input type="email" class="form-control" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}" aria-describedby="email" wire:model.defer="email">
                                
                            </div>
                            @if($errors->has('email'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim gender -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="gender">{{ __('The gender') }}</span>
                                </div>
                                <select class="custom-select" aria-describedby="gender" wire:model.defer="gender">
                                    <option value="0">--اختر--</option>
                                        <option value="male">{{ __('Male') }}</option>
                                        <option value="female">{{ __('Female') }}</option>
                                </select>
                            </div>
                            @if($errors->has('gender'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('gender') }}</small>
                            @endif
                        </div>
                        <!-- User role -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="gender">{{ __('Role') }}</span>
                                </div>
                                <select class="custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}" wire:model="role">
                                    <option value="0">--اختر--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('role'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('role') }}</small>
                            @endif
                        </div>

                        <div class="modal-body">
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                <label class="form-label required">{{ __('Password') }}</label>
                                <div class="input-icon mb-3">
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"  wire:model="password" type="password" placeholder="{{ __('Password') }}">
                                </div>
                                @if($errors->has('password'))
                                        <small class="invalid-feedback d-block" style="margin-top: -10px;">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                <label class="form-label required">{{ __('Confirm Password') }}</label>
                                <div class="input-icon mb-3">
                                    <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"  wire:model="password_confirmation"  placeholder="{{ __('Confirm Password') }}" type="password">
                                </div>
                                @if($errors->has('password_confirmation'))
                                    <small class="invalid-feedback d-block" style="margin-top: -10px;">{{ $errors->first('password_confirmation') }}</small>
                                @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                <label class="form-label">{{ __('Bio') }}</label>
                                <textarea class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}" wire:model="bio" rows="3"></textarea>
                                @if($errors->has('bio'))
                                    <small class="invalid-feedback d-block">{{ $errors->first('bio') }}</small>
                                @endif
                                </div>
                            </div>
                            </div>
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

    <!-- Modal for Edit User -->
    <div class="modal modal-blur fade" id="modal-edituser" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" user="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new user') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updateUser">
                    <div class="modal-body">

                        <!-- User name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" aria-label="{{ __('Name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>

                        <!-- User email -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_email">{{ __('Email') }}</span>
                                </div>
                                <input type="email" class="form-control" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}" aria-describedby="up_email" wire:model.defer="up_email">
                                
                            </div>
                            @if($errors->has('up_email'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_email') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim gender -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_gender">{{ __('The gender') }}</span>
                                </div>
                                <select class="custom-select" aria-describedby="up_gender" wire:model.defer="up_gender">
                                    <option value="0">--اختر--</option>
                                        <option value="male">{{ __('Male') }}</option>
                                        <option value="female">{{ __('Female') }}</option>
                                </select>
                            </div>
                            @if($errors->has('up_gender'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_gender') }}</small>
                            @endif
                        </div>
                        <!-- User role -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_role">{{ __('Role') }}</span>
                                </div>
                                <select class="custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}" wire:model="up_role">
                                    <option value="0">--اختر--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('up_role'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_role') }}</small>
                            @endif
                        </div>

                        <div class="modal-body">
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                <label class="form-label">{{ __('Password') }}</label>
                                <div class="input-icon mb-3">
                                    <input class="form-control {{ $errors->has('up_password') ? 'is-invalid' : '' }}"  wire:model="up_password" type="up_password" placeholder="{{ __('Password') }}">
                                </div>
                                @if($errors->has('up_password'))
                                        <small class="invalid-feedback d-block" style="margin-top: -10px;">{{ $errors->first('up_password') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                <label class="form-label">{{ __('Bio') }}</label>
                                <textarea class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}" wire:model="up_bio" rows="3"></textarea>
                                @if($errors->has('up_bio'))
                                    <small class="invalid-feedback d-block">{{ $errors->first('up_bio') }}</small>
                                @endif
                                </div>
                            </div>
                            </div>
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

                $('#modal-user').modal('hide');
                $('#modal-edituser').modal('hide');
        })

        window.addEventListener('editUser', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditUserModal', event => {

            $('#modal-edituser').modal('show');

        })

        window.addEventListener('deleteUser', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteUserConfirm', event => {

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

                            @this.delete_current_user()
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
