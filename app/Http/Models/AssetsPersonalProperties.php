<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AssetsPersonalProperties extends Model
{
    protected $table = 'assets_personal_properties';

    public static function find_data($uid){
		$find = DB::table('assets_personal_properties')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->description = '';
			$data->year_acquired = '';
			$data->acquisition_cost = '';
					
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }

    public static function get_data($uid){
		$find = DB::table('assets_personal_properties')->where('user_id',$uid)->where('flag',1)->get();
		return $find;
	}

	public static function pdf_generate($number,$uid){

	 	$assets_personal_properties = DB::table('assets_personal_properties')->where('user_id',$uid)->where('flag',1)->orderBy('id', 'desc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($assets_personal_properties);
	 	if($count_data){

	 		$number = $number - $count_data;

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->description = $assets_personal_properties[$i]->description ? $assets_personal_properties[$i]->description : 'N/A';
				$data->year_acquired = $assets_personal_properties[$i]->year_acquired ? $assets_personal_properties[$i]->year_acquired : 'N/A';
				$data->acquisition_cost = $assets_personal_properties[$i]->acquisition_cost ? $assets_personal_properties[$i]->acquisition_cost : '0';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
	    	for ($x=0; $x <= $number; $x++) { 
				$data->description = 'N/A';
				$data->year_acquired = 'N/A';
				$data->acquisition_cost = '0';
	    		$arr[] = $data;
			}

    	return $arr;
    }
}
