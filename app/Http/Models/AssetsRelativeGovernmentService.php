<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AssetsRelativeGovernmentService extends Model
{
    protected $table = 'relatives_government_service';

    public static function find_data($uid){
		$find = DB::table('relatives_government_service')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->name_of_relative = '';
			$data->relationship = '';
			$data->position = '';
			$data->agency_and_address = '';
		
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }

    public static function get_data($uid){
		$find = DB::table('relatives_government_service')->where('user_id',$uid)->where('flag',1)->get();
		return $find;
	}

	public static function pdf_generate($number,$uid){

	 	$relatives_government_service = DB::table('relatives_government_service')->where('user_id',$uid)->where('flag',1)->orderBy('id', 'desc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($relatives_government_service);
	 	if($count_data){

	 		$number = $number - $count_data;

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->name_of_relative = $relatives_government_service[$i]->name_of_relative ? $relatives_government_service[$i]->name_of_relative : 'N/A';
				$data->relationship = $relatives_government_service[$i]->relationship ? $relatives_government_service[$i]->relationship : 'N/A';
				$data->position = $relatives_government_service[$i]->position ? $relatives_government_service[$i]->position : 'N/A';
				$data->agency_and_address = $relatives_government_service[$i]->agency_and_address ? $relatives_government_service[$i]->agency_and_address : 'N/A';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
	    	for ($x=0; $x <= $number; $x++) { 
				$data->name_of_relative = 'N/A';
				$data->relationship = 'N/A';
				$data->position = 'N/A';
				$data->agency_and_address = 'N/A';
	    		$arr[] = $data;
			}

    	return $arr;
    }
}
