<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AssetsBussIntFinCon extends Model
{
   	protected $table = 'assets_business_interest_and_financial_connection';

    public static function find_data($uid){
		$find = DB::table('assets_business_interest_and_financial_connection')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->name_of_business = '';
			$data->business_address	 = '';
			$data->nature_of_business = '';
			$data->date_of_acquisition	 = '';
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }

    public static function get_data($uid){
		$find = DB::table('assets_business_interest_and_financial_connection')->where('user_id',$uid)->where('flag',1)->get();
		return $find;
	}

	public static function pdf_generate($number,$uid){

	 	$assets_business_interest_and_financial = DB::table('assets_business_interest_and_financial_connection')->where('user_id',$uid)->where('flag',1)->orderBy('id', 'desc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($assets_business_interest_and_financial);
	 	if($count_data){

	 		$number = $number - $count_data;

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->name_of_business = $assets_business_interest_and_financial[$i]->name_of_business ? $assets_business_interest_and_financial[$i]->name_of_business : 'N/A';
				$data->business_address = $assets_business_interest_and_financial[$i]->business_address ? $assets_business_interest_and_financial[$i]->business_address : 'N/A';
				$data->nature_of_business = $assets_business_interest_and_financial[$i]->nature_of_business ? $assets_business_interest_and_financial[$i]->nature_of_business : 'N/A';
				$data->date_of_acquisition = $assets_business_interest_and_financial[$i]->date_of_acquisition ? $assets_business_interest_and_financial[$i]->date_of_acquisition : 'N/A';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
	    	for ($x=0; $x <= $number; $x++) { 
				$data->name_of_business = 'N/A';
				$data->business_address = 'N/A';
				$data->nature_of_business = 'N/A';
				$data->date_of_acquisition = 'N/A';
	    		$arr[] = $data;
			}

    	return $arr;
    }
}
