<div class="modal fade" id="create_form_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-form p-2">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-black text-600">{{ __('shop::category.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('shop.categories.store')}}" method="POST" id="create_submit_form">
                @method('post')
                @csrf
                <div class="modal-body px-3">
                    @include('shop::categories.form', ['category' => null, 'maxOrder' => $maxOrder])
                </div>
                <div class="modal-footer d-flex-center-vertical border-top-0 pt-0">
                    <button type="button" class="btn btn-100 btn-outline-normal"
                        data-dismiss="modal">　{{ __('shop::common.labels.back') }}　</button>
                    <button class="btn btn-100 btn-normal btn-submit">
                        <div class="spinner-border spinner-border-sm icon-loading" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        {{ __('shop::common.labels.store') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
