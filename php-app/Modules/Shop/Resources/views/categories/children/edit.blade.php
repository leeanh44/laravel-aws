@extends('shop::layouts.master')
@php
Breadcrumbs::after(function ($trail) use ($category, $subCategory) {
    $trail->push($category->name, route('shop.categories.detail', $category->id));
    $trail->push($subCategory->name);
    $trail->push(__('shop::common.labels.edit'));
});
@endphp
@section('shop::content')
<form action="{{ route('shop.categories.children.update', $subCategory->id) }}" method="POST"
    enctype="multipart/form-data" class="form" id="form-category">
    @method('put')
    @csrf
    @include('shop::categories.children.form', ['subCategory' => $subCategory, 'maxOrder' => $maxOrder])
</form>
@endsection
