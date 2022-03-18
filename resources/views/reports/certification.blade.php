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
      font-size: 10pt;
    }
    @page {
      margin: 80px;
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

<title>Certification</title>

</head>
<body>

<div class="container-fluid">
  
  <div style="margin-left: 7px;">
    <img src="{{ asset('admin-assets/images/doh-ro2-header.jpg') }}" height="70" width="620" />
  </div>

  <br><br><br>

  <div style="text-align: center; font-size: 14pt;">
    <b>C E R T I F I C A T I O N</b>
  </div>

  <br><br><br>

  <div style="text-align: justify;">
    TO WHOM IT MAY CONCERN:
    <br><br>
    <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to CERTIFY that as per record on file in this Office, (NAME HERE), (POSITION HERE) is a (POSITION TYPE) employee of the Department of Health, Regional Office No. 02  from the period (FROM DATE) to (TO DATE) and is currently receiving an annual compensation including benefits and allowances amounting to (COST / IN WORDS) & (CENTAVOS/100) (Php (ANNUAL SALARY)).
    <br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This certification is issued upon request of (MR./MRS./MS. LASTNAME) to support his application for VISA/?.
    <br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Given this (DAY/th) day of (MONTH), (YEAR).
  </div>

  <br><br><br><br>

  <div style="text-align: center; margin-left: 320px;">
    <span style="font-weight: 900;">OFFICER HERE</span>
    <br>
    <span>Position of Officer</span>
  </div>  -->
  {!! $data !!}
  </div>

</div>

</body>
</html>