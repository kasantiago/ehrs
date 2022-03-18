@extends('layouts.app')
@section('title','NOTIFICATIONS')


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
                                NOTIFICATIONS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-container">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover data-table-report  dataTable" id="data-table-report"  style="width:100%">
                                        <thead>
                                            <tr>
                                                
                                                <th>Notifications</th>
                                                
                                                <th>Date/Time</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                
                                                <th>Notifications</th>
                                               
                                                <th>Date/Time</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            @foreach($notifications as $key => $value)
                                                <tr>
                                                    <td> 
                                                            {!! $value->notification !!}
                                                    </td>
                                                    <th>{!! $value->created_at !!}</th>
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

<style type="text/css">
    .bg-expt {
        background-color: {{ $color[4] }};
        color: #fff;
        padding: 0px 15px 5px 15px !important;
    }
    .bg-expt:hover {
        background-color: {{ $color[3] }};
        color: #fff;
        padding: 0px 15px 5px 15px !important;
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

    <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>
               <!-- Custom Js -->

    <script type="text/javascript">
        $(document).ready(function() {

            $('#data-table-report').DataTable({

                "bSort" : false,

                dom: 'Bfrtip',
                    buttons: [
                    {
                        extend: 'copy',
                        title: function() {
         
                             return "NOTIFICATIONS";
                          
                          },
                        text: '<buttons class="btn bg-expt waves-effect"> <i class="material-icons">format_list_bulleted</i> COPY </buttons> ',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'excel',
                        title: function() {
                           
                             return "NOTIFICATIONS";
                          
                          },
                        text: ' <buttons class="btn bg-expt waves-effect"><i class="material-icons">grid_on</i> Excel </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'pdf',
                        title: function() {
                           
                             return "NOTIFICATIONS";
                        
                          },
                        text: '<buttons class="btn bg-expt waves-effect"> <i class="material-icons">picture_as_pdf</i> PDF  </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },

                    },
                    {
                        extend: 'csv',
                        title: function() {
                       
                             return "NOTIFICATIONS";
                          
                          },
                        text: '<buttons class="btn bg-expt waves-effect"><i class="material-icons">library_books</i> CSV </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },
                    },
                    {
                        extend: 'print',
                        title: function() {
                       
                             return "NOTIFICATIONS";
                         
                          }, 
                        text: '<buttons class="btn bg-expt waves-effect"><i class="material-icons">local_printshop</i> PRINT </buttons>',
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
            $('.pagination li.active a').addClass('{{ $color[0] }}');
        });
   </script>
@endsection
