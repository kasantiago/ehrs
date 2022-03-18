@extends('layouts.app')
@section('title',App\Http\Models\PersonalInformation::get_name($user_id).' - LEAVE CARD')

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
                               {{  App\Http\Models\PersonalInformation::get_name($user_id) }} - LEAVE CARD
                            </h2>

                              <ul class="header-dropdown m-r--5">
                         
                        <!--           <a href="{{ url('account/create') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons {{ $color[3] }}" style="font-size:35px">note_add</i>
                                  </a> -->
                              </ul>


                          <!--   <ul class="header-dropdown m-r--5">
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

                              <div class="row clearfix">
                              
                                  <div class="col-sm-2">

                                    <div class="info-box bg-green hover-expand-effect">
                                      <div class="icon">
                                          <i class="material-icons">card_travel</i>
                                      </div>
                                      <div class="content">
                                          <div class="text">VACTION LEAVE</div>
                                          <div class="number count-to" data-from="0" data-to="{{ number_format($latest->vacation_balance,3) }}" data-speed="1000" data-fresh-interval="10">{{ number_format($latest->vacation_balance,3) }}</div>
                                      </div>
                                  </div>

                                </div>  

                                 <div class="col-sm-2">

                                    <div class="info-box bg-cyan hover-expand-effect">
                                      <div class="icon">
                                          <i class="material-icons">local_hospital</i>
                                      </div>
                                      <div class="content">
                                          <div class="text">SICK LEAVE</div>
                                          <div class="number count-to" data-from="0" data-to="{{ number_format($latest->sick_balance,3) }}" data-speed="1000" data-fresh-interval="10">{{ number_format($latest->sick_balance,3) }}</div>
                                      </div>
                                  </div>

                                    
                                  </div>


                                  <div class="col-sm-5">

                                    
                                  </div>
                                    
                               

                                  <div class="col-sm-1">
                                      <h4>Filter by:</h4>
                                  </div>

                                 <form method="POST" id="year_filter_form" action="{!! url('reports/employees-list/') !!}">
                                  {!! csrf_field() !!}

                                  <div class="col-sm-2">
                                      <select id="year_filter" class="form-control" name="years" required>
                                          <option value="" selected disabled>-- Select Year --</option>
                                          @foreach ($filter as $key => $value)
                                          <option value="{{$value}}" {{ ($selected_year == $value) ? 'selected' : '' }}>{{ucwords($value)}}</option>
                                          @endforeach
                                      </select>
                                  </div>

                                </form>

                            </div>


                              <a href="{{ url('leave-management/create/'.encrypt($user_id)) }}" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons {{ $color[3] }}" style="font-size:35px">note_add</i>
                              </a>

                               <a href="{{ url('account/create') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons {{ $color[3] }}" style="font-size:35px">print</i>
                              </a>
                            

                             <div class="table-container">

                        <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                            <thead>

                                <tr>
                                  
                                    <th width="20%"></th>
                                    <th width="10%"> <center>PARTICULARS <center></th>
                                    <th width="25%" colspan="4"> <center>VACATION LEAVE <center></th>
                                    <th width="25%" colspan="4"> <center>SICK LEAVE <center></th>
                                    <th width="20%" colspan="2"><small></small></th>
                                
                                </tr>

                                <tr>
                               
                                    <th><small>Period</small></th>
                                    <th><small>Bal. Brought Forward</small></th>
                                    <th><small>Earned</small></th>
                                    <th><small>Absence Undertime w/ Pay</small></th>
                                    <th><small>Balance</small></th>
                                    <th><small>Absence Undertime w/o Pay</small></th>
                                    <th><small>Earned</small></th>
                                    <th><small>Absence Undertime w/ Pay</small></th>
                                    <th><small>Balance</small></th>
                                    <th><small>Absence Undertime w/o Pay</small></th>
                                    <th colspan="2"><small>Remarks</small></th>
                                  </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="12"><small>&nbsp;</small></th>
                              
                                   
                                </tr>
                            </tfoot>
                           
                                        <tbody id="leave_card_data">

                                            @include('leave.leave-card-management-table')  


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

<link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

<style type="text/css">
a.details {text-decoration: none !important;color: #000;cursor:pointer;}
a.details:hover { color: #000;}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    padding: 2px 0px 0px 8px !important;
}
.bootstrap-select.btn-group .dropdown-toggle .filter-option {
    display: inline-block;
    overflow: hidden;
    width: 100%;
    text-align: left;
    left: 10px;
}

</style>
@endsection


@section('scripts')
  
<script src="{{ asset('admin-assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script type="text/javascript">


$(document).ready(function(){

     $('body').on('change','#year_filter',function(){

      $('#leave_card_data').html('');
       $('#leave_card_data').html('<td colspan="11"> <br> <center><b>Loading Data...</b></center> <br></td>');
          selected_year = $(this).val();
          url = "{{ url('leave-management/details/') }}/"+selected_year+"/"+"{{ encrypt($user_id) }}";

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url: url,
                    type: 'POST', 
                    success: function(data)
                       {
                       
                          $('#leave_card_data').html('');
                          $('#leave_card_data').html(data.html);

                      
                        history.pushState(null, null, url);

                       }
                });

              
        });

});

</script>
@endsection