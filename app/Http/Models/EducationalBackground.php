<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class EducationalBackground extends Model
{
    protected $table = 'educational_background';

	public static function find_data($uid){
		$find = DB::table('educational_background')->where('user_id',$uid)->where('flag',1)->first();
		if($find){
			$find = $find->id;
		}
		return $find;
	}

	public static function get_data($uid){
		$find = DB::table('educational_background')->where('id',$uid)->where('flag',1)->first();
		return $find;
	}


    public static function generate_blank_data(){

    	$data= new \stdClass();
		$data->elem_name_of_school = '';
		$data->elem_basic_ed_degree_course = '';
		$data->elem_period_from = '';
		$data->elem_period_to = '';
		$data->elem_highest_lvl_units_earned = '';
		$data->elem_year_graduated = '';
		$data->elem_scholarship_academic_honors = '';
		$data->second_name_of_school = '';
		$data->second_basic_ed_degree_course = '';
		$data->second_period_from = '';
		$data->second_period_to = '';
		$data->second_highest_lvl_units_earned = '';
		$data->second_year_graduated = '';
		$data->second_scholarship_academic_honors = '';
		$data->vocational_name_of_school = '';
		$data->vocational_basic_ed_degree_course = '';
		$data->vocational_period_from = '';
		$data->vocational_period_to = '';
		$data->vocational_highest_lvl_units_earned = '';
		$data->vocational_year_graduated = '';
		$data->vocational_scholarship_academic_honors = '';
		$data->college_name_of_school = '';
		$data->college_basic_ed_degree_course = '';
		$data->college_period_from = '';
		$data->college_period_to = '';
		$data->college_highest_lvl_units_earned = '';
		$data->college_year_graduated = '';
		$data->college_scholarship_academic_honors = '';
		$data->graduate_name_of_school = '';
		$data->graduate_basic_ed_degree_course = '';
		$data->graduate_period_from = '';
		$data->graduate_period_to = '';
		$data->graduate_highest_lvl_units_earned = '';
		$data->graduate_year_graduated = '';
		$data->graduate_scholarship_academic_honors = '';

		return $data;
    }

    public static function pdf_generate_blank_data(){

    	$data= new \stdClass();
		$data->elem_name_of_school = 'N/A';
		$data->elem_basic_ed_degree_course = 'N/A';
		$data->elem_period_from = 'N/A';
		$data->elem_period_to = 'N/A';
		$data->elem_highest_lvl_units_earned = 'N/A';
		$data->elem_year_graduated = 'N/A';
		$data->elem_scholarship_academic_honors = 'N/A';
		$data->second_name_of_school = 'N/A';
		$data->second_basic_ed_degree_course = 'N/A';
		$data->second_period_from = 'N/A';
		$data->second_period_to = 'N/A';
		$data->second_highest_lvl_units_earned = 'N/A';
		$data->second_year_graduated = 'N/A';
		$data->second_scholarship_academic_honors = 'N/A';
		$data->vocational_name_of_school = 'N/A';
		$data->vocational_basic_ed_degree_course = 'N/A';
		$data->vocational_period_from = 'N/A';
		$data->vocational_period_to = 'N/A';
		$data->vocational_highest_lvl_units_earned = 'N/A';
		$data->vocational_year_graduated = 'N/A';
		$data->vocational_scholarship_academic_honors = 'N/A';
		$data->college_name_of_school = 'N/A';
		$data->college_basic_ed_degree_course = 'N/A';
		$data->college_period_from = 'N/A';
		$data->college_period_to = 'N/A';
		$data->college_highest_lvl_units_earned = 'N/A';
		$data->college_year_graduated = 'N/A';
		$data->college_scholarship_academic_honors = 'N/A';
		$data->graduate_name_of_school = 'N/A';
		$data->graduate_basic_ed_degree_course = 'N/A';
		$data->graduate_period_from = 'N/A';
		$data->graduate_period_to = 'N/A';
		$data->graduate_highest_lvl_units_earned = 'N/A';
		$data->graduate_year_graduated = 'N/A';
		$data->graduate_scholarship_academic_honors = 'N/A';

		return $data;
    }

}
