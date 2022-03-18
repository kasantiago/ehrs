@extends('layouts.app')
@section('title','EDIT ACCOUNT')

@section('content')


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>EDIT ACCOUNT</h2>
                <!-- <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                 
                    </li>
                </ul> -->
            </div>
            <div class="body">
                <form  method="POST" novalidate="novalidate" action="{{ url('account/update/'.encrypt($user->id)) }}">
                 
                    {{ csrf_field() }}

                        <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control noSpace" name="username"  value="{{ $user->username }}" required aria-required="true">
                                <label class="form-label" >Username</label>
                            </div>
                            <label id="username-error" class="error" for="username"></label>
                        </div>


                     
                        <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="password" class="form-control" name="password"  value="" required aria-required="true">
                                <label class="form-label" >Default Password: {{ env('DEFAULT_PASSWORD') }}</label>
                            </div>
                            <label id="password-error" class="error" for="password"></label>
                        </div>


                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control all-caps" name="employee_number"  value="{{ $user->employee_number }}" required aria-required="true">
                                <label class="form-label" >Employee Number</label>
                            </div>
                            <label id="employee_number-error" class="error" for="employee_number"></label>
                        </div>



                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control all-caps" name="name"  value="{{ $user->name }}" required aria-required="true">
                                <label class="form-label" >Employee Full Name</label>
                            </div>
                            <label id="name-error" class="error" for="name"></label>
                        </div>


                        <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick" name="employee_status">
                                       <option  disabled  {{ $user->employee_status == 0 ? 'selected' : '' }} > Select Employee Status</option>
                                      @foreach($employee_status as $key => $value)
                                        <option value="{{ strtoupper($value->name) }}" {{ strtoupper($user->employee_status) == strtoupper($value->name) ? 'selected' : '' }} >{{ strtoupper($value->name) }}</option>
                                      @endforeach
                                      </select>
                                </div>
                                <label id="employee_status-error" class="error" for="employee_status"></label>
                            </div> 

                      <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick" name="division">
                                       <option  disabled  {{ $user->division == 0 ? 'selected' : '' }} > Select division</option>
                                      @foreach($division as $key => $value)
                                        <option value="{{ strtoupper($value->name) }}" {{ strtoupper($user->division) == strtoupper($value->name) ? 'selected' : '' }} >{{ strtoupper($value->name) }}</option>
                                      @endforeach
                                      </select>
                                </div>
                                <label id="division-error" class="error" for="division"></label>
                            </div> 


                         <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick" name="position">
                                       <option  disabled  {{ $user->position == 0 ? 'selected' : '' }} > Select Position </option>
                                      @foreach($position as $key => $value)
                                        <option value="{{ strtoupper($value->name) }}" {{ strtoupper($user->position) == strtoupper($value->name) ? 'selected' : '' }} >{{ strtoupper($value->name) }}</option>
                                      @endforeach
                                      </select>
                                </div>
                                <label id="position-error" class="error" for="position"></label>
                            </div> 



                            <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick salary-computation" name="salary_grade">
                                       <option  disabled >Salary Grade</option>
                                      @for ($i = 1; $i <= 33; $i++)
                                        <option value="{{ $i }}" {{ $i == $user->salary_grade ? 'selected' : '' }} >Salary Grade {{ $i }}</option>
                                      @endfor
                                      </select>
                                </div>
                                <label id="salary_grade-error" class="error" for="salary_grade"></label>
                            </div> 


                            <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick" name="level">
                                       <option  disabled selected >Level</option>
                                      @for ($i = 1; $i <= 3; $i++)
                                        <option value="{{ $i }}" {{ $i == $user->level ? 'selected' : '' }} >Level {{ $i }}</option>
                                      @endfor
                                      </select>
                                </div>
                                <label id="level-error" class="error" for="level"></label>
                            </div> 
                        


                            <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick salary-computation" name="step_increment">
                                       <option  disabled selected >Step Increment</option>
                                      @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ $i == $user->step_increment ? 'selected' : '' }} >Step Increment {{ $i }}</option>
                                      @endfor
                                      </select>
                                </div>
                                <label id="step_increment-error" class="error" for="step_increment"></label>
                            </div> 
                        


                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control noSpace money" value="{{ number_format($user->salary_amount ,2,'.', ',')  }}" name="salary_amount" required aria-required="true">
                                    <label class="form-label" >Salary Amount</label>
                                </div>
                                <label id="salary_amount-error" class="error" for="salary_amount"></label>
                            </div>


                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control noSpace" name="email"  value="{{ $user->email }}" required aria-required="true">
                                <label class="form-label" >Email</label>
                            </div>
                            <label id="email-error" class="error" for="email"></label>
                        </div>


                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control noSpace" name="biometric_id"  value="{{ $user->biometric_id }}" required aria-required="true">
                                <label class="form-label" >Bio Metric Id</label>
                            </div>
                            <label id="biometric_id-error" class="error" for="biometric_id"></label>
                        </div>


                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <input type="text" class="form-control noSpace" name="biometric"  value="{{ $user->biometric }}" required aria-required="true">
                                <label class="form-label" >Bio Metric</label>
                            </div>
                            <label id="biometric-error" class="error" for="biometric"></label>
                        </div>


                         <div class="form-group form-float">
                                <div class="form-line">
                                      <select class="form-control show-tick salary-computation" name="dual_account">
                                       <option  disabled selected> Dual Account (w/ Administrator Privilege)</option>
                                       <option value="0" {{ 0 == $user->dual_account ? 'selected' : '' }} >User Account Only</option>
                                       <option value="1" {{ 1 == $user->dual_account ? 'selected' : '' }} >With Administrator Privilege</option>
                                    
                                      </select>
                                </div>
                                <label id="dual_account-error" class="error" for="dual_account"></label>
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
 <script src="{{ asset('admin-assets/js/jquery.allmask.min.js') }}"></script>
   <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script>
   <script type="text/javascript">
         setTimeout(function() {
            $('.form-line').addClass('focused');
         }, 100);

           $(document).ready(function(){
            $('.money').mask('000,000,000,000,000.00', {reverse: true});
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

   </script>
@endsection