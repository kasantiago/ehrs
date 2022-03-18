<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use Validator;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\FamilyBackground as FamilyBackground;
use App\Http\Models\Childrens as Childrens;
use App\Http\Models\EducationalBackground as EducationalBackground;
use App\Http\Models\CivilServiceEligibility as CivilServiceEligibility;
use App\Http\Models\WorkExperience as WorkExperience;
use App\Http\Models\VoluntaryWorkInvolvement as VoluntaryWorkInvolvement;
use App\Http\Models\LearningDevelopmentInterventions as LearningDevelopmentInterventions;
use App\Http\Models\OtherInformation as OtherInformation;
use App\Http\Models\SurveyPage as SurveyPage;
use DB;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\ProgressBar as ProgressBar;
use App\Http\Models\AdminRequest as AdminRequest;


class PDSController extends Controller
{
    public function index($uid){

    	$secure = AdminRequest::secure_page($uid);
    	if(!$secure){
    		 return redirect()->back();
    	}

    	$color = Accounts::theme_color();

    	$countries = PersonalInformation::countries();
    	$personal_information_id = PersonalInformation::find_data(decrypt($uid));
    	$personal_information = PersonalInformation::generate_blank_data();
    	if($personal_information_id){
    		$personal_information = PersonalInformation::get_data($personal_information_id);
    	}
    

    	$family_background_id = FamilyBackground::find_data(decrypt($uid));
    	$family_background = FamilyBackground::generate_blank_data();
    	if($family_background_id){
    		$family_background = FamilyBackground::get_data($family_background_id);
    	}

    	$Childrens_find = Childrens::find_data(decrypt($uid));
    	$childrens = Childrens::generate_blank_data();
    	if($Childrens_find){
    		$childrens = Childrens::get_data(decrypt($uid));
    	}

    	$educational_background_id = EducationalBackground::find_data(decrypt($uid));
    	$educational_background = EducationalBackground::generate_blank_data();
    	if($educational_background_id){
    		$educational_background = EducationalBackground::get_data($educational_background_id);
    	}


    	$civil_service_eligibility_find = CivilServiceEligibility::find_data(decrypt($uid));
    	$civil_service_eligibility = CivilServiceEligibility::generate_blank_data();
    	if($civil_service_eligibility_find){
    		$civil_service_eligibility = CivilServiceEligibility::get_data(decrypt($uid));
    	}

    	$work_experience_find = WorkExperience::find_data(decrypt($uid));
    	$work_experience = WorkExperience::generate_blank_data();
    	if($work_experience_find){
    		$work_experience = WorkExperience::get_data(decrypt($uid));
    	}

    	$voluntart_work_involvement_find = VoluntaryWorkInvolvement::find_data(decrypt($uid));
    	$voluntart_work_involvement = VoluntaryWorkInvolvement::generate_blank_data();
    	if($voluntart_work_involvement_find){
    		$voluntart_work_involvement = VoluntaryWorkInvolvement::get_data(decrypt($uid));
    	}


    	$learning_development_interventions_find = LearningDevelopmentInterventions::find_data(decrypt($uid));
    	$learning_development_interventions = LearningDevelopmentInterventions::generate_blank_data();
    	if($learning_development_interventions_find){
    		$learning_development_interventions = LearningDevelopmentInterventions::get_data(decrypt($uid));
    	}


    	$other_inforamtion_find = OtherInformation::find_data(decrypt($uid));
    	$other_inforamtion = OtherInformation::generate_blank_data();
    	if($other_inforamtion_find){
    		$other_inforamtion = OtherInformation::get_data(decrypt($uid));
    	}

		// echo "<pre>";
		// print_r($work_experience);exit;



    	$survey = SurveyPage::get_data(decrypt($uid));

    	$name = PersonalInformation::get_name(decrypt($uid));
    	SystemLogs::saveLogs('visited '.$name.' personal data sheet page!');

    	return view('personal-data-sheet-form',[
    		'uid' => $uid,
    		'countries' => $countries, 
    		'personal_information' =>$personal_information,
    		'family_background' => $family_background,
    		'educational_background' => $educational_background, 
    		'childrens' => $childrens,
    		'civil_service_eligibility' => $civil_service_eligibility,
    		'work_experience' => $work_experience,
    		'voluntart_work_involvement' => $voluntart_work_involvement,
    		'learning_development_interventions' => $learning_development_interventions,
    		'other_inforamtion' => $other_inforamtion,
    		'survey' => $survey,
    		'color' => $color
    	]);
    	
    }

    public function store_personal_information(Request $request){;


    	$uid = decrypt($request->uid);
    	$name = Accounts::get_name($uid);
    	$rules = [
			'surname' => 'required|max:255',
			'first_name' => 'required|max:255',
			'middle_name' => 'required|max:255',
			'date_of_birth' => 'required|date_format:m/d/Y|before:tomorrow',
			'place_of_birth' => 'required|max:255',
			'sex' => 'required',
			'civil_status' => 'required',
			'height' => 'required|numeric',
			'weight' => 'required|numeric',
			'blood_type' => 'required',
			'citizenship' => 'required',
			'p_address_city_municipality' => 'required|max:255',
			'p_address_province' => 'required|max:255',
			'p_address_zipcode' => 'required|max:255',
			'p_address_house_block_lot_number' => 'max:255',
			'p_address_street' => 'max:255',
			'p_address_subdivision_village' => 'max:255',
			'p_address_barangay' => 'max:255',
			'r_address_city_municipality' => 'required|max:255',
			'r_address_province' => 'required|max:255',
			'r_address_zipcode' => 'required|max:255',
			'r_address_house_block_lot_number' => 'max:255',
			'r_address_street' => 'max:255',
			'r_address_subdivision_village' => 'max:255',
			'r_address_barangay' => 'max:255',
			'weight' => 'max:3',
			'height' => 'max:4',
			'blood_type' => 'max:2'

		];	

		if($request->email_address){
			$rules['email_address'] = 'nullable|email';
		}
		if($request->mobile_number){
			$rules['mobile_number'] = 'nullable|numeric';
		}


		$customize = [
            	 'pagibig_id_number.required' => 'The pag-ibig id number field is required.',
            	 'r_address_house_block_lot_number.required' => 'The house/lot/block field is required.',
            	 'p_address_house_block_lot_number.required' => 'The house/lot/block field is required.',
            	 'r_address_subdivision_village.required' => 'The subdivision/village field is required.',
            	 'p_address_subdivision_village.required' => 'The subdivision/village field is required.',
            	 'r_address_street.required' => 'The street field is required.',
            	 'p_address_street.required' => 'The street field is required.',
            	 'r_address_barangay.required' => 'The barangay field is required.',
            	 'p_address_barangay.required' => 'The barangay field is required.',
            	 'r_address_city_municipality.required' => 'The city/municipality field is required.',
            	 'p_address_city_municipality.required' => 'The city/municipality field is required.',
            	 'r_address_province.required' => 'The province field is required.',
            	 'p_address_province.required' => 'The province field is required.',
            	 'sex.required' => 'The gender field is required.',
            	 'date_of_birth.date_format' => 'The date format must be (mm/dd/yyyy)',
            	 'date_of_birth.before' => 'The date must be a date before tomorrow.',
            	 'p_address_zipcode.required' => 'The zip code field is required.',
            	 'r_address_zipcode.required' => 'The zip code field is required.',
            ];

			

    	  $validation = Validator::make($request->all(),$rules,$customize);


      if($validation->passes())

        {



	       $find = PersonalInformation::find_data($uid);


	       if($find){
	       		$save = PersonalInformation::find($find);
	       		$msg_action = "updated!";
	       		$action  = 0;
	       }else{
	       		$save = New PersonalInformation;
	       		$msg_action = "saved!";
	       		$action  = 1;
	       }


		    // $save->employee_id = $request->employee_id;
	        $save->user_id = $uid;
			$save->surname = $request->surname;
			$save->first_name = $request->first_name;
			$save->name_extension = $request->name_extension;
			$save->middle_name = $request->middle_name;
			$save->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
			$save->place_of_birth = $request->place_of_birth;
			$save->sex = $request->sex;
			$save->civil_status = $request->civil_status;
			$save->height = $request->height;
			$save->weight = $request->weight;
			$save->blood_type = $request->blood_type;
			$save->gsis_id_number = $request->gsis_id_number;
			$save->pagibig_id_number = $request->pagibig_id_number;
			$save->philhealth_number = $request->philhealth_number;
			$save->sss_number = $request->sss_number;
			$save->tin_number = $request->tin_number;
			$save->agency_employee_number = $request->agency_employee_number;
			$save->citizenship = $request->citizenship;
			$save->country = $request->country;
			$save->r_address_house_block_lot_number = $request->r_address_house_block_lot_number;
			$save->r_address_street = $request->r_address_street;
			$save->r_address_subdivision_village = $request->r_address_subdivision_village;
			$save->r_address_barangay = $request->r_address_barangay;
			$save->r_address_city_municipality = $request->r_address_city_municipality;
			$save->r_address_province = $request->r_address_province;
			$save->r_address_zipcode = $request->r_address_zipcode;
			$save->p_address_house_block_lot_number = $request->p_address_house_block_lot_number;
			$save->p_address_street = $request->p_address_street;
			$save->p_address_subdivision_village = $request->p_address_subdivision_village;
			$save->p_address_barangay = $request->p_address_barangay;
			$save->p_address_city_municipality = $request->p_address_city_municipality;
			$save->p_address_province = $request->p_address_province;
			$save->p_address_zipcode = $request->p_address_zipcode;
			$save->telephone_number = $request->telephone_number;
			$save->mobile_number = $request->mobile_number;
			$save->email_address = $request->email_address;
			if(isset($request->duplicate_address)){
        		$save->duplicate_address = $request->duplicate_address;
			}else{
				$save->duplicate_address = 0;
			}

            
             if($save->save()) {

				ProgressBar::personal_information($request->all(),'personal_information',$uid);

             	SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' personal information!'); 
             	 
             	DB::table('users')->where('id',$uid)->update(
             	[
             		'name' => PersonalInformation::get_name($uid),
             		'birthday' => date('Y-m-d', strtotime($request->date_of_birth)),
             		'gender' => $request->sex
             	]);


             	$msg = $name.' personal information has been successfully '.$msg_action;
                  // $request->session()->flash('msg', $msg);
                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }

    public function store_family_background(Request $request){

    		// echo '<pre>';
    		// print_r($request->all());exit;

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	    	$rules = [
					'fathers_surname' => 'required|max:255',
					'fathers_first_name' => 'required|max:255',
					'fathers_middle_name' => 'required|max:255',
					'mothers_maiden_name' => 'required|max:255',
					'mothers_surname' => 'required|max:255',
					'mothers_first_name' => 'required|max:255',
					'mothers_middle_name' => 'required|max:255',
					'date_of_birth.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
					'spouse_surname' => 'max:255',
					'spouse_first_name' => 'max:255',
					'spouse_middle_name' => 'max:255',
					'spouse_occupation' => 'max:255',
					'spouse_employer_business_name' => 'max:255',
					'spouse_business_address' => 'max:255',
    			];	


    			$customize = [

					'fathers_surname.required' => 'The surname field is required.',
					'fathers_first_name.required' => 'The first name field is required.',
					'fathers_middle_name.required' => 'The middle name field is required.',
					'mothers_maiden_name.required' => 'The maiden name field is required.',
					'mothers_surname.required' => 'The surname field is required.',
					'mothers_first_name.required' => 'The first name field is required.',
					'mothers_middle_name.required' => 'The middle name field is required.',
				    'date_of_birth.*.date_format' => 'The date format must be (mm/dd/yyyy)',
            	    'date_of_birth.*.before' => 'The date must be a date before tomorrow.'
    	            ];

    				

    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {


	    	        

	    	   
					     $find = FamilyBackground::find_data($uid);


					     if($find){
					     		$save = FamilyBackground::find($find);
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$save = New FamilyBackground;
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }

					        $save->user_id = $uid;
							$save->spouse_surname = $request->spouse_surname;
							$save->spouse_first_name = $request->spouse_first_name;
							$save->spouse_name_extension = $request->spouse_name_extension;
							$save->spouse_middle_name = $request->spouse_middle_name;
							$save->spouse_occupation = $request->spouse_occupation;
							$save->spouse_employer_business_name = $request->spouse_employer_business_name;
							$save->spouse_business_address = $request->spouse_business_address;
							$save->spouse_telephone_number = $request->spouse_telephone_number;
							$save->fathers_surname = $request->fathers_surname;
							$save->fathers_first_name = $request->fathers_first_name;
							$save->fathers_name_extension = $request->fathers_name_extension;
							$save->fathers_middle_name = $request->fathers_middle_name;
							$save->mothers_maiden_name = $request->mothers_maiden_name;
							$save->mothers_surname = $request->mothers_surname;
							$save->mothers_first_name = $request->mothers_first_name;
							$save->mothers_middle_name = $request->mothers_middle_name;


							Childrens::where('user_id',$uid)->delete();

							$cnt = count($request->fullname)-1;

							for ($count=0; $count <= $cnt; $count++) {
							    $child = New Childrens;
							    $child->user_id = $uid; 
								$child->fullname = $request->fullname[$count];
								if($request->date_of_birth[$count]){
									$child->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth[$count]));
								}

								$child->save();
							}


	    	        
	    	            
	    	             if($save->save()) {

							ProgressBar::family_background($request->all(),'family_background',$uid);
             				SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' family background!'); 

	    	             	$msg = $name.' family background has been successfully '.$msg_action;
	    	                  // $request->session()->flash('msg', $msg);
	    	                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
	    	             }
	    	        }

	    	     

    	        $errors = $validation->errors();
    	        $errors =  json_decode($errors); 
    	        
    	        return response()->json(['success' => false,'message' => $errors]);


    }


        public function store_educational_background(Request $request){

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	    	$rules = [
					'elem_name_of_school' => 'required|max:255',
					'elem_period_from' => 'required',//max:4
					'elem_period_to' => 'required',//max:4
					'elem_year_graduated' => 'required',//max:4
					'second_name_of_school' => 'required|max:255',
					'second_period_from' => 'required',//max:4
					'second_period_to' => 'required',//max:4
					'second_year_graduated' => 'required|max:4',//max:4

					'elem_basic_ed_degree_course' => 'max:255',
					'elem_highest_lvl_units_earned' => 'max:255',
					'second_basic_ed_degree_course' => 'max:255',
					'elem_highest_lvl_units_earned' => 'max:255',
					'second_scholarship_academic_honors' => 'max:255',

					'vocational_name_of_school' => 'max:255',
					'vocational_basic_ed_degree_course' => 'max:255',
					'vocational_period_from' => '',//max:4
					'vocational_period_to' => '',//max:4
					'vocational_highest_lvl_units_earned' => 'max:255',
					'vocational_year_graduated' => '',//max:4
					'vocational_scholarship_academic_honors' => 'max:255',

					'college_name_of_school' => 'max:255',
					'college_basic_ed_degree_course' => 'max:255',
					'college_period_from' => '',//max:4
					'college_period_to' => '',//max:4
					'college_highest_lvl_units_earned' => 'max:255',
					'college_year_graduated' => 'max:4',//max:4
					'college_scholarship_academic_honors' => 'max:255',

					'graduate_name_of_school' => 'max:255',
					'graduate_basic_ed_degree_course' => 'max:255',
					'graduate_period_from' => '',//max:4
					'graduate_period_to' => '',//max:4
					'graduate_highest_lvl_units_earned' => 'max:255',
					'graduate_year_graduated' => 'max:4',
					'graduate_scholarship_academic_honors' => 'max:255'



    			];	


    			$customize = [

					'elem_name_of_school.required' => 'The name of school field is required.',
					'elem_period_from.required' => 'The period (from) field is required.',
					'elem_period_to.required' => 'The period (to) field is required.',
					'elem_year_graduated.required' => 'The year graduated field is required.',
					'second_name_of_school.required' => 'The name of school field is required.',
					'second_period_from.required' => 'The period (from) field is required.',
					'second_period_to.required' => 'The period (to) field is required.',
					'second_year_graduated.required' => 'The year graduated field is required.',

    	            ];

    				

    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {

 		
	    	   
					     $find = EducationalBackground::find_data($uid);


					     if($find){
					     		$save = EducationalBackground::find($find);
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$save = New EducationalBackground;
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }

						  	
							$save->user_id = $uid;
							$save->elem_name_of_school = $request->elem_name_of_school;
							$save->elem_basic_ed_degree_course = $request->elem_basic_ed_degree_course;
							$save->elem_period_from = $request->elem_period_from;
							$save->elem_period_to = $request->elem_period_to;
							$save->elem_highest_lvl_units_earned = $request->elem_highest_lvl_units_earned;
							$save->elem_year_graduated = $request->elem_year_graduated;
							$save->elem_scholarship_academic_honors = $request->elem_scholarship_academic_honors;
							$save->second_name_of_school = $request->second_name_of_school;
							$save->second_basic_ed_degree_course = $request->second_basic_ed_degree_course;
							$save->second_period_from = $request->second_period_from;
							$save->second_period_to = $request->second_period_to;
							$save->second_highest_lvl_units_earned = $request->second_highest_lvl_units_earned;
							$save->second_year_graduated = $request->second_year_graduated;
							$save->second_scholarship_academic_honors = $request->second_scholarship_academic_honors;
							$save->vocational_name_of_school = $request->vocational_name_of_school;
							$save->vocational_basic_ed_degree_course = $request->vocational_basic_ed_degree_course;
							$save->vocational_period_from = $request->vocational_period_from;
							$save->vocational_period_to = $request->vocational_period_to;
							$save->vocational_highest_lvl_units_earned = $request->vocational_highest_lvl_units_earned;
							$save->vocational_year_graduated = $request->vocational_year_graduated;
							$save->vocational_scholarship_academic_honors = $request->vocational_scholarship_academic_honors;
							$save->college_name_of_school = $request->college_name_of_school;
							$save->college_basic_ed_degree_course = $request->college_basic_ed_degree_course;
							$save->college_period_from = $request->college_period_from;
							$save->college_period_to = $request->college_period_to;
							$save->college_highest_lvl_units_earned = $request->college_highest_lvl_units_earned;
							$save->college_year_graduated = $request->college_year_graduated;
							$save->college_scholarship_academic_honors = $request->college_scholarship_academic_honors;
							$save->graduate_name_of_school = $request->graduate_name_of_school;
							$save->graduate_basic_ed_degree_course = $request->graduate_basic_ed_degree_course;
							$save->graduate_period_from = $request->graduate_period_from;
							$save->graduate_period_to = $request->graduate_period_to;
							$save->graduate_highest_lvl_units_earned = $request->graduate_highest_lvl_units_earned;
							$save->graduate_year_graduated = $request->graduate_year_graduated;
							$save->graduate_scholarship_academic_honors = $request->graduate_scholarship_academic_honors;

		    
		             if($save->save()) {

		             	   ProgressBar::educational_background($request->all(),'educational_background',$uid);
             				SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' educational background!'); 

		             	$msg = $name.' educational background has been successfully '.$msg_action;
		                  // $request->session()->flash('msg', $msg);
		                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
		             }
		        }

		     

		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);


    }


       public function store_civil_service_eligibility(Request $request){

        	
 

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	      
    	        $rules = [
    	        	'cs_board_bar_ces_csee_barangay_drivers.*' => 'required|max:255',
    	        	//'date_of_exam_conferment.*' => 'date_format:m/d/Y|before:tomorrow',
    	        	'place_of_exam_conferment.*' => 'max:255',
    	        	'license_date_of_validity.*' => 'nullable|date_format:m/d/Y',
    	        	'license_number.*' => 'nullable|max:255',
    	        	'rating.*' => 'max:255'

    	        ];
    	        
    	        $customize = [
    	        	'cs_board_bar_ces_csee_barangay_drivers.*.required' => 'The name of eligibility field is required.',
    	        	'date_of_exam_conferment.*required' => 'The date of examamination/conferment field is required.',
    	        	'date_of_exam_conferment.*.before' => 'The date of examamination/conferment must be a date before tomorrow.',
    	        	'date_of_exam_conferment.*date_format' => 'The date of examamination/conferment does not match the format m/d/Y.',
    	        	'license_date_of_validity.*.date_format' =>   'The license date of validity does not match the format m/d/Y.',
    	        	// 'license_date_of_validity.*.before' => 'The license date of validity must be a date before tomorrow.',
    	        	// 'license_number.*.numeric' => 'The license number must be number',
    	        	'place_of_exam_conferment.*.required' => 'The place of examination conferment field is required.',

    	        ];

    	     
	  

    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {


					     $find = CivilServiceEligibility::find_data($uid);


					     if($find){
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }


						CivilServiceEligibility::where('user_id',$uid)->delete();


						  $cnt = count($request->cs_board_bar_ces_csee_barangay_drivers)-1;


						

						for ($count=0; $count <= $cnt; $count++) {
							
						    $save = New CivilServiceEligibility;
						    $save->user_id = $uid; 

						 	 $save->cs_board_bar_ces_csee_barangay_drivers = $request->cs_board_bar_ces_csee_barangay_drivers[$count];
						 	 $save->rating = $request->rating[$count];
						 	 if($request->date_of_exam_conferment[$count]){
						 	 	$save->date_of_exam_conferment = date('Y-m-d', strtotime($request->date_of_exam_conferment[$count]));
						 	 }
						 	 $request->place_of_exam_conferment[$count];
						 	 $save->place_of_exam_conferment = $request->place_of_exam_conferment[$count];
						 	 $save->license_number = $request->license_number[$count];
						 	 if($request->license_date_of_validity[$count]){
						 	 	$save->license_date_of_validity = date('Y-m-d', strtotime($request->license_date_of_validity[$count]));
						 	 }

						  	$save->save();
					    }
					  

	    	             if($save->save()) {

	    	             	 ProgressBar::civil_service_eligibility($request->all(),'civil_service_eligibility',$uid);
             				 SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' civil service eligibility!'); 

	    	             	$msg = $name.' civil service eligibility has been successfully '.$msg_action;
	    	                  // $request->session()->flash('msg', $msg);
	    	                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
	    	             }
		         }

		     

		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);


    }




    public function store_work_experience(Request $request){

    		// echo "<pre>";
    		// print_r($request->tag_work);exit;

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	      
    	        $rules = [
    	        		'dept_agency_office_company.*' => 'required',
    	        		'position_title.*' => 'required|max:255',
    	        		'name_of_office_unit.*' => 'max:255',
    	        		'immediate_supervisor.*' => 'max:255',
						'inclusive_date_from.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
						// 'inclusive_date_to.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
						'monthly_salary.*' => 'nullable|regex:/^[\d.,]+$/|max:255',
						'dept_agency_office_company.*' => 'max:255',
						'paygrade.*' => 'max:255',
						'status_of_appointment.*' => 'required|max:255',
						'govt_service.*' => 'required|max:1',


    	        ];
    	        
    	        $customize = [
    	        	'inclusive_date_from.*.date_format' =>   'The date from does not match the format m/d/Y.',
    	        	'inclusive_date_from.*.before' => 'The date must be a date before tomorrow.',
    	        	// 'inclusive_date_to.*.date_format' =>   'The date to does not match the format m/d/Y.',
    	        	'monthly_salary.*' => 'The salary is invalid money format',
    	        	'dept_agency_office_company.*' => 'The department/agency/office/company field is required.',
    	        	'position_title.*' => 'The position title field is required.',
    	        	'govt_service.*.required' => 'The goverment service field is required.',
    	        	'status_of_appointment.*.required' => 'The status of appointment field is required.',

    	        ];

    	     
	  

    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {


					     $find = WorkExperience::find_data($uid);


					     if($find){
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }


						WorkExperience::where('user_id',$uid)->delete();


						$cnt = count($request->inclusive_date_from)-1;
			

						for ($count=0; $count <= $cnt; $count++) {
							
						    $save = New WorkExperience;
						    $save->user_id = $uid; 

						 	 if($request->inclusive_date_from[$count]){
						 	 	$save->inclusive_date_from = date('Y-m-d', strtotime($request->inclusive_date_from[$count]));
						 	 }
						 	 $save->inclusive_date_to = $request->inclusive_date_to[$count];
						 	 $save->position_title = $request->position_title[$count];
						 	 $save->dept_agency_office_company = $request->dept_agency_office_company[$count];
						 	 $save->name_of_office_unit = $request->name_of_office_unit[$count];
						 	 $save->immediate_supervisor = $request->immediate_supervisor[$count];
						 	 if($request->monthly_salary[$count]){
						 	 	$save->monthly_salary = str_replace( ',', '', $request->monthly_salary[$count]);
						 	 }
						 	 $save->paygrade = $request->paygrade[$count];
							 $save->status_of_appointment = $request->status_of_appointment[$count];					 	
							 if($request->service_record_salary[$count]){
							 	$save->service_record_salary = str_replace( ',', '', $request->service_record_salary[$count]);
							 }
							 $save->agency_type = $request->agency_type[$count];
							 $save->pay = $request->pay[$count];
							 $save->cause = $request->cause[$count];
							 $save->govt_service = $request->govt_service[$count];
							 $save->summary_of_duties = $request->summary_of_duties[$count];
							 $save->office_address = $request->office_address[$count];

							 if(isset($request->tag_work[$count])){
							 	$save->tag_work = $request->tag_work[$count];
							 }

						  	$save->save();
					    }

	    	            if($save->save()) {
								    	             	
							ProgressBar::work_experience($request->all(),'work_experience',$uid);
							SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' work experience!'); 

	    	             	$msg = $name.' work experience has been successfully '.$msg_action;
	    	                  // $request->session()->flash('msg', $msg);
	    	                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
	    	            }
		         }

		     

		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);


    }

      public function store_voluntary_work_involvement(Request $request){

        		// echo '<pre>';
        		// print_r($request->all());exit;

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	      
    	        $rules = [
    	        		'name_address_of_org.*' => 'required|max:255',
						'inclusive_date_from.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
						'inclusive_date_to.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
						'number_of_hours.*' => 'nullable|numeric',
						'position_work' => 'max:255',
    	        ];
    	        
    	        $customize = [
    	        	'inclusive_date_from.*.date_format' =>   'The date from does not match the format m/d/Y.',
    	        	'inclusive_date_to.*.date_format' =>   'The date to does not match the format m/d/Y.',
    	        	'number_of_hours.*.numeric' => 'The number of hour/s must be number.',
    	        	'inclusive_date_from.*.before' => 'The date must be a date before tomorrow.',
    	        	'inclusive_date_to.*.before' => 'The date must be a date before tomorrow.',
    	        	'name_address_of_org.*' => 'The name & address of organization field is required.',

    	        ];

    	     
	  

    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {


					     $find = VoluntaryWorkInvolvement::find_data($uid);


					     if($find){
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }


						VoluntaryWorkInvolvement::where('user_id',$uid)->delete();


						$cnt = count($request->inclusive_date_from)-1;
			

						for ($count=0; $count <= $cnt; $count++) {
							
						    $save = New VoluntaryWorkInvolvement;
						    $save->user_id = $uid; 
						    $save->name_address_of_org = $request->name_address_of_org[$count];
						 	 if($request->inclusive_date_from[$count]){
						 	 	$save->inclusive_date_from = date('Y-m-d', strtotime($request->inclusive_date_from[$count]));
						 	 }
						 	 if($request->inclusive_date_to[$count]){
						 	 	$save->inclusive_date_to = date('Y-m-d', strtotime($request->inclusive_date_to[$count]));
						 	 }
						 
						 	 $save->number_of_hours = $request->number_of_hours[$count];
						 	 $save->position_work = $request->position_work[$count];
						  	 $save->save();
					    }
					  

	    	             if($save->save()) {

							ProgressBar::voluntary_works($request->all(),'voluntary_work',$uid);
							SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' voluntary work involvement!'); 
	    	             	$msg = $name.' voluntary work involvement has been successfully '.$msg_action;
	    	                  // $request->session()->flash('msg', $msg);
	    	                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
	    	             }
		         }

		     

		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);


    }


          public function store_learning_development_intervention(Request $request){

        		// echo '<pre>';
        		// print_r($request->all());exit;

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	      
    	        $rules = [
    	        		'title_of_learning.*' => 'required',
						'inclusive_date_from.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
						'inclusive_date_to.*' => 'nullable|date_format:m/d/Y|before:tomorrow',
						'number_of_hours.*' => 'nullable|numeric',
    	        ];
    	        
    	        $customize = [
    	        	'inclusive_date_from.*.date_format' =>   'The date from does not match the format m/d/Y.',
    	        	'inclusive_date_to.*.date_format' =>   'The date to does not match the format m/d/Y.',
    	        	'number_of_hours.*.numeric' => 'The number of hour/s must be number.',
    	        	'inclusive_date_from.*.before' => 'The date must be a date before tomorrow.',
    	        	'inclusive_date_to.*.before' => 'The date must be a date before tomorrow.',
    	        	'title_of_learning.*' => 'The title of learning and development interventions / training programs field is required.',

    	        ];

    	     
	  

    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {


					     $find = LearningDevelopmentInterventions::find_data($uid);


					     if($find){
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }


						LearningDevelopmentInterventions::where('user_id',$uid)->delete();


						$cnt = count($request->inclusive_date_from)-1;
			
						for ($count=0; $count <= $cnt; $count++) {
							
						    $save = New LearningDevelopmentInterventions;
						    $save->user_id = $uid; 
						    $save->title_of_learning = $request->title_of_learning[$count];
						 	 if($request->inclusive_date_from[$count]){
						 	 	$save->inclusive_date_from = date('Y-m-d', strtotime($request->inclusive_date_from[$count]));
						 	 }
						 	 if($request->inclusive_date_to[$count]){
						 	 	$save->inclusive_date_to = date('Y-m-d', strtotime($request->inclusive_date_to[$count]));
						 	 }
						 
						 	 $save->number_of_hours = $request->number_of_hours[$count];
						 	 $save->type_of_ld = $request->type_of_ld[$count];
						 	 $save->conducted_sponsored_by = $request->conducted_sponsored_by[$count];
						  	 $save->save();
					    }
					  

	    	             if($save->save()) {
	    	             	ProgressBar::learning_development($request->all(),'learning_and_development',$uid);
							SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).'  learning and development intervention / training programs !'); 
	    	             	$msg = $name.' learning and development intervention / training programs has been successfully '.$msg_action;
	    	                  // $request->session()->flash('msg', $msg);
	    	                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
	    	             }
		         }

		     

		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);


    }

      public function store_other_information(Request $request){

        		// echo '<pre>';
        		// print_r($request->all());exit;

    	    	$uid = decrypt($request->uid);
    	        $name = Accounts::get_name($uid);
    	      
    	        $rules = [
    	        		// 'special_skills_hobbies.*' => 'required',
					
    	        ];
    	        
    	        $customize = [
    	 
    	        	// 'special_skills_hobbies.*.required' => 'The special skills hobbies field is required.',

    	        ];

    	    
    	    	  $validation = Validator::make($request->all(),$rules,$customize);


	    	      if($validation->passes())

	    	        {


					     $find = OtherInformation::find_data($uid);


					     if($find){
					     		$msg_action = "updated!";
					     		$action  = 0;
					     }else{
					     		$msg_action = "saved!";
					     		$action  = 1;
					     }


						OtherInformation::where('user_id',$uid)->delete();

						$cnt = count($request->special_skills_hobbies)-1;
			
						for ($count=0; $count <= $cnt; $count++) {
							
						     $save = New OtherInformation;
						     $save->user_id = $uid; 
						 	 $save->special_skills_hobbies = strtoupper($request->special_skills_hobbies[$count]);
						 	 $save->none_academic_distinctions = $request->none_academic_distinctions[$count];
						 	 $save->membership_in_assoc_org = $request->membership_in_assoc_org[$count];
						  	 $save->save();
					    }
					  

	    	             if($save->save()) {
								ProgressBar::other_information($request->all(),'other_information',$uid);
								SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' other information/s!'); 

	    	             	$msg = $name.' other information/s has been successfully '.$msg_action;
	    	                  // $request->session()->flash('msg', $msg);
	    	                  return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
	    	             }
		         }

		     

		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);


    }


   public function store_survey(Request $request){


 	    $rules = [
        		'references_name_one' => 'required',
        		'references_address_one' => 'required',
        		'references_telephone_one' => 'required',
				// 'references_name_two' => 'required',
				// 'references_address_two' => 'required',
				// 'references_telephone_two' => 'required',
				// 'references_name_three' => 'required',
				// 'references_address_three' => 'required',
				// 'references_telephone_three' => 'required',
				'government_issued_id' => 'required',
				'id_license_passport_number' => 'required',
				'date_place_of_issuance' => 'required',
				// 'co_government_issued_id' => 'required',
				// 'co_id_license_passport_number' => 'required',
				// 'co_date_place_of_issuance' => 'required',

        ];
        
        $customize = [
	 
	        'references_name_one.required' => 'The name field is required.',
	        'references_address_one.required' => 'The address field is required.',
	        'references_telephone_one.required' => 'The phone field is required.',
	        'references_name_two.required' => 'The name field is required.',
	        'references_address_two.required' => 'The address field is required.',
	        'references_telephone_two.required' => 'The phone field is required.',
	        'references_name_three.required' => 'The name field is required.',
	        'references_address_three.required' => 'The address field is required.',
	        'references_telephone_three.required' => 'The phone field is required.',
	        // 'co_government_issued_id.required' => 'The goverment issued id field is required.',
	        // 'co_id_license_passport_number.required' => 'The id/license/passport no. field is required.',
	        // 'co_date_place_of_issuance.required' => 'The date/place of issuance field is required.',

        ];

     


    	  $validation = Validator::make($request->all(),$rules,$customize);


	      if($validation->passes())

	        {



				$uid = decrypt($request->uid);
				$name = Accounts::get_name($uid);



				$find = SurveyPage::find_data($uid);


				$data1 = [
				 	'user_id' => $uid, 
					'thirty_four_a' => $request->thirty_four_a, 
					'thirty_four_b' => $request->thirty_four_b, 
					'thirty_four_a_b_if_yes' => $request->thirty_four_a_b_if_yes, 
					'thirty_five_a' => $request->thirty_five_a, 
					'thirty_five_a_if_yes' => $request->thirty_five_a_if_yes, 
					'thirty_five_b' => $request->thirty_five_b, 
					'thirty_five_b_if_yes_date' => $request->thirty_five_b_if_yes_date, 
					'thirty_five_b_if_yes_case' => $request->thirty_five_b_if_yes_case, 
					'thirty_six' => $request->thirty_six, 
					'thirty_six_if_yes' => $request->thirty_six_if_yes, 
					'thirty_seven' => $request->thirty_seven, 
					'thirty_seven_if_yes' => $request->thirty_seven_if_yes, 
					'thirty_eight_a' => $request->thirty_eight_a, 
					'thirty_eight_a_if_yes' => $request->thirty_eight_a_if_yes, 
					'thirty_eight_b' => $request->thirty_eight_b, 
					'thirty_eight_b_if_yes' => $request->thirty_eight_b_if_yes, 
					'thirty_nine' => $request->thirty_nine, 
					'thirty_nine_if_yes' => $request->thirty_nine_if_yes, 
					'fourty_a' => $request->fourty_a, 
					'fourty_a_if_yes' => $request->fourty_a_if_yes, 
					'fourty_b' => $request->fourty_b, 
					'fourty_b_if_yes' => $request->fourty_b_if_yes, 
					'fourty_c' => $request->fourty_c, 
					'fourty_c_if_yes' => $request->fourty_c_if_yes, 
				];

				$data2 = [
					'user_id' => $uid, 
					'references_name_one' => $request->references_name_one,
					'references_address_one' => $request->references_address_one,
					'references_telephone_one' => $request->references_telephone_one,
					'references_name_two' => $request->references_name_two,
					'references_address_two' => $request->references_address_two,
					'references_telephone_two' => $request->references_telephone_two,
					'references_name_three' => $request->references_name_three,
					'references_address_three' => $request->references_address_three,
					'references_telephone_three' => $request->references_telephone_three,
					'government_issued_id' => $request->government_issued_id,
					'id_license_passport_number' => $request->id_license_passport_number,
					'date_place_of_issuance' => $request->date_place_of_issuance,
					'co_government_issued_id' => $request->co_government_issued_id,
					'co_id_license_passport_number' => $request->co_id_license_passport_number,
					'co_date_place_of_issuance' => $request->co_date_place_of_issuance,
				];


				if($find){
						DB::table('pds_page_four')->where('user_id',$uid)->update($data1);
						DB::table('pds_page_four_two')->where('user_id',$uid)->update($data2);
						$msg_action = "updated!";
						$action  = 0;
				}else{

					    DB::table('pds_page_four')->insert($data1);
						DB::table('pds_page_four_two')->insert($data2);
						$msg_action = "saved!";
						$action  = 1;
				}


				ProgressBar::survey($request->all(),'survey',$uid);
				SystemLogs::saveLogs('has successfully '.str_replace('!','',$msg_action).' survey!'); 


					$msg = $name.' survey has been successfully '.$msg_action;
				 return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);


			}


		        $errors = $validation->errors();
		        $errors =  json_decode($errors); 
		        
		        return response()->json(['success' => false,'message' => $errors]);

    }
}