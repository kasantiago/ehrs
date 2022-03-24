<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION </li>
        
        <li class="{{ (Request::segment(1) == 'dashboard' ? 'active' : '' ) }}">
            <a href="{{ url('/dashboard') }}">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
 


    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')


        <li class="{{ Request::segment(1) == 'accounts' || Request::segment(1) == 'account' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">supervisor_account</i>
                <span>Accounts</span>
            </a>
            <ul class="ml-menu">
                <li class="{{ Request::segment(1) == 'accounts' && Request::segment(2) == 'manage' ? 'active' : ''  }}">
                    <a href="{{ url('/accounts/manage') }}">Manage Accounts</a>
                </li>
                <li class="{{ Request::segment(1) == 'accounts' && Request::segment(2) == 'manage' ? 'active' : ''  }}">
                    <a href="{{ url('/accounts/for/approval') }}">For Approval</a>
                </li>
                <li class="{{ (Request::segment(1) == 'account' && Request::segment(2) == 'create' ? 'active' : '' ) }}">
                    <a href="{{ url('account/create') }}">Create Accounts</a>
                </li>

                <li class="{{ Request::segment(1) == 'accounts' && Request::segment(2) == 'employee-status' || Request::segment(1) == 'account' && Request::segment(2) == 'employee-status' ? 'active' : ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment_ind</i>
                        <span>Employees Status</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::segment(2) == 'employee-status' && Request::segment(3) == 'manage'  ? 'active' : ''  }}">
                            <a href="{{ url('accounts/employee-status/manage') }}"><font size="2px">Manage Employees Status</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'employee-status' && Request::segment(3) == 'create' ? 'active' : '' ) }}">
                            <a href="{{ url('account/employee-status/create') }}"><font size="2px">Create Employee Status</font></a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::segment(1) == 'accounts' && Request::segment(2) == 'division' || Request::segment(1) == 'account' && Request::segment(2) == 'division' ? 'active' : ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">domain</i>
                        <span>Division</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::segment(2) == 'division' && Request::segment(3) == 'manage'  ? 'active' : ''  }}">
                            <a href="{{ url('accounts/division/manage') }}"><font size="2px">Manage Division</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'division' && Request::segment(3) == 'create' ? 'active' : '' ) }}">
                            <a href="{{ url('accounts/division/create') }}"><font size="2px">Create Division</font></a>
                        </li>
                    </ul>
                </li>

                <li class="{{ Request::segment(1) == 'accounts' && Request::segment(2) == 'position' || Request::segment(1) == 'account' && Request::segment(2) == 'position' ? 'active' : ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">stars</i>
                        <span>Position</span>
                    </a>
                    <ul class="ml-menu">
                         <li class="{{ Request::segment(2) == 'position' && Request::segment(3) == 'manage'  ? 'active' : ''  }}">
                            <a href="{{ url('accounts/position/manage') }}"><font size="2px">Manage Position</font></a>
                        </li>
                         <li class="{{ (Request::segment(2) == 'position' && Request::segment(3) == 'create' ? 'active' : '' ) }}">
                            <a href="{{ url('account/position/create') }}"><font size="2px">Create Position</font></a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>

        @if(App\Http\Models\SystemSettings::field('pds') == 1 && Auth::user()->role == 'admin')
        <li class="{{ (Request::segment(1) == 'personal-data-sheet-table' ? 'active' : '' ) }}">
            <a href="{{ url('personal-data-sheet-table') }}">
                <i class="material-icons">assignment</i>
                <span>Pesonal Data Information</span>
            </a>
        </li>
        @endif


        @if(App\Http\Models\SystemSettings::field('ssalnw') == 1 && Auth::user()->role == 'admin')
        <li class="{{ (Request::segment(1) == 'sworn-statement-assets-liabilities-net-worth' ? 'active' : '' ) }}">
            <a href="{{ url('sworn-statement-assets-liabilities-net-worth') }}">
                <i class="material-icons">account_balance</i>
                <span>Sworn Statement of Assets, Liabilities and Net Worth</span>
            </a>
        </li>
        @endif


        @if(App\Http\Models\SystemSettings::field('service_record') == 1 && Auth::user()->role == 'admin')
        <li class="{{ (Request::segment(1) == 'service-records' ? 'active' : '' ) }}">
            <a href="{{ url('service-records') }}">
                <i class="material-icons">description</i>
                <span>Service Records</span>
            </a>
        </li>
      @endif



        @if(Auth::user()->role == 'admin')
        <li class="{{ (Request::segment(1) == 'employee-biometric-attendance' ? 'active' : '' ) }}">
            <a href="{{ url('employee-biometric-attendance') }}">
                <i class="material-icons">fingerprint</i>
                <span>Employee Biometric Attendance</span>
            </a>
        </li>
        @endif


<!--        <li class="{{ (Request::segment(1) == 'leave-applications' ? 'active' : '' ) }}">
           
            <a href="{{ url('leave-management/applications') }}">
                <i class="material-icons">library_books</i>
                @if(App\Http\Models\LeaveApplication::seen_count() > 1)
                <span class="" style="background-color: #bf1717;position: absolute; top: 2px; color: #fff; font-size: 10px; line-height: 15px; padding: 0 4px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; border-radius: 3px;">{{ App\Http\Models\LeaveApplication::seen_count() }}</span>
                @endif
                <span>Leave Requests</span>
            </a>
        </li>
 -->






        {{-- <li class="{{ Request::segment(1) == 'leave-management' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-toggle">
                @if(App\Http\Models\LeaveApplication::pending_count(Auth::id()) != 0)
                <span class="" style="background-color: #bf1717;position: absolute; top: 2px; color: #fff; font-size: 10px; line-height: 15px; padding: 0 4px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; border-radius: 3px;">{{ App\Http\Models\LeaveApplication::pending_count(Auth::id()) }}</span>
                @endif
                <i class="material-icons">library_books</i>
                <span>Leave Managament</span>
            </a>
            <ul class="ml-menu">
                <li class="{{ Request::segment(1) == 'leave-management' && Request::segment(2) == 'applications' ? 'active' : ''  }}">
                    <a href="{{ url('leave-management/applications') }}">For Approval</a> 
                </li>
                <li class="{{ (Request::segment(1) == 'leave-management' && Request::segment(2) == 'employees' || Request::segment(2) == 'details'? 'active' : '' ) }}">
                    <a href="{{ url('leave-management/employees') }}">Leave Card</a>
                </li>
            </ul>
        </li> --}}





        <li class="{{ (Request::segment(1) == 'messages' ? 'active' : '' ) }}">
            <a href="{{ url('/messages/inbox') }}">
                @if(App\Http\Models\Notifications::unseen_message(Auth::id()) != 0)
                <span class="" style="background-color: #bf1717;position: absolute; top: 2px; color: #fff; font-size: 10px; line-height: 15px; padding: 0 4px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; border-radius: 3px;">{{ App\Http\Models\Notifications::unseen_message(Auth::id()) }}</span>
                @endif
                <i class="material-icons">email</i>
                <span>Messenger</span>
            </a>
        </li>

        <li class="{{ (Request::segment(1) == 'reports' ? 'active' : '' ) }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">local_printshop</i>
                <span>Reports</span>
            </a>
            <ul class="ml-menu">

                <li class="{{ (Request::segment(2) == 'civil-service-eligibilty' || Request::segment(2) == 'work-experience' || Request::segment(2) == 'voluntary-works' || Request::segment(2) == 'learning-development-training' ? 'active' : '' ) }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>CSE/Work/Voluntary/LDT</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ (Request::segment(2) == 'civil-service-eligibilty' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/civil-service-eligibilty') }}"><font size="2px">Civil Service Eligibility</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'work-experience' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/work-experience') }}"><font size="2px">Work Experience</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'voluntary-works' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/voluntary-works') }}"><font size="2px">Voluntary Work or Involvement</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'learning-development-training' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/learning-development-training') }}"><font size="2px">Learning and Development</font></a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (Request::segment(2) == 'employees' ? 'active' : '') }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Employees Report</span>
                    </a>
                    <ul class="ml-menu">
                        <?php
                            $now = Carbon\Carbon::now();
                            $month = $now->format('m');
                        ?>
                        <li class="{{ (Request::segment(3) == 'birthday' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/employees/birthday/'. $month) }}"><font size="2px">Birthday Celebrants List</font></a>
                        </li>
                        <li class="{{ (Request::segment(3) == 'age' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/employees/age/18/70') }}"><font size="2px">Employees Age List</font></a>
                        </li>

                          <li class="{{ (Request::segment(3) == 'years' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/employees/years/1/40') }}"><font size="2px">Years of Service</font></a>
                        </li>
                        <li class="{{ (Request::segment(3) == 'menu' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/employees/menu') }}"><font size="2px">Employees List</font></a>
                        </li>                     
                    </ul>
                </li>


           <!--      <li class="{{ (Request::segment(1) == 'leave-application' ? 'active' : '' ) }}">
                   
                    <a href="{{ url('/leave-application') }}">
                        <i class="material-icons">library_books</i>
                        <span class="" style="background-color: #bf1717;position: absolute; top: 2px; color: #fff; font-size: 10px; line-height: 15px; padding: 0 4px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; border-radius: 3px;">2</span>
                        <span>Leave Requests</span>
                    </a>
                </li>
 -->
                <li class="{{ (Request::segment(1) == 'reports' && Request::segment(2) == 'service-record' ? 'active' : '' ) }}">
                    <a href="{{ url('service-records') }}">
                        <span>Service Records</span>
                    </a>
                </li>

           


                {{-- <li class="{{ (Request::segment(2) == 'leave-card' || Request::segment(2) == 'leave' || Request::segment(2) == 'leave'  ? 'active' : '' ) }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Employees Leave</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ (Request::segment(2) == 'leave-card' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/leave-card') }}"><font size="2px">Leave Card</font></a>
                        </li>
                        <li class="{{ (Request::segment(3) == 'approved' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/leave/approved') }}"><font size="2px">Approved Leave</font></a>
                        </li>
                        <li class="{{ (Request::segment(3) == 'declined' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/leave/declined') }}"><font size="2px">Declined Leave</font></a>
                        </li>
                    
                    </ul>
                </li> --}}


                <li class="{{ (Request::segment(2) == 'audit-trail' ? 'active' : '' ) }}">
                    <a href="{{ url('reports/audit-trail/all') }}">
                        <span>System Logs</span>
                    </a>
                </li>

            </ul>
        </li>







        <li class="{{ (Request::segment(1) == 'upload' ? 'active' : '' ) }}">
            <a href="{{ url('/upload/form') }}">
                <i class="material-icons">file_upload</i>
                <span>Upload</span>
            </a>
        </li>

    @else

        <li class="{{ (Request::segment(1) == 'personal-data-sheet' ? 'active' : '' ) }}">
            <a href="{{ url('/personal-data-sheet/'.encrypt(Auth::user()->id)) }}">
                <i class="material-icons">assignment</i>
                <span>Pesonal Data Information</span>
            </a>
        </li>

        <li class="{{ (Request::segment(1) == 'sworn-statement-assets-liabilities-net-worth' ? 'active' : '' ) }}">
            <a href="{{ url('/sworn-statement-assets-liabilities-net-worth/'.encrypt(Auth::user()->id)) }}">
                <i class="material-icons">account_balance</i>
                <span>Sworn Statement of Assets, Liabilities and Net Worth</span>
            </a>
        </li>

       

        @if(Auth::user()->employee_status == 'PERMANENT' || Auth::user()->employee_status == 'CASUAL')

        <li class="{{ (Request::segment(1) == 'leave' ? 'active' : '' ) }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">logout</i>
                <span>Application For Leave</span>
            </a>
            <ul class="ml-menu">

                <li class="{{ (Request::segment(1) == 'leave' && Request::segment(2) == 'application' ? 'active' : '' ) }}">
                    <a href="{{ url('leave/application') }}">
                        <span>Create Application for Leave</span>
                    </a>
                </li>


                <li class="{{ (Request::segment(1) == 'leave' && Request::segment(2) == 'all-request' ? 'active' : '' ) }}">
                    <a href="{{ url('leave/all-request/'.encrypt(Auth::user()->id)) }}">
                        <span>Applications for Leave</span>
                    </a>
                </li>

            </ul>
        </li>

        @endif


        <li class="{{ (Request::segment(1) == 'messages' ? 'active' : '' ) }}">
            <a href="{{ url('/messages/inbox') }}">
            @if(App\Http\Models\Notifications::unseen_message(Auth::id()) != 0)
             <span class="" style="background-color: #bf1717;position: absolute; top: 2px; color: #fff; font-size: 10px; line-height: 15px; padding: 0 4px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -ms-border-radius: 3px; border-radius: 3px;">{{ App\Http\Models\Notifications::unseen_message(Auth::id()) }}</span>
            @endif
                <i class="material-icons">email</i>
                <span>Messenger</span>
            </a>
        </li>



        <li class="{{ (Request::segment(1) == 'reports' ? 'active' : '' ) }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">local_printshop</i>
                <span>Reports</span>
            </a>
            <ul class="ml-menu">

                <li class="{{ (Request::segment(2) == 'civil-service-eligibilty' || Request::segment(2) == 'work-experience' || Request::segment(2) == 'voluntary-works' || Request::segment(2) == 'learning-development-training' ? 'active' : '' ) }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>CSE/Work/Voluntary/LDT</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ (Request::segment(2) == 'civil-service-eligibilty' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/civil-service-eligibilty/'.encrypt(Auth::user()->id)) }}"><font size="2px">Civil Service Eligibility</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'work-experience' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/work-experience/'.encrypt(Auth::user()->id)) }}"><font size="2px">Work Experience</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'voluntary-works' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/voluntary-works/'.encrypt(Auth::user()->id)) }}"><font size="2px">Voluntary Work or Involvement</font></a>
                        </li>
                         <li class="{{ (Request::segment(2) == 'learning-development-training' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/learning-development-training/'.encrypt(Auth::user()->id)) }}"><font size="2px">Learning and Development</font></a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (Request::segment(1) == 'reports' && Request::segment(2) == 'service-record' ? 'active' : '' ) }}">
                    <a href="{{ url('reports/service-record/list/all/'.encrypt(Auth::user()->id)) }}">
                        <span>Service Records</span>
                    </a>
                </li>



            <li class="{{ (Request::segment(2) == 'daily-time-record' || Request::segment(2) == 'daily-time-record' ? 'active' : '' ) }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>My Daily Time Record</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ (Request::segment(2) == 'daily-time-record' && Request::segment(3) == 'monthly'? 'active' : '' ) }}">
                            <a href="{{ url('reports/daily-time-record/monthly') }}"><font size="2px">Montly (DTR)</font></a>
                        </li>
                        <li class="{{ (Request::segment(2) == 'daily-time-record' && Request::segment(3) == 'range' ? 'active' : '' ) }}">
                            <a href="{{ url('reports/daily-time-record/range') }}"><font size="2px">Attendance</font></a>
                        </li>
                       
                    </ul>
                </li>

               
              <!--  <li class="{{ (Request::segment(2) == 'my-dtr' ? 'active' : '' ) }}">
                    <a href="{{ url('reports/my-dtr/') }}">
                        <span>My Daily Time Record</span>
                    </a>
                </li>
 -->


                <li class="{{ (Request::segment(2) == 'audit-trail' ? 'active' : '' ) }}">
                    <a href="{{ url('reports/audit-trail/'.encrypt(Auth::user()->id)) }}">
                        <span>System Logs</span>
                    </a>
                </li>

            </ul>
        </li>





     @endif


        @if(Auth::user()->role == 'admin')
        <li class="{{ (Request::segment(1) == 'faq' ? 'active' : '' ) }}">
            <a href="{{ url('faq/list') }}">
                <i class="material-icons">contact_mail</i>
                <span>Frequently Asked Questions</span>
            </a>
        </li>
        @endif


    </ul>
</div>
<!-- #Menu