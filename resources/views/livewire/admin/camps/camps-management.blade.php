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
        <livewire:admin.camps.camps-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-camp" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Add a new camp') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewCamp">
                    <div class="modal-body">

                        <!-- Camp name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Camp name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Camp name') }}" aria-label="{{ __('Camp name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <!-- Camp start_from -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="start_from">بداية الترقيم</span>
                                </div>
                                <input type="number" class="form-control" placeholder="0001" aria-label="{{ __('Camp name') }}" aria-describedby="start_from" wire:model.defer="start_from">
                                
                            </div>
                            @if($errors->has('start_from'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('start_from') }}</small>
                            @endif
                        </div>
                        <!-- Camp end_to -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="end_to">نهاية الترقيم</span>
                                </div>
                                <input type="number" class="form-control" placeholder="1000" aria-label="{{ __('Camp name') }}" aria-describedby="end_to" wire:model.defer="end_to">
                                
                            </div>
                            @if($errors->has('end_to'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('end_to') }}</small>
                            @endif
                        </div>
                        <!-- Camp season -->
                        <div class="form-group">
                            <label for="description">{{ __('Season') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season') }}" aria-describedby="season_name" wire:model.defer="season_name" disabled readonly>
                            @if($errors->has('season_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('season_name') }}</small>
                            @else
                                <small class="mt-1 d-block">يتم اختيار موسم الحج تلقائياً بدلالة الموسم النشط.</small>
                            @endif
                        </div>

                        <!-- Camp front_pilgrim_card -->
                        <div class="form-group">
                            <label for="description">وجه بطاقة الحاج</label>
                            <input onclick="filemanager.selectFile('front_pilgrim_card')" name="front_pilgrim_card" type="text" class="form-control" id="front_pilgrim_card" wire:model.blur="front_pilgrim_card">
                            @if($errors->has('front_pilgrim_card'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('front_pilgrim_card') }}</small>
                            @else
                                <small class="mt-1 d-block">أضف وجه بطاقة الحاج (سيتم طباعة بيانات الحاج عليه).</small>
                            @endif
                        </div>

                        <!-- Camp back_pilgrim_card -->
                        <div class="form-group">
                            <label for="description">ظهر بطاقة الحاج</label>
                            <input onclick="filemanager.selectFile('back_pilgrim_card')" name="back_pilgrim_card" type="text" class="form-control" id="back_pilgrim_card" wire:model.blur="back_pilgrim_card">
                            @if($errors->has('back_pilgrim_card'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('back_pilgrim_card') }}</small>
                            @else
                                <small class="mt-1 d-block">أضف ظهر بطاقة الحاج (لن يتم طباعة شئ عليه).</small>
                            @endif
                        </div>

                        <!-- Camp description -->
                        <div class="form-group">
                            <label for="description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="description" rows="3" wire:model.defer="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" onclick="@this.frontBackPilgrimCardChanged(document.querySelector('#front_pilgrim_card').value, document.querySelector('#back_pilgrim_card').value)" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
        </div>
        </div>
    </div>

    <!-- Modal for Edit Camp -->
    <div class="modal modal-blur fade" id="modal-editcamp" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Camp') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing Camp details -->
                    <form wire:submit.prevent="updateCamp">
                        <!-- Camp name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">{{ __('Camp name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Camp name') }}" aria-label="{{ __('Camp name') }}" aria-describedby="up_name" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>
                        <!-- Camp start_from -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_start_from">بداية الترقيم</span>
                                </div>
                                <input type="number" class="form-control" placeholder="0001" aria-label="{{ __('Camp name') }}" aria-describedby="up_start_from" wire:model.defer="up_start_from">
                                
                            </div>
                            @if($errors->has('up_start_from'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_start_from') }}</small>
                            @endif
                        </div>
                        <!-- Camp end_to -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_end_to">نهاية الترقيم</span>
                                </div>
                                <input type="number" class="form-control" placeholder="1000" aria-label="{{ __('Camp name') }}" aria-describedby="up_end_to" wire:model.defer="up_end_to">
                                
                            </div>
                            @if($errors->has('up_end_to'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_end_to') }}</small>
                            @endif
                        </div>
                        <!-- Camp season -->
                        <div class="form-group">
                            <label for="description">{{ __('Season') }}</label>
                            <input type="text" class="form-control" placeholder="{{ __('Season name') }}" aria-label="{{ __('Season') }}" aria-describedby="season_name" wire:model.defer="up_season_name" disabled readonly>
                            @if($errors->has('season_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('season_name') }}</small>
                            @else
                                <small class="mt-1 d-block">يتم اختيار موسم الحج تلقائياً بدلالة الموسم النشط.</small>
                            @endif
                        </div>
                        <!-- Camp front_pilgrim_card -->
                        <div class="form-group">
                            <label for="description">وجه بطاقة الحاج</label>
                            <input onclick="filemanager.selectFile('up_front_pilgrim_card')" name="up_front_pilgrim_card" type="text" class="form-control" id="up_front_pilgrim_card" wire:model.blur="up_front_pilgrim_card">
                            @if($errors->has('up_front_pilgrim_card'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_front_pilgrim_card') }}</small>
                            @else
                                <small class="mt-1 d-block">أضف وجه بطاقة الحاج (سيتم طباعة بيانات الحاج عليه).</small>
                            @endif
                        </div>

                        <!-- Camp back_pilgrim_card -->
                        <div class="form-group">
                            <label for="description">ظهر بطاقة الحاج</label>
                            <input onclick="filemanager.selectFile('up_back_pilgrim_card')" name="up_back_pilgrim_card" type="text" class="form-control" id="up_back_pilgrim_card" wire:model.blur="up_back_pilgrim_card">
                            @if($errors->has('up_back_pilgrim_card'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_back_pilgrim_card') }}</small>
                            @else
                                <small class="mt-1 d-block">أضف ظهر بطاقة الحاج (لن يتم طباعة شئ عليه).</small>
                            @endif
                        </div>
                        <!-- Camp description -->
                        <div class="form-group">
                            <label for="up_description">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="up_description" rows="3" wire:model.defer="up_description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button onclick="@this.frontBackPilgrimCardChanged(document.querySelector('#up_front_pilgrim_card').value, document.querySelector('#up_back_pilgrim_card').value)" type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
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

                $('#modal-camp').modal('hide');
                $('#modal-editcamp').modal('hide');
        })

        window.addEventListener('editCamp', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditCampModal', event => {

            $('#modal-editcamp').modal('show');

        })

        window.addEventListener('deleteCamp', event => {

            @this.confirm_delete(event.detail.id)

        })

        window.addEventListener('deleteCampConfirm', event => {

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

                            @this.delete_current_camp()
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
