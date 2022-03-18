<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProgressBar extends Model
{
    protected $table = 'pds_progress_bar';
    
   public static function save_id_to_progress($uid)
   {
      DB::table('pds_progress_bar')->insert(
          ['user_id' => $uid]
      );

   }

   public static function compute($total,$result,$field,$user_id){
   	  
	    $percentage = round(($result/$total) * 100,2);

   		$find = DB::table('pds_progress_bar')->where('user_id',$user_id)->first();
   		if($find){
   			DB::table('pds_progress_bar')->where('user_id',$user_id)->update([
   				$field => $percentage,
   			]);
   		}else{
   			DB::table('pds_progress_bar')->where('user_id',$user_id)->insert([
   				$field => $percentage,
   				'user_id' => $user_id
   			]);
   		}

   		return $percentage;
   }


   public static function personal_information($arry,$field,$user_id){
   			$total = 25;
   			$result = 0;
   	  		foreach ($arry as $key => $value) {
   	  	

        			$key == 'surname' && $value ? $result++ : '';
        			$key == 'first_name' && $value  ? $result++ : '';
        			$key == 'middle_name' && $value  ? $result++ : '';
        			$key == 'date_of_birth' && $value  ? $result++ : '';
        			$key == 'place_of_birth' && $value  ? $result++ : '';
        			$key == 'sex' && $value  ? $result++ : '';
        			$key == 'civil_status' && $value  ? $result++ : '';
        			$key == 'weight' && $value  ? $result++ : '';
        			$key == 'height' && $value  ? $result++ : '';
        			$key == 'blood_type' && $value  ? $result++ : '';
        			// $key == 'gsis_id_number' && $value  ? $result++ : '';
        			$key == 'pagibig_id_number' && $value  ? $result++ : '';
        			$key == 'philhealth_number' && $value  ? $result++ : '';
        			// $key == 'sss_number' && $value  ? $result++ : '';
        			$key == 'tin_number' && $value  ? $result++ : '';
        			$key == 'agency_employee_number' && $value  ? $result++ : '';
        			$key == 'citizenship' && $value  ? $result++ : '';
        			// $key == 'country' && $value  ? $result++ : '';
        			// $key == 'r_address_house_block_lot_number' && $value  ? $result++ : '';
        			// $key == 'r_address_street' && $value  ? $result++ : '';
        			// $key == 'r_address_subdivision_village' && $value  ? $result++ : '';
        			$key == 'r_address_barangay' && $value  ? $result++ : '';
        			$key == 'r_address_city_municipality' && $value  ? $result++ : '';
        			$key == 'r_address_province' && $value  ? $result++ : '';
        			$key == 'r_address_zipcode' && $value  ? $result++ : '';
        			// $key == 'duplicate_address' && $value  ? $result++ : '';
        			// $key == 'p_address_house_block_lot_number' && $value  ? $result++ : '';
        			// $key == 'p_address_street' && $value  ? $result++ : '';
        			// $key == 'p_address_subdivision_village' && $value  ? $result++ : '';
        			$key == 'p_address_barangay' && $value  ? $result++ : '';
        			$key == 'p_address_city_municipality' && $value  ? $result++ : '';
        			$key == 'p_address_province' && $value  ? $result++ : '';
        			$key == 'p_address_zipcode' && $value  ? $result++ : '';
        			// $key == 'telephone_number' && $value  ? $result++ : '';
        			$key == 'mobile_number' && $value  ? $result++ : '';
        			$key == 'email_address' && $value  ? $result++ : '';
			   	  		

   	  		}


   	  		self::compute($total,$result,$field,$user_id);

   	  		return $result;
   }



   public static function family_background($arry,$field,$user_id){
   			$total = 7;
   			$result = 0;
   	  		foreach ($arry as $key => $value) {
  	   	  
    				$key == 'fathers_surname' && $value ? $result++ : '';
    				$key == 'fathers_first_name' && $value  ? $result++ : '';
    				$key == 'fathers_middle_name' && $value  ? $result++ : '';
    			
          	$key == 'mothers_maiden_name' && $value  ? $result++ : '';
    				$key == 'mothers_surname' && $value  ? $result++ : '';
    				$key == 'mothers_first_name' && $value  ? $result++ : '';
    				$key == 'mothers_middle_name' && $value  ? $result++ : '';

   	  		}


   	  		self::compute($total,$result,$field,$user_id);

   	  		return $result;
   }



   public static function educational_background($arry,$field,$user_id){
   			$total = 13;
   			$result = 0;
   	  		foreach ($arry as $key => $value) {

      				$key == 'elem_name_of_school' && $value ? $result++ : '';
      				$key == 'elem_period_from' && $value  ? $result++ : '';
      				$key == 'elem_period_to' && $value  ? $result++ : '';
      				$key == 'elem_year_graduated' && $value  ? $result++ : '';

      				$key == 'second_name_of_school' && $value  ? $result++ : '';
      		
      				$key == 'second_period_from' && $value ? $result++ : '';
      				$key == 'second_period_to' && $value  ? $result++ : '';
      				$key == 'second_year_graduated' && $value  ? $result++ : '';

      				$key == 'college_name_of_school' && $value  ? $result++ : '';
      				$key == 'college_basic_ed_degree_course' && $value  ? $result++ : '';
      				$key == 'college_period_from' && $value  ? $result++ : '';
      				$key == 'college_period_to' && $value  ? $result++ : '';
      				$key == 'college_year_graduated' && $value ? $result++ : '';

   	  		}


   	  		self::compute($total,$result,$field,$user_id);

   	  		return $result;
   }




   public static function civil_service_eligibility($arry,$field,$user_id){
          $total = 3 * count($arry['cs_board_bar_ces_csee_barangay_drivers']);
            $result = 0;
            $cnt_arry = count($arry['cs_board_bar_ces_csee_barangay_drivers']) - 1;

            for ($cnt=0; $cnt <= $cnt_arry; $cnt++) { 
               
                $arry['date_of_exam_conferment'][$cnt]  ? $result++ : '';
                $arry['cs_board_bar_ces_csee_barangay_drivers'][$cnt]  ? $result++ : '';
                $arry['place_of_exam_conferment'][$cnt]  ? $result++ : '';   
               

            }
   	  		self::compute($total,$result,$field,$user_id);
   	  		return $result;
   }


   public static function work_experience($arry,$field,$user_id){
   		   $total = 12 * count($arry['position_title']);
            $result = 0;
            $cnt_arry = count($arry['position_title']) - 1;

            for ($cnt=0; $cnt <= $cnt_arry; $cnt++) { 
               
                $arry['inclusive_date_from'][$cnt]  ? $result++ : '';
                $arry['inclusive_date_to'][$cnt]  ? $result++ : '';
                $arry['position_title'][$cnt]  ? $result++ : '';
                $arry['dept_agency_office_company'][$cnt]  ? $result++ : '';
                $arry['monthly_salary'][$cnt]  ? $result++ : '';   
                $arry['service_record_salary'][$cnt]  ? $result++ : '';
                $arry['status_of_appointment'][$cnt]  ? $result++ : '';
                $arry['govt_service'][$cnt]  ? $result++ : '';

                if( $arry['govt_service'][$cnt] == 'Y')
                  {
                      // $arry['paygrade'][$cnt]  ? $result++ : '';
                      $arry['agency_type'][$cnt]  ? $result++ : '';
                      // $arry['pay'][$cnt]  ? $result++ : '';
                      // $arry['cause'][$cnt]  ? $result++ : '';
                      $result = $result + 3;
                  }else{
                      $result = $result + 4;
                  }
            }
            
   	  		self::compute($total,$result,$field,$user_id);
   	  		return $result;
   }
    public static function voluntary_works($arry,$field,$user_id){
            $total = 5 * count($arry['name_address_of_org']);
            $result = 0;
            $cnt_arry = count($arry['name_address_of_org']) - 1;

            for ($cnt=0; $cnt <= $cnt_arry; $cnt++) { 
               
                $arry['inclusive_date_from'][$cnt]  ? $result++ : '';
                $arry['inclusive_date_to'][$cnt]  ? $result++ : '';
                $arry['name_address_of_org'][$cnt]  ? $result++ : '';
                $arry['number_of_hours'][$cnt]  ? $result++ : '';
                $arry['position_work'][$cnt]  ? $result++ : '';  

            }
            
   	  		self::compute($total,$result,$field,$user_id);
   	  		return $result;
   }
   public static function learning_development($arry,$field,$user_id){
            $total = 6 * count($arry['title_of_learning']);
            $result = 0;
            $cnt_arry = count($arry['title_of_learning']) - 1;

            for ($cnt=0; $cnt <= $cnt_arry; $cnt++) { 
               
                $arry['inclusive_date_from'][$cnt]  ? $result++ : '';
                $arry['inclusive_date_to'][$cnt]  ? $result++ : '';
                $arry['title_of_learning'][$cnt]  ? $result++ : '';
                $arry['number_of_hours'][$cnt]  ? $result++ : '';
                $arry['type_of_ld'][$cnt]  ? $result++ : '';  
                $arry['conducted_sponsored_by'][$cnt]  ? $result++ : '';  

            }
   	  		self::compute($total,$result,$field,$user_id);
   	  		return $result;
   }

    public static function other_information($arry,$field,$user_id){
            $total = 1 * count($arry['special_skills_hobbies']);
            $result = 0;
            $cnt_arry = count($arry['special_skills_hobbies']) - 1;

            for ($cnt=0; $cnt <= $cnt_arry; $cnt++) { 
                $arry['special_skills_hobbies'][$cnt]  ? $result++ : '';
                // $arry['membership_in_assoc_org'][$cnt]  ? $result++ : '';
                // $arry['none_academic_distinctions'][$cnt]  ? $result++ : '';
            }
   	  		self::compute($total,$result,$field,$user_id);
   	  		return $result;
   }
 

    public static function survey($arry,$field,$user_id){
            $total = 23;
            $result = 0;
          
            foreach ($arry as $key => $value) {
           
            $key == 'thirty_four_a' && $value ? $result++ : '';
            $key == 'thirty_four_b' && $value  ? $result++ : '';
            $key == 'thirty_five_a' && $value  ? $result++ : '';
            $key == 'thirty_five_b' && $value  ? $result++ : '';
            $key == 'thirty_six' && $value  ? $result++ : '';
            $key == 'thirty_seven' && $value  ? $result++ : '';
            $key == 'thirty_eight_a' && $value  ? $result++ : '';
            $key == 'thirty_eight_b' && $value  ? $result++ : '';
            $key == 'thirty_nine' && $value  ? $result++ : '';
            $key == 'fourty_a' && $value  ? $result++ : '';
            $key == 'fourty_b' && $value  ? $result++ : '';
            $key == 'fourty_c' && $value  ? $result++ : '';
            $key == 'references_name_one' && $value  ? $result++ : '';
            $key == 'references_address_one' && $value  ? $result++ : '';
            $key == 'references_telephone_one' && $value  ? $result++ : '';
            $key == 'references_name_two' && $value  ? $result++ : '';
            $key == 'references_address_two' && $value  ? $result++ : '';
            $key == 'references_telephone_two' && $value  ? $result++ : '';
            $key == 'references_name_three' && $value  ? $result++ : '';
            $key == 'references_address_three' && $value  ? $result++ : '';
            $key == 'references_telephone_three' && $value  ? $result++ : '';
            $key == 'government_issued_id' && $value  ? $result++ : '';
            $key == 'id_license_passport_number' && $value  ? $result++ : '';
            $key == 'date_place_of_issuance' && $value  ? $result++ : '';

            }


            self::compute($total,$result,$field,$user_id);

            return $result;
   }



}
