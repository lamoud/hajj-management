<div>
    @if ( isset($unit_id) && isset($national_id) && isset($number) && isset($employees_id) )
    
        <button type="button" class="btn btn-primary d-block mb-1" wire:click="printCard('print', {{$employees_id}})">طباعة الكارت</button>
        <button type="button" class="btn btn-warning d-block mb-1" wire:click="printCard('save', {{$employees_id}})">حفظ الكارت &nbsp;</button>
    @else
    <button type="button" class="btn border d-block mb-1" title="برجاء إكمال بيانات الحاج وتسكينه" disabled>طباعة الكارت</button>
    <button type="button" class="btn btn-warning d-block mb-1" title="برجاء إكمال بيانات الحاج وتسكينه" disabled>حفظ الكارت &nbsp;</button>
        {{-- <button type="button" class="btn btn-secondary d-block mb-1">طباعة الأسورة</button>
        <button type="button" class="btn btn-warning d-block mb-1">طباعة الإستيكر</button> --}}
    @endif
</div>