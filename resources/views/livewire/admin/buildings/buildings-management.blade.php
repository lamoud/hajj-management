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
        <livewire:admin.buildings.buildings-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-building" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new building') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewBuilding">
                    <div class="modal-body">

                        <!-- Building name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Building name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Building name') }}" aria-label="{{ __('Building name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <!-- camps -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="camp_id">{{ __('Camp') }}</span>
                                </div>

                                <select class="custom-select" id="camp_id" aria-label="{{ __('camp_id') }}" aria-describedby="camp_id" wire:model.defer="camp_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($camps as $camp)
                                        <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('camp_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('camp_id') }}</small>
                            @endif
                        </div>
                        
                        <!-- Unit season -->
                        <div class="form-group">
                            <label for="description">{{ __('Season') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season') }}" aria-describedby="season_name" wire:model.defer="season_name" disabled readonly>
                            @if($errors->has('season_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('season_name') }}</small>
                            @else
                                <small class="mt-1 d-block">يتم اختيار موسم الحج تلقائياً بدلالة الموسم النشط.</small>
                            @endif
                        </div>

                        <!-- Building description -->
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

    <!-- Modal for Edit Building -->
    <div class="modal modal-blur fade" id="modal-editbuilding" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Building') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing Building details -->
                    <form wire:submit.prevent="updateBuilding">
                        <!-- Building name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Building name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Building name') }}" aria-label="{{ __('Building name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>
                        <!-- Building start_from -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_start_from">بداية الترقيم</span>
                                </div>
                                <input type="number" class="form-control" placeholder="0001" aria-label="{{ __('Building name') }}" aria-describedby="up_start_from" wire:model.defer="up_start_from">
                                
                            </div>
                            @if($errors->has('up_start_from'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_start_from') }}</small>
                            @endif
                        </div>
                        <!-- Building end_to -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_end_to">نهاية الترقيم</span>
                                </div>
                                <input type="number" class="form-control" placeholder="1000" aria-label="{{ __('Building name') }}" aria-describedby="up_end_to" wire:model.defer="up_end_to">
                                
                            </div>
                            @if($errors->has('up_end_to'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_end_to') }}</small>
                            @endif
                        </div>
                        <!-- Building season -->
                        <div class="form-group">
                            <label for="description">{{ __('Season') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season') }}" aria-describedby="season_name" wire:model.defer="up_season_name" disabled readonly>
                            @if($errors->has('season_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('season_name') }}</small>
                            @else
                                <small class="mt-1 d-block">يتم اختيار موسم الحج تلقائياً بدلالة الموسم النشط.</small>
                            @endif
                        </div>
                        <!-- Building description -->
                        <div class="form-group">
                            <label for="up_description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="up_description" rows="3" wire:model.defer="up_description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </div>
                    </form>
                </div>
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

                $('#modal-building').modal('hide');
                $('#modal-editbuilding').modal('hide');
        })

        window.addEventListener('editBuilding', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditBuildingModal', event => {

            $('#modal-editbuilding').modal('show');

        })

        window.addEventListener('deleteBuilding', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteBuildingConfirm', event => {

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

                            @this.delete_current_building()
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
