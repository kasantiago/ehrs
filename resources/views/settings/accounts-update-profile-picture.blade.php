@extends('layouts.app')
@section('title','EDIT PROFILE PICTURE')

@section('content')



           <!-- Basic Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT PROFILE PICTURE
                                <small><!-- update your profile picture! --></small>
                            </h2>
                            <!--   <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                             
                                </li>
                            </ul> -->
                            
                        </div>
                        <div class="body">
                         <center>
                            


                                 <div class="row justify-content-center">
                         
                                    <div class="profile-header-container">
                                        <div class="profile-header-img">
                                            @if(!$user->photo)
                                            <img class="rounded-circle" src="{{ url('admin-assets/images/user.png')}}" height="300px;" width="300px;" />
                                            @else
                                              <img class="rounded-circle" src="{{ url('storage/avatars') }}/{{ $user->photo }}" height="300px;" width="300px;" />
                                            @endif
                                            <!-- badge -->
                                           
                                        </div>
                                    </div>
                         
                                </div>
                                <div class="row justify-content-center">
                                    
                                    <form action="{{ url('manage-accounts/update-profile-picture') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                       
                                        <br /><br />
                                        Please upload a valid image file. Size of image should not be more than 2MB.
                                        <br />
                                        <input type="file" id="fileupload" name="avatar" data-url="/upload"  />
                                        <br />
                                        <div id="files_list"></div>
                                        <p id="loading"></p>
                                        <input type="hidden" name="file_ids" id="file_ids" value="" />
                                         <button class="btn {{ $color[2] }} waves-effect" type="submit">SUBMIT</button>
                                    </form>

                                </div>
         
                      
</center>
                        </div>
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

   <script type="text/javascript">
         setTimeout(function() {
            $('.form-line').addClass('focused');
         }, 100);

         $(function(){
          $('input[type="file"]').change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
             {
                var reader = new FileReader();

                reader.onload = function (e) {
                   $('img').attr('src', e.target.result);
                }
               reader.readAsDataURL(input.files[0]);
            }
            else
            {
              console.log('no image found')//$('img').attr('src', '/assets/no_preview.png');
            }
          });

        });

     ;

   </script>
@endsection