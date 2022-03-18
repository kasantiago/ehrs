<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon as Carbon;


class Dashboard extends Model
{

// SELECT 
// es.name as label,
// (
//     (SELECT COUNT(*) FROM users as u WHERE u.employee_status = es.name AND u.employee_status != '')
//     / 
//     (SELECT COUNT(*) FROM users as u WHERE u.employee_status != '')
//     * 100
// )
//  as value 

// FROM employee_status as es WHERE name != ''

	public static function emp_status_users(){
       	$find = DB::select("SELECT es.name as label,
					ROUND
					(
					    (SELECT COUNT(*) FROM users as u WHERE u.employee_status = es.name AND u.employee_status != '' AND u.flag = 1)
					    /
					    (SELECT COUNT(*) FROM users as u WHERE u.employee_status != '' AND u.flag = 1)
					    * 100,
					    2
					)
					as value 

					FROM employee_status as es WHERE name != ''");

     	   	return json_encode($find);
    }

    public static function pds_progress_users(){
     	$find = DB::select("SELECT 
				x, 

				ROUND((a / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as a,
				ROUND((b / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as b,
				ROUND((c / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as c, 
				ROUND((d / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as d, 
				ROUND((e / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as e, 
				ROUND((f / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as f,
				ROUND((g / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as g,
				ROUND((h / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as h, 
				ROUND((i / (SELECT COUNT(*) FROM pds_progress_bar as ppb WHERE ppb.user_id != '')
										    ),2) as i
				     
				FROM (
				   	SELECT 'Percentage (%)' as x, SUM(personal_information) as a, SUM(family_background) as b, SUM(educational_background) as c, SUM(civil_service_eligibility) as d, SUM(work_experience) as e, SUM(voluntary_work) as f, SUM(learning_and_development) as g, SUM(other_information) as h, SUM(survey) as i FROM pds_progress_bar as ppb WHERE ppb.user_id != '' AND flag = 1
				    
				) as newTable");

     	   	return json_encode($find);
    }

    public static function my_pds_progress($user_id){
     	$find = DB::select("SELECT 'Percentage (%)' as x, personal_information as a, family_background as b, educational_background as c, civil_service_eligibility as d, work_experience as e, voluntary_work as f, learning_and_development as g, other_information as h, survey as i FROM pds_progress_bar as ppb WHERE ppb.user_id = '$user_id'");

     		if(!$find){
		        $data = new \stdClass();
		        $data->x = "Percentage (%)"; // PHP creates  a Warning here
		        $data->a = 0.00;
		        $data->b = 0.00;
		        $data->c = 0.00;
		        $data->d = 0.00;
		        $data->e = 0.00;
		        $data->f = 0.00;
		        $data->g = 0.00;
		        $data->h = 0.00;
		        $data->i = 0.00;

		        return json_encode([$data]);
		    }

     	   	return json_encode($find);
    }

    public static function emp_status_chart(){
     	$find = DB::table('users')->count();
     	   return $find;
    }

	public static function dashboard_pds()
	{
		$pds = DB::table('pds_progress_bar')->where('flag',1)->get();

		return $pds;
	}

	public static function determine_progress_color($percentage)
	{
		switch ($percentage) {
				case $percentage <= 25:
				return "bg-red";
				break;

				case $percentage <= 50:
				return "bg-orange";
				break;

				case $percentage <= 75:
				return "bg-purple";
				break;

				case $percentage <= 99:
				return "bg-blue";
				break;

				case $percentage = 100:
				return "bg-green";
				break;
			
			default:
				return "";
				break;
		}
		// if ()
	}

	public static function current_birthday_list(){
      $now = Carbon::now();
      $month = $now->format('m');

      $user = DB::table('users')
      ->select('id','name','employee_status','division','position','gender','birthday')
      ->where('flag',1)->whereMonth('birthday', '=', $month)->where('role','user')->get();

      return $user;

   	}

   	public static function retirees_list($age = 60){

       	$query = DB::select("SELECT * FROM (SELECT id,name,employee_status,division,position,gender,birthday,TIMESTAMPDIFF(YEAR,birthday, CURDATE()) AS age, flag FROM users WHERE flag = 1 AND role = 'user') as temp_user_table WHERE age >= ".$age);
       	return $query;
   	}

   	public static function audit_trail(){
     	   $find = DB::table('system_logs')->orderBy('created_at','desc')->limit('20')->get();
     	   return $find;
    }

}
