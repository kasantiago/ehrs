<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Biometrics as Biometrics;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\SystemLogs as SystemLogs;
use PDF;
use Carbon\Carbon as Carbon;
use Auth;
class BiometricController extends Controller
{
    public function daily_time_records(Request $request){
    	  
    

        $range = $request->range;

        // echo $range;exit;
        // Carbon::parse($dt->format('Y-m-d'))->daysInMonth

        $selected_date = explode("/",$range);
        $month = $selected_date[0];
        $year = $selected_date[1];


        $start =  date("Y-m-d", strtotime($year.'-'.$month.'-1'));
        $days = Carbon::parse($start)->daysInMonth;
        $end = date("Y-m-d", strtotime($year.'-'.$month.'-'.$days));
        $uid = Auth::id();


    	$data = Biometrics::get_records($start,$end,$uid);

        // $test = Biometrics::get_records('2020-01-28','2020-01-28','131');

        // echo "<pre>";
        // print_r($test);exit;

    	

    	$range = "";
        if($start == $end){
        $range = $start;
        }else{
        $range = $start.' to '.$end;
        }

         $range = date("F, Y", strtotime($start));
        // echo "<pre>";
        // print_r($data);exit;
	
        $pdf = PDF::loadView('reports.dtr.dtr_priout',compact('range','data'))->setPaper('A4');
        return $pdf->stream('service-record','.pdf');
	}

public function daily_time_records_test(Request $request){
    	


    	$start =  date("Y-m-d", strtotime($request->start));
    	$end = date("Y-m-d", strtotime($request->end));
    	$uid = $request->user_id;
    	$data = Biometrics::get_records($start,$end,$uid);
    	$range = $request->range;


    	$range = "";
        if($start == $end){
        $range = $start;
        }else{
        $range = $start.' to '.$end;
        }

        // echo "<pre>";
        // print_r($data->daily_time_record);exit;
	
        $pdf = PDF::loadView('reports.dtr.dtr_priout',compact('range','data'))->setPaper('A4');
        return $pdf->stream('service-record','.pdf');
	}

    public function dtr_monthly(Request $request){

        $current_month = Carbon::now()->format('m/Y');
        $color = Accounts::theme_color();

        SystemLogs::saveLogs('visited montly daily time record report!');
        return view('reports.dtr.dtr',compact('color','current_month'));
    }


    public function bioweb(){

        // //  $shellexec = exec('getmac'); 
        // // dd($shellexec);

        // ob_start();
        // system('ipconfig/all');
        // $mycom = ob_get_contents();
        // ob_clean();
        // $findme = "Physical";
        // $pmac=strpos($mycom,$findme);
        // $mac=substr($mycom,($pmac+36),17);
       
        // echo "<pre>";
        // print_r($mac);exit;
       
        return view('bioweb.index');
    }
}
