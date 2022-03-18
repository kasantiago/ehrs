<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\WorkExperience as WorkExperience;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\AdminRequest as AdminRequest;
use App\User as User;
use Auth;

class ServiceRecordController extends Controller
{
    public function index(){
      
       //$full_name = PersonalInformation::get_name(1);
	
    	$users = Accounts::employees_table();
        $color = Accounts::theme_color();

        foreach ($users as $key => $value) { 
            $data[$key] = $value;
        }

        for ($cnt = 0; $cnt <= count($users) -1; $cnt++) { 
            $data[$cnt]->view = url('reports/service-record/list/all/'.encrypt($data[$cnt]->id));
            $data[$cnt]->view_title = 'View';
            $data[$cnt]->view_title_request = 'Send Request';
            $data[$cnt]->view_request_status = 'Active';
            $data[$cnt]->view_status = 'Denied';
            $data[$cnt]->view_coe_status = 'Denied';
            $data[$cnt]->certification = url('reports/service-record/work-exp/'.encrypt($data[$cnt]->id));
            $data[$cnt]->certification_title = 'COE';
        }
        
        $s = count($users) > 1 ? "s" : "";
        SystemLogs::saveLogs('visited employees service record'.$s.' page!'); 
        return view('service-records-page',['users' => $users, 'color' => $color]);
    }

  

    public function service_record_list_selected($govt_service,$uid){
       

        $work_experience_find = WorkExperience::find_data_selected($govt_service,decrypt($uid));
        $color = Accounts::theme_color();
      
        if(!$work_experience_find){
            session()->flash('msg','No work experience record found!');
            return redirect()->back();
        }

        if($work_experience_find){
            $work_experience = WorkExperience::get_data_selected($govt_service,decrypt($uid));
        }

        $s = $work_experience_find > 1 ? "s" : "";
        switch ($govt_service) {
            case 'y':
                
                $title = "Goverment service record".$s." are shown!";
                break;
            case 'n':
               
                 $title = "Non-Goverment service record".$s." are shown!";
                break;
            
            default:
                 $title = "All service record".$s." are shown!";
                break;
        }

        if(Auth::user()->id == decrypt($uid)){
            $gender = Accounts::find_gender(Auth::user()->gender);
            SystemLogs::saveLogs('visited '.$gender.' service record'.$s.' page!');
        }else{
            $name = PersonalInformation::get_name(decrypt($uid));
            SystemLogs::saveLogs('visited '.$name.' service record'.$s.' page!');
        }
        
        return view('service-records-list',['work_experience' => $work_experience,'uid' => decrypt($uid),'title' => $title, 'color' => $color]);

    }

    public function service_record_work_exp($uid){

    $work_experience_find = WorkExperience::find_data_department(decrypt($uid));
    $color = Accounts::theme_color();
      
        if(!$work_experience_find){
            session()->flash('msg','No work experience record found!');
            return redirect()->back();
        }

        $work_experience = WorkExperience::generate_blank_data();
        if($work_experience_find){
            $work_experience = WorkExperience::get_data_department(decrypt($uid));
        }

         $s = $work_experience_find > 1 ? "s" : "";

        if(Auth::user()->id == decrypt($uid)){
            $gender = Accounts::find_gender(Auth::user()->gender);
            SystemLogs::saveLogs('visited '.$gender.' service record'.$s.' page!');
        }else{
            $name = PersonalInformation::get_name(decrypt($uid));
            SystemLogs::saveLogs('visited '.$name.' service record'.$s.' page!');
        }
        
        return view('service-records-work-exp',['work_experience' => $work_experience,'uid' => decrypt($uid),'color' => $color]);

    }

    public function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }

    public function service_record_certification($id){

        $work = WorkExperience::find(decrypt($id));
        $s = WorkExperience::find(decrypt($id))->count();
        $s = $s > 1 ? "s" : "";

        $num = $work->service_record_salary;
        $service_record_salary = self::convertNumberToWord($num);
        // $cents = substr($work->service_record_salary, -2);

        $decimal = "";
        $money = explode('.', $work->service_record_salary);

        $whole = self::convertNumberToWord($money[0]);
        if($money[1] == 00){
            $combination = $whole.'Pesos';
        }else{
            $decimal = self::convertNumberToWord($money[1]);
            $combination = $whole.'Pesos and '.$decimal.'Centavos';
        }

        SystemLogs::saveLogs('visited service record'.$s.' certification page!');
        $color = Accounts::theme_color();
        return view('service-records-certification',['work' => $work, 'service_record_salary' => ucwords($combination),'color' => $color]);

    }

    public function service_record_update(Request $request){

                $save = WorkExperience::find(decrypt($request->id));

                 if($request->service_record_salary){
                    $save->service_record_salary = str_replace( ',', '', $request->service_record_salary);
                 }
                 $save->pay = strtoupper($request->pay);
                 $save->cause = strtoupper($request->cause);

            

                 if($save->save()) {

                     if(Auth::user()->id == $save->user_id){
                        $gender = Accounts::find_gender(Auth::user()->gender);
                        SystemLogs::saveLogs('has successfully updated '.$gender.' service record!');
                    }else{
                        $name = PersonalInformation::get_name($save->user_id);
                        SystemLogs::saveLogs('has successfully updated '.$name.' service record!');
                    }
                                                
                    // ProgressBar::work_experience($request->all(),'work_experience',$uid);
                    // SystemLogs::saveLogs('has successfully updated service records!'); 

                    $msg = ' service record has been successfully!';

                    $data= new \stdClass();
                    $data->id = $save->id;
                    $data->service_record_salary = $request->service_record_salary;
                    $data->pay = strtoupper($request->pay);
                    $data->cause = strtoupper($request->cause);
                      // $request->session()->flash('msg', $msg);
                      return response()->json([ 'success' => true,'message' => $msg,'data' => $data  ]);
                 }
                

             

                $errors = $validation->errors();
                $errors =  json_decode($errors); 
                
                return response()->json(['success' => false,'message' => $errors]);
    }

}
