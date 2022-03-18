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
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\AdminRequest as AdminRequest;
use App\Http\Models\EmailNotification as EmailNotification;
use App\Http\Models\Notifications as Notifications;
use App\Http\Models\Messages as Messages;
use DB;
use PDF;
use Auth;

class PDSTableController extends Controller
{


    public function index(){    

    	$users = Accounts::employees_table();
        $color = Accounts::theme_color();
        
        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }


        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            
            $user_id = $data[$cnt]->id;

            $data[$cnt]->view = url('personal-data-sheet/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
            $data[$cnt]->view_title_request = 'Send Request';
            $data[$cnt]->view_status = 'Denied';
            $data[$cnt]->view_coe_status = 'Denied';
            $data[$cnt]->download = url('personal-data-sheet/download/'.encrypt($data[$cnt]->id));
            $data[$cnt]->download_title = 'Download';
            $data[$cnt]->certification = url('reports/service-record/work-exp/'.encrypt($data[$cnt]->id));
        }

        $s = count($users) > 1 ? "s" : "";
        SystemLogs::saveLogs('visited employees personal data information'.$s.' page!');

        return view('pds-table-page',['users' => $users, 'color' => $color]);
    }

    public function send_request(Request $request){
        $user_id = decrypt($request->user_id);
        $class = ".u-".$user_id;
        self::send_request_function($user_id);
        $message = "Your request has been successfully sent!";
        return response()->json(['success' => true,'message' => $message,'class' => $class]);

    }

    public function send_request_to_all(){

        $find = DB::table("admin_request")->select("user_id")->where("pds",0)->get();

        $cnt = 0;
        if($find){
            foreach ($find as $key => $value) {
                $user = User::find($value->user_id);
                if($user->role != "admin"){
                    if($user->flag == 1){
                        if($user->status == 1){
                            $cnt++;
                        }
                    }
                }

            }
        }


         if($cnt >= 1){


            $users = Accounts::users_id();
            foreach ($users as $key => $value) {
                $user_id = $value->id;
                $class = ".all-users";
                self::send_request_function($user_id);
            }
            
            $message = "Your request has been successfully sent to all employees!";
            return response()->json(['success' => true,'message' => $message,'class' => $class,'page' => url('personal-data-sheet-table/employees-table')]);

        }else{

             $message = "You've already sent requests to all employees!";
             return response()->json(['success' => false,'message' => $message]);
        }


    }


    public function send_request_to_selected_unit(Request $request){
      
        $selected = $request->selected;
        $arrId = [];
        $class = "";
        foreach ($selected as $key => $value) {
            $user = User::select("id")->where("division",$value)->get();
                foreach ($user as $key => $value) {
                    $arrId[] = $value->id;
                    self::send_request_function($value->id);
                }
            
        }

        $message = "Your request has been successfully sent to all selected units!";
            return response()->json(['success' => true,'message' => $message,'class' => $class,'page' => url('personal-data-sheet-table/employees-table')]);

    }


    public static function send_request_function($user_id){
        $admin_id = Auth::id();
        AdminRequest::send_request($user_id);
        $full_name = PersonalInformation::get_name($user_id);
        SystemLogs::saveLogs('send request to view (PDS) of '.$full_name);
        $subject = "Request View (PDS)";
        $from_email = Auth::user()->email;
        $from_name = Auth::user()->name;
        $find = User::find($user_id);
        $to_email = $find->email;
        $to_name = $find->name;

        $thread_id = Messages::admin_request_view_pdf($user_id,$admin_id); 

        $body = "Hello ".$full_name.", we are requesting to view your Personal Data Sheet. <br> Please <font color='red'><a href='".url("personal-data-sheet-table/view/confirm")."/".encrypt($thread_id)."'>Confirm</a></font></a>";

        Notifications::insertMessage($user_id,$body);
        EmailNotification::create_email_notifcation($subject,$body,$from_email,$from_name,$to_email,$to_name);
    }



    public function pds_view_request_confirmation(Request $request,$thread_id){

      $find = DB::table("admin_request")->select("pds")->where("user_id",Auth::id())->first();

      if($find->pds == 1){
        return view('request-confirmation',['thread_id' => $thread_id]);
      }else{

        $msg = 'Your not allowed to access this content!';
        $request->session()->flash('msg',$msg);
        return redirect()->back();
      }


    }

    public function pds_request_confirmation(Request $request){



        $response = $request->response;
        $thread_id = $request->thread_id;

        $msg = "You have successfully ".$response."d the request!";
        $user_id = Auth::id();

        
        if($response == 'approve'){

            $response = 2;
         

        }else{

           
            $response = 0;
           

        }

            self::request_reply($user_id,$response,$thread_id);
            $request->session()->flash('msg',$msg);
            return redirect('messages/inbox');

    }


    
    public static function request_reply($user_id,$response,$thread_id){

        if($response == 2){
           $ress_word = 'approved';
           ////DB::table('admin_request')->where('user_id', $user_id)->update(['pds' => 2]);
        } else{
           $ress_word = 'disapproved';
          //// DB::table('admin_request')->where('user_id', $user_id)->update(['pds' => 0]);
        }

        AdminRequest::request_reply($user_id,$response);

        $full_name = PersonalInformation::get_name($user_id);

        $thread_id = decrypt($thread_id);


        SystemLogs::saveLogs($ress_word.' request of Human Resource Unit / Administrator.');
        $subject = "Request View (PDS)";
        
        if($response == 2){
        $body = $full_name.' '.$ress_word.' your request <a href="'.url("personal-data-sheet/".encrypt($user_id)).'"> (Personal Information Sheet)</a>.';
        }else{
            $body = $full_name." ".$ress_word." your request (Personal Information Sheet).";
        }

        $find = DB::table("messenger_threads")->select("owner")->where("id",$thread_id)->first(); 

        $admin_id =  $find->owner;

        $admin = User::select('id','email','name')->where("id",$admin_id)->first();

        $from_email = Auth::user()->email;
        $from_name = Auth::user()->name;
        $find = User::find($admin_id);
        $to_email = $admin->email;
        $to_name = $admin->name;

        EmailNotification::create_email_notifcation($subject,$body,$from_email,$from_name,$to_email,$to_name);


        Messages::user_response($admin_id,$user_id,$thread_id,$body); 

        Notifications::insertMessage($admin_id, $body);



          

    }



    public function download_pds($uid){

        
        $secure = AdminRequest::secure_page($uid);
        if(!$secure){
             return redirect()->back();
        }
    
        $pds_name = 'pds';
        $uid = decrypt($uid);

    	$personal_information_id = PersonalInformation::find_data($uid);
    	$personal_information = PersonalInformation::pdf_generate_blank_data();
    	if($personal_information_id){
    		$personal_information = PersonalInformation::get_data($personal_information_id);
            $pds_name = ucwords(strtolower($personal_information->surname.', '.$personal_information->first_name));
    	}

    	
    	$family_background_id = FamilyBackground::find_data($uid);
    	$family_background = FamilyBackground::pdf_generate_blank_data();
    	if($family_background_id){
    		$family_background = FamilyBackground::get_data($family_background_id);
    	}


        $Childrens_find = Childrens::find_data($uid);
        
        if($Childrens_find){
            $childrens = Childrens::get_data($uid);
            $childrens = Childrens::pdf_generate(11,$uid);
        }else{

            $childrens = Childrens::pdf_generate_blank_data(11);
        }



    	$educational_background_id = EducationalBackground::find_data($uid);
    	$educational_background = EducationalBackground::pdf_generate_blank_data();
    	if($educational_background_id){
    		$educational_background = EducationalBackground::get_data($educational_background_id);
    	}




    	$civil_service_eligibility_find = CivilServiceEligibility::find_data($uid);
    	
    	if($civil_service_eligibility_find){
    		$civil_service_eligibility = CivilServiceEligibility::get_data($uid);
    		$civil_service_eligibility = CivilServiceEligibility::pdf_generate(6,$uid);
    	}else{

    		$civil_service_eligibility = CivilServiceEligibility::pdf_generate_blank_data(6);
    	}


        $work_experience_reach_limit = 0;
    	$work_experience_find = WorkExperience::find_data($uid);
    	
    	if($work_experience_find){
    		$work_experience = WorkExperience::get_data($uid);
    		
            if(count($work_experience) >= 27){
                 $work_experience_reach_limit = 1;
                 $work_experience = WorkExperience::pdf_generate_reach_limit(54,$uid);
                 //$work_experience = WorkExperience::pdf_generate(27,$uid);
            }else{
                
                $work_experience = WorkExperience::pdf_generate(27,$uid);
            }

    	}else{

    		$work_experience = WorkExperience::pdf_generate_blank_data(27);
    	}
 


    	$voluntary_work_involvement_find = VoluntaryWorkInvolvement::find_data($uid);
    	
    	if($voluntary_work_involvement_find){
    		$voluntary_work_involvement = VoluntaryWorkInvolvement::get_data($uid);
    		$voluntary_work_involvement = VoluntaryWorkInvolvement::pdf_generate(6,$uid);
    	}else{

    		$voluntary_work_involvement = VoluntaryWorkInvolvement::pdf_generate_blank_data(6);
    	}



    	$learning_development_interventions_find = LearningDevelopmentInterventions::find_data($uid);
    	
    	if($learning_development_interventions_find){
    		$learning_development_interventions = LearningDevelopmentInterventions::get_data($uid);
    		$learning_development_interventions = LearningDevelopmentInterventions::pdf_generate(20,$uid);
    	}else{

    		$learning_development_interventions = LearningDevelopmentInterventions::pdf_generate_blank_data(20);
    	}


    	$other_information_find = OtherInformation::find_data($uid);
    	$other_information = OtherInformation::pdf_generate_blank_data();
    	if($other_information_find){
    		$other_information = OtherInformation::get_data($uid);
    	}


    	$other_information_find = OtherInformation::find_data($uid);
    	
    	if($other_information_find){
    		$other_information = OtherInformation::get_data($uid);
    		$other_information = OtherInformation::pdf_generate(6,$uid);
    	}else{

    		$other_information = OtherInformation::pdf_generate_blank_data(6);
    	}

    	$survey = SurveyPage::get_data($uid);


   		// echo '<pre>';
	    // print_r($survey);exit;


    	$data = [
    		'uid' => $uid,
    		'personal_information' =>$personal_information,
    		'family_background' => $family_background,
            'childrens' => $childrens,
    		'educational_background' => $educational_background, 
    		'civil_service_eligibility' => $civil_service_eligibility,
    		'work_experience' => $work_experience,
            'work_experience_reach_limit' => $work_experience_reach_limit,
    		'voluntary_work_involvement' => $voluntary_work_involvement,
    		'learning_development_interventions' => $learning_development_interventions,
    		'other_information' => $other_information,
    		'survey' => $survey
    	];


    	// echo '<pre>';
    	// print_r($data);exit;

       // return view('pds',$data);
       // return $pdf->stream("pds.pdf", array("Attachment" => false));


        if($uid == Auth::user()->id){
            $gender = Accounts::find_gender( Auth::user()->gender);
             SystemLogs::saveLogs('downloaded '.$gender.' personal data sheet!'); 
        }else{
            $name =  PersonalInformation::get_name($uid);
            SystemLogs::saveLogs('downloaded personal data sheet of '.$name.'!'); 
        }

        
        $pdf = PDF::loadView('personal-data-sheet-download',$data)->setPaper('legal','portrait'); //->setPaper([0,0,612,936],'portrait');
        return $pdf->stream($pds_name.'.pdf');

    }
}
