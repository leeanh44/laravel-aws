@extends('admin::layouts.master')

@section('admin::content')
<form action="{{ route('admin.shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data" class="form"
    id="form-shop">
    @method('put')
    @csrf
    @include('admin::shops.form', ['shop' => $shop])
</form>
@endsection
