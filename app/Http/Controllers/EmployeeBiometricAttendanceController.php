<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use Validator;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\Biometrics as Biometrics;
use Carbon\Carbon as Carbon;
use PDF;

class EmployeeBiometricAttendanceController extends Controller
{
    public function index(){

    	$users = Accounts::all_employees_table();
        $color = Accounts::theme_color();
        
        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }


        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            
            $user_id = $data[$cnt]->id;

            $data[$cnt]->view = url('employee-biometric-attendance/user/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
        }
        

        $s = count($users) > 1 ? "s" : "";

        SystemLogs::saveLogs('visited employee biometric attendance'.$s.' page!');
      
        return view('employee-biometric-attendance-list',['users' => $users, 'color' => $color]);

    }

    public function biometric_view(Request $request,$uid){

	    $current_month = Carbon::now()->format('m/Y');
        $color = Accounts::theme_color();

        $user = User::find(decrypt($uid));

        SystemLogs::saveLogs('visited montly daily time record report!');
        return view('reports.dtr.dtr-select',compact('user','color','current_month'));

   }

   public function biometric_data(Request $request){

		$range = $request->range;

		$selected_date = explode("/",$range);
		$month = $selected_date[0];
		$year = $selected_date[1];

		$start =  date("Y-m-d", strtotime($year.'-'.$month.'-1'));
		$days = Carbon::parse($start)->daysInMonth;
		$end = date("Y-m-d", strtotime($year.'-'.$month.'-'.$days));
		$uid = decrypt($request->uid);
		$user = User::find($uid);

 	    $data = Biometrics::get_records($start,$end,$uid);

       // $test = Biometrics::get_records('2020-01-21','2020-01-21','131');

       //  echo "<pre>";
       //  print_r($test);exit;



		$range = "";
		if($start == $end){
		$range = $start;
		}else{
		$range = $start.' to '.$end;
		}

        $range = date("F, Y", strtotime($start));

		$pdf = PDF::loadView('reports.dtr.dtr_selected_priout',compact('user','range','data'))->setPaper('A4');
		return $pdf->stream('service-record','.pdf');
    }
}