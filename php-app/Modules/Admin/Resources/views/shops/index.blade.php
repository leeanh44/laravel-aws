@extends('admin::layouts.master')
@php
use Modules\Admin\Constants\ShopStatus;
@endphp
@section('admin::breadcrumb-buttons')
<div class="breadcrumbs-buttons">
    <a href="{{ route('admin.shops.create') }}" class="btn btn-normal btn-sm mr-3">{{ __('admin::shop.add') }}</a>
</div>
@endsection
@section('admin::content')
<div class="fade-in">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false"
                    aria-controls="collapse">
                    <i class="cil-search"></i> <strong>{{ __('admin::common.labels.search') }}</strong>
                </div>
                <div class="card-body collapse @if((request('page') && count(request()->input()) > 1) ||
                    (!request('page') && count(request()->input()) > 0)) show @endif" id="collapse">
                    <form class="form-horizontal" action="{{ route('admin.shops.index') }}" method="GET">
                        <div class="row form-group">
                            <label class="col-md-3 col-lg-2 col-form-label">{{ __('admin::common.labels.id') }}</label>
                            <div class="col-md-6 col-lg-4">
                                <input id="userId" class="form-control" name="id" value="{{ request('id') }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-lg-2 col-form-label">{{ __('admin::shop.name') }}</label>
                            <div class="col-md-6 col-lg-4">
                                <input id="name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="row form-group input-daterange">
                            <label class="col-md-3 col-lg-2 col-form-label">{{ __('admin::common.labels.created_at') }}</label>
                            <div class="col-md-3 col-lg-2 ml-1">
                                <input type="text" name="created_from" class="form-control" value="{{ request('created_from') }}" autocomplete="off" placeholder="dd / mm / yyyy">
                            </div>
                            <span class="align-middle">~</span>
                            <div class="col-md-3 col-lg-2">
                                <input type="text" name="created_to" class="form-control" value="{{ request('created_to') }}" autocomplete="off" placeholder="dd / mm / yyyy">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-lg-2 col-form-label">{{ __('admin::shop.status') }}</label>
                            <div class="col-lg-9 d-flex-center-vertical">
                                <div class="custom-control custom-checkbox d-inline">
                                    <input type="checkbox" class="custom-control-input" id="active" name="status[]"
                                        value="{{ ShopStatus::ACTIVE }}" @if(in_array(ShopStatus::ACTIVE, request('status') ?? [])) checked @endif>
                                    <label class="custom-control-label" for="active">{{ __('admin::common.labels.active') }}</label>
                                </div>
                                <span class="align-middle">　</span>
                                <div class="custom-control custom-checkbox ml-2 d-inline">
                                    <input type="checkbox" class="custom-control-input" id="inactive" name="status[]"
                                        value="{{ ShopStatus::INACTIVE }}" @if(in_array(ShopStatus::INACTIVE, request('status') ?? [])) checked @endif>
                                    <label class="custom-control-label" for="inactive">{{ __('admin::common.labels.inactive') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <button id="btnFilter" type="submit" class="btn btn-info">
                            {{ __('admin::common.labels.search') }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-table border-0">
                <div class="card-body border-0">
                    <table class="table table-responsive-sm table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('admin::common.labels.id') }}</th>
                                <th class="w-25">{{ __('admin::shop.name') }}</th>
                                <th>{{ __('admin::shop.status') }}</th>
                                <th>{{ __('admin::common.labels.created_at') }}</th>
                                <th>{{ __('admin::common.labels.update') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shops as $shop)
                            <tr class="tr-row text-center" id="1">
                                <td>{{ $shop->id }}</td>
                                <td>
                                    <a href="{{ route('admin.shops.edit', $shop->id) }}" class="text-bold text-black">
                                        {{ $shop->name }}
                                    </a>
                                </td>
                                <td> <span
                                        class="badge @if($shop->status == ShopStatus::ACTIVE) badge-success @else badge-warning @endif">{{ $shop->status }}</span>
                                </td>
                                <td>{{ formatDate($shop->created_at, 'd/m/Y') }}</td>
                                <td>
                                    <div class="justify-content-center">
                                        <a href="{{ route('admin.shops.edit', $shop->id) }}"
                                            class="btn btn-info btn-sm">{{ __('admin::common.labels.edit') }}</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row col-12 justify-content-center">
                        {{ $shops->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
