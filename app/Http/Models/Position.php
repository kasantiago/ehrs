<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Position extends Model
{
     protected $table = 'position';

     public static function name($id){
     	if($id != 0){
     		$find = DB::table('position')->where('id',$id)->first();
     		return $find->name;
     	}
     }

     public static function list(){
     	   $find = DB::table('position')->where('flag',1)->orderBy('name','asc')->get();
     	   return $find;
     }
}
