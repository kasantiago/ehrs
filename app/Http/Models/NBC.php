<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class NBC extends Model
{
    protected $table = 'national_budget_circular'; 

    public static function autocompute($grade,$step){
    	if($step && $grade){
    		$find = DB::select("SELECT step".$step." FROM national_budget_circular WHERE salary_grade = ".$grade);
    		$fieldname = "step".$step;
    		return $find[0]->$fieldname;
    	}
    }
}
