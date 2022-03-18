@extends('layouts.app')
@section('title','REPORT - EMPLOYEES GENDER ( '.$gender_name.')')


@section('content')


        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>
                    ACCOUNTS
                    Taken from <a href="https://datatables.net/" >datatables.net</a>
                </h2> -->
            </div>

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EMPLOYEES LIST Filtered by: <b>Gender - <b class="{{ $color[3] }}">( {!! $gender_name !!} )</b> | Column - <b class="{{ $color[3] }}">( {!! strtoupper($column) !!} )</b> | Text - <b class="{{ $color[3] }}">( {!! strtoupper($columndata) !!} )</b></b>
                            </h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <button type="button" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 20px 5px 19px">
                                            
                                             &nbsp; Select Employees Gender
                                             <i class="material-icons">arrow_drop_down</i>
                                        </button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                            <li><a href="{{ url('reports/employees/gender/0') }}">All</a></li>
                                            <li><a href="{{ url('reports/employees/gender/1') }}">Male</a></li>
                                            <li><a href="{{ url('reports/employees/gender/2') }}">Female</a></li>
                
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form method="POST" id="form_validation" action="{!! url('reports/employees-list/') !!}">
                                {!! csrf_field() !!}

                                <div class="col-sm-12">
                                    <h4>Filter by:</h4>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="gender" required>
                                        <option value="" selected disabled>-- Select Gender --</option>
                                        <option value="0">All</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="column" required>
                                        <option value="" selected disabled>-- Select a Column --</option>
                                        <option value="all">All</option>
                                        <option value="name">Name</option>
                                        <option value="level">Level</option>
                                        <option value="employee_status">Employee Status</option>
                                        <option value="division">Division</option>
                                        <option value="position">Position</option>
                                        <option value="civil_status">Marital Status</option>
                                        <option value="birthday">Birthday</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="columndata">
                                            <label class="form-label">Search</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn waves-effect {{ $color[2] }}" type="submit"><i class="material-icons">search</i></button>
                                </div>
                                </form>
                            </div>
                            <hr>
                            <div class="table-container">

                                  <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover data-table-report  dataTable" id="data-table-report"  style="width:100%">
                                        <thead>
                                            <tr>
                                                <th >Name</th>
                                                <th >Level</th>
                                                <th >Status</th>
                                                <th >Dept</th> 
                                                <th >Position</th>
                                                <th >Gender</th>
                                                <th >Marital Status</th>
                                                <th >Birthday</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th >Name</th>
                                                <th >Level</th>
                                                <th >Status</th>
                                                <th >Dept</th> 
                                                <th >Position</th>
                                                <th >Gender</th>
                                                <th >Marital Status</th>
                                                <th >Birthday</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($report_data as $key => $value)
                                            <tr class="data">
                                                <td><small>{!! App\Http\Models\PersonalInformation::get_name($value->id) !!}</small></td>
                                                <td><small>{!! $value->level!!}</small></td>
                                                <td><small>{!! strtoupper($value->employee_status) !!}</small></td>
                                                <td><small>{!! strtoupper($value->division) !!}</small></td> 
                                                <td><small>{!! strtoupper($value->position) !!}</small></td>
                                                <td><small>
                                                    {!! $value->gender == 0 ? '<span class="col-light-red">UPDATING...</span>' : '' !!}
                                                    {!! $value->gender == 1 ? 'MALE' : '' !!}
                                                    {!! $value->gender == 2 ? 'FEMALE' : '' !!}
                                                </small></td>
                                                <td><small>
                                                    {!! $value->civil_status == 0 ? '<span class="col-light-red">UPDATING...</span>' : '' !!}
                                                    {!! $value->civil_status == 1 ? 'SINGLE' : '' !!}
                                                    {!! $value->civil_status == 2 ? 'WIDOWED' : '' !!}
                                                    {!! $value->civil_status == 3 ? 'MARRIED' : '' !!}
                                                    {!! $value->civil_status == 4 ? 'SEPARATED' : '' !!}
                                                    {!! $value->civil_status == 5 ? 'OTHER/S' : '' !!}
                                                </small></td>
                                                <td><small>{!! date('m/d/Y', strtotime($value->birthday)) !!}</small></td>
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
<!--  <link href="{{ asset('/css/dataTable.css') }}" rel="stylesheet">  -->

<link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

<style type="text/css">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        padding: 15px;
        margin: auto; /* margin you want for the content */
    }

    .dataTables_wrapper .dt-buttons a.dt-button {
        background-color: transparent;
        box-shadow: 0 0px 0px rgba(0, 0, 0, 0), 0 0px 0px rgba(0, 0, 0, 0);
        padding: 7px 1.1px !important;
    }
    .table-bordered > thead > tr th{
        border-bottom: 1px solid #000 !important;
    }
    table.table-bordered.dataTable {
        border-collapse: separate !important;
        border: #fff;
    }
    .table-bordered thead tr th ,.table-bordered tfoot tr th   {
        padding: 10px;
        border: 1px solid #fff;
    }
    .table-bordered > tfoot > tr th{
        border-top: 1px solid #000 !important;
    }
    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
        border-bottom-width: 0;
        border-top: 1px solid #000 !important;
    }
    .table-bordered thead tr th, .table-bordered tfoot tr th {
        padding: 0px;
        border: 1px solid #fff;
    }
    .table-bordered tbody tr td, .table-bordered tbody tr th {
        padding: 1px;
        border: 1px solid #eee;
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
    <!-- Custom Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>



   <script type="text/javascript">
       $(document).ready(function() {

             $('#data-table-report').DataTable({

                dom: 'Bfrtip',
                   buttons: [
                  {
                        extend: 'copy',
                        title: function() {
                            return "EMPLOYEES LIST Filtered by: Gender - ( {!! $gender_name !!} ) | Column - ( {!! strtoupper($column) !!} ) | Text - ( {!! strtoupper($columndata) !!} )";
                          },
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">format_list_bulleted</i> COPY </buttons> ',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'excel',
                        title: function() {
                            return "EMPLOYEES LIST \n Filtered by: Gender - ( {!! $gender_name !!} ) | Column - ( {!! strtoupper($column) !!} ) | Text - ( {!! strtoupper($columndata) !!} )";
                          },
                        text: ' <buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">grid_on</i> Excel </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'pdf',
                        title: function() {
                            return "EMPLOYEES LIST \n Filtered by: Gender - ( {!! $gender_name !!} ) | Column - ( {!! strtoupper($column) !!} ) | Text - ( {!! strtoupper($columndata) !!} )";
                          },
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">picture_as_pdf</i> PDF  </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },

                    },
                    {
                        extend: 'csv',
                        title: function() {
                            return "EMPLOYEES LIST \n Filtered by: Gender - ( {!! $gender_name !!} ) | Column - ( {!! strtoupper($column) !!} ) | Text - ( {!! strtoupper($columndata) !!} )";
                          },
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">library_books</i> CSV </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },
                    },
                    {
                        extend: 'print',
                        title: function() {
                            return "EMPLOYEES LIST <br> Filtered by: Gender - ( {!! $gender_name !!} ) | Column - ( {!! strtoupper($column) !!} ) | Text - ( {!! strtoupper($columndata) !!} )";
                          }, 
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">local_printshop</i> PRINT </buttons><br><br>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },
                         customize: function ( win ) {
                            $(win.document.body).find('h1').css('font-size', '12pt');
                            $(win.document.body).find('h1').css('text-align', 'center');
                            $(win.document.body).css( 'font-size', '8pt' );
                            $(win.document.body).find('table' ).addClass( 'compact' ).css( 'font-size', 'inherit' );
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                              // $(win.document.body).find('.table-bordered > thead > tr th' ).css('border', ' 1px solid #fff !important;' );
                              // $(win.document.body).find('.table-bordered  th' ).css('border-bottom', ' 1px solid #000 !important;' );
                              // $(win.document.body).find('.table-bordered  th' ).css('border-top', ' 1px solid red !important;' );
                              // $(win.document.body).find('.table-bordered  th' ).css('background', '#000  !important;' )
                              
                         }
                    }
                    ]
                     
                });
      
        });

        $(document).ready(function(){
            $('.pagination li.active a').addClass('{{ $color[2] }}');
        });
   </script>


@endsection
