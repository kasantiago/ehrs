<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CivilServiceEligibility extends Model
{
    protected $table = 'civil_service_eligibility';

    public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();

    	for ($count=0; $count <= $number; $count++) { 

			$data->cs_board_bar_ces_csee_barangay_drivers = '';
			$data->rating = '';
			$data->date_of_exam_conferment = '';
			$data->place_of_exam_conferment = '';
			$data->license_number = '';
			$data->license_date_of_validity = '';
    		$arr[] = $data;
    	}


    	return $arr;
    }




	public static function find_data($uid){
		$find = DB::table('civil_service_eligibility')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}


	public static function get_data($uid){
		$find = DB::table('civil_service_eligibility')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(date_of_exam_conferment,'%Y-%m-%d')"), 'desc')->get();
		return $find;
	}


    public static function pdf_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();

    	for ($count=0; $count <= $number; $count++) { 

			$data->cs_board_bar_ces_csee_barangay_drivers = 'N/A';
			$data->rating = 'N/A';
			$data->date_of_exam_conferment = 'N/A';
			$data->place_of_exam_conferment = 'N/A';
			$data->license_number = 'N/A';
			$data->license_date_of_validity = 'N/A';
    		$arr[] = $data;
    	}


    	return $arr;
    }


	 public static function pdf_generate($number,$uid){

	 	$civil_service_eligibility = DB::table('civil_service_eligibility')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(date_of_exam_conferment,'%Y-%m-%d')"), 'desc')->limit($number+1)->get();
   //%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($civil_service_eligibility);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->cs_board_bar_ces_csee_barangay_drivers =$civil_service_eligibility[$i]->cs_board_bar_ces_csee_barangay_drivers ? $civil_service_eligibility[$i]->cs_board_bar_ces_csee_barangay_drivers : 'N/A';
				$data->rating =$civil_service_eligibility[$i]->rating ? $civil_service_eligibility[$i]->rating : 'N/A';
				$data->date_of_exam_conferment =$civil_service_eligibility[$i]->date_of_exam_conferment ? date('m/d/Y', strtotime($civil_service_eligibility[$i]->date_of_exam_conferment)) : 'N/A';
				$data->place_of_exam_conferment =$civil_service_eligibility[$i]->place_of_exam_conferment ? $civil_service_eligibility[$i]->place_of_exam_conferment : 'N/A';
				$data->license_number =$civil_service_eligibility[$i]->license_number ? $civil_service_eligibility[$i]->license_number : 'N/A';
				$data->license_date_of_validity =$civil_service_eligibility[$i]->license_date_of_validity ? date('m/d/Y', strtotime($civil_service_eligibility[$i]->license_date_of_validity)) : 'N/A';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 

	    	for ($x=0; $x <= $number; $x++) { 

				$data->cs_board_bar_ces_csee_barangay_drivers = 'N/A';
				$data->rating = 'N/A';
				$data->date_of_exam_conferment = 'N/A';
				$data->place_of_exam_conferment = 'N/A';
				$data->license_number = 'N/A';
				$data->license_date_of_validity = 'N/A';
	    		$arr[] = $data;
	    	}
	
    	return $arr;
    }

    public static function reports($id){

    	switch ($id) {
    		case 'all':

			    	$find = DB::table('civil_service_eligibility')
			         ->select(
								'users.id',
								'users.name',
								'users.employee_status',
								'users.division',
								'users.position',
								'civil_service_eligibility.cs_board_bar_ces_csee_barangay_drivers',
								'civil_service_eligibility.rating',
								'civil_service_eligibility.date_of_exam_conferment',
								'civil_service_eligibility.place_of_exam_conferment',
								'civil_service_eligibility.license_number',
								'civil_service_eligibility.license_date_of_validity',
								'civil_service_eligibility.created_at',
								'civil_service_eligibility.updated_at')
							->crossJoin('users','civil_service_eligibility.user_id','=','users.id')
							->where(['civil_service_eligibility.flag' => 1, 'users.flag' => 1])
							->get();
    			
    			break;
    		
    		default:
    			
    			$find = DB::table('civil_service_eligibility')
			         ->select(
								'users.id',
								'users.name',
								'users.employee_status',
								'users.division',
								'users.position',
								'civil_service_eligibility.cs_board_bar_ces_csee_barangay_drivers',
								'civil_service_eligibility.rating',
								'civil_service_eligibility.date_of_exam_conferment',
								'civil_service_eligibility.place_of_exam_conferment',
								'civil_service_eligibility.license_number',
								'civil_service_eligibility.license_date_of_validity',
								'civil_service_eligibility.created_at',
								'civil_service_eligibility.updated_at')
							->crossJoin('users','civil_service_eligibility.user_id','=','users.id')
							->where(['civil_service_eligibility.flag' => 1, 'users.flag' => 1,'users.id' => decrypt($id)])
							->get();
    			

    			break;
    	}

       
      return $find;
    }

    public static function validate($id){
    	switch ($id) {
    		case 'all':
					$find = DB::table('civil_service_eligibility')
							->where(['flag' => 1])
							->count();
    				return $find;
    			break;
    		
    		default:
    				$find = DB::table('civil_service_eligibility')
							->where(['user_id' => decrypt($id)])
							->where(['flag' => 1])
							->count();
					return $find;	
    			break;

    			
    	}
    }
}
