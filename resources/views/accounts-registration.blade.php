<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>E-HRS Registration</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('DOH.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('admin-assets/css/googleapis.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('admin-assets/css/fonts.googleapis.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin-assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin-assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/css/customized-styles.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/css/apprise.css') }}" rel="stylesheet" />

    <style type="text/css">
      textarea {
        width: 100%;
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        resize: none;
      }
    </style>
</head>

<body class="login-page bg-light-green">

    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">
                <img src="{{ asset('e-logo.png')}}" alt="e-logo" height="30">
            </a>
            <small><b>Electronic Human Resource System Registration</b></small>
        </div>
        <div class="card">
            <div class="body">
                <form method="POST" novalidate="novalidate" action="{{ url('registration/store') }}">
                             
                    {{ csrf_field() }}

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control all-caps" name="name" required aria-required="true" autocomplete="off">
                                    <label class="form-label">Full Name: (Last Name, First Name and M.I.)</label>
                                </div>
                                <label id="name-error" class="error" for="name"></label>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control noSpace all-small" name="username" required aria-required="true" autocomplete="off">
                                    <label class="form-label" style="top: -10px; left: 0; font-size: 12px;">Username</label>
                                </div>
                                <label id="username-error" class="error" for="username"></label>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="employee_status" >
                                      <option  disabled selected> Select Employee Status</option>
                                    @foreach($employee_status as $key => $value)
                                      <option value="{{ strtoupper($value->name) }}" >{{ strtoupper($value->name) }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <label id="employee_status-error" class="error" for="employee_status"></label>
                            </div> 


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="division">
                                     <option  disabled selected> Select Division</option>
                                    @foreach($division as $key => $value)
                                      <option value="{{ strtoupper($value->name) }}" >{{ strtoupper($value->name) }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <label id="division-error" class="error" for="division"></label>
                            </div> 


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="position">
                                     <option  disabled selected> Select Position</option>
                                    @foreach($position as $key => $value)
                                      <option value="{{ strtoupper($value->name) }}" >{{ strtoupper($value->name) }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <label id="position-error" class="error" for="position"></label>
                            </div> 



                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick salary-computation" name="salary_grade">
                                     <option  disabled selected > Salary Grade</option>
                                    @for ($i = 1; $i <= 33; $i++)
                                      <option value="{{ $i }}" >Salary Grade {{ $i }}</option>
                                    @endfor
                                    </select>
                                </div>
                                <label id="salary_grade-error" class="error" for="salary_grade"></label>
                            </div> 


                        

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick salary-computation" name="step_increment">
                                     <option  disabled selected >Step Increment</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                      <option value="{{ $i }}" >Step Increment {{ $i }}</option>
                                    @endfor
                                    </select>
                                </div>
                                <label id="step_increment-error" class="error" for="step_increment"></label>
                            </div> 
                        

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control noSpace money" name="salary_amount" required aria-required="true" autocomplete="off">
                                    <label class="form-label" >Salary Amount</label>
                                </div>
                                <label id="salary_amount-error" class="error" for="salary_amount"></label>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control noSpace" name="email" required aria-required="true" autocomplete="off">
                                    <label class="form-label" >Email</label>
                                </div>
                                <label id="email-error" class="error" for="email"></label>
                            </div>



                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control noSpace" name="biometric_id" required aria-required="true" autocomplete="off">
                                    <label class="form-label" >Bio Metric Id</label>
                                </div>
                                <label id="biometric_id-error" class="error" for="biometric_id"></label>
                            </div>


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control show-tick salary-computation" name="biometric">
                                       <option  disabled selected >Biometric Machine Number</option>
                                
                                       <option value="1" >Biometric 1 (Near ICTU Office)</option>
                                       <option value="2" >Biometric 2 (Near Budget Office)</option>
                                       <option value="3" >Biometric 3 (Side of LHSD)</option>
                                       <option value="4" >Biometric 4 (Infront of Procurement Office)</option>  
                                       <option value="5" >Biometric 5 (Side of Cold Room Office)</option>                      
                                   
                                    </select>
                                </div>
                                <label id="biometric-error" class="error" for="biometric"></label>
                            </div> 
                        




                    <button class="btn bg-blue waves-effect" type="submit">SUBMIT</button>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="body">
                 <small><b>Frequently Asked Questions</b><br></small>

                  <form method="POST" novalidate="novalidate" action="{{ url('registration/faq') }}">

                  {{ csrf_field() }}

                  <div class="form-group form-float">
                      <div class="form-line">
                          <textarea name="faq"></textarea>
                         
                      </div>
                      <label id="faq-error" class="error" for="name"></label>
                  </div>


                   <button class="btn bg-blue waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>


      <script type="text/javascript">
         var public_url = "{{ asset('/') }}";
     </script>


       @yield('for_modal')

     <script type="text/javascript">
         var public_url = "{{ asset('/') }}";
     </script>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/node-waves/waves.js') }}"></script>

    <script src="{{ asset('admin-assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin-assets/js/admin.js') }}"></script>


    <!-- Validation Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/jquery-validation/jquery.validate.js') }}"></script>


    <!-- Demo Js -->
    <script src="{{ asset('admin-assets/js/demo.js') }}"></script>

    <!-- Apprise Js -->
    <script src="{{ asset('admin-assets/js/apprise.js') }}"></script>


   <script src="{{ asset('admin-assets/js/jquery.allmask.min.js') }}"></script>
   
   <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>

  <script type="text/javascript">
    setTimeout(function() {
      $('.form-line').removeClass('focused');
    }, 100);

    $(document).ready(function(){
      $('.money').mask('000,000,000,000,000.00', {reverse: true});
    });

    $(document).ready(function(){
      $('input[name="name"]').keyup(function() {

        name = $(this).val();
        splitz = name.split(", ");

        if (splitz[1]){

          lastname = splitz[0];
          firstname = splitz[1];
          matches = firstname.match(/\b(\w)/g);
          acronym = matches.join('');

          $('input[name="username"]').val(acronym.slice(0).toLowerCase()+lastname.toLowerCase().replace(/-/g, ''));

        }else{

          lastname = splitz[0];
          $('input[name="username"]').val(lastname.toLowerCase().replace(/-/g, ''));

        }
        
      });

      $('.salary-computation').on('change',function(){
          salary_grade = $('select[name="salary_grade"]').val();
          salary_step = $('select[name="step_increment"]').val();
        
             $.ajax({   
                url: '{{ url("salary/autocompute") }}',
                type:'POST',
                data:  {'_token':'{{ csrf_token() }}','salary_grade':salary_grade,'salary_step':salary_step},
                async: false,
                success: function(data)
                    {
                    
                        if(data.success){
                            salary = data.salary;
                            $('input[name="salary_amount"]').val(salary);
                            $('input[name="salary_amount"]').parent().addClass('focused');
                        }
                        
                    }
               }); 
        return false;
      });


    });

  </script>

     
    @if(Session::has('msg'))
         <script type="text/javascript">
            $('.appriseInner button').click();

            apprise('<div style="float:left;clear:none;display: flex;"> <div><center><font size="3" color="black">{{Session::get('msg')}}</font></div> <div style="margin-top:-3px;padding-left: 7px;"><i class="material-icons">info</i></center></div></div>');

        </script>

    @endif

   

</body>

</html>