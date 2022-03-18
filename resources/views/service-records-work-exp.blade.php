@extends('layouts.app')
@section('title','SERVICE RECORD CERTIFICATION')

@section('content')


        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>
                    ACCOUNTS
                    <small>Taken from <a href="https://datatables.net/" >datatables.net</a></small>
                </h2> -->
            </div>
            <!-- Basic dataTableEditables -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                       
                            <h3>{!!  strtoupper(App\Http\Models\PersonalInformation::get_name($uid)) !!}</h3>
                            <small>SELECT A SERVICE RECORD FOR CERTIFICATION</small>
                            <!--<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                 <ul class="dropdown-menu pull-right">
                                            <li><a href="{{ url('reports/employees-gender-list/0') }}">All</a></li>
                                            <li><a href="{{ url('reports/employees-gender-list/1') }}">Male</a></li>
                                            <li><a href="{{ url('reports/employees-gender-list/2') }}">Female</a></li>
                
                                    </ul>
                                </li>
                            </ul>-->
                        </div>
                        <div class="body">
                            <div class="table-container">

                                <div class="table-responsive">
                                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                      <thead>
                                          <tr>
                                            <th><small>From</small></th>
                                            <th><small>To</small></th>
                                            <th><small>Designation</small></th>
                                            <th><small>Status</small></th>
                                            <th><small>Salary</small></th>
                                            <th><small>Station/Branch</th>
                                            <th width="12%"><small>W/out pay</small></th>
                                            <th width="10%"><small>Date/Cause</small></th>
                                            <th><small>Action</small></th>
                                          </tr>
                                      </thead>
                                      <tfoot>
                                          <tr>
                                            <th><small>From</small></th>
                                            <th><small>To</small></th>
                                            <th><small>Designation</small></th>
                                            <th><small>Status</small></th>
                                            <th><small>Salary</small></th>
                                            <th><small>Station/Branch</th>
                                            <th width="12%"><small>W/out pay</small></th>
                                            <th width="10%"><small>Date/Cause</small></th>
                                            <th><small>Action</small></th>
                                          </tr>
                                      </tfoot>
                                      <tbody>

                                            @foreach ($work_experience as $key => $value)
                                              <tr>
                                                <td><small>{!! date('m/d/Y', strtotime($value->inclusive_date_from)) !!}</small></td>
                                                <td><small>{!! ucwords($value->inclusive_date_to) !!}</small></td>
                                                <td><small>{!! ucwords($value->position_title) !!}</small></td>
                                                <td><small>{!! ucwords($value->status_of_appointment) !!}</small></td>
                                                <td><small>{!! number_format($value->service_record_salary ,2,'.', ',') !!}</small></td>
                                                <td><small>{!! ucwords($value->dept_agency_office_company) !!}</small></td>
                                                <td><small>{!! ucwords($value->pay) !!}</small></td>
                                                <td><small>{!! ucwords($value->cause) !!}</small></td>
                                                <td style="text-align: center;">
                                                  <a class="edit-function action-tag" href="{!! url('reports/service-record/certification/'.encrypt($value->id)) !!}"  data-toggle="tooltip" data-placement="top" title data-original-title="Use"> <!-- target="_blank" -->
                                                  <i class="material-icons {{ $color[3] }}">arrow_forward</i>
                                                  </a>
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
            <!-- #END# Basic dataTableEditables -->


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
td > input[type="checkbox"] {
  margin: 0px 0px 0px 0px !important;
  border: 1px solid black !important;
  opacity: 100 !important;
  left: 33px !important;
  cursor:pointer !important;
  vertical-align:middle;
}
tbody tr,tbody td {
  border:0px;
}
input[type=checkbox] {
  transform: scale(1.5);
}
input[type=checkbox] {
  width: 30px;
  height: 30px;
  margin-right: 8px;
  cursor: pointer;
  font-size: 17px;
  visibility: hidden;
}
input[type=checkbox]:after {
  content: " ";
  background-color: #fff;
  display: inline-block;
  margin-left: 0px;
  margin-top: 8px;
  padding-bottom: 0px;
  color: #059550;
  width: 10px;
  height: 10px;
  visibility: visible;
  border: 1px solid #059550;
  padding-left: 0px;
  border-radius: 2px;
}
input[type=checkbox]:checked:after {
  content: "\2713";
  padding: -5px;
  font-weight: bold;
  font-size:10px;
  line-height:71%;
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

    <script src="{{ asset('admin-assets/js/pages/ui/tooltips-popovers.js') }}"></script>

    <!--<script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/ui/tooltips-popovers.js') }}"></script> -->
 
    <!--<script src="{{ asset('admin-assets/plugins/editable-table/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/tables/editable-table.js') }}"></script>-->
               <!-- Custom Js -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.pagination li.active a').addClass('{{ $color[2] }}');
      });
    </script>
@endsection