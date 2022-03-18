<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;
use Carbon\Carbon as Carbon;

class Biometrics extends Model
{
     protected $table = 'biologs';


     public static function get_records($start,$end,$user){



		// $start = "2019-10-14";
		// $end = "2019-10-14";
		    $dtr = [];

			$start = new DateTime($start);
			$end   = new DateTime($end);
			$user_id = $user;
			$status = '';
			$biometric = 0;

			$find = DB::table('users')->select('employee_status','biometric')->where('id',$user_id)->first();

			if($find){
				$status = $find->employee_status;
				$biometric = $find->biometric;
			}


			


			for($i = $start; $i <= $end; $i->modify('+1 day')){
			     $dates = $i->format("Y-m-d");
			   	 $days = $i->format("D");
			 

			     $obj = New \stdClass();

			     $am_in = self::morning_in($dates,$user_id,$biometric);

			     $pm_in = self::afternoon_in($dates,$user_id,$biometric);

			     $am_out = self::morning_out($dates,$user_id,$am_in,$pm_in,$biometric);

			     $pm_out = self::afternoon_out($dates,$user_id,$pm_in,$biometric);

			     $overtime_in = self::overtime_in($dates,$user_id,$biometric);

			     $overtime_out = self::overtime_out($dates,$user_id,$biometric);
			     
			     $obj->days = $days;

			     $obj->morning_in = $am_in; 
			     $obj->morning_out =  $am_out; 

			     if($pm_in !=  $pm_out){
			     	$obj->afternoon_in =  $pm_in; 
			     	
			     }else{
			     	$obj->afternoon_in = "";
			     }

			     $obj->afternoon_out = $pm_out; 
			     $obj->overtime_in =  $overtime_in;
			     $obj->overtime_out =  $overtime_out;
			     // $obj->total_am_late = "";
			     // $obj->total_pm_late ="";
			     $obj->late = self::late($status,$days,$am_in,$pm_in,$am_out,$pm_out);
			     $obj->rendered = self::rendered($am_in,$pm_in,$am_out,$pm_out,$overtime_in,$overtime_out);
			     $dtr[$dates] = $obj;
			}

		    $data = New \stdClass();
		    $data->employee = "";
		    $data->employee_status = "";
		    $data->date_range = "";
		    $data->days = "";
		    $data->daily_time_record = $dtr;
			return $data;
     }

     public static function rendered($am_in,$pm_in,$am_out,$pm_out,$overtime_in,$overtime_out){

			$am_posted = new DateTime($am_out);
			$am_now = new DateTime($am_in);
			$am_diff = $am_posted->diff($am_now);

			$am = sprintf("%02d",$am_diff->h).':'.sprintf("%02d",$am_diff->i).':'.sprintf("%02d",$am_diff->s);



			$pm_posted = new DateTime($pm_out);
			$pm_now = new DateTime($pm_in);
			$pm_diff = $pm_posted->diff($pm_now);

			$pm = sprintf("%02d",$pm_diff->h).':'.sprintf("%02d",$pm_diff->i).':'.sprintf("%02d",$pm_diff->s);

			$overtime_posted = new DateTime($overtime_out);
			$overtime_now = new DateTime($overtime_in);
			$overtime_diff = $overtime_posted->diff($overtime_now);

			$overtime = sprintf("%02d",$overtime_diff->h).':'.sprintf("%02d",$overtime_diff->i).':'.sprintf("%02d",$overtime_diff->s);



			$time = $am;
			$time2 = $pm;

			$secs = strtotime($time2)-strtotime("00:00:00");
			$result = date("H:i:s:s",strtotime($time)+$secs);
			
			$obj = New \stdClass();
			$obj->am = $am;
			$obj->pm = $pm;
			$obj->total = $result;
			$obj->overtime = $overtime;

			return  $obj;

     }

     public static function late($status,$day,$am_in,$pm_in,$am_out,$pm_out){

     	
		$am_in = new DateTime($am_in);
		$am_out = new DateTime($am_out);

		$pm_in = new DateTime($pm_in);
		$pm_out = new DateTime($pm_out);

		$aam = '00:00:00';
		$uam = '00:00:00';	
		$ppm = '00:00:00';
		$upm = '00:00:00';
		$result = '00:00:00';

		//  $since_start = $start_date->diff(new DateTime($am_in));

		//  return $since_start->h.':'.$since_start->i;

		// // echo $am_in.' time<br>';
		// // echo $since_start->days.' days total<br>';
		// // echo $since_start->y.' years<br>';
		// // echo $since_start->m.' months<br>';
		// // echo $since_start->d.' days<br>';
		// // echo $since_start->h.' hours<br>';
		// // echo $since_start->i.' minutes<br>';
		// // echo $since_start->s.' seconds<br>';

		// exit;

		 if($status == 'PERMANENT'){
		 	switch (strtolower($day)) {
		 		case 'mon':
		 				
		 				// $flexiam = new DateTime('07:30:00')

		 				// if($am_in >  $flexiam){

		 				// }

		 			    $aam_time_in = new DateTime('08:00:00');	
		 			   
		 			    $uam_time_out = new DateTime('12:00:00');
		 			  
						$ppm_time_in = new DateTime('13:01:00');
							
						$upm_time_out = new DateTime('17:00:00');



						$flexi730 = new DateTime('00:00:00');
						$flexi800 = new DateTime('08:00:00');
					    $current = $am_in;
						$start = $flexi730;
						$end = $flexi800;

						if ($current > $start && $current < $end)
						{
							$min = $start->diff($current)->i;
							$sec = $start->diff($current)->s;
							$mins = sprintf("%02d",$min).':'.sprintf("%02d",$sec);

							//$aam_time_in = new DateTime('07:'.$mins);
							$upm_time_out = new DateTime('16:30:00');
						}



						// $flexi800 = new DateTime('08:00:00');
						// $flexi830 = new DateTime('08:30:00');
					 //    $current = $am_in;
						// $start = $flexi730;
						// $end = $flexi830;

						// if ($current > $start && $current < $end)
						// {
						// 	$min = $start->diff($current)->i;
						// 	$sec = $start->diff($current)->s;
						// 	$mins = sprintf("%02d",$min).':'.sprintf("%02d",$sec);
						// 	$upm_time_out = new DateTime('17:'.$mins);
						// }




		 			   
		 				if($am_in > $aam_time_in){

							//	$am_posted = $aam_time_in;
								//$am_now = $am_in;
								$aam_diff = $aam_time_in->diff($am_in);

								$aam = sprintf("%02d",$aam_diff->h).':'.sprintf("%02d",$aam_diff->i).':'.sprintf("%02d",$aam_diff->s);
					    }

					    if($am_out < $uam_time_out){

								//$am_posted = $uam_time_out;
								//$am_now = $am_out;
								$uam_diff = $uam_time_out->diff($am_out);

							    $uam = sprintf("%02d",$uam_diff->h).':'.sprintf("%02d",$uam_diff->i).':'.sprintf("%02d",$uam_diff->s);
					    }



					    if($pm_in > $ppm_time_in){

							//	$am_posted = $aam_time_in;
								//$am_now = $am_in;
								$ppm_diff = $ppm_time_in->diff($pm_in);

								$ppm = sprintf("%02d",$ppm_diff->h).':'.sprintf("%02d",$ppm_diff->i).':'.sprintf("%02d",$ppm_diff->s);
					    }

					    if($pm_out < $upm_time_out){

								//$pm_posted = $upm_time_out;
								//$pm_now = $pm_out;
								$upm_diff = $upm_time_out->diff($pm_out);

							    $upm = sprintf("%02d",$upm_diff->h).':'.sprintf("%02d",$upm_diff->i).':'.sprintf("%02d",$upm_diff->s);
					    }



							$obj = New \stdClass();
							$obj->am_late = $aam;
							$obj->pm_late = $ppm;
							$obj->am_undertime = $uam;
							$obj->pm_undertime = $upm;
							$obj->total = $result;
							

							return $obj;
								
						

		 			break;
		 		// case 'tue':



		 			
		 		// 	break;
		 		// case 'wed':
		 			
		 		// 	break;
		 		// case 'thu':
		 			
		 			break;
		 		case 'fri':

		 				 				// $flexiam = new DateTime('07:30:00')

		 				// if($am_in >  $flexiam){

		 				// }

		 			    $aam_time_in = new DateTime('08:00:00');	
		 			   
		 			    $uam_time_out = new DateTime('12:00:00');
		 			  
						$ppm_time_in = new DateTime('13:01:00');
							
						$upm_time_out = new DateTime('17:00:00');



						$flexi730 = new DateTime('00:00:00');
						$flexi800 = new DateTime('08:00:00');
						$current = $am_in;
						$start = $flexi730;
						$end = $flexi800;

						// if ($current > $start && $current < $end)
						// {
						// 	$min = $start->diff($current)->i;
						// 	$sec = $start->diff($current)->s;
						// 	$mins = sprintf("%02d",$min).':'.sprintf("%02d",$sec);

						// 	//$aam_time_in = new DateTime('07:'.$mins);
						// 	$upm_time_out = new DateTime('16:30:00');
						// }



						$flexi800 = new DateTime('08:00:00');
						$flexi830 = new DateTime('08:30:00');
						$current = $am_in;
						$start = $flexi800;
						$end = $flexi830;

						if ($current > $start && $current < $end)
						{
							$min = $start->diff($current)->i;
							$sec = $start->diff($current)->s;
							$mins = sprintf("%02d",$min).':'.sprintf("%02d",$sec);
							$upm_time_out = new DateTime('17:'.$mins);
						}




		 			   
		 				if($am_in > $aam_time_in){

							//	$am_posted = $aam_time_in;
								//$am_now = $am_in;
								$aam_diff = $aam_time_in->diff($am_in);

								$aam = sprintf("%02d",$aam_diff->h).':'.sprintf("%02d",$aam_diff->i).':'.sprintf("%02d",$aam_diff->s);
					    }

					    if($am_out < $uam_time_out){

								//$am_posted = $uam_time_out;
								//$am_now = $am_out;
								$uam_diff = $uam_time_out->diff($am_out);

							    $uam = sprintf("%02d",$uam_diff->h).':'.sprintf("%02d",$uam_diff->i).':'.sprintf("%02d",$uam_diff->s);
					    }



					    if($pm_in > $ppm_time_in){

							//	$am_posted = $aam_time_in;
								//$am_now = $am_in;
								$ppm_diff = $ppm_time_in->diff($pm_in);

								$ppm = sprintf("%02d",$ppm_diff->h).':'.sprintf("%02d",$ppm_diff->i).':'.sprintf("%02d",$ppm_diff->s);
					    }

					    if($pm_out < $upm_time_out){

								//$pm_posted = $upm_time_out;
								//$pm_now = $pm_out;
								$upm_diff = $upm_time_out->diff($pm_out);

							    $upm = sprintf("%02d",$upm_diff->h).':'.sprintf("%02d",$upm_diff->i).':'.sprintf("%02d",$upm_diff->s);
					    }



							$obj = New \stdClass();
							$obj->am_late = $aam;
							$obj->pm_late = $ppm;
							$obj->am_undertime = $uam;
							$obj->pm_undertime = $upm;
							$obj->total = $result;
							

							return $obj;

		 			
		 			break;
		 		case 'sat':
		 				    $obj = New \stdClass();
							$obj->am_late = $aam;
							$obj->pm_late = $ppm;
							$obj->am_undertime = $uam;
							$obj->pm_undertime = $upm;
							$obj->total = $result;
							

							return $obj;
		 			
		 			break;
		 		case 'sun':
		 			       $obj = New \stdClass();
							$obj->am_late = $aam;
							$obj->pm_late = $ppm;
							$obj->am_undertime = $uam;
							$obj->pm_undertime = $upm;
							$obj->total = $result;
							

							return $obj;
		 			
		 			break;
		 		default:


		 			
					
		 			    $aam_time_in = new DateTime('08:00:00');	
		 			   
		 			    $uam_time_out = new DateTime('12:00:00');
		 			  
						$ppm_time_in = new DateTime('13:01:00');
							
						$upm_time_out = new DateTime('17:00:00');



						$flexi700 = new DateTime('00:00:00');
						$flexi800 = new DateTime('08:00:00');
					    $current = $am_in;
						$start = $flexi700;
						$end = $flexi800;

						if ($current > $start && $current < $end)
						{
							$min = $start->diff($current)->i;
							$sec = $start->diff($current)->s;
							$mins = sprintf("%02d",$min).':'.sprintf("%02d",$sec);

							//$aam_time_in = new DateTime('07:'.$mins);
							$upm_time_out = new DateTime('16:30:00');
						}



						$flexi800 = new DateTime('08:00:00');
						$flexi830 = new DateTime('08:30:00');
					    $current = $am_in;
						$start = $flexi800;
						$end = $flexi830;

						if ($current > $start && $current < $end)
						{
							$min = $start->diff($current)->i;
							$sec = $start->diff($current)->s;
							$mins = sprintf("%02d",$min).':'.sprintf("%02d",$sec);
							$upm_time_out = new DateTime('17:'.$mins);
						}


		 			   
		 				if($am_in > $aam_time_in){

							//	$am_posted = $aam_time_in;
								//$am_now = $am_in;
								$aam_diff = $aam_time_in->diff($am_in);

								$aam = sprintf("%02d",$aam_diff->h).':'.sprintf("%02d",$aam_diff->i).':'.sprintf("%02d",$aam_diff->s);
					    }

					    if($am_out < $uam_time_out){

								//$am_posted = $uam_time_out;
								//$am_now = $am_out;
								$uam_diff = $uam_time_out->diff($am_out);

							    $uam = sprintf("%02d",$uam_diff->h).':'.sprintf("%02d",$uam_diff->i).':'.sprintf("%02d",$uam_diff->s);
					    }



					    if($pm_in > $ppm_time_in){

							//	$am_posted = $aam_time_in;
								//$am_now = $am_in;
								$ppm_diff = $ppm_time_in->diff($pm_in);

								$ppm = sprintf("%02d",$ppm_diff->h).':'.sprintf("%02d",$ppm_diff->i).':'.sprintf("%02d",$ppm_diff->s);
					    }

					    if($pm_out < $upm_time_out){

								//$pm_posted = $upm_time_out;
								//$pm_now = $pm_out;
								$upm_diff = $upm_time_out->diff($pm_out);

							    $upm = sprintf("%02d",$upm_diff->h).':'.sprintf("%02d",$upm_diff->i).':'.sprintf("%02d",$upm_diff->s);
					    }



							$obj = New \stdClass();
							$obj->am_late = $aam;
							$obj->pm_late = $ppm;
							$obj->am_undertime = $uam;
							$obj->pm_undertime = $upm;
							$obj->total = $result;
							

							return $obj;
								

		 			break;
		 	}
		 }

     }


        
// SELECT * FROM (SELECT 
// users.id as user_id,
// biologs.id as biologs_id, 
// users.name as name,
// users.employee_status as employee_status, 
// biologs.IndRegID as biologs_user_id,
// biologs.DwInOutMode as mode, 
// biologs.DateTimeRecord as datetime, 
// biologs.DateOnlyRecord as date, 
// biologs.TimeOnlyRecord as time, 
// DATE_FORMAT(biologs.TimeOnlyRecord,'%a') as day,
// TIME_FORMAT(biologs.TimeOnlyRecord,'%p') as noon, 
// TIME_FORMAT(biologs.TimeOnlyRecord,'%h') as hours,
// TIME_FORMAT(biologs.TimeOnlyRecord,'%i') as mins 

// FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID) as biometric_data WHERE biologs_user_id = 15 AND date = '2019-01-25'
// ers INNER JOIN biologs ON users.biometric_id = biologs.IndRegID) as biometric_data WHERE biologs_user_id = 15 AND date = '2019-01-25'

     public static function morning_in($date,$user_id,$biometric){

     	   $query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'AM' AND biologs.DwInOutMode = 0 AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC  LIMIT 1";
     		
     		$query = DB::select($query);
     		if($query){
     			return date('h:i:s', strtotime($query[0]->time ));
			}else{
				$query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'AM' AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC  LIMIT 1";
				$query = DB::select($query);

				if($query){
					return date('h:i:s', strtotime($query[0]->time ));
				}
     		}
     		return '';
     }

      public static function morning_out($date,$user_id,$ain,$pin,$biometric){

      		$time_pin = "";
      		$time_ain = "";

      	   if($ain){
      	   		$time_ain = $ain; 
      	   		$ain = " AND biologs.TimeOnlyRecord > '".$ain."' AND TIME_FORMAT(biologs.TimeOnlyRecord,'%H:%i:%s') != '".date('h:i:s', strtotime($ain))."'";
      	   }

      	   if($pin){
      	   		$time_pin = $pin; 
      	  	 	$pin = " AND biologs.TimeOnlyRecord < '".$pin."' AND TIME_FORMAT(biologs.TimeOnlyRecord,'%H:%i:%s') != '".date('h:i:s', strtotime($pin))."'";
      	   }

     	   $query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."' AND  biologs.DwInOutMode = 1  AND biologs.TimeOnlyRecord < '13:01' ".$pin."".$ain."  AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC LIMIT 1"; //ASC


     		$query = DB::select($query);
     		if($query){

     		
     			
     			return date('h:i:s', strtotime($query[0]->time));
     		
     		}else{

     			//echo 2;exit;


     			 
     			$query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND biologs.TimeOnlyRecord < '13:01' ".$pin."".$ain."  AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC LIMIT 1"; //ASC



     		    $query = DB::select($query);

     		    if($query){

     		    	return date('h:i:s', strtotime($query[0]->time));

     		    }else{


   

					if($pin){
						$pin = " AND biologs.TimeOnlyRecord >= '".$time_pin."'";

					}


					$query = "SELECT DwInOutMode,biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND biologs.TimeOnlyRecord < '13:01' ".$pin."".$ain."  AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC LIMIT 1"; //ASC

					// echo $query;exit;

					$query = DB::select($query);



					if($query){ // && !$time_ain

						
			
						
		                   if( $query[0]->DwInOutMode = 1){

		                   	 //echo

								return date('h:i:s', strtotime($query[0]->time));
							}
						
						
					}elseif($query){

						// echo 2;exit;


						//echo $query[0]->time.' - '.$time_pin;exit;
					if($query[0]->time !== $time_pin){
						   return date('h:i:s', strtotime($query[0]->time));
						}

					}else{
							

						$query_out = "SELECT DwInOutMode,biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."' AND biologs.DwInOutMode = 1 AND biologs.MachineNumber = '".$biometric."'  ORDER BY biologs.TimeOnlyRecord ASC"; //ASC

						//echo $query_out;exit;

			         	$query_out = DB::select($query_out);

			         	// echo "<pre>";
			         	// print_r($query_out);exit;

						if(count($query_out) == 2){
							if($query_out[0]->time !== $time_pin){
					   				return date('h:i:s', strtotime($query_out[0]->time));
							}
						}else{
							return '';
						}

					}





     		    }	


     		}
     		return '';
     }	

     public static function afternoon_in($date,$user_id,$biometric){

     	   $query = "SELECT DwInOutMode,biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'PM' AND biologs.DwInOutMode = 0 AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC  LIMIT 1";

     		  $query = DB::select($query);

     		if($query){
     		
     			return date('h:i:s', strtotime($query[0]->time));
     		}else{
     		
     			  $query = "SELECT DwInOutMode,biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'PM' AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC  LIMIT 1,1";

     			//  echo $query;exit;
     			  $query = DB::select($query);

     			  // echo "<pre>";print_r($query);exit;

     			  if($query){
     			  	// if($query[0]->DwInOutMode = 0){
     			 	 	return date('h:i:s', strtotime($query[0]->time));
     			 	// }
     			  }

     		}	

     		
     		  return '';

     }

     public static function afternoon_out($date,$user_id,$pm_in,$biometric){


      	   // if($pm_in){
      	   //  	$pm_in = " AND biologs.TimeOnlyRecord > '".$pm_in."'";
      	   // }


      	   // if($ain){
      	   // 	$ain = " AND biologs.TimeOnlyRecord > '".$ain."' AND TIME_FORMAT(biologs.TimeOnlyRecord,'%H:%i:%s') != '".date('h:i:s', strtotime($ain))."'";
      	   // }

      	   if($pm_in){
      	   	$pm_in = " AND biologs.TimeOnlyRecord > '".$pm_in."' AND TIME_FORMAT(biologs.TimeOnlyRecord,'%H:%i:%s') != '".date('h:i:s', strtotime($pm_in))."'";
      	   }



     	   $query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'PM' AND biologs.DwInOutMode = 1 ".$pm_in." AND biologs.TimeOnlyRecord > '13:01'  AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord DESC  LIMIT 1";

     		$query = DB::select($query);
     		if($query){
     			return date('h:i:s', strtotime($query[0]->time));
     		}else{

     		    $query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'PM'  ".$pm_in." AND biologs.TimeOnlyRecord > '13:01'  AND  biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord DESC  LIMIT 1";
     		    $query = DB::select($query);

     		    if($query){
     		    	return date('h:i:s', strtotime($query[0]->time));
     		    }

     		}
     		return '';
     }



     public static function overtime_in($date,$user_id,$biometric){
     	   $query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'PM' AND biologs.DwInOutMode = 4  AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord ASC  LIMIT 1";
     		$query = DB::select($query);
     		if($query){
     			return date('h:i:s', strtotime($query[0]->time));
     		}
     		return '';

     }

     public static function overtime_out($date,$user_id,$biometric){
     	   $query = "SELECT biologs.TimeOnlyRecord as time FROM users INNER JOIN biologs ON users.biometric_id = biologs.IndRegID WHERE users.id = ".$user_id." AND biologs.DateOnlyRecord = '".$date."'  AND  TIME_FORMAT(biologs.TimeOnlyRecord,'%p')  = 'PM' AND biologs.DwInOutMode = 5  AND biologs.TimeOnlyRecord > '17:00'  AND biologs.MachineNumber = '".$biometric."' ORDER BY biologs.TimeOnlyRecord DESC  LIMIT 1";
     		$query = DB::select($query);
     		if($query){
     			return date('h:i:s', strtotime($query[0]->time));
     		}
     		return '';
     }
}
