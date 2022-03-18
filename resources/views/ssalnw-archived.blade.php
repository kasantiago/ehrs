@extends('layouts.app')
@section('title','NOTARIZED SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH')

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
                            <h3>{!! strtoupper(App\Http\Models\PersonalInformation::get_name(decrypt($uid))) !!}</h3>
                            <h2>NOTARIZED SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH</h2>
                        </div>
                        <div class="body">
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super-admin')

                            @else

                                <div class="row">
                                    <div class="col-sm-12 offset-sm-1">
                                        <!-- <h2 class="page-heading">Upload your Files <span id="counter"></span></h2> -->
                                        <!-- <form method="post" action="{{ url('image/upload/store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                            @csrf
                                            <div class="dz-message">
                                                <div class="drag-icon-cph">
                                                    <i class="material-icons">touch_app</i>
                                                </div>
                                                <h3>Drop files here or click to upload.</h3>
                                                <em>(PDF Only)</em>
                                            </div>
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
                                        </form> -->

                                        <form action="{{ url('image/upload') }}" class="dropzone" id="dropzoneFrom" enctype="multipart/form-data">
                                            @csrf
                                            <div class="dz-message">
                                                <div class="drag-icon-cph">
                                                    <i class="material-icons">touch_app</i>
                                                </div>
                                                <h3>Drop files here or click to upload.</h3>
                                                <em>(PDF Only)</em>
                                            </div>
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div align="center">
                                    <button type="button" class="btn {{ $color[2] }}" id="submit-all">Upload</button>
                                </div>

                                <hr>

                            @endif

                            <div id="preview">
                                <div class="grid">

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

    <!-- Dropzone Css -->   
    <link href="{{ asset('admin-assets/plugins/dropzone/dropzone-5.5.1.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/css/hover-styles.css') }}" rel="stylesheet">

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

    <!-- Dropzone Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/dropzone/dropzone-5.5.1.js') }}"></script>
    
    <!-- Custom Js -->
    <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/ui/tooltips-popovers.js') }}"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination li.active a').addClass('{{ $color[2] }}');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
 
         Dropzone.options.dropzoneFrom = {
          autoProcessQueue: false,
          maxFiles: 1,
          acceptedFiles:".pdf", //.png,.jpg,.gif,.bmp,.jpeg,
          init: function(){
           var submitButton = document.querySelector('#submit-all');
           myDropzone = this;
           submitButton.addEventListener("click", function(){
            myDropzone.processQueue();
           });
           this.on("complete", function(){
            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
            {
             var _this = this;
             _this.removeAllFiles();
            }
            list_image();
           });
          },
         };

         list_image();

         function list_image()
         {
          $.ajax({
           headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
           url: '{{ url("image/upload") }}',
           success:function(data){
            $('.grid').html(data);
           }
          });
         }

         $(document).on('click', '.remove_file', function(){
          var name = $(this).attr('id');
          $.ajax({
           headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
           url: '{{ url("image/upload") }}',
           method:"POST",
           data:{name:name},
           success:function(data)
           {
            list_image();
           }
          })
         });
         
        });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('.pagination li.active a').addClass('{{ $color[2] }}');
      });
    </script>
@endsection