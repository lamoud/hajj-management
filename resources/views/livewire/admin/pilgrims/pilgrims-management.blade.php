<div>
    <style>
        .lm-td {
            vertical-align: top !important
        }
        .input-group-append span {
            width: 110px;
        }
        .lm-filtrs input {
            height: 30px;
            width: 70px !important;
        }
        .table-responsive {
            max-width: 1500px;
            overflow: auto;
        }
        .table-responsive table {
            font-size: 12px;
            width: max-content !important;
            max-width: unset !important;
            min-width: 100%;
        }
    </style>

<div class="row">
    <div><button class="button button-border x-small mx-2" wire:click="exportAll"> اكسيل  <i class="fa fa-long-arrow-up"></i> </button></div>
    <div><button class="button button-border x-small mx-2" data-toggle="modal" data-target="#modal-import"> استيراد  <i class="fa fa-long-arrow-down"></i> </button></div>
    <div><button class="button button-border x-small mx-2"> طباعة  <i class="fa fa-print"></i> </button></div>
</div>

    <div class="my-5 p-2 bg-white">
        <livewire:admin.pilgrims.pilgrims-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-pilgrim" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new pilgrim') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewPilgrim">
                    <div class="modal-body">

                        <!-- Pilgrim name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Pilgrim name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim name') }}" aria-label="{{ __('Pilgrim name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim number -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="pilgrim_number">{{ __('Pilgrim number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim number') }}" aria-label="{{ __('Pilgrim number') }}" aria-describedby="pilgrim_number" wire:model.defer="pilgrim_number">
                                
                            </div>
                            @if($errors->has('pilgrim_number'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('pilgrim_number') }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="pilgrim_declaration">{{ __('Declaration') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Declaration') }}" aria-label="{{ __('Declaration') }}" aria-describedby="pilgrim_declaration" wire:model.defer="pilgrim_declaration">
                                
                            </div>
                            @if($errors->has('pilgrim_declaration'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('pilgrim_declaration') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim id -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="national_id">{{ __('National id') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('National id') }}" aria-label="{{ __('Pilgrim id') }}" aria-describedby="national_id" wire:model.defer="national_id">
                                
                            </div>
                            @if($errors->has('national_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('national_id') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim nationality -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="nationality">{{ __('Nationality') }}</span>
                                </div>
                                <select class="custom-select" aria-describedby="nationality" wire:model.defer="nationality">
                                    <option value="0">--اختر--</option>
                                    @forelse ($nationalities as $nat)
                                        <option value="{{ $nat->slug }}">{{ $nat->name_ar }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            @if($errors->has('nationality'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('nationality') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim gender -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="gender">{{ __('The gender') }}</span>
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
                        <!-- camps -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="camp_id">{{ __('Camp') }}</span>
                                </div>

                                <select class="custom-select" id="camp_id" aria-label="{{ __('camp_id') }}" aria-describedby="camp_id" wire:model.defer="camp_id" wire:change="updateCamp('camp_id')">
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
                        <!-- unit -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="unit_id">{{ __('Unit') }}</span>
                                </div>

                                <select class="custom-select" id="unit_id" aria-label="{{ __('unit_id') }}" aria-describedby="unit_id" wire:model.defer="unit_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('unit_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('unit_id') }}</small>
                            @endif
                        </div>

                        <!-- arrival_type -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="arrival_type">{{ __('Arrival') }}</span>
                                </div>

                                <select class="custom-select" id="arrival_type" aria-label="{{ __('Arrival') }}" aria-describedby="arrival_type" wire:model.defer="arrival_type">
                                    <option value="0">--اختر--</option>
                                    <option value="internal">{{ __('Internal') }}</option>
                                    <option value="external">{{ __('External') }}</option>
                                </select>

                            </div>
                            @if($errors->has('arrival_type'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('arrival_type') }}</small>
                            @endif
                        </div>
                        <!-- agency -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="agency_id">{{ __('Agency') }}</span>
                                </div>

                                <select class="custom-select" id="agency_id" aria-label="{{ __('Agency') }}" aria-describedby="agency_id" wire:model.defer="agency_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($agencys as $agency)
                                        <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('agency_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('agency_id') }}</small>
                            @endif
                        </div>
                        <!-- Phone -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="phone">{{ __('Phone') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}" aria-describedby="phone" wire:model.defer="phone">
                                
                            </div>
                            @if($errors->has('phone'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('phone') }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="phone2">{{ __('Phone') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}" aria-describedby="phone2" wire:model.defer="phone2">
                                
                            </div>
                            @if($errors->has('phone2'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('phone2') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim season -->
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

    <div class="modal modal-blur fade" id="modal-editpilgrim" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Edit') .': '. $up_name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updatePilgrim">
                    <div class="modal-body">

                        <!-- Pilgrim name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Pilgrim name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim name') }}" aria-label="{{ __('Pilgrim name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim number -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_pilgrim_number">{{ __('Pilgrim number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim number') }}" aria-label="{{ __('Pilgrim number') }}" aria-describedby="up_pilgrim_number" wire:model.defer="up_pilgrim_number">
                                
                            </div>
                            @if($errors->has('up_pilgrim_number'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_pilgrim_number') }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="up_pilgrim_declaration">{{ __('Declaration') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Declaration') }}" aria-label="{{ __('Declaration') }}" aria-describedby="up_pilgrim_declaration" wire:model.defer="up_pilgrim_declaration">
                                
                            </div>
                            @if($errors->has('up_pilgrim_declaration'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_pilgrim_declaration') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim id -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_national_id">{{ __('National id') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('National id') }}" aria-label="{{ __('Pilgrim id') }}" aria-describedby="up_national_id" wire:model.defer="up_national_id">
                                
                            </div>
                            @if($errors->has('up_national_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_national_id') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim nationality -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_nationality">{{ __('Nationality') }}</span>
                                </div>
                                <select class="custom-select" aria-describedby="up_nationality" wire:model.defer="up_nationality">
                                    <option value="0">--اختر--</option>
                                    @forelse ($nationalities as $nat)
                                        <option value="{{ $nat->slug }}">{{ $nat->name_ar }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            @if($errors->has('up_nationality'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_nationality') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim gender -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_gender">{{ __('The gender') }}</span>
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
                        <!-- camps -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_camp_id">{{ __('Camp') }}</span>
                                </div>

                                <select class="custom-select" id="up_camp_id" aria-label="{{ __('camp_id') }}" aria-describedby="up_camp_id" wire:model.defer="up_camp_id" wire:change="updateCamp('up_camp_id')">
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
                        <!-- unit -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_unit_id">{{ __('Unit') }}</span>
                                </div>

                                <select class="custom-select" id="up_unit_id" aria-label="{{ __('unit_id') }}" aria-describedby="up_unit_id" wire:model.defer="up_unit_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_unit_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_unit_id') }}</small>
                            @endif
                        </div>

                        <!-- arrival_type -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_arrival_type">{{ __('Arrival') }}</span>
                                </div>

                                <select class="custom-select" id="up_arrival_type" aria-label="{{ __('Arrival') }}" aria-describedby="up_arrival_type" wire:model.defer="up_arrival_type">
                                    <option value="0">--اختر--</option>
                                    <option value="internal">{{ __('Internal') }}</option>
                                    <option value="external">{{ __('External') }}</option>
                                </select>

                            </div>
                            @if($errors->has('up_arrival_type'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_arrival_type') }}</small>
                            @endif
                        </div>
                        <!-- agency -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_agency_id">{{ __('Agency') }}</span>
                                </div>

                                <select class="custom-select" id="up_agency_id" aria-label="{{ __('Agency') }}" aria-describedby="up_agency_id" wire:model.defer="up_agency_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($agencys as $agency)
                                        <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_agency_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_agency_id') }}</small>
                            @endif
                        </div>
                        <!-- Phone -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text " id="up_phone">{{ __('Phone') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}" aria-describedby="up_phone" wire:model.defer="up_phone">
                                
                            </div>
                            @if($errors->has('up_phone'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_phone') }}</small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="up_phone2">{{ __('Phone') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}" aria-describedby="up_phone2" wire:model.defer="up_phone2">
                                
                            </div>
                            @if($errors->has('up_phone2'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_phone2') }}</small>
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

    <div class="modal modal-blur fade" id="modal-swappilgrim" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">تبديل سكن: {{ $up_name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="swap_current_pilgrim">
                    <div class="modal-body">

                        <!-- Pilgrim name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Pilgrim name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim name') }}" aria-label="{{ __('Pilgrim name') }}" aria-describedby="up_name" wire:model.defer="up_name" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim number -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_pilgrim_number">{{ __('Pilgrim number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim number') }}" aria-label="{{ __('Pilgrim number') }}" aria-describedby="up_pilgrim_number" wire:model.defer="up_pilgrim_number" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_pilgrim_number'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_pilgrim_number') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim id -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_national_id">{{ __('National id') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('National id') }}" aria-label="{{ __('Pilgrim id') }}" aria-describedby="up_national_id" wire:model.defer="up_national_id" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_national_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_national_id') }}</small>
                            @endif
                        </div>
                        <!-- camps -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_camp_id">{{ __('Camp') }}</span>
                                </div>

                                <select class="custom-select" id="up_camp_id" aria-label="{{ __('camp_id') }}" aria-describedby="up_camp_id" wire:model.defer="up_camp_id" disabled readonly>
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
                        <!-- unit -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_unit_id">{{ __('Unit') }}</span>
                                </div>
                                <select class="custom-select" id="up_unit_id" aria-label="{{ __('unit_id') }}" aria-describedby="up_unit_id" wire:model.defer="up_unit_id" disabled readonly>
                                    <option value="0">--اختر--</option>
                                    @forelse ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_unit_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_unit_id') }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="modal-body">
                        <i class="fa fa-exchange"></i>
                        <span>التبديل مع:</span>
                        <!-- Pilgrim name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="بحث" aria-describedby="swap_search" wire:model.defer="swap_search" wire:keyup="swapSearchChanged">
                            </div>
                            @if($errors->has('swap_search'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('swap_search') }}</small>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-10">
                                @forelse ($swaps as $plg)
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" wire:model.live="swap_with" value="{{ $plg->id }}" wire:change="swapWithChanged">
                                        <label class="form-check-label">{{ $plg->name }}</label>
                                    </div>
                                @empty
                                    {{ __('No data') }}
                                @endforelse
                                
                            </div>
                        </div>

                        @isset($this->current_swaps)
                        <!-- Pilgrim name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_swap_name">{{ __('Pilgrim name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim name') }}" aria-label="{{ __('Pilgrim name') }}" aria-describedby="up_swap_name" wire:model.defer="up_swap_name" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_swap_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_swap_name') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim number -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_swap_number">{{ __('Pilgrim number') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Pilgrim number') }}" aria-label="{{ __('Pilgrim number') }}" aria-describedby="up_swap_number" wire:model.defer="up_swap_number" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_swap_number'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_swap_number') }}</small>
                            @endif
                        </div>
                        <!-- Pilgrim id -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_swap_national_id">{{ __('National id') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('National id') }}" aria-label="{{ __('Pilgrim id') }}" aria-describedby="up_swap_national_id" wire:model.defer="up_swap_national_id" disabled readonly>
                                
                            </div>
                            @if($errors->has('up_swap_national_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_swap_national_id') }}</small>
                            @endif
                        </div>
                        <!-- camps -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_swap_camp_id">{{ __('Camp') }}</span>
                                </div>

                                <select class="custom-select" id="up_swap_camp_id" aria-label="{{ __('camp_id') }}" aria-describedby="up_swap_camp_id" wire:model.defer="up_swap_camp_id" disabled readonly>
                                    <option value="0">--اختر--</option>
                                    @forelse ($camps as $camp)
                                        <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('up_swap_camp_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_swap_camp_id') }}</small>
                            @endif
                        </div>
                        <!-- unit -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_swap_unit_id">{{ __('Unit') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Unit') }}" aria-label="{{ __('Unit') }}" aria-describedby="up_swap_unit_id" wire:model.defer="up_swap_unit_id" disabled readonly>

                            </div>
                            @if($errors->has('up_swap_unit_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_swap_unit_id') }}</small>
                            @endif
                        </div>
                        @endisset
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">تبديل</button>
                    </div>
                </form>
        </div>
        </div>
    </div>
    
    <div class="modal modal-blur fade" id="modal-import" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new pilgrim') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="importFile">
                    <div class="modal-body">
                        <!-- Select file -->
                        <div class="form-group">
                            <label for="description">اختر ملف</label>
                            <input type="file" class="form-control" placeholder="اختر ملف" aria-describedby="import_file" wire:model.defer="import_file">
                            @if($errors->has('import_file'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('import_file') }}</small>
                            @else
                                <small class="mt-1 d-block">اختر ملف اكسيل لتحميل، تأكد من الصيغة الصحيحة للملف.</small>
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

                $('#modal-pilgrim').modal('hide');
                $('#modal-editpilgrim').modal('hide');
                $('#modal-swappilgrim').modal('hide');
        })

        window.addEventListener('editPilgrim', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditPilgrimModal', event => {

            $('#modal-editpilgrim').modal('show');

        })

        window.addEventListener('deletePilgrim', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deletePilgrimConfirm', event => {

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

                            @this.delete_current_pilgrim()
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            
                        }, true],
                        ['<button>NO</button>', function (instance, toast) {
                
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                
                        }],
                    ]
            });

        })

        window.addEventListener('swapPilgrim', event => {

            @this.confirm_swap(event.detail.id)

        })

        window.addEventListener('swapPilgrimConfirm', event => {

            $('#modal-swappilgrim').modal('show');

        })
    </script>
</div>
