@php
use Modules\Admin\Constants\MasterCategoryStatus;
@endphp
<div class="row p-4">
    <div class="col-sm-8 offset-sm-2">
        <div class="card card-white p-4">
            <div class="form-group row @if($errors->has('name')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="name">{{ __('admin::category.name') }}</label>
                </div>
                <div class="col-lg-9">
                    <input class="form-control text" type="text" name="name" id="name" maxlength="50"
                    value="{{ old('name', optional($category)->name) }}"
                        @if($errors->has('name')) autofocus @endif />
                    @if($errors->has('name'))
                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    @endif
                </div>
            </div>

            <div class="form-group row @if($errors->has('order')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="order">{{ __('admin::category.order') }}</label>
                </div>
                <div class="col-lg-9">
                    <select class="custom-select icon-select" id="orderSelected" name="order" @if($errors->has('order'))
                        autofocus @endif>
                        @for($i=$maxOrder; $i >= 1; $i--)
                            <option @if(old('order', optional($category)->order)==$i) selected
                                @endif value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <input class="form-control" type="hidden" name="oldorder" id="oldorder"
                        value="{{ old('order', optional($category)->order) }}">
                    @if($errors->has('order'))
                    <div class="invalid-feedback">{{$errors->first('order')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('image') || $errors->has('img_url')) has-errors @endif">
                <div class="col-lg-3 d-flex-top-vertical">
                    <label class="form-control-label" for="order">{{ __('admin::category.image') }}</label>
                </div>

                <div class="col-lg-9 form-bs4__file pt-3">
                    <input class="form-bs4__file__input" type="file" name="image" id="upload_input"
                        preview-target="#preview_image" accept="image/jpeg,image/png" />
                    <div class="form-bs4__file__preview relative input-group-custom" id="preview_image" input-target="#upload_input">
                        <div class="form-bs4__file__overlay">
                            <div class="form-bs4__file__action reset-image">
                                <span class="cil-trash"></span>
                            </div>
                        </div>
                        <div class="form-bs4__file__empty text-center">
                            <span class="cil-image-plus"></span>
                            <p>@lang('admin::common.labels.select_img')</p>
                        </div>
                        @if($category && $category->img_url && !$errors->has('img_url'))
                        <img src="{{$category->img_url}}" class="tmp-image" />
                        <input type="hidden" name="img_url" value="{{$category->img_url}}" class="tmp-image" />
                        @endif
                    </div>
                    @if($errors->has('image'))
                    <div class="invalid-feedback">{{$errors->first('image')}}</div>
                    @elseif($errors->has('img_url'))
                    <div class="invalid-feedback">{{$errors->first('img_url')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('status')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="status">{{ __('admin::category.status') }}</label>
                </div>
                <div class="col-lg-9">
                    <div class="custom-control custom-radio d-inline">
                        <input type="radio" class="custom-control-input" id="active" name="status"
                            value="{{ MasterCategoryStatus::ACTIVE }}" checked>
                        <label class="custom-control-label" for="active">{{ __('admin::common.labels.active') }}</label>
                    </div>
                    <div class="custom-control custom-radio ml-2 d-inline">
                        <input type="radio" class="custom-control-input" id="inactive" name="status"
                            value="{{ MasterCategoryStatus::INACTIVE }}" @if(old('status',
                            optional($category)->status)==MasterCategoryStatus::INACTIVE)
                        checked @endif>
                        <label class="custom-control-label" for="inactive">{{ __('admin::common.labels.inactive') }}</label>
                    </div>
                    @if($errors->has('status'))
                    <div class="invalid-feedback">{{$errors->first('status')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="mt-3 pb-3 d-flex justify-content-center">
                        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('admin.categories.index') }}"
                            class="btn btn-outline-normal">　{{ __('admin::common.labels.back') }}　</a>　
                        <button type="submit" class="btn btn-normal">@if($category)
                            {{ __('admin::common.labels.update') }} @else
                            {{ __('admin::common.labels.store') }} @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
