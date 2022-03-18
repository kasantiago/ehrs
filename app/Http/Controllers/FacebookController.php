<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NotificationChannels\Facebook\FacebookMessage;
class FacebookController extends Controller
{
    public function push_facebook(Request $request){
    	FacebookMessage::create('You have just paid your monthly fee! Thanks')->to("2147036688652583");
    }
}
