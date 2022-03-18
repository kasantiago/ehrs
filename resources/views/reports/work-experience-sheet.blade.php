<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
   "http://www.w3.org/TR/REC-html40/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

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
      font-size: 11pt;
    }
    @page {
      margin-top: 50px;
      margin-bottom: 50px;
      margin-left: 30px;
      margin-right: 30px;
    }
    .container-fluid{
      border-collapse: collapse;
      border: 1px solid #000;
      height: 900px;
    }
    .head{
      font-family: arialnarrowbolditalic;
      text-align: center;
      font-size: 12pt;
      color: #fff;
      background-color: #C0C0C0;
      border-bottom: 1px solid #000;
      padding: 5px;
    }
    .instruct{
      font-family: arialnarrowitalic;
      border-bottom: 1px solid #000;
      padding: 5px;
    }
    .content{
      font-family: arialnarrow;
      padding: 10px;
    }
    .footer{
      font-family: arialnarrow;
      padding: 10px;
      text-align: center;
      float: right;
    }
    .iboldmo{
      font-family: arialnarrowbold;
    }
    
  </style>

@forelse ($service_record as $service_record)

  <title>Work Experience Sheet </title>

  </head>
  <body>

  <div class="container-fluid">
   
    <div class="head">WORK EXPERIENCE SHEET</div>

    <div class="instruct">
      <span style="font-family: arialnarrowbolditalic;">Instructions: </span> 1. Include only the work experiences relevant to the position being applied to.
      <br>
      <br>
      <span style="margin-left: 79px;">2. The duration should include start and finish dates, if known, month in abbreviated form, if known, and year in full.</span>
      <br>
      <span style="margin-left: 92px;">For the current position, use the word Present, e.g., 1998-Present. Work experience should be listed from most</span>
      <br>
      <span style="margin-left: 92px;">recent first.</span>
    </div>

    <div class="content">
      <ul>
        <li>Duration: <span class="iboldmo">{!! date("m/d/Y",strtotime($service_record->inclusive_date_from)) !!} to {{ $service_record->inclusive_date_to }}</span></li>
        <li>Position: <span class="iboldmo">{{ $service_record->position_title }}</span></li>
        <li>Name of Office/Unit: <span class="iboldmo">{{ $service_record->name_of_office_unit }}</span></li>
        <li>Immediate Supervisor: <span class="iboldmo">{{ $service_record->immediate_supervisor }}</span></li>
        <li>Name of Agency/Organization and Location: <span class="iboldmo">{{ $service_record->dept_agency_office_company }}</span></li>
      </ul>

      <p> &nbsp;&nbsp; > &nbsp; Summary of Actual Duties</p>

      <p> &nbsp; &nbsp; &nbsp; &nbsp; <span class="iboldmo">{{ $service_record->summary_of_duties }}</span></p>
    </div>

  </div>

  <br><br><br><br>

  <div class="footer">
    <u>{{ App\Http\Models\PersonalInformation::get_name($service_record->user_id) }}</u>
    <br>
    (Signature over Printed Name
    <br>
    of Employee/Applicant)
    <br><br>
    Date: <u>{!! date("m/d/Y",strtotime(Carbon\Carbon::now()->toDateString())) !!}</u>
  </div>

  </body>

@empty

@endforelse

</html>