<div>
    <style>
        .lm-td {
            vertical-align: top !important
        }
    </style>

    <div class="my-5 p-2 bg-white">
        <livewire:admin.season.season-datatable />
    </div>
    <!-- Modal for Create season -->
    <div class="modal modal-blur fade" id="modal-season" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new season') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewseason">
                    <div class="modal-body">

                        <!-- season name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Season name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <!-- season start date -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="start_date">{{ __('Start date') }}</span>
                                </div>
                                <input type="date" class="form-control" aria-label="{{ __('Season name') }}" aria-describedby="start_date" wire:model.defer="start_date">
                                
                            </div>
                            @if($errors->has('start_date'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('start_date') }}</small>
                            @endif
                        </div>
                        
                        <!-- season end date -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="end_date">{{ __('End date') }}</span>
                                </div>
                                <input type="date" class="form-control" aria-label="{{ __('Season name') }}" aria-describedby="end_date" wire:model.defer="end_date">
                                
                            </div>
                            @if($errors->has('end_date'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('end_date') }}</small>
                            @endif
                        </div>

                        <!-- season description -->
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
    <!-- Modal for Edit season -->
    <div class="modal modal-blur fade" id="modal-editseason" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Edit') .': '. $up_name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updateSeason">
                    <div class="modal-body">

                        <!-- season name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Season name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>
                        <!-- season start date -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_start_date">{{ __('Start date') }}</span>
                                </div>
                                <input type="date" class="form-control" aria-label="{{ __('Start date') }}" aria-describedby="up_start_date" wire:model.defer="up_start_date" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_start_date'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_start_date') }}</small>
                            @endif
                        </div>
                        
                        <!-- season end date -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_end_date">{{ __('End date') }}</span>
                                </div>
                                <input type="date" class="form-control" aria-label="{{ __('End date') }}" aria-describedby="up_end_date" wire:model.defer="up_end_date" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_end_date'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_end_date') }}</small>
                            @endif
                        </div>

                        <!-- season description -->
                        <div class="form-group">
                            <label for="up_description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="up_description" rows="3" wire:model.defer="up_description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
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

                $('#modal-season').modal('hide');
                $('#modal-editseason').modal('hide');
        })

        
        window.addEventListener('editSeason', event => {

            @this.confirm_edit(event.detail.id)

        })
        
        window.addEventListener('showEditSeasonModal', event => {

            $('#modal-editseason').modal('show');

        })
        
        window.addEventListener('deleteSeason', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteSeasonConfirm', event => {

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

                            @this.delete_current_season()
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
