<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class WorkExperience extends Model
{
    protected $table = 'work_experience';

    public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->inclusive_date_from = '';
			$data->inclusive_date_to = '';
			$data->position_title = '';
			$data->dept_agency_office_company = '';
			$data->monthly_salary = '';
			$data->paygrade = '';
			$data->status_of_appointment = '';
			$data->govt_service = '';
			$data->service_record_salary = '';
			$data->agency_type = '';
			$data->name_of_office_unit = "";
			$data->immediate_supervisor  = "";
			$data->summary_of_duties = "";
			$data->office_address = "";
			$data->pay = '';
			$data->cause = '';
			$data->tag_work = '';
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }

	public static function find_data($uid){
		$find = DB::table('work_experience')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function find_data_department($uid){
		$find = DB::table('work_experience')->where('user_id',$uid)->where('dept_agency_office_company', 'like', '%Department of Health%')->orWhere('dept_agency_office_company', 'like', '%DOH%')->where('flag',1)->count();
		return $find;
	}

	public static function find_data_selected($govt_service,$uid){

		switch ($govt_service) {
			case 'y':
				$find = DB::table('work_experience')->where('user_id',$uid)->where('govt_service','Y')->where('flag',1)->count();
				break;
			
			case 'n':
				$find = DB::table('work_experience')->where('user_id',$uid)->where('govt_service','N')->where('flag',1)->count();
				break;
			
			default:
				$find = DB::table('work_experience')->where('user_id',$uid)->where('flag',1)->count();
				break;
		}

		return $find;
	}

	public static function get_data($uid){
		$find = DB::table('work_experience')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
		return $find;
	}

	public static function get_data_department($uid){
		$find = DB::table('work_experience')->where('user_id',$uid)->where('tag_work', 'dohro2')->orWhere('dept_agency_office_company', 'like', '%DOH%')->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'asc')->get();
		return $find;
	}

	public static function get_data_selected($govt_service,$uid){
		switch ($govt_service) {
			case 'y':
				$find = DB::table('work_experience')->where('user_id',$uid)->where('govt_service','Y')->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
				break;
			
			case 'n':
				$find = DB::table('work_experience')->where('user_id',$uid)->where('govt_service','N')->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
				break;
			
			default:
				$find = DB::table('work_experience')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
				break;
		}
		
		return $find;
	}


   public static function pdf_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->inclusive_date_from = 'N/A';
			$data->inclusive_date_to = 'N/A';
			$data->position_title = 'N/A';
			$data->dept_agency_office_company = 'N/A';
			$data->monthly_salary = 'N/A';
			$data->paygrade = 'N/A';
			$data->status_of_appointment = 'N/A';
			$data->govt_service = 'N/A';
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }


	public static function pdf_generate($number,$uid){

	 	$work_experience = DB::table('work_experience')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($work_experience);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->inclusive_date_from = $work_experience[$i]->inclusive_date_from ? date('m/d/Y', strtotime($work_experience[$i]->inclusive_date_from)) : 'N/A';
				$data->inclusive_date_to = $work_experience[$i]->inclusive_date_to ? $work_experience[$i]->inclusive_date_to : 'N/A';
				$data->position_title = $work_experience[$i]->position_title ? $work_experience[$i]->position_title : 'N/A';
				$data->dept_agency_office_company = $work_experience[$i]->dept_agency_office_company ? $work_experience[$i]->dept_agency_office_company : 'N/A';
				$data->monthly_salary = $work_experience[$i]->monthly_salary ? $work_experience[$i]->monthly_salary : 'N/A';
				$data->paygrade = $work_experience[$i]->paygrade ? $work_experience[$i]->paygrade : 'N/A';
				$data->status_of_appointment = $work_experience[$i]->status_of_appointment ? $work_experience[$i]->status_of_appointment : 'N/A';
				$data->govt_service = $work_experience[$i]->govt_service ? $work_experience[$i]->govt_service : 'N/A';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	

	    	for ($x=0; $x <= $number; $x++) { 
				$data->inclusive_date_from = 'N/A';
				$data->inclusive_date_to = 'N/A';
				$data->position_title = 'N/A';
				$data->dept_agency_office_company = 'N/A';
				$data->monthly_salary = 'N/A';
				$data->paygrade = 'N/A';
				$data->status_of_appointment = 'N/A';
				$data->govt_service = 'N/A';
	    		$arr[] = $data;
	    	}
	    

	 

    	return $arr;
    }

    public static function pdf_generate_reach_limit($number,$uid){


	 	$work_experience = DB::table('work_experience')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
   	//%d-%m-%Y
    	$arr0 = [];
    	$arr1 = [];
    	$regroup = [];
    	
    	$default = 0;

	 	$count_data = count($work_experience);

	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->inclusive_date_from = $work_experience[$i]->inclusive_date_from ? date('m/d/Y', strtotime($work_experience[$i]->inclusive_date_from)) : 'N/A';
				$data->inclusive_date_to = $work_experience[$i]->inclusive_date_to ? $work_experience[$i]->inclusive_date_to : 'N/A';
				$data->position_title = $work_experience[$i]->position_title ? $work_experience[$i]->position_title : 'N/A';
				$data->dept_agency_office_company = $work_experience[$i]->dept_agency_office_company ? $work_experience[$i]->dept_agency_office_company : 'N/A';
				$data->monthly_salary = $work_experience[$i]->monthly_salary ? $work_experience[$i]->monthly_salary : 'N/A';
				$data->paygrade = $work_experience[$i]->paygrade ? $work_experience[$i]->paygrade : 'N/A';
				$data->status_of_appointment = $work_experience[$i]->status_of_appointment ? $work_experience[$i]->status_of_appointment : 'N/A';
				$data->govt_service = $work_experience[$i]->govt_service ? $work_experience[$i]->govt_service : 'N/A';

	    		

	    		if($i <= 27){
	    			$arr1[] = $data;
	    			$regroup[0] = $arr1;
	    		}
	    		if($i >= 28){
	    			$arr2[] = $data;
	    			$regroup[1] = $arr2;
	    		}
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	

	    	for ($x=0; $x <= $number; $x++) { 
				$data->inclusive_date_from = 'N/A';
				$data->inclusive_date_to = 'N/A';
				$data->position_title = 'N/A';
				$data->dept_agency_office_company = 'N/A';
				$data->monthly_salary = 'N/A';
				$data->paygrade = 'N/A';
				$data->status_of_appointment = 'N/A';
				$data->govt_service = 'N/A';
	    		$arr[] = $data;
	    	}
	    

	 

    	return $regroup;
    }


    //   public static function reports(){

    //      $find =   DB::table('work_experience')
    //       ->select(
				// 	'users.id',
				// 	'users.name',
				// 	'users.employee_status',
				// 	'users.division',
				// 	'users.position',
				// 	'work_experience.position_title',
				// 	'work_experience.inclusive_date_from',
				// 	'work_experience.inclusive_date_to',
				// 	'work_experience.dept_agency_office_company',
				// 	'work_experience.monthly_salary',
				// 	'work_experience.paygrade',
				// 	'work_experience.status_of_appointment',
				// 	'work_experience.govt_service',
				// 	'work_experience.created_at',
				// 	'work_experience.updated_at')
				// ->crossJoin('users','work_experience.user_id','=','users.id')
				// ->where(['work_experience.flag' => 1, 'users.flag' => 1])
				// ->get();

 
    //  //    echo '<pre>';
    // 	// print_r($find);exit;
    //   return $find;
    // }

        public static function reports($id){

    	switch ($id) {
    		case 'all':

					$find =   DB::table('work_experience')
					->select(
							'users.id',
							'users.name',
							'users.employee_status',
							'users.division',
							'users.position',
							'work_experience.position_title',
							'work_experience.inclusive_date_from',
							'work_experience.inclusive_date_to',
							'work_experience.dept_agency_office_company',
							'work_experience.monthly_salary',
							'work_experience.paygrade',
							'work_experience.status_of_appointment',
							'work_experience.govt_service',
							'work_experience.office_address',
							'work_experience.created_at',
							'work_experience.updated_at')
					->crossJoin('users','work_experience.user_id','=','users.id')
					->where(['work_experience.flag' => 1, 'users.flag' => 1])
					->get();

    			
    			break;
    		
    		default:


					$find =   DB::table('work_experience')
					->select(
							'users.id',
							'users.name',
							'users.employee_status',
							'users.division',
							'users.position',
							'work_experience.position_title',
							'work_experience.inclusive_date_from',
							'work_experience.inclusive_date_to',
							'work_experience.dept_agency_office_company',
							'work_experience.monthly_salary',
							'work_experience.paygrade',
							'work_experience.status_of_appointment',
							'work_experience.govt_service',
							'work_experience.office_address',
							'work_experience.created_at',
							'work_experience.updated_at')
					->crossJoin('users','work_experience.user_id','=','users.id')
					->where(['work_experience.flag' => 1, 'users.flag' => 1,'users.id' => decrypt($id)])
					->get();
    		
    			break;
    	}

       
      return $find;
    }

    public static function validate($id){
    	switch ($id) {	
    		case 'all':
					$find = DB::table('work_experience')
							->where(['flag' => 1])
							->count();
    				return $find;
    			break;
    		
    		default:
    				$find = DB::table('work_experience')
							->where(['user_id' => decrypt($id)])
							->where(['flag' => 1])
							->count();
					return $find;	
    			break;

    			
    	}
    }
    public static function present_job($user_id){

    	

    	$find = DB::table('work_experience')->where('user_id',$user_id)->where('inclusive_date_to','PRESENT')->where('flag',1)->first();

    	// echo "<pre>";
    	// print_r($find);exit();
		
		return $find;


    }


      public static function present_job_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->inclusive_date_from = '';
			$data->inclusive_date_to = '';
			$data->position_title = '';
			$data->dept_agency_office_company = '';
			$data->monthly_salary = '';
			$data->paygrade = '';
			$data->status_of_appointment = '';
			$data->govt_service = '';
			$data->service_record_salary = '';
			$data->agency_type = '';
			$data->name_of_office_unit = "";
			$data->immediate_supervisor  = "";
			$data->summary_of_duties = "";
			$data->office_address = "";
			$data->pay = '';
			$data->cause = '';
			$data->tag_work = '';
    		$arr[] = $data;
    		
    	}

    	return $arr[0];
    }

}