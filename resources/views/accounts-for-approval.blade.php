@extends('layouts.app')
@section('title','APPROVE ACCOUNTS')

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
                                APPROVE ACCOUNTS
                            </h2>

                        
                        
                        </div>
                        <div class="body">
                            <div class="table-container">
                                 @include('accounts-table-for-approval')    
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

      
    </script>
@endsection