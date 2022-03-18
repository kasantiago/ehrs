<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Division extends Model
{
     protected $table = 'division';

     public static function name($id){
     	if($id != 0){
     		$find = DB::table('division')->where('id',$id)->first();
     		return $find->name;
     	}
     }

     public static function list(){
     	   $find = DB::table('division')->where('flag',1)->orderBy('name','asc')->get();
     	   return $find;
     }

    public static function get_division(){
     $division = DB::select("SELECT id,name as code,name FROM division WHERE name NOT LIKE '%/%';"); 
     return $division;
    }

    public static function get_unit(){
      $unit = DB::select("SELECT id,name as code,SUBSTRING_INDEX(name, '/',-1) as name FROM division WHERE flag = 1 ORDER BY name ASC");
      return $unit;
    }

    public static function leave_approval_setting($division){
        if($division){
            $find = DB::table("division")->where("name",$division)->first();
            if($find->leave_approval_setting == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
}
