@extends('layouts.app')
@section('title','DASHBOARD')

@section('content')

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DASHBOARD
                            </h2>
                           <!--  <ul class="header-dropdown m-r--5">
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
                            
                        @if(Auth::user()->role == 'admin')

                            <div class="row clearfix">
                                <!-- Donut Chart -->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" align="center">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Percentage by Employment Status (All)</h2>
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
                                            <div id="donut_chart" class="graph"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Donut Chart -->

                                <!-- Bar Chart -->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Percentage of PDS Progress (All)</h2>
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
                                            <div id="bar_chart" class="graph" style="z-index: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Bar Chart -->
                            </div>

                            <div class="row clearfix">
                                <!-- Task Info -->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="header {{ $color[2] }}">
                                            <h2>PERSONAL DATA SHEET</h2>
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
                                            <div class="table-responsive">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="demo-google-material-icon">
                                                                <div class="material-icons" style="float: left; margin-top: -5px;">info</div>
                                                                <div class="icon-name"><h5>&nbsp; LEGEND</h5></div>
                                                            </div>
                                                        </div>
                                                        <div class="body">
                                                                <h6>
                                                                    I. &nbsp; &nbsp; &nbsp; - &nbsp; &nbsp; PERSONAL INFORMATION
                                                                </h6>
                                                                <h6>
                                                                    II. &nbsp;&nbsp; &nbsp; - &nbsp; &nbsp; FAMILY BACKGROUND
                                                                </h6>
                                                                <h6>
                                                                    III. &nbsp;&nbsp; &nbsp;- &nbsp; &nbsp; EDUCATIONAL BACKGROUND
                                                                </h6>
                                                                <h6>
                                                                    IV. &nbsp;&nbsp; &nbsp;- &nbsp; &nbsp; CIVIL SERVICE ELIGIBILITY
                                                                </h6>
                                                                <h6>
                                                                    V. &nbsp; &nbsp; &nbsp;- &nbsp; &nbsp; WORK EXPERIENCE
                                                                </h6>
                                                                <h6>
                                                                    VI. &nbsp; &nbsp; - &nbsp; &nbsp; VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S
                                                                </h6>
                                                                <h6>
                                                                    VII. &nbsp; &nbsp;- &nbsp; &nbsp; LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED
                                                                </h6>
                                                                <h6>
                                                                    VIII. &nbsp; - &nbsp; &nbsp; OTHER INFORMATION
                                                                </h6>
                                                                <h6>
                                                                    IX. &nbsp; &nbsp; - &nbsp; &nbsp; SURVEY
                                                                </h6>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table class="table table-hover dashboard-task-infos table-striped table-hover js-basic-example dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th width="28%"><small>Name</small></th>
                                                            <th width="8%" class="fsize">I.</th>
                                                            <th width="8%" class="fsize">II.</th>
                                                            <th width="8%" class="fsize">III.</th>
                                                            <th width="8%" class="fsize">IV.</th>
                                                            <th width="8%" class="fsize">V.</th>
                                                            <th width="8%" class="fsize">VI.</th>
                                                            <th width="8%" class="fsize">VII.</th>
                                                            <th width="8%" class="fsize">VIII.</th>
                                                            <th width="8%" class="fsize">IX</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($pds as $key => $value)
                                                    
                                                    @if(App\Http\Models\PersonalInformation::get_name($value->user_id))
                                                        <tr>
                                                            <td width="28%">{!! App\Http\Models\PersonalInformation::get_name($value->user_id) !!}</td>
                                                            <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->personal_information !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->personal_information) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->personal_information !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->family_background !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->family_background) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->family_background !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->educational_background !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->educational_background) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->educational_background !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->civil_service_eligibility !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->civil_service_eligibility) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->civil_service_eligibility !!}%"></div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->work_experience !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->work_experience) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->work_experience !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->voluntary_work !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->voluntary_work) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->voluntary_work !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->learning_and_development !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->learning_and_development) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->learning_and_development !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->other_information !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->other_information) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->other_information !!}%"></div>
                                                                </div>
                                                            </td>
                                                                  <td>
                                                                <div class="progress" data-toggle="tooltip" data-placement="top" title data-original-title="{!! $value->survey !!}%">
                                                                    <div class="progress-bar {!! App\Http\Models\Dashboard::determine_progress_color($value->survey) !!}" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: {!! $value->survey !!}%"></div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @endif

                                                        @endforeach
                                                      <!--   <tr>
                                                            <td>2</td>
                                                            <td>Task B</td>
                                                            <td><span class="label bg-blue">To Do</span></td>
                                                            <td>John Doe</td>
                                                            <td>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                                </div>
                                                            </td>
                                                        </tr> -->

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            <!-- #END# Task Info -->
                            </div>

                            <div class="row clearfix">
                                <!-- Task Info -->
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="header {{ $color[2] }}">
                                            <b>BIRTHDAY CELEBRANTS THIS MONTH</b>
                                            <ul class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="{{ url('reports/employees/birthday/'.$month_now) }}">Proceed to Reports</a></li>
                                                        <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                                        <li><a href="javascript:void(0);">Something else here</a></li> -->
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-hover dashboard-task-infos">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Date</th>
                                                            <!-- <th>Progress</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @forelse ($bday as $key => $value)

                                                        <tr>
                                                            <td>{!! App\Http\Models\PersonalInformation::get_name($value->id) !!}</td>
                                                            <td>{!! date('m/d/Y', strtotime($value->birthday)) !!}</td>
                                                        </tr>

                                                    @empty

                                                        <tr> 
                                                             <td colspan="2" style="text-align: center; background-color: #F9F9F9;"><i>NO BIRTHDAY CELEBRANTS HAS BEEN FOUND.</i></td>   
                                                        </tr>

                                                    @endforelse
                                             
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Task Info -->
                                <!-- Browser Usage -->
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="header {{ $color[2] }}">
                                            <b>LIST OF RETIREES</b>
                                            <ul class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                       <li><a href="{{ url('reports/employees/age/60/'.$retirees_age) }}">Proceed to Reports</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                           
                                            <table class="table table-hover dashboard-task-infos">

                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                            <th>Dept</th>
                                                            <th>Age</th>
                                                            <!-- <th>Progress</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @forelse ($age as $key => $value)

                                                        <tr>
                                                            <td>{!! App\Http\Models\PersonalInformation::get_name($value->id) !!}</td>
                                                            <td>{!! strtoupper($value->employee_status) !!}</td>
                                                            <td>{!! strtoupper($value->division) !!}</td> 
                                                            <td>{!! $value->age !!}</td>
                                                        </tr>

                                                    @empty

                                                        <tr> 
                                                             <td colspan="4" style="text-align: center; background-color: #F9F9F9;"><i>NO RETIREES HAS BEEN FOUND.</i></td>   
                                                        </tr>

                                                    @endforelse

                                                    </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Browser Usage -->
                            </div>

                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="header {{ $color[2] }}">
                                            <h2>AUDIT TRAIL</h2>
                                            <ul class="header-dropdown m-r--5">
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="{{ url('reports/audit-trail/all') }}">View All</a></li>
                                                        <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                                        <li><a href="javascript:void(0);">Something else here</a></li> -->
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table class="table table-hover dashboard-task-infos">
                                                    <thead>
                                                        <tr>
                                                            <th>System Trail</th>
                                                            <th>Date/Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($audit as $key => $value)

                                                        <tr>
                                                            <td>{!! $value->name !!} <span class="{{ $color[1] }}">{!! $value->logs !!}</span></td>
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

                        @else

                            <div class="row clearfix">
                                <!-- Bar Chart -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>My Personal Data Sheet Progress</h2>
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
                                            <div id="bar_chart" class="graph" style="z-index: 1;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Bar Chart -->
                            </div>

                        @endif

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

<link href="{{ asset('admin-assets/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

<style type="text/css">
    .fsize {
        font-size:9px;
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

    <!-- Morris Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/morrisjs/morris.js') }}"></script>
 
    <script type="text/javascript">

        @if(Auth::user()->role == 'admin')
        
            $(function () {
                getMorris('bar', 'bar_chart');
                getMorris('donut', 'donut_chart');
            });

            function getMorris(type, element) {
                if (type === 'bar') {
                    var records_bar = jQuery.parseJSON('{!! $pds_progress !!}');

                    Morris.Bar({
                        element: element,
                        data: records_bar,
                        xkey: 'x',
                        ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'],
                        labels: ['I. Personal Information', 'II. Family Background', 'III. Educational Background', 'IV. Civil Service Eligibility', 'V. Work Experience', 'VI. Voluntary Work', 'VII. Learning & Development', 'VIII. Other Information', 'IX. Survey'],
                        barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(204, 51, 255)', 'rgb(0, 153, 51)', 'rgb(255, 102, 102)', 'rgb(51, 153, 255)', 'rgb(177, 31, 0)'],
                    });
                } else if (type === 'donut') {
                    var records_donut = jQuery.parseJSON('{!! $emp_status !!}');

                    Morris.Donut({
                        element: element,
                        data: records_donut,
                        colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(204, 51, 255)', 'rgb(0, 153, 51)', 'rgb(255, 102, 102)', 'rgb(51, 153, 255)', 'rgb(177, 31, 0)'],
                        formatter: function (y) {
                            return y + '%'
                        }
                    });
                }
            }

        @else

            $(function () {
                getMorris('bar', 'bar_chart');
            });

            function getMorris(type, element) {
                if (type === 'bar') {
                    var my_records_bar = jQuery.parseJSON('{!! $my_pds_progress !!}');

                    Morris.Bar({
                        element: element,
                        data: my_records_bar,
                        xkey: 'x',
                        ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'],
                        labels: ['I. Personal Information', 'II. Family Background', 'III. Educational Background', 'IV. Civil Service Eligibility', 'V. Work Experience', 'VI. Voluntary Work', 'VII. Learning & Development', 'VIII. Other Information', 'IX. Survey'],
                        barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(204, 51, 255)', 'rgb(0, 153, 51)', 'rgb(255, 102, 102)', 'rgb(51, 153, 255)', 'rgb(177, 31, 0)'],
                    });
                }
            }

        @endif

        $(document).ready(function(){
            $('.pagination li.active a').addClass('{{ $color[2] }}');
        });
    </script>

@endsection