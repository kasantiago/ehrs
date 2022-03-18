<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
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
              font-family: "Times New Roman", Times, serif;
              font-size: 10pt;
            }
            @page {
              margin: 20px 10px 40px 10px;
            }
            .top {
              width: 100%;
              font-size: 12.5px;
            }
            .header {
              width: 100%;
              text-align: center;
              margin-top: 20px;
            }
            .head {
              font-size: 17px;
            }
            .subhead {
              font-size: 13.5px;
            }
            .subsubhead {
              font-size: 12.5px;
            }
            .note {
              font-size: 12.5px;
            }
            .chckbxline {
              text-align: left;
              margin-left: 190px;
            }
            .chckbxlinetwo {
              text-align: left;
              margin-left: 170px;
            }
            .checkbox {
              float: left;
              width: 20px;
            }
            .checkboxtext {
              float: left;
              width: 125px;
              margin-top: 3px;
              font-size: 13.5px;
            }
            .checkboxtexttwo {
              float: left;
              margin-top: 3px;
              font-size: 15.5px;
            }
            .content {
              margin-top: 35px;
              margin-left: 20px;
              margin-right: 20px;
            }
            .contenthead {
              font-size: 14.5px;
              text-align: center;
              margin-top: 15px;
              margin-bottom: 10px;
            }
            .table{
              border-collapse: collapse;
              width: 100%;
            }
            .table th, .table td{
              border-collapse: collapse;
              border: 0;
            }
            .tableborder{
              border-collapse: collapse;
              text-align: center;
              width: 100%;
            }
            .tableborder th, .tableborder td{
              border-collapse: collapse;
              border: 1px solid #000;
            }
            input[type=checkbox]
            {
              /* Double-sized Checkboxes */
              -ms-transform: scale(0.8); /* IE */
              -moz-transform: scale(0.8); /* FF */
              -webkit-transform: scale(0.8); /* Safari and Chrome */
              -o-transform: scale(0.8); /* Opera */
              padding: 0px;
            }
            hr.linebrk {
              overflow: visible; /* For IE */
              padding: 0;
              border: none;
              border-top: 3px double #333;
              color: #333;
              text-align: center;
            }
            .contenttext {
              width: 100%;
              margin-top: 15px;
              margin-left: 15px;
              margin-right: 15px;
              text-align: center;
              font-size: 16px;
            }
            .footersign {
              margin-left: 390px
              font-size: 15px;
              text-align: center;
            }

            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            /*@page {
                margin: 100px 10px;
            }*/

            footer {
                position: fixed;
                bottom: -20px;
                left: 0px;
                right: 0px;
                height: 40px;

                /** Extra personal styles **/
                color: #000;
                text-align: center;
                font-size: 15px;
            }

        </style>

        <title>SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH</title>
        
    </head>
    <body>
        <footer>
            <script type="text/php">
              if ( isset($pdf) ) { 
                  $pdf->page_script('
                      if ($PAGE_COUNT > 1) {
                          $font = $fontMetrics->get_font("Times New Roman, serif", "normal");
                          $size = 12;
                          $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                          $y = 905;
                          $x = 270;
                          $pdf->text($x, $y, $pageText, $font, $size);
                      } 
                  ');
              }
            </script>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div class="top">
              <span style="margin-left: 610px;">Revised as of January 2015</span> <br>
              <span style="margin-left: 610px;">Per CSC Resolution No. 1500088</span> <br>
              <span style="margin-left: 610px;">Promulgated on January 23, 2015</span>
            </div>

            <div class="header">
              <div class="head"><b>SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH</b></div>
              <div class="subhead">As of _______________________________</div>
              <div class="subsubhead">(Required by R.A. 6713)</div>
              <br>
              <div class="note"><b>Note: </b><i>Husband and wife who are both public officials and employees may file the required statements jointly or separately.</i></div>
              
              <div class="chckbxline">
                <div class="checkbox"><input type="checkbox" name="" id="" /></div>
                <div class="checkboxtext"><i>Joint Filing</i></div>

                <div class="checkbox"><input type="checkbox" name="" id="" /></div>
                <div class="checkboxtext"><i>Separate Filing</i></div>

                <div class="checkbox"><input type="checkbox" name="" id="" /></div>
                <div class="checkboxtext"><i>Not Applicable</i></div>
              </div>
            </div>

            <div class="content">
              <table class="table" style="font-size: 12px;">
                <tbody>
                  <tr style="height: 15px;">
                    <td style="width: 12%;"><b>DECLARANT:</b></td>
                    <td style="width: 17%; border-bottom: 1px solid #000; text-align: center;">{!! $personal_information->surname ? strtoupper($personal_information->surname) : '' !!}</td>
                    <td style="width: 17%; border-bottom: 1px solid #000; text-align: center;">{!! $personal_information->first_name ? strtoupper($personal_information->first_name) : '' !!} {!! $personal_information->name_extension ? strtoupper($personal_information->name_extension) : '' !!}</td>
                    <td style="width: 6%; border-bottom: 1px solid #000; text-align: center;">{!! $personal_information->middle_name ? strtoupper(substr($personal_information->middle_name, 0, 1).".") : '' !!}</td>
                    <td style="width: 18%;"><b style="margin-left: 15px;">POSITION:</b></td>
                    <td style="width: 30%; border-bottom: 1px solid #000; text-align: center; /* For Resizing */<?php if(strlen($work_experience->position_title)<=40){echo"font-size: 10px;";}elseif(strlen($work_experience->position_title)<=90){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $work_experience->position_title ? strtoupper($work_experience->position_title) : 'N/A' !!}</td>
                  </tr>

                  <tr style="height: 15px;">
                    <td>&nbsp;</td>
                    <td style="text-align: center;">(Family Name)</td>
                    <td style="text-align: center;">(First Name)</td>
                    <td style="text-align: center;">(M.I.)</td>
                    <td><b style="margin-left: 15px;">AGENCY/OFFICE:</b></td>
                    <td style="border-bottom: 1px solid #000; text-align: center; /* For Resizing */<?php if(strlen($work_experience->dept_agency_office_company)<=40){echo"font-size: 9px;";}elseif(strlen($work_experience->dept_agency_office_company)<=90){echo"font-size: 7px;";}else{echo"font-size: 6px;";}?>/* For Resizing */">{!! $work_experience->dept_agency_office_company ? strtoupper($work_experience->dept_agency_office_company) : 'N/A' !!}</td>
                  </tr>

                  <tr style="height: 15px;">
                    <td><b>ADDRESS:</b></td>
                    <td colspan="3" rowspan="2">
                      <div style="width: 100.7%; margin-left: -1px; border-bottom: 1px solid #000; text-align: center; /* For Resizing */<?php if(strlen($personal_information->p_address_house_block_lot_number) <=30 && strlen($personal_information->p_address_street) <=30 && strlen($personal_information->p_address_subdivision_village) <=30){echo"font-size: 9px;";}elseif(strlen($personal_information->p_address_house_block_lot_number)<=60 && strlen($personal_information->p_address_street) <=60 && strlen($personal_information->p_address_subdivision_village) <=60){echo"font-size: 7px;";}else{echo"font-size: 6px;";}?>/* For Resizing */">{!! $personal_information->p_address_house_block_lot_number ? strtoupper($personal_information->p_address_house_block_lot_number.",") : '' !!} {!! $personal_information->p_address_street ?  strtoupper($personal_information->p_address_street.",") : '' !!} {!! $personal_information->p_address_subdivision_village ? strtoupper($personal_information->p_address_subdivision_village.",") : '' !!}</div>
                      <div style="width: 100.7%; margin-left: -1px; border-bottom: 1px solid #000; text-align: center; /* For Resizing */<?php if(strlen($personal_information->p_address_barangay) <=30 && strlen($personal_information->p_address_city_municipality) <=30){echo"font-size: 9px;";}elseif(strlen($personal_information->p_address_barangay)<=60 && strlen($personal_information->p_address_city_municipality) <=60){echo"font-size: 7px;";}else{echo"font-size: 6px;";}?>/* For Resizing */">{!! $personal_information->p_address_barangay ? strtoupper($personal_information->p_address_barangay.",") : '' !!} {!! $personal_information->p_address_city_municipality ? strtoupper($personal_information->p_address_city_municipality.",") : '' !!} {!! $personal_information->p_address_province ? strtoupper($personal_information->p_address_province) : '' !!} {!! $personal_information->p_address_zipcode ? $personal_information->p_address_zipcode : '' !!}</div>
                    </td>
                    <td><b style="margin-left: 15px;">OFFICE ADDRESS:</b></td>
                    <td rowspan="2">
                      <div style="width: 100.7%; margin-left: -1px; border-bottom: 1px solid #000; text-align: center; /* For Resizing */<?php if(strlen($work_experience->office_address) <=30){echo"font-size: 9px;";}elseif(strlen($work_experience->office_address) <=60){echo"font-size: 7px;";}else{echo"font-size: 6px;";}?>/* For Resizing */">{!! $work_experience->office_address ? strtoupper($work_experience->office_address) : 'N/A' !!}</div>
                      <div style="width: 100.7%; margin-left: -1px; border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                  </tr>

                  <tr style="height: 15px;">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>

              <br>

              <table class="table" style="font-size: 12px;">
                <tbody>
                  <tr style="height: 15px;">
                    <td style="width: 12%;"><b>SPOUSE:</b></td>
                    <td style="width: 17%; border-bottom: 1px solid #000; text-align: center;">{!! $family_background->spouse_surname ? strtoupper($family_background->spouse_surname) : 'N/A'  !!}</td>
                    <td style="width: 17%; border-bottom: 1px solid #000; text-align: center;">{!! $family_background->spouse_first_name ? strtoupper($family_background->spouse_first_name) : 'N/A' !!} {!! $family_background->spouse_name_extension ? strtoupper($family_background->spouse_name_extension) : '' !!}</td>
                    <td style="width: 6%; border-bottom: 1px solid #000; text-align: center;">{!! $family_background->spouse_middle_name ? strtoupper(substr($family_background->spouse_middle_name, 0, 1).".") : 'N/A' !!}</td>
                    <td style="width: 18%;"><b style="margin-left: 15px;">POSITION:</b></td>
                    <td style="width: 30%; border-bottom: 1px solid #000; text-align: center;/* For Resizing */<?php if(strlen($family_background->spouse_occupation)<=40){echo"font-size: 10px;";}elseif(strlen($family_background->spouse_occupation)<=90){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $family_background->spouse_occupation ? strtoupper($family_background->spouse_occupation) : 'N/A' !!}</td>
                  </tr>

                  <tr style="height: 15px;">
                    <td>&nbsp;</td>
                    <td style="text-align: center;">(Family Name)</td>
                    <td style="text-align: center;">(First Name)</td>
                    <td style="text-align: center;">(M.I.)</td>
                    <td><b style="margin-left: 15px;">AGENCY/OFFICE:</b></td>
                    <td style="border-bottom: 1px solid #000; text-align: center;/* For Resizing */<?php if(strlen($family_background->spouse_employer_business_name)<=40){echo"font-size: 10px;";}elseif(strlen($family_background->spouse_employer_business_name)<=90){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $family_background->spouse_employer_business_name ? strtoupper($family_background->spouse_employer_business_name) : 'N/A' !!}</td>
                  </tr>

                  <tr style="height: 15px;">
                    <td>&nbsp;</td>
                    <td colspan="3" rowspan="2">&nbsp;</td>
                    <td><b style="margin-left: 15px;">OFFICE ADDRESS:</b></td>
                    <td rowspan="2">
                      <div style="width: 100.7%; margin-left: -1px; border-bottom: 1px solid #000; text-align: center;/* For Resizing */<?php if(strlen($family_background->spouse_business_address)<=40){echo"font-size: 10px;";}elseif(strlen($family_background->spouse_business_address)<=90){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $family_background->spouse_business_address ? strtoupper($family_background->spouse_business_address) : 'N/A' !!}</div>
                      <div style="width: 100.7%; margin-left: -1px; border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                  </tr>

                  <tr style="height: 15px;">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>

              <hr class="linebrk" style="margin-top: 10px;">

              <div class="contenthead"><b><u>UNMARRIED CHILDREN BELOW EIGHTEEN (18) YEARS OF AGE LIVING IN DECLARANTS HOUSEHOLD</u></b></div>

              <table class="table" style="font-size: 12px; margin-left: 20px; margin-right: 35px;">
                <tbody>
                  <tr style="height: 15px;">
                    <td style="width: 49%; text-align: center;"><b>NAME</b></td>
                    <td style="width: 3%;">&nbsp;</td>
                    <td style="width: 30%; text-align: center;"><b>DATE OF BIRTH</b></td>
                    <td style="width: 3%;">&nbsp;</td>
                    <td style="width: 15%; text-align: center;"><b style="margin-left: 15px;"><b>AGE</b></td>
                  </tr>
                  @foreach($childrens as $key => $value)
                  <tr style="height: 15px;">
                    <td style="border-bottom: 1px solid #000; text-align: center; /* For Resizing */<?php if(strlen($value->fullname)<=38){echo"font-size: 11px;";}elseif(strlen($value->fullname)<=56){echo"font-size: 10px;";}elseif(strlen($value->fullname)<=68){echo"font-size: 9px;";}else{echo"font-size: 8px;";}?>/* For Resizing */">{!! strtoupper($value->fullname) !!}</td>
                    <td>&nbsp;</td>
                    <td style="border-bottom: 1px solid #000; text-align: center;">{!! $value->date_of_birth !!}</td>
                    <td>&nbsp;</td>
                    <td style="border-bottom: 1px solid #000; text-align: center;">{!! $value->age !!}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <hr class="linebrk" style="margin-top: 25px;">


              <div class="contenthead"><b><u>ASSETS, LIABILITIES AND NETWORTH</u></b>
                <div class="subhead" style="text-align: center;">
                  <i>(Including those of the spouse and unmarried children below eighteen (18) <br>
                  years of age living in declarant's household)</i>
                </div>
              </div>

              <div class="contenttable">
                <div style="margin-bottom: 5px;">
                  <b>
                  1. ASSETS
                  </b>
                </div>
                <div style="margin-bottom: 5px; margin-left: 15px;">
                  <b>
                  a. &nbsp; &nbsp; Real Properties*
                  </b>
                </div>

                <table class="tableborder" style="font-size: 12px;">
                  <tbody>
                    <tr style="background-color: #F0F0F0;">
                      <td rowspan="2" style="height: 70px; width: 90px; border-bottom: 3px solid #000;">
                        <span><b>DESCRIPTION</b></span> <br>
                        <span style="font-size: 10px;">(e.g lot, house and lot, condominium and improvements)</span>
                      </td>
                      <td rowspan="2" style="height: 70px; width: 100px; border-bottom: 3px solid #000;">
                        <span><b>KIND</b></span> <br>
                        <span style="font-size: 10px;">(e.g residential, commercial, industrial, agricultural and mixed use)</span>
                      </td>
                      <td rowspan="2" style="height: 70px; width: 150px; border-bottom: 3px solid #000;"><b>EXACT <br> LOCATION</b></td>
                      <td style="width: 70px;"><b>ASSESSED VALUE</b></td>
                      <td style="width: 105px;"><b>CURRENT FAIR MARKET VALUE</b></td>
                      <td colspan="2" style="width: 111px;"><b>ACQUISITION</b></td>
                      <td rowspan="2" style="height: 70px; width: 111px; border-bottom: 3px solid #000;"><b>ACQUISITION COST</b></td>
                    </tr>

                    <tr style="background-color: #F0F0F0;">
                      <td colspan="2" style="height: 25px; font-size: 10px; border-bottom: 3px solid #000;">(As found in the Tax Declaration of Real Property)</td>
                      <td style="height: 25px; width: 50px; border-bottom: 3px solid #000;"><b>YEAR</b></td>
                      <td style="height: 25px; width: 60px; border-bottom: 3px solid #000; border-right: 2px solid #000;"><b>MODE</b></td>
                    </tr>
                    @foreach($assets_real_properties as $key => $value)
                    <tr>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->description) <=20){echo"font-size: 10px;";}elseif(strlen($value->description) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->description ? strtoupper($value->description) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->kind) <=20){echo"font-size: 10px;";}elseif(strlen($value->kind) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->kind ? strtoupper($value->kind) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->exact_location) <=20){echo"font-size: 10px;";}elseif(strlen($value->exact_location) <=50){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->exact_location ? strtoupper($value->exact_location) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->assessed_value) <=20){echo"font-size: 10px;";}elseif(strlen($value->assessed_value) <=50){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->assessed_value ? strtoupper($value->assessed_value) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->current_fair_market_value) <=20){echo"font-size: 10px;";}elseif(strlen($value->current_fair_market_value) <=50){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->current_fair_market_value ? strtoupper($value->current_fair_market_value) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->acquisition_year) <=20){echo"font-size: 10px;";}elseif(strlen($value->acquisition_year) <=50){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->acquisition_year ? strtoupper($value->acquisition_year) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->acquisition_mode) <=20){echo"font-size: 10px;";}elseif(strlen($value->acquisition_mode) <=50){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->acquisition_mode ? str_replace("/"," / ",strtoupper($value->acquisition_mode)) : 'N/A' !!}</td>
                      <td style="height: 55px; /* For Resizing */<?php if(strlen($value->acquisition_cost) <=20){echo"font-size: 10px;";}elseif(strlen($value->acquisition_cost) <=50){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->acquisition_cost ? number_format($value->acquisition_cost, 2) : 'N/A' !!}</td>
                    </tr>
                    @endforeach

                    <tr>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0;"><b>Subtotal:</b></td>
                      <td style="border-bottom: 1px solid #000; border-left: 0; border-right: 0;">{!! $real_subtotal !!}</td>
                    </tr>
                  </tbody>
                </table>

                <div style="margin-bottom: 5px; margin-left: 15px;">
                  <b>
                  b. &nbsp; &nbsp; Personal Properties*
                  </b>
                </div>

                <table class="tableborder" style="font-size: 12px;">
                  <tbody>
                    <tr style="background-color: #F0F0F0;">
                      <td style="height: 35px; width: 419px; border-bottom: 3px solid #000;"><b>DESCRIPTION</b></td>
                      <td style="height: 35px; width: 226.7px; border-bottom: 3px solid #000;"><b>YEAR ACQUIRED</b></td>
                      <td style="height: 35px; border-bottom: 3px solid #000;"><b>ACQUISITION COST/AMOUNT</b></td>
                    </tr>
                    @foreach($assets_personal_properties as $key => $value)
                    <tr>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->description) <=40){echo"font-size: 10px;";}elseif(strlen($value->description) <=80){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->description ? strtoupper($value->description) : 'N/A' !!}</td>
                      <td style="height: 18px;">{!! $value->year_acquired ? strtoupper($value->year_acquired) : 'N/A' !!}</td>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->acquisition_cost) <=30){echo"font-size: 10px;";}elseif(strlen($value->acquisition_cost) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->acquisition_cost ? number_format($value->acquisition_cost, 2) : 'N/A' !!}</td>
                    </tr>
                    @endforeach

                    <tr>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0; text-align: right;"><b>Subtotal:</b></td>
                      <td style="border-bottom: 1px solid #000; border-left: 0; border-right: 0;">{!! $personal_subtotal !!}</td>
                    </tr>

                    <tr valign="bottom">
                      <td style="height: 30px; border: 0;">&nbsp;</td>
                      <td style="height: 30px; border: 0; text-align: right;"><b>TOTAL ASSETS (a+b):</b></td>
                      <td style="height: 30px; border-bottom: 3px solid #000; border-left: 0; border-right: 0;">{!! $real_personal_total !!}</td>
                    </tr>
                  </tbody>
                </table>

                <div style="margin-bottom: 10px; font-size: 14px;">
                  <i>* Additional sheet/s may be used, if necessary.</i>
                </div>

                <div style="margin-top: 20px; margin-bottom: 5px;">
                  <b>
                  2. LIABILITIES*
                  </b>
                </div>

                <table class="tableborder" style="font-size: 12px;">
                  <tbody>
                    <tr style="background-color: #F0F0F0;">
                      <td style="height: 23px; width: 280px; border-bottom: 3px solid #000;"><b>NATURE</b></td>
                      <td style="height: 23px; width: 310px; border-bottom: 3px solid #000;"><b>NAME OF CREDITORS</b></td>
                      <td style="height: 23px; border-bottom: 3px solid #000;"><b>OUTSTANDING BALANCE</b></td>
                    </tr> 
                    @foreach($assets_liabilities as $key => $value)
                    <tr>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->nature) <=30){echo"font-size: 10px;";}elseif(strlen($value->nature) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->nature ? strtoupper($value->nature) : 'N/A' !!}</td>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->name_of_creditors) <=30){echo"font-size: 10px;";}elseif(strlen($value->name_of_creditors) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->name_of_creditors ? strtoupper($value->name_of_creditors) : 'N/A' !!}</td>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->outstanding_balance) <=30){echo"font-size: 10px;";}elseif(strlen($value->outstanding_balance) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->outstanding_balance ? number_format($value->outstanding_balance, 2) : 'N/A' !!}</td>
                    </tr>
                    @endforeach

                    <tr>
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0; text-align: right;"><b>TOTAL LIABILITIES:</b></td>
                      <td style="border-bottom: 1px solid #000; border-left: 0; border-right: 0;">{!! $data_outstanding_balance_total !!}</td>
                    </tr>

                    <tr valign="bottom">
                      <td style="border: 0;">&nbsp;</td>
                      <td style="border: 0; text-align: right;"><b>NET WORTH : Total Assets less Total Liabilities =</b></td>
                      <td style="border-bottom: 3px solid #000; border-left: 0; border-right: 0;">{!! $net_worth !!}</td>
                    </tr>
                  </tbody>
                </table>

                <div style="margin-bottom: 10px; font-size: 14px;">
                  <p><i>* Additional sheet/s may be used, if necessary.</i></p>
                </div>

                <div class="contenthead" style="margin-top: 35px;"><b><u>BUSINESS INTERESTS AND FINANCIAL CONNECTIONS</u></b>
                  <div class="subhead" style="text-align: center;">
                    <i>(of Declarant/ Declarant's spouse/ Unmarried Children Below Eighteen (18) years of Age Living in Declarant's Household)</i>
                  </div>
                  <div class="chckbxlinetwo">
                    <div class="checkbox"><input type="checkbox" name="" id="" /></div>
                    <div class="checkboxtexttwo"><i>I/We do not have any business interest or financial connection.</i></div>
                  </div>
                </div>

                <table class="tableborder" style="font-size: 12px; margin-top: 25px;">
                  <tbody>
                    <tr style="background-color: #F0F0F0;">
                      <td style="height: 45px; width: 175px;"><b>NAME OF ENTITY/BUSINESS ENTERPRISE</b></td>
                      <td style="height: 45px; width: 190px;"><b>BUSINESS ADDRESS</b></td>
                      <td style="height: 45px; width: 190px;"><b>NATURE OF BUSINESS INTEREST & /OR FINANCIAL CONNECTION</b></td>
                      <td style="height: 45px;"><b>DATE OF ACQUISITION OF INTEREST OR CONNECTION</b></td>
                    </tr>
                    @foreach($business_interest_and_financial as $key => $value)
                    <tr>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->name_of_business) <=30){echo"font-size: 10px;";}elseif(strlen($value->name_of_business) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->name_of_business ? strtoupper($value->name_of_business) : 'N/A' !!}</td>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->business_address) <=30){echo"font-size: 10px;";}elseif(strlen($value->business_address) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->business_address ? strtoupper($value->business_address) : 'N/A' !!}</td>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->nature_of_business) <=30){echo"font-size: 10px;";}elseif(strlen($value->nature_of_business) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->nature_of_business ? strtoupper($value->nature_of_business) : 'N/A' !!}</td>
                      <td style="height: 18px; /* For Resizing */<?php if(strlen($value->date_of_acquisition) <=30){echo"font-size: 10px;";}elseif(strlen($value->date_of_acquisition) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->date_of_acquisition ? strtoupper($value->date_of_acquisition) : 'N/A' !!}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="contenthead" style="margin-top: 35px;"><b><u>RELATIVES IN THE GOVERNMENT SERVICE</u></b>
                  <div class="subhead" style="text-align: center;">
                    <i>(Within the Fourth Degree of Consanguinity or Affinity. Include also Bilas, Balae and Inso)</i>
                  </div>
                  <div class="chckbxlinetwo">
                    <div class="checkbox"><input type="checkbox" name="" id="" /></div>
                    <div class="checkboxtexttwo"><i>I/We do not know of any relative/s in the government service</i></div>
                  </div>
                </div>

                <table class="tableborder" style="font-size: 12px; margin-top: 25px;">
                  <tbody>
                    <tr style="background-color: #F0F0F0;">
                      <td style="width: 195px;"><b>NAME OF RELATIVE</b></td>
                      <td style="width: 145px;"><b>RELATIONSHIP</b></td>
                      <td style="width: 125px;"><b>POSITION</b></td>
                      <td><b>NAME OF AGENCY/OFFICE AND ADDRESS</b></td>
                    </tr>
                    @foreach($relatives_government_service as $key => $value)
                    <tr>
                      <td  style="height: 18px; /* For Resizing */<?php if(strlen($value->name_of_relative) <=30){echo"font-size: 10px;";}elseif(strlen($value->name_of_relative) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->name_of_relative ? strtoupper($value->name_of_relative) : '' !!}</td>
                      <td  style="height: 18px; /* For Resizing */<?php if(strlen($value->relationship) <=30){echo"font-size: 10px;";}elseif(strlen($value->relationship) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->relationship ? strtoupper($value->relationship) : '' !!}</td>
                      <td  style="height: 18px; /* For Resizing */<?php if(strlen($value->position) <=30){echo"font-size: 10px;";}elseif(strlen($value->position) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->position ? strtoupper($value->position) : '' !!}</td>
                      <td  style="height: 18px; /* For Resizing */<?php if(strlen($value->agency_and_address) <=30){echo"font-size: 10px;";}elseif(strlen($value->agency_and_address) <=60){echo"font-size: 8px;";}else{echo"font-size: 7px;";}?>/* For Resizing */">{!! $value->agency_and_address ? strtoupper($value->agency_and_address) : '' !!}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="contenttext">
                  <p align="justify">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    I hereby certify that these are true and correct statements of my assets, liabilities, net worth, business interests and financial connections, including those of my spouse and unmarried children below eighteen (18) years of age living in my household, and that to the best of my knowledge, the above-enumerated are names of my relatives in the government within the fourth civil degree of consanguinity or affinity.
                  </p>
                  <p align="justify">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    I hereby authorize the Ombudsman or his/her duly authorized representative to obtain and secure from all appropriate government agencies, including the Bureau of Internal Revenue such documents that may show my assets, liabilities, net worth, business interests and financial connections, to include those of my spouse and unmarried children below 18 years of age living with me in my household covering previous years to include the year I first assumed office in government.
                  </p>

                  <p align="justify">
                    Date: &nbsp; &nbsp; &nbsp;<u>{{ $date_now }}</u>
                  </p>

                  <table class="table" style="font-size: 12px; margin-top: 20px;">
                    <tbody>
                      <tr>
                        <td colspan="2" style="border-bottom: 1px solid #000;">&nbsp;</td>
                        <td style="width: 30px;">&nbsp;</td>
                        <td colspan="2" style="border-bottom: 1px solid #000;">&nbsp;</td>
                      </tr>

                      <tr valign="top">
                        <td colspan="2" style="height: 30px; text-align: center;"><i>(Signature of Declarant)</i></td>
                        <td>&nbsp;</td>
                        <td colspan="2" style="height: 30px; text-align: center;"><i>(Signature of Co-Declarant/Spouse)</i></td>
                      </tr>c

                      <tr>
                        <td style="width: 130px;">Government Issued ID:</td>
                        <td style="width: 210px; border-bottom: 1px solid #000;">{!! $survey->government_issued_id ? strtoupper($survey->government_issued_id) : 'N/A' !!}</td>
                        <td>&nbsp;</td>
                        <td style="width: 130px;">Government Issued ID:</td>
                        <td style="border-bottom: 1px solid #000;">{!! $survey->co_government_issued_id ? strtoupper($survey->co_government_issued_id) : 'N/A' !!}</td>
                      </tr>

                      <tr>
                        <td>ID No.:</td>
                        <td style="border-bottom: 1px solid #000;">{!! $survey->id_license_passport_number ? strtoupper($survey->id_license_passport_number) : 'N/A' !!}</td>
                        <td>&nbsp;</td>
                        <td>ID No.:</td>
                        <td style="border-bottom: 1px solid #000;">{!! $survey->co_id_license_passport_number ? strtoupper($survey->co_id_license_passport_number) : 'N/A' !!}</td>
                      </tr>

                      <tr>
                        <td>Date Issued:</td>
                        <td style="border-bottom: 1px solid #000;">{!! $survey->date_place_of_issuance ? strtoupper($survey->date_place_of_issuance) : 'N/A' !!}</td>
                        <td>&nbsp;</td>
                        <td>Date Issued:</td>
                        <td style="border-bottom: 1px solid #000;">{!! $survey->co_date_place_of_issuance ? strtoupper($survey->co_date_place_of_issuance) : 'N/A' !!}</td>
                      </tr>

                    </tbody>
                  </table>

                  <br>

                  <p align="justify">
                    &nbsp; &nbsp; <b>SUBSCRIBED AND SWORN</b> to before me this ______ day of ____________, affiant exhibiting to me the above-stated government issued identification card.
                  </p>
                </div>

                <div class="footersign" style="margin-top: 15px; font-size: 14px;">
                  <p>
                    <b><u><!-- {!! $personal_information->first_name ? strtoupper($personal_information->first_name) : '' !!} {!! $personal_information->middle_name ? strtoupper(substr($personal_information->middle_name, 0, 1).".") : '' !!} {!! $personal_information->surname ? strtoupper($personal_information->surname) : '' !!} -->______________________________________</u></b>
                    <br>
                    <i>(Person Administering Oath)</i>
                  </p>
                </div>

              </div>

            </div>
        </main>
    </body>
</html>
