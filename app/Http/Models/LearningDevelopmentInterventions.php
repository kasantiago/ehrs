<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LearningDevelopmentInterventions extends Model
{
    protected $table = 'learning_and_development';

    public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->title_of_learning = '';
			$data->inclusive_date_from = '';
			$data->inclusive_date_to = '';
			$data->number_of_hours = '';
			$data->type_of_ld = '';
			$data->conducted_sponsored_by = '';
    		$arr[] = $data;
    	}

    	return $arr;
    }

	public static function find_data($uid){
		$find = DB::table('learning_and_development')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}


	public static function get_data($uid){
		$find = DB::table('learning_and_development')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
		return $find;
	}

    public static function pdf_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->title_of_learning = 'N/A';
			$data->inclusive_date_from = 'N/A';
			$data->inclusive_date_to = 'N/A';
			$data->number_of_hours = 'N/A';
			$data->type_of_ld = 'N/A';
			$data->conducted_sponsored_by = 'N/A';
    		$arr[] = $data;
    	}

    	return $arr;
    }

    public static function pdf_generate($number,$uid){

	 	$learning_and_development = DB::table('learning_and_development')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->limit($number+1)->get();
   //%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($learning_and_development);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				
					$data->title_of_learning = $learning_and_development[$i]->title_of_learning ? $learning_and_development[$i]->title_of_learning : 'N/A';
					$data->inclusive_date_from = $learning_and_development[$i]->inclusive_date_from ? date('m/d/Y', strtotime($learning_and_development[$i]->inclusive_date_from)) : 'N/A';
					$data->inclusive_date_to = $learning_and_development[$i]->inclusive_date_to ? date('m/d/Y', strtotime($learning_and_development[$i]->inclusive_date_to)) : 'N/A';
					$data->number_of_hours = $learning_and_development[$i]->number_of_hours ? $learning_and_development[$i]->number_of_hours : 'N/A';
					$data->type_of_ld = $learning_and_development[$i]->type_of_ld ? $learning_and_development[$i]->type_of_ld : 'N/A';
					$data->conducted_sponsored_by = $learning_and_development[$i]->conducted_sponsored_by ? $learning_and_development[$i]->conducted_sponsored_by : 'N/A';
		    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
		    for ($x=0; $x <= $number; $x++) { 
			    $data->title_of_learning = 'N/A';
			    $data->inclusive_date_from = 'N/A';
			    $data->inclusive_date_to = 'N/A';
			    $data->number_of_hours = 'N/A';
			    $data->type_of_ld = 'N/A';
			    $data->conducted_sponsored_by = 'N/A';
	    		$arr[] = $data;
	    	}
	    

	 

    	return $arr;
    }



    //   public static function reports(){

    //      $find =   DB::table('learning_and_development')
    //        ->select(
				// 	'users.id',
				// 	'users.name',
				// 	'users.employee_status',
				// 	'users.division',
				// 	'users.position',
				// 	'learning_and_development.title_of_learning',
				// 	'learning_and_development.inclusive_date_from',
				// 	'learning_and_development.inclusive_date_to',
				// 	'learning_and_development.number_of_hours',
				// 	'learning_and_development.type_of_ld',
				// 	'learning_and_development.conducted_sponsored_by',
				// 	'learning_and_development.created_at',
				// 	'learning_and_development.updated_at')
				// ->crossJoin('users','learning_and_development.user_id','=','users.id')
				// ->where(['learning_and_development.flag' => 1, 'users.flag' => 1])
				// ->get();

 
    //  //    echo '<pre>';
    // 	// print_r($find);exit;
    //   return $find;
    // }

      public static function reports($id){

    	switch ($id) {
    		case 'all':


			$find = DB::table('learning_and_development')
				->select(
					'users.id',
					'users.name',
					'users.employee_status',
					'users.division',
					'users.position',
					'learning_and_development.title_of_learning',
					'learning_and_development.inclusive_date_from',
					'learning_and_development.inclusive_date_to',
					'learning_and_development.number_of_hours',
					'learning_and_development.type_of_ld',
					'learning_and_development.conducted_sponsored_by',
					'learning_and_development.created_at',
					'learning_and_development.updated_at')
				->crossJoin('users','learning_and_development.user_id','=','users.id')
				->where(['learning_and_development.flag' => 1, 'users.flag' => 1])
				->get();
    			
    			break;
    		
    		default:


			$find = DB::table('learning_and_development')
				->select(
					'users.id',
					'users.name',
					'users.employee_status',
					'users.division',
					'users.position',
					'learning_and_development.title_of_learning',
					'learning_and_development.inclusive_date_from',
					'learning_and_development.inclusive_date_to',
					'learning_and_development.number_of_hours',
					'learning_and_development.type_of_ld',
					'learning_and_development.conducted_sponsored_by',
					'learning_and_development.created_at',
					'learning_and_development.updated_at')
				->crossJoin('users','learning_and_development.user_id','=','users.id')
				->where(['learning_and_development.flag' => 1, 'users.flag' => 1,'users.id' => decrypt($id)])
				->get();
    		
    			break;
    	}

       
      return $find;
    }

    public static function validate($id){
    	switch ($id) {
    		case 'all':
					$find = DB::table('learning_and_development')
							->where(['flag' => 1])
							->count();
    				return $find;
    			break;
    		
    		default:
    				$find = DB::table('learning_and_development')
							->where(['user_id' => decrypt($id)])
							->where(['flag' => 1])
							->count();
					return $find;	
    			break;

    			
    	}
    }
}
