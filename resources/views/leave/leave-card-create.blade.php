@extends('layouts.app')
@section('title','CREATE EMPLOYEES LEAVE CARD DATA')

@section('content')


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>CREATE EMPLOYEES LEAVE CARD DATA</h2>
                <!-- <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                 
                    </li>
                </ul> -->
            </div>
            <div class="body">
                <form  method="POST" novalidate="novalidate" action="{{ url('leave-management/leave-card/store') }}">
                 
                    {{ csrf_field() }}

                    

                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <h4><br>{{ $user->name }}</h4>
                                <label class="form-label" >Full Name</label>
                            </div>
                          
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <h4><br>{{ $user->position }}</h4>
                                <label class="form-label" >Position</label>
                            </div>
                          
                        </div>
                      </div>


                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                       <div class="form-group form-float">
                            <div class="form-line focused">
                                <h4><br>{{ $user->division }}</h4>
                                <label class="form-label" >Unit/Division</label>
                            </div>
                          
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                        <div class="input-group">
                            <a style="cursor:pointer;" class="input-group-addon" data-toggle="modal" data-target="#smallModal">
                              <i class="material-icons">settings</i>
                            </a>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps date-range" autocomplete="off" value="" name="six_c_inclusive_dates" required aria-required="true">
                              <label class="form-label">Period</label>
                          </div>
                        </div>
                          <label id="period-error" class="error" for="period"></label>
                      </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">

                        <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                          <div class="form-line focused">
                               <input type="text" class="form-control all-caps"  name="six_c_for" autocomplete="off" required aria-required="true">
                              <label class="form-label">Bal Brought Forward</label>
                          </div>
                         </div>
                          <label id="bal_brought_forward-error" class="error" for="bal_brought_forward"></label>
                      </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                       <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps decimal vacation_earned_default_value noSpace" name="vacation_earned" required aria-required="true">
                              <label class="form-label">Vacation Earned</label>
                          </div>
                        </div>
                          <label id="vacation_earned-error" class="error" for="vacation_earned"></label>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                       <div class="input-group">
                           <span class="input-group-addon">
                                <i class="material-icons" style="color: #ffffff;">input</i>
                           </span>
                          <div class="form-line ">
                              <input type="text" class="form-control all-caps decimal vacation_abs_und_w_pay_dafault_value  noSpace" name="vacation_abs_und_w_pay" required aria-required="true">
                              <label class="form-label">Vacation Absence Undertime w/ Pay</label>
                          </div>
                          </div>
                          <label id="vacation_abs_und_w_pay-error" class="error" for="vacation_abs_und_w_pay"></label>
                      </div>
                    </div>
            

                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <div class="form-group form-float">
                         <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                            <div class="form-line focused">
                                <h4><br><text id="vacation_balance">{{ $latest->vacation_balance }}</text></h4>
                                <label class="form-label" >Vacation Balance</label>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                         <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps decimal  noSpace" name="vacation_abs_und_wout_pay" required aria-required="true">
                              <label class="form-label">Vacation Absence Undertime w/out Pay</label>
                          </div>
                        </div>
                          <label id="vacation_abs_und_wout_pay-error" class="error" for="vacation_abs_und_wout_pay"></label>
                      </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                           <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps decimal sick_earned_dafault_value noSpace" name="sick_earned" required aria-required="true">
                              <label class="form-label">Sick Earned</label>
                          </div>
                        </div>
                          <label id="sick_earned-error" class="error" for="sick_earned"></label>
                      </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                           <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps decimal sick_abs_und_w_pay_dafault_value  noSpace" name="sick_abs_und_w_pay" required aria-required="true">
                              <label class="form-label">Sick Undertime w/ Pay</label>
                          </div>
                        </div>
                          <label id="sick_abs_und_w_pay-error" class="error" for="sick_abs_und_w_pay"></label>
                      </div>
                    </div>
                    

                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <div class="form-group form-float">
                         <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>    
                            <div class="form-line focused">
                                <h4><br><text id="sick_balance">{{ $latest->sick_balance }}</text></h4>
                                <label class="form-label" >Sick Balance</label>
                            </div>
                          </div>
                        </div>
                      </div>

                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                           <div class="input-group">
                             <span class="input-group-addon">
                                  <i class="material-icons" style="color: #ffffff;">input</i>
                             </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps decimal  noSpace" name="sick_abs_und_wout_pay" required aria-required="true">
                              <label class="form-label">Vacation Absence Undertime w/out Pay</label>
                          </div>
                        </div>
                          <label id="sick_abs_und_wout_pay-error" class="error" for="sick_abs_und_wout_pay"></label>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                       <div class="input-group">
                         <span class="input-group-addon">
                              <i class="material-icons" style="color: #ffffff;">input</i>
                         </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps" name="etd" required aria-required="true">
                              <label class="form-label">ETD</label>
                          </div>
                        </div>
                          <label id="etd-error" class="error" for="etd"></label>
                      </div>
                    </div>
                    

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group form-float">
                       <div class="input-group">
                           <span class="input-group-addon">
                                <i class="material-icons" style="color: #ffffff;">input</i>
                           </span>
                          <div class="form-line focused">
                              <input type="text" class="form-control all-caps" name="remarks" required aria-required="true">
                              <label class="form-label">Remarks</label>
                          </div>
                        </div>
                          <label id="remarks-error" class="error" for="remarks"></label>
                      </div>
                    </div>
                    

                    <input type="hidden" name="user_id" value="{{ encrypt($user_id) }}">

                        <button class="btn {{ $color[2] }} waves-effect" type="submit">SUBMIT</button>
            
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
                  
                  <input name="date_picker"  type="radio" id="single_date_picker"  class="with-gap radio-col-black" />
                  <label for="single_date_picker">Single Date Picker</label> <br>
                  <input name="date_picker" type="radio" id="date_range_picker" checked class="with-gap radio-col-black" />
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
  <script src="{{ asset('admin-assets/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('admin-assets/js/jquery.allmask.min.js') }}"></script>

  <script src="{{ asset('admin-assets/js/bootstrap-datepicker.js') }}"></script> 
  
  <script type="text/javascript" src="{{ asset('admin-assets/js/moment.min.js') }}"></script>
  
  <script type="text/javascript" src="{{ asset('admin-assets/js/jquery.daterangepicker.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('admin-assets/js/range-datepicker.js') }}"></script>
 


  <script type="text/javascript">


$('#single_date_picker').on('click',function(){

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

    $('#smallModal').modal('hide');
  


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


    $('#smallModal').modal('hide');
  

});




  $('input[name="six_c_inclusive_dates"]').on('change paste keyup keydown blur',function(){

      input = $(this);

      if ($('#date_range_picker').is(':checked')){
          // append goes here
          input = input.val().split("-");

         // alert(input[0]+'=='+input[1]);

          if($.trim(input[0]) == $.trim(input[1])){
            
             $('input[name="six_c_inclusive_dates"]').val($.trim(input[0]));
             $('input[name="six_c_for"]').val(1);

          }

      }

  });


    input = $('input[name="six_c_inclusive_dates"]').val().split("-");

    if($.trim(input[0]) == $.trim(input[1])){
       $('input[name="six_c_inclusive_dates"]').val($.trim(input[0]));
       $('input[name="six_c_for"]').val(1);
    }

    
    $('input[name="six_c_inclusive_dates"]').val('');
    $('input[name="six_c_for"]').val('');




//     $('input[name="six_c_inclusive_dates"]').on('change',function(){
//        var getNumbers = $(this).val().split('').filter(function(item) {
//         return item === ','
//       }).length;
//        getNumbers = getNumbers+1;

//        $('input[name="six_c_for"]').val(getNumbers);
//        $('input[name="six_c_for"]').parent().addClass('focused');
//     });



    current_vacation_balance = parseFloat("{{ $latest->vacation_balance }}");
    current_sick_balance = parseFloat("{{ $latest->sick_balance }}");


    $(document).ready(function(){
      



        
        $('input[name="vacation_earned"]').on('keyup',function(){
            vacation_earned = parseFloat($(this).val());
            vacation_abs_und_w_pay = parseFloat($('input[name="vacation_abs_und_w_pay"]').val());
            $('#vacation_balance').text(current_vacation_balance + vacation_earned - vacation_abs_und_w_pay);
          });


        $('.vacation_earned_default_value').on("keyup", function () {
            if ($(this).val().length == 0) {
                $(this).val("0");
                $(this).parent().addClass("focused");

                 vacation_abs_und_w_pay = parseFloat($('input[name="vacation_abs_und_w_pay"]').val());

                $('#vacation_balance').text(current_vacation_balance - vacation_abs_und_w_pay);
            }
        });
        $('.vacation_earned_default_value').trigger("keyup");






         $('input[name="vacation_abs_und_w_pay"]').on('keyup',function(){
            vacation_abs_und_w_pay = parseFloat($(this).val());
            vacation_earned = parseFloat($('input[name="vacation_earned"]').val());
            $('#vacation_balance').text(current_vacation_balance - vacation_abs_und_w_pay + vacation_earned);
         });


        $('.vacation_abs_und_w_pay_dafault_value').on("keyup", function () {
            if ($(this).val().length == 0) {
                $(this).val("0");
                $(this).parent().addClass("focused");

                 vacation_abs_und_w_pay = parseFloat($('input[name="vacation_earned"]').val());

                $('#vacation_balance').text(current_vacation_balance + vacation_abs_und_w_pay);
            }
        });

        $('.vacation_abs_und_w_pay_dafault_value').trigger("keyup");




///////////////////////////////////////////////////////////////////////////////

  
   
        $('input[name="sick_earned"]').on('keyup',function(){
            sick_earned = parseFloat($(this).val());
            sick_abs_und_w_pay = parseFloat($('input[name="sick_abs_und_w_pay"]').val());
            $('#sick_balance').text(current_sick_balance + sick_earned - sick_abs_und_w_pay);
          });


        $('.sick_earned_dafault_value').on("keyup", function () {
            if ($(this).val().length == 0) {
                $(this).val("0");
                $(this).parent().addClass("focused");

                 sick_abs_und_w_pay = parseFloat($('input[name="sick_abs_und_w_pay"]').val());

                $('#sick_balance').text(current_sick_balance - sick_abs_und_w_pay);
            }
        });
        $('.sick_earned_dafault_value').trigger("keyup");






         $('input[name="sick_abs_und_w_pay"]').on('keyup',function(){
            sick_abs_und_w_pay = parseFloat($(this).val());
            sick_earned = parseFloat($('input[name="sick_earned"]').val());
            $('#sick_balance').text(current_sick_balance - sick_abs_und_w_pay + sick_earned);
         });


        $('.sick_abs_und_w_pay_dafault_value').on("keyup", function () {
            if ($(this).val().length == 0) {
                $(this).val("0");
                $(this).parent().addClass("focused");

                 sick_abs_und_w_pay = parseFloat($('input[name="sick_earned"]').val());

                $('#sick_balance').text(current_sick_balance + sick_abs_und_w_pay);
            }
        });

        $('.sick_abs_und_w_pay_dafault_value').trigger("keyup");








    $('.decimal').keypress(function(event) {
      if (event.which != 46 && (event.which < 47 || event.which > 59))
      {
          event.preventDefault();
          if ((event.which == 46) && ($(this).indexOf('.') != -1)) {
              event.preventDefault();
          }
      }
    });

    $('input').on('focusout',function(){
      $(this).parent().addClass('focused');
    });



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

   });
  </script>
@endsection