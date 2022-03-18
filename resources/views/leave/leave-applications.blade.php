@extends('layouts.app')
@section('title','FOR APPROVAL')


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <!-- <h2>
            ACCOUNTS
            <small>Taken from <a href="https://datatables.net/" >datatables.net</a></small>
        </h2> -->
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                   
                    <h2>
                        FOR APPROVAL
                    </h2>
                  <!--   <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Department</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul> -->
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                         <thead>
                                <tr>
                                    <th width="10%">Date of Filing</th>
                                    <th width="15%">Name</th>
                                    <th width="10%">Type of Leave</th>
                                    <th width="10%">Leave Details</th>
                                    <th width="10%">Where will be Spent</th>
                                    <th width="10%">Numer of Days</th>
                                    <th width="20%">Inclusive Dates</th>
                                    <th width="15%"><center>Action</center></th>
                               
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="10%">Date of Filing</th>
                                    <th width="15%">Name</th>
                                    <th width="10%">Type of Leave</th>
                                    <th width="10%">Leave Details</th>
                                    <th width="10%">Where will be Spent</th>
                                    <th width="10%">Numer of Days</th>
                                    <th width="20%">Inclusive Dates</th> 
                                    <th width="15%"><center>Action</center></th>
                                  
                                </tr>
                            </tfoot>
                            <tbody>

                                @foreach ($application as $key => $value)

                                    <tr>
                                        <td><small>{!! date('m/d/Y', strtotime($value->date_of_filing)) !!}</small></td>
                                        <td><small>{!! $value->name !!}</small></td>
                                        <td><small>{!! ucwords($value->six_a_type_of_leave) !!}</small></td>
                                        <td><small>{!! ucwords($value->six_a_type_of_leave_data) !!}</small></td>
                                        <td><small>{!! ucwords($value->where_will_be_spent) !!}</small></td>
                                        <td><small><center>{!! ucwords($value->six_c_for) !!}</center></small></td>
                                        <td><small>{!! str_replace(',',', ',$value->six_c_inclusive_dates) !!}</small></td>

                                      
                                        <td valign="top|middle|bottom">
                                        <center style="font-size:10px;margin-top: 5px;margin-bottom:5px;">
                                 
                                            <a href="{{ url('leave-management/applications/'.encrypt($value->id).'/'.encrypt('approve')) }}" class="btn bg-green waves-effect">&nbsp;APPROVE&nbsp;</a> &nbsp;
                                            
                                            <a href="{{ url('leave-management/applications/'.encrypt($value->id).'/'.encrypt('decline')) }}" class="btn bg-red waves-effect">&nbsp;DECLINE&nbsp;</a>

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
@endsection

@section('styles')
    <!-- JQuery DataTable Css -->
<link href="{{ asset('admin-assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- Sweetalert Css -->
<link href="{{ asset('admin-assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

<link href="{{ asset('admin-assets/css/customized-styles.css') }}" rel="stylesheet">

<style type="text/css">
a.details {text-decoration: none !important;color: #000;cursor:pointer;}
a.details:hover { color: #000;}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    padding: 2px 0px 0px 8px !important;
}

.input-error {
  border: 1px solid #f50000;
}
.error-message {
  color: #cc0033;
  display: inline-block;
  font-size: 12px;
  line-height: 15px;
  margin: 5px 0 0;
}

.btn{
    padding:1px !important;
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
  
    </script>
@endsection