<div>
    <style>
        .lm-td {
            vertical-align: top !important
        }
        .input-group-append span {
            width: 110px;
        }
    </style>

    <div class="my-5 p-2 bg-white">
        <livewire:admin.buses.buses-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-bus" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new bus') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewBus">
                    <div class="modal-body">

                        <!-- Bus name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Bus number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Bus number') }}" aria-label="{{ __('Bus number') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <!-- Bus number -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="board_number">{{ __('Board number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Board number') }}" aria-label="{{ __('Board number') }}" aria-describedby="board_number" wire:model.defer="board_number">
                                
                            </div>
                            @if($errors->has('board_number'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('board_number') }}</small>
                            @endif
                        </div>
                        <!-- Bus declaration -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="declaration">{{ __('Declaration') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Declaration') }}" aria-label="{{ __('Declaration') }}" aria-describedby="declaration" wire:model.defer="declaration">
                                
                            </div>
                            @if($errors->has('declaration'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('declaration') }}</small>
                            @endif
                        </div>
                        <!-- Unit Number of sets -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="capacity">{{ __('Number of sets') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="50" aria-label="{{ __('Number of sets') }}" aria-describedby="capacity" wire:model.defer="capacity">
                            </div>
                            @if($errors->has('capacity'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('capacity') }}</small>
                            @endif
                        </div>
                        <!-- Bus season -->
                        <div class="form-group">
                            <label for="description">{{ __('Season') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season') }}" aria-describedby="season_name" wire:model.defer="season_name" disabled readonly>
                            @if($errors->has('season_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('season_name') }}</small>
                            @else
                                <small class="mt-1 d-block">يتم اختيار موسم الحج تلقائياً بدلالة الموسم النشط.</small>
                            @endif
                        </div>

                        <!-- Bus description -->
                        <div class="form-group">
                            <label for="description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="description" rows="3" wire:model.defer="description"></textarea>
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

    <!-- Modal for Edit Bus -->
    <div class="modal modal-blur fade" id="modal-editbus" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Bus') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="w-100" wire:submit.prevent="updateBus">
                    <div class="modal-body">

                        <!-- Bus name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Bus number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Bus number') }}" aria-label="{{ __('Bus number') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>

                        <!-- Bus number -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_board_number">{{ __('Board number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Board number') }}" aria-label="{{ __('Board number') }}" aria-describedby="up_board_number" wire:model.defer="up_board_number">
                                
                            </div>
                            @if($errors->has('up_board_number'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_board_number') }}</small>
                            @endif
                        </div>
                        <!-- Bus declaration -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_declaration">{{ __('Declaration') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Declaration') }}" aria-label="{{ __('Declaration') }}" aria-describedby="up_declaration" wire:model.defer="up_declaration">
                                
                            </div>
                            @if($errors->has('up_declaration'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_declaration') }}</small>
                            @endif
                        </div>
                        <!-- Unit Number of sets -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_capacity">{{ __('Number of sets') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="50" aria-label="{{ __('Number of sets') }}" aria-describedby="up_capacity" wire:model.defer="up_capacity">
                            </div>
                            @if($errors->has('up_capacity'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_capacity') }}</small>
                            @endif
                        </div>

                        <!-- Bus description -->
                        <div class="form-group">
                            <label for="up_description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="up_description" rows="3" wire:model.defer="up_description"></textarea>
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

                $('#modal-bus').modal('hide');
                $('#modal-editbus').modal('hide');
        })

        window.addEventListener('editBus', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditBusModal', event => {

            $('#modal-editbus').modal('show');

        })

        window.addEventListener('deleteBus', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteBusConfirm', event => {

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

                            @this.delete_current_bus()
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
