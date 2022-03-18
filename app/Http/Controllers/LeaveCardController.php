<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\LeaveCard as LeaveCard;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\EmployeeStatus as EmployeeStatus;
use App\Http\Models\Division as Division;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\Position as Position;
use App\User as User;
use Auth;

class LeaveCardController extends Controller
{
 
    public function leave_card_users_management(){

        SystemLogs::saveLogs('visited employees list leave card management!'); 
        $color = Accounts::theme_color();
        $full_name = PersonalInformation::get_name(Auth::id());
        $users = LeaveCard::users_leave_card();

        return view('leave.leave-card-users-management',['users' => $users, 'color' => $color]);

    }

    public function details($year,$user_id){

        $selected_year = $year;
    	$user_id = decrypt($user_id);
    	$filter = LeaveCard::leaves_year($user_id);
        SystemLogs::saveLogs('visited leave card management!'); 
        $color = Accounts::theme_color();
        $full_name = PersonalInformation::get_name(Auth::id());
        $leave_card_data = LeaveCard::users_leave_card_details($year,$user_id);
        $latest  = LeaveCard::latest_result($user_id);
        return view('leave.leave-card-management',compact('leave_card_data','color','user_id','latest','filter','selected_year'));

    }

    public function year_filter($year,$user_id){
      
       $user_id = decrypt($user_id);
        $leave_card_data = LeaveCard::users_leave_card_details($year,$user_id);
        $color = Accounts::theme_color();
        $html =  view('leave.leave-card-management-table',compact('leave_card_data','color'))->render();
        return response()->json(['html' => $html]);
    }


    public function create($user_id){

        $user_id = decrypt($user_id);
        $user = User::find($user_id);
        $employee_status = EmployeeStatus::list();
        $division = Division::list();
        $position = Position::list();
        $latest  = LeaveCard::latest_result($user_id);
        SystemLogs::saveLogs('visited create leave card adjustment page!');
        $color = Accounts::theme_color();

        return view('leave.leave-card-create',compact('user','employee_status','division','position','color','latest','user_id'));

    }


    public function store(Request $request){



            $user_id = decrypt($request->user_id);

            $latest  = LeaveCard::latest_result($user_id);

            $save = New LeaveCard;

            $save->user_id = $user_id;

            $save->etd = $request->etd;

            $save->period = $request->six_c_inclusive_dates; 

            $save->bal_brought_forward =  $request->six_c_for ? $request->six_c_for  : 0;

            $save->vacation_earned =  $request->vacation_earned;

            $save->vacation_abs_und_w_pay =  $request->vacation_abs_und_w_pay;

            $save->vacation_balance = $latest->vacation_balance + floatval($request->vacation_earned) - floatval($request->vacation_abs_und_w_pay);

            $save->vacation_abs_und_wout_pay =  $request->vacation_abs_und_wout_pay;

            $save->sick_earned =  $request->sick_earned;

            $save->sick_abs_und_w_pay =  $request->sick_abs_und_w_pay;

            $save->sick_balance =  $latest->sick_balance + floatval($request->sick_earned) - floatval($request->sick_abs_und_w_pay);

            $save->sick_abs_und_wout_pay =  $request->sick_abs_und_wout_pay;

            $save->remarks =  $request->remarks;


            if($save->save()) {
              
                $remarks = $request->remarks ? ' w/ remarks : '.strtolower($request->remarks).'!' : '!';

                  SystemLogs::saveLogs('successfully created leave card'.$remarks); 
                  $msg = "successfully created leave card".$remarks; 
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('leave-management/details/all/'.encrypt($user_id)) ]);
             }


    }



}
