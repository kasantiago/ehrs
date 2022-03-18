<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\LeaveApplication as LeaveApplication;
use App\Http\Models\LeaveCard as LeaveCard;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\EmployeeStatus as EmployeeStatus;
use App\Http\Models\Position as Position;
use App\Http\Models\Division as Division;
use Carbon\Carbon as Carbon;
use App\User as User;
use PDF;
use Validator;
use Auth;

class LeaveApplicationController extends Controller
{
    public function index(Request $request){

        $findData = PersonalInformation::find_data(Auth::id());

        if(!$findData){
            $msg = 'Please fillup  I. Personal Information first.';
            $request->session()->flash('msg',$msg);
            return redirect('personal-data-sheet/'.encrypt(Auth::id()));
        }
        $latest  = LeaveCard::latest_result(Auth::id());
    	SystemLogs::saveLogs('visited leave form page!'); 
	    $color = Accounts::theme_color();
	    return view('leave.leave-form',['color' => $color,'latest' => $latest]);
    }


    public function leave_card(){

    	$users = Accounts::employees_table();
        $color = Accounts::theme_color();

        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            $data[$cnt]->view = url('reports/leave-info/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
        }
        
        SystemLogs::saveLogs('visited Employees Leave Card page!'); 
        return view('leave.leave-card-page',['users' => $users, 'color' => $color]);
    }
    

    public function leave_info($uid){

    	$leave_info = 'leave_info';

    	$pdf = PDF::loadView('leave.leave-info-report')->setPaper([0, 0, 595, 841],'portrait');
        return $pdf->stream($leave_info.'.pdf');
    }


    public function store(Request $request){


        $validators = [
   
                'six_a_type_of_leave' => 'required',
                'six_c_for'  => 'required',
                'six_c_inclusive_dates' => 'required'
        
            ];

        
        $findData = PersonalInformation::find_data(Auth::id());


        if(!$findData){
            $validators['personal_information']  = 'required';
        }else{
            $findData = PersonalInformation::get_user_data(Auth::id());
        }


        if($request->six_a_vacation_leave_data == 'others'){
            $validators['six_a_type_of_leave_data']  = 'required';
        }

        if($request->six_b_vacation_leave_be_spent == 'abroad'){
             $validators['six_b_vacation_leave_be_spent_data']  = 'required';
        }

        
        if($request->six_a_type_of_leave == 'others'){
            if(!$request->six_a_type_of_leave_data){
                $validators['input_six_a_type_of_leave_data']  = 'required';
            }
        }
    
   
        $customize_validator = [
                'six_a_type_of_leave.required' => 'The type of leave field is required.',
                'six_c_for.required' => 'The number of working days field is required.',
                'six_c_inlusive_dates.required' => 'The inclusive dates field is required.',
                'six_a_type_of_leave_data.required' => 'The other information details is required.',
                'input_six_a_type_of_leave_data.required' => 'The other information details is required.',
                'six_b_vacation_leave_be_spent_data.required' => 'The other information details is required.',
                'six_a_type_of_leave_data.required' => 'The other information details is required.',
                'six_c_inclusive_dates.required' => 'The inclusive dates details is required.',
                'personal_information.required' => 'Please fillup I. Personal Information in Personal Data Information.',
            ];

          $validation = Validator::make($request->all(),$validators,$customize_validator);


      if($validation->passes())

        {
        

            $save = New LeaveApplication;


            $save->user_id = Auth::id();
            $save->office_agency = 'DOH-RO2';
            $save->last_name = $findData->surname;
            $save->first_name = $findData->first_name;
            $save->middle_name = $findData->middle_name;
            $save->date_of_filing = Carbon::now()->toDateTimeString();
            $save->position = Auth::user()->position;
            $save->monthly_salary = Auth::user()->salary_amount;
            $save->six_a_type_of_leave = $request->six_a_type_of_leave;
            $save->six_a_vacation_leave_data = $request->six_a_vacation_leave_data;
            $save->six_a_type_of_leave_data = $request->six_a_type_of_leave_data;
            $save->six_b_vacation_leave_be_spent = $request->six_b_vacation_leave_be_spent;
            $save->six_b_vacation_leave_be_spent_data = $request->six_b_vacation_leave_be_spent_data;
            $save->six_b_sick_leave_be_spent = $request->six_b_sick_leave_be_spent;
            $save->six_b_sick_leave_be_spent_data = $request->six_b_sick_leave_be_spent_data;
            $save->six_c_for = $request->six_c_for;
            $save->six_c_inclusive_dates = $request->six_c_inclusive_dates;
            $save->six_d_commutation = $request->six_d_commutation;
            $save->seven_b_recommendation = 'pending';
        
             if($save->save()) {
                  SystemLogs::saveLogs('successfully created '.ucwords($request->six_a_type_of_leave).' Leave form!'); 
                  $msg = 'You have successfully created '.ucwords($request->six_a_type_of_leave).' Leave form!';
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('leave/application/'.encrypt($save->id)) ]);
             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }

    public function update(Request $request){

 

        $validators = [
   
                'six_a_type_of_leave' => 'required',
                'six_c_for'  => 'required',
                'six_c_inclusive_dates' => 'required'
        
            ];

        
        $findData = PersonalInformation::find_data(Auth::id());


        if(!$findData){
            $validators['personal_information']  = 'required';
        }else{
            $findData = PersonalInformation::get_user_data(Auth::id());
        }


        if($request->six_a_vacation_leave_data == 'others'){
            $validators['six_a_type_of_leave_data']  = 'required';
        }

        if($request->six_b_vacation_leave_be_spent == 'abroad'){
             $validators['six_b_vacation_leave_be_spent_data']  = 'required';
        }

        
        if($request->six_a_type_of_leave == 'others'){
            if(!$request->six_a_type_of_leave_data){
                $validators['input_six_a_type_of_leave_data']  = 'required';
            }
        }
    
   
        $customize_validator = [
                'six_a_type_of_leave.required' => 'The type of leave field is required.',
                'six_c_for.required' => 'The number of working days field is required.',
                'six_c_inlusive_dates.required' => 'The inclusive dates field is required.',
                'six_a_type_of_leave_data.required' => 'The other information details is required.',
                'input_six_a_type_of_leave_data.required' => 'The other information details is required.',
                'six_b_vacation_leave_be_spent_data.required' => 'The other information details is required.',
                'six_a_type_of_leave_data.required' => 'The other information details is required.',
                'six_c_inclusive_dates.required' => 'The inclusive dates details is required.',
                'personal_information.required' => 'Please fillup I. Personal Information in Personal Data Information.',
            ];

          $validation = Validator::make($request->all(),$validators,$customize_validator);


      if($validation->passes())

        {
        

            $updated = LeaveApplication::find(decrypt($request->id));
            $updated->six_a_type_of_leave = $request->six_a_type_of_leave;
            $updated->six_a_vacation_leave_data = $request->six_a_vacation_leave_data;
            $updated->six_a_type_of_leave_data = $request->six_a_type_of_leave_data;
            $updated->six_b_vacation_leave_be_spent = $request->six_b_vacation_leave_be_spent;
            $updated->six_b_vacation_leave_be_spent_data = $request->six_b_vacation_leave_be_spent_data;
            $updated->six_b_sick_leave_be_spent = $request->six_b_sick_leave_be_spent;
            $updated->six_b_sick_leave_be_spent_data = $request->six_b_sick_leave_be_spent_data;
            $updated->six_c_for = $request->six_c_for;
            $updated->six_c_inclusive_dates = $request->six_c_inclusive_dates;
            $updated->six_d_commutation = $request->six_d_commutation;
        
             if($updated->update()) {
                  SystemLogs::saveLogs(ucwords($request->six_a_type_of_leave).' Leave has been successfully updated!'); 
                  $msg = ucwords($request->six_a_type_of_leave).' Leave has been successfully updated!'; 
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('leave/application/'.encrypt($updated->id)) ]);
             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }

    public function edit(Request $request,$id){
      

       $id = decrypt($id);

        $findData = PersonalInformation::find_data(Auth::id());
        $data = LeaveApplication::find($id);

        // echo "<pre>";
        // print_r($data);exit;

        if($data->user_id != Auth::id()){
            $msg = 'Your not allowed to access this page!';
            $request->session()->flash('msg',$msg);
            return redirect()->back();
        }

        if(!$findData){
            $msg = 'Please fillup  I. Personal Information first.';
            $request->session()->flash('msg',$msg);
            return redirect('personal-data-sheet/'.encrypt(Auth::id()));
        }
        $latest  = LeaveCard::latest_result(Auth::id());
        SystemLogs::saveLogs('visited update leave form page!'); 
        $color = Accounts::theme_color();
        return view('leave.leave-edit-form',['color' => $color,'latest' => $latest,'data' => $data,'id' => encrypt($id)]);
    }

    public function request($uid){

           $user_id = decrypt($uid);
           $application = LeaveApplication::leave_information($user_id,Null);

           if($application){
                if(Auth::id() == $user_id || Auth::user()->role == 'admin'){

                    // echo "<pre>";
                    // print_r($application);exit; 
                     SystemLogs::saveLogs('visited leave requests page!'); 
                     $color = Accounts::theme_color();
                     return view('leave.leave-request',['application' => $application,'uid' => $user_id,'color' => $color]);


                }else{

                    $msg = "Your not allowed to access this content!";
                    Session::flash('msg',$msg);
                    return redirect()->back();
                }   
           
           }else{

                $msg = "No Leave Application data found!";
                Session::flash('msg',$msg);
                return redirect()->back();

           }

    }

    public function application_printout($id){
        $latest  = LeaveCard::latest_result(Auth::id());
    	$leave_form = 'leave_form';
        $id = decrypt($id);
        $data = LeaveApplication::find($id);

        //   echo "<pre>";
        // print_r($data);exit;

        if($data->user_id != Auth::id()){
                $msg = "Your not allowed to access this leave application form.";
                Session::flash('msg',$msg);
                return redirect()->back();   
        }

        $pdf = PDF::loadView('leave.leave-form-report',['data' => $data,'latest' => $latest])->setPaper([0,0,612,936],'portrait');
        return $pdf->stream($leave_form.'.pdf');
    }

    public function leave_applications(){

        $application = LeaveApplication::leave_information(Null,'pending');
        LeaveApplication::seen();
        SystemLogs::saveLogs('visited leave applications page!'); 
        $color = Accounts::theme_color();
        return view('leave.leave-applications',['color' => $color,'application' => $application]);
    }

    public function leave_applications_status_update(Request $request,$id,$status){

        $id = decrypt($id);
        $status = decrypt($status);


        $update = LeaveApplication::find($id);
        $update->seven_b_recommendation = $status.'d';

        $name = PersonalInformation::get_name($update->user_id);

         if($update->update()) {

                if($status == 'approve'){
                    LeaveCard::create_leave_card($update->id,$update->user_id);
                }

               SystemLogs::saveLogs(' has successfully '.$status.'d '.$name.' '.ucwords($update->six_a_type_of_leave).' Leave!'); 
               $msg = 'You has successfully '.$status.'d '.$name.' '.ucwords($update->six_a_type_of_leave).' Leave!';
               $request->session()->flash('msg',$msg);
               return redirect()->back();
               // return response()->json([ 'success' => true,'message' => 'record added','url' => url('leave/application/'.encrypt($update->id)) ]);
         }


    }

    public function report_leave_status($status){

        $application  = LeaveApplication::leave_information(Null,$status);

        $color = Accounts::theme_color();
        return view('leave.report-approved-leave',['application' => $application,'color' => $color,'status' => $status]);
    }


    public function leave_card_make(){
     SystemLogs::saveLogs('visited create accounts page!');
      $color = Accounts::theme_color();

      $employee_status = EmployeeStatus::list();
      $division = Division::list();
      $position = Position::list();
      return view('leave.leave-card-make',['employee_status' => $employee_status,'division' => $division,'position' => $position, 'color' => $color]);
    }



}
