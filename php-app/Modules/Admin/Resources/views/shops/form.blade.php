@php
use Modules\Admin\Constants\ShopStatus;
@endphp
<div class="row p-4">
    <div class="col-sm-8 offset-sm-2">
        <div class="card card-white p-4">
            <div class="form-group row @if($errors->has('name')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="name">{{ __('admin::shop.name') }}</label>
                </div>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="name" id="name" maxlength="50"
                    value="{{ old('name', optional($shop)->name) }}"
                        @if($errors->has('name')) autofocus @endif />
                    @if($errors->has('name'))
                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    @endif
                </div>
            </div>

            <div class="form-group row @if($errors->has('image') || $errors->has('img_url')) has-errors @endif">
                <div class="col-lg-3 d-flex-top-vertical">
                    <label class="form-control-label" for="order">{{ __('admin::shop.image') }}</label>
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
                        @if($shop && $shop->img_url && !$errors->has('img_url'))
                        <img src="{{$shop->img_url}}" class="tmp-image" />
                        <input type="hidden" name="img_url" value="{{$shop->img_url}}" class="tmp-image" />
                        @endif
                    </div>
                    @if($errors->has('image'))
                    <div class="invalid-feedback">{{$errors->first('image')}}</div>
                    @elseif($errors->has('img_url'))
                    <div class="invalid-feedback">{{$errors->first('img_url')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('master_categories')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="status">{{ __('admin::common.labels.category') }}</label>
                </div>
                <div class="col-lg-9">
                    <select class="js-select-category" id="master_categories" name="master_categories[]"
                            multiple>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(in_array($category->id, old('master_categories', $master_categories ?? []))) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('master_categories'))
                    <div class="invalid-feedback">{{$errors->first('master_categories')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('address')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="address">{{ __('admin::common.labels.address') }}</label>
                </div>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="address" id="address" maxlength="50"
                    value="{{ old('address', optional($shop)->address) }}"
                        @if($errors->has('address')) autofocus @endif />
                    @if($errors->has('address'))
                    <div class="invalid-feedback">{{$errors->first('address')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('working_time')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="working_time">{{ __('admin::shop.working_time') }}</label>
                </div>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="working_time" id="working_time" maxlength="50"
                    value="{{ old('working_time', optional($shop)->working_time) }}"
                        @if($errors->has('working_time')) autofocus @endif />
                    @if($errors->has('working_time'))
                    <div class="invalid-feedback">{{$errors->first('working_time')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('description')) has-errors @endif">
                <div class="col-lg-3 d-flex">
                    <label class="form-control-label" for="description">{{ __('admin::common.labels.description') }}</label>
                </div>
                <div class="col-lg-9">
                    <textarea name="description" class="form-control" name="description" id="description"
                        @if($errors->has('description')) autofocus @endif
                        rows="5">{{ old('description', optional($shop)->description) ?? '' }}</textarea>
                    @if($errors->has('description'))
                    <div class="invalid-feedback">{{$errors->first('description')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row @if($errors->has('status')) has-errors @endif">
                <div class="col-lg-3 d-flex-center-vertical">
                    <label class="form-control-label" for="status">{{ __('admin::shop.status') }}</label>
                </div>
                <div class="col-lg-9">
                    <select class="custom-select icon-select" id="statusSelected" name="status"
                        @if($errors->has('status'))
                        autofocus @endif>
                        <option value="{{ ShopStatus::ACTIVE }}">{{ __('shop::common.labels.active') }}</option>
                        <option value="{{ ShopStatus::INACTIVE }}">{{ __('shop::common.labels.inactive') }}
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
                        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('admin.categories.index') }}"
                            class="btn btn-outline-normal">　{{ __('admin::common.labels.back') }}　</a>　
                        <button type="submit" class="btn btn-normal">@if($shop)
                            {{ __('admin::common.labels.update') }} @else
                            {{ __('admin::common.labels.store') }} @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('middle-scripts')
<script>
    $(document).ready(function () {
        createSlimSelect('.js-select-category')
    });
</script>
@endpush
