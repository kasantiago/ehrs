<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FamilyBackground extends Model
{
    protected $table = 'family_background';

	public static function find_data($uid){
		$find = DB::table('family_background')->where('user_id',$uid)->where('flag',1)->first();
		if($find){
			$find = $find->id;
		}
		return $find;
	}

	public static function get_data($uid){
		$find = DB::table('family_background')->where('id',$uid)->where('flag',1)->first();
		return $find;
	}


    public static function generate_blank_data(){

    	$data= new \stdClass();
		$data->spouse_surname = '';
		$data->spouse_first_name = '';
		$data->spouse_name_extension = '';
		$data->spouse_middle_name = '';
		$data->spouse_occupation = '';
		$data->spouse_employer_business_name = '';
		$data->spouse_business_address = '';
		$data->spouse_telephone_number = '';
		$data->fathers_surname = '';
		$data->fathers_first_name = '';
		$data->fathers_name_extension = '';
		$data->fathers_middle_name = '';
		$data->mothers_maiden_name = '';
		$data->mothers_surname = '';
		$data->mothers_first_name = '';
		$data->mothers_middle_name = '';

		return $data;
    }


    public static function pdf_generate_blank_data(){

    	$data= new \stdClass();
		$data->spouse_surname = 'N/A';
		$data->spouse_first_name = 'N/A';
		$data->spouse_name_extension = 'N/A';
		$data->spouse_middle_name = 'N/A';
		$data->spouse_occupation = 'N/A';
		$data->spouse_employer_business_name = 'N/A';
		$data->spouse_business_address = 'N/A';
		$data->spouse_telephone_number = 'N/A';
		$data->fathers_surname = 'N/A';
		$data->fathers_first_name = 'N/A';
		$data->fathers_name_extension = 'N/A';
		$data->fathers_middle_name = 'N/A';
		$data->mothers_maiden_name = 'N/A';
		$data->mothers_surname = 'N/A';
		$data->mothers_first_name = 'N/A';
		$data->mothers_middle_name = 'N/A';

		return $data;
    }

}
