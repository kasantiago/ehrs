<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AssetsLiabilities extends Model
{
   
	protected $table = 'assets_liabilities';

    public static function find_data($uid){
		$find = DB::table('assets_liabilities')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function generate_blank_data($number = 0){

    	$arr = [];
    	$data= new \stdClass();
		
    	for ($count=0; $count <= $number; $count++) { 

			$data->nature = '';
			$data->name_of_creditors = '';
			$data->outstanding_balance = '';
		
    		$arr[] = $data;
    		
    	}

    	return $arr;
    }


    public static function get_data($uid){
		$find = DB::table('assets_liabilities')->where('user_id',$uid)->where('flag',1)->get();
		return $find;
	}

	public static function pdf_generate($number,$uid){

	 	$assets_liabilities = DB::table('assets_liabilities')->where('user_id',$uid)->where('flag',1)->orderBy('id', 'desc')->limit($number+1)->get();
   	//%d-%m-%Y
    	$arr = [];
    	
    	$default = 0;

	 	$count_data = count($assets_liabilities);
	 	if($count_data){

	 		$number = $number - $count_data;

	 	    for ($i=0; $i <= $count_data-1; $i++) { 
	 	    	$data= new \stdClass();

				$data->nature = $assets_liabilities[$i]->nature ? $assets_liabilities[$i]->nature : 'N/A';
				$data->name_of_creditors = $assets_liabilities[$i]->name_of_creditors ? $assets_liabilities[$i]->name_of_creditors : 'N/A';
				$data->outstanding_balance = $assets_liabilities[$i]->outstanding_balance ? $assets_liabilities[$i]->outstanding_balance : '0';

	    		$arr[] = $data;
	    	}
			
	 	}

	 	$data= new \stdClass();
	 	
	    	for ($x=0; $x <= $number; $x++) { 
				$data->nature = 'N/A';
				$data->name_of_creditors = 'N/A';
				$data->outstanding_balance = '0';
	    		$arr[] = $data;
			}

    	return $arr;
    }

}
