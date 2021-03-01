@extends('admin::layouts.master')

@section('admin::content')
<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="form"
    id="form-category">
    @method('post')
    @csrf
    @include('admin::categories.form', ['category' => null, 'maxOrder' => ++ $maxOrder])
</form>

@endsection
