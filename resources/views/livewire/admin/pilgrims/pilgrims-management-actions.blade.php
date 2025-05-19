<div>
    <div class="card card-statistics mb-30">
        <div class="card-body">
        <h5 class="card-title">ما الذي تود عمله اليوم؟ </h5>
        <div class="row mb-3">
            <div class="col-12">
            <label class="form-label my-1 me-2" for="actions">العمليات</label>
            <select class="form-select custom-select my-1 me-sm-2" id="actions" wire:model.live="actions">
                <option value="accommodation">تسكين</option>
                <option value="escalation">تصعيد</option>
                <option value="inter">دخول</option>
                <option value="exit">خروج</option>
            </select>
            </div>
        </div>

        @switch($actions)
            @case('accommodation')
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
                                @isset($units)
                                    @forelse ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @empty
                                        <option value="0">{{ __('No data') }}</option>
                                    @endforelse
                                @endisset
                                
                            </select>

                        </div>
                        @if($errors->has('unit_id'))
                            <small class="invalid-feedback mt-1 d-block">{{ $errors->first('unit_id') }}</small>
                        @endif
                    </div>
                @break
            @case('escalation')
                <!-- bus_id -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text" id="bus_id">{{ __('Bus') }}</span>
                        </div>

                        <select class="custom-select" id="bus_id" aria-label="{{ __('bus_id') }}" aria-describedby="bus_id" wire:model.defer="bus_id">
                            <option value="0">--اختر--</option>
                            @forelse ($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                            @empty
                                <option value="0">{{ __('No data') }}</option>
                            @endforelse
                        </select>

                    </div>
                    @if($errors->has('bus_id'))
                        <small class="invalid-feedback mt-1 d-block">{{ $errors->first('bus_id') }}</small>
                    @endif
                </div>
                @break
            @default
                
        @endswitch

        <div class="form-group">
            <label for="pilgrims_search">حدد الحاج (الإسم أو الرقم أو الهوية)</label>
            <input type="text" class="form-control" id="pilgrims_search" rows="3" wire:model.live="pilgrims_search">
            @if($errors->has('pilgrims_search'))
                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('pilgrims_search') }}</small>
            @else
                <small class="mt-1 d-block">يمكنك البحث بالإسم، الرقم، الهوية أو بعمل سكان لبطاقة الحاج</small>
            @endif
        </div>

        </div>
    </div>

    <div class="card card-statistics mb-30">
        <div class="card-body">
        <h5 class="card-title">بيانات الحاج </h5>
        <div class="row mb-3">
            <div class="col-12">
                @if ($pilgrim)
                    <div>
                        <p>اسم الحاج: {{ $pilgrim->name }}</p>
                        <p>رقم الحاج: {{ $pilgrim->number }}</p>
                        <p>رقم الهوية: {{ $pilgrim->national_id }}</p>
                        <p>رقم الهاتف: {{ $pilgrim->phone }}</p>
                        <p>المخيم: {{ $pilgrim->camp->name ?? '' }}</p>
                        <p>الخيمة: {{ $pilgrim->unit->name ?? '' }}</p>
                        <p>الباص: {{ $pilgrim->bus->name ?? '' }}</p>
                    </div>

                    <a class="button d-grid" href="javascript:void(0)" wire:click="confirmAction">تنفيذ الإجراء</a>
                @else
                    <div class="alert alert-primary" role="alert">
                        ستظهر هنا بيانات الحاج بمجرد أن تكون متاحة!
                    </div>
                @endif
                
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
        })
    </script>
</div>
