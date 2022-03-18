<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Childrens extends Model
{
    protected $table = 'name_of_children';

    public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 
    		$data->user_id = '';
			$data->fullname = '';
			$data->date_of_birth = '';
			$data->age = '';
    		$arr[] = $data;
    	}

    	return $arr;
    }

	public static function find_data($uid){
		$find = DB::table('name_of_children')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}


	public static function get_data($uid){
		//$find = DB::table('name_of_children')->where('user_id',$uid)->where('flag',1)->get();
		$find = DB::select("SELECT user_id,fullname,date_of_birth,FLOOR(DATEDIFF(CURRENT_DATE,date_of_birth)/365) AS age,flag,created_at,updated_at FROM name_of_children WHERE user_id = ".$uid." AND flag = 1");
		return $find;
	}


	public static function under_18_get_data($uid){
		$find = DB::select("SELECT * FROM (SELECT id,user_id,fullname,date_of_birth,FLOOR(DATEDIFF(CURRENT_DATE,date_of_birth)/365) AS age,flag,created_at,updated_at FROM name_of_children) as name_of_children WHERE age <= 18 AND user_id = ".$uid." AND flag = 1");
		return $find;
	}

	public static function under_18_find_data($uid){
		$find = DB::select("SELECT count(*) as count FROM (SELECT id,user_id,fullname,date_of_birth,FLOOR(DATEDIFF(CURRENT_DATE,date_of_birth)/365) AS age,flag,created_at,updated_at FROM name_of_children) as name_of_children WHERE age <= 18 AND user_id = ".$uid." AND flag = 1");
		
		return $find[0]->count;
	}


	 public static function pdf_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 
    		$data->user_id = 'N/A';
			$data->fullname = 'N/A';
			$data->date_of_birth = 'N/A';
			$data->age = 'N/A';
    		$arr[] = $data;
    	}

    	return $arr;
    }

    public static function pdf_generate_blank_data_ssalnw($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 
    		$data->user_id = 'N/A';
			$data->fullname = 'N/A';
			$data->date_of_birth = 'N/A';
			$data->age = 'N/A';
    		$arr[] = $data;
    	}

    	return $arr;
    }




	public static function pdf_generate($number,$uid){

	 	$childrens = DB::table('name_of_children')->where('user_id',$uid)->where('flag',1)->orderBy(DB::raw("DATE_FORMAT(date_of_birth,'%Y')"), 'asc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($childrens);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();
				$data->fullname = $childrens[$i]->fullname ? $childrens[$i]->fullname : 'N/A';
				$data->date_of_birth = $childrens[$i]->date_of_birth ?  date('m/d/Y', strtotime($childrens[$i]->date_of_birth)) : 'N/A';
	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	

	    	for ($x=0; $x <= $number; $x++) { 
	    		if($x == 0){
					$data->fullname = 'N/A';
					$data->date_of_birth = 'N/A';
		    		$arr[] = $data;
	    		}else{
		    		$data->fullname = 'N/A';
					$data->date_of_birth = 'N/A';
		    		$arr[] = $data;
	    		}
				
	    	}
	    

    	return $arr;
    }

    public static function pdf_generate_ssalnw($number,$uid){

	 	$childrens = DB::select("SELECT * FROM (SELECT id,user_id,fullname,date_of_birth,FLOOR(DATEDIFF(CURRENT_DATE,date_of_birth)/365) AS age,flag,created_at,updated_at FROM name_of_children) as name_of_children WHERE age <= 18 AND user_id = ".$uid." AND flag = 1");

	 	// echo "<pre>";
	 	// print_r($childrens);exit;

   //%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($childrens);
	 	if($count_data){

	 		$number = $number - $count_data;

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();
				$data->fullname = $childrens[$i]->fullname ? $childrens[$i]->fullname : 'N/A';
				$data->date_of_birth = $childrens[$i]->date_of_birth ? date('m/d/Y', strtotime($childrens[$i]->date_of_birth)) : 'N/A';
				$data->age = $childrens[$i]->age ?  $childrens[$i]->age : 'N/A';
	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	

	    	for ($x=0; $x <= $number; $x++) { 
	    		if($x == 0){
					$data->fullname = 'N/A';
					$data->date_of_birth = 'N/A';
					$data->age = 'N/A';
		    		$arr[] = $data;
	    		}else{
		    		$data->fullname = 'N/A';
					$data->date_of_birth = 'N/A';
					$data->age = 'N/A';
		    		$arr[] = $data;
	    		}
				
	    	}
	    
    	return $arr;
    }

}
