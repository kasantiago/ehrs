<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeStatus extends Model
{
     protected $table = 'employee_status';

     public static function name($id){
     	if($id != 0){
     		$find = DB::table('employee_status')->where('id',$id)->first();
     		return $find->name;
     	}
     }

     public static function list(){
     	   $find = DB::table('employee_status')->where('flag',1)->orderBy('name','asc')->get();
     	   return $find;
     }
}
