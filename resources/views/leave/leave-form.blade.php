@extends('layouts.app')
@section('title','APPLICATION FOR LEAVE')

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
                          <div class="number count-to" id="leave_display" data-from="0" data-to="{{ $latest->vacation_balance }}" data-speed="1000" data-fresh-interval="10">{{ $latest->vacation_balance }}</div>
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
                          <div class="number count-to" data-from="0" id="sick_display" data-to="{{ $latest->sick_balance }}" data-speed="1000" data-fresh-interval="10">{{ $latest->sick_balance }}</div>
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
                <form method="POST" novalidate="novalidate" action="{{ url('leave/application/store') }}">
                             
                    {{ csrf_field() }}

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                          <h2>APPLICATION FOR LEAVE</h2>
                                            <small>     
                                                DETAILS OF APPLICATION <label id="personal_information-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                            </small>
                        
                                        </div>
                                        <div class="body">
                                          <div class="row clearfix">
                                            <div class="col-sm-6">
                                           <!--    <hr> -->
                                              <h2 class="card-inside-title">TYPE OF LEAVE  <small><label id="six_a_type_of_leave-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label></small></h2> 
                                                <div class="demo-radio-button">

                                                  <input name="six_a_type_of_leave" type="radio" id="radio_vacation_leave" value="vacation" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_vacation_leave"><b>Vacation Leave</b></label> <br>
                                                    <div style="margin-left:10%">
                                                      <input name="six_a_vacation_leave_data" type="radio" id="to_seek_employment" disabled value="to seek employment"  class="with-gap radio-col-black" />
                                                      <label for="to_seek_employment">to seek employment</label> <br>
                                                     <!-- <input name="six_a_vacation_leave_data"  type="radio" id="other_leave_vacation" value="others" disabled  class="with-gap radio-col-black" />
                                                       <label for="other_leave_vacation">Others</label> <br>
                                                      <input name="six_a_type_of_leave_data" type="text" id="others_input_leave_vacation"  class="timepicker form-control" disabled placeholder="Please specify">
                                                      <label id="six_a_type_of_leave_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label> -->
                                                    </div>

                                                  <br>


                                                  <input name="six_a_type_of_leave" type="radio" id="other_vacation" value="other vacation" class="with-gap radio-col-black" />
                                                  <label for="other_vacation"><b>Other Vacation Leave</b></label> <br>
                                                  <div style="margin-left:10%">
                                                      <input id="others_input_leave_vacation" name="six_a_type_of_leave_data" class="timepicker form-control" disabled placeholder="Please specify">
                                                      <label id="others_input_leave_vacation-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                                  </div>  

                                                  <br>
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_force" value="force" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_force"><b>Force Leave</b></label> <br>
                                                  
                                                 <!--  <br><br>
                                                  <input name="six_a_vacation_leave_data"  type="radio" id="radio_other_vacation_leave" value="others"  class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_other_vacation_leave"><b>Other Vacation Leave</b></label> <br>
                                                  <div style="margin-left:10%">
                                                        <input name="six_a_type_of_leave" type="text" id="others_input_leave_vacation"  class="timepicker form-control" disabled  placeholder="Please specify">
                                                        <label id="six_a_type_of_leave_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label> 
                                                  </div>  -->
                                                 
                                                  <hr>
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_sick" value="sick" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_sick"><b>Sick Leave</b></label> <br>

                                                  <hr>
                                                  <input name="six_a_type_of_leave" type="radio" id="radio_maternity" value="maternity" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="radio_maternity"><b>Maternity Leave</b></label> <br>

                                                  <hr>
                                                  <input name="six_a_type_of_leave" type="radio" id="other_leave_type" value="others" class="with-gap radio-col-black type_of_leave_class" />
                                                  <label for="other_leave_type"><b>Other Leave</b></label> <br>
                                                    <div style="margin-left:10%">
                                                        <input id="input_other_leave_type" name="six_a_type_of_leave_data" class="timepicker form-control" disabled placeholder="Please specify">
                                                        <label id="input_six_a_type_of_leave_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                                    </div> 
                                                </div>

                                            </div>

                                            <div class="col-sm-6">
                                             <!--  <hr> -->
                                              <div class="where-to-spent-container" style="display:none;">
                                                <h2 class="card-inside-title">Where will leave be spent</h2>
                                                  <div class="demo-radio-button">
                                                    

                                                    <div class="vacation-leave-container">
                                                     <label for="radio_49">In case of Vacation Leave</label><br>

                                                       <div style="margin-left:10%">
                                                        <input name="six_b_vacation_leave_be_spent" value="within philippines" type="radio"  id="within_philippines" class="with-gap radio-col-black" />
                                                        <label for="within_philippines">Within Philippines</label> <br>
                                                        <input name="six_b_vacation_leave_be_spent" type="radio" value="abroad" id="abroad" class="with-gap radio-col-black" />
                                                        <label for="abroad">Abroad</label> <br>
                                                        <input type="text" name="six_b_vacation_leave_be_spent_data" id="input_abroad" class="timepicker form-control" disabled placeholder="Please specify">
                                                         <label id="six_b_vacation_leave_be_spent_data-error" class="error" style="color:#F44336;font-weight:normal;font-size: 12px;" ></label>
                                                      </div>

                                                    </div>

                                                    <div class="sick-leave-container">
                                                
                                                       <label for="radio_49">In case of Sick Leave</label><br>

                                                       <div style="margin-left:10%">
                                                        <input name="six_b_sick_leave_be_spent" type="radio" value="in hospital" id="in_hospital" class="with-gap radio-col-black" />
                                                        <label for="in_hospital">In Hospital</label> <br>
                                                        <input type="text" name="six_b_sick_leave_be_spent_data" disabled id="in_hospital_data" class="timepicker form-control" placeholder="Please specify"><br>

                                                        <input name="six_b_sick_leave_be_spent" type="radio" value="out patient" id="out_patient" class="with-gap radio-col-black" />
                                                        <label for="out_patient">Out Patient</label> <br>
                                                        <input type="text" name="six_b_sick_leave_be_spent_data" disabled id="out_patient_data" class="timepicker form-control" placeholder="Please specify">
                                                    
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
                                                       <a style="cursor:pointer;" class="input-group-addon" data-toggle="modal" data-target="#datesSettings">
                                                          <i class="material-icons">settings</i>
                                                      </a>

                                                      <div class="form-line focused">
                                                          <input type="text" class="form-control all-caps date-range" autocomplete="off"  name="six_c_inclusive_dates" required aria-required="true">
                                                          <label class="form-label" >INCLUSIVE DATES</label>
                                                      </div>
                                                        <label id="six_c_inclusive_dates-error" class="error" ></label>
                                                     </div>

                                                      
                                                      
                                                    </div>
                                                  </div>

                                                  <div class="form-group form-float">
                                                     <div class="input-group">
                                                       <span class="input-group-addon">
                                                          <i class="material-icons" style="color: #dadada;">input</i>
                                                      </span>
                                                      <div class="form-line focused">
                                                          <input type="text" class="form-control all-caps" autocomplete="off" value="0" name="six_c_for" required aria-required="true" readonly="true">
                                                          <label class="form-label" >FOR  <small style="color:red;"><!-- (Estimated count please double check.) --></small> </label>
                                                      </div>
                                                       <label id="six_c_for-error" class="error" ></label>
                                                    </div>
                                                    
                                                  </div>


                                            </div>

                                            <div class="col-sm-6">
                                              <hr>
                                              <h2 class="card-inside-title"> COMMUTATION</h2>
                                                <div class="demo-radio-button">
                                                  
                                                  
                                                    <div style="margin-left:10%">
                                                      <input name="six_d_commutation" value="requested" type="radio" id="requested" class="with-gap radio-col-black" />
                                                      <label for="requested">Requested</label> <br>
                                                      <input name="six_d_commutation" value="not requested" type="radio" id="not_requested" class="with-gap radio-col-black number" />
                                                      <label for="not_requested">Not Requested</label> <br>
                                                     
                                                    </div>


                                                </div>

                                            </div>


                          

                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                

                    <button class="btn {{ $color[2] }} waves-effect submit-button" type="submit" >SUBMIT</button>

                </form>
            </div>
        </div>
    </div>





    <div class="modal fade" id="datesSettings" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="datesSettingsLabel">CALENDAR SETTING</h4>
                </div>
                <div class="modal-body">
                   <div style="margin-left:20%">
                      <input name="date_picker"  type="radio" id="single_date_picker" class="with-gap radio-col-black" />
                      <label for="single_date_picker">Single Date Picker</label> <br>
                      <input name="date_picker" type="radio" id="date_range_picker" checked class="with-gap radio-col-black" />
                      <label for="date_range_picker">Date Range Picker</label> <br>
                    </div>
                </div>
                <div class="modal-footer">
                  
                </div>
            </div>
        </div>
    </div>


<!-- 
<div class="modal fade" id="datesSettings" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="datesSettingsLabel">CALENDAR SETTING  <i class="material-icons" style="font-size: 17px;">date_range</i></h4>
                </div>
                <div class="modal-body">

                  <div style="margin-left:20%">
                    <input name="date_picker"  type="radio" id="single_date_picker" class="with-gap radio-col-black" />
                    <label for="single_date_picker">Single Date Picker</label> <br>
                    <input name="date_picker" type="radio" id="date_range_picker" checked class="with-gap radio-col-black" />
                    <label for="date_range_picker">Date Range Picker</label> <br>
                   
                  </div>


                <div class="modal-footer">
                  
                </div>
            </div>
        </div>
    </div>
 -->

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




      // var prop=false;
      // if(value == 1) {
      //    prop=true; 
      // }
      // $('#to_seek_employment').prop('checked',prop);


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

///////////////////////////////////////

vacation_balance = parseFloat("{{ $latest->vacation_balance }}").toFixed(3);
sick_balance = parseFloat("{{ $latest->sick_balance }}").toFixed(3);


  // $('.submit-button').on('mouseenter',function(){
  //   apprise('test');

  // });
  



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
            woutpay = (parseFloat($('input[name="six_c_for"]').val()) - parseFloat(vacation_balance)).toFixed(3);
            var messageError = 'Your remaining leave balance (<b><u>'+vacation_balance+'</u></b>) is not enough! <br> w/ Pay: <b><u>'+vacation_balance+'</u></b> <br> w/out Pay: <b><u>'+woutpay+'<u></b>';
            $('#six_c_for-error').html( messageError );

          }else{
            console.log('balance remaining ' + vacation_balance_total);

            // $('div#leave_display').html(vacation_balance_total);
            $('input[name="six_c_for"]').css({ 'color': 'black', 'font-size': '100%' });

            $('form').prop( "disabled", false );
            $('.submit-button').prop( "disabled", false );
            $('#six_c_for-error').html('');
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


            //$('#six_c_for-error').html('Your remaining sick and leave balance ('+ (parseFloat(sick_balance) + parseFloat(vacation_balance)).toFixed(3) +') is not enough!' );

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



  $('input[name="six_c_inclusive_dates"]').on('change paste keyup',function(){

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
$('input[name="six_c_inclusive_dates"]').val('');

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

    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/single-click-date-picker.js";///
    docHeadObj.appendChild(newScript);

    

    $('#datesSettings').modal('hide');
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


    var docHeadObj = document.getElementsByTagName("head")[0];
    var newScript= document.createElement("script");
    newScript.type = "text/javascript";
    newScript.src = public_url+"admin-assets/js/range-datepicker.js";///
    docHeadObj.appendChild(newScript);

    

    $('#datesSettings').modal('hide');
    // $('input[name="six_c_inclusive_dates"]').focus();




});




// Count FOR not working...

 
  


  
  </script>
@endsection