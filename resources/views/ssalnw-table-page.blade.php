@extends('layouts.app')
@section('title','SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH')

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
                                SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH
                            </h2>
                        </div>
                        <div class="body">
                           @if(App\Http\Models\AdminRequest::system_settings() == 1)
                            <div class="row clearfix">
                                <div class="col-md-3" style="border-right: 2px solid #f0f0f0;">
                                    <form method="POST" id="send_request_to_all" action="{{ url('sworn-statement-assets-liabilities-net-worth/send-request-to-all') }}">
                                        <button type="submit" class="btn {{ $color[2] }} waves-effect col-md-12">SEND REQUEST TO ALL</button>
                                    </form>
                                </div>

                                <form method="POST" id="send_selected" action="{{ url('sworn-statement-assets-liabilities-net-worth/send-request-selected-unit') }}">
                                <div class="col-md-6">
                                    <select name="selected[]" class="form-control show-tick division-selector" multiple>
                                        @foreach(App\Http\Models\Division::get_unit() as $row => $value)
                                            @if($value->code == 'MSD')
                                                <option value="{!! $value->code !!}">MSD HEADS</option>
                                            @else
                                                <option value="{!! $value->code !!}">{!! $value->name !!}</option>
                                            @endif
                                        @endforeach
                                        <!-- <option value="" disabled selected>Send Request by Division</option>
                                        <option value="One">One</option>
                                        <option value="Two">Two</option>
                                        <option value="Three">Three</option> -->
                                    </select>
                                </div>
                                <div class="col-md-3" style="border-left: 2px solid #f0f0f0;">
                                    <button type="submit" class="btn {{ $color[2] }} waves-effect col-md-12">SEND</button>
                                </div>
                                </form>
                            </div>
                            <hr>
                            @endif
                            <div class="table-container">
                                 @include('employees-table')    
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

    <!-- Multi Select Css -->
    <link href="{{ asset('admin-assets/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <style type="text/css">
        a.details {text-decoration: none !important;color: #000;cursor:pointer;}
        a.details:hover { color: #000;}
        .bootstrap-select.btn-group .dropdown-toggle .filter-option {
            /*width: 120%;*/
        }
        .card .body .col-md-3 {
            margin-bottom: 0px;
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

    <!-- <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script> -->
    <script src="{{ asset('admin-assets/js/pages/ui/tooltips-popovers.js') }}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>

    <!-- Multi Select Custom Js -->
    <script type="text/javascript">
        //Multi-select
        $('#optgroup').multiSelect({ selectableOptgroup: true });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination li.active a').addClass('{{ $color[2] }}');
        });
    </script>

    <script type="text/javascript">
        $('.SendRequestForm').on('click',function(){
          name = $(this).data('name');
          user_id = $(this).data('user_id');
          $('#user_id').val(user_id);
          $('#formSubmit').attr('action', 'sworn-statement-assets-liabilities-net-worth/send-request');
          $('#SendRequestFormLabel').html("Do you want to send request (SSALNW) to "+name+"");
        });


        $('#formSubmit').on('submit',function(){
        $('#SendRequestForm').modal('hide');
        $('.appriseInner button').click();
        apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
                  $('.aButtons').hide();


           var form = $(this);
                $.ajax({
                    headers: (
                      'Content-type: text/html; charset=utf-8'
                     ),
                    url: form.attr("action"),
                    type: form.attr("method"),
                    data: form.serialize(), 
                    success: function(data)
                       {
                         if(data.success){
                           
                            $(data.class).fadeOut().html('');
                            $(data.class).fadeIn().html('<a><i class="material-icons col-grey">hourglass_empty</i></a>');
                            $('.appriseInner button').click();

                            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">'+data.message+'</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>');


                         }

                       }

                });
            return false;
        });


        $('form#send_request_to_all').on('submit',function(){
            
        
             var form = $(this);

          
             var msg = '<strong><font size="3" color="green"> Are you sure you want to send request to all employees? </font></strong>';
              $('.appriseInner button').click();

              apprise(msg, {'verify':true}, function(r)
              {
              if(r){ 

            $('.appriseInner button').click();
            apprise("<i><b><font color='grey'>Sending request to all employees ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
            $('.aButtons').hide();

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url: form.attr("action"),
                    type: 'POST', 
                    success: function(data)
                       {
                        
                        $('.appriseInner button').click();

                          if(data.success == true){

                            $(data.class).fadeOut().html('');
                            $(data.class).fadeIn().html('<a><i class="material-icons col-grey">hourglass_empty</i></a>');
                            
                            $('.appriseInner button').click();

                            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">'+data.message+'</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>',null, function(){
                               location.reload();
                            });

                           // renderTable(data.page);

                          }else{

                            $('.appriseInner button').click();

                            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="red">'+data.message+'</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>');


                          }
                        
                        
                       }
                  });


                }
             });




        
            return false;
        });



        function renderTable(page) {
          
         // $('.table-container').html('');

          var $request = $.get(page); 

          var $container = $('.table-container');

          $container.addClass('loading'); // add loading class (optional)

          $request.done(function(data) { // success
              $container.html(data.html);
             
          });
          $request.always(function() {
              $container.removeClass('loading');
          });

          setTimeout(function() {
            reLoadTable();
          }, 1500);
      }

         function reLoadTable(){

            var docHeadObj = document.getElementsByTagName("head")[0];
            var newScript= document.createElement("script");
            newScript.type = "text/javascript";
            newScript.src = public_url+"admin-assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js";///
            docHeadObj.appendChild(newScript);

            var docHeadObj = document.getElementsByTagName("head")[0];
            var newScript= document.createElement("script");
            newScript.type = "text/javascript";
            newScript.src = public_url+"admin-assets/js/pages/tables/jquery-datatable.js";///
            docHeadObj.appendChild(newScript);

        }


        // $('.division-selector').on('change',function(){
        //     if($(this).val() == 'MSD'){

        //     }
        // });

        $('form#send_selected').on('submit',function(){


            var form = $(this);

          
            var msg = '<strong><font size="3" color="green"> Are you sure you want to send request to selected unit? </font></strong>';
              $('.appriseInner button').click();

            apprise(msg, {'verify':true}, function(r)
              {
              if(r){ 

            $('.appriseInner button').click();
            apprise("<i><b><font color='grey'>Sending request to all selected units ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
            $('.aButtons').hide();

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url: form.attr("action"),
                    data: form.serialize(), 
                    type: 'POST', 
                    success: function(data)
                       {
                        
                        $('.appriseInner button').click();

                          if(data.success == true){

                            $(data.class).fadeOut().html('');
                            $(data.class).fadeIn().html('<a><i class="material-icons col-grey">hourglass_empty</i></a>');
                            
                            $('.appriseInner button').click();

                            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">'+data.message+'</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>',null, function(){
                               location.reload();
                            });

                            //renderTable(data.page);

                          }
                        
                        
                       }
                  });


                }
             });


          return false;
        });

    </script>

@endsection