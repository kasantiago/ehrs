<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AssetsRealProperties extends Model
{
	protected $table = 'assets_real_properties';

    public static function find_data($uid){
		$find = DB::table('assets_real_properties')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->description = '';
			$data->kind = '';
			$data->exact_location = '';
			$data->assessed_value = '';
			$data->current_fair_market_value = '';
			$data->acquisition_year = '';
			$data->acquisition_mode = '';
			$data->acquisition_cost = '';		
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }


    public static function get_data($uid){
		$find = DB::table('assets_real_properties')->where('user_id',$uid)->where('flag',1)->get();
		return $find;
	}

	public static function pdf_generate($number,$uid){

	 	$assets_real_properties = DB::table('assets_real_properties')->where('user_id',$uid)->where('flag',1)->orderBy('id', 'desc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($assets_real_properties);
	 	if($count_data){

	 		$number = $number - $count_data;

	 		

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->description = $assets_real_properties[$i]->description ? $assets_real_properties[$i]->description : 'N/A';
				$data->kind = $assets_real_properties[$i]->kind ? $assets_real_properties[$i]->kind : 'N/A';
				$data->exact_location = $assets_real_properties[$i]->exact_location ? $assets_real_properties[$i]->exact_location : 'N/A';
				$data->assessed_value = $assets_real_properties[$i]->assessed_value ? $assets_real_properties[$i]->assessed_value : '0';
				$data->current_fair_market_value = $assets_real_properties[$i]->current_fair_market_value ? $assets_real_properties[$i]->current_fair_market_value : '0';
				$data->acquisition_year = $assets_real_properties[$i]->acquisition_year ? $assets_real_properties[$i]->acquisition_year : 'N/A';
				$data->acquisition_mode = $assets_real_properties[$i]->acquisition_mode ? $assets_real_properties[$i]->acquisition_mode : 'N/A';
				$data->acquisition_cost = $assets_real_properties[$i]->acquisition_cost ? $assets_real_properties[$i]->acquisition_cost : '0';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
	    	for ($x=0; $x <= $number; $x++) { 
				$data->description = 'N/A';
				$data->kind = 'N/A';
				$data->exact_location = 'N/A';
				$data->assessed_value = '0';
				$data->current_fair_market_value = '0';
				$data->acquisition_year = 'N/A';
				$data->acquisition_mode = 'N/A';
				$data->acquisition_cost = '0';
	    		$arr[] = $data;
			}

    	return $arr;
    }
 
}
