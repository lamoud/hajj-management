<div>

    <style>
        .lm-td {
            vertical-align: top !important
        }
    </style>

    <div class="my-5 p-2 bg-white">
        <livewire:admin.employees.employe-positions-categories-datatable />
    </div>

    <div class="modal modal-blur fade" id="modal-position" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">إضافة تصنيف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="addNewCategory">
                    <div class="modal-body">

                        <!-- name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="name">اسم التصنيف</span>
                                </div>
                                <input type="text" class="form-control" placeholder="التصنيف" wire:model.defer="name">
                                
                            </div>
                            @if($errors->has('name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <!-- Agency description -->
                        <div class="form-group">
                            <label for="content">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="content" rows="3" wire:model.defer="content"></textarea>
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

    <div class="modal modal-blur fade" id="modal-editeposition" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">تعديل التصنيف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <form class="w-100" wire:submit.prevent="updateCategory">
                    <div class="modal-body">

                        <!-- name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text required" id="up_name">اسم التصنيف</span>
                                </div>
                                <input type="text" class="form-control" placeholder="التصنيف" wire:model.defer="up_name">
                                
                            </div>
                            @if($errors->has('up_name'))
                                <small class="invalid-feedback mt-1 d-block">{{ $errors->first('up_name') }}</small>
                            @endif
                        </div>

                        <!-- description -->
                        <div class="form-group">
                            <label for="up_content">{{ __('Additional info') }}</label>
                            <textarea class="form-control" id="content" rows="3" wire:model.defer="up_content"></textarea>
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

                $('#modal-position').modal('hide');
                $('#modal-editeposition').modal('hide');
        })

        window.addEventListener('editConfirm', event => {

            @this.confirm_edit(event.detail.id)

        })

        window.addEventListener('showEditCategoryModal', event => {

            $('#modal-editeposition').modal('show');

        })
    </script>
</div>