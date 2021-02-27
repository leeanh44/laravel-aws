@php
use Modules\Shop\Constants\SubCategoryStatus;
@endphp
<div class="row p-4">
    <div class="col-sm-8 offset-sm-2">
        <div class="card card-white p-4">
            <div class="form-group row @if($errors->has('name')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="name">{{ __('shop::category.name') }}</label>
                </div>
                <div class="col-lg-9">
                    <input class="form-control text" type="text" name="name" id="name" maxlength="255"
                        value="{{ old('name', optional($subCategory)->name) }}" @if($errors->has('name')) autofocus
                    @endif />
                    @if($errors->has('name'))
                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    @endif
                </div>
            </div>

            <div class="form-group row @if($errors->has('order')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="order">{{ __('shop::category.order') }}</label>
                </div>
                <div class="col-lg-9">
                    <select class="custom-select icon-select" id="orderSelected" name="order" @if($errors->has('order'))
                        autofocus @endif>
                        @for($i=$maxOrder; $i >= 1; $i--)
                        <option @if(old('order', optional($subCategory)->order)==$i) selected
                            @endif value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <input class="form-control" type="hidden" name="oldorder" id="oldorder"
                        value="{{ old('order', optional($subCategory)->order) }}">
                    @if($errors->has('order'))
                    <div class="invalid-feedback">{{$errors->first('order')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('image') || $errors->has('img_url')) has-errors @endif">
                <div class="col-lg-3 d-flex-top-vertical">
                    <label class="form-control-label" for="order">{{ __('shop::category.image') }}</label>
                </div>

                <div class="col-lg-9 form-bs4__file pt-3">
                    <input class="form-bs4__file__input" type="file" name="image" id="upload_input"
                        preview-target="#preview_image" accept="image/jpeg,image/png" />
                    <div class="form-bs4__file__preview relative input-group-custom" id="preview_image"
                        input-target="#upload_input">
                        <div class="form-bs4__file__overlay">
                            <div class="form-bs4__file__action reset-image">
                                <span class="cil-trash"></span>
                            </div>
                        </div>
                        <div class="form-bs4__file__empty text-center">
                            <span class="cil-image-plus"></span>
                            <p>@lang('shop::common.labels.select_img')</p>
                        </div>
                        @if($subCategory && $subCategory->img_url && !$errors->has('img_url'))
                        <img src="{{$subCategory->img_url}}" class="tmp-image" />
                        <input type="hidden" name="img_url" value="{{$subCategory->img_url}}" class="tmp-image" />
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
                    <label class="form-control-label" for="status">{{ __('shop::category.status') }}</label>
                </div>
                <div class="col-lg-9">
                    <select class="custom-select icon-select" id="statusSelected" name="status"
                        @if($errors->has('status'))
                        autofocus @endif>
                        <option value="{{ SubCategoryStatus::ACTIVE }}">{{ __('shop::common.labels.active') }}</option>
                        <option value="{{ SubCategoryStatus::INACTIVE }}">{{ __('shop::common.labels.inactive') }}
                        </option>
                    </select>
                    @if($errors->has('status'))
                    <div class="invalid-feedback">{{$errors->first('status')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="mt-3 pb-3 d-flex justify-content-center">
                        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('shop.categories.index') }}"
                            class="btn btn-outline-normal">　{{ __('shop::common.labels.back') }}　</a>　
                        <button type="submit" class="btn btn-normal">@if($subCategory)
                            {{ __('shop::common.labels.update') }} @else
                            {{ __('shop::common.labels.store') }} @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
