@extends('layouts.app')
@section('title','EMPLOYEE BIOMETRIC ATTENDANCE')

@section('content')


        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>
                    ACCOUNTS
                    <small>Taken from <a href="https://datatables.net/" >datatables.net</a></small>
                </h2> -->
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EMPLOYEE BIOMETRIC ATTENDANCE
                            </h2>
                        </div>
                        <div class="body">

                            <div class="table-container">
                                 @include('employees-table')    
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
  

@endsection
@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- Sweetalert Css -->
    <link href="{{ asset('admin-assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/css/customized-styles.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('admin-assets/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <style type="text/css">
        a.details {text-decoration: none !important;color: #000;cursor:pointer;}
        a.details:hover { color: #000;}
        .bootstrap-select.btn-group .dropdown-toggle .filter-option {
            /*width: 120%;*/
        }
        .card .body .col-md-3 {
            margin-bottom: 0px;
        }
    </style>
@endsection
@section('scripts')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/tables/jquery-datatable.js') }}"></script>

    <!-- <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script> -->
    <script src="{{ asset('admin-assets/js/pages/ui/tooltips-popovers.js') }}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>

    <!-- Multi Select Custom Js -->
    <script type="text/javascript">
        //Multi-select
        $('#optgroup').multiSelect({ selectableOptgroup: true });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination li.active a').addClass('{{ $color[2] }}');
        });
    </script>

 

@endsection