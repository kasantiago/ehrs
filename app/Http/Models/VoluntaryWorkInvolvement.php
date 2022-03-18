<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class VoluntaryWorkInvolvement extends Model
{
   protected $table = 'voluntary_work';

    public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->name_address_of_org = '';
			$data->inclusive_date_from = '';
			$data->inclusive_date_to = '';
			$data->number_of_hours = '';
			$data->position_work = '';
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }

	public static function find_data($uid){
		$find = DB::table('voluntary_work')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}


	public static function get_data($uid){
		$find = DB::table('voluntary_work')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->get();
		return $find;
	}

    public static function pdf_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->name_address_of_org = 'N/A';
			$data->inclusive_date_from = 'N/A';
			$data->inclusive_date_to = 'N/A';
			$data->number_of_hours = 'N/A';
			$data->position_work = 'N/A';
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }

	 public static function pdf_generate($number,$uid){

	 	$voluntary_work = DB::table('voluntary_work')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'desc')->limit($number+1)->get();
   //%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($voluntary_work);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

			    $data->name_address_of_org = $voluntary_work[$i]->name_address_of_org ? $voluntary_work[$i]->name_address_of_org : 'N/A';
				$data->inclusive_date_from = $voluntary_work[$i]->inclusive_date_from ? date('m/d/Y', strtotime($voluntary_work[$i]->inclusive_date_from)) : 'N/A';
				$data->inclusive_date_to = $voluntary_work[$i]->inclusive_date_to ? date('m/d/Y', strtotime($voluntary_work[$i]->inclusive_date_to)) : 'N/A';
				$data->number_of_hours = $voluntary_work[$i]->number_of_hours ? $voluntary_work[$i]->number_of_hours : 'N/A';
				$data->position_work = $voluntary_work[$i]->position_work ? $voluntary_work[$i]->position_work : 'N/A';
	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
		    for ($x=0; $x <= $number; $x++) { 
				$data->name_address_of_org = 'N/A';
				$data->inclusive_date_from = 'N/A';
				$data->inclusive_date_to = 'N/A';
				$data->number_of_hours = 'N/A';
				$data->position_work = 'N/A';
	    		$arr[] = $data;
	    	}
	    

	 

    	return $arr;
    }


    //  public static function reports(){
  

    //   $find =   DB::table('voluntary_work')
				// ->select(
				// 	'users.id',
				// 	'users.name',
				// 	'users.employee_status',
				// 	'users.division',
				// 	'users.position',
				// 	'voluntary_work.name_address_of_org',
				// 	'voluntary_work.inclusive_date_from',
				// 	'voluntary_work.inclusive_date_to',
				// 	'voluntary_work.number_of_hours',
				// 	'voluntary_work.position_work',
				// 	'voluntary_work.updated_at',
				// 	'voluntary_work.created_at')
				// ->crossJoin('users','voluntary_work.user_id','=','users.id')
				// ->where(['voluntary_work.flag' => 1, 'users.flag' => 1])
				// ->get();

    //  //    echo '<pre>';
    // 	// print_r($find);
    //   return $find;
    // }

      public static function reports($id){

    	switch ($id) {
    		case 'all':

   			$find = DB::table('voluntary_work')
				->select(
					'users.id',
					'users.name',
					'users.employee_status',
					'users.division',
					'users.position',
					'voluntary_work.name_address_of_org',
					'voluntary_work.inclusive_date_from',
					'voluntary_work.inclusive_date_to',
					'voluntary_work.number_of_hours',
					'voluntary_work.position_work',
					'voluntary_work.updated_at',
					'voluntary_work.created_at')
				->crossJoin('users','voluntary_work.user_id','=','users.id')
				->where(['voluntary_work.flag' => 1, 'users.flag' => 1])
				->get();
    			
    			break;
    		
    		default:


				$find = DB::table('voluntary_work')
					->select(
						'users.id',
						'users.name',
						'users.employee_status',
						'users.division',
						'users.position',
						'voluntary_work.name_address_of_org',
						'voluntary_work.inclusive_date_from',
						'voluntary_work.inclusive_date_to',
						'voluntary_work.number_of_hours',
						'voluntary_work.position_work',
						'voluntary_work.updated_at',
						'voluntary_work.created_at')
					->crossJoin('users','voluntary_work.user_id','=','users.id')
					->where(['voluntary_work.flag' => 1, 'users.flag' => 1,'users.id' => decrypt($id)])
					->get();
    		
    			break;
    	}

       
      return $find;
    }

    public static function validate($id){
    	switch ($id) {
    		case 'all':
					$find = DB::table('voluntary_work')
							->where(['flag' => 1])
							->count();
    				return $find;
    			break;
    		
    		default:
    				$find = DB::table('voluntary_work')
							->where(['user_id' => decrypt($id)])
							->where(['flag' => 1])
							->count();
					return $find;	
    			break;

    			
    	}
    }
}
