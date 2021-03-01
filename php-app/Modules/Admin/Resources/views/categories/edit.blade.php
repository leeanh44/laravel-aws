@extends('admin::layouts.master')

@section('admin::content')
<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="form"
    id="form-category">
    @method('put')
    @csrf
    @include('admin::categories.form', ['category' => $category, 'maxOrder' => $maxOrder])
</form>

@endsection
