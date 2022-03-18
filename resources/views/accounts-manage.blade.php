@extends('layouts.app')
@section('title','MANAGE ACCOUNTS')

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
                                MANAGE ACCOUNTS
                            </h2>

                              <ul class="header-dropdown m-r--5">
                                  <a href="{{ url('account/create') }}" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons {{ $color[3] }}" style="font-size:35px">note_add</i>
                                    </a>
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
                            <div class="table-container">
                                 @include('accounts-table')    
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>

 @foreach ($users as $key => $value)
  <div class="modal fade" id="smallModal-{{$key}}" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
              <div class="modal-header bg-green">
                  <h4 class="modal-title" ><center>{{  App\Http\Models\PersonalInformation::get_name($value->id) }}<center></h4>
              </div>
              <div class="modal-body">
                <center>
                <a href="{!! url('personal-data-sheet').'/'.encrypt($value->id) !!}"  title="Click to View PDS"><!-- target="_blank"  -->
                        <img class="media-object" src="{!! $value->photo ? asset('storage/avatars/'.$value->photo) : asset('admin-assets/images/user.png') !!}" width="100" height="100">
                    </a>
                 <hr></center>

           
                        <b>Employee Number : </b> <u><i>{{ strtoupper($value->employee_number) }}</i></u><br>
                        <b>Employee Status : </b> <u><i>{{ strtoupper($value->employee_status) }}</i></u><br>
                        <b>Division - Section/Unit : </b> <u><i>{{ strtoupper($value->division) }}</i></u><br>
                        <b>Position: </b> <u><i>{{ strtoupper($value->position) }}</i></u><br>
                        <b>Salary Grade : </b> <u><i>{{ strtoupper($value->salary_grade) }}</i></u><br>
                        <b>Level : </b> <u><i>{{ strtoupper($value->level) }}</i></u><br>
                        <b>Step Increment : </b> <u><i>{{ strtoupper($value->step_increment) }}</i></u><br>
                        <b>Salary : </b> <u><i>{{ number_format($value->salary_amount ,2,'.', ',') }}</i></u><br>
                        <hr>
                        <b>Username : </b><br> <u><i>{{ strtoupper($value->username) }}</i></u><br>
                        <b>Email : </b> <br><u><i>{{ $value->email }}</i></u><br>
                        <hr>
                        <b>Gender : </b> <u><i><?php if($value->gender == 1){ echo 'MALE';}elseif($value->gender == 2){  echo 'FEMALE';  }else{  echo 'N/A'; } ?></i></u><br>
                        <b>Birthday : </b> <u><i>{{ $value->birthday ? $value->birthday : 'N/A' }}</i></u><br>
                    

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
              </div>
          </div>
      </div>
  </div>
@endforeach


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
    
    <script type="text/javascript">
           $(document).ready(function(){

                $('.details').on('click', function () {
                    var color = $(this).data('color');
                     @foreach ($users as $key => $value)
                        $('#mdModal-{{$key}} .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
                        $('#mdModal-{{$key}}').modal('show');
                     @endforeach
                });
            });   
           
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('.pagination li.active a').addClass('{{ $color[2] }}');
      });

      $(document).ready(function(){

            $('body').on('click','.security-password',function(){
              var selector = $(this);
              
              apprise('<center><b>Please enter your password!</b></center>',{'input':true},function(input){

                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                            url: '{{ url('accounts/security-password') }}',
                            type: 'POST',
                            data: {'password':input,'_token':'{{ csrf_token() }}'}, 
                            success: function(data)
                               {
                                 if(data.success){

                                          $('.security-password.action-tag').security_delete(selector);

                                       // security_delete(selector);

                                         // var msg = '<strong><font size="3" color="red"> Are you sure you want to delete '+selector.data('name')+'? </font></strong>'
                                         // // $('.appriseInner.aButtons.cancel').click();
                                         // $('.appriseInner button').click();
                                         // apprise(msg, {'verify':true}, function(r)
                                         // {
                                         // if(r)
                                         //     {

                                         //     loadingMsg();

                                         //     var dataString = 'id='+ selector.data('id');

                                         //     $.ajax({
                                         //         headers: {
                                         //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                         //          },
                                         //         url: selector.data('action'),
                                         //         type: 'POST',
                                         //         data: dataString, 
                                         //         success: function(data)
                                         //            {
                                         //             $('.appriseInner button').click();
                                         //               if(data.success == true){

                                         //                 renderTable(data.page);

                                         //               }
                                         //                $('.appriseInner.aButtons.cancel').click();
                                         //                apprise(data.message);
                                         //            }
                                         //     });

                                         //     }
                                         //  return false;
                                         // });
                                 }else{
                                   if(data.message){
                                      apprise('<center><strong><font size="3" color="red"> '+ data.message +'</b></center>');
                  
                                   }
                                 }
                               }
                        });          
              });
            });
        });

       // $('body').on('click','.destory-function.action-tag',function(){
       //      var selector = $(this);

       //      var msg = '<strong><font size="3" color="red"> Are you sure you want to delete '+selector.data('name')+'? </font></strong>'
       //      // $('.appriseInner.aButtons.cancel').click();
       //      $('.appriseInner button').click();
       //      apprise(msg, {'verify':true}, function(r)
       //      {
       //      if(r)
       //          {

       //          loadingMsg();

       //          var dataString = 'id='+ selector.data('id');

       //          $.ajax({
       //              headers: {
       //                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       //               },
       //              url: selector.data('action'),
       //              type: 'POST',
       //              data: dataString, 
       //              success: function(data)
       //                 {
       //                  $('.appriseInner button').click();
       //                    if(data.success == true){

       //                      renderTable(data.page);

       //                    }
       //                     $('.appriseInner.aButtons.cancel').click();
       //                     apprise(data.message);
       //                 }
       //          });

       //          }
       //       return false;
       //      });
       //  });
    </script>
@endsection