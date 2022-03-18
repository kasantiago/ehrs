<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\VoluntaryWorkInvolvement as VoluntaryWorkInvolvement;
use App\Http\Models\CivilServiceEligibility as CivilServiceEligibility;
use App\Http\Models\WorkExperience as WorkExperience;
use App\Http\Models\LearningDevelopmentInterventions as LearningDevelopmentInterventions;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\PersonalInformation as PersonalInformation;
use Validator;
use PDF;
use Auth;
use DB;
use Carbon\Carbon as Carbon;


class ReportsController extends Controller
{
    
    public function civil_service_eligibilty(){
        $users = Accounts::active_pds_report_employees_table();
        
        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            $data[$cnt]->view = url('reports/civil-service-eligibilty/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
        }
        $page_title = "REPORT - CIVIL SERVICE ELIGIBITY";
        $all_link = url('reports/civil-service-eligibilty/all');
        SystemLogs::saveLogs('visited employees civil service eligibilty record page!');
        $color = Accounts::theme_color();
        return view('reports.cse-workexp-voluntary-learning-page',['users' => $users,'page_title' => $page_title,'all_link' => $all_link,'color' => $color]);     
    }

    public function find_civil_service_eligibilty($uid){
       $user_id = $uid;
        $validate = CivilServiceEligibility::validate($uid);
         if(!$validate){
            session()->flash('msg','No civil service eligibilty record  found!');
            return redirect()->back();
        }
        if($uid != 'all'){
         $user_id = decrypt($uid);
            if(Auth::user()->id == decrypt($uid)){
                $gender = Accounts::find_gender(Auth::user()->gender);
                SystemLogs::saveLogs('visited '.$gender.' civil service eligibilty page!');
            }else{
                $name = PersonalInformation::get_name(decrypt($uid));
                SystemLogs::saveLogs('visited '.$name.' civil service eligibilty page!');
            }

        }else{
            SystemLogs::saveLogs('visited all civil service eligibilty record page!'); 
        }
        $report_data = CivilServiceEligibility::reports($uid);
        $color = Accounts::theme_color();
        return view('reports.civil-service-eligibilty',['report_data' => $report_data,'uid' => $user_id,'color' => $color]);
    }



    // public function voluntary_works(){
    //  $report_data = VoluntaryWorkInvolvement::reports();
    //  return view('reports.voluntary-works',['report_data' => $report_data]);
    // }


    public function work_experience(){


        $users = Accounts::active_pds_report_employees_table();


        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            $data[$cnt]->view = url('reports/work-experience/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
        }

        $page_title = "REPORT - WORK EXPERIENCE";
        $all_link = url('reports/work-experience/all');
        SystemLogs::saveLogs('visited employees work experience record page!');
        $color = Accounts::theme_color();
        return view('reports.cse-workexp-voluntary-learning-page',['users' => $users,'page_title' => $page_title,'all_link' => $all_link,'color' => $color]); 
    }

    public function find_work_experience($uid){

        $user_id = $uid;
        $validate = WorkExperience::validate($uid);
         if(!$validate){
            session()->flash('msg','No work experience record found!');
            return redirect()->back();
        }
        if($uid != 'all'){
         $user_id = decrypt($uid);
            if(Auth::user()->id == decrypt($uid)){
                $gender = Accounts::find_gender(Auth::user()->gender);
                SystemLogs::saveLogs('visited '.$gender.' work experience page!');
            }else{
                $name = PersonalInformation::get_name(decrypt($uid));
                SystemLogs::saveLogs('visited '.$name.' work experience page!');
            }

        }else{
            SystemLogs::saveLogs('visited all work experience  record page!'); 
        }
        $report_data = WorkExperience::reports($uid);
        $color = Accounts::theme_color();
        return view('reports.work-experience',['report_data' => $report_data,'uid' => $user_id,'color' => $color]);
    }



    public function voluntary_works(){

        $users = Accounts::active_pds_report_employees_table();
        
        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            $data[$cnt]->view = url('reports/voluntary-works/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
        }

        $page_title = "REPORT - VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S";
        $all_link = url('reports/voluntary-works/all');
        SystemLogs::saveLogs('visited employees voluntary works record page!');
        $color = Accounts::theme_color();
        return view('reports.cse-workexp-voluntary-learning-page',['users' => $users,'page_title' => $page_title,'all_link' => $all_link,'color' => $color]); 
    }


    public function find_voluntary_works($uid){

        $user_id = $uid;
        $validate = VoluntaryWorkInvolvement::validate($uid);
         if(!$validate){
            session()->flash('msg','No voluntary works record found!');
            return redirect()->back();
        }
        if($uid != 'all'){
         $user_id = decrypt($uid);
            if(Auth::user()->id == decrypt($uid)){
                $gender = Accounts::find_gender(Auth::user()->gender);
                SystemLogs::saveLogs('visited '.$gender.' voluntary works page!');
            }else{
                $name = PersonalInformation::get_name(decrypt($uid));
                SystemLogs::saveLogs('visited '.$name.' voluntary works page!');
            }

        }else{
            SystemLogs::saveLogs('visited all voluntary works record page!'); 
        }
        $report_data = VoluntaryWorkInvolvement::reports($uid);
        $color = Accounts::theme_color();
        return view('reports.voluntary-works',['report_data' => $report_data,'uid' => $user_id,'color' => $color]);
    }





    // public function work_experience(){
    //  $report_data = WorkExperience::reports();
    //  return view('reports.work-experience',['report_data' => $report_data]);
    // }
    // public function learning_development_training(){
    //  $report_data = LearningDevelopmentInterventions::reports();
    //  return view('reports.learning-development-training',['report_data' => $report_data]);
    // }


    public function learning_development_training(){

        $users = Accounts::active_pds_report_employees_table();
        
        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            $data[$cnt]->view = url('reports/learning-development-training/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
        }

        $page_title = "REPORT - LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED";
        $all_link = url('reports/learning-development-training/all');
        SystemLogs::saveLogs('visited employees learning development training record page!');
        $color = Accounts::theme_color();
        return view('reports.cse-workexp-voluntary-learning-page',['users' => $users,'page_title' => $page_title,'all_link' => $all_link,'color' => $color]); 
    }


    public function find_learning_development_training($uid){

        $user_id = $uid;
        $validate = LearningDevelopmentInterventions::validate($uid);
         if(!$validate){
            session()->flash('msg','No learning development training record found!');
            return redirect()->back();
        }
        if($uid != 'all'){
         $user_id = decrypt($uid);
            if(Auth::user()->id == decrypt($uid)){
                $gender = Accounts::find_gender(Auth::user()->gender);
                SystemLogs::saveLogs('visited '.$gender.' learning development training page!');
            }else{
                $name = PersonalInformation::get_name(decrypt($uid));
                SystemLogs::saveLogs('visited '.$name.' learning development training page!');
            }

        }else{
            SystemLogs::saveLogs('visited all learning development training record page!'); 
        }
        $report_data = LearningDevelopmentInterventions::reports($uid);
        $color = Accounts::theme_color();
        return view('reports.learning-development-training',['report_data' => $report_data,'uid' => $user_id,'color' => $color]);
    }





    public function birthday_celebrants($month){
        switch ($month) {
            case '01':
                $month_name = '( JANUARY )';
                break;
            case '02':
                $month_name = '( FEBRUARY )';
                break;
            case '03':
                $month_name = '( MARCH )';
                break;
            case '04':
                $month_name = '( APRIL )';
                break;
            case '05':
                $month_name = '( MAY )';
                break;
            case '06':
                $month_name = '( JUNE )';
                break;
            case '07':
                $month_name = '( JULY )';
                break;
            case '08':
                $month_name = '( AUGUST )';
                break;
            case '09':
                $month_name = '( SEPTEMBER )';
                break;
            case '10':
                $month_name = '( OCTOBER )';
                break;
            case '11':
                $month_name = '( NOVEMBER )';
                break;
            case '12':
                $month_name = '( DECEMBER )';
                break;
            
            default:
                $month_name = '';
                break;
        }
        $report_data = Accounts::birthday_list($month);
        SystemLogs::saveLogs('visited employees birthday celebrants list page!');
        $color = Accounts::theme_color();
        return view('reports.birthday-celebrants',['report_data' => $report_data,'month_name' => $month_name,'color' => $color]);
    }

    public function employees_age_list($from,$to){

        $report_data = Accounts::employees_age_list($from,$to);
        $color = Accounts::theme_color();
        $age = "";
        if($from == $to){
            $age = $from;
        }else{
            $age = $from.' to '.$to;
        }
        SystemLogs::saveLogs('visited employees age list page!');
        return view('reports.employees-age-range',['report_data' => $report_data,'from' => $from,'to' => $to,'age' => $age,'color' => $color]);
    }

    public function employees_age_range(Request $request){
        $range = explode(",",$request->data);
        $report_data = Accounts::employees_age_list($range[0],$range[1]);


     if($range[1] == $range[0]){
            $age = $range[0];
        }else{
            $age = $range[0].' to '.$range[1];
        }

        $html =  view('reports.employees-age-table',['report_data' => $report_data,'from' => $range[0],'to' => $range[1]])->render();
        return response()->json(['html' => $html,'age' => $age,'from' => $range[0],'to' => $range[1]]);
    }

    public function employees_years_list($from,$to){
        $report_data = Accounts::employees_years_list($from,$to);
        $color = Accounts::theme_color();
        $years = "";
        if($from == $to){
        $years = $from;
        }else{
        $years = $from.' to '.$to;
        }
        SystemLogs::saveLogs('visited employees years of service list page!');
        return view('reports.employees-year-of-service-range',['report_data' => $report_data,'from' => $from,'to' => $to,'years' => $years,'color' => $color]);
    }   

    public function employees_years_range(Request $request){
        $range = explode(",",$request->data);
        $report_data = Accounts::employees_years_list($range[0],$range[1]);


     if($range[1] == $range[0]){
            $years = $range[0];
        }else{
            $years = $range[0].' to '.$range[1];
        }

        $html =  view('reports.employees-year-of-service-table',['report_data' => $report_data,'from' => $range[0],'to' => $range[1]])->render();
        return response()->json(['html' => $html,'years' => $years,'from' => $range[0],'to' => $range[1]]);
    }

    public function employees_list_menu(Request $request){
        
        // echo "<pre>"; print_r($request->all());exit;

        $gender = "0";
        $column = "all";
        $columndata = "";
        $report_data = Accounts::employees_list($gender);

        switch ($gender) {
            case '0': 
                $gender_name = "ALL";
                break;
            case '1':
                $gender_name = "MALE";
                break;
            case '2':
                $gender_name = "FEMALE";
                break;
            
            default:
                # code...
                break;
        } 

            $color = Accounts::theme_color();
            SystemLogs::saveLogs('visited employees list page!');
            return view('reports.employees-gender-list',['report_data' => $report_data, 'gender' => $gender, 'gender_name' => $gender_name, 'column' => $column, 'columndata' => $columndata, 'color' => $color]);
    }


    public function employees_list(Request $request){
        
        // echo "<pre>"; print_r($request->all());exit;

            $validation = Validator::make($request->all(), [
  
            'gender' => 'required',
            'column' => 'required'
            ]);


            if($validation->passes())

            {
        
                if ($request->gender == "" && $request->column == "" && $request->columndata == "") {
                $gender = "0";
                $report_data = Accounts::employees_list($gender);

                } elseif ($request->gender == "" && $request->column == "") {
                    $gender = "0";
                    $column = "";
                    $columndata = $request->columndata;
                    $report_data = Accounts::employees_list_coldata($gender, $column, $columndata);

                } elseif ($request->column == "" && $request->columndata == "") {
                    $gender = $request->gender;
                    $report_data = Accounts::employees_list($gender);

                } elseif ($request->gender == "" && $request->columndata == "") {
                    $gender = "0";
                    $report_data = Accounts::employees_list($gender);

                } elseif ($request->column == "all") {
                    $gender = "0";
                    $column = $request->column;
                    $columndata = $request->columndata;
                    $report_data = Accounts::employees_list_coldata($gender, $column, $columndata);

                } elseif ($request->gender == "") {
                    $gender = "0";
                    $column = $request->column;
                    $columndata = $request->columndata;
                    $report_data = Accounts::employees_list_gen_col_coldata($gender, $column, $columndata);

                } elseif ($request->column == "") {
                    $gender = $request->gender;
                    $column = "";
                    $columndata = $request->columndata;
                    $report_data = Accounts::employees_list_gen_coldata($gender, $column, $columndata);

                } elseif ($request->columndata == "") {
                    $gender = $request->gender;
                    $column = $request->column;
                    $report_data = Accounts::employees_list($gender);

                } else {
                    $gender = $request->gender;
                    $column = $request->column;
                    $columndata = $request->columndata;
                    $report_data = Accounts::employees_list_gen_col_coldata($gender, $column, $columndata);
                }

                switch ($gender) {
                    case '0': 
                        $gender_name = "ALL";
                        break;
                    case '1':
                        $gender_name = "MALE";
                        break;
                    case '2':
                        $gender_name = "FEMALE";
                        break;
                    
                    default:
                        # code...
                        break;
                } 
                
                $color = Accounts::theme_color();
                SystemLogs::saveLogs('visited employees list page!');
                return view('reports.employees-gender-list',['report_data' => $report_data, 'gender' => $gender, 'gender_name' => $gender_name, 'column' => $request->column, 'columndata' => $request->columndata, 'color' => $color]);

            } else {

                $gender = "0";
                $report_data = Accounts::employees_list($gender);

                switch ($gender) {
                    case '0': 
                        $gender_name = "ALL";
                        break;
                    case '1':
                        $gender_name = "MALE";
                        break;
                    case '2':
                        $gender_name = "FEMALE";
                        break;
                    
                    default:
                        # code...
                        break;
                }

                $color = Accounts::theme_color();
                SystemLogs::saveLogs('visited employees list page!');
                return view('reports.employees-gender-list',['report_data' => $report_data, 'gender' => $gender, 'gender_name' => $gender_name, 'column' => $request->column, 'columndata' => $request->columndata, 'color' => $color]);
            }
    }


    public function audit_trail($id){
        switch ($id) {
            case 'all':
                $type = "admin";
                $uid = "";
                $report_data = SystemLogs::audit_trail_all();
                break;
            
            default:
                $type = "user";
                $uid = Auth::user()->id;
                $report_data = SystemLogs::find_audit_trail(decrypt($id));
                break;
        }
        SystemLogs::saveLogs('visited audit trail page!');
        $color = Accounts::theme_color();
        return view('reports.audit-trail', ['report_data' => $report_data,'type' => $type,'uid' => $uid,'color' => $color]);
    }

    public function pdf_service_record(Request $request){

        // echo '<pre>';
        // print_r($request->all());exit;
        if ($request->option == "service_record")
        {

            $user = PersonalInformation::get_user_data(decrypt($request->uid));
           
            $array = $request->id;

            if(!$array){
              session()->flash('msg','No service record selected!');
                return redirect()->back();
            }
            
            foreach ($array as $key => $value) {
                $id[] = decrypt($value);
            }
            
            $service_record = WorkExperience::whereIn('id',$id)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'asc')->get();
          

            if(Auth::user()->id == decrypt($request->uid)){
                $gender = Accounts::find_gender(Auth::user()->gender);
                SystemLogs::saveLogs('generated pdf '.$gender.' service record!');
            }else{
                $name = PersonalInformation::get_name(decrypt($request->uid));
                SystemLogs::saveLogs('generated pdf '.$name.' service record!');
            }

            $mytime = Carbon::now();
            $dateNow = $mytime->toDateTimeString();
            $dateNow = date("F d, Y",strtotime($dateNow));

            $pdf = PDF::loadView('reports.service-record',['service_record' => $service_record,'user' => $user,'dateNow' => $dateNow ])->setPaper('A4');
            return $pdf->stream('service-record','.pdf');

        }else{

            $user = PersonalInformation::get_user_data(decrypt($request->uid));
           
            $array = $request->id;

            if(!$array){
              session()->flash('msg','No service record selected!');
                return redirect()->back();
            }
            
            foreach ($array as $key => $value) {
                $id[] = decrypt($value);
            }
            
            $service_record = WorkExperience::whereIn('id',$id)->orderBy(DB::raw("DATE_FORMAT(inclusive_date_from,'%Y-%m-%d')"), 'asc')->get();
          

            if(Auth::user()->id == decrypt($request->uid)){
                $gender = Accounts::find_gender(Auth::user()->gender);
                SystemLogs::saveLogs('generated pdf '.$gender.' service record!');
            }else{
                $name = PersonalInformation::get_name(decrypt($request->uid));
                SystemLogs::saveLogs('generated pdf '.$name.' service record!');
            }

            $mytime = Carbon::now();
            $dateNow = $mytime->toDateTimeString();
            $dateNow = date("F d, Y",strtotime($dateNow));

            // echo "<pre>";
            // print_r($service_record);exit;

            $pdf = PDF::loadView('reports.work-experience-sheet',['service_record' => $service_record,'user' => $user,'dateNow' => $dateNow ])->setPaper([0,0,612,936],'portrait');
            return $pdf->stream('work-experience-sheet','.pdf');
        }
    }

    // public function service_record_cert_one(Request $request){
    //     SystemLogs::saveLogs('generated pdf service record certification type A!');
    //     $pdf = PDF::loadView('reports.certification-one',['data' => $request->certification_content])->setPaper('A4');
    //     return $pdf->stream('certificate-one','.pdf');
    // }

    public function service_record_cert(Request $request){
        $pdf = PDF::loadView('reports.certification',['data' => $request->certification_content])->setPaper('A4');
        return $pdf->stream('certificate','.pdf');
    }



}
