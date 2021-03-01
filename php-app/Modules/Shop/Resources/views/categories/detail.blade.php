@extends('shop::layouts.master')
@php
use Modules\Shop\Constants\SubCategoryStatus;
Breadcrumbs::after(function ($trail) use ($category) {
$trail->push($category->name);
});
@endphp
@section('shop::breadcrumb-buttons')
<div class="breadcrumbs-buttons">
    <a href="javascript:void(0)" class="btn btn-normal btn-sm mr-3" data-backdrop="static" data-toggle="modal"
        data-init="true" data-name="{{ $category->name }}" data-status="{{ $category->status }}"
        data-order="{{ $category->order }}" data-target="#update_form_modal">{{ __('shop::category.edit') }}</a>
    <a href="{{ route('shop.categories.children.create', $category->id) }}"
        class="btn btn-normal btn-sm mr-3">{{ __('shop::sub_category.add') }}</a>

</div>
@endsection
@section('shop::content')
<div class="fade-in">
    <div class="card card-table border-0 my-4">
        <div class="card-body border-0">
            <table class="table table-responsive-sm table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>{{ __('shop::common.labels.id') }}</th>
                        <th class="w-25">{{ __('shop::sub_category.name') }}</th>
                        <th>{{ __('shop::category.image') }}</th>
                        <th>{{ __('shop::category.order') }}</th>
                        <th>{{ __('shop::category.status') }}</th>
                        <th>{{ __('shop::common.labels.created_at') }}</th>
                        <th>{{ __('shop::common.labels.update') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($subCategories as $subCategory)
                    <tr class="tr-row text-center">
                        <td>{{ $subCategory->id }}</td>
                        <td>
                            <a href="{{ route('shop.categories.edit', $subCategory->id) }}"
                                class="text-bold text-black">
                                {{ $subCategory->name }}
                            </a>
                        </td>
                        <td>
                            <img src="{{$subCategory->img_url}}" class="tmp-image form-bs4__file__preview d-inline" />
                        </td>
                        <td>{{ $subCategory->order }}</td>
                        <td> <span
                                class="badge @if($subCategory->status == SubCategoryStatus::ACTIVE) badge-success @else badge-warning @endif">{{ $subCategory->status }}</span>
                        </td>
                        <td>{{ formatDate($subCategory->created_at, 'd/m/Y') }}</td>
                        <td>
                            <div class="justify-content-center">
                                <a href="{{ route('shop.categories.children.edit', $subCategory->id) }}"
                                    class="btn btn-info btn-sm">{{ __('shop::common.labels.edit') }}</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row col-12 justify-content-center">
                {{ $subCategories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@include('shop::categories.edit', ['category' => $category, 'maxOrder' => $maxOrder])
@endsection
@push('middle-scripts')
<script src="{{ mix('js/shop/modal.js') }}"></script>
@endpush
