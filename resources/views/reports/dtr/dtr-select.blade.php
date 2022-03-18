@extends('layouts.app')
@section('title','REPORT - EMPLOYEES AGE RANGE  YEARS OLD')


@section('content_header')

@stop

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
                              <b> DAILY TIME RECORD </b>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                               
                            </ul>
                        </div>
                        <div class="body">
                           <div class="row"> 
                             <form action="{{url('employee-biometric-attendance/data')}}" class="form-validate" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate" target="_blank">
                              @csrf

                                  <div class="col-sm-4">
                                      <!-- Default box -->
                                     <div class="box">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">{{ $user->name }}</h3>
                                        </div>
                                        <ul class="nav nav-pills nav-stacked">
                                         
                                            <li >
                                              <small>generate report from date range.</small>
                                            </li>
                                          
                                        </ul>

                                      </div>
                                    </div>


                                    <div class="col-sm-8">
                                      <!-- Default box -->
                                      <div class="box">
                                        <div class="box-header">
                                          <h3 class="box-title">Date Range Reports</h3>
                                        </div>
                                        <div class="box-body">

                                          <div class="form-group" >
                                            <label for="range">Date range:</label>
                                            <input type="text" class="form-control" name="range" id="range" required  autofocus="" value="{{ $current_month }}" style="border: solid 1px;padding: 11px;;">
                                            <em id="range-error" class="error help-block"></em>
                                          </div>

                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->


                                     <div class="box">
                                        <div class="box-footer ">
                                          <input type="hidden" name="uid" value="{{ encrypt($user->id) }}">
                                          <button type="submit" class="btn btn-flat btn-primary float-right">Generate Report</button>
                                        </div>
                                        <!-- /.box-footer-->

                                      </div>

                                    </div>

                                   <div class="col-sm-12" >
                                        <!-- Default box -->
                                   
                                    <!-- /.box -->
                                  </div>

                                </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>

@stop
@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/smoothness-jquery-ui.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/MonthPicker.css') }}" />

<style type="text/css">
  .table-condensed thead tr:nth-child(2),
    .table-condensed tbody {
      display: none
    }
  .daterangepicker select.yearselect {
    width: 52%;
    }

</style>
@stop

@section('scripts')

<script src="{{ asset('admin-assets/js/montly-jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/montly-jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/MonthPicker.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function() {
  $('#range').MonthPicker({ MaxMonth: 0 ,Button: false });
});


</script>
@stop
