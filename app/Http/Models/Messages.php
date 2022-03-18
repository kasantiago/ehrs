<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Cmgmyr\Messenger\Traits\Messagable;
use App\User as User;
use Auth;
use DB;
use App\Http\Models\Accounts as Accounts;
use Carbon\Carbon as Carbon;
use App\Http\Models\Notifications as Notifications;
use App\Http\Models\EmailNotification as EmailNotification;
use App\Http\Models\PersonalInformation as PersonalInformation;

class Messages extends Model
	{
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
			$data->uid = encrypt($users[$count]->uid);
			$data->name = $users[$count]->name;
			$data->photo = $users[$count]->photo;
			$arr[] = $data;
			}
		return json_encode($arr);
		}
	public static function count_all_accounts()
		{
		$users = DB::select("SELECT count(*) as cnt FROM users WHERE id != " . Auth::id());
		return json_encode($users[0]->cnt);
		}
	public static function threadId($thread)
		{
		$find = DB::table('messenger_threads')->where('subject', $thread)->first();
		return $find;
		}

	public static function message($thread_id)
		{
		$arr = [];
		$find = DB::select("SELECT * FROM ( SELECT id, thread_id, (SELECT user_id FROM messenger_message_participants as mmp WHERE mmp.thread_id = mmp.thread_id AND mmp.message_id = mm.id AND mmp.user_id = " . Auth::id() . ") as user_id, owner, body, (SELECT subject FROM messenger_threads as mt WHERE mt.id = mm.thread_id) as subject, (SELECT party FROM messenger_threads as mt WHERE mt.id = mm.thread_id) as party, (SELECT status FROM messenger_message_participants as mmp WHERE mmp.thread_id = mmp.thread_id AND mmp.message_id = mm.id AND mmp.user_id = " . Auth::id() . ") as status, created_at FROM messenger_messages as mm ) as messages WHERE thread_id = " . $thread_id . " AND user_id = " . Auth::id() . " AND status = 1"); //." AND
		for ($count = 0; $count <= count($find) - 1; $count++)
			{
			$data = new \stdClass();
			$data->id = encrypt($find[$count]->id);
			$data->body = $find[$count]->body;
			$data->subject = $find[$count]->party ? $find[$count]->party : $find[$count]->subject;
			$data->thread_id = $find[$count]->thread_id;
			$data->owner = $find[$count]->owner;
			$data->user_id = $find[$count]->user_id;
			$data->created_at = $find[$count]->created_at;
			$arr[] = $data;
			}

		return $arr;
		}
	public static function threads($keyword = '')
		{
		if ($keyword)
			{
			$keyword = " AND subject Like '%" . addslashes($keyword) . "%' OR party Like '%" . addslashes($keyword) . "%' OR body Like '%" . addslashes($keyword) . "%' ";
			}

		$arr = [];
		$uid = Auth::id();
		$find = DB::select("SELECT * FROM (SELECT id,owner, (SELECT user_id FROM messenger_participants as mp WHERE mp.thread_id = mt.id AND mp.user_id = " . Auth::id() . " ) as user_id, subject, party, (SELECT mm.body FROM messenger_messages as mm LEFT JOIN messenger_message_participants as mmp ON mm.id = mmp.message_id WHERE mmp.status = 1 AND mmp.thread_id = mt.id AND mmp.user_id = " . Auth::id() . " ORDER BY mm.id DESC LIMIT 1) as body, (SELECT status FROM messenger_participants as mp WHERE mp.thread_id = mt.id AND mp.user_id = " . Auth::id() . " ) as status, (SELECT GROUP_CONCAT(user_id) FROM messenger_participants as mp WHERE mp.thread_id = mt.id AND status = 1) as peoples, (SELECT created_at FROM messenger_messages as mm WHERE mm.thread_id = mt.id ORDER BY mm.id DESC LIMIT 1) as created_at FROM messenger_threads as mt) as inbox WHERE user_id = " . Auth::id() . "" . $keyword . " AND status = 1  ORDER BY created_at DESC;");
		if ($find)
			{
			for ($count = 0; $count <= count($find) - 1; $count++)
				{
				$data = new \stdClass();
				$data->id = $find[$count]->id;
				$data->owner = $find[$count]->owner;
				$data->user_id = $find[$count]->user_id;
				$data->peoples = $find[$count]->peoples;
				$photo = explode(',', $find[$count]->peoples);
				$data->photo_count = count($photo);
				$data->photo = self::get_profile_photos($find[$count]->peoples);
				$data->subject = $find[$count]->party ? $find[$count]->party : self::unecrypted_user_id_for_subject($find[$count]->peoples);
				$data->body = $find[$count]->body ? $find[$count]->body : '&nbsp;<b>. . .</b>';
				$data->status = $find[$count]->status;
				$data->created_at = $find[$count]->created_at;
				$arr[] = $data;
				}
			}

		return $arr;
		}
    public static function frist_message($user_id)
		{
		$find = DB::select("SELECT * FROM (SELECT id as thread_id, (SELECT GROUP_CONCAT(user_id) FROM messenger_participants as mp WHERE mp.thread_id = mt.id) as user_id FROM messenger_threads as mt) as inbox WHERE user_id = '" . $user_id . "'");
		if (!$find)
			{
			return Null;
			}

		return $find[0]->thread_id;
		}

	public static function unseen($thread_id)
		{
		$find = DB::select("SELECT  COUNT(*) as seen FROM messenger_participants WHERE thread_id = " . $thread_id . " AND user_id = " . Auth::id() . " AND last_read IS NULL");
		return $find[0]->seen == 1 ? 'unseen_chat' : 'seen_chat';
		}
	public static function active_background($thread_id)
		{
		$color = Accounts::theme_color();
		$find = DB::table('messenger_participants')->where('thread_id', $thread_id)->where('user_id', Auth::id())->where('last_read', '')->get()->first();
		if ($find)
			{
			return $color;
			}
		  else
			{
			return '';
			}
		}
	public static function active_delete($thread_id)
		{
		$color = Accounts::theme_color();
		$find = DB::table('messenger_participants')->where('thread_id', $thread_id)->where('user_id', Auth::id())->where('last_read', '')->count();
		if ($find)
			{
			return 'white';
			}
		  else
			{
			return $color[4];
			}
		}
	public static function ecrypted_user_id_for_subject($user_id, $option)
		{
		$arr = explode(",", $user_id);
		for ($cnt = 0; $cnt <= count($arr) - 1; $cnt++)
			{
			if (decrypt($arr[$cnt]) != Auth::id())
				{
				$arrUid[] = decrypt($arr[$cnt]);
				$arrThread[] = PersonalInformation::get_name(decrypt($arr[$cnt]));
				}
			}
		sort($arrUid);
		$arrlength = count($arrUid);
		for ($x = 0; $x < $arrlength; $x++)
			{
			$arrUidSort[] = $arrUid[$x];
			$arrThreadSort[] = PersonalInformation::get_name($arrUid[$x]);
			}
		$thread = implode(", ", $arrThreadSort);
		$thread_id = Messages::threadId($thread);
		if ($option == 1)
			{
			return $thread;
			}

		if ($option == 2)
			{
			return $thread_id;
			}
		}
	public static function unecrypted_user_id_for_subject($user_id)
		{
		$arrSubject = "";
		$arrUid = [];
		$arrThread = [];
		$arrThreadSort = [];
		$thread = "";
		$arrSubject = explode(",", $user_id);
		for ($cnt = 0; $cnt <= count($arrSubject) - 1; $cnt++)
			{
			if ($arrSubject[$cnt] != Auth::id())
				{
				$arrUid[] = $arrSubject[$cnt];
				$arrThread[] = PersonalInformation::get_name($arrSubject[$cnt]);
				}
			}
		sort($arrUid);
		$arrlength = count($arrUid);
		for ($x = 0; $x < $arrlength; $x++)
			{
			$arrUidSort[] = $arrUid[$x];
			$arrThreadSort[] = PersonalInformation::get_name($arrUid[$x]);
			}

		$thread = implode(", ", $arrThreadSort);
		return $thread;
		}
	public static function encrypt_user_id($user_id)
		{
		$arr2 = explode(",", $user_id, 2);
		for ($cnt = 0; $cnt <= count($arr2) - 1; $cnt++)
			{
			$arrUid[] = encrypt($arr2[$cnt]);
			}

		$thread_id = implode(",", $arrUid);
		return $thread_id;
		}
	public static function get_profile_photos($user_id)
		{
		$user_id = explode(',', $user_id);
		if ($user_id)
			{
			switch (count($user_id))
				{
			case 1:
				$photo[] = Accounts::profile(Auth::id());
				break;

			case 2:
				for ($cnt = 0; $cnt <= count($user_id) - 1; $cnt++)
					{
					if (Auth::id() != $user_id[$cnt])
						{
						$photo[] = Accounts::profile($user_id[$cnt]);
						}
					}

				break;

			case 3:
				$photo[] = Accounts::profile(array_slice($user_id, -1, 1) [0]);
				$photo[] = Accounts::profile(array_slice($user_id, -2, 1) [0]);
				break;

			default:
				$photo[] = Accounts::profile(array_slice($user_id, -1, 1) [0]);
				$photo[] = Accounts::profile(array_slice($user_id, -2, 1) [0]);
				$photo[] = Accounts::profile(array_slice($user_id, -3, 1) [0]);
				break;
				}
			}
		return $photo;
		}
	public static function people($user_id)
		{
		if ($user_id)
			{
			$users = DB::select("SELECT  id, name, IF(photo IS NOT NULL,CONCAT('/storage/avatars/',photo),'/admin-assets/images/user.png') as photo FROM users WHERE id IN (" . $user_id . ")");
			}
		  else
			{
			return [];
			}

		return $users;
		}
	public static function party_name($thread_id)
		{
		$find = DB::table("messenger_threads")->select("party")->where("id", $thread_id)->first();
		return $find->party;
		}

	public static function find_subject($thread_id)
		{
		$find = DB::select("SELECT (SELECT GROUP_CONCAT(user_id) FROM messenger_participants as mp WHERE mp.thread_id = mm.id) as user_id, party as subject FROM messenger_threads as mm WHERE mm.id = " . $thread_id);
		foreach($find as $key => $value)
			{
			$subject = $value->subject ? $value->subject : self::unecrypted_user_id_for_subject($value->user_id);
			}

		return $subject;
		}
	public static function new_thread($user_id, $message)
		{
		$party = '';
		$arrThreadSortEmail = [];
		$arrThreadSortEmailsName = [];
		$arrSubject = explode(",", $user_id);
		for ($cnt = 0; $cnt <= count($arrSubject) - 1; $cnt++)
			{
			$arrUid[] = $arrSubject[$cnt];
			}

		sort($arrUid);
		$arrlength = count($arrUid);
		for ($x = 0; $x < $arrlength; $x++)
			{
			$arrUidSort[] = $arrUid[$x];
			$arrThreadSort[] = PersonalInformation::get_name($arrUid[$x]);
			if(Auth::id() != $arrUid[$x]){
				$arrThreadSortEmailsName[] = PersonalInformation::get_name($arrUid[$x]);
			}
			if(EmailNotification::get_email($arrUid[$x]) && $arrUid[$x] != Auth::id()){
				$arrThreadSortEmail[] = EmailNotification::get_email($arrUid[$x]);
			}
			if (Auth::id() != $arrUid[$x])
				{
				Notifications::insertMessage($arrUid[$x], $message);
				}
			}
		$emails_name = implode(", ", $arrThreadSortEmailsName);
		$names = implode(", ", $arrThreadSort);
		$emails = implode(", ", $arrThreadSortEmail);
		$user_id = implode(",", $arrUidSort);

		
		$lastTreadId = DB::table('messenger_threads')->insertGetId(['owner' => Auth::id() , 'subject' => $names, 'party' => $party, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);
		$arrUid = explode(",", $user_id);
		for ($cnt = 0; $cnt <= count($arrUid) - 1; $cnt++)
			{
			$arrData = ['thread_id' => $lastTreadId, 'user_id' => $arrUid[$cnt], 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ];
			if (Auth::id() == $arrUid[$cnt])
				{
				$arrData['last_read'] = Carbon::now();
				}

			DB::table('messenger_participants')->insert($arrData);
			}
		$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $lastTreadId, 'owner' => Auth::id() , 'body' => $message, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);
		$arrUid = explode(",", $user_id);
		for ($cnt = 0; $cnt <= count($arrUid) - 1; $cnt++)
			{
			$arrData = ['thread_id' => $lastTreadId, 'user_id' => $arrUid[$cnt], 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ];
			if (Auth::id() == $arrUid[$cnt])
				{
				$arrData['last_read'] = Carbon::now();
				}

			DB::table('messenger_message_participants')->insert($arrData);
			}

		$to_email = $emails;
		$to_name = $emails_name;
		$subject = self::find_subject($lastTreadId);
		$body = $message;
		$from_email = Auth::user()->email;
		$from_name = Auth::user()->name;
		EmailNotification::create_email_notifcation($subject,$body,$from_email,$from_name,$to_email,$to_name);


		return $lastTreadId ? $lastTreadId : false;
		}
	public static function new_message($thread_id, $user_id_encrypted, $message)
		{
		$party = '';
		$arrThreadSortEmail = [];
		$arrThreadSortEmailsName = [];
		$arrSubject = explode(",", $user_id_encrypted);
		for ($cnt = 0; $cnt <= count($arrSubject) - 1; $cnt++)
			{
			$arrUid[] = $arrSubject[$cnt];
			}
		sort($arrUid);
		$arrlength = count($arrUid);
		for ($x = 0; $x < $arrlength; $x++)
			{
			$arrUidSort[] = $arrUid[$x];
			$arrThreadSort[] = PersonalInformation::get_name($arrUid[$x]);
			if(Auth::id() != $arrUid[$x]){
				$arrThreadSortEmailsName[] = PersonalInformation::get_name($arrUid[$x]);
			}
			if(EmailNotification::get_email($arrUid[$x]) && $arrUid[$x] != Auth::id()){
				$arrThreadSortEmail[] = EmailNotification::get_email($arrUid[$x]);
			}

			if (Auth::id() != $arrUid[$x])
				{
				Notifications::insertMessage($arrUid[$x], $message);
				}
			}
		$names = implode(", ", $arrThreadSort);
		$emails_name = implode(", ", $arrThreadSortEmailsName);
		$emails = implode(", ", $arrThreadSortEmail);
		$user_id = implode(",", $arrUidSort);;
		DB::table('messenger_threads')->where('id', $thread_id)->update(['updated_at' => Carbon::now() , ]);
		DB::table('messenger_participants')->where('thread_id', $thread_id)->update(['last_read' => Null, 'updated_at' => Carbon::now() , ]);
		DB::table('messenger_participants')->where('thread_id', $thread_id)->where('user_id', Auth::id())->update(['last_read' => Carbon::now() , 'updated_at' => Carbon::now() , ]);
		$find = DB::table("messenger_threads")->where("id", $thread_id)->first();
		$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $thread_id, 'owner' => Auth::id() , 'body' => $message, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);
		$arrUid = explode(",", $user_id);
		for ($cnt = 0; $cnt <= count($arrUid) - 1; $cnt++)
			{
			$arrData = ['thread_id' => $thread_id, 'user_id' => $arrUid[$cnt], 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ];
			if (Auth::id() == $arrUid[$cnt])
				{
				$arrData['last_read'] = Carbon::now();
				}

			DB::table('messenger_message_participants')->insert($arrData);
			}

		$to_email = $emails;
		$to_name = $emails_name;
		$subject = self::find_subject($thread_id);
		$body = $message;
		$from_email = Auth::user()->email;
		$from_name = Auth::user()->name;
		EmailNotification::create_email_notifcation($subject,$body,$from_email,$from_name,$to_email,$to_name);

		return $thread_id ? $thread_id : false;
		}
	public static function seen_message($thread_id)
		{
		DB::table('messenger_participants')->where('thread_id', $thread_id)->where('user_id', Auth::id())->update(['last_read' => Carbon::now() ]);
		DB::table('messenger_message_participants')->where('thread_id', $thread_id)->where('user_id', Auth::id())->update(['last_read' => Carbon::now() ]);
		}
	public static function empty_thread($thread_id)
		{
		$thread = DB::table("messenger_threads")->where("id", $thread_id)->first();
		$find = DB::select("SELECT COUNT(*) as msg FROM (SELECT id,thread_id, deleted_at , created_at FROM messenger_messages as mm WHERE thread_id = " . $thread_id . " AND FIND_IN_SET(" . Auth::id() . ", deleted_at)) as dataMSG");
		if ($find[0]->msg == 0)
			{
			}
		}
	public static function all_participants($thread_id)
		{
		$find = DB::select("SELECT GROUP_CONCAT(user_id) as user_id  FROM messenger_participants as mp WHERE mp.thread_id = " . $thread_id);
		return $find[0];
		}
	public static function active_participants($thread_id)
		{
		$find = DB::select("SELECT GROUP_CONCAT(user_id) as deleted_at FROM messenger_participants as mp WHERE mp.thread_id = " . $thread_id . " AND status = 1");
		return $find[0];
		}
	public static function who_seen($thread_id)
		{
		$thread_id = decrypt($thread_id);
		$find = DB::select("SELECT GROUP_CONCAT(user_id) as user_id FROM messenger_participants as mp WHERE mp.thread_id = " . $thread_id . " AND status = 1");
		$message_id = DB::select("SELECT id FROM messenger_messages WHERE thread_id = " . $thread_id . " ORDER BY id DESC LIMIT 1");
		$user_id = $find[0]->user_id;
		$message_id = $message_id[0]->id;
		$arrSubject = explode(",", $user_id);
		$last_read = DB::select("SELECT  (SELECT owner FROM messenger_messages 
        as mm WHERE mm.id = mmp.message_id) as owner, thread_id,message_id,user_id,(SELECT IF(photo IS NOT NULL,CONCAT('/storage/avatars/',photo),'/admin-assets/images/user.png') as photo FROM users as u WHERE u.id = mmp.user_id) as photo,last_read FROM messenger_message_participants as mmp WHERE thread_id = " . $thread_id . " AND message_id = " . $message_id . "");
		return $last_read;
		}
	public static function owner($thread_id)
		{
		$find = DB::table("messenger_threads")->where("id", $thread_id)->first();
		return $find->owner;
		}

	public static function admin_request_view_pdf($uid,$aid){


	$names[] = PersonalInformation::get_name($aid);
	$names[] = PersonalInformation::get_name($uid);

	$combine_names = implode(", ", $names);

	$full_name = PersonalInformation::get_name($uid);

	// echo $combine_names;exit;

	

		$thread_id = "";

		$find_thread = DB::table('messenger_threads')->where('subject',$combine_names)->first();

		

		if($find_thread){

			$thread_id = $find_thread->id;

			$message = "Hello ".$full_name.", we are requesting to view your Personal Data Sheet. <br> Please <font color='red'><a href='".url("personal-data-sheet-table/view/confirm/")."/".encrypt($thread_id)."'>Confirm</a></font></a>";
		
			//$find_update_lastread = DB::table('messenger_participants')->where('thread_id',$thread_id)->update(['last_read' => Carbon::now()]);
		
			$name =  PersonalInformation::get_name($uid);

			$names = Auth::user()->name.", ".$name;


			$arrData = ['last_read' => Carbon::now() ];		

			DB::table('messenger_participants')->where('id',$find_thread->id)->update($arrData);

			
			$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $thread_id, 'owner' => Auth::id() , 'body' => $message, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

			$arrData = [
					   		['thread_id' => $thread_id, 'user_id' => $uid, 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
					   		['thread_id' => $thread_id, 'user_id' => Auth::id(), 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
					   ];
			
			DB::table('messenger_message_participants')->insert($arrData);
				


		}else{


			$name =  PersonalInformation::get_name($uid);

			$names = Auth::user()->name.", ".$name;
		
			$lastTreadId = DB::table('messenger_threads')->insertGetId(['owner' => Auth::id() , 'subject' => $names, 'party' => '', 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

			$thread_id = $lastTreadId;

			$message = "Hello ".$full_name.", we are requesting to view your Personal Data Sheet. <br> Please <font color='red'><a href='".url("personal-data-sheet-table/view/confirm/")."/".encrypt($thread_id)."'>Confirm</a></font></a>";
			
			$arrData = [
							['thread_id' => $lastTreadId, 'user_id' => Auth::id(), 'status' => 1,'last_read' => Carbon::now(), 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
							['thread_id' => $lastTreadId, 'user_id' => $uid, 'status' => 1,'last_read' => Null, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
					   ];

			DB::table('messenger_participants')->insert($arrData);

			
			$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $lastTreadId, 'owner' => Auth::id() , 'body' => $message, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

			$arrData = [
					   		['thread_id' => $lastTreadId, 'user_id' => $uid, 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
					   		['thread_id' => $lastTreadId, 'user_id' => Auth::id(), 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
					   ];
			
			DB::table('messenger_message_participants')->insert($arrData);
				

		}


		return $thread_id;


	}


	public static function admin_request_view_ssalnw($uid,$aid){


	$names[] = PersonalInformation::get_name($aid);
	$names[] = PersonalInformation::get_name($uid);

	$combine_names = implode(", ", $names);

	$full_name = PersonalInformation::get_name($uid);

	// echo $combine_names;exit;

	

		$thread_id = "";

		$find_thread = DB::table('messenger_threads')->where('subject',$combine_names)->first();

		

		if($find_thread){

			$thread_id = $find_thread->id;

			$message = "Hello ".$full_name.", we are requesting to view your SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH. <br> Please <font color='red'><a href='".url("sworn-statement-assets-liabilities-net-worth/view/confirm/")."/".encrypt($thread_id)."'>Confirm</a></font></a>";
		
			//$find_update_lastread = DB::table('messenger_participants')->where('thread_id',$thread_id)->update(['last_read' => Carbon::now()]);
		
			$name =  PersonalInformation::get_name($uid);

			$names = Auth::user()->name.", ".$name;


			$arrData = ['last_read' => Carbon::now() ];		

			DB::table('messenger_participants')->where('id',$find_thread->id)->update($arrData);

			
			$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $thread_id, 'owner' => Auth::id() , 'body' => $message, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

			$arrData = [
					   		['thread_id' => $thread_id, 'user_id' => $uid, 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
					   		['thread_id' => $thread_id, 'user_id' => Auth::id(), 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
					   ];
			
			DB::table('messenger_message_participants')->insert($arrData);
				


		}else{


			$name =  PersonalInformation::get_name($uid);

			$names = Auth::user()->name.", ".$name;
		
			$lastTreadId = DB::table('messenger_threads')->insertGetId(['owner' => Auth::id() , 'subject' => $names, 'party' => '', 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

			$thread_id = $lastTreadId;

			$message = "Hello ".$full_name.", we are requesting to view your SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH. <br> Please <font color='red'><a href='".url("sworn-statement-assets-liabilities-net-worth/view/confirm/")."/".encrypt($thread_id)."'>Confirm</a></font></a>";
			
			$arrData = [
							['thread_id' => $lastTreadId, 'user_id' => Auth::id(), 'status' => 1,'last_read' => Carbon::now(), 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
							['thread_id' => $lastTreadId, 'user_id' => $uid, 'status' => 1,'last_read' => Null, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
					   ];

			DB::table('messenger_participants')->insert($arrData);

			
			$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $lastTreadId, 'owner' => Auth::id() , 'body' => $message, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

			$arrData = [
					   		['thread_id' => $lastTreadId, 'user_id' => $uid, 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
					   		['thread_id' => $lastTreadId, 'user_id' => Auth::id(), 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
					   ];
			
			DB::table('messenger_message_participants')->insert($arrData);
				

		}


		return $thread_id;


	}




 public static function user_response($uid,$aid,$thread_id,$body){

	

		//$find_thread = DB::table('messenger_threads')->where('id',$thread_id)->first();

	
		$name =  PersonalInformation::get_name($uid);

		$names = Auth::user()->name.", ".$name;


		$arrData = ['last_read' => Carbon::now() ];		

		DB::table('messenger_participants')->where('thread_id',$thread_id)->update($arrData);

		
		$lastMessageId = DB::table('messenger_messages')->insertGetId(['thread_id' => $thread_id, 'owner' => Auth::id() , 'body' => $body, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ]);

		$arrData = [
				   		['thread_id' => $thread_id, 'user_id' => $uid, 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ],
				   		['thread_id' => $thread_id, 'user_id' => Auth::id(), 'message_id' => $lastMessageId, 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()  ]
				   ];
		
		DB::table('messenger_message_participants')->insert($arrData);
				


	

		return $thread_id;


	}



}