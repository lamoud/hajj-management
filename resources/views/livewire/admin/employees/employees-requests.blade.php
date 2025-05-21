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

    <div class="my-5 p-2 bg-white">
        <p class="mb-4 text-primary">رابط <a href="{{ route('employment_application') }}" target="_blank">التقدم للوظائف</a></p>
        <livewire:admin.employees.employees-requests-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-editEmployeRequest" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ __('Edit') .': '. $name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updateEmployeRequest">
                    <div class="modal-body">

                        <!-- Employe name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">{{ __('Employe name') }}</span>
                                </div>
                                <input type="text" class="form-control" placeholder="{{ __('Employe name') }}" aria-label="{{ __('Employe name') }}" aria-describedby="name" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="age">العمر</span>
                                </div>
                                <input type="number" class="form-control" placeholder="العمر" aria-label="{{ __('age') }}" aria-describedby="age" wire:model.defer="age">
                                
                            </div>
                            @if($errors->has('age'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('age') }}</small>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="years_experience">سنوات الخبرة</span>
                                </div>
                                <input type="number" class="form-control" placeholder="سنوات الخبرة" aria-label="{{ __('age') }}" aria-describedby="years_experience" wire:model.defer="years_experience">
                            </div>
                            @if($errors->has('years_experience'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('years_experience') }}</small>
                            @endif
                        </div>
                        
                        <!-- Employe nationality -->
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
                        <!-- job_id -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="job_id">المسمى الوظيفي</span>
                                </div>

                                <select class="custom-select" id="job_id" aria-label="{{ __('job_id') }}" aria-describedby="job_id" wire:model.defer="job_id">
                                    <option value="0">--اختر--</option>
                                    @forelse ($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                </select>

                            </div>
                            @if($errors->has('job_id'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('job_id') }}</small>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">حفظ & قبول</button>
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

                $('#modal-employe').modal('hide');
                $('#modal-editEmployeRequest').modal('hide');
                $('#modal-swapemploye').modal('hide');
        })

        window.addEventListener('editEmployeRequest', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditEmployeModal', event => {

            $('#modal-editEmployeRequest').modal('show');

        })

        window.addEventListener('deleteEmploye', event => {

            @this.confirm_delete(event.detail.id, event.detail.type)

        })

        window.addEventListener('deleteEmployeConfirm', event => {

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

                            @this.delete_current_employe()
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
