@extends('layouts.app')
@section('title','REPORT - EMPLOYEES AGE RANGE (  '.$age.' )  YEARS OLD')


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
                                EMPLOYEES AGE RANGE <b class="{{ $color[3] }}"><span class="dynamic_title">( {!! $age !!} )</span></b>  YEARS OLD
                            </h2>
                          <!--   <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <button type="button" class="btn bg-red waves-effect" style="padding: 0px 20px 5px 19px">
                                            
                                             &nbsp; Select Employees Age Above
                                             <i class="material-icons">arrow_drop_down</i>
                                        </button>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                            <li><a href="{{ url('reports/employees-age-list/20') }}">20 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/25') }}">25 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/30') }}">30 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/35') }}">35 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/40') }}">40 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/45') }}">45 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/50') }}">50 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/55') }}">55 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/60') }}">60 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/65') }}">65 Years</a></li>
                                            <li><a href="{{ url('reports/employees-age-list/70') }}">70 Years</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
<!-- 
                                <div class="col-md-12">
                                    <p><b>Range Example</b></p>
                                    <div id="nouislider_range_example"></div>
                                    <div class="m-t-20 font-12"><b>Value: </b><span class="js-nouislider-value"></span></div>
                                 </div>
 -->
                           

                            <div class="body">
                               
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                    <p><b>Age Range</b></p>
                                    <br>
                                    <div id="nouislider_basic_example"></div>
                                        <input class="range-slider" type="hidden" value="{!! $from !!},{!! $to !!}"/>
                                    </div>
                                </div>
                                  <hr>
                            </div>
                                
                             <div class="table-container">
                                 @include('reports.employees-age-table')  

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

<link href="{{ asset('admin-assets/css/jquery.range.css') }}" rel="stylesheet">

<style type="text/css">
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
     <script src="{{ asset('admin-assets/plugins/jquery-datatable/jquery.dataTables.js') }}"></script> <!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script><!---->
    <script src="{{ asset('admin-assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/tables/jquery-datatable.js') }}"></script> 
 <script src="{{ asset('admin-assets/js/jquery.range-min.js') }}"></script> 


               <!-- Custom Js -->
  

    <script type="text/javascript">
       $(document).ready(function() {

          var dynamic_title = "( {!! $age !!} ";


             function renderTable(page) {
                  
                  $('.table-container').html('');
                  $('.table-container').append(page);
                   jquery_table();
                  //reLoadTable();

                  // var $request = $.get(page); 

                  // var $container = $('.table-container');

                  // $container.addClass('loading'); // add loading class (optional)

                  // $request.done(function(data) { // success
                  //    //console.log(data);
                  //     $container.html(data);
                     
                  // });
                  // $request.always(function() {
                  //     $container.removeClass('loading');
                  // });

                  // setTimeout(function() {
                  //   reLoadTable();
                  // }, 500);
             }


            $('body').on('change','.range-slider',function(){

              $('.appriseInner button').click();
              apprise("<i><b><font color='grey'>Loading information please wait ... </font></b></i><br><br><center> <img src={{ asset('admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif') }} width='20' height='20' /></center>");
              $('.aButtons').hide();

                range = $(this).val();
                 setTimeout(function() {
                     console.log(range);
                     $.ajax({
                        url: '{{ url("reports/employees/age/range") }}',
                        type: 'POST',
                        data: {'data': range,'_token':'{!! csrf_token() !!}'}, 
                        success: function(data)
                           {
                              $('.dynamic_title').text('( '+data.age+' )');
                              dynamic_title = data.age
                              $(document).attr("title", 'E-HRS | REPORT - EMPLOYEES AGE RANGE ( '+data.age+' )  YEARS OLD ');
                              $('a.navbar-brand').text('E-HRS | REPORT - EMPLOYEES AGE RANGE ( '+data.age+' )  YEARS OLD ');

                               history.pushState(null, null, public_url+'reports/employees/age/'+data.from+'/'+data.to);
                             
                               renderTable(data.html);
                               $('.appriseInner button').click();
                           }
                    });
                 }, 1000);
            });


            function jquery_table(){

             $('.range-slider').jRange({
                from: 15,
                to: 70,
                step: 1,
                scale: [15,20,25,30,35,40,45,50,55,60,65,70],
                format: '%s',
                width: 400,
                showLabels: true,
                isRange : true
            });


             $('#data-table-report').DataTable({

                dom: 'Bfrtip',
                   buttons: [
                  {
                        extend: 'copy',
                        title: function() {
                            return "EMPLOYEES AGE RANGE ( "+dynamic_title+" )  YEARS OLD";
                          },
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">format_list_bulleted</i> COPY </buttons> ',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'excel',
                        title: function() {
                            return "EMPLOYEES AGE RANGE ( "+dynamic_title+" )  YEARS OLD";
                          },
                        text: ' <buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">grid_on</i> Excel </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'pdf',
                        title: function() {
                            return "EMPLOYEES AGE RANGE ( "+dynamic_title+" )  YEARS OLD";
                          },
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">picture_as_pdf</i> PDF  </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },

                    },
                    {
                        extend: 'csv',
                        title: function() {
                            return "EMPLOYEES AGE RANGE ( "+dynamic_title+" )  YEARS OLD";
                          },
                        text: '<buttons class="btn {{ $color[2] }} waves-effect" style="padding: 1px 10px 6px 8px;"> <i class="material-icons">library_books</i> CSV </buttons>',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },
                    },
                    {
                        extend: 'print',
                        title: function() {
                             return "EMPLOYEES AGE RANGE ( "+dynamic_title+" )  YEARS OLD";
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
      
            }

            jquery_table();

             function reLoadTable(){

                    //reinitialize javascipt
                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/jquery.dataTables.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/jszip.min.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js";///
                    // docHeadObj.appendChild(newScript);

                    // var docHeadObj = document.getElementsByTagName("head")[0];
                    // var newScript= document.createElement("script");
                    // newScript.type = "text/javascript";
                    // newScript.src = public_url+"admin-assets/js/pages/tables/jquery-datatable.js";///
                    // docHeadObj.appendChild(newScript);

                    jquery_table();




                    }
        });

        $(document).ready(function(){
          $('.pagination li.active a').addClass('{{ $color[2] }}');
        });
   </script>

@endsection
