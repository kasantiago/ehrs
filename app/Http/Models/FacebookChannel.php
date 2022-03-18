<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use NotificationChannels\Facebook\FacebookMessage;

class FacebookChannel extends Model
{
    public static function push_facebook(){
    	FacebookMessage::create('You have just paid your monthly fee! Thanks')->to("2147036688652583");
    }
}
