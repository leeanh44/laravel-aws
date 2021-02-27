@extends('admin::layouts.master')

@section('admin::content')
<form action="{{ route('admin.shops.store') }}" method="POST" enctype="multipart/form-data" class="form"
    id="form-category">
    @method('post')
    @csrf
    @include('admin::shops.form', ['shop' => null, 'categories' => $categories])
</form>
@endsection
