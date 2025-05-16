<div style="width: 100%">
    <link rel="stylesheet" type="text/css" href="{{ asset('izitoast/css/iziToast.min.css') }}">
    <style>
        /* Style inputs, select elements and textareas */
        form {
            max-width: 800px;
            margin: 0 auto;
            direction: rtl
        }
        .invalid-feedback {
            display: block;
            color: rgb(202, 29, 29)
        }
        input[type=text], input[type=number], select, textarea{
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
        }

        /* Style the label to display next to the inputs */
        label {
        padding: 12px 0 12px 12px;
        display: inline-block;
        }

        /* Style the submit button */
        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: left;
        }

        /* Style the container */
        .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        min-height: 100vh;
        padding: 20px;
        }

        /* Floating column for labels: 25% width */
        .col-25 {
        float: right;
        width: 25%;
        margin-top: 6px;
        }

        /* Floating column for inputs: 75% width */
        .col-75 {
        float: right;
        width: 75%;
        margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
        .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
        }

        /* The alert message box */
.alert {
    padding: 16px;
    background-color: #04aa6d; /* Red */
    color: white;
    margin-bottom: 15px;
    direction: rtl;
}

.alert span {
    font-weight: bold
}

.alert h2 {
    font-size: 24px;
    font-weight: bold;
    width: 100%;
    margin: 0 auto;
    text-align: center;
}

/* The close button */
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
    </style>
    <div class="container">
        <div class="alert">
            <h2>طلب توظيف</h2>
            {{-- <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> --}}
            لطلب وظيفة لدينا في خدمات الحجاج، برجاء تعبئة النموذج التالي <span>اذا سبق لك التقديم فقد تلقينا طلبك وسيتم نجاهل أية طلبات أخرى</span>.
        </div>
        <form wire:submit.prevent="addNewRequest">
        <div class="row">
            <div class="col-25">
            <label for="name">{{ __('Name') }}<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <input type="text" class="form-control" placeholder="الإسم بالكامل" wire:model.defer="name">
                @if($errors->has('name'))
                    <small class="invalid-feedback">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            <label for="age">العمر<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <input type="number" class="form-control" placeholder="العمر" wire:model.defer="age">
                @if($errors->has('age'))
                    <small class="invalid-feedback">{{ $errors->first('age') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            <label for="nationality">الجنسية<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <select id="nationality" wire:model.defer="nationality">
                    <option value="0">--اختر--</option>
                    @forelse ($nationalities as $nat)
                        <option value="{{ $nat->slug }}">{{ $nat->name_ar }}</option>
                    @empty
                        <option value="0">{{ __('No data') }}</option>
                    @endforelse
                </select>
                @if($errors->has('nationality'))
                    <small class="invalid-feedback">{{ $errors->first('nationality') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            <label for="phone">رقم الجوال<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <input type="text" class="form-control" placeholder="رقم الجوال" wire:model.defer="phone">
                @if($errors->has('phone'))
                    <small class="invalid-feedback">{{ $errors->first('phone') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            <label for="years_experience">سنوات الخبرة<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <input type="number" class="form-control" placeholder="عدد سنوات الخبرة" wire:model.defer="years_experience">
                @if($errors->has('years_experience'))
                    <small class="invalid-feedback">{{ $errors->first('years_experience') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            <label for="job_id">المسمى الوظيفي<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <select id="job_id" wire:model.defer="job_id">
                    <option value="0">--اختر--</option>
                    @forelse ($jobs as $job)
                        <option value="{{ $job->id }}">{{ $job->name }}</option>
                    @empty
                        <option value="0">{{ __('No data') }}</option>
                    @endforelse
                </select>
                @if($errors->has('job_id'))
                    <small class="invalid-feedback">{{ $errors->first('job_id') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-25">
            <label for="worked_here_before">عملت معنا؟<span style="color: red">*</span></label>
            </div>
            <div class="col-75">
                <select id="worked_here_before" wire:model.defer="worked_here_before">
                    <option value="0">--اختر--</option>
                    <option value="yes">نعم عملت معكم من قبل</option>
                    <option value="no">لا لم أعمل معكم حتى الآن</option>
                </select>
                @if($errors->has('worked_here_before'))
                    <small class="invalid-feedback">{{ $errors->first('worked_here_before') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            <label for="content">معلومات اضافية</label>
            </div>
            <div class="col-75">
                <textarea id="content" placeholder="عرف عن نفسك..." style="height:200px" wire:model.defer="content"></textarea>
                @if($errors->has('content'))
                    <small class="invalid-feedback">{{ $errors->first('content') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <input type="submit" value="{{ __('Send') }}">
        </div>
        </form>
    </div>

    <script src="{{ asset('izitoast/js/iziToast.min.js') }}"></script>
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
