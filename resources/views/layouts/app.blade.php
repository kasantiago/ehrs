<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
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

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('admin-assets/css/themes/all-themes.css') }}" rel="stylesheet" />

    <!-- Apprise CSS-->
    <link href="{{ asset('admin-assets/css/apprise.css') }}" rel="stylesheet" />


    @yield('styles')

    <style type="text/css">
        .unseen{background-color:antiquewhite;}
        .seen{background-color:white;}
        .user-info:hover i{color: #000;}
    </style>



</head>

<body class="theme-{{ $color[4] }}"> <!-- theme-color -->
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
 <!--    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div> -->
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <div style="float: left;">
                    <a class="navbar-brand" href="{{ url('/dashboard') }}"><img src="{{ asset('e-logo.png')}}" alt="e-logo" height="30" width="100" style="margin-top: -5px;"></a>
                </div>
                <div style="float: right;">
                    <a class="navbar-brand" href="{{ url('/dashboard') }}"> | @yield('title') </a>
                </div>
            </div>
           
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                  <!--   <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a class="notifications" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <div class="notification-count">
                            @if(App\Http\Models\Notifications::unseen(Auth::id()))
                            <span class="label-count">{{ App\Http\Models\Notifications::unseen(Auth::id()) }}</span>
                            @endif
                            </div>
                          
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                <div class="notification-container">
                                
                                     @include('layouts.notifications')
                            
                                </div>
                                </ul>

                            </li>
                            <li class="footer">
                                @if(App\Http\Models\Notifications::get_mine(Auth::id())->count())
                                <a href="{{ url('notifications') }}">View All Notifications</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')
                    @else
                    <!-- Tasks -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <i class="material-icons">flag</i>
                                @if( App\Http\Models\Notifications::task_count(Auth::id()))
                                <span class="label-count task-label" style="background-color: #bf1717;">{{ App\Http\Models\Notifications::task_count(Auth::id()) }}</span>
                                @endif
                            </a>
                             <ul class="dropdown-menu">
                                <li class="header">TASKS </li>
                                <li class="body">
                                    <ul class="menu tasks">
                                    <div class="task-container">
                                
                                       @include('layouts.tasks')
                                   
                                    </div>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <!-- <a href="javascript:void(0);">View All Tasks</a> -->
                                </li>
                            </ul>
                        </li>
                    <!-- #END# Tasks -->
                     @endif
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
         
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                   
                        @if(!Auth::user()->photo)
                         <img src="{{ asset('admin-assets/images/user.png') }}" width="60" height="60" alt="User" style="border: 1px solid #d2d2d2;" />
                        @else
                         <img  src="{{ asset('storage/avatars') }}/{{ Auth::user()->photo }}"  width="60" height="60" alt="User" style="border: 1px solid #d2d2d2;" />
                        @endif

                </div>
                <div class="info-container" style="top: 13px;">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="max-width: 160px;">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>

                    <div class="btn-group user-helper-dropdown" style="right: -12px; color: #888888;">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ url('manage-accounts/name') }}">Name</a></li>
                            <li><a href="{{ url('manage-accounts/profile-picture') }}">Profile Picture</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="{{ url('manage-accounts/email') }}">Email</a></li>
                            <li><a href="{{ url('manage-accounts/username') }}">Username</a></li>
                            <li><a href="{{ url('manage-accounts/password') }}">Password</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="{{ url('logout') }}"><i class="material-icons">logout</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            @include('layouts.menu')
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; {{ env('COPYRIGHT') }} <a href="javascript:void(0);">{{ env('PROJECT_TITLE') }} - {{ env('PROJECT_DESCRIPTION') }}</a>.
                </div>
                <div class="version">
                    <b>Version: </b> {{ env('VERSION') }}
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="{{ $color[4] == 'red' ?  'active' : '' }}">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="blue" class="{{ $color[4] == 'blue' ?  'active' : '' }}" >
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="green" class="{{ $color[4] == 'green' ?  'active' : '' }}" >
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <!-- <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li> -->
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>NOTIFICATION SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Email</span>
                                <div class="switch">
                                    <label><input type="checkbox" class="gmail_notification" {{ Auth::user()->gmail_notification ? 'checked' : '' }} ><span class="lever" ></span></label><!-- data-toggle="modal" data-target="#eMailNotification" -->
                                </div>
                            </li>
                            <li>
                                <span>Facebook Messanger</span>
                                <div class="switch">
                                    <label><input type="checkbox" ><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Name</span>
                                <div class="switch">
                                    <label><a  class="waves-effect" href="{{ url('manage-accounts/name') }}"><i class="material-icons">edit</i></a></label>
                                </div>
                            </li>
                            <li>
                                <span>Profile Picture</span>
                                <div class="switch">
                                    <label><a  class="waves-effect" href="{{ url('manage-accounts/profile-picture') }}"><i class="material-icons">edit</i></a></label>
                                </div>
                            </li>
                             <li>
                                <span>Email</span>
                                <div class="switch">
                                    <label><a  class="waves-effect" href="{{ url('manage-accounts/email') }}"><i class="material-icons">edit</i></a></label>
                                </div>
                            </li>
                            <li>
                                <span>Username</span>
                                <div class="switch">
                                    <label><a  class="waves-effect" href="{{ url('manage-accounts/username') }}"><i class="material-icons">edit</i></a></label>
                                </div>
                            </li>
                            <li>
                                <span>Password</span>
                                <div class="switch">
                                    <label><a  class="waves-effect" href="{{ url('manage-accounts/password') }}"><i class="material-icons">edit</i></a></label>
                                </div>
                            </li>
                            <li>
                                <span>Sign Out</span>
                                <div class="switch">
                                    <label><a  class="waves-effect" href="{{ url('logout') }}"><i class="material-icons">logout</i></a></label>
                                </div>
                            </li>
                        </ul>

                        @if(Auth::user()->dual_account == 1)
                        <p>ADMINISTRATOR ACCOUNT</p>
                        <ul class="setting-list">
                            <li>
                                <span>Activate</span>
                                <div class="switch">
                                    <label><input type="checkbox" class="activate_admin" {{ Auth::user()->role == 'admin' ? 'checked' : '' }}><span class="lever"></span></label>
                                </div>
                            </li>
                           
                        </ul> 
                        @endif
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
           <!--  <div class="block-header">
                <h2>BLANK PAGE</h2>
            </div> -->

  

            @yield('content')
        </div>
    </section>


   <div class="modal fade" id="eMailNotification" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            
             <form method="POST" novalidate="novalidate" action="{!! url('settings/send-verification-code') !!}">                       
              {!! csrf_field() !!}
                <div class="modal-header">
                    <h4 class="modal-title" id="eMailNotificationLabel">Verify Email Account.</h4>
                </div>
                <div class="modal-body">
                   
               
                    <div class="msg">
                        We have sent a temporary verification code to <b>{!! Auth::user()->email !!}</b>. Enter the code to verify this email address.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="code" placeholder="Enter Code" required autofocus  autocomplete="off">
                        </div>
                        <label id="code-error" class="error" ></label>
                    </div>

                 <!--    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET MY PASSWORD</button> -->

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="sign-in.html">Send a new code.</a>
                    </div>
                

                </div>
                <div class="modal-footer align-center">
                    <button type="submit" class="btn btn-link waves-effect">VERIFY CODE</button>
                    <button type="button" class="btn btn-link waves-effect" id="email-setting-close">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>


     @yield('for_modal')

     <script type="text/javascript">
         var public_url = "{{ asset('/') }}";
     </script>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin-assets/js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('admin-assets/js/demo.js') }}"></script>

    <!-- Apprise Js -->
    <script src="{{ asset('admin-assets/js/apprise.js') }}"></script>


    @if(Session::has('msg'))
         <script type="text/javascript">
            $('.appriseInner button').click();

            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">{{Session::get('msg')}}</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>');

        </script>
    @endif
   
    @yield('scripts')

    @yield('modal_scripts')


     <script type="text/javascript">
    
     //$('.notification-count').hide();
      notification_count = "{{ App\Http\Models\Notifications::unseen(Auth::id()) }}";
     
       setInterval(function() {
        
           $.ajax({
            url: '{{ url("notifications/list") }}',
            type:'POST',
            data:  {'_token':'{{ csrf_token() }}'},
            async: false,
            success: function(data)
                {
                 $('.notification-container').html('');
                 $('.notification-container').html(data.html);
                 $('.notification-count').html('');
            
                //console.log(notification_count+"-"+data.count);
         
                if(notification_count != data.count){
                   // ion.sound.play("door_bell");
                    audio.src = source;
                }
                notification_count = data.count;
                 if(data.count != 0){
                    $('.notification-count').html('<span class="label-count notification-count">'+notification_count+'</span>');
                 }     
                }
            });

        }, 5000); 
        //60000
    
            // ion.sound({
            //     sounds: [
            //         {name: "door_bell"}
            //     ],
            //     path: "{{ asset('admin-assets/sounds/') }}/",
            //     preload: true,
            //     volume: 1.0
            // });

             var source = "{{ asset('admin-assets/sounds/door_bell.mp3') }}";
             var audio = document.createElement("audio");
             //
             audio.autoplay = true;
             //
             audio.load()
             audio.addEventListener("load", function() { 
                 audio.play(); 
             }, true);
            // audio.src = source;
           


        $('.notifications').on('click',function(){
             $.ajax({
                url: '{{ url("notifications/seen") }}',
                type:'POST',
                data:  {'_token':'{{ csrf_token() }}'},
                async: false,
                success: function(data)
                    {
                      if(data.success){
                        setTimeout(function() {
                            $('.notification-container').find('li').removeClass('unseen');
                            $('.notification-container').find('li').addClass('seen');
                            $('.notification-count').html('');
                            notification_count = 0;
                        }, 1000);
                      
                      }
                    }
                });
        });


        $('.demo-choose-skin li').on('click',function(){
            selected_theme = $(this).data('theme');
            $.ajax({
                url: '{{ url("settings/change-theme") }}',
                type:'POST',
                data:  {'_token':'{{ csrf_token() }}','theme':selected_theme},
                async: false,
                success: function(data)
                    {
                        location.reload(true);
                    }
                });
        });


        $('input.gmail_notification').on('click',function(){
            var gmail_settings = 'off';
            if($('input.gmail_notification').is(':checked')){
                 gmail_settings = 'on';
            }

             $.ajax({
                url: '{{ url("settings/gmail-notification") }}/'+gmail_settings,
                type:'POST',
                data:  {'_token':'{{ csrf_token() }}','setting':gmail_settings},
                async: false,
                success: function(data)
                    {
                    
                       if(data.success){

                            if(data.switch == 'off'){
                                 $('.appriseInner button').click();
                                 apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">'+data.msg+'</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>');
                            }else{

                                $('#eMailNotification').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });

                            }
                       }
                    }
                });

        });

        $('#email-setting-close').on('click',function(){
           $('#eMailNotification').modal('hide');
           $('.gmail_notification').prop('checked', false); 
        });

        

        $('input.activate_admin').on('click',function(){
          
              $('.appriseInner button').click();
              apprise("<i><b><font color='grey'>Switching Account Role  <br> <center>Please Wait...</center></font></b></i><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
              $('.aButtons').hide();

            var activate_admin = 'off';
            if($('input.activate_admin').is(':checked')){
                 activate_admin = 'on';
            }

             $.ajax({
                url: '{{ url("/manage-accounts/admin") }}/'+activate_admin,
                type:'POST',
                data:  {'_token':'{{ csrf_token() }}','setting':activate_admin},
                async: false,
                success: function(data)
                    {
                    
                    setTimeout(function() {
                         window.location = data.url;
                    }, 1000); 
    
                    }
                });

        });





    </script>



</body>

</html>