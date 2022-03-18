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
      margin: 10px 10px 10px 10px;
    }
    .tableone{
      width: 100%;
      border-collapse: collapse;
    }
    .tableone th, .tableone td{
      border-collapse: collapse;
      border: 0;
    }
    .table{
      width: 100%;
      border-collapse: collapse;
    }
    .table th, .table td{
      border-collapse: collapse;
      border: 1px solid #000;
    }
    
  </style>

<title>EMPLOYEES LEAVE CARD</title>

</head>
<body>

<div class="container-fluid">

  <div style="position: fixed; left: 160px; top: 25px;">
      <img src="{{ asset('admin-assets/images/doh-b-n-w.png') }}" height="80" width="80" />
  </div>

  <div style="text-align: center; font-size: 14pt;">
    <p style="font-family: "Times New Roman", Times, serif;">
      <span style="font-size: 12pt;">Republic of the Philippines</span> <br>
      <b>DEPARTMENT OF HEALTH</b> <br>
      <b><span style="font-size: 12pt;">Regional Office II</span></b> <br>
      <span style="font-size: 12pt;">Tuguegarao City, Cagayan</span>
    </p>
    <p style="margin-top: -10px;">
      <b>EMPLOYEES LEAVE CARD</b>
    </p>
  </div>

  <div style="text-align: center;">
    <table class="tableone" style="font-size: 12px; padding-bottom: 8px;">
      <tbody>
        <tr style="height: 25px;">
          <td style="text-align:left; width: 40px;">NAME</td>
          <td style="border-bottom: 1px solid #000; width: 220px;">&nbsp;</td>
          <td style="text-align:center; width: 60px;">POSITION</td>
          <td style="border-bottom: 1px solid #000; width: 170px;">&nbsp;</td>
          <td style="text-align:center; width: 40px;">ETD =</td>
          <td style="border-bottom: 1px solid #000;">&nbsp;</td>
          <td style="text-align:center; width: 40px;">UNIT</td>
          <td style="border-bottom: 1px solid #000;">&nbsp;</td>
        </tr>
      </tbody>
    </table>

    <table class="table" style="font-size: 12px;">
      <tbody>
        <tr style="height: 25px;">
          <td rowspan="2" style="vertical-align: bottom; text-align:center;">Period</td>
          <td style="text-align:center; font-size: 9.5pt;">PARTICULARS</td>
          <td colspan="4" style="text-align:center; font-weight: bold; font-size: 9.5pt;">VACATION LEAVE</td>
          <td colspan="4" style="text-align:center; font-weight: bold; font-size: 9.5pt;">SICK LEAVE</td>
          <td>&nbsp;</td>
        </tr>

        <tr style="height: 60px;">
          <td style="vertical-align: bottom; text-align:center; font-weight: bold;">BAL. BROUGHT FORWARD</td>
          <td style="vertical-align: bottom; text-align:center; width: 50px;">Earned</td>
          <td style="vertical-align: bottom; text-align:center; width: 65px;">Absence Undertime with Pay</td>
          <td style="vertical-align: bottom; text-align:center; width: 50px;">Balance</td>
          <td style="vertical-align: bottom; text-align:center; width: 65px;">Absence Undertime w/o Pay</td>
          <td style="vertical-align: bottom; text-align:center; width: 50px;">Earned</td>
          <td style="vertical-align: bottom; text-align:center; width: 65px;">Absence Undertime with Pay</td>
          <td style="vertical-align: bottom; text-align:center; width: 50px;">Balance</td>
          <td style="vertical-align: bottom; text-align:center; width: 65px;">Absence Undertime w/o Pay</td>
          <td style="vertical-align: bottom; text-align:center; width: 100px;">Remarks</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

        <tr style="height: 25px;">
          <td colspan="2" style="text-align:left; font-weight: bold; font-size: 9.5pt;">BALANCE carried forward</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
          <td style="text-align:center;">&nbsp;</td>
        </tr>

      </tbody>
    </table>
  </div>

</div>

</body>
</html>