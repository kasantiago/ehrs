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

    <link href="{{ asset('admin-assets/css/apprise.css') }}" rel="stylesheet" />

</head>

<body class="login-page bg-light-green">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">
                <img src="{{ asset('e-logo.png')}}" alt="e-logo" height="30" width="100">
            </a>
            <small><b>{{env('PROJECT_DESCRIPTION') }}</b></small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="msg"><b>Sign in to start your session</b></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons col-green">person</i>
                        </span>
                        <div class="form-line {{ ($errors->has('email')) ? 'error' : '' }}">
                            <input type="text" class="form-control" name="email" placeholder="Username" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                        <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                        @endif
                              
                    </div>

                    

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons col-green">lock</i>
                        </span>
                         <div class="form-line {{ ($errors->has('password')) ? 'error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                         @if ($errors->has('password'))
                        <label id="password-error" class="error" for="password"{{ $errors->first('password') }}</label>
                        @endif
                              
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                             <input class="form-check-input filled-in chk-col-green" type="checkbox" name="remember" id="rememberme" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-green waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <!-- <a href="sign-up.html">Register Now!</a> -->
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}" class="col-green">Forgot Password?</a>
                        </div>
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

     <script src="{{ asset('admin-assets/js/apprise.js') }}"></script>

    
    @if(Session::has('msg'))
         <script type="text/javascript">
            $('.appriseInner button').click();

            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">{!!Session::get('msg') !!}</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>');

        </script>

    @endif
   
   
</body>

</html>
