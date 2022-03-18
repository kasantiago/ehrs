<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\LeaveApplication as LeaveApplication;
use DB;
use Carbon\Carbon as Carbon;


class LeaveCard extends Model
{
    protected $table = 'leave_info';

    public static function create_leave_card($id,$user_id){


      
			$info = LeaveApplication::find($id);




			$lastData = LeaveCard::where('user_id',$user_id)->orderBy('created_at','desc')->first();


			$new = New LeaveCard;
			$new->user_id = $user_id;
			$new->leave_users_id = $info->id;
			$new->etd = '';
			$new->period = $info->six_c_inclusive_dates;  
			$new->bal_brought_forward =  $info->six_c_for;


			if($lastData){
				switch ($info->six_a_type_of_leave) {
					case 'sick':	
						if(floatval($lastData->sick_balance) == 0.00){
							$new->sick_abs_und_w_pay =  $info->six_c_for;
						}else{
							$new->sick_abs_und_w_pay =  $info->six_c_for;
							$new->sick_balance = floatval($lastData->sick_balance) - floatval($info->six_c_for);
							$new->vacation_balance = floatval($lastData->vacation_balance);					
						}

						break;
					case 'vacation':
					     if(floatval($lastData->vacation_balance) == 0.00){
							$new->vacation_abs_und_w_pay =  $info->six_c_for;
					     }else{
							$new->vacation_abs_und_w_pay =  $info->six_c_for;
							$new->vacation_balance = floatval($lastData->vacation_balance) - floatval($info->six_c_for);
							$new->sick_balance = floatval($lastData->sick_balance);			     	
					     }
						break;
					
					default:
						# code...
						break;
				}

			}else{

				switch ($info->six_a_type_of_leave) {
					case 'sick':
							$new->sick_abs_und_w_pay =  $info->six_c_for;
						
				
							//$new->vacation_balance = floatval($lastData->vacation_balance);
						break;
					case 'vacation':
							$new->vacation_abs_und_w_pay =  $info->six_c_for;
					
							//$new->sick_balance = floatval($lastData->sick_balance);
						break;
					
					default:
						# code...
						break;
				}

			}



			$new->remarks = $info->six_a_type_of_leave;

			$new->save();
	 

    }

     public static function users_leave_card(){
        
        $find = DB::select("SELECT id,name,division,position, IF( (SELECT vacation_balance FROM leave_info as li WHERE li.user_id = u.id ORDER BY id DESC LIMIT 1) != 0.000 OR (SELECT vacation_balance FROM leave_info as li WHERE li.user_id = u.id ORDER BY id DESC LIMIT 1) != NULL, (SELECT vacation_balance FROM leave_info as li WHERE li.user_id = u.id ORDER BY id DESC LIMIT 1), '0' ) as vacation_earned, IF( (SELECT sick_balance FROM leave_info as li WHERE li.user_id = u.id ORDER BY id DESC LIMIT 1) != 0.000 OR (SELECT sick_balance FROM leave_info as li WHERE li.user_id = u.id ORDER BY id DESC LIMIT 1) != NULL, (SELECT sick_balance FROM leave_info as li WHERE li.user_id = u.id ORDER BY id DESC LIMIT 1), '0' ) as sick_earned FROM users as u WHERE employee_status = 'permanent' AND flag = 1");

        return $find;
    }


    public static function users_leave_card_details($year,$user_id){
    	// echo $user_id;exit;
    	if($year == 'all'){
    		$year = "";
    	}else{
    		$year = "AND year_of_leave = ".$year;
    	}

    	$find = DB::select("SELECT * FROM (
							SELECT
							id,
							user_id,
							leave_users_id,
							etd,
							REPLACE(period,',',', ') as period,
							bal_brought_forward,
							IF(vacation_earned != 0.000,vacation_earned,'0') as vacation_earned,
							IF(vacation_abs_und_w_pay != 0.000,vacation_abs_und_w_pay,'0') as vacation_abs_und_w_pay,
							IF(vacation_balance != 0.000,vacation_balance,'0') as vacation_balance,
							IF(vacation_abs_und_wout_pay != 0.000,vacation_abs_und_wout_pay,'0') as vacation_abs_und_wout_pay,
							IF(sick_earned != 0.000,sick_earned,'0') as sick_earned,
							IF(sick_abs_und_w_pay != 0.000,sick_abs_und_w_pay,'0') as sick_abs_und_w_pay,
							IF(sick_balance != 0.000,sick_balance,'0') as sick_balance,
							IF(sick_abs_und_wout_pay != 0.000,sick_abs_und_wout_pay,'0') as sick_abs_und_wout_pay,
							substring_index(period,',',1) as first_date,
							substring_index(period,',',-1) as last_date,
							substring_index(substring_index(period,',',1),'/',-1) as year_of_leave,
							remarks,
							created_at 
							FROM leave_info
							) as leave_info  WHERE user_id = {$user_id} ".$year." ORDER BY id ASC");

    	return $find;
    }



    public static function leaves_year($user_id){

    	$find = DB::select("SELECT substring_index(substring_index(period,',',1),'/',-1) as year_of_leave FROM leave_info WHERE user_id = ".$user_id." LIMIT 1");

    	$current_year =  Carbon::now()->year;

    	if($find){
    		$year_start = $find[0]->year_of_leave;
    	}else{
    		$year_start =  Carbon::now()->year;
    	}

    	
    	if($current_year == $year_start){
    		$years[] = $current_year;
    	}else{
    		for ($i=$year_start; $i <= $current_year; $i++) { 
    			$years[] = $i;
    		}
    	}
    	
    	$years[] = 'all';

    	$years = array_reverse($years);
   		
   		return $years;


    }

  
    public static function latest_result($user_id){
    	$latest  = LeaveCard::select('sick_balance','vacation_balance')->where("user_id",$user_id)->latest()->first();

    	if(!$latest){
    		$latest = new \stdClass();
    		$latest->sick_balance = 0.000;
    		$latest->vacation_balance = 0.000;
    	}
    	

    	return $latest;
    }
}
