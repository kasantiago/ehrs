<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{env('PROJECT_DESCRIPTION') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('DOH.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('admin-assets/css/googleapis.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin-assets/css/fonts.googleapis.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin-assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin-assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="fp-page bg-light-green">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">
                <img src="{{ asset('e-logo.png')}}" alt="e-logo" height="30" width="100">
            </a>
            <small><b>{{env('PROJECT_DESCRIPTION') }}</small>
        </div>
        <div class="card">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="msg"><b>{{ __('Reset Password') }}</b></div>
                    <div class="msg">
                        Enter your email address that you used to register. We'll send you an email with your username and a
                        link to reset your password.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons col-green">email</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-lg bg-green waves-effect">
                        {{ __('Send Password Reset Link') }}
                    </button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{ url('/login') }}" class="col-green">Sign In!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin-assets/js/admin.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>