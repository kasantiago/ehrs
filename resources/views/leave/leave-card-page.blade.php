@extends('layouts.app')
@section('title','EMPLOYEES LEAVE CARD')

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
                                EMPLOYEES LEAVE CARD
                            </h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
                            <div class="table-container">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                        <thead>
                                            <tr>
                                              
                                                <th><small>Name</small></th>
                                                <th><small><center>Level</center></small></th>
                                                <th><small><center>Employee Status</center></small></th>
                                                <th><small><center>Division Section/Unit</center></small></th>
                                                <th><small><center>Position</center></small></th>
                                                <th><small><center>Action</center></small></th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               
                                                <th style="padding-right:30px;"><small>Name</small></th>
                                                <th style="padding-right:30px;"><small><center>Level</small></center></th>
                                                <th style="padding-right:30px;"><small><center>Employee Status</center></small></th>
                                                <th style="padding-right:30px;"><small><center>Division Section/Unit</center></small></th>
                                                <th style="padding-right:30px;"><small><center>Position</center></small></th>
                                                <th style="padding-right:30px;"><small><center>Action</center></small></th>

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           
                                            @foreach ($users as $key => $value)
                                            <tr class="data">
                                              
                                                <td style="padding:5px 0px 0px 5px" ><small>{{  App\Http\Models\PersonalInformation::get_name($value->id) }}</small></td>
                                                <td style="padding:5px 0px 0px 5px"><small><center>{{ $value->level }}</small></center></td>
                                                <td style="padding:5px 0px 0px 5px"><small><center>{{ strtoupper($value->employee_status) }}</small></center></td>
                                                <td style="padding:5px 0px 0px 5px"><small><center>{{ strtoupper($value->division) }}</small></center></td>
                                                <td style="padding:5px 0px 0px 5px"><small><center>{{ strtoupper($value->position) }}</small></center></td>
                                                <td style="width:12%;padding:5px 0px 0px 5px">
                                                <center>
                                                    <div class="u-{{$value->id}} all-users">

                                                        <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}" target="_blank">
                                                            <i class="material-icons {{ $color[3] }}">pageview</i>
                                                        </a>

                                                    </div>
                                                </center>
                                                </td>

                                            </tr>
                                            @endforeach
                                          
                                        </tbody>
                                    </table>

                                </div>

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

<style type="text/css">
   .dataTables_wrapper .dt-buttons a.dt-button {
    background-color: #f44336!important;
    padding: 7px 1.1px !important;
}
.bg-red-expt {
    background-color: #F44336 !important;
    color: #fff;
    padding: 0px 12px 0px 0px !important;
}
element.style {
}
.btn:not(.btn-link):not(.btn-circle):hover {
    outline: none;
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

    <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/ui/tooltips-popovers.js') }}"></script>
                <!-- Custom Js -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.pagination li.active a').addClass('{{ $color[2] }}');
      });
    </script>
@endsection