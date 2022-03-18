<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Request;
use Carbon\Carbon;
use Auth;
use App\User as User;
use Session;

class AdminRequest extends Model
{

    protected $table = 'admin_request';

    public static function send_request($user_id){

          switch (Request::segment(1)) {

            case 'personal-data-sheet-table':

               DB::table('admin_request')->where('user_id',$user_id)->update(['pds' => 1,'updated_at' =>  Carbon::now()]);

            break;

            case 'reports':

               DB::table('admin_request')->where('user_id',$user_id)->update(['pds' => 1,'updated_at' =>  Carbon::now()]);

            break;

            case 'sworn-statement-assets-liabilities-net-worth':

               DB::table('admin_request')->where('user_id',$user_id)->update(['ssalnw' => 1,'updated_at' =>  Carbon::now()]);
                
            break;

            default:
            
            break;
        }

      
    }

    public static function reply_request($user_id){
       
       switch (Request::segment(1)) {

            case 'personal-data-sheet-table':

                DB::table('admin_request')->where('user_id',$user_id)->update(['pds' => 2,'updated_at' =>  Carbon::now()]);

            break;

            case 'sworn-statement-assets-liabilities-net-worth':

                DB::table('admin_request')->where('user_id',$user_id)->update(['ssalnw' => 2,'updated_at' =>  Carbon::now()]);
                
            break;

            default:
            
            break;
        }

    }


    public static function request_reply($user_id,$response){


       switch (Request::segment(1)) {

            case 'personal-data-sheet-table':


                DB::table('admin_request')->where('user_id',$user_id)->update(['pds' => $response,'updated_at' =>  Carbon::now()]);

            break;

            case 'sworn-statement-assets-liabilities-net-worth':

                DB::table('admin_request')->where('user_id',$user_id)->update(['ssalnw' => $response,'updated_at' =>  Carbon::now()]);
                
            break;

            default:
            
            break;
        }
    }

    
    public static function system_settings(){
        switch (Request::segment(1)) {

            case 'personal-data-sheet-table':

             $system_settings = DB::table('system_settings')->where('settings','pds_request')->first();
             return $system_settings->action;

            break;

            case 'sworn-statement-assets-liabilities-net-worth':

             $system_settings = DB::table('system_settings')->where('settings','ssalnw_request')->first();
             return $system_settings->action;
                
            break;

            default:

                return 1;
            
            break;
        }
    }


    public static function admin_request($user_id){
    
        switch (Request::segment(1)) {

            case 'personal-data-sheet-table':

             $system_settings = DB::table('system_settings')->select("action")->where('settings','pds_request')->first();

             if($system_settings->action == 1){

                $request = DB::table('admin_request')->select("pds")->where('user_id',$user_id)->first(); // ->whereDate('updated_at', DB::raw('CURDATE()'))

                return $request->pds;
                
             }


            break;


            case 'reports':

             $system_settings = DB::table('system_settings')->select("action")->where('settings','pds_request')->first();

             if($system_settings->action == 1){

                $request = DB::table('admin_request')->select("pds")->where('user_id',$user_id)->first(); // ->whereDate('updated_at', DB::raw('CURDATE()'))

                return $request->pds;
                
             }


            break;

           
            case 'sworn-statement-assets-liabilities-net-worth':

             $system_settings = DB::table('system_settings')->select("action")->where('settings','ssalnw_request')->first();

             if($system_settings->action == 1){

                $request = DB::table('admin_request')->select("ssalnw")->where('user_id',$user_id)->first(); // ->whereDate('updated_at', DB::raw('CURDATE()'))

                return $request->ssalnw;
                
             }


            break;



            default:

                return 1;
            
                break;
        }

    }


    public static function secure_page($uid){
     
            switch (Request::segment(1)) {

            case 'personal-data-sheet':

                $user_id = decrypt($uid);
                if($user_id != Auth::id()){
                
                        $isAdmin = User::find(Auth::id());

                        if($isAdmin->role == "admin"){

                              $isSettings = DB::table("system_settings")->where('settings','pds_request')->first();

                                if($isSettings->action == 0){
                                           
                                  DB::table('admin_request')->where('user_id',$user_id)->update(['pds' => 0,'updated_at' =>  Carbon::now()]);
                                  
                                  return true;
                                }else{

                                  if($isSettings->action == 1){

                                          $adminRequest = DB::table("admin_request")->select("pds")->where("user_id",$user_id)->first();

                                          if($adminRequest->pds == 2){
                                              
                                               if(Request::segment(2) == 'download'){
                                             
                                                  DB::table('admin_request')->where('user_id',$user_id)->update(['pds' => 0,'updated_at' =>  Carbon::now()]);
                                               }
                                               return true;
                                          }else{
                                             $msg = "Request to access the Personal Information Sheet is not yet accepted!";
                                          }

                                  }else{
                                      $msg = "Personal Data Sheet is not available!";
                                  }
                                }


                        }else{
                            $msg = "Your not allowed to access this content!";
                        }


                        
                }else{

                     return true;
                }

                Session::flash('msg',$msg);
                return false;

            break;

            case 'sworn-statement-assets-liabilities-net-worth':

              $user_id = decrypt($uid);
                if($user_id != Auth::id()){
                
                        $isAdmin = User::find(Auth::id());

                        if($isAdmin->role == "admin"){

                              $isSettings = DB::table("system_settings")->where('settings','ssalnw_request')->first();

                                if($isSettings->action == 0){
                                           
                                  DB::table('admin_request')->where('user_id',$user_id)->update(['ssalnw' => 0,'updated_at' =>  Carbon::now()]);
                                  
                                  return true;
                                }else{

                                  if($isSettings->action == 1){

                                          $adminRequest = DB::table("admin_request")->select("ssalnw")->where("user_id",$user_id)->first();

                                          if($adminRequest->ssalnw == 2){
                                              
                                               if(Request::segment(2) == 'download'){
                                             
                                                  DB::table('admin_request')->where('user_id',$user_id)->update(['ssalnw' => 0,'updated_at' =>  Carbon::now()]);
                                               }
                                               return true;
                                          }else{
                                             $msg = "Request to access the Sworn Statement of Asset, Liabilities and Net Worth is not yet accepted!";
                                          }

                                  }else{
                                      $msg = "Sworn Statement of Asset, Liabilities and Net Worth is not available!";
                                  }
                                }


                        }else{
                            $msg = "Your not allowed to access this content!";
                        }


                        
                }else{

                     return true;
                }

                Session::flash('msg',$msg);
                return false;

            break;

            default:

                return 1;
            
            break;
        }
    }


    public static function request_expiration(){
        DB::select("UPDATE admin_request SET pds = 0 WHERE updated_at + INTERVAL 1 DAY >= now() AND pds = 2");
    }
}