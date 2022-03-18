 <div class="table-responsive">
  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
    <thead>
        <tr>
          
            <th><small>Name</small></th>
            <th><small><center>Level</center></small></th>
            <th><small><center>Employee Status</center></small></th>
            <th><small><center>Division Section/Unit</center></small></th>
            <th><small><center>Position</center></small></th>
           <!--  <th>Username</th> -->
           <!--  <th>Email</th> -->

            <th><small><center>Action</center></small></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
           
            <th style="padding-right:30px;"><small>Name</small></th>
            <th style="padding-right:30px;"><small><center>Level</small></center></th>
            <th style="padding-right:30px;"><small><center>Employee Status</center></small></th>
            <th style="padding-right:30px;"><small><center>Division Section/Unit</center></small></th>
            <th style="padding-right:30px;"><small><center>Position</center></small></th>
            <!--  <th>Username</th> -->
            <!-- <th>Email</th> -->

            <th style="padding-right:30px;"><small><center>Action</center></small></th>
        </tr>
    </tfoot>
    <tbody>

       
        @foreach ($users as $key => $value)
        <tr class="data">
          
          <td style="padding:5px 0px 0px 5px" ><small>{{  App\Http\Models\PersonalInformation::get_name($value->id) }}</small></td>
          <td style="padding:5px 0px 0px 5px"><small><center>{{ $value->level }}</small></center></td>
          <td style="padding:5px 0px 0px 5px"><small><center>{{ strtoupper($value->employee_status) }}</small></center></td>
          <td style="padding:5px 0px 0px 5px"><small><center>{{ strtoupper($value->division) }}</small></center></td>
          <td style="padding:5px 0px 0px 5px"><small><center>{{ strtoupper($value->position) }}</small></center></td>
          <td style="width:12%;padding:5px 0px 0px 5px">
          <center>
                  <div class="u-{{$value->id}} all-users">

                      @if(Request::segment(1) == 'personal-data-sheet-table')

                          @if(App\Http\Models\AdminRequest::system_settings() == 1)

                              @switch(App\Http\Models\AdminRequest::admin_request($value->id))
                                
                                @case(0)
                                  <a class="waves-effect m-r-5 SendRequestForm" data-user_id="{{encrypt($value->id)}}" data-name="{{  App\Http\Models\PersonalInformation::get_name($value->id) }}" data-toggle="modal" data-target="#SendRequestForm" >
                                <i class="material-icons col-amber">visibility</i>
                                  </a>
                                @break

                                @case(1)
                                  <a><i class="material-icons col-grey">hourglass_empty</i></a>
                                @break

                                @case(2)
                                  <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> <!-- target="_blank" -->
                                     <i class="material-icons {{ $color[3] }}">pageview</i>
                                  </a>
                                @break

                                @default

                              @endswitch

                          @else

                                 <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> <!-- target="_blank" -->
                                 <i class="material-icons {{ $color[3] }}">pageview</i>
                                </a>

                          @endif

                      @endif




                      @if(Request::segment(1) == 'sworn-statement-assets-liabilities-net-worth')

                          @if(App\Http\Models\AdminRequest::system_settings() == 1)

                              @switch(App\Http\Models\AdminRequest::admin_request($value->id))
                                
                                @case(0)
                                  <a class="waves-effect m-r-5 SendRequestForm" data-user_id="{{encrypt($value->id)}}" data-name="{{  App\Http\Models\PersonalInformation::get_name($value->id) }}" data-toggle="modal" data-target="#SendRequestForm" >
                                <i class="material-icons col-amber">visibility</i>
                                  </a>
                                @break

                                @case(1)
                                  <a><i class="material-icons col-grey">hourglass_empty</i></a>
                                @break

                                @case(2)
                                  <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> <!-- target="_blank" -->
                                     <i class="material-icons {{ $color[3] }}">pageview</i>
                                  </a>
                                @break

                                @default

                              @endswitch

                          @else

                                 <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> <!-- target="_blank" -->
                                 <i class="material-icons {{ $color[3] }}">pageview</i>
                                </a>

                          @endif

                      @endif



                       @if(Request::segment(1) == 'service-records')


                           @if(isset($value->view)) 
                            <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> <!-- target="_blank" -->
                                           <i class="material-icons {{ $color[3] }}">pageview</i>
                                          </a>
                           @endif

                           @if(isset($value->certification))
                            <a class="edit-function action-tag" href="{{ $value->certification }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->certification_title) ? $value->certification_title : '' }}">
                                           <i class="material-icons {{ $color[3] }}">tab</i><!-- target="_blank" -->
                                          </a>
                           @endif
                           

                      @endif






                    @if(Request::segment(1) == 'reports')

                        @if(App\Http\Models\AdminRequest::system_settings() == 1)

                             <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> 
                                <i class="material-icons {{ $color[3] }}">pageview</i>
                                </a>

                        @endif

                    @endif



                  @if(Request::segment(1) == 'employee-biometric-attendance')

                         <a class="edit-function action-tag" href="{{ $value->view }}"  data-toggle="tooltip" data-placement="top" title data-original-title="{{ isset($value->view_title) ? $value->view_title : '' }}"> 
                              <i class="material-icons {{ $color[3] }}">pageview</i>
                              </a>

                  @endif














                </div>
          </center>
          </td>

        </tr>
        @endforeach
      
    </tbody>
  </table>

  <!-- Default Size -->

</div>


@section('for_modal')
  <div class="modal fade" id="SendRequestForm" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title {{ $color[3] }}" id="SendRequestFormLabel">Send Request for Personal Data Sheet?</h4>
              </div>
              <div class="modal-footer">
                <form method="POST" id="formSubmit">
                  {{ csrf_field() }}
                  <input id="user_id" type="hidden" name="user_id">
                  <button type="submit" class="btn btn-link waves-effect" >OK</button>
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                </form>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('modal_scripts')
  

@endsection
