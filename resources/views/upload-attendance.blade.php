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
                            <h2>Upload DAT File to Database</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12 offset-sm-1">
                                    <!-- Message -->
                                     @if(Session::has('message'))
                                        <h2>{{ Session::get('message') }}</h2>
                                     @endif

                                     <!-- Form -->
                                     <form method="post" action="{{ url('upload/attendance') }}" class="dropzone" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div align="center">
                                            <input type="file" name="file" class="btn {{ $color[0] }}">
                                        </div>

                                        <br>

                                        <div align="center">
                                            <button type="submit" name="submit" class="btn {{ $color[2] }}" value="Import" style="width: 20%; font-size: 18px;">Upload</button>
                                        </div>
                                     </form>
                                </div>
                            </div>

                            <!-- <div align="center">
                                <button type="button" class="btn {{ $color[2] }}" id="submit-all">Upload</button>
                            </div> -->

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
@endsection
