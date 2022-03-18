<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <style type="text/css">

    @font-face {
      font-family: Calibri, sans-serif;
      src: url("{{ asset('storage/fonts/calibri.ttf') }}") format('truetype');
    }
    @font-face {
      font-family: Arial, Helvetica, sans-serif;
      src: url("{{ asset('storage/fonts/arial.ttf') }}") format('truetype');
    }
    @font-face {
      font-family: arialblack;
      src: url("{{ asset('storage/fonts/ariblk.ttf') }}") format('truetype');
      font-weight: bold;
    }
    @font-face {
      font-family: arialnarrow;
      src: url("{{ asset('storage/fonts/ARIALN.TTF') }}") format('truetype');
      font-weight: lighter;
    }
    @font-face {
      font-family: arialnarrowbold;
      src: url("{{ asset('storage/fonts/ARIALNB.TTF') }}") format('truetype');
    }
    @font-face {
      font-family: arialnarrowbolditalic;
      src: url("{{ asset('storage/fonts/ARIALNBI.TTF') }}") format('truetype');
    }
    @font-face {
      font-family: arialnarrowitalic;
      src: url("{{ asset('storage/fonts/ARIALNI.TTF') }}") format('truetype');
    }
    body {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 8pt;
    }
    @page {
      margin: 15px 50px 10px 40px;
    }
    .table{
      width: 100%;
      border-collapse: collapse;
    }
    .table th, .table td{
      border-collapse: collapse;
      border: 1px solid #000;
    }
    .tableone{
      width: 100%;
      border-collapse: collapse;
    }
    .tableone th, .tableone td{
      border-collapse: collapse;
      border: 0;
    }
    .label {
      padding-left: 7px;
      padding-top: -12px;
    }
    label {
      display: block;
      padding-left: 60px;
      padding-top: -15px;
      text-indent: -15px;
    }
    input {
      width: 16px;
      height: 16px;
      padding: 0;
      margin: 0;
      position: relative;
      top: -20px;
      *overflow: hidden;

    }
    input:before{
    /*content: '';
    background: #fff;
    border: 2px solid #000;
    display: inline-block;
    vertical-align: middle;
    width: 6px;
    height: 6px;
    padding: 2px;
    text-align: center;*/
  }


  </style>

<title>APPLICATION FOR LEAVE</title>

</head>
<body>

<div class="container-fluid">

  <div>
    C.S FORM No. 6 <br>
    Revised 1984
  </div>

  <div align="center" style="font-size: 14px; margin-top: 15px;">
    <b>APPLICATION FOR LEAVE</b>
  </div>

  <div align="right" style="margin-right: 50px;">
    Control No. AFL __________
  </div>

  <br>

  <div>
    <table class="table" style="font-weight: bold; width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; width: 20%; border-bottom: 0;">&nbsp; 1. &nbsp; OFFICE/AGENCY</td>
          <td style="width: 25%; border-bottom: 0; border-left: 0; border-right: 0;">&nbsp; 2. &nbsp; NAME (Last)</td>
          <td style="width: 25%;border-bottom: 0; border-left: 0; border-right: 0;">(First)</td>
          <td style="border-bottom: 0; border-left: 0;">(Middle)</td>
        </tr>

        <tr>
          <td style="height: 15px; text-align: center; border-top: 0;">{!! $data->office_agency !!}</td>
          <td style="text-align: center; border-top: 0; border-left: 0; border-right: 0;">{!! $data->last_name !!}</td>
          <td style="text-align: center; border-top: 0; border-left: 0; border-right: 0;">{!! $data->first_name !!}</td>
          <td style="text-align: center; border-top: 0; border-left: 0;">{!! $data->middle_name !!}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 15px;">
    <table class="table" style="font-weight: bold; width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; width: 33.33%; border-bottom: 0;">&nbsp; 3. &nbsp; DATE OF FILING</td>
          <td style="width: 33.33%; border-bottom: 0;">&nbsp; 4. &nbsp; POSITION</td>
          <td style="border-bottom: 0;">&nbsp; 5. &nbsp; MONTHLY SALARY</td>
        </tr>

        <tr>
          <td style="height: 15px; text-align: center; border-top: 0;">&nbsp;{!! date('m/d/Y', strtotime($data->date_of_filing)) !!}</td>
          <td style="text-align: center; border-top: 0;">&nbsp;{!! $data->position !!} </td>
          <td style="text-align: center; border-top: 0;">&nbsp;{!! number_format($data->monthly_salary ,2,'.', ',')  !!}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 15px;">
    <table class="table" style="font-weight: bold; width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; text-align: center;">DETAILS OF APPLICATION</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 15px;">
    <table class="tableone" style="width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; width: 50%;"><b>&nbsp; 6. a) TYPE OF LEAVE</b></td>
          <td colspan="2"><b>&nbsp; 6. b) Where will leave be spent</b></td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 13px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="vacation_leave" class="vacation_leave"  {!! ($data->six_a_type_of_leave == 'vacation' ? 'checked' : '') !!}/><div class="label">Vacation Leave</div></label></td>
          <td colspan="2" style="padding-left: 13px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (1) In case of Vacation Leave</td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 50px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="to_seek_emp" class="to_seek_emp" {!! ($data->six_a_vacation_leave_data == 'to seek employment' ? 'checked' : '') !!} /><div class="label">to seek employment</div></label></td>
          <td colspan="2" style="padding-left: 50px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="within_phil" class="within_phil" {!! ($data->six_b_vacation_leave_be_spent == 'within philippines' ? 'checked' : '') !!} /><div class="label">Within Philippines</div></label></td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 50px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="vacation_leave_others" class="vacation_leave_others"  {!! ($data->six_a_type_of_leave == 'other vacation' ||  $data->six_a_type_of_leave == 'force'? 'checked' : '') !!} /><div class="label">others <u>{!! ($data->six_a_type_of_leave == 'other vacation'  ? $data->six_a_type_of_leave_data : '') !!}{!! ($data->six_a_type_of_leave == 'force'  ? 'Force Leave &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '_____________') !!}  </u></div></label></td>
          <td colspan="2" style="padding-left: 50px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="vacation_leave_abroad" class="vacation_leave_abroad"  {!! ($data->six_b_vacation_leave_be_spent == 'abroad' ? 'checked' : '') !!} /><div class="label">Abroad (Specify) <u>{!! ($data->six_b_vacation_leave_be_spent == 'abroad'  ? $data->six_b_vacation_leave_be_spent_data.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '_____________') !!}  </u> </div></label></td>
        </tr>

        <tr>
          <td style="height: 20px; padding-left: 13px;" valign="bottom">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="sick_leave" class="sick_leave" {!! ($data->six_a_type_of_leave == 'sick' ? 'checked' : '') !!} /><div class="label">Sick</div></label></td>
          <td colspan="2" valign="bottom" style="padding-left: 13px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (2) In case of Sick Leave</td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 13px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="maternity_leave" class="maternity_leave"  {!! ($data->six_a_type_of_leave == 'maternity' ? 'checked' : '') !!}/><div class="label">Maternity</div></label></td>
          <td colspan="2" style="padding-left: 50px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="sick_leave_hospital" class="sick_leave_hospital" {!! ($data->six_b_sick_leave_be_spent == 'in hospital' ? 'checked' : '') !!} /><div class="label">In Hospital (Specify) <u>{!! ($data->six_b_sick_leave_be_spent == 'in hospital'  ? $data->six_b_sick_leave_be_spent_data.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '_____________') !!} </u> </div></label></td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 13px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="others_leave" class="others_leave"  {!! ($data->six_a_type_of_leave == 'others' ? 'checked' : '_____________') !!}/><div class="label">Others (Specify) <u>{!! ($data->six_a_type_of_leave == 'others'  ? $data->six_a_type_of_leave_data.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '_____________') !!}</div></label></td>
          <td colspan="2" style="padding-left: 50px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="sick_leave_out" class="sick_leave_out" {!! ($data->six_b_sick_leave_be_spent == 'out patient' ? 'checked' : '') !!} /><div class="label">Out Patient (Specify)  <u>{!! ($data->six_b_sick_leave_be_spent == 'out patient'  ? $data->six_b_sick_leave_be_spent_data.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '_____________') !!} </u></div></label></td>
        </tr>

        <tr>
          <td style="height: 23px;" valign="bottom"><b>&nbsp; c) NUMBER OF WORKING DAYS APPLIED</b></td>
          <td colspan="2" valign="bottom"><b>&nbsp; d) COMMUTATION</b></td>
        </tr>

        <tr>
          <td style="height: 15px;"><b>&nbsp; &nbsp; &nbsp; FOR : <u>{!! ($data->six_c_for  ? $data->six_c_for.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '_____________________________') !!}</u></b></td>
          <td><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="requested" {!! $data->six_d_commutation == 'requested'  ? 'checked' : '' !!} class="requested" /><div class="label">Requested</div></label></b></td>
          <td><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="not_requested" {!! $data->six_d_commutation == 'not requested'  ? 'checked' : '' !!} class="not_requested" /><div class="label">Not Requested</div></label></b></td>
        </tr>

        <tr>
          <td colspan="3" style="height: 15px;"><b>&nbsp; &nbsp; &nbsp; INCLUSIVE DATES : <u>{!! ($data->six_c_inclusive_dates  ? $data->six_c_inclusive_dates.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '__________________') !!}</u></b></td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td colspan="2" style="height: 15px; text-align: center;">_______________________</td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td colspan="2" style="height: 15px; text-align: center;">(Signature of Applicant)</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 15px;">
    <table class="table" style="font-weight: bold; width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; text-align: center;">DETAILS OF ACTION ON APPLICATION</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 15px;">
    <table class="tableone" style="width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; width: 50%;"><b>&nbsp; 7. a) CERTIFICATION OF LEAVE CREDITS</b></td>
          <td><b>&nbsp; 7. b) RECOMMENDATION</b></td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 13px;"><b>&nbsp; &nbsp; &nbsp; AS OF ________________________</b></td>
          <td style="padding-left: 2px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="approval" class="approval" /><div class="label">Approval</div></label></td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 50px;">&nbsp;</td>
          <td style="padding-left: 2px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <label><input type="checkbox" name="disapproval" class="disapproval" /><div class="label">Disapproval due to _____________________</div></label></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 15px;">
    <table class="table" style="width: 95%;" >
      <tbody>
        <tr>
          <td style="height: 15px; width: 15.5%; border-bottom: 0; text-align: center;">Vacation</td>
          <td style="width: 15.5%; border-bottom: 0; text-align: center;">Sick</td>
          <td style="width: 19%; border-bottom: 0; text-align: center;">Total</td>
          <td rowspan="5" style="width: 50%; text-align: center; border: 0; padding-bottom: -40px;"><b>______________________________ <br> (Authorized Official)</b></td>
        </tr>
        <tr>
        
         
          <td style="height: 15px; border-top: 0; border-bottom: 0; text-align: center;"> <div style=" border-bottom: 1px solid black; width:76px;float:left;margin-left:13px; " ><center>
          
              <!-- VACATION -->  
              {{ $latest->vacation_balance }}

          </center></div> </td>


          <td style="border-top: 0; border-bottom: 0; text-align: center;"> <div style=" border-bottom: 1px solid black; width:76px;float:left;margin-left:13px; " ><center>
          
                <!-- SICK --> 
                {{ $latest->sick_balance }} 

          </center></div></td>


          <td style="border-top: 0; border-bottom: 0; text-align: center;" rowspan="3">&nbsp;&nbsp; <font size="20px"> 
                  
                  <!-- TOTAL -->
                 
                   @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')

                        @if($data->six_c_for > $latest->vacation_balance)

                               {{ $latest->sick_balance }} 

                        @else
                          {{ $latest->vacation_balance - $data->six_c_for +  $latest->sick_balance}}
                        @endif
                  
                   @endif





                    @if($data->six_a_type_of_leave == 'sick')

                        @if($data->six_c_for > $latest->vacation_balance)
                           {{ $latest->vacation_balance }}
                        @else
                           {{ $data->six_c_for }}
                        @endif

                    @endif


                     @if($data->six_a_type_of_leave == 'sick')

                       @if($data->six_c_for < $latest->sick_balance)

                            {{ $latest->vacation_balance + ($latest->sick_balance -  $data->six_c_for) }} <!-- pasok -->

                       @elseif($data->six_c_for < ($latest->vacation_balance + $latest->sick_balance))

                            {{  ($latest->vacation_balance + $latest->sick_balance) - $data->six_c_for   }} 

                       @else

                          0<!--  pinka malaki -->

                       @endif
                          
                    @endif

  
          </font></td>
          
        </tr>
         




        <tr>
     

                  
                <td style="height: 15px; border-top: 0; border-bottom: 0; text-align: center;"> <div style=" border-bottom: 1px solid black; width:76px;float:left;margin-left:13px; " ><center>
                
                    <!-- LESS VACATION--> 

                    @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')

                        @if($data->six_c_for > $latest->vacation_balance)
                           {{ $latest->vacation_balance }}
                        @else
                          {{ $data->six_c_for }}
                        @endif

                    @endif



                     @if($data->six_a_type_of_leave == 'sick')

                       @if($data->six_c_for < $latest->sick_balance)

                           0 <!-- pasok -->

                       @elseif($data->six_c_for < ($latest->vacation_balance + $latest->sick_balance))

                           {{    $latest->vacation_balance - (($latest->vacation_balance + $latest->sick_balance) - $data->six_c_for) }} 

                       @else

                           {{ $latest->vacation_balance }} <!-- pinka malaki  -->

                       @endif
                          

                    @endif


                  

                </center></div> </td>


                <td style="border-top: 0; border-bottom: 0; text-align: center;"> <div style=" border-bottom: 1px solid black; width:76px;float:left;margin-left:13px; " ><center>
                
                      <!-- LESS SICK--> 

                   @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')

                       0

                   @endif

                  



                  @if($data->six_a_type_of_leave == 'sick')

                        @if($data->six_c_for > $latest->vacation_balance)
                           {{ $latest->vacation_balance }}
                        @else
                          {{ $data->six_c_for }}
                        @endif

                    @endif


                     @if($data->six_a_type_of_leave == 'sick')

                       @if($data->six_c_for < $latest->sick_balance)

                            {{ $data->six_c_for }} <!-- pasok -->

                       @elseif($data->six_c_for < ($latest->vacation_balance + $latest->sick_balance))

                            {{  $latest->sick_balance }}


                       @else

                            {{ $latest->sick_balance }} <!-- pinka malaki  -->

                       @endif
                          
                   @endif


                </center></div></td>

        </tr>


         
        <tr>

          
                  
              <td style="height: 15px; border-top: 0; border-bottom: 0; text-align: center;"> <div style=" border-bottom: 1px solid black; width:76px;float:left;margin-left:13px; " ><center><b>
              
                  <!-- REMAINING  VACATION--> 


                    @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')

                        @if($data->six_c_for > $latest->vacation_balance)
                             0
                        @else
                          {{ $latest->vacation_balance - $data->six_c_for }}
                        @endif
                    @endif




                   @if($data->six_a_type_of_leave == 'sick')

                       @if($data->six_c_for < $latest->sick_balance)

                           {{ $latest->vacation_balance }} <!-- pasok -->

                       @elseif($data->six_c_for < ($latest->vacation_balance + $latest->sick_balance))

                          {{  ($latest->vacation_balance + $latest->sick_balance) - $data->six_c_for   }} 

                       @else

                          0 <!--  pinka malaki -->

                       @endif
                          

                    @endif

              </b></center></div> </td>


              <td style="border-top: 0; border-bottom: 0; text-align: center;"> <div style=" border-bottom: 1px solid black; width:76px;float:left;margin-left:13px; " ><center><b>
              
                    <!-- REMAINING  SICK-->

                   @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')

                      {{ $latest->sick_balance }} 

                   @endif



                   @if($data->six_a_type_of_leave == 'sick')

                       @if($data->six_c_for < $latest->sick_balance)

                           {{ $latest->sick_balance -  $data->six_c_for }} <!-- pasok -->

                       @elseif($data->six_c_for < ($latest->vacation_balance + $latest->sick_balance))

                           0

                       @else

                           0<!-- pinka malaki -->

                       @endif
                          
                  @endif

              </b></center></div></td>
        </tr>


      

        <tr>
          <td style="height: 15px; text-align: center;">Days</td>
          <td style="text-align: center;">Days</td>
          <td style="text-align: center;">Days</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 45px;">
    <table class="tableone" style="width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; width: 50%; text-align: center;"><b><u>DOMINGO K. LAVADIA</u></b></td>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td style="height: 15px; text-align: center;">Administrative Officer V</td>
          <td>&nbsp;</td>
        </tr>

        <tr>
          <td style="height: 15px; text-align: center;">HRMO</td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </div>

  <hr>

  <div style="margin-top: 15px;">
    <table class="tableone" style="width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; width: 50%;"><b>&nbsp; 7. c) APPROVED FOR:</b></td>
          <td><b>&nbsp; 7. b) DISAPPROVED DUE TO:</b></td>
        </tr>

        
        <tr>
        @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')

          @if($data->six_c_for > $latest->vacation_balance)
            <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp; {{ $latest->vacation_balance }}</center></div> <div style="float:left">&nbsp;  <b>days with pay</b></div></div></td>
          @else
            <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp; {{ $data->six_c_for }} </center></div> <div style="float:left">&nbsp; <b>days with pay</b></div></div></td>

          @endif
       
        @elseif($data->six_a_type_of_leave == 'sick')


         @if($data->six_c_for > ($latest->sick_balance + $latest->vacation_balance))
            <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp; {{ ($latest->sick_balance + $latest->vacation_balance) }}</center></div> <div style="float:left">&nbsp;  <b>days with pay</b></div></div></td>
          @else
            <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp; {{ $data->six_c_for }} </center></div> <div style="float:left">&nbsp; <b>days with pay</b></div></div></td>

          @endif

        @else
            <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp; </center></div> <div style="float:left">&nbsp;  <b>days with pay</b></div></div></td>

        @endif

          <td style="padding-left: 8px;">________________________________________________</td>
        </tr>
        

        <tr>
          @if($data->six_c_for > $latest->vacation_balance)

      
           @if($data->six_a_type_of_leave == 'vacation' || $data->six_a_type_of_leave == 'force')
          <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp;{{ $data->six_c_for - $latest->vacation_balance }}</center></div> <div style="float:left">&nbsp; <b>days without pay</b></div></div></td>
            @elseif($data->six_a_type_of_leave == 'sick')
              <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp;

                    
                 {{   str_replace("-","",($latest->sick_balance + $latest->vacation_balance) -  $data->six_c_for) }} 



              </center></div> <div style="float:left">&nbsp; <b>days without pay</b></div></div></td>
            @else
             <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp;</center></div> <div style="float:left">&nbsp; <b>days without pay</b></div></div></td>
            @endif

          @else
          <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp;</center></div> <div style="float:left">&nbsp; <b>days without pay</b></div></div></td>
          @endif
          <td style="padding-left: 8px;">&nbsp;</td>
        </tr>

        <tr>
          <td style="height: 15px; padding-left: 8px;"><div><div style=" border-bottom: 1px solid black; width:76px;float:left;margin-top:3px; " ><center>&nbsp;</center></div> <div style="float:left">&nbsp; <b>Others (Specify)</b></div></div></td>
          <td style="padding-left: 8px;">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 35px;">
    <table class="tableone" style="width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; text-align: center;"><b>__________________________________</b></td>
        </tr>

        <tr>
          <td style="height: 15px; text-align: center;">(Signature)</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 35px;">
    <table class="tableone" style="width: 95%;">
      <tbody>
        <tr>
          <td style="height: 15px; text-align: center;"><b>_______________________________________</b></td>
        </tr>

        <tr>
          <td style="height: 15px; text-align: center;">(Authorized Official)</td>
        </tr>

        <tr>
          <td style="height: 15px;">Date:_______________</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div style="margin-top: 35px; position: absolute; bottom: 15px; font-size: 6.5pt;">
    <table class="tableone" style="width: 100%;">
      <tbody>
        <tr>
          <td style="height: 12px; width: 30px; padding-left: 15px;">1.</td>
          <td style="height: 12px;">Application for VACATION/SICK LEAVE for (1) full day shall made on this form and to be accomplished in triplicate</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">2.</td>
          <td style="height: 12px;">Application for Vacation Leave shal be filed in advance or whenever possible, five (5) days before such leave</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">3.</td>
          <td style="height: 12px;">Application for SICK Leave shall be filed immediately or at least within 3 days upon the employee's return to office. Sick Leave applications filed beyond 3 days upon return to</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">&nbsp;</td>
          <td style="height: 12px;">office may not be given due course as per Regional Office Memorandum no. 01 dated January 12, 2004.</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">4.</td>
          <td style="height: 12px;">Application for Sick Leave filed in advance, a medical certificate shall be attached if exceeding 5 days. If such medical consultation was not availed an affidavit should be</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">&nbsp;</td>
          <td style="height: 12px;">executed by the applicant.</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">5.</td>
          <td style="height: 12px;">An employee who is absent WITHOUT APPROVED LEAVE shall not be entitled to receive his/her salary corresponding to the period of his/her unauthorized leave of absences.</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">6.</td>
          <td style="height: 12px;">An application for LEAVE OF ABSENCE for 30 calendar days or more shall be accompanied by clearance from money and property responsibility/accountability.</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">7.</td>
          <td style="height: 12px;">An applicant who goes on Vacation Leave ahead of the approval of his/her supervisors such leave will be automatically disapproved under CSC Memorandun Circular No. 04</td>
        </tr>

        <tr>
          <td style="height: 12px; padding-left: 15px;">&nbsp;</td>
          <td style="height: 12px;">series of 1991.</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>