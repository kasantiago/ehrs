<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Upload extends Model
{
    protected $table = 'ssalnw_archive';

    public static function insertData($data){

      	DB::table('employees_attendance')->insert($data);
    }
}
