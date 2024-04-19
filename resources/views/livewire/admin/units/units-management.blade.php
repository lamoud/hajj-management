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
        <livewire:admin.units.units-datatable />
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
                <form class="w-100" wire:submit.prevent="addNewUnit">
                    <div class="modal-body">

                        <!-- Unit nume -->
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
                        <!-- Unit unit_size -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="unit_size">{{ __('Unit size') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="4*4" aria-label="{{ __('Unit unit') }}" aria-describedby="unit_size" wire:model.defer="unit_size">
                                
                            </div>
                            @if($errors->has('unit_size'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('unit_size') }}</small>
                            @endif
                        </div>
                        <!-- Unit accommodation -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="unit_accommodation">{{ __('Unit Accommodation') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="50" aria-label="{{ __('Unit Accommodation') }}" aria-describedby="unit_accommodation" wire:model.defer="unit_accommodation">
                            </div>
                            @if($errors->has('unit_accommodation'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('unit_accommodation') }}</small>
                            @endif
                        </div>
                        
                        <!-- bed_type -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="bed_type">{{ __('Bed type') }}</span>
                                </div>

                                <select class="custom-select" name="bed_type" id="bed_type" aria-label="{{ __('bed_type') }}" aria-describedby="bed_type" wire:model.defer="bed_type">
                                <option value="0">--اختر--</option>
                                    @forelse ($bedTypes as $bed)
                                        <option value="{{ $bed->id }}">{{ $bed->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('bed_type'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('bed_type') }}</small>
                            @endif
                        </div>
                        <!-- unit_types -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="unit_type">{{ __('Unit type') }}</span>
                                </div>

                                <select class="custom-select" id="unit_type" aria-label="{{ __('unit_type') }}" aria-describedby="unit_type" wire:model.defer="unit_type">
                                    <option value="0">--اختر--</option>
                                    @forelse ($unitTypes as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('unit_type'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('unit_type') }}</small>
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
                <form class="w-100" wire:submit.prevent="updateUnit">
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
                        <!-- Unit unit_size -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="unit_size">{{ __('Unit size') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="4*4" aria-label="{{ __('Unit unit') }}" aria-describedby="up_unit_size" wire:model.defer="up_unit_size">
                                
                            </div>
                            @if($errors->has('up_unit_size'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_unit_size') }}</small>
                            @endif
                        </div>
                        <!-- Unit accommodation -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="unit_accommodation">{{ __('Unit Accommodation') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="50" aria-label="{{ __('Unit Accommodation') }}" aria-describedby="up_unit_accommodation" wire:model.defer="up_unit_accommodation">
                            </div>
                            @if($errors->has('up_unit_accommodation'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_unit_accommodation') }}</small>
                            @endif
                        </div>
                        
                        <!-- bed_type -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="bed_type">{{ __('Bed type') }}</span>
                                </div>

                                <select class="custom-select" name="bed_type" id="bed_type" aria-label="{{ __('bed_type') }}" aria-describedby="up_bed_type" wire:model.defer="up_bed_type">
                                <option value="0">--اختر--</option>
                                    @forelse ($bedTypes as $bed)
                                        <option value="{{ $bed->id }}">{{ $bed->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_bed_type'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_bed_type') }}</small>
                            @endif
                        </div>
                        <!-- unit_types -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="unit_type">{{ __('Unit type') }}</span>
                                </div>

                                <select class="custom-select" id="up_unit_type" aria-label="{{ __('unit_type') }}" aria-describedby="up_unit_type" wire:model.defer="up_unit_type">
                                    <option value="0">--اختر--</option>
                                    @forelse ($unitTypes as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_unit_type'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_unit_type') }}</small>
                            @endif
                        </div>
                        <!-- camps -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_camp_id">{{ __('Camp') }}</span>
                                </div>

                                <select class="custom-select" id="up_camp_id" aria-label="{{ __('up_camp_id') }}" aria-describedby="up_camp_id" wire:model.defer="up_camp_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($camps as $camp)
                                        <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_camp_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_camp_id') }}</small>
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

        window.addEventListener('editUnit', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditUnitModal', event => {

            $('#modal-editunit').modal('show');

        })

        window.addEventListener('deleteUnit', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteUnitConfirm', event => {

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
