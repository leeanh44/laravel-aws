@extends('admin::layouts.master')
@php
use Modules\Admin\Constants\MasterCategoryStatus;
@endphp
@section('admin::breadcrumb-buttons')
<div class="breadcrumbs-buttons">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-normal btn-sm mr-3">@lang('admin::category.add')</a>
</div>
@endsection
@section('admin::content')
<div class="fade-in">
    <div class="card card-table border-0 my-4">
        <div class="card-body border-0">
            <table class="table table-responsive-sm table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>{{ __('admin::common.labels.id') }}</th>
                        <th class="w-25">{{ __('admin::category.name') }}</th>
                        <th>{{ __('admin::category.order') }}</th>
                        <th>{{ __('admin::category.status') }}</th>
                        <th>{{ __('admin::common.labels.created_at') }}</th>
                        <th>{{ __('admin::common.labels.update') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="tr-row text-center" id="1">
                        <td>{{ $category->id }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-bold text-black">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td>{{ $category->order }}</td>
                        <td> <span class="badge @if($category->status == MasterCategoryStatus::ACTIVE) badge-success @else badge-warning @endif">{{ $category->status }}</span> </td>
                        <td>{{ formatDate($category->created_at, 'd/m/Y') }}</td>
                        <td>
                            <div class="justify-content-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-info btn-sm">{{ __('admin::common.labels.edit') }}</a>
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
@endsection
