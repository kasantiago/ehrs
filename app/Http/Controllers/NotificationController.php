<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Notifications as Notifications;
use Auth;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;
class NotificationController extends Controller
{
  	
	public function index(){

        SystemLogs::saveLogs('visited notifications page!');
        $color = Accounts::theme_color();
        $notifications = Notifications::get_mine_all(Auth::id());
        return view('notifications',['notifications' => $notifications,'color' => $color]);
	} 
    
    public function notification_list(){
   		$count = Notifications::unseen(Auth::id());
        $html =  view('layouts.notifications')->render();
        return response()->json(['html' => $html,'count' => $count]);
    }
    
    public function notification_seen(){
    	SystemLogs::saveLogs('has already seen notifications!');
    	Notifications::seen();
  	    return response()->json(['success' => true]);
    }
    public function task_list(){
        $count = Notifications::task_count(Auth::id());
        $html =  view('layouts.tasks')->render();
        return response()->json(['html' => $html,'count' => $count]);
    }
}
