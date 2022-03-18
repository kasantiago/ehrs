<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Carbon\Carbon as Carbon;
// use App\Http\Models\PersonalInformation::get_name($value->id)



class Notifications extends Model
{
   protected $table = 'notifications';

     public static function menu(){
       	self::birthday();
        self::retiree();
        self::password();
       // self::insertMessage(['test']);
     }

     public static function birthday(){


           $users = DB::select("
                SELECT 
                id as table_id,
                CONCAT('It\'s ',name,'',' Birthday Today!') AS notification,
                'card_giftcard' as 'icon',
                photo
                FROM users
                WHERE DAY(birthday) = DAY(CURDATE())
                AND MONTH(birthday) = MONTH(CURDATE());
            ");


           self::insert($users);
      }

       public static function retiree(){


           $users = DB::select("
                SELECT 
                id as table_id,
                CONCAT(name,'',' is now 60 years Old !') AS notification,
                'star' as 'icon',
                photo
                FROM (SELECT id,name,photo,birthday,TIMESTAMPDIFF(YEAR,birthday, CURDATE()) AS age, flag FROM users WHERE flag = 1 AND role = 'user') as temp_user_table WHERE age = 27 AND     DAY(birthday) = DAY(CURDATE()) AND MONTH(birthday) = MONTH(CURDATE())
            ");


           self::insert($users);
      }


      public static function password(){
         
        if (password_verify(env('DEFAULT_PASSWORD'), Auth::user()->password)) {
            $users = New \stdClass();
            $users->table_id = Auth::user()->id;
            $users->notification = Auth::user()->name.' please change your default password!';
            $users->icon = 'warning';
            $users->photo = Auth::user()->photo;
             self::insert([$users]);
        }

      }


      public static function insert($data){
    
        $dateNow = Carbon::now()->toDateString(); 
       
        if($data){
           $insert = [];
            foreach($data as $row)
            {
        
              $find = DB::table('notifications')->where('icon',$row->icon)->where('user_id',Auth::id())->where('table_id',$row->table_id)->whereDate('created_at', $dateNow)->count();

              if(!$find){
                $draw = [
                    'table_id' =>$row->table_id,
                    'notification' => $row->notification,
                    'user_id' => Auth::id(),
                    'icon' => $row->icon,
                    'photo' => $row->photo,
                    'created_at' => Carbon::now()
                ];
                $insert[] = $draw;
              }
            }
            DB::table('notifications')->insert($insert);
        }
        

      }


      public static function insertMessage($user_id,$notification){

           $find = DB::table('users')->select('photo')->where('id',$user_id)->first();

            $insert = [
              'table_id' => '1',
              // /'notification' => str_limit($notification, $limit = 50, $end = '...'),
              'notification' => $notification,
              'user_id' => $user_id,
              'icon' => 'message',
              'photo' => $find->photo,
              'created_at' => Carbon::now()
            ];
            DB::table('notifications')->insert($insert);
      }

      public static function get_mine($id){

          $find = DB::table('notifications')->where('user_id',$id)->orderBy('id', 'desc')->take(10)->get();
          return $find;
      }

      public static function get_mine_all($id){

          $find = DB::table('notifications')->where('user_id',$id)->orderBy('id', 'desc')->get();
          return $find;
      }



     public static function time_elapsed_string($datetime, $full = false) {
         // $now = new \DateTime;
          //$ago = new \DateTime($datetime);
          $ago = new \DateTime($datetime);
          $now = new \DateTime(date("Y-m-d H:i:s"));
          $diff = $now->diff($ago);

          $diff->w = floor($diff->d / 7);
          $diff->d -= $diff->w * 7;


          $string = array(
              'y' => 'year',
              'm' => 'month',
              'w' => 'week',
              'd' => 'day',
              'h' => 'hour',
              'i' => 'minute',
              's' => 'second',
          );
          foreach ($string as $k => &$v) {
              if ($diff->$k) {
                  $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
              } else {
                  unset($string[$k]);
              }
          }


          if (!$full) $string = array_slice($string, 0, 1);

          return $string ? implode(', ', $string) . ' ago' : 'just now';
      }

      public static function icon_color($icon){
        switch ($icon) {
          case 'card_giftcard':
                return "#ff528d";
            break;
          case 'star':
                return "#ff9800";
            break;
          case 'message':
                return "#009688";
            break;
          case 'warning':
                return "#ff0000";
            break;
          default:
          
            break;
        }
      }

      public static function unseen_message($id){
          $find = DB::table('notifications')->where('icon','message')->where('user_id',$id)->where('seen',0)->count();
          return $find;
      }

      public static function unseen($id){
          $find = DB::table('notifications')->where('user_id',$id)->where('seen',0)->count();
          return $find;
      }

      public static function seen(){
        DB::table('notifications')->where('user_id', Auth::id())->update(['seen' => 1]);
      }

     public static function task($user_id){
      $find = DB::select("SELECT 'Percentage (%)' as x, personal_information as a, family_background as b, educational_background as c, civil_service_eligibility as d, work_experience as e, voluntary_work as f, learning_and_development as g, other_information as h, survey as i FROM pds_progress_bar as ppb WHERE ppb.user_id = $user_id");

      if(!$find){
        $data = new \stdClass();
        $data->x = "Percentage (%)"; // PHP creates  a Warning here
        $data->a = 0.00;
        $data->b = 0.00;
        $data->c = 0.00;
        $data->d = 0.00;
        $data->e = 0.00;
        $data->f = 0.00;
        $data->g = 0.00;
        $data->h = 0.00;
        $data->i = 0.00;

        return $data;
      }

        return $find[0];
    }

    public static function task_count($user_id){
      $task = self::task($user_id);
      $count = 0;
      foreach ($task as $key => $value) {
        if($value == 0.00){
          if($key != 'x'){
            $count++;
          }
        }
      }
      return $count;
    }
}
