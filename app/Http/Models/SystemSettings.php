<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SystemSettings extends Model
{
    public static function field($field){

    	$system = DB::table('system_settings')->where('settings',$field)->first();
    	return $system->action;
    	
    }
}
