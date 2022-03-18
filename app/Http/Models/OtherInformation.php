<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OtherInformation extends Model
{
   protected $table = 'other_information';

    public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->special_skills_hobbies = '';
			$data->none_academic_distinctions = '';
			$data->membership_in_assoc_org = '';
    		$arr[] = $data;
    	}

    	return $arr;
    }

	public static function find_data($uid){
		$find = DB::table('other_information')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}


	public static function get_data($uid){
		$find = DB::table('other_information')->where('user_id',$uid)->where('flag',1)->get();
		return $find;
	}


	  public static function pdf_generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->special_skills_hobbies = 'N/A';
			$data->none_academic_distinctions = 'N/A';
			$data->membership_in_assoc_org = 'N/A';
    		$arr[] = $data;
    	}

    	return $arr;
    }

    public static function pdf_generate($number,$uid){

	 	$other_information = DB::table('other_information')->where('user_id',$uid)->where('flag',1)->limit($number+1)->get();
   //%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($other_information);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				
				    $data->special_skills_hobbies = $other_information[$i]->special_skills_hobbies ? $other_information[$i]->special_skills_hobbies :'N/A';
					$data->none_academic_distinctions = $other_information[$i]->none_academic_distinctions ? $other_information[$i]->none_academic_distinctions :'N/A';
					$data->membership_in_assoc_org = $other_information[$i]->membership_in_assoc_org ? $other_information[$i]->membership_in_assoc_org :'N/A';
		    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
		    for ($x=0; $x <= $number; $x++) { 
				$data->special_skills_hobbies = 'N/A';
			    $data->none_academic_distinctions = 'N/A';
			    $data->membership_in_assoc_org = 'N/A';
	    		$arr[] = $data;
	    	}
	    

	 

    	return $arr;
    }
}
