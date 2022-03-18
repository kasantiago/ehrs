<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Division as Division;
use App\Http\Models\PersonalInformation as PersonalInformation;
use DB;
use Auth;
class LeaveApplication extends Model
{
    protected $table = 'leave_users';

    public static function application($uid){
    	$find = DB::table("leave_users")->Where("user_id",$uid)->get();
    	return $find;
    }

    public static function leave_information($uid,$status){
   
        if($uid){
    	   $find = DB::table("leave_users")->Where("user_id",$uid)->orderBy('id', 'DESC')->get();  
        }else{
           if($status){
                $find = DB::table("leave_users")->where('seven_b_recommendation',$status)->orderBy('id', 'DESC')->get();
           }else{
                $find = DB::table("leave_users")->orderBy('id', 'DESC')->get();
           } 
        }
    	    	
    	$arr = [];
    	
    	foreach ($find as $key => $value) {
            $data= new \stdClass();
            $data->id = $value->id;
            $data->name = PersonalInformation::get_name($value->user_id);
    		$data->date_of_filing = $value->date_of_filing;
    		$data->six_a_type_of_leave = $value->six_a_type_of_leave;

    		switch ($data->six_a_type_of_leave) {
    			case 'vacation':
    				$data->six_a_type_of_leave_data = $value->six_a_type_of_leave_data;
    				$data->where_will_be_spent = $value->six_b_vacation_leave_be_spent;
    				break;
                case 'other vacation':
                    $data->six_a_type_of_leave_data = $value->six_a_type_of_leave_data;
                    $data->where_will_be_spent = '';
                    break;
                case 'force':
                    $data->six_a_type_of_leave_data = '';
                    $data->where_will_be_spent = '';
                    break;
    			case 'sick':
    				$data->six_a_type_of_leave_data = $value->six_b_sick_leave_be_spent_data;
    				$data->where_will_be_spent = $value->six_b_sick_leave_be_spent;
    				break;
    			case 'maternity':
    				$data->six_a_type_of_leave_data = '';
    				$data->where_will_be_spent = '';
    				break;
    		    case 'others':
    				$data->six_a_type_of_leave_data = $value->six_a_type_of_leave_data;
    				$data->where_will_be_spent = '';
    				break;	    			
    			default:
    				
    				break;
    		}

    		$data->six_c_for = $value->six_c_for;
    		$data->six_c_inclusive_dates = $value->six_c_inclusive_dates;
    		$data->six_d_commutation = $value->six_d_commutation;
            $data->seven_b_recommendation  = $value->seven_b_recommendation; 
    		$arr[] = $data;
	
    	}

    	return $arr;
    }

    public static function seen_count(){
        $cnt = DB::table("leave_users")->where("seen",0)->count();
        return $cnt;
    }

    public static function seen(){
        DB::table('leave_users')->where('seen',0)->update(['seen' => 1]);
    }

  

    public static function pending_count(){
        $count = DB::table('leave_users')->where('seven_b_recommendation','pending')->get()->count();
        return $count;
    }


}