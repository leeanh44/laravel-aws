<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/shop.css') }}">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center text-dark mb-4">
                                        <h1>Shop management</h1>
                                    </div>
                                    <form class="user" action="{{ route('shop.login') }}" method="post">
                                        @csrf
                                        @if($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            @foreach($errors->all() as $error)
                                            {!! $error !!}<br />
                                            @endforeach
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp" placeholder="{{__('shop::common.labels.email')}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="password"
                                                placeholder="{{__('shop::common.labels.password')}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('shop::common.labels.login') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Js -->
    <script src="{{ mix('js/coreui.bundle.min.js') }}"></script>
</body>

</html>