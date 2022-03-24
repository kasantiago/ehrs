<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\User as User;
use Auth;
use DB;
use Carbon\Carbon as Carbon;
use App\Http\Models\AdminRequest as AdminRequest;

class Accounts extends Model
{
   protected $table = 'users';

   public static function first_login(){
     $update = User::find(Auth::user()->id);
     $update->first_login = 1;
     $update->save();
   }

   public static function get_name($uid){
      $name = User::find($uid);
      $name = $name->name;
      return $name;
   }

   public static function theme_color(){
      $user = DB::table('settings')
      ->select('id','user_id','themes')
      ->where('flag',1)->where('user_id', Auth::id())->first();
      
      if ($user){
        return ["bg-light-".$user->themes, "col-light-".$user->themes, "bg-".$user->themes, "col-".$user->themes, $user->themes];
      }else{
        return ["bg-light-green", "col-light-green", "bg-green", "col-green", "green"];
      }

   }

   public static function theme_update($theme){
    
    $find = DB::select("SELECT count(*) as cnt FROM settings WHERE user_id = ".Auth::id());
   
    if($find[0]->cnt){

      DB::table('settings')->where('user_id', Auth::id())->update(['themes' => $theme]);

    }else{

      DB::table('settings')->insert(
          ['user_id' =>  Auth::id(),'themes' => $theme]
      );

    }
   }

   public static function birthday_list($month){
      
      $user = DB::table('users')
      ->select('id','name','level','employee_status','division','position','gender','birthday')
      ->where('flag',1)->whereMonth('birthday', '=', $month)->where('role','user')->get();

      return $user;

   }

   public static function employees_age_list($from,$to){

       $query = DB::select("SELECT * FROM (SELECT id,name,level,employee_status,division,position,gender,birthday,TIMESTAMPDIFF(YEAR,birthday, CURDATE()) AS age, flag FROM users WHERE flag = 1 AND role = 'user') as temp_user_table WHERE age BETWEEN  ".$from." AND ".$to);
       return $query;
   }

  public static function employees_years_list($from,$to){

       $query = DB::select("SELECT * FROM (SELECT id,name,level,employee_status,division,position,gender,IF(IFNULL(years_render, '') = '', 0, years_render) as years_render FROM (SELECT id,name,level,employee_status,division,position,gender,(SELECT CAST(SUM((SELECT TIMESTAMPDIFF(DAY, inclusive_date_from, IF(inclusive_date_to = 'PRESENT',CURDATE(),STR_TO_DATE(inclusive_date_to, '%m/%d/%Y')))) / 365) as INT) as years_of_service FROM work_experience as we WHERE we.user_id = u.id AND tag_work = 'dohro2' ) as years_render ,flag FROM users as u WHERE flag = 1 AND role = 'user') as temp_user_table) as employees_years_of_service WHERE years_render BETWEEN  ".$from." AND ".$to);
       return $query;
   }

    public static function employees_list($gender){
    
    if($gender){
      $user = DB::select("SELECT id, name, level, employee_status, division, position, gender, birthday, (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) as civil_status FROM users as u WHERE u.flag = 1 AND u.gender = $gender AND u.role = 'user'");
      // $user = DB::table('users')
      //   ->select('id','name','level','employee_status','division','position','gender','birthday')
      //   ->where('flag',1)
      //   ->where('gender', '=', $gender)
      //   ->where('role','user')->get();
    }else{
      $user = DB::select("SELECT id, name, level, employee_status, division, position, gender, birthday, (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) as civil_status FROM users as u WHERE u.flag = 1 AND u.role = 'user'");
      // $user = DB::table('users')
      //   ->select('id','name','level','employee_status','division','position','gender','birthday')
      //   ->where('flag',1)
      //   ->where('role','user')->get();
    }
    return $user;

    }

    public static function employees_list_coldata($gender, $column, $columndata){

      if ($column = "all") {

        $user = DB::select("SELECT id, name, level, employee_status, division, position, gender, birthday, (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) as civil_status FROM users as u WHERE name LIKE '%$columndata%' OR level LIKE '%$columndata%' OR employee_status LIKE '%$columndata%' OR division LIKE '%$columndata%' OR position LIKE '%$columndata%' OR gender LIKE '%$columndata%' OR birthday LIKE '%$columndata%' AND u.flag = 1 AND u.gender != 0 AND u.role = 'user'");
        return $user;
      
      }else{

        $user = DB::select("SELECT id, name, level, employee_status, division, position, gender, birthday, (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) as civil_status FROM users as u WHERE $column LIKE '%$columndata%' AND u.flag = 1 AND u.gender = $gender AND u.role = 'user'");
        return $user;

      }

    }

    public static function employees_list_gen_coldata($gender, $column, $columndata){
      
      if ($gender == 0) {

        $user = DB::select("SELECT id, name, level, employee_status, division, position, gender, birthday, (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) as civil_status FROM users as u WHERE name LIKE '%$columndata%' OR level LIKE '%$columndata%' OR employee_status LIKE '%$columndata%' OR division LIKE '%$columndata%' OR position LIKE '%$columndata%' OR gender LIKE '%$columndata%' OR birthday LIKE '%$columndata%' AND u.flag = 1 AND u.gender = 1 OR u.gender = 2 AND u.role = 'user'");
        return $user;

      }else{

        $user = DB::select("SELECT id, name, level, employee_status, division, position, gender, birthday, (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) as civil_status FROM users as u WHERE name LIKE '%$columndata%' OR level LIKE '%$columndata%' OR employee_status LIKE '%$columndata%' OR division LIKE '%$columndata%' OR position LIKE '%$columndata%' OR gender LIKE '%$columndata%' OR birthday LIKE '%$columndata%' AND u.flag = 1 AND u.gender = $gender AND u.role = 'user'");
        return $user;

      }

    }

    public static function employees_list_gen_col_coldata($gender, $column, $columndata){
    
      if ($gender == 0) {

        $user = DB::select("SELECT * FROM (SELECT id, name, level, employee_status, division, position, gender, birthday, flag, role, (CASE (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) WHEN 1 THEN 'single' WHEN 2 THEN 'widowed' WHEN 3 THEN 'married' WHEN 4 THEN 'separated' WHEN 5 THEN 'other/s' ELSE '0' END) as civil_status FROM users as u ) as usr_tbl WHERE $column LIKE '%$columndata%' AND flag = 1 AND gender = 1 OR gender = 2 AND role = 'user'");
        return $user;

        }else{

        $user = DB::select("SELECT * FROM (SELECT id, name, level, employee_status, division, position, gender, birthday, flag, role, (CASE (SELECT civil_status FROM personal_information as pi WHERE pi.user_id = u.id) WHEN 1 THEN 'single' WHEN 2 THEN 'widowed' WHEN 3 THEN 'married' WHEN 4 THEN 'separated' WHEN 5 THEN 'other/s' ELSE '0' END) as civil_status FROM users as u ) as usr_tbl WHERE $column LIKE '%$columndata%' AND flag = 1 AND gender = $gender AND role = 'user'");
        return $user;

      }

    }

   public static function employees_table(){
    return DB::table('users')->select('id','name','level','photo','employee_status','division','position')->where('flag',1)->where('role','user')->get();
   }


   public static function all_employees_table(){
    return DB::table('users')->select('id','name','level','photo','employee_status','division','position')->where('flag',1)->get();
   }

   public static function active_pds_report_employees_table(){
     if(AdminRequest::system_settings() == 1){  
         $query = self::employees_table();
     }else{
         $query = DB::select("SELECT * FROM (SELECT id,name,level,photo,employee_status,division,position,(SELECT pds FROM admin_request as ar WHERE ar.user_id = u.id  ) as pds from users as u WHERE u.flag = 1 AND u.role = 'user') as pds_request_table WHERE pds = 2");
     }
     return $query;
  
   }

   public static function users_id(){
    return DB::table('users')->select('id')->where('flag',1)->where('role','user')->get();
   }

   public static function find_gender($gender){
    switch ($gender) {
      case 1:
        return 'his';
        break;
      case 2:
        return 'her';
        break;
      default:
        return 'his/her';
        break;
    }
   }


   public static function create_settings($uid)
   {
      DB::table('settings')->insert(
          ['user_id' => $uid,'themes' => 'green']
      );

   }

    public static function create_admin_request($uid)
   {
      DB::table('admin_request')->insert(
          ['user_id' => $uid,'pds' => 0,'ssalnw' => 0]
      );

   }


   public static function profile($uid){

    $users = DB::select("SELECT IF(photo IS NOT NULL,CONCAT('/storage/avatars/',photo),'/admin-assets/images/user.png') as photo FROM users WHERE id = ".$uid);
    if($users){
      return $users[0]->photo;
    }
   }

   public static function verification_code($length = 6) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
      $rand = mt_rand(0, $max);
      $str .= $characters[$rand];
    }
    return $str;
  }

  public static function accounts($user_id = "")
    {
    if ($user_id)
      {
      $user_id = $user_id;
      }
      else
      {
      $user_id = Auth::id();
      }
    $users = DB::select("SELECT * FROM (SELECT id as uid, name, IF(photo IS NOT NULL,CONCAT('/storage/avatars/',photo),'/admin-assets/images/user.png') as photo FROM users) as users WHERE uid NOT IN (" . $user_id . ")");
    $arr = [];
    for ($count = 0; $count <= count($users) - 1; $count++)
      {
      $data = new \stdClass();
      $data->uid = $users[$count]->uid;
      $data->name = $users[$count]->name;
      $data->photo = $users[$count]->photo;
      $arr[] = $data;
      }
    return json_encode($arr);
    }

    public static function accounts_selected($user_id)
    {
    $users = DB::select("SELECT * FROM (SELECT id as uid, name, IF(photo IS NOT NULL,CONCAT('/storage/avatars/',photo),'/admin-assets/images/user.png') as photo FROM users) as users ");
    $arr = [];
    for ($count = 0; $count <= count($users) - 1; $count++)
      {
      $data = new \stdClass();
      $data->uid = $users[$count]->uid;
      $data->name = $users[$count]->name;
     
      if($user_id == $users[$count]->uid){
        $data->selected = 'true';
      }else{
        $data->selected = 'false';
      }
       $data->photo = $users[$count]->photo;
      $arr[] = $data;
      }

     return json_encode($arr);
    }

    public function division_name(){
      return $this->belongsTo('App\Http\Models\Division','division_id','id');
    }
}
