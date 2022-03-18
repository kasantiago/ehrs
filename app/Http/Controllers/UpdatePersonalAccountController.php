<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use App\User as User;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;


class UpdatePersonalAccountController extends Controller
{
    public function name(){
    	$id = Auth::user()->id;
      $user = User::find($id);
      $color = Accounts::theme_color();
      return view('settings.accounts-update-name',['user' => $user,'color' => $color]);
    }


    public function update_name(Request $request)
    {
    
    SystemLogs::saveLogs('visited edit name page!'); 

      $validation = Validator::make($request->all(), [ 'name' => 'required',]);
      if($validation->passes())

        {
        
            $save = User::find(Auth::user()->id);
            $save->name = $request->name;

           
            SystemLogs::saveLogs('account name updated to '.$request->name.'.');


            if($save->save()) {
              $msg = Auth::user()->name.' account has been successfully updated name!';
              $request->session()->flash('msg', $msg);
                  return response()->json([ 'success' => true,'message' => $msg,'url' => url('dashboard') ]);

             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }


    public function email(){
      SystemLogs::saveLogs('visited edit email address page!'); 
        $id = Auth::user()->id;
        $user = User::find($id);
        $color = Accounts::theme_color();
        return view('settings.accounts-update-email',['user' => $user,'color' => $color]);
    }


   public function update_email(Request $request)
    {
    
      $validation = Validator::make($request->all(), [ 'email' => 'required|email|unique:users,email,'.Auth::user()->id,]);
      if($validation->passes())

        {
        
            $save = User::find(Auth::user()->id);
            $save->email = $request->email;

            if($save->save()) { 

              SystemLogs::saveLogs('account email address updated to '.$request->email.'.');

              $msg =  Auth::user()->name.' account has been successfully updated email address!';
              $request->session()->flash('msg', $msg);
                  return response()->json([ 'success' => true,'message' => $msg,'url' => url('dashboard') ]);

             }
        }

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }


    public function username(){
      SystemLogs::saveLogs('visited edit username page!'); 
        $id = Auth::user()->id;
        $user = User::find($id);
        $color = Accounts::theme_color();
        return view('settings.accounts-update-username',['user' => $user,'color' => $color]);
    }


   public function update_username(Request $request)
    {
    
      $validation = Validator::make($request->all(), [ 'username' => 'required|unique:users,username,'.Auth::user()->id,]);
      if($validation->passes())

        {
        
            $save = User::find(Auth::user()->id);
            $save->username = $request->username;

            if($save->save()) {

             SystemLogs::saveLogs('account username updated to '.$request->username.'.');

              $msg =   Auth::user()->name.' account has been successfully updated username!';
              $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' =>  $msg,'url' => url('dashboard') ]);

             }
        }

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }




   public function password(){
      SystemLogs::saveLogs('visited edit password page!'); 
        $id = Auth::user()->id;
        $user = User::find($id);
        $color = Accounts::theme_color();
        return view('settings.accounts-update-password',['user' => $user,'color' => $color]);
    }


   public function update_password(Request $request)
    {

      $validation = Validator::make($request->all(), [ 
        'password'         => 'required',
        'password_confirm' => 'required|same:password' 
      ]);

     if (Hash::check($request->current_password,Auth::user()->password)) {
      	

      if($validation->passes())

        {
        
            $save = User::find(Auth::user()->id);
            $save->password = bcrypt($request->password);

            if($save->save()) {

             SystemLogs::saveLogs('account password has been successfully changed!'); 
              
              $msg = Auth::user()->name.', you successfully changed your password!';
              $request->session()->flash('msg', $msg );
                  return response()->json([ 'success' => true,'message' => $msg,'url' => url('dashboard') ]);

             }
        }


        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        

	 }else{
	
	    $errors = $validation->getMessageBag()->add('current_password', 'Password did not match!');
        $errors =  json_decode($errors); 
       

	 }
	
       return response()->json(['success' => false,'message' => $errors]);

    }




  public function first_login(){
      $id = Auth::user()->id;
        $user = User::find($id);
        $color = Accounts::theme_color();
        return view('settings.accounts-update-first-login-password',['user' => $user,'color' => $color]);
  }


   public function update_first_login_password(Request $request)
    {

      $validation = Validator::make($request->all(), [ 
        'password'         => 'required',
        'password_confirm' => 'required|same:password' 
      ]);
     

      if($validation->passes())

        {
        
            $save = User::find(Auth::user()->id);
            $save->password = bcrypt($request->password);

            if($save->save()) {

               SystemLogs::saveLogs('account password has been successfully changed!'); 

              $msg = Auth::user()->name.', you successfully changed your password!';
              $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => $msg,'url' => url('dashboard') ]);

             }
        }

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
    
  
       return response()->json(['success' => false,'message' => $errors]);

    }

    public function profile_picture(){
      SystemLogs::saveLogs('visited edit profile picture page!'); 
        $id = Auth::user()->id;
        $user = User::find($id);
        $color = Accounts::theme_color();
        return view('settings.accounts-update-profile-picture',['user' => $user,'color' => $color]);
    }


    public function update_profile_picture(Request $request)
    {

       $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        $user = Auth::user();

        Storage::disk('uploads')->delete('avatars/'.$user->photo);
 
        $avatarName = $user->id.''.time().'.'.request()->avatar->getClientOriginalExtension();
 
        $request->avatar->storeAs('avatars',$avatarName);
 
        $user->photo = $avatarName;
        $user->save();

        SystemLogs::saveLogs('account profile picture has been changed!'); 
  
        $msg =  Auth::user()->name.' account has been successfully updated profile picture!';
        $request->session()->flash('msg',$msg);
        
        return redirect('dashboard')->with('success','You have successfully upload image.');
      
    }



    public function change_account($setting,Request $request){
      if(Auth::user()->dual_account == 1){
        $id = Auth::id();
        $save = User::find($id);

          switch ($setting) {
            case 'on':
                 
                     $save->role = 'admin';
                      SystemLogs::saveLogs('successfully switch account to administrator account!'); 
                      $msg = 'successfully change account to administrator account!';

              break;
            case 'off':
                 
                    $save->role = 'user';
                      SystemLogs::saveLogs('successfully switch account to user account!'); 
                      $msg = 'successfully change account to user account!';
              break;

            default:
             
              break;
          }

            if($save->save()) {

                    $request->session()->flash('msg',$msg);
                    return response()->json([ 'success' => true,'message' => $msg,'url' => url('dashboard') ]);
            }

      } 

            $msg = 'Something went wrong! <br> Your account cannot be converted to administrator.';
            $request->session()->flash('msg',$msg);
            return response()->json([ 'success' => false,'message' => $msg]);


    }

}
