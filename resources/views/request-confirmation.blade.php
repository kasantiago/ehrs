<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>END USER LICENSE AGREEMENT</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('DOH.ico') }}" type="image/x-icon">

     <!-- Google Fonts -->
    <link href="{{ asset('admin-assets/css/googleapis.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin-assets/css/fonts.googleapis.css') }}" rel="stylesheet" type="text/css">
   
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin-assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">

    <style type="text/css">
        p { font-size:16px;text-align: justify;text-justify: inter-word; }
    </style>

</head>

<body style="margin-top: 30px;">
   
    <div class="container-fluid">
        
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1">
      
        <div class="card">
            <div class="header">
                <center><h1>REQUEST FOR APPROVAL</h1></center>
                <!-- <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                 
                    </li>
                </ul> -->
            </div>
            <div class="body">

                <div class="eula-modal-content">
                    <div class="button-demo">

                        <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
                        normal;text-align:center;'>Human Resource Unit / Administrator would like to access your <b>Personal Data Sheet</b>. Please press approve if you approved our request or vice versa.</p>
                    
                        <br>

                        <center>
                             <form method="POST" novalidate="novalidate" action="{{ url('personal-data-sheet-table/confirm') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="thread_id" value="{{$thread_id}}">
                                <button type="submit" name="response" value="approve" class="btn btn-success waves-effect">APPROVE</button>
                                <button type="submit" name="response" value="disapprove" class="btn btn-danger waves-effect">DISAPPROVE</button>
                             </form>
                        </center>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/node-waves/waves.js') }}"></script>
</body>

</html>
    

