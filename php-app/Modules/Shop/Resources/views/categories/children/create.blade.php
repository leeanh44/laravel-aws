@extends('shop::layouts.master')
@php
Breadcrumbs::after(function ($trail) use ($category) {
    $trail->push($category->name);
    $trail->push(__('shop::sub_category.add'));
});
@endphp
@section('shop::content')
<form action="{{ route('shop.categories.children.store', $category->id) }}" method="POST" enctype="multipart/form-data"
    class="form" id="form-category">
    @method('post')
    @csrf
    @include('shop::categories.children.form', ['subCategory' => null, 'maxOrder' => ++ $maxOrder])
</form>
@endsection
