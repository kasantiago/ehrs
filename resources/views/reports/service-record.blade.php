<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <title>Service Record</title>

  <link rel="icon" href="{{ asset('DOH.ico') }}" type="image/x-icon">

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
      font-size: 10pt;
    }
    @page {
      margin-top: 50px;
      margin-bottom: 50px;
      margin-left: 50px;
      margin-right: 65px;
    }
    .table{
      border-collapse: collapse;
    }
    .table th, .table td{
      border-collapse: collapse;
      border: 0;
    }
    .tabletwo{
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }
    .tabletwo th, .tabletwo td{
      border-collapse: collapse;
      border: 1px solid #000;
    }
    
  </style>

</head>
<body>

<div class="container-fluid">
  
  <div>
    <div style="text-align: center; font-size: 11pt; font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;">
      S e r v i c e &nbsp; &nbsp; R e c o r d
      <br>
      (To be accomplished by the Employee)
    </div>

    <div style="margin-left: 392px; text-align: left; line-height: 100%;">
      (If married woman, give also
      <br>
      maiden name) Date herein should
      <br>
      be checked from birth or baptismal
      <br>
      certificate or some reliable sources.
    </div>
  </div>

  <div>
    <table class="table">
      <tbody>
        <tr style="">
          <td style="width: 50px;">NAME</td>
          <td style="width: 180px; border-bottom: 1px solid #000;">&nbsp; {!! $user->surname !!}</td>
          <td style="width: 180px; border-bottom: 1px solid #000;">&nbsp;{!! $user->first_name !!}</td>
          <td style="width: 50px; border-bottom: 1px solid #000;">&nbsp; {!! substr($user->middle_name, 0, 1) !!}.</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>(SURNAME)</td>
          <td>(GIVEN NAME)</td>
          <td>(M.I.)</td>
        </tr>
        <tr>
          <td>BIRTH</td>
          <td style="border-bottom: 1px solid #000;">&nbsp; {!! date("F d, Y",strtotime($user->date_of_birth)) !!}</td>
          <td style="border-bottom: 1px solid #000;">&nbsp;{!! $user->place_of_birth !!}</td>
          <td style="border-bottom: 1px solid #000;">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>(Date of Birth)</td>
          <td>(Place)</td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is to certify that the employee named above actually rendered service in this <br> office as shown by the service record below each line of which is supported by an <br> appointment and other papers actually issued by this Office and approved by the <br> authorities concerned.
  </div>

  <div>
    <table class="tabletwo">
      <tbody>
        <tr style="">
          <td colspan="9">Record of Appointment Office/Entity/Division Place of Ass. Leave of Absence/Separation</td>
        </tr>
        <tr>
          <td colspan="2">Inclusive Dates</td>
          <td>Designation</td>
          <td>Status</td>
          <td style="width: 20px;">Salary</td>
          <td colspan="2">Station/Branch</td>
          <td style="width: 10px;">W/out pay</td>
          <td style="width: 15px; word-wrap: break-word;">Date/Cause</td>
        </tr>
       @foreach($service_record as $key => $row)
        <tr style="font-size: 10px;">
          <td style="width: 20px; word-wrap: break-word;">{!! date('m/d/Y', strtotime($row->inclusive_date_from))  !!}</td>
          <td style="width: 20px; word-wrap: break-word;">{!! $row->inclusive_date_to !!}</td>
          <td>{!! $row->position_title !!}</td>
          <td>{!! $row->status_of_appointment !!}</td>
          <td>{!! number_format($row->service_record_salary ,2,'.', ',')  !!}</td>
          <td style="word-wrap: break-word;">{!! $row->dept_agency_office_company !!}</td>
          <td style="width: 20px; word-wrap: break-word;">{!! $row->agency_type !!}</td>
          <td>{!! $row->pay !!}</td>
          <td>{!! $row->cause !!}</td>
        </tr>
       @endforeach
       <!--  <tr>
          <td>01-01-2015</td>
          <td>12-31-2015</td>
          <td>Manager</td>
          <td>Permanent</td>
          <td>300,000.00</td>
          <td>DOH-RHO#2</td>
          <td>National</td>
          <td>None</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>01-01-2016</td>
          <td>12-31-2016</td>
          <td>General Manager</td>
          <td>Permanent</td>
          <td>400,000.00</td>
          <td>DOH-RHO#2</td>
          <td>National</td>
          <td>None</td>
          <td>&nbsp;</td>
        </tr> -->
      </tbody>
    </table>
  </div>

  <br>

  <div>
    &nbsp;NOTE: &nbsp; Not valid without official seal of the office.
    <br>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Issued in compliance with Executive Order No. 34, dated August 10, 1954 in accordance
    <br>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;with Circular No. 58 dated August 10, 1954 of the system.
  </div>

  <br>

  <div>
    &nbsp;CERTIFIED CORRECT:
    <br><br><br>
    <table class="tabletwo">
      <tbody>
        <tr>
          <td style="border: 0; width: 50%;">DOMINGO K. LAVADIA</td>
          <td style="border: 0; width: 50%;">{!! $dateNow !!}</td>
        </tr>
        <tr>
          <td style="border: 0;">Chief Administrative Officer</td>
          <td style="border: 0;">(Date)</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>