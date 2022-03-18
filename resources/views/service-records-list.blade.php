@extends('layouts.app')
@section('title','SERVICE RECORDS')

@section('content')


        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>
                    ACCOUNTS
                    <small>Taken from <a href="https://datatables.net/" >datatables.net</a></small>
                </h2> -->
            </div>
            <!-- Basic dataTableEditables -->
          <form method="POST" novalidate="novalidate" action="{!! url('reports/pdf/service-record') !!}" target="_blank">
            {!! csrf_field() !!}
            <input type="hidden" name="uid" value="{{ encrypt($uid) }}">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                       
                            <h3>{!!  strtoupper(App\Http\Models\PersonalInformation::get_name($uid)) !!}</h3>
                            <h2>{{  strtoupper($title) }}</h2>

                            <hr>

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-xs-6">

                                  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')

                                    <button type="submit" name="option" value="service_record" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;">
                                      &nbsp; Service Record &nbsp; <i class="material-icons">file_download</i>
                                    </button>

                                    <button type="submit" name="option" value="work_experience" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;">
                                      &nbsp; Work Experience &nbsp; <i class="material-icons">file_download</i>
                                    </button>

                                  @else

                                    <button type="submit" name="option" value="work_experience" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;">
                                      &nbsp; Work Experience &nbsp; <i class="material-icons">file_download</i>
                                    </button>
                                    
                                  @endif

                                </div>

                                <div class="col-xs-6" align="right">
                                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <button type="button" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;">
                                    &nbsp; Select Type
                                    <i class="material-icons">arrow_drop_down</i>
                                  </button>
                                  </a>
                                  <ul class="dropdown-menu pull-right" style="z-index: 1;">
                                    <li><a href="{{ url('reports/service-record/list/all/'.encrypt($uid)) }}">All</a></li>
                                    <li><a href="{{ url('reports/service-record/list/y/'.encrypt($uid)) }}">Government</a></li>
                                    <li><a href="{{ url('reports/service-record/list/n/'.encrypt($uid)) }}">Non Government</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                        </div>
                        
                        <div class="body">
                            <div class="table-container">

                                   <div class="table-responsive">
                                     <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                        <thead>
                                            <tr>
                                               <th width="3%"><!-- <input type="checkbox" name="select_all" value="1" id="dataTableEditable-select-all"> --></th>
                                               <th><small>From</small></th>
                                               <th><small>To</small></th>
                                               <th><small>Designation</small></th>
                                               <th><small>Status</small></th>
                                               <th><small>Salary</small></th>
                                               <th><small>Station/Branch</small></th>
                                               <th width="12%"><small>W/out pay</small></th>
                                               <th width="10%"><small>Date/Cause</small></th>
                                               <th><small>Action</small></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td width="3%"></td>
                                               <th><small>From</small></th>
                                               <th><small>To</small></th>
                                               <th><small>Designation</small></th>
                                               <th><small>Status</small></th>
                                               <th><small>Salary</small></th>
                                               <th><small>Station/Branch</small></th>
                                               <th width="12%"><small>W/out pay</small></th>
                                               <th width="10%"><small>Date/Cause</small></th>
                                               <th><small>Action</small></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                              @foreach ($work_experience as $key => $value)
                                                <tr class="we-{{$value->id}}">

                                                    <td><input type="checkbox" checked name="id[]" value="{!! encrypt($value->id) !!}" class="{{ $color[3] }}" /></td>
                                                    <td><small>{!! date('m/d/Y', strtotime($value->inclusive_date_from)) !!}</small></td>
                                                    <td><small>{!! ucwords($value->inclusive_date_to) !!}</small></td>
                                                    <td><small>{!! ucwords($value->position_title) !!}</small></td>
                                                    <td><small>{!! ucwords($value->status_of_appointment) !!}</small></td>
                                                    <td><small class="service_record_salary">{!! number_format($value->service_record_salary ,2,'.', ',')  !!}</small></td>
                                                    <td><small>{!! ucwords($value->dept_agency_office_company) !!} / {!! ucwords($value->agency_type) !!}</small></td>
                                                    <td><small class="pay">{!! ucwords($value->pay) !!}</small></td>
                                                    <td><small class="cause">{!! ucwords($value->cause) !!}</small></td>
                                                    <td>    
                                                      <center>
                                                        <a class="edit-function action-tag data-{{$value->id}}"
                                                              data-id="{!! encrypt($value->id) !!}"
                                                              data-service_record_salary="{!! number_format($value->service_record_salary ,2,'.', ',')  !!}"
                                                              data-pay="{!! ucwords($value->pay) !!}"
                                                              data-cause="{!! ucwords($value->cause) !!}"
                                                        >
                                                          <i class="material-icons {{ $color[3] }}" data-toggle="tooltip" data-placement="top" title data-original-title="Edit User">mode_edit</i>
                                                       </a>
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
          </form>

    <!-- #END# Basic dataTableEditables -->
        </div>
    
  

        <!-- Small Size -->
      <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="smallModalLabel">Update Service Record</h4>
                  </div>

                  <form id="updateForm" method="POST" novalidate="novalidate" action="{{ url('reports/service-record/update') }}">
                  <div class="modal-body">
                            
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">

                     <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="service_record_salary" class="form-control money all-caps">
                            <label class="form-label">Salary</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="pay" class="form-control all-caps">
                            <label class="form-label">W/out pay</label>
                        </div>
                    </div>
                   
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="cause" class="form-control all-caps">
                            <label class="form-label">Date/Cause</label>
                        </div>
                    </div>              
                            
                            
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-link waves-effect submit-form">SAVE CHANGES</button> 
                      <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                  </div>
                  </form>
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
    width: 10px;
    height: 10px;
    visibility: visible;
    border: 1px solid;
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

    <script src="{{ asset('admin-assets/js/jquery.allmask.min.js') }}"></script>

    <script type="text/javascript">
      $(document).ready(function(){
                $('.money').mask('000,000,000,000,000.00', {reverse: true});

                function all_caps(){
                    $('.all-caps').bind('keyup blur',function(){ 
                     $(this).val($(this).val().toUpperCase());
                    });
                }
                 all_caps();



                   $('#updateForm').submit(function(e) {

                        $('#smallModal').modal('hide');


                        $('#smallModal').on('hidden.bs.modal', function () {
                            
                             $('.appriseInner button').click();

                             apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
                               $('.aButtons').hide(); 
                        });

                       

                          var form = $(this);
                             $.ajax({
                                      url: form.attr("action"),
                                      type: form.attr("method"),
                                      data: form.serialize(), 
                                      success: function(data)
                                         {
                                          setTimeout(function() {$('.appriseInner button').click();}, 500);
                                      
                                            if(data.success == true){     

                                                $('.we-'+data.data.id).css('background-color','#D1FACD');
                                      
                                                $('.we-'+data.data.id).find(".service_record_salary").text(data.data.service_record_salary);
                                                $('.data-'+data.data.id).data('service_record_salary',data.data.service_record_salary);
                                                
                                                $('.we-'+data.data.id).find(".pay").text(data.data.pay);
                                                $('.data-'+data.data.id).data('pay',data.data.pay);
                                                
                                                $('.we-'+data.data.id).find(".cause").text(data.data.cause);
                                                $('.data-'+data.data.id).data('cause',data.data.cause);

                                                setTimeout(function() {

                                                    $('.we-'+data.data.id).css('background-color','#fff');

                                                    $('.odd').css('background-color','#f9f9f9');


                                                },  2000);
                                            }
                                         }

                                  });
                   
                           return false;
                      });
                 

                $('.edit-function').on('click',function(){

                      var id = $(this).data('id');
                      // var from = $(this).data('from');
                      // var from = $(this).data('from');
                      // var position_title = $(this).data('position_title');
                      // var status_of_appointment = $(this).data('status_of_appointment');
                      var service_record_salary = $(this).data('service_record_salary');
                      // var dept_agency_office_company = $(this).data('dept_agency_office_company');
                      var pay = $(this).data('pay');
                      var cause = $(this).data('cause');

                      $('#smallModal input[name="id"]').val(id);

                      $('#smallModal input[name="service_record_salary"]').val(service_record_salary);
                      if(service_record_salary){
                        $('#smallModal input[name="service_record_salary"]').parent().addClass('focused');
                      }else{
                        $('#smallModal input[name="service_record_salary"]').parent().removeClass('focused');
                      }
                      $('#smallModal input[name="pay"]').val(pay);
                      if(pay){
                        $('#smallModal input[name="pay"]').parent().addClass('focused');
                      }else{
                        $('#smallModal input[name="pay"]').parent().removeClass('focused');
                      }
                      $('#smallModal input[name="cause"]').val(cause);
                      if(cause){
                        $('#smallModal input[name="cause"]').parent().addClass('focused');
                      }else{
                        $('#smallModal input[name="cause"]').parent().removeClass('focused');
                      }

                      $('#smallModal').modal('toggle');
                });
         });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('.pagination li.active a').addClass('{{ $color[2] }}');
      });
    </script>
@endsection