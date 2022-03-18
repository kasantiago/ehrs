<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use Validator;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\FamilyBackground as FamilyBackground;
use App\Http\Models\Childrens as Childrens;
use App\Http\Models\AssetsRealProperties as AssetsRealProperties;
use App\Http\Models\AssetsPersonalProperties as AssetsPersonalProperties;
use App\Http\Models\AssetsLiabilities as AssetsLiabilities;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\AssetsBussIntFinCon as AssetsBussIntFinCon;
use App\Http\Models\AssetsRelativeGovernmentService as AssetsRelativeGovernmentService;
use App\Http\Models\ProgressBar as ProgressBar;
use App\Http\Models\SurveyPage as SurveyPage;
use App\Http\Models\AdminRequest as AdminRequest;
use App\Http\Models\Upload as Upload;
use Carbon\Carbon as Carbon;
use App\Http\Models\EmailNotification as EmailNotification;
use App\Http\Models\Notifications as Notifications;
use App\Http\Models\Messages as Messages;
use DB;
use PDF;
use Auth;

use App\Http\Models\WorkExperience as WorkExperience;

class SSALNWController extends Controller
{

    public function index(){

   		$full_name = PersonalInformation::get_name(1);
	
    	$users = Accounts::employees_table();
        $color = Accounts::theme_color();
        
        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
         
            $data[$cnt]->view = url('sworn-statement-assets-liabilities-net-worth/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
            $data[$cnt]->view_title_request = 'Send Request';
            $data[$cnt]->view_request_status = 'Active';
            $data[$cnt]->view_status = 'Denied';
            $data[$cnt]->view_coe_status = 'Denied';
            $data[$cnt]->download = url('sworn-statement-assets-liabilities-net-worth/download/'.encrypt($data[$cnt]->id));
            $data[$cnt]->download_title = 'Download';   
        }

        $s = count($users) > 1 ? "s" : "";
        SystemLogs::saveLogs('visited employees sworn statement of assets, liabilities and net worth'.$s.' page!');


        return view('ssalnw-table-page',['users' => $users, 'color' => $color]);
    }


    public function ssalnw($uid){

        $secure = AdminRequest::secure_page($uid);
        if(!$secure){
             return redirect()->back();
        }

    	$color = Accounts::theme_color();

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


        $Childrens_find = Childrens::under_18_find_data(decrypt($uid));
        $childrens = Childrens::generate_blank_data();
        if($Childrens_find){
            $childrens = Childrens::under_18_get_data(decrypt($uid));
        }
    
        $assets_real_properties_find = AssetsRealProperties::find_data(decrypt($uid));
        $assets_real_properties = AssetsRealProperties::generate_blank_data();
        if($assets_real_properties_find){
            $assets_real_properties = AssetsRealProperties::get_data(decrypt($uid));
        }

        $assets_personal_properties_find = AssetsPersonalProperties::find_data(decrypt($uid));
        $assets_personal_properties = AssetsPersonalProperties::generate_blank_data();
        if($assets_personal_properties_find){
            $assets_personal_properties = AssetsPersonalProperties::get_data(decrypt($uid));
        }

        $assets_liabilities_find = AssetsLiabilities::find_data(decrypt($uid));
        $assets_liabilities = AssetsLiabilities::generate_blank_data();
        if($assets_liabilities_find){
            $assets_liabilities = AssetsLiabilities::get_data(decrypt($uid));
        }
      


        $business_interest_and_financial_find = AssetsBussIntFinCon::find_data(decrypt($uid));
        $business_interest_and_financial = AssetsBussIntFinCon::generate_blank_data();
        if($business_interest_and_financial_find){
            $business_interest_and_financial = AssetsBussIntFinCon::get_data(decrypt($uid));
        }
 
        
        $relatives_government_service_find = AssetsRelativeGovernmentService::find_data(decrypt($uid));
        $relatives_government_service = AssetsRelativeGovernmentService::generate_blank_data();
        if($relatives_government_service_find){
            $relatives_government_service = AssetsRelativeGovernmentService::get_data(decrypt($uid));
        }

    

       // $work_experience_find = WorkExperience::present_job(decrypt($uid));
       //  $work_experience = WorkExperience::present_job_generate_blank_data();
       //  if($work_experience_find){
       //      $work_experience = WorkExperience::present_job(decrypt($uid));
       //  }
        


        $work_experience_find = WorkExperience::find_data(decrypt($uid));
        $work_experience = WorkExperience::generate_blank_data();

        if($work_experience_find){
            $work_experience = WorkExperience::get_data(decrypt($uid));
        }



            $survey = SurveyPage::get_data(decrypt($uid));


    	$name = PersonalInformation::get_name(decrypt($uid));
    	SystemLogs::saveLogs('visited '.$name.' sworn statement of assets, liabilities and net worth page!');
    	return view('ssalnw-form',[
    		'uid' => $uid,
    		'personal_information' =>$personal_information,
            'family_background' => $family_background,
            'childrens' => $childrens,
            'assets_real_properties' => $assets_real_properties,
            'assets_personal_properties' => $assets_personal_properties,
            'assets_liabilities' => $assets_liabilities,
            'business_interest_and_financial' => $business_interest_and_financial,
            'work_experience' => $work_experience[0],
            'relatives_government_service' => $relatives_government_service,
            'survey' => $survey,
    		'color' => $color
    	]);
    	
    }


    public function download_ssalnw($uid){
    
        $pds_name = 'ssalnw';
        // $uid = decrypt($uid);

    	$personal_information_id = PersonalInformation::find_data(decrypt($uid));
    	$personal_information = PersonalInformation::pdf_generate_blank_data();
    	if($personal_information_id){
    		$personal_information = PersonalInformation::get_data($personal_information_id);
            $pds_name = ucwords(strtolower($personal_information->surname.', '.$personal_information->first_name));
    	}

        $family_background_id = FamilyBackground::find_data(decrypt($uid));
        $family_background = FamilyBackground::generate_blank_data();
        if($family_background_id){
            $family_background = FamilyBackground::get_data($family_background_id);
        }

        // $Childrens_find = Childrens::under_18_find_data(decrypt($uid));
        // $childrens = Childrens::generate_blank_data();
        // if($Childrens_find){
        //     $childrens = Childrens::under_18_get_data(decrypt($uid));
        // }

        $Childrens_find = Childrens::under_18_get_data(decrypt($uid));
        
        if($Childrens_find){
            $cnt = count($Childrens_find) - 1;
            $childrens = Childrens::under_18_get_data(decrypt($uid));
            $childrens = Childrens::pdf_generate_ssalnw($cnt,decrypt($uid));

        }else{
            $childrens = Childrens::pdf_generate_blank_data_ssalnw(0);
        }

        // echo "<pre>";
        // print_r($family_background);exit;
    
        $assets_real_properties_find = AssetsRealProperties::find_data(decrypt($uid));

        if($assets_real_properties_find){
            $cnt = $assets_real_properties_find - 1;
            $assets_real_properties = AssetsRealProperties::get_data(decrypt($uid));
            $assets_real_properties = AssetsRealProperties::pdf_generate($cnt,decrypt($uid));

            // echo "<pre>";
            // print_r($assets_real_properties);exit;

            $data_real[] = [];
          
            foreach ($assets_real_properties as $key => $value) {
               if($value->current_fair_market_value){
                    $data_real[] = str_replace(",","",$value->acquisition_cost); 
               }
            }

            if($data_real){
                $real_subtotal = number_format(array_sum($data_real), 2);
            }else{
                $real_subtotal = "0.00";
            }
        }else{
            $assets_real_properties = AssetsRealProperties::generate_blank_data(0);
            $real_subtotal = "0.00";
        }

        // echo "<pre>";
        // print_r($assets_real_properties);exit;
        
        $assets_personal_properties_find = AssetsPersonalProperties::find_data(decrypt($uid));

        if($assets_personal_properties_find){
            $cnt = $assets_personal_properties_find - 1;
            $assets_personal_properties = AssetsPersonalProperties::get_data(decrypt($uid));
            $assets_personal_properties = AssetsPersonalProperties::pdf_generate($cnt,decrypt($uid));

            foreach ($assets_personal_properties as $key => $value) {
               if($value->acquisition_cost){
                    $data_personal[] = $value->acquisition_cost; 
               }
            }

            $personal_subtotal = number_format(array_sum($data_personal), 2);
        }else{
            $assets_personal_properties = AssetsPersonalProperties::generate_blank_data(0);
            $personal_subtotal = "0.00";
        }

        $assets_liabilities_find = AssetsLiabilities::find_data(decrypt($uid));

        if($assets_liabilities_find){
            $cnt = $assets_liabilities_find - 1;
            $assets_liabilities = AssetsLiabilities::get_data(decrypt($uid));
            $assets_liabilities = AssetsLiabilities::pdf_generate($cnt,decrypt($uid));

            foreach ($assets_liabilities as $key => $value) {
               if($value->outstanding_balance){
                    $data_outstanding_balance[] = $value->outstanding_balance; 
               }
            }

            $data_outstanding_balance_total = number_format(array_sum($data_outstanding_balance), 2);
        }else{
            $assets_liabilities = AssetsLiabilities::generate_blank_data(0);
            $data_outstanding_balance_total = "0.00";
        }

        $business_interest_and_financial_find = AssetsBussIntFinCon::find_data(decrypt($uid));

        if($business_interest_and_financial_find){
            $cnt = $business_interest_and_financial_find - 1;
            $business_interest_and_financial = AssetsBussIntFinCon::get_data(decrypt($uid));
            $business_interest_and_financial = AssetsBussIntFinCon::pdf_generate($cnt,decrypt($uid));
        }else{
            $business_interest_and_financial = AssetsBussIntFinCon::generate_blank_data(0);
        }
        
        $relatives_government_service_find = AssetsRelativeGovernmentService::find_data(decrypt($uid));

        if($relatives_government_service_find){
            $cnt = $relatives_government_service_find - 1;
            $relatives_government_service = AssetsRelativeGovernmentService::get_data(decrypt($uid));
            $relatives_government_service = AssetsRelativeGovernmentService::pdf_generate($cnt,decrypt($uid));
        }else{
            $relatives_government_service = AssetsRelativeGovernmentService::generate_blank_data(0);
        }


        $work_experience_find = WorkExperience::present_job(decrypt($uid));
        
        if($work_experience_find){
            $work_experience = WorkExperience::present_job(decrypt($uid));
        }
        else{
            $work_experience = WorkExperience::present_job_generate_blank_data(0);
        }


        // $work_experience_find = WorkExperience::find_data(decrypt($uid));
        // $work_experience = WorkExperience::generate_blank_data();

        // if($work_experience_find){
        //     $work_experience = WorkExperience::get_data(decrypt($uid));
        // }



        $survey = SurveyPage::get_data(decrypt($uid));

        // echo "<pre>";
        // print_r($survey);exit;
        

        $date_now = Carbon::now()->format('F d, Y');

        $real_personal_total =  str_replace(",","", $real_subtotal) + str_replace(",","", $personal_subtotal);
        $real_personal_total = number_format($real_personal_total, 2);

        $net_worth = str_replace(",","", $real_personal_total) - str_replace(",","", $data_outstanding_balance_total);
        $net_worth = number_format($net_worth, 2);

    	$data = [
    		'uid' => $uid,
            'personal_information' =>$personal_information,
            'family_background' => $family_background,
            'childrens' => $childrens,
            'assets_real_properties' => $assets_real_properties,
            'real_subtotal' => $real_subtotal,
            'assets_personal_properties' => $assets_personal_properties,
            'personal_subtotal' => $personal_subtotal,
            'real_personal_total' => $real_personal_total,
            'assets_liabilities' => $assets_liabilities,
            'data_outstanding_balance_total' => $data_outstanding_balance_total,
            'net_worth' => $net_worth,
            'business_interest_and_financial' => $business_interest_and_financial,
            'work_experience' => $work_experience,
            'relatives_government_service' => $relatives_government_service,
            'survey' => $survey,
            'date_now' => $date_now
    	];

    	// echo '<pre>';
    	// print_r($data);exit;

       	// return view('pds',$data);
       	// return $pdf->stream("pds.pdf", array("Attachment" => false));

        if($uid == Auth::user()->id){
            $gender = Accounts::find_gender( Auth::user()->gender);
             SystemLogs::saveLogs('downloaded '.$gender.' sworn statement of assets, liabilities and net worth!'); 
        }else{
            $name =  PersonalInformation::get_name(decrypt($uid));
            SystemLogs::saveLogs('downloaded sworn statement of assets, liabilities and net worth of '.$name.'!'); 
        }


       // echo "<pre>";
       // print_r($work_experience);exit;
       

        
        $pdf = PDF::loadView('reports.ssalnw-download',$data)->setPaper('legal','portrait'); //[0,0,612,936]
        return $pdf->stream($pds_name.'.pdf');

    }


    public function assets_real_properties(Request $request){



                $uid = decrypt($request->uid);
                $name = Accounts::get_name($uid);
                
                $rules = [
                        'description.*' => 'required',
                        'kind.*' => 'required',
                        'exact_location.*' => 'required',
                        'assessed_value.*' => 'required',
                        'current_fair_market_value.*' => 'required',
                        'acquisition_year.*' => 'required',//|digits:4|integer|min:1900|max:'.(date('Y')+1),
                        'acquisition_mode.*' => 'required',
                        'acquisition_cost.*' => 'required',
                   
                ];
                
                $customize = [

                    'description.*.required' => 'The description field is required.',
                    'kind.*.required' => 'The kind field is required.',
                    'exact_location.*.required' => 'The exact location field is required.',
                    'assessed_value.*.required' => 'The assessed value field is required.',
                    'current_fair_market_value.*.required' => 'The current fair market value field is required.',
                    'acquisition_year.*' => 'The acquisition year is invalid format.',
                    'acquisition_mode.*.required' => 'The acquisition mode field is required.',
                    'acquisition_cost.*.required' => 'The acquisition cost field is required.',

                ];

             
      

                  $validation = Validator::make($request->all(),$rules,$customize);


                  if($validation->passes())

                    {


                          $find = AssetsRealProperties::find_data($uid);

                   

                         if($find){
                                $msg_action = "updated!";
                                $action  = 0;
                         }else{
                                $msg_action = "saved!";
                                $action  = 1;
                         }

                         // echo $action;exit;


                         AssetsRealProperties::where('user_id',$uid)->delete();


                        $cnt = count($request->description)-1;
            

                        for ($count=0; $count <= $cnt; $count++) {
                            
                            $save = New AssetsRealProperties;
                            $save->user_id = $uid; 

                            $save->description = $request->description[$count];
                            $save->kind = $request->kind[$count];
                            $save->exact_location = $request->exact_location[$count];
                            $save->assessed_value = $request->assessed_value[$count];
                            $save->current_fair_market_value = $request->current_fair_market_value[$count];
                            $save->acquisition_year = $request->acquisition_year[$count];
                            $save->acquisition_mode = $request->acquisition_mode[$count];
                         
                             if($request->acquisition_cost[$count]){
                                $save->acquisition_cost = str_replace( ',', '', $request->acquisition_cost[$count]);
                             }

                            $save->save();
                        }

                        if($save->save()) {
                                                        
                            
                            SystemLogs::saveLogs('has successfully '.$action.' assets real properties!'); 

                            $msg = $name.' assets real properties has been successfully '.$msg_action;
                              // $request->session()->flash('msg', $msg);
                              return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
                        }
                 }

             

                $errors = $validation->errors();
                $errors =  json_decode($errors); 
                
                return response()->json(['success' => false,'message' => $errors]);


    }


    public function assets_personal_properties(Request $request){



                $uid = decrypt($request->uid);
                $name = Accounts::get_name($uid);
                
                $rules = [
                        'description.*' => 'required',
                        'acquisition_cost.*' => 'required',
                        'year_acquired.*' => 'required',//|digits:4|integer|min:1900|max:'.(date('Y')+1),
                   
                ];
                
                $customize = [

                    'description.*.required' => 'The description field is required.',
                    'year_acquired.*.required' => 'The acquisition year is invalid format.',
                    'acquisition_cost.*.required' => 'The acquisition cost field is required.',
                    
                ];

             
      

                  $validation = Validator::make($request->all(),$rules,$customize);


                  if($validation->passes())

                    {


                          $find = AssetsPersonalProperties::find_data($uid);

                   

                         if($find){
                                $msg_action = "updated!";
                                $action  = 0;
                         }else{
                                $msg_action = "saved!";
                                $action  = 1;
                         }

                         // echo $action;exit;


                         AssetsPersonalProperties::where('user_id',$uid)->delete();


                        $cnt = count($request->description)-1;
            

                        for ($count=0; $count <= $cnt; $count++) {
                            
                            $save = New AssetsPersonalProperties;
                            $save->user_id = $uid; 

                            $save->description = $request->description[$count];
                            $save->year_acquired = $request->year_acquired[$count];
                        
                             if($request->acquisition_cost[$count]){
                                $save->acquisition_cost = str_replace( ',', '', $request->acquisition_cost[$count]);
                             }

                            $save->save();
                        }

                        if($save->save()) {
                                                        
                            
                            SystemLogs::saveLogs('has successfully '.$action.' assets personal properties!'); 

                            $msg = $name.' assets personal properties has been successfully '.$msg_action;
                              // $request->session()->flash('msg', $msg);
                              return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
                        }
                    }

             

                $errors = $validation->errors();
                $errors =  json_decode($errors); 
                
                return response()->json(['success' => false,'message' => $errors]);


    }


    public function assets_liabilities(Request $request){



                $uid = decrypt($request->uid);
                $name = Accounts::get_name($uid);
                
                $rules = [
                        'nature.*' => 'required',
                        'name_of_creditors.*' => 'required',
                        'outstanding_balance.*' =>  'required',
                ];
                
                $customize = [

                    'nature.*.required' => 'The nature field is required.',
                    'outstanding_balance.*.required' =>  'The outstanding balance field is required.',
                    'name_of_creditors.*.required' => 'The name of creditors field is required.',
                    
                ];

             
      

                  $validation = Validator::make($request->all(),$rules,$customize);


                  if($validation->passes())

                    {


                          $find = AssetsLiabilities::find_data($uid);

                   

                         if($find){
                                $msg_action = "updated!";
                                $action  = 0;
                         }else{
                                $msg_action = "saved!";
                                $action  = 1;
                         }

                         // echo $action;exit;


                         AssetsLiabilities::where('user_id',$uid)->delete();


                        $cnt = count($request->nature)-1;
            

                        for ($count=0; $count <= $cnt; $count++) {
                            
                            $save = New AssetsLiabilities;
                            $save->user_id = $uid; 

                            $save->nature = $request->nature[$count];
                            $save->name_of_creditors = $request->name_of_creditors[$count];
                        
                             if($request->outstanding_balance[$count]){
                                $save->outstanding_balance = str_replace( ',', '', $request->outstanding_balance[$count]);
                             }

                            $save->save();
                        }

                        if($save->save()) {
                                                        
                            
                            SystemLogs::saveLogs('has successfully '.$action.' assets liabilities!'); 

                            $msg = $name.' assets liabilities has been successfully '.$msg_action;
                              // $request->session()->flash('msg', $msg);
                              return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
                        }
                    }

             

                $errors = $validation->errors();
                $errors =  json_decode($errors); 
                
                return response()->json(['success' => false,'message' => $errors]);


    }


    public function business_interest_and_financial(Request $request){



                $uid = decrypt($request->uid);
                $name = Accounts::get_name($uid);
                
                $rules = [
                        'name_of_business.*' => 'required',
                        'business_address.*' => 'required',
                        'nature_of_business.*' =>  'required',
                        'date_of_acquisition.*' =>  'required',
                ];
                
                $customize = [

                    'name_of_business.*.required' => 'The name of business field is required.',
                    'business_address.*.required' =>  'The business address field is required.',
                    'nature_of_business.*.required' => 'The nature of business field is required.',
                    'date_of_acquisition.*.required' => 'The date of acquisition field is required.',
                    
                ];

             
      

                  $validation = Validator::make($request->all(),$rules,$customize);


                  if($validation->passes())

                    {


                          $find = AssetsBussIntFinCon::find_data($uid);

                   

                         if($find){
                                $msg_action = "updated!";
                                $action  = 0;
                         }else{
                                $msg_action = "saved!";
                                $action  = 1;
                         }

                         // echo $action;exit;


                         AssetsBussIntFinCon::where('user_id',$uid)->delete();


                        $cnt = count($request->name_of_business)-1;
            

                        for ($count=0; $count <= $cnt; $count++) {
                            
                            $save = New AssetsBussIntFinCon;
                            $save->user_id = $uid; 

                            $save->name_of_business = $request->name_of_business[$count];
                            $save->business_address = $request->business_address[$count];
                            $save->nature_of_business = $request->nature_of_business[$count];
                            $save->date_of_acquisition = $request->date_of_acquisition[$count];
                        
                             // if($request->outstanding_balance[$count]){
                             //    $save->outstanding_balance = str_replace( ',', '', $request->outstanding_balance[$count]);
                             // }

                            $save->save();
                        }

                        if($save->save()) {
                                                        
                            
                            SystemLogs::saveLogs('has successfully '.$action.' business interest and financial connection!'); 

                            $msg = $name.' business interest and financial connection has been successfully '.$msg_action;
                              // $request->session()->flash('msg', $msg);
                              return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
                        }
                    }

             

                $errors = $validation->errors();
                $errors =  json_decode($errors); 
                
                return response()->json(['success' => false,'message' => $errors]);


    }


    public function relatives_government_service(Request $request){



                $uid = decrypt($request->uid);
                $name = Accounts::get_name($uid);
                
                $rules = [
                        'name_of_relative.*' => 'required',
                        'relationship.*' => 'required',
                        'position.*' =>  'required',
                        'agency_and_address.*' =>  'required',
                ];
                
                $customize = [

                    'name_of_relative.*.required' => 'The name of relative field is required.',
                    'relationship.*.required' =>  'The relationship field is required.',
                    'position.*.required' => 'The position field is required.',
                    'agency_and_address.*.required' => 'The agency and address field is required.',
                    
                ];

             
      

                  $validation = Validator::make($request->all(),$rules,$customize);


                  if($validation->passes())

                    {


                          $find = AssetsRelativeGovernmentService::find_data($uid);

                   

                         if($find){
                                $msg_action = "updated!";
                                $action  = 0;
                         }else{
                                $msg_action = "saved!";
                                $action  = 1;
                         }

                         // echo $action;exit;


                         AssetsRelativeGovernmentService::where('user_id',$uid)->delete();


                        $cnt = count($request->name_of_relative)-1;
            

                        for ($count=0; $count <= $cnt; $count++) {
                            
                            $save = New AssetsRelativeGovernmentService;
                            $save->user_id = $uid; 

                            $save->name_of_relative = $request->name_of_relative[$count];
                            $save->relationship = $request->relationship[$count];
                            $save->position = $request->position[$count];
                            $save->agency_and_address = $request->agency_and_address[$count];
                    

                            $save->save();
                        }

                        if($save->save()) {
                                                        
                            
                            SystemLogs::saveLogs('has successfully '.$action.' relatives in the government service!'); 

                            $msg = $name.'  relatives in the government service has been successfully '.$msg_action;
                              // $request->session()->flash('msg', $msg);
                              return response()->json([ 'success' => true,'message' => $msg,'action' => $action  ]);
                        }
                    }

             

                $errors = $validation->errors();
                $errors =  json_decode($errors); 
                
                return response()->json(['success' => false,'message' => $errors]);


    }


    public function archived($uid){
       
        $approval = 1;

        if(Auth::id() == decrypt($uid)){
            //echo 'own';
        }elseif (Auth::user()->role == 'admin' && $approval == 1) {
            //echo 'approved admin view';
        }else{
            //echo 'not allowed';
        }

        $color = Accounts::theme_color();
        return view('ssalnw-archived',['color' => $color,'uid' => $uid]);
    }



    public function send_request(Request $request){

        $user_id = decrypt($request->user_id);
        $class = ".u-".$user_id;
        self::send_request_function($user_id);
        $message = "Your request has been successfully sent!";
        return response()->json(['success' => true,'message' => $message,'class' => $class]);

    }

    public function send_request_to_all(){

        $find = DB::table("admin_request")->select("user_id")->where("ssalnw",0)->get();

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

      // echo "<pre>";
      // print_r($find);exit;

         if($cnt >= 1){


            $users = Accounts::users_id();
            foreach ($users as $key => $value) {
                $user_id = $value->id;
                $class = ".all-users";
                self::send_request_function($user_id);
            }
            
            $message = "Your request has been successfully sent to all employees!";
            return response()->json(['success' => true,'message' => $message,'class' => $class,'page' => url('sworn-statement-assets-liabilities-net-worth/employees-table')]);

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
            return response()->json(['success' => true,'message' => $message,'class' => $class,'page' => url('sworn-statement-assets-liabilities-net-worth/employees-table')]);

    }


    public static function send_request_function($user_id){
        $admin_id = Auth::id();
        AdminRequest::send_request($user_id);
        $full_name = PersonalInformation::get_name($user_id);
        SystemLogs::saveLogs('send request to view (SSALNW) of '.$full_name);
        $subject = "Request View (SSALNW)";
        $from_email = Auth::user()->email;
        $from_name = Auth::user()->name;
        $find = User::find($user_id);
        $to_email = $find->email;
        $to_name = $find->name;

        $thread_id = Messages::admin_request_view_ssalnw($user_id,$admin_id); 

        $body = "Hello ".$full_name.", we are requesting to view your SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH. <br> Please <font color='red'><a href='".url("sworn-statement-assets-liabilities-net-worth/view/confirm")."/".encrypt($thread_id)."'>Confirm</a></font></a>";

        Notifications::insertMessage($user_id,$body);
        EmailNotification::create_email_notifcation($subject,$body,$from_email,$from_name,$to_email,$to_name);
    }


    public function ssalnw_view_request_confirmation(Request $request,$thread_id){

      $find = DB::table("admin_request")->select("ssalnw")->where("user_id",Auth::id())->first();

      if($find->ssalnw == 1){
        return view('request-confirmation-ssalnw',['thread_id' => $thread_id]);
      }else{

        $msg = 'Your not allowed to access this content!';
        $request->session()->flash('msg',$msg);
        return redirect()->back();
      }


    }


    public function ssalnw_request_confirmation(Request $request){



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
        } else{
           $ress_word = 'disapproved';
        }

        AdminRequest::request_reply($user_id,$response);

        $full_name = PersonalInformation::get_name($user_id);

        $thread_id = decrypt($thread_id);


        SystemLogs::saveLogs($ress_word.' request of Human Resource Unit / Administrator.');
        $subject = "Request View (SSALNW)";
        
        if($response == 2){
        $body = $full_name.' '.$ress_word.' your request <a href="'.url("sworn-statement-assets-liabilities-net-worth/".encrypt($user_id)).'"> (SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH)</a>.';
        }else{
            $body = $full_name." ".$ress_word." your request (SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH).";
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


}
