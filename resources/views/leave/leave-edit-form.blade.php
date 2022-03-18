@extends('layouts.app')
@section('title','APPLICATION FOR LEAVE UPDATE')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="col-sm-8">
               <!--  <h2>APPLICATION FOR LEAVE</h2> -->
               </div>

                 <div class="col-sm-2">

                    <div class="info-box bg-green hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">card_travel</i>
                      </div>
                      <div class="content">
                          <div class="text">VACTION LEAVE</div>
                          <div class="number count-to" id="leave_display" data-from="0" data-to="{{ number_format($latest->vacation_balance - $data->six_c_for,3) }}" data-speed="1000" data-fresh-interval="10">{{ number_format($latest->vacation_balance,3) }}</div>
                      </div>
                  </div>

                </div>  

                 <div class="col-sm-2">

                    <div class="info-box bg-cyan hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">local_hospital</i>
                      </div>
                      <div class="content">
                          <div class="text">SICK LEAVE</div>
                          <div class="number count-to" data-from="0" id="sick_display" data-to="{{ number_format($latest->sick_balance - $data->six_c_for,3) }}" data-speed="1000" data-fresh-interval="10">{{ number_format($latest->sick_balance,3) }}</div>
                      </div>
                  </div>
                    
                </div>
                <!-- <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                    
                    </li>
                </ul> -->


            </div>
            <div class="body">
                <form method="POST" novalidate="novalidate" action="{{ url('leave/application/update') }}">
                             
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ encrypt($data->id) }}" >

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">

                                          <div align="left">
                                            <h2>APPLICATION FOR LEAVE UPDATE</h2>
                                            <small>     
                                                DETAILS OF APPLICATION <label id="personal_information-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                            </small>
                                          </div>
                                          
                                           <div align="right" class="generate-button">

                                               <a type="button" href="{{ url('leave/pdf/application/'.$id) }}" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;" target="_blank">
                                                   <i class="material-icons">picture_as_pdf</i> &nbsp; GENERATE &nbsp;  <i class="material-icons">file_download</i> 
                                               </a>

                                           </div>

                                       
                                        
                                        </div>
                                        <div class="body">
                                          <div class="row clearfix">
                                            <div class="col-sm-6">
                                              <hr>
                                              <h2 class="card-inside-title">TYPE OF LEAVE   <small><label id="six_a_type_of_leave-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label></small></h2> 
                                                <div class="demo-radio-button">

                                                  <input name="six_a_type_of_leave" type="radio" id="radio_vacation_leave" {{ $data->six_a_type_of_leave == 'vacation' ? 'checked' : '' }} value="vacation" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_vacation_leave"><b>Vacation Leave</b></label> <br>
                                                    <div style="margin-left:10%">
                                                      <input name="six_a_vacation_leave_data" type="radio" id="to_seek_employment"  {{ $data->six_a_vacation_leave_data == 'to seek employment' ? 'checked' : 'disabled' }}  value="to seek employment"  class="with-gap radio-col-black" />
                                                      <label for="to_seek_employment">to seek employment</label> <br>
                                                      <input name="six_a_vacation_leave_data"  type="radio" id="other_leave_vacation" value="others" {{ $data->six_a_vacation_leave_data == 'others' ? 'checked' : '' }}   class="with-gap radio-col-black" />
                                                     <!--  <label for="other_leave_vacation">Others</label> <br>
                                                      <input name="six_a_type_of_leave_data" type="text" id="others_input_leave_vacation"  class="timepicker form-control" {{ $data->six_a_vacation_leave_data != 'others' ? 'disabled' : '' }}   placeholder="Please specify" value="{{ $data->six_a_type_of_leave_data }}">
                                                      <label id="six_a_type_of_leave_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label> -->
                                                    </div>

                                              

                                                  <br>


                                                  <input name="six_a_type_of_leave" type="radio" id="other_vacation" {{ $data->six_a_type_of_leave == 'other vacation' ? 'checked' : '' }} value="other vacation" class="with-gap radio-col-black" />
                                                  <label for="other_vacation"><b>Other Vacation Leave</b></label> <br>
                                                  <div style="margin-left:10%">
                                                      <input id="others_input_leave_vacation" name="six_a_type_of_leave_data" class="timepicker form-control" value="{{ $data->six_a_type_of_leave == 'other vacation' ? $data->six_a_type_of_leave_data : '' }}"  {{ $data->six_a_type_of_leave == 'other vacation' ? '' : 'disabled' }} placeholder="Please specify">
                                                      <label id="others_input_leave_vacation-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                                  </div>  

                                                  <br>
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_force" {{ $data->six_a_type_of_leave == 'force' ? 'checked' : '' }}  value="force" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_force"><b>Force Leave</b></label> <br>
                                                  
                                                 <!--  <br><br>
                                                  <input name="six_a_vacation_leave_data"  type="radio" id="radio_other_vacation_leave" value="others"  class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_other_vacation_leave"><b>Other Vacation Leave</b></label> <br>
                                                  <div style="margin-left:10%">
                                                        <input name="six_a_type_of_leave" type="text" id="others_input_leave_vacation"  class="timepicker form-control" disabled  placeholder="Please specify">
                                                        <label id="six_a_type_of_leave_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label> 
                                                  </div>  -->
                                                 
                                                  <hr>


                            <!--                   
                                                  <hr>
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_force" {{ $data->six_a_type_of_leave == 'force' ? 'checked' : '' }} value="force" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_force"><b>Force Leave</b></label> <br>

                                                  <hr><hr>   -->
                                                  
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_sick" {{ $data->six_a_type_of_leave == 'sick' ? 'checked' : '' }} value="sick" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_sick"><b>Sick Leave</b></label> <br>

                                                  <hr>
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_maternity" {{ $data->six_a_type_of_leave == 'maternity' ? 'checked' : '' }} value="maternity" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_maternity"><b>Maternity Leave</b></label> <br>

                                                  <hr>
                                                  <input name="six_a_type_of_leave" type="radio" id="other_leave_type" {{ $data->six_a_type_of_leave == 'others' ? 'checked' : '' }} value="others" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="other_leave_type"><b>Others Leave</b></label> <br>
                                                    <div style="margin-left:10%">
                                                        <input id="input_other_leave_type" name="six_a_type_of_leave_data" value="{{ $data->six_a_type_of_leave == 'others' ? $data->six_a_type_of_leave_data : '' }}" {{ $data->six_a_type_of_leave == 'others' ? '' : 'disabled' }} class="timepicker form-control" placeholder="Please specify">
                                                        <label id="input_six_a_type_of_leave_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                                    </div> 
                                                </div>

                                            </div>

                                            <div class="col-sm-6">
                                              <hr>
                                              <div class="where-to-spent-container" style="display:{{ $data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'sick'  ? 'block' : 'none' }};">
                                                <h2 class="card-inside-title">Where will leave be spent</h2>
                                                  <div class="demo-radio-button">
                                                    

                                                    <div class="vacation-leave-container" style="display:{{ $data->six_a_type_of_leave == 'vacation' ? 'block' : 'none' }};">
                                                     <label for="radio_49">In case of Vacation</label><br>

                                                       <div style="margin-left:10%">
                                                        <input name="six_b_vacation_leave_be_spent" value="within philippines" {{ $data->six_b_vacation_leave_be_spent == 'within philippines' ? 'checked' : '' }} type="radio"  id="within_philippines" class="with-gap radio-col-black" />
                                                        <label for="within_philippines">Within Philippines</label> <br>
                                                        <input name="six_b_vacation_leave_be_spent" type="radio" value="abroad" id="abroad" {{ $data->six_b_vacation_leave_be_spent == 'abroad' ? 'checked' : '' }} class="with-gap radio-col-black" />
                                                        <label for="abroad">Abroad</label> <br>
                                                        <input type="text" name="six_b_vacation_leave_be_spent_data" id="input_abroad" value="{{ $data->six_b_vacation_leave_be_spent_data }}" {{ $data->six_b_vacation_leave_be_spent == 'abroad' ? '' : 'disabled' }} class="timepick form-control"  placeholder="Please specify">
                                                         <label id="six_b_vacation_leave_be_spent_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                                      </div>

                                                    </div>

                                                    <div class="sick-leave-container"  style="display:{{ $data->six_a_type_of_leave == 'sick' ? 'block' : 'none' }};">
                                                
                                                       <label for="radio_49">In case of Sick Leave</label><br>

                                                       <div style="margin-left:10%">
                                                        <input name="six_b_sick_leave_be_spent" type="radio" {{ $data->six_b_sick_leave_be_spent == 'in hospital' ? 'checked' : '' }} value="in hospital" id="in_hospital" class="with-gap radio-col-black" />
                                                        <label for="in_hospital">In Hospital</label> <br>
                                                        <input type="text" name="six_b_sick_leave_be_spent_data" value="{{ $data->six_b_sick_leave_be_spent == 'in hospital' ? $data->six_b_sick_leave_be_spent_data : '' }}"  {{ $data->six_b_sick_leave_be_spent == 'in hospital' ? '' : 'disabled' }}  id="in_hospital_data" class="timepicker form-control" placeholder="Please specify"><br>

                                                        <input name="six_b_sick_leave_be_spent" type="radio" {{ $data->six_b_sick_leave_be_spent == 'out patient' ? 'checked' : '' }} value="out patient" id="out_patient" class="with-gap radio-col-black" />
                                                        <label for="out_patient">Out Patient</label> <br>
                                                        <input type="text" name="six_b_sick_leave_be_spent_data" value="{{ $data->six_b_sick_leave_be_spent == 'out patient' ? $data->six_b_sick_leave_be_spent_data : '' }}" {{ $data->six_b_sick_leave_be_spent == 'out hospital' ? '' : 'disabled' }}  id="out_patient_data" class="timepicker form-control" placeholder="Please specify">
                                                    
                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>

                                            </div>
                                            
                                          </div>

                                          <div class="row clearfix">

                                            <div class="col-sm-6">
                                              <hr>
                                              <h2 class="card-inside-title">NUMBER OF WORKING DAYS APPLIED</h2>
                                                <div class="demo-radio-button">

                                                  <div class="form-group form-float">
                                                     <div class="input-group">
                                                       <a style="cursor:pointer;" class="input-group-addon" data-toggle="modal" data-target="#smallModal">
                                                          <i class="material-icons">settings</i>
                                                       </a>

                                                        <div class="form-line">
                                                            <input type="text" class="form-control all-caps date-range" autocomplete="off" value="{{ $data->six_c_inclusive_dates }}" name="six_c_inclusive_dates" required aria-required="true">
                                                            <label class="form-label" >INCLUSIVE DATES</label>
                                                        </div>
                                                    </div>
                                                    <label id="six_c_inclusive_dates-error" class="error" ></label>
                                                  </div>

                                                  <div class="form-group form-float">
                                                  
                                                  <div class="input-group">
                                                       <span class="input-group-addon">
                                                            <i class="material-icons" style="color: #dadada;">input</i>
                                                      </span>

                                                    <div class="form-line">
                                                        <input type="text" class="form-control all-caps" value="{{ $data->six_c_for }}" name="six_c_for" autocomplete="off" required aria-required="true">
                                                        <label class="form-label" >FOR </label>
                                                    </div>
                                                      <label id="six_c_for-error" class="error" ></label>
                                                    </div>
                                                  
                                                  </div>

                                                </div>

                                            </div>

                                            <div class="col-sm-6">
                                              <hr>
                                              <h2 class="card-inside-title"> COMMUTATION</h2>
                                                <div class="demo-radio-button">
                                                  
                                                  
                                                    <div style="margin-left:10%">
                                                      <input name="six_d_commutation" {{ $data->six_d_commutation == 'requested' ? 'checked' : '' }} value="requested" type="radio" id="requested" class="with-gap radio-col-black" />
                                                      <label for="requested">Requested</label> <br>
                                                      <input name="six_d_commutation" {{ $data->six_d_commutation == 'not requested' ? 'checked' : '' }} value="not requested" type="radio" id="not_requested" class="with-gap radio-col-black" />
                                                      <label for="not_requested">Not Requested</label> <br>
                                                     
                                                    </div>


                                                </div>

                                            </div>

                          

                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                

                    <button class="btn {{ $color[2] }} waves-effect submit-button" type="submit">SUBMIT</button>

                </form>
            </div>
        </div>
    </div>





  <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" style="display: none;">
      <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="smallModalLabel">CALENDAR SETTING  <i class="material-icons" style="font-size: 17px;">date_range</i></h4>
              </div>
              <div class="modal-body">
                  
                
                <div style="margin-left:20%">
                  
                  <input name="date_picker"  type="radio" id="single_date_picker"  class="with-gap radio-col-black" {{ (strpos($data->six_c_inclusive_dates, "-") !== false)? '' : 'checked' }} />
                  <label for="single_date_picker">Single Date Picker</label> <br>
                  <input name="date_picker" type="radio"  id="date_range_picker" class="with-gap radio-col-black" {{ (strpos($data->six_c_inclusive_dates, "-") !== false)? 'checked' : '' }} />
                  <label for="date_range_picker">Date Range Picker</label> <br>
                 
                </div>


              <div class="modal-footer">
                 <!--  <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
               <!--    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
              </div>
          </div>
      </div>
  </div>


@endsection


@section('styles')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/customized-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/bootstrap-datepicker.css') }}" rel="stylesheet"> 

    
   <link href="{{ asset('admin-assets/css/daterangepicker.min.css') }}" rel="stylesheet"> 

   <style type="text/css">
     .form-group .form-line.focused .form-label {
          top: -13px;
          left: 0;
          font-size: 12px;
      }
   </style>
    
@endsection
@section('scripts')
  <script src="{{ asset('admin-assets/js/jquery.allmask.min.js') }}"></script>
  <!-- <script src="{{ asset('admin-assets/js/customized-scripts.js') }}"></script> -->

  <script src="{{ asset('admin-assets/js/bootstrap-datepicker.js') }}"></script> 
  
  <script type="text/javascript" src="{{ asset('admin-assets/js/moment.min.js') }}"></script>
  
  <script type="text/javascript" src="{{ asset('admin-assets/js/jquery.daterangepicker.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('admin-assets/js/range-datepicker.js') }}"></script>
 
  <script type="text/javascript">




    $('.type_of_leave_class:first').on('click',function(){
        $('#to_seek_employment').attr('disabled',false);
        $('#input_other_leave_type').attr('disabled',true);
        $('#others_input_leave_vacation').val(''); 
        $('#others_input_leave_vacation').attr('disabled',true);
    });


    $('#other_vacation').on('click',function(){
       $('#others_input_leave_vacation').attr('disabled',false);
       $('#to_seek_employment').prop('checked', false);
    });


    $('#to_seek_employment').on('click',function(){

      $('#others_input_leave_vacation').attr('disabled',true);
      $('#others_input_leave_vacation').val('');

    });





    $('.type_of_leave_class:not(:first)').on('click',function(){
        $('#to_seek_employment').attr('disabled',true);
        $('#to_seek_employment').prop('checked', false);
        $('#input_other_leave_type').attr('disabled',true);
        $('#input_other_leave_type').val('');
        $('#others_input_leave_vacation').val('');
        $('#others_input_leave_vacation').attr('disabled',true);
        $('#others_input_leave_vacation').val('');
    });


    $('.type_of_leave_class:last').on('click',function(){
      $('#input_other_leave_type').attr('disabled',false);
    });


    $('#within_philippines').on('click',function(){
       $('#input_abroad').val('');
       $('#input_abroad').attr('disabled',true);
    });

    $('#abroad').on('click',function(){
      $('#input_abroad').attr('disabled',false);
    });



  $('#in_hospital').on('click',function(){
    $('#in_hospital_data').attr('disabled',false);
    $('#out_patient_data').attr('disabled',true);
    $('#out_patient_data').val('');
  });



  $('#out_patient').on('click',function(){
    $('#in_hospital_data').attr('disabled',true);
    $('#out_patient_data').attr('disabled',false);
    $('#in_hospital_data').val('');
  });
  

 $('#radio_vacation_leave').on('click',function(){
    $('.where-to-spent-container').show(function(){
        $('.vacation-leave-container').fadeIn();
    });
    $('.sick-leave-container').hide();
    $('#in_hospital').prop('checked', false);
    $('#in_hospital_data').val('');
    $('#in_hospital_data').attr('disabled',true);
    $('#out_patient').prop('checked', false);
    $('#out_patient_data').val('');
    $('#out_patient_data').attr('disabled',true);


    $('#to_seek_employment').prop('checked', false);
    $('#to_seek_employment').attr('disabled',false);

 });


$('#radio_sick').on('click',function(){
    $('.where-to-spent-container').show(function(){
        $('.sick-leave-container').fadeIn();
    });
    $('.vacation-leave-container').hide();
    $('#within_philippines').prop('checked', false);
    $('#abroad').prop('checked', false);
    $('#input_abroad').val('');
    $('#input_abroad').attr('disabled',true);
 });


$('#radio_maternity,#other_leave_type,#radio_force,#other_vacation').on('click',function(){
   
    $('.where-to-spent-container').fadeOut();
    $('#in_hospital').prop('checked', false);
    $('#in_hospital_data').val('');
    $('#in_hospital_data').attr('disabled',true);
    $('#out_patient').prop('checked', false);
    $('#out_patient_data').val('');
    $('#out_patient_data').attr('disabled',true);
    $('#within_philippines').prop('checked', false);
    $('#abroad').prop('checked', false);
    $('#input_abroad').val('');
    $('#input_abroad').attr('disabled',true);

    $('#to_seek_employment').prop('checked', false);
    $('#to_seek_employment').attr('disabled',true);

});

$('.body').on('click',function(){
   $('#six_a_type_of_leave-error').text('');
   $('#six_a_type_of_leave_data-error').text('');
   $('#six_b_vacation_leave_be_spent_data-error').text('');
   $('#input_six_a_type_of_leave_data-error').text('');
});




$(document).ready(function(){


  $('form').submit(function(e) {

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
                  $('.appriseInner button').click();
                  
                    if(data.success == true){
                      window.location = data.url;
                    }else{
                      $.each( data.message, function( key, value ) {
                         $('#'+key+'-error').text(value[0]);
                         $('#'+key+'-error').prev().addClass('error focused');
                      });
                    }
                 }

          });

   return false;
  });


 $('input').on('focus',function(){
      $(this).parent().removeClass('error');
      $(this).parent().next().text('');
  });




vacation_balance = parseFloat("{{ $latest->vacation_balance }}").toFixed(3);
sick_balance = parseFloat("{{ $latest->sick_balance }}").toFixed(3);





  $('input[name="six_c_for"]').on('keypress',function(event) {

     if( isNaN( input ) ){
       
        return false;
       
       }else{
        

        if (event.which != 46 && (event.which < 47 || event.which > 59))
        {
            event.preventDefault();
            if ((event.which == 46) && ($(this).indexOf('.') != -1)) {
                event.preventDefault();
            }
        }

      }

  });


  $('input[name="six_c_inclusive_dates"],input[name="six_c_for"],#radio_vacation_leave,#radio_force,#radio_sick').on('keyup keydown keypress change blur click',function(){
      
       input = $('input[name="six_c_for"]').val();


      
  
          vacation_balance_total = parseFloat(vacation_balance).toFixed(3) - parseFloat(input).toFixed(3);
          
          if (isNaN(vacation_balance_total)) {
              vacation_balance_total = vacation_balance;
          }else{
            vacation_balance_total =  vacation_balance_total.toFixed(3);
          }


          sick_balance_total = parseFloat(sick_balance) + parseFloat(vacation_balance); 
          sick_balance_total = sick_balance_total - parseFloat(input).toFixed(3);

          if (isNaN(sick_balance_total)) {
            sick_balance_total = sick_balance;
          }else{
            sick_balance_total = sick_balance_total.toFixed(3);
          }
      
        if($('#radio_vacation_leave').is(':checked') || $('#radio_force').is(':checked')){

          // $('div#sick_display').html(sick_balance);

          if(vacation_balance_total <= 0){
           
            console.log('negative ' + vacation_balance_total);
         
            // $('div#leave_display').html(vacation_balance);
            $('input[name="six_c_for"]').css({ 'color': 'red', 'font-size': '150%' });

            $('form').prop( "disabled", true );
            // $('.submit-button').prop( "disabled", true );
          //  $('#six_c_for-error').html('Your remaining leave balance ('+vacation_balance+') is not enough!' );

             woutpay = (parseFloat($('input[name="six_c_for"]').val()) - parseFloat(vacation_balance)).toFixed(3);
            var messageError = 'Your remaining leave balance (<b><u>'+vacation_balance+'</u></b>) is not enough! <br> w/ Pay: <b><u>'+vacation_balance+'</u></b> <br> w/out Pay: <b><u>'+woutpay+'<u></b>';
            $('#six_c_for-error').html( messageError );

            // $('.generate-button').fadeOut();

          }else{
            console.log('balance remaining ' + vacation_balance_total);

            // $('div#leave_display').html(vacation_balance_total);
            $('input[name="six_c_for"]').css({ 'color': 'black', 'font-size': '100%' });

            $('form').prop( "disabled", false );
            $('.submit-button').prop( "disabled", false );
            $('#six_c_for-error').html('');
            $('.generate-button').fadeIn();
          }
        }

        if($('#radio_sick').is(':checked')){

          // $('div#leave_display').html(vacation_balance);

          if(sick_balance_total <= 0){
            console.log('negative ' + sick_balance_total);

            // $('div#sick_display').html(sick_balance);
            $('input[name="six_c_for"]').css({ 'color': 'red', 'font-size': '150%' });

            $('form').prop( "disabled", true );
            // $('.submit-button').prop( "disabled", true );

            // $('#six_c_for-error').html('Your remaining sick and leave balance ('+ (parseFloat(sick_balance) + parseFloat(vacation_balance)).toFixed(3) +') is not enough!' );
            woutpay = (parseFloat($('input[name="six_c_for"]').val()) - (parseFloat(sick_balance) + parseFloat(vacation_balance)).toFixed(3)).toFixed(3);
            var messageError = 'Your remaining sick and leave balance (<b><u>'+ (parseFloat(sick_balance) + parseFloat(vacation_balance)).toFixed(3) +'</u></b>) is not enough! <br> w/ Pay: <b><u>'+(parseFloat(sick_balance) + parseFloat(vacation_balance)).toFixed(3)+'</u></b> <br> w/out Pay: <b><u>'+woutpay+'<u></b>';
            if(parseFloat($('input[name="six_c_for"]').val()) > 5){
              messageError = messageError+'<br><b> PLEASE ATTACH MEDICAL CERTIFICATE UPON SUBMITTION OF YOUR SICK LEAVE! <b>';
            }
            $('#six_c_for-error').html( messageError );

          }else{
            console.log('balance remaining ' + sick_balance_total);

            // $('div#sick_display').html(sick_balance_total);
            $('input[name="six_c_for"]').css({ 'color': 'black', 'font-size': '100%' });

            $('form').prop( "disabled", false );
            $('.submit-button').prop( "disabled", false );
            $('#six_c_for-error').html('');

          }
        }

       


  });

// computation if balance is available



  $('input[name="six_c_inclusive_dates"]').on('change paste keyup keydown blur',function(){

      input = $(this);

      if ($('#date_range_picker').is(':checked')){
          // append goes here
          input = input.val().split("-");

         // alert(input[0]+'=='+input[1]);

          if($.trim(input[0]) == $.trim(input[1])){
            
             $('input[name="six_c_inclusive_dates"]').val($.trim(input[0]));
             // $('input[name="six_c_for"]').val(1);

          }

      }

  });


    



});





///////////////////////////////////////////////////////////////////////////////  


$('input[name="six_c_inclusive_dates"],input[name="six_c_for"]').on('focus',function(){
  $(this).parent().addClass('focused');
});




$('#single_date_picker').on('click',function(){

 
    // $('input[name="six_c_inclusive_dates"]').removeClass('date-range');
    // $('input[name="six_c_inclusive_dates"]').addClass('date');
    $('input[name="six_c_inclusive_dates"],input[name="six_c_for"]').val('');
    $('.date-range').data('daterangepicker').remove();

    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "stylesheet";
    newScript.src = public_url+"admin-assets/css/bootstrap-datepicker.css";///
    docHeadObj.appendChild(newScript);

    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/bootstrap-datepicker.js";///
    docHeadObj.appendChild(newScript);


  // $.getScript( public_url+"admin-assets/js/jquery.daterangepicker.min.js", function( data, textStatus, jqxhr ) {
  //   console.log( data ); // Data returned
  //   console.log( textStatus ); // Success
  //   console.log( jqxhr.status ); // 200
  //   console.log( "Load was performed." );
  // });


    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/single-click-date-picker.js";///
    docHeadObj.appendChild(newScript);

    

    $('#smallModal').modal('hide');
    // $('input[name="six_c_inclusive_dates"]').focus();


});






$('#date_range_picker').on('click',function(){

      


    $('input[name="six_c_inclusive_dates"],input[name="six_c_for"]').val('');

     $('.date-range').data('datepicker').remove();

    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "stylesheet";
    newScript.src = public_url+"admin-assets/css/daterangepicker.min.css";///
    docHeadObj.appendChild(newScript);


    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/moment.min.js";///
    docHeadObj.appendChild(newScript);

    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/jquery.daterangepicker.min.js";///
    docHeadObj.appendChild(newScript);

  // $.getScript( public_url+"admin-assets/js/jquery.daterangepicker.min.js", function( data, textStatus, jqxhr ) {
  //   console.log( data ); // Data returned
  //   console.log( textStatus ); // Success
  //   console.log( jqxhr.status ); // 200
  //   console.log( "Load was performed." );
  // });


    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/range-datepicker.js";///
    docHeadObj.appendChild(newScript);


    

    $('#smallModal').modal('hide');
    // $('input[name="six_c_inclusive_dates"]').focus();

//////// fix jquery range single pick error


});





@if(strpos($data->six_c_inclusive_dates, "-") !== false)
  
  console.log(1);

    // $('.date-range').data('datepicker').remove();

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "stylesheet";
    // newScript.src = public_url+"admin-assets/css/daterangepicker.min.css";///
    // docHeadObj.appendChild(newScript);

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "text/javascript";
    // newScript.src = public_url+"admin-assets/js/moment.min.js";///
    // docHeadObj.appendChild(newScript);

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "text/javascript";
    // newScript.src = public_url+"admin-assets/js/jquery.daterangepicker.min.js";///
    // docHeadObj.appendChild(newScript);

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "text/javascript";
    // newScript.src = public_url+"admin-assets/js/range-datepicker.js";///
    // docHeadObj.appendChild(newScript);

@else

console.log(2);
    // $('.date-range').data('daterangepicker').remove();

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "stylesheet";
    // newScript.src = public_url+"admin-assets/css/bootstrap-datepicker.css";///
    // docHeadObj.appendChild(newScript);

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "text/javascript";
    // newScript.src = public_url+"admin-assets/js/bootstrap-datepicker.js";///
    // docHeadObj.appendChild(newScript);

    // var docHeadObj = document.getElementsByTagName("head")[0];
    // var newScript= document.createElement("script");
    // newScript.type = "text/javascript";
    // newScript.src = public_url+"admin-assets/js/single-click-date-picker.js";///
    // docHeadObj.appendChild(newScript);


@endif






    // input = $('input[name="six_c_inclusive_dates"]').val().split("-");

    // if($.trim(input[0]) == $.trim(input[1])){
    //    $('input[name="six_c_inclusive_dates"]').val($.trim(input[0]));
    //    // $('input[name="six_c_for"]').val(1);
    // }

console.log({!! $data->six_c_inclusive_dates !!});

  
  </script>
@endsection