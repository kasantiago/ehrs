@extends('layouts.app')
@section('title','FREQUENTLY ASKED QUESTIONS')

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
                                FREQUENTLY ASKED QUESTIONS
                            </h2>

                           
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

                               <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                  <thead>
                                      <tr>
                                          <th><small>FREQUENTLY ASKED QUESTIONS</small></th>
                                          <th><small>Created At</small></th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                           <th><small>FREQUENTLY ASKED QUESTIONS</small></th>
                                           <th><small>Created At</small></th>
                      
                                      </tr>
                                  </tfoot>
                                  <tbody>

                                      @foreach ($faq as $key => $value)
                                      <tr class="data">
                                         
                                          <td style="vertical-align:middle;text-align:left;width:80%;"><small>{{ $value->faq }}</small></td>
                                         
                                          <td style="vertical-align:middle;text-align:left;width:20%;"><small>{{ $value->created_at }}</small></td>
                   

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