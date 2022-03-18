<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use Mail;
use Carbon\Carbon as Carbon;
class EmailNotification extends Model
{
    
    protected $table = 'email_sender';

    public static function get_email($uid){
    	if(!$uid){
    		return "";
    	}

    	$user = "";
        $user = DB::table('users')->where('gmail_notification',1)->where('id',$uid)->where('flag',1)->first();
        
        if($user){
        	return $user->email;
        }

        return Null;
    }

    public static function create_email_notifcation($subject,$body,$from_email,$from_name,$to_email,$to_name){
    	
    	if($to_email){
	    	$save = New EmailNotification;
	    	$save->subject = $subject;
	    	$save->body = $body;
	    	$save->from_email = $from_email;
	    	$save->from_name = $from_name;
	    	$save->to_email = $to_email;
	    	$save->to_name = $to_name;
    		$save->save();
    	}
    	
    }


    public static function push_email(){

   
		$find = EmailNotification::all();


	   foreach ($find as $key => $value) {
		$to_name = $value->to_name;

		$to_email = explode(", ", $value->to_email);

		$from_email = $value->from_email;
		$from_name = $value->from_name;

		$system_name = env("PROJECT_TITLE"); 
		$system_description = env("PROJECT_DESCRIPTION")." Message Notification";


		$now = Carbon::now();
		$meridies = $now->format('A');


		$data = array('form'=> $from_name, "body" => $value->body, "meridies" => $meridies);

		Mail::send(['html' => 'emails.mail'], $data, function($message) use ($system_name,$system_description,$to_name, $to_email,$from_email,$from_name) {
		$message->to($to_email, $to_name)
		     ->subject($system_description);
		$message->from($from_email,$system_name);
		});

		$find = EmailNotification::find($value->id);
			if($find){
				$find->delete(); 
			}
		}

        // dd("Testing Email!");//Sending Email
        // echo 1;exit;

    }
}
