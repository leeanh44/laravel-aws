@php
use Modules\Shop\Constants\CategoryStatus;
@endphp
<div class="form-group form-row form-bs4">
    <label class="col-md-3 d-flex-center-vertical">{{ __('shop::category.name') }}</label>
    <div class="col-md-9 form-group mb-0">
        <input type="text" maxlength="255" name="name" placeholder="{{ __('shop::category.name') }}"
            class="form-control form-bs4--input">
    </div>
</div>

<div class="form-group form-row form-bs4">
    <label class="col-md-3 d-flex-center-vertical" for="order">{{ __('shop::category.order') }}</label>
    <div class="col-md-9 form-group mb-0">
        <select class="custom-select icon-select" id="orderSelected" name="order" @if($errors->has('order'))
            autofocus @endif>
            @for($i=$maxOrder; $i >= 1; $i--)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>
<div class="form-group form-row form-bs4">
    <label class="col-md-3 d-flex-center-vertical for="status">{{ __('shop::category.status') }}</label>
    <div class="col-md-9 form-group mb-0">
        <select class="custom-select icon-select" id="statusSelected" name="status" @if($errors->has('status'))
            autofocus @endif>
            <option value="{{ CategoryStatus::ACTIVE }}">{{ __('shop::common.labels.active') }}</option>
            <option value="{{ CategoryStatus::INACTIVE }}">{{ __('shop::common.labels.inactive') }}</option>
        </select>
    </div>
</div>
