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
        <livewire:admin.units.unit-types-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-unit" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new unit') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewUnitType">
                    <div class="modal-body">

                        <!-- UnitType nume -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Unit number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Unit number') }}" aria-label="{{ __('Unit name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
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

    <!-- Modal for Edit Unit -->
    <div class="modal modal-blur fade" id="modal-editunit" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new unit') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updateUnitType">
                    <div class="modal-body">

                        <!-- Unit nume -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Unit number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Unit number') }}" aria-label="{{ __('Unit name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
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

                $('#modal-unit').modal('hide');
                $('#modal-editunit').modal('hide');
        })

        window.addEventListener('editUnitType', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditUnitTypeModal', event => {

            $('#modal-editunit').modal('show');

        })

        window.addEventListener('deleteUnitType', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteUnitTypeConfirm', event => {

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

                            @this.delete_current_unit()
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
