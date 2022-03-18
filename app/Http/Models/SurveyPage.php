<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SurveyPage extends Model
{
 
	public static function find_data($uid){
		$find = DB::table('pds_page_four')->where('user_id',$uid)->where('flag',1)->count();
		return $find;
	}

	public static function get_data($uid){
		
		$data1 = DB::table('pds_page_four')->where('user_id',$uid)->where('flag',1)->first();
		$data2 = DB::table('pds_page_four_two')->where('user_id',$uid)->where('flag',1)->first();


    	$data= new \stdClass();

    	if($data1){

				
		$data->thirty_four_a = $data1->thirty_four_a;
		$data->thirty_four_b = $data1->thirty_four_b;
		$data->thirty_four_a_b_if_yes = $data1->thirty_four_a_b_if_yes;
		$data->thirty_five_a = $data1->thirty_five_a;
		$data->thirty_five_a_if_yes = $data1->thirty_five_a_if_yes;
		$data->thirty_five_b = $data1->thirty_five_b;
		$data->thirty_five_b_if_yes_date = $data1->thirty_five_b_if_yes_date;
		$data->thirty_five_b_if_yes_case = $data1->thirty_five_b_if_yes_case;
		$data->thirty_six = $data1->thirty_six;
		$data->thirty_six_if_yes = $data1->thirty_six_if_yes;
		$data->thirty_seven = $data1->thirty_seven;
		$data->thirty_seven_if_yes = $data1->thirty_seven_if_yes;
		$data->thirty_eight_a = $data1->thirty_eight_a;
		$data->thirty_eight_a_if_yes = $data1->thirty_eight_a_if_yes;
		$data->thirty_eight_b = $data1->thirty_eight_b;
		$data->thirty_eight_b_if_yes = $data1->thirty_eight_b_if_yes;
		$data->thirty_nine = $data1->thirty_nine;
		$data->thirty_nine_if_yes = $data1->thirty_nine_if_yes;
		$data->fourty_a = $data1->fourty_a;
		$data->fourty_a_if_yes = $data1->fourty_a_if_yes;
		$data->fourty_b = $data1->fourty_b;
		$data->fourty_b_if_yes = $data1->fourty_b_if_yes;
		$data->fourty_c = $data1->fourty_c;
		$data->fourty_c_if_yes = $data1->fourty_c_if_yes;

	}else{


		$data->thirty_four_a = '';
		$data->thirty_four_b = '';
		$data->thirty_four_a_b_if_yes = '';
		$data->thirty_five_a = '';
		$data->thirty_five_a_if_yes = '';
		$data->thirty_five_b = '';
		$data->thirty_five_b_if_yes_date = '';
		$data->thirty_five_b_if_yes_case = '';
		$data->thirty_six = '';
		$data->thirty_six_if_yes = '';
		$data->thirty_seven = '';
		$data->thirty_seven_if_yes = '';
		$data->thirty_eight_a = '';
		$data->thirty_eight_a_if_yes = '';
		$data->thirty_eight_b = '';
		$data->thirty_eight_b_if_yes = '';
		$data->thirty_nine = '';
		$data->thirty_nine_if_yes = '';
		$data->fourty_a = '';
		$data->fourty_a_if_yes = '';
		$data->fourty_b = '';
		$data->fourty_b_if_yes = '';
		$data->fourty_c = '';
		$data->fourty_c_if_yes = '';


	}

	if($data1){

		$data->references_name_one = $data2->references_name_one;
		$data->references_address_one = $data2->references_address_one;
		$data->references_telephone_one = $data2->references_telephone_one;
		$data->references_name_two = $data2->references_name_two;
		$data->references_address_two = $data2->references_address_two;
		$data->references_telephone_two = $data2->references_telephone_two;
		$data->references_name_three = $data2->references_name_three;
		$data->references_address_three = $data2->references_address_three;
		$data->references_telephone_three = $data2->references_telephone_three;
		$data->government_issued_id = $data2->government_issued_id;
		$data->id_license_passport_number = $data2->id_license_passport_number;
		$data->date_place_of_issuance = $data2->date_place_of_issuance;	
		$data->co_government_issued_id = $data2->co_government_issued_id;
		$data->co_id_license_passport_number = $data2->co_id_license_passport_number;
		$data->co_date_place_of_issuance = $data2->co_date_place_of_issuance;	
					
  
	}else{

		$data->references_name_one = '';
		$data->references_address_one = '';
		$data->references_telephone_one = '';
		$data->references_name_two = '';
		$data->references_address_two = '';
		$data->references_telephone_two = '';
		$data->references_name_three = '';
		$data->references_address_three = '';
		$data->references_telephone_three = '';
		$data->government_issued_id = '';
		$data->id_license_passport_number = '';
		$data->date_place_of_issuance = '';		
  		$data->co_government_issued_id = '';
		$data->co_id_license_passport_number = '';
		$data->co_date_place_of_issuance = '';	  
    	

	}

    	return $data;
	}


	public static function pdf_get_data($uid){
		
		$data1 = DB::table('pds_page_four')->where('user_id',$uid)->where('flag',1)->first();
		$data2 = DB::table('pds_page_four_two')->where('user_id',$uid)->where('flag',1)->first();


    	$data= new \stdClass();

    	if($data1){

				
		$data->thirty_four_a = $data1->thirty_four_a ? $data1->thirty_four_a : 'N/A';
		$data->thirty_four_b = $data1->thirty_four_b ? $data1->thirty_four_b : 'N/A';
		$data->thirty_four_a_b_if_yes = $data1->thirty_four_a_b_if_yes ? $data1->thirty_four_a_b_if_yes : 'N/A';
		$data->thirty_five_a = $data1->thirty_five_a ? $data1->thirty_five_a : 'N/A';
		$data->thirty_five_a_if_yes = $data1->thirty_five_a_if_yes ? $data1->thirty_five_a_if_yes : 'N/A';
		$data->thirty_five_b = $data1->thirty_five_b ? $data1->thirty_five_b : 'N/A';
		$data->thirty_five_b_if_yes_date = $data1->thirty_five_b_if_yes_date ? $data1->thirty_five_b_if_yes_date : 'N/A';
		$data->thirty_five_b_if_yes_case = $data1->thirty_five_b_if_yes_case ? $data1->thirty_five_b_if_yes_case : 'N/A';
		$data->thirty_six = $data1->thirty_six ? $data1->thirty_six : 'N/A';
		$data->thirty_six_if_yes = $data1->thirty_six_if_yes ? $data1->thirty_six_if_yes : 'N/A';
		$data->thirty_seven = $data1->thirty_seven ? $data1->thirty_seven : 'N/A';
		$data->thirty_seven_if_yes = $data1->thirty_seven_if_yes ? $data1->thirty_seven_if_yes : 'N/A';
		$data->thirty_eight_a = $data1->thirty_eight_a ? $data1->thirty_eight_a : 'N/A';
		$data->thirty_eight_a_if_yes = $data1->thirty_eight_a_if_yes ? $data1->thirty_eight_a_if_yes : 'N/A';
		$data->thirty_eight_b = $data1->thirty_eight_b ? $data1->thirty_eight_b : 'N/A';
		$data->thirty_eight_b_if_yes = $data1->thirty_eight_b_if_yes ? $data1->thirty_eight_b_if_yes : 'N/A';
		$data->thirty_nine = $data1->thirty_nine ? $data1->thirty_nine : 'N/A';
		$data->thirty_nine_if_yes = $data1->thirty_nine_if_yes ? $data1->thirty_nine_if_yes : 'N/A';
		$data->fourty_a = $data1->fourty_a ? $data1->fourty_a : 'N/A';
		$data->fourty_a_if_yes = $data1->fourty_a_if_yes ? $data1->fourty_a_if_yes : 'N/A';
		$data->fourty_b = $data1->fourty_b ? $data1->fourty_b : 'N/A';
		$data->fourty_b_if_yes = $data1->fourty_b_if_yes ? $data1->fourty_b_if_yes : 'N/A';
		$data->fourty_c = $data1->fourty_c ? $data1->fourty_c : 'N/A';
		$data->fourty_c_if_yes = $data1->fourty_c_if_yes ? $data1->fourty_c_if_yes : 'N/A';

	}else{


		$data->thirty_four_a = 'N/A';
		$data->thirty_four_b = 'N/A';
		$data->thirty_four_a_b_if_yes = 'N/A';
		$data->thirty_five_a = 'N/A';
		$data->thirty_five_a_if_yes = 'N/A';
		$data->thirty_five_b = 'N/A';
		$data->thirty_five_b_if_yes_date = 'N/A';
		$data->thirty_five_b_if_yes_case = 'N/A';
		$data->thirty_six = 'N/A';
		$data->thirty_six_if_yes = 'N/A';
		$data->thirty_seven = 'N/A';
		$data->thirty_seven_if_yes = 'N/A';
		$data->thirty_eight_a = 'N/A';
		$data->thirty_eight_a_if_yes = 'N/A';
		$data->thirty_eight_b = 'N/A';
		$data->thirty_eight_b_if_yes = 'N/A';
		$data->thirty_nine = 'N/A';
		$data->thirty_nine_if_yes = 'N/A';
		$data->fourty_a = 'N/A';
		$data->fourty_a_if_yes = 'N/A';
		$data->fourty_b = 'N/A';
		$data->fourty_b_if_yes = 'N/A';
		$data->fourty_c = 'N/A';
		$data->fourty_c_if_yes = 'N/A';


	}

	if($data1){

		$data->references_name_one = $data2->references_name_one ? $data2->references_name_one : 'N/A';
		$data->references_address_one = $data2->references_address_one ? $data2->references_address_one : 'N/A';
		$data->references_telephone_one = $data2->references_telephone_one ? $data2->references_telephone_one : 'N/A';
		$data->references_name_two = $data2->references_name_two ? $data2->references_name_two : 'N/A';
		$data->references_address_two = $data2->references_address_two ? $data2->references_address_two : 'N/A';
		$data->references_telephone_two = $data2->references_telephone_two ? $data2->references_telephone_two : 'N/A';
		$data->references_name_three = $data2->references_name_three ? $data2->references_name_three : 'N/A';
		$data->references_address_three = $data2->references_address_three ? $data2->references_address_three : 'N/A';
		$data->references_telephone_three = $data2->references_telephone_three ? $data2->references_telephone_three : 'N/A';
		$data->government_issued_id = $data2->government_issued_id ? $data2->government_issued_id : 'N/A';
		$data->id_license_passport_number = $data2->id_license_passport_number ? $data2->id_license_passport_number : 'N/A';
		$data->date_place_of_issuance = $data2->date_place_of_issuance ? $data2->date_place_of_issuance : 'N/A';		
  
	}else{

		$data->references_name_one = 'N/A';
		$data->references_address_one = 'N/A';
		$data->references_telephone_one = 'N/A';
		$data->references_name_two = 'N/A';
		$data->references_address_two = 'N/A';
		$data->references_telephone_two = 'N/A';
		$data->references_name_three = 'N/A';
		$data->references_address_three = 'N/A';
		$data->references_telephone_three = 'N/A';
		$data->government_issued_id = 'N/A';
		$data->id_license_passport_number = 'N/A';
		$data->date_place_of_issuance = 'N/A';		
    
    	

	}

    	return $data;
	}
}
