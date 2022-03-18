<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Http\Models\SystemLogs as SystemLogs;
use Auth;

class SystemLogs extends Model
{
	protected $table = 'system_logs';

	public static function saveLogs($logs){
	  	$uid = Auth::user()->id;
	  	$name = Auth::user()->name;

		$save = New SystemLogs;
			$save->user_id = $uid;
			$save->name = $name;
			$save->logs = $logs;
			$save->save();
	}

	public static function audit_trail_all(){
	   // $find = DB::table('system_logs')->orderBy('created_at','desc')->limit(10000)->get();
	     $find = DB::select("SELECT * FROM system_logs ORDER BY created_at DESC LIMIT 1000");
	    return $find;
	}

	public static function find_audit_trail($id){
	    $find = DB::table('system_logs')->where('user_id',$id)->orderBy('created_at','desc')->get();
	    return $find;
	}

}