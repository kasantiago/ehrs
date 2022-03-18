@extends('layouts.app')
@section('title','EDIT NAME')

@section('content')


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>EDIT NAME</h2>
              <!--   <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                 
                    </li>
                </ul> -->
            </div>
            <div class="body">
                <form  method="POST" novalidate="novalidate" action="{{ url('manage-accounts/update-name') }}">
                 
                    {{ csrf_field() }}

                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control all-caps" name="name"  value="{{ $user->name }}" required aria-required="true">
                                <label class="form-label" >Name</label>
                            </div>
                            <label id="name-error" class="error" for="name"></label>
                        </div>


                        <button class="btn {{ $color[2] }} waves-effect" type="submit">SUBMIT</button>
            
                </form>
            </div>
        </div>
    </div>


@endsection
@section('styles')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/css/customized-styles.css') }}" rel="stylesheet">

@endsection
@section('scripts')
   <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>
   <script type="text/javascript">
         setTimeout(function() {
            $('.form-line').addClass('focused');
         }, 100);

   </script>
@endsection