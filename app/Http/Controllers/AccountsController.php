<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User as User;
use Validator;
use App\Http\Models\EmployeeStatus as EmployeeStatus;
use App\Http\Models\Division as Division;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\Position as Position;
use App\Http\Models\SystemLogs as SystemLogs;
use Auth;
use App\Http\Models\ProgressBar as ProgressBar;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\NBC as NBC;
use DB;
use Carbon\Carbon as Carbon;
use Mail;
use Session;
use Hash;
use App\FAQ;

class AccountsController extends Controller
{

  public function index(){

    SystemLogs::saveLogs('visited manage accounts page!'); 

    $color = Accounts::theme_color();
    $full_name = PersonalInformation::get_name(Auth::id());
    $users = User::where('flag',1)->where('role','!=','super-admin')->where('id','!=',Auth::user()->id)->get();
    return view('accounts-manage',['users' => $users, 'color' => $color]);
  }



    public function registration(){

    //  $nbc = NBC::autocompute()

      //SystemLogs::saveLogs('visited registration accounts page!');
      $color = Accounts::theme_color();

      $employee_status = EmployeeStatus::list();
      $division = Division::list();
      $position = Position::list();
      return view('accounts-registration',['employee_status' => $employee_status,'division' => $division,'position' => $position, 'color' => $color]);
    }


   public function for_approval(){

      SystemLogs::saveLogs('visited manage accounts page!'); 

      $color = Accounts::theme_color();
      $full_name = PersonalInformation::get_name(Auth::id());
      $users = User::where('flag',1)->where('role','!=','super-admin')->where('id','!=',Auth::user()->id)->where('status',2)->get();
      return view('accounts-for-approval',['users' => $users, 'color' => $color]);

    }
    


    public function registration_faq_store(Request $request){

      $validation = Validator::make($request->all(), [
  
            'faq' => 'required',
         
            ]);


      if($validation->passes())

        {

          $save = New FAQ;
          $save->faq = $request->faq;
          $save->save();

          $msg =  'Hello you have successfully send your inquiries to Human Resource!';
          $request->session()->flash('msg',$msg);
          return response()->json([ 'success' => true,'message' => 'record added','url' => url('registration') ]);

        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }


   public function registration_store(Request $request){

  

      $validation = Validator::make($request->all(), [
  
            'name' => 'required',
            'employee_number' => 'unique:users,employee_number',
            'employee_status' => 'required',
            'division' => 'required',
            'position' => 'required',
            'salary_grade' => 'required',
            'salary_amount' => 'required',
            'username' => 'required|unique:users,username',
            'biometric_id' => 'required',
            'biometric' => 'required',
            ]);


      if($validation->passes())

        {
        
            $save = New User;
            $save->name = $request->name;
            $save->employee_number = $request->employee_number;
            $save->email  = $request->email;
            $save->username = $request->username;
            $save->employee_status = $request->employee_status;
            $save->division = $request->division;
            $save->position = $request->position;
            $save->salary_grade = $request->salary_grade;
            $save->level = 3;
            $save->step_increment = $request->step_increment;
            $save->salary_amount = str_replace( ',', '', $request->salary_amount );
            $save->password = bcrypt(env('DEFAULT_PASSWORD'));
             $save->dual_account = 0;
            $save->biometric_id = $request->biometric_id;
            $save->biometric = $request->biometric;
            $save->dual_account = $request->dual_account; 
            $save->status = 2;
        
             if($save->save()) {

             ProgressBar::save_id_to_progress($save->id);
             Accounts::create_settings($save->id);
             Accounts::create_admin_request($save->id);

           //  SystemLogs::saveLogs('successfully created '.$request->name.' account!'); 
                  $msg =  'Hello '. $request->name .', you have successfully requested account to Human Resource! <br> Please wait for confirmation!';
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('login') ]);
             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }




    public function create(){

    //  $nbc = NBC::autocompute()

      SystemLogs::saveLogs('visited create accounts page!');
      $color = Accounts::theme_color();

      $employee_status = EmployeeStatus::list();
      $division = Division::list();
      $position = Position::list();
      return view('accounts-create',['employee_status' => $employee_status,'division' => $division,'position' => $position, 'color' => $color]);
    }

    public function store(Request $request){
      $validation = Validator::make($request->all(), [
  
            'name' => 'required',
            'employee_number' => 'unique:users,employee_number',
            'employee_status' => 'required',
            'division' => 'required',
            'position' => 'required',
            'salary_grade' => 'required',
            'salary_amount' => 'required',
            'username' => 'required|unique:users,username'
            ]);


      if($validation->passes())

        {
        
            $save = New User;
            $save->name = $request->name;
            $save->employee_number = $request->employee_number;
            $save->email  = $request->email;
            $save->username = $request->username;
            $save->employee_status = $request->employee_status;
            $save->division = $request->division;
            $save->position = $request->position;
            $save->salary_grade = $request->salary_grade;
            $save->level = $request->level;
            $save->step_increment = $request->step_increment;
            $save->salary_amount = str_replace( ',', '', $request->salary_amount );
            if($request->password){
                  $save->password = bcrypt($request->password);
            }else{
                  $save->password = bcrypt(env('DEFAULT_PASSWORD'));
            }

            $save->biometric_id = $request->biometric_id;
            $save->biometric = $request->biometric;
            $save->dual_account = $request->dual_account;


        
             if($save->save()) {

             ProgressBar::save_id_to_progress($save->id);
             Accounts::create_settings($save->id);
             Accounts::create_admin_request($save->id);


             SystemLogs::saveLogs('successfully created '.$request->name.' account!'); 

                  $msg =  $request->name.' account has been successfully added!';
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('accounts/manage') ]);
             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }

    public function edit($id){

        $id = decrypt($id);
        $user = User::find($id);
        $employee_status = EmployeeStatus::list();
        $division = Division::list();
        $position = Position::list();

        SystemLogs::saveLogs('visited edit '.$user->name.' accounts page!');
        $color = Accounts::theme_color();

        return view('accounts-edit',['user' => $user,'employee_status' => $employee_status,'division' => $division,'position' => $position,'color'=> $color]);
    }

    public function update(Request $request, $id)
    {
     
      $id = decrypt($id);

      $validation = Validator::make($request->all(), [
  
             'name' => 'required',
             'employee_status' => 'required',
             'employee_number' => 'unique:users,employee_number,'.$id,
             'division' => 'required',
             'position' => 'required',
             'salary_grade' => 'required',
             'salary_amount' => 'required',
             'username' => 'required|unique:users,username,'.$id

            ]);


      if($validation->passes())

        {
        
            $save = User::find($id);
            $save->name = $request->name;
            $save->email  = $request->email;
            $save->username = $request->username;
            $save->employee_status = $request->employee_status;
            $save->division = $request->division;
            $save->position = $request->position;
            $save->salary_grade = $request->salary_grade;
            $save->level = $request->level;
            $save->step_increment = $request->step_increment;
            $save->salary_amount = str_replace( ',', '', $request->salary_amount );

            
            $save->biometric_id = $request->biometric_id;
            $save->biometric = $request->biometric;
            $save->dual_account = $request->dual_account;


           if($request->password){
                  $save->password = bcrypt($request->password);
            }

             if($save->save()) {
              SystemLogs::saveLogs('successfully updated '.$request->name.' account!'); 
              $msg = $request->name.' account has been successfully updated!';
              $request->session()->flash('msg',$msg);

                  return response()->json([ 'success' => true,'message' => 'record updated','url' => url('accounts/manage') ]);

             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }

      public function destroy(Request $request, $id)
    {
        $id = decrypt($request->id);
        $update = User::find($id);
        $update->status = 0;
        $update->flag = 0;

        if($update->save()){

            DB::table('pds_progress_bar')->where('user_id',$id)->update(['flag' => 0]);

             SystemLogs::saveLogs('successfully deleted '.$update->name.' account!'); 
            $msg = '<strong><font size="3" color="green">'.$update->name.' account has been successfully deleted! </font></strong>';
            return response()->json(['success' => true,'message' => $msg,'page' => url('accounts/manage/table')]);
        }

        return response()->json(['success' => false,'message' => '<strong><font size="3" color="red">An error has occurred while  updating record! </font></strong>','page' => url('accounts/manage/table')]);

    }

  
    public function table(){
        $users = User::where('flag',1)->where('role','user')->get();
        $color = Accounts::theme_color();
        $html =  view('accounts-table',['users' => $users,'color' => $color])->render();
        return response()->json(['html' => $html]);
    }


    public function employees_table(){
        $users = Accounts::employees_table();
        $color = Accounts::theme_color();
        $html =  view('employees-table',['users' => $users,'color' => $color])->render();
        return response()->json(['html' => $html]);
    }

   public function change_status(Request $request)
    {
        $id = decrypt($request->id);
        $update = User::find($id);

        if($update->status == 1){
            $update->status = 0;
             DB::table('pds_progress_bar')->where('user_id',$id)->update(['flag' => 0]);
            $msg ="Block";
        }else{
            $update->status = 1;
            DB::table('pds_progress_bar')->where('user_id',$id)->update(['flag' => 1]);
            $msg ="Unblocked";
        }

        if($update->save()){

          SystemLogs::saveLogs($update->name.' account has been successfully '.strtolower($msg).'!'); 

            $msg = '<strong><font size="3" color="green">'.$update->name.' account has been successfully '.$msg.'! </font></strong>';
            return response()->json(['success' => true,'message' =>  $msg]);
        }
        return response()->json(['success' => false,'message' => '<strong><font size="3" color="red">An error has occurred while  updating record! </font></strong>']);

    }



   public function change_status_approved(Request $request)
    {
        $id = decrypt($request->id);
        $update = User::find($id);
        $update->status = 1;

        if($update->save()){

            SystemLogs::saveLogs($update->name.' account has been successfully activated!'); 

            $msg = '<strong><font size="3" color="green">'.$update->name.' account has been successfully activated! </font></strong>';
            return response()->json(['success' => true,'message' =>  $msg]);
        }

        return response()->json(['success' => false,'message' => '<strong><font size="3" color="red">An error has occurred while  updating record! </font></strong>']);

    }




    public function change_theme(Request $request){
      //echo '<pre>';
      //print_r($request->theme);exit;
    
      Accounts::theme_update($request->theme);
      return response()->json(['success' => true,'theme' =>  $request->theme]);
    }

    public function salary_autocompute(Request $request){

      $salary_grade = $request->salary_grade;
      $salary_step = $request->salary_step;

      $result = "";
      if($salary_grade && $salary_step){
        $result = NBC::autocompute($salary_grade,$salary_step);
        return response()->json(['success' => true,'salary' => number_format($result,2)]);
      }else{
        return response()->json(['success' => false]);
      }

  

    }

    public function gmail_notification(Request $request){
      $setting = $request->setting;
      switch ($setting) {
        case 'on':

          $code = Accounts::verification_code();
          $to_name = Auth::user()->name;
          $to_email = Auth::user()->email;
          $from_email = 'dohro2ehrs@gmail.com';
          $data = array('name'=>$to_name, "code" => $code);

          Mail::send('emails.email-verification', $data, function($message) use ($to_name, $to_email,$from_email) {
          $message->to($to_email, $to_name)
             ->subject('Email Notification Temporary Verification Code.');
          $message->from($from_email,'e-Hrs');
          });
         // dd("Message successfully send!");//Sending Email

          $update = User::find(Auth::id());
          $update->gmail_notification = 0;
          $update->gmail_code = $code;
          $update->gmail_created_at = Carbon::now()->toDateTimeString();
          $update->save();

           return response()->json(['success' => true,'switch' => 'on']);
         
          break;

        case 'off':

          $update = User::find(Auth::id());
          $update->gmail_notification = 0;
          $update->gmail_code = Null;
          $update->gmail_created_at = Null;
          $update->save();

          $msg = 'Email notifcation successfully deactivated!';
          SystemLogs::saveLogs($msg); 

          return response()->json(['success' => true,'switch' => 'off','msg' => 'Email notifcation successfully deactivated!']);
         
          break;
        
        
        default:
         
          break;
      }

       return response()->json(['success' => false]);

    }

    public function fb_messenger_notification(Request $request){

    }

    public function send_verification_code(Request $request){


       $code = User::find(Auth::id());
       $code = $code->gmail_code;

        $validation = Validator::make($request->all(), [
  
            'code' => 'required|unique:users,id,'.Auth::id().'|in:'.$code
  
            ]);


      if($validation->passes())

        {

          
          $find = DB::select("SELECT * FROM (SELECT id,(gmail_created_at + INTERVAL 15 MINUTE) as end_time FROM users WHERE id = ".Auth::id().") as tmpTable WHERE CURTIME() <= end_time");

          if(!$find){
             
              $data = new \stdClass();
              $data->code = ["The temporary code has already expired please send new code."];
               return response()->json(['success' => false,'message' => $data]);
          }


            $update = User::find(Auth::id());
            $update->gmail_notification = 1;
            $update->gmail_code = Null;
            $update->gmail_created_at = Null;
            $update->save();


            if($update->save()) {
              $msg = 'Email notifcation successfully activated!';
              SystemLogs::saveLogs($msg); 
              $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'successfully gmail notifcation successfully activated','url' => url()->previous() ]);

             }




        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }


  public function logout(Request $request){
    
    SystemLogs::saveLogs(Auth::user()->username.' account has logged out!');
    $request->session()->flash('eula');
    Auth::logout();
    return redirect('/login');
  }
  

  public function eula(Request $request){

    $eula = Session::get('eula');
    switch ($eula) {
      case 'accept':
          if(Auth::user()->first_login == 1){
             return redirect('dashboard');
          }else{
            Accounts::first_login();
            return redirect('manage-accounts/first-login');
          }

        break;
      default:
         return view('eula');
        break;
    }
    
  }

  public function eula_response(Request $request){
   
    $request->session()->put('eula', $request->eula);
    SystemLogs::saveLogs(' has '.$request->eula.'ed the END USER LICENSE AGREEMENT!');
    switch ($request->eula) {
      case 'accept':
            if(Auth::user()->first_login == 1){
               return redirect('dashboard');
            }else{
              Accounts::first_login();
              return redirect('manage-accounts/first-login');
            }
        break;
      case 'decline':
           Auth::logout();
           return redirect('/login');
        break;
      default:
          return redirect('eula');
        break;
    }
   
   
  }

  public function security_password(Request $request){

    $password = $request->password;

    switch ($password) {
      case 'cancel':
           return response()->json(['success' => false]);
        break;
      case 'false':
            //$errors = "Please fill up your current password!";
            //return response()->json(['success' => false,'message' => $errors]);
             return response()->json(['success' => false]);
        break;
      
      default:
            
            if(Hash::check($password, Auth::user()->password)){
              return response()->json(['success' => true]);
            }else{
              $errors = "Password didn't match!";
              return response()->json(['success' => false,'message' => $errors]);
            }

        break;
    }



  }

}