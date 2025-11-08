<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <title>Digitiz | Forget Password</title>
    <link rel="icon" href="{{asset('backend/images/favicon-16x16.png')}}" type="image/x-icon"/>
    <link href="{{asset('backend/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/plugins.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/animated.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/plugins/icons/icons.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/switcher/css/switcher.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/switcher/demo.css')}}" rel="stylesheet" />
</head>

<body class="login-img">
    <div class="page  responsive-log login-bg">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-4 col-xxl-4">
                                <div class="card my-5">
                                    <div class="p-4 pt-6 text-center">
                                        <img src="{{asset('backend/images/brand/logo-white.png')}}"
                                            class="header-brand-img dark-logo" alt="Dayonelogo" style="height: 35px;">
                                        <p class="text-muted">Sign In to your account</p>
                                    </div>
                                    @include('flash-message')
                                    <form class="card-body pt-3" method="POST" action="{{ route('ForgetPasswordPost') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Email Address') }}</label>
                                            <div class="input-group mb-4">
                                                <div class="input-group">
                                                    <a href="#" class="input-group-text">
                                                        <i class="fe fe-mail" aria-hidden="true"></i>
                                                    </a>
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}"
                                                        autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="submit">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Send Reset Password Link') }}</button>
                                        </div>
                                        @if (Route::has('password.request'))
                                        <a class="text-center mt-3" href="{{ route('login') }}">
                                            {{ __('Login?') }}
</a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
    <script src="{{asset('backend/js/sticky.js')}}"></script>
    <script src="{{asset('backend/js/themeColors.js')}}"></script>
    <script src="{{asset('backend/js/custom.js')}}"></script>
    <script src="{{asset('backend/switcher/js/switcher.js')}}"></script>
</body>

</html>