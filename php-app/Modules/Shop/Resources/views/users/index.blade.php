@extends('shop::layouts.master')
@php
use Modules\Shop\Constants\UserStatus;
use Modules\Shop\Constants\ShopUserStatus;
@endphp
@section('shop::content')
<div class="fade-in">

    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false"
                    aria-controls="collapse">
                    <i class="cil-search"></i> <strong>{{ __('shop::common.labels.search') }}</strong>
                </div>
                <div class="card-body collapse @if((request('page') && count(request()->input()) > 1) ||
                    (!request('page') && count(request()->input()) > 0)) show @endif" id="collapse">
                    <form class="form-horizontal" action="{{ route('shop.users.index') }}" method="GET">
                        <div class="row form-group">
                            <label class="col-md-3 col-lg-2 col-form-label">{{ __('shop::common.labels.id') }}</label>
                            <div class="col-md-6 col-lg-4">
                                <input id="userId" class="form-control" name="id" value="{{ request('id') }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-lg-2 col-form-label">{{ __('shop::user.name') }}</label>
                            <div class="col-md-6 col-lg-4">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="row form-group input-daterange">
                            <label
                                class="col-md-3 col-lg-2 col-form-label">{{ __('shop::common.labels.created_at') }}</label>
                            <div class="col-md-3 col-lg-2 ml-1">
                                <input type="text" name="created_from" class="form-control"
                                    value="{{ request('created_from') }}" autocomplete="off"
                                    placeholder="dd / mm / yyyy">
                            </div>
                            <span class="align-middle">~</span>
                            <div class="col-md-3 col-lg-2">
                                <input type="text" name="created_to" class="form-control"
                                    value="{{ request('created_to') }}" autocomplete="off" placeholder="dd / mm / yyyy">
                            </div>
                            @if($errors->has('created_to'))
                            <div class="invalid-feedback">{{$errors->first('created_to')}}</div>
                            @endif
                        </div>
                        <div class="row form-group">
                            <label
                                class="col-md-3 col-lg-2 col-form-label">{{ __('shop::common.labels.status') }}</label>
                            <div class="col-lg-9 d-flex-center-vertical">
                                <div class="custom-control custom-checkbox d-inline">
                                    <input type="checkbox" class="custom-control-input" id="active" name="status[]"
                                        value="{{ ShopUserStatus::ACTIVE }}" @if(in_array(ShopUserStatus::ACTIVE,
                                        request('status') ?? [])) checked @endif>
                                    <label class="custom-control-label"
                                        for="active">{{ __('shop::common.labels.active') }}</label>
                                </div>
                                <span class="align-middle">　</span>
                                <div class="custom-control custom-checkbox ml-2 d-inline">
                                    <input type="checkbox" class="custom-control-input" id="inactive" name="status[]"
                                        value="{{ ShopUserStatus::INACTIVE }}" @if(in_array(ShopUserStatus::INACTIVE,
                                        request('status') ?? [])) checked @endif>
                                    <label class="custom-control-label"
                                        for="inactive">{{ __('shop::common.labels.inactive') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <button id="btnFilter" type="submit" class="btn btn-info">
                                {{ __('shop::common.labels.search') }} </button>
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
                                <th>{{ __('shop::common.labels.id') }}</th>
                                <th class="w-25">{{ __('shop::user.name') }}</th>
                                <th>{{ __('shop::user.level') }}</th>
                                <th>{{ __('shop::user.point_total') }}</th>
                                <th>{{ __('shop::common.labels.status') }}</th>
                                <th>{{ __('shop::common.labels.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="tr-row text-center">
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="#" class="text-bold text-black">
                                        {{ $user->userProfile->name }}
                                    </a>
                                </td>
                                <td>{{ $user->level }}</td>
                                <td>{{ $user->point_total }}</td>
                                <td> <span
                                        class="badge @if($user->status == ShopUserStatus::ACTIVE) badge-success @else badge-warning @endif">{{ $user->status }}</span>
                                </td>
                                <td>{{ formatDate($user->created_at, 'd/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row col-12 justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
