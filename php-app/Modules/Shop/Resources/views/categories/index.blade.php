@extends('shop::layouts.master')
@php
use Modules\Shop\Constants\CategoryStatus;
@endphp
@section('shop::breadcrumb-buttons')
<div class="breadcrumbs-buttons">
    <a href="javascript:void(0)" class="btn btn-normal btn-sm mr-3" data-backdrop="static" data-toggle="modal"
        data-target="#create_form_modal">{{ __('shop::category.add') }}</a>
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
                        <th class="w-25">{{ __('shop::category.name') }}</th>
                        <th>{{ __('shop::category.order') }}</th>
                        <th>{{ __('shop::category.status') }}</th>
                        <th>{{ __('shop::common.labels.created_at') }}</th>
                        <th>{{ __('shop::common.labels.update') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="tr-row text-center">
                        <td>{{ $category->id }}</td>
                        <td>
                            <a href="{{ route('shop.categories.detail', $category->id) }}" class="text-bold text-black">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td>{{ $category->order }}</td>
                        <td> <span
                                class="badge @if($category->status == CategoryStatus::ACTIVE) badge-success @else badge-warning @endif">{{ $category->status }}</span>
                        </td>
                        <td>{{ formatDate($category->created_at, 'd/m/Y') }}</td>
                        <td>
                            <div class="justify-content-center">
                                <a href="{{ route('shop.categories.detail', $category->id) }}"
                                    class="btn btn-info btn-sm">{{ __('shop::common.labels.update') }}</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row col-12 justify-content-center">
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@include('shop::categories.create', ['category' => null, 'maxOrder' => ++ $maxOrder])
@endsection

@push('middle-scripts')
<script src="{{ mix('js/shop/modal.js') }}"></script>
@endpush
