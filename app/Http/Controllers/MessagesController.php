<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Session;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\Messages as Messages;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\EmailNotification as EmailNotification;
use DB;

class MessagesController extends Controller
    {
    public function index()
        {

        EmailNotification::push_email();

        $color = Accounts::theme_color();
        $accounts = Messages::accounts();
        $count_all_accounts = Messages::count_all_accounts();
        $threads = Messages::threads();
        $messages = [];
        $people = [];
        $add_people = [];
        $thread_id = "";
        $group_name = "";
        $add_people = json_encode([]);
        $user_id_encrypted = "";
        $subject = "";
        $who_seen = "";
        $owner = "";
        
        if ($threads)
            {
            $messages = Messages::message($threads[0]->id);
            $people = Messages::people($threads[0]->peoples);
            $add_people = Messages::accounts($threads[0]->peoples);
            $group_name = Messages::party_name($threads[0]->id);
            $thread_id = encrypt($threads[0]->id);
            $user_id_encrypted = encrypt($threads[0]->peoples);
            Messages::seen_message($threads[0]->id);
            $subject = Messages::find_subject($threads[0]->id);
            $who_seen = Messages::who_seen($thread_id);
            $owner = $threads[0]->owner; //stop here

            if (!$subject)
                {
                $subject = "You yourself!";
                }
            }
        SystemLogs::saveLogs('visited messenger page!');
        return view('messenger.index', compact('thread_id', 'threads', 'messages', 'color', 'accounts', 'add_people', 'people', 'group_name', 'count_all_accounts', 'user_id_encrypted', 'subject', 'who_seen', 'owner'));
        }
    public function inbox(Request $request)
        {
     //  echo "<pre>";print_r($request->selected);exit;
        if ($request->selected)
            {
            $uid = explode(",", $request->selected);
            for ($cnt = 0; $cnt <= count($uid) - 1; $cnt++)
                {
                $arrUid[] = decrypt($uid[$cnt]);
                }
            array_push($arrUid, Auth::id());
            sort($arrUid);
            $arrlength = count($arrUid);
            for ($x = 0; $x < $arrlength; $x++)
                {
                $arrUidSort[] = $arrUid[$x];
                }
            $user_id = implode(",", $arrUidSort);
            $user_id_encrypted = encrypt($user_id);
            $thread_id = Messages::frist_message($user_id);
            if (count($uid) == 1)
                {
                if ($thread_id)
                    {
                    $color = Accounts::theme_color();
                    $messages = Messages::message($thread_id);
                    $who_seen = Messages::who_seen(encrypt($thread_id));
                    if (!$messages[0]->subject)
                        {
                        $subject = "You yourself!";
                        }
                    $subject = str_limit($messages[0]->subject, $limit = 80, $end = '...');
                    $threads_id = encrypt($thread_id);
                    $class = "_" . $thread_id . "tId";
                    $bg_color = $color[0];
                    $html = view('messenger.parts.msg_history', compact('messages', 'color', 'who_seen'))->render();
                    return response()->json(compact('html', 'subject', 'threads_id', 'user_id_encrypted', 'class', 'bg_color'));
                    }
                }

            $threads_id = "";
            return response()->json(compact('threads_id', 'user_id_encrypted'));
            }
        }
    public function all_user(Request $request)
        {
        $user_id_encrypted = "";
        $thread_id = DB::table('messenger_threads')->where('party', 'ALL USER')->first();
        if ($thread_id)
            {
            $color = Accounts::theme_color();
            $messages = Messages::message($thread_id->id);
            $who_seen = Messages::who_seen(encrypt($thread_id->id));
            if (!$messages[0]->subject)
                {
                $subject = "You yourself!";
                }
            $subject = str_limit($messages[0]->subject, $limit = 80, $end = '...');
            $threads_id = encrypt($thread_id->id);
            $user_id_encrypted = 'ALL USER';
            $html = view('messenger.parts.msg_history', compact('messages', 'color', 'who_seen'))->render();
            return response()->json(compact('html', 'subject', 'threads_id', 'user_id_encrypted'));
            }
        $threads_id = "";
        return response()->json(compact('threads_id', 'user_id_encrypted'));
        }
    public function search(Request $request)
        {
        if ($request->keyword)
            {
            SystemLogs::saveLogs('searching for <b>"' . $request->keyword . '"</b> in messenger!');
            }
        $color = Accounts::theme_color();
        $threads = Messages::threads($request->keyword);
        $html = view('messenger.parts.inbox_chat', compact('threads', 'color'))->render();
        return response()->json(['html' => $html]);
        }
    public function refresh(Request $request)
        {
        $rowId = decrypt($request->rowId);
        $class = "_" . $rowId . "tId";
        $subject = "You yourself!";
        $messages = Messages::message($rowId);
        $subject = str_limit($messages[0]->subject, $limit = 80, $end = '...');
        $color = Accounts::theme_color();
        $threads = Messages::threads($request->keyword);
        $bg_color = $color[0];
        $html = view('messenger.parts.inbox_chat', compact('threads', 'color'))->render();
        return response()->json(compact('html', 'subject', 'class', 'bg_color'));
        }
    public function history(Request $request)
        {
        if ($request->id)
            {
            $color = Accounts::theme_color();
            $thread_id = decrypt($request->id);
            $find_thread = DB::table("messenger_threads")->where("id", $thread_id)->first();
            $messages = Messages::message($thread_id);
            $find = Messages::all_participants($thread_id);
            if ($messages)
                {
                $subject = Messages::find_subject($thread_id);
                if (!$subject)
                    {
                    $subject = "You yourself!";
                    }
                $subject = str_limit($subject, $limit = 80, $end = '...');
                $people = Messages::accounts($find->user_id);
                $added = encrypt($find->user_id);
                $group_name = Messages::party_name($messages[0]->thread_id);
                $thread_id = encrypt($messages[0]->thread_id);
                $user_id_encrypted = encrypt($find->user_id);
                $class = "_" . $messages[0]->thread_id . "tId";
                Messages::seen_message($messages[0]->thread_id);
                }
              else
                {
                $subject = Messages::find_subject($thread_id);
                if (!$subject)
                    {
                    $subject = "You yourself!";
                    }
                $subject = str_limit($subject, $limit = 80, $end = '...');
                $people = Messages::accounts($find->user_id);
                $added = encrypt($find->user_id);
                $group_name = Messages::party_name($thread_id);
                $class = "_" . $thread_id . "tId";
                $thread_id = $request->id;
                $user_id_encrypted = encrypt($find->user_id);
                }
            $bg_color = $color[0];
            $who_seen = Messages::who_seen($thread_id);
            $html = view('messenger.parts.msg_history', compact('messages', 'color', 'who_seen'))->render();
            SystemLogs::saveLogs('selected <b>' . str_limit($subject, $limit = 50, $end = '...') . '</b> thread in messenger!');
            return response()->json(compact('html', 'subject', 'people', 'added', 'group_name', 'thread_id', 'user_id_encrypted', 'class', 'bg_color'));
            }
        }
    public function new_compose()
        {
        $color = Accounts::theme_color();
        $html = view('messenger.parts.compose_new', compact('messages', 'color', 'thread'))->render();
        return response()->json(compact('html', "status"));
        }
    public function group_update(Request $request)
        {
        $thread_id = decrypt($request->thread_id);
        $group = $request->group_name;
        DB::table("messenger_threads")->where('id', $thread_id)->update(['party' => $group]);
        $class = "_" . $thread_id . "tId";
        $color = Accounts::theme_color();
        $bg_color = $color[0];
        $success = true;
        SystemLogs::saveLogs('updated thread group name to <b>' . str_limit($request->group_name, $limit = 50, $end = '...') . '</b> in messenger!');
        return response()->json(compact('success', 'class', 'bg_color', 'group'));
        }
    public function add_people(Request $request)
        {
        $thread_id = decrypt($request->thread_id);
        $group = $request->group_name;
        $people = explode(",", $request->people);
        $user_id = [];
        $arrPeople = [];
        $arrAdded = [];
        $find = Messages::all_participants($thread_id);
        if ($find)
            {
            $user_id = explode(",", $find->user_id);
            if (!isset($user_id))
                {
                $success = false;
                return response()->json(compact('success', 'people'));
                }
            for ($cnt = 0; $cnt <= count($user_id) - 1; $cnt++)
                {
                $arrPeople[] = $user_id[$cnt];
                }
            }
        if ($request->people)
            {
            for ($cnt = 0; $cnt <= count($people) - 1; $cnt++)
                {
                $arrAdded[] = decrypt($people[$cnt]);
                }
            for ($cnt = 0; $cnt <= count($people) - 1; $cnt++)
                {
                $arrData = ['thread_id' => $thread_id, 'user_id' => decrypt($people[$cnt]) , 'status' => 1, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() , ];
                DB::table('messenger_participants')->insert($arrData);
                }
            $merge = array_merge($arrPeople, $arrAdded);
            $arrlength = count($merge);
            for ($x = 0; $x < $arrlength; $x++)
                {
                $mergeSort[] = $merge[$x];
                $peopleNames[] = PersonalInformation::get_name($merge[$x]);
                }
            $user_id = implode(",", $mergeSort);
            $user_names = implode(", ", $peopleNames);
            $remaing_people = implode(",", $arrAdded);
            DB::table("messenger_threads")->where('id', $thread_id)->update(['subject' => $user_names]);
            $people = Messages::accounts($user_id);
            if (!$people)
                {
                $people = json_encode([]);
                }
            $rowId = decrypt($request->thread_id);
            $color = Accounts::theme_color();
            $class = "_" . $rowId . "tId";
            $bg_color = $color[0];
            $added = encrypt($user_id);
            $success = true;
            return response()->json(compact('success', 'added', 'people', 'thread_id', 'class', 'bg_color'));
            }
          else
            {
            $success = false;
            $people = json_encode([]);
            $thread_id = $request->thread_id;
            return response()->json(compact('success', 'people', 'thread_id'));
            }
        }
    public function added_people_list(Request $request)
        {
        $color = Accounts::theme_color();
        $people = Messages::people(decrypt($request->thread_id));
        $owner = Messages::owner(decrypt($request->thread_id));
        $html = view('messenger.parts.people', compact('people', 'color','owner'))->render();
        return response()->json(['html' => $html]);
        }
    public function remove_people(Request $request)
        {
        $uid = decrypt($request->uid);
        $thread_id = decrypt($request->thread_id);
        $delete = DB::table('messenger_participants')->where('user_id', $uid)->where('thread_id', $thread_id)->delete();
        $class = "_" . $thread_id . "tId";
        $find = Messages::all_participants($thread_id);
        $user_id = $find->user_id;
        $arrSubject = "";
        $arrUid = [];
        $arrThread = [];
        $arrThreadSort = [];
        $thread = "";
        $arrUidSort = [];
        $arrSubject = explode(",", $user_id);
        for ($cnt = 0; $cnt <= count($arrSubject) - 1; $cnt++)
            {
            if ($uid != $arrSubject[$cnt])
                {
                $arrUid[] = $arrSubject[$cnt];
                }
            }
        sort($arrUid);
        $arrlength = count($arrUid);
        for ($x = 0; $x < $arrlength; $x++)
            {
            $arrUidSort[] = $arrUid[$x];
            $arrThreadSort[] = PersonalInformation::get_name($arrUid[$x]);
            }
        if ($delete)
            {
            $user_names = implode(", ", $arrThreadSort); ///name
            $user_id = implode(",", $arrUidSort); /// id
            DB::table("messenger_threads")->where('id', decrypt($request->thread_id))->update(['subject' => $user_names]);
            $thread_id = encrypt($request->thread_id);
            $people = Messages::accounts($user_id);
            $added = encrypt($user_id);
            $success = true;
            $color = Accounts::theme_color();
            $bg_color = $color[0];
            $subject = Messages::find_subject(decrypt(decrypt($thread_id)));
            SystemLogs::saveLogs('leaved thread <b>' . str_limit($subject, $limit = 50, $end = '...') . '</b> in messenger!');
            return response()->json(compact('success', 'added', 'people', 'subject', 'thread_id', 'class', 'bg_color')); // DELETED PEOPLE
            }
          else
            {
            $success = false;
            return response()->json(compact('success'));
            }
        }
    public function store(Request $request)
        {
        $request->message ? $message = $request->message : $message = "";
        $all = $request->user_id_encrypted;
       
        if ($all == 'ALL USER'){
            $user_id_encrypted = DB::table('users')->select('id')->pluck('id')->implode(',');
            $user_id_encrypted = $user_id_encrypted;
            $find = DB::table('messenger_threads')->select('id')->where('party', $all)->first();
                if($find){
                    $thread_id = $find->id;
                }else{
                    $thread_id = "";
                }
            }else{
                $request->user_id_encrypted ? $user_id_encrypted = decrypt($request->user_id_encrypted) : $user_id_encrypted = "";
                $request->thread_id ? $thread_id = decrypt($request->thread_id) : $thread_id = "";
        }
      
        if (!$user_id_encrypted){
            $success = false;
            $errMsg = "Please specify at least one recipient!";
            return response()->json(compact('success', 'errMsg'));
        }

        if (!$message){
            $success = false;
            $errMsg = "Unable to send this message without a text in the body?";
            return response()->json(compact('success', 'errMsg'));
        }
        
        $new = 0;

        if ($thread_id && $user_id_encrypted){
            //existing
            $lastId = Messages::new_message($thread_id, $user_id_encrypted, $message);
            $who_seen = Messages::who_seen(encrypt($lastId));
            $new = 0;
        }else{
            //new
            $user_id_encrypted = $user_id_encrypted;
            $lastId = Messages::new_thread($user_id_encrypted, $message);
            $who_seen = Messages::who_seen(encrypt($lastId));
            $new = 1;
        }

        $color = Accounts::theme_color();
        $messages = [];
        $threads = [];
        $success = false;
        $thread_id = "";
        $user_id_encrypted = "";

        if($lastId){
            if($all == "ALL USER"){
                DB::table('messenger_threads')->where('id', $lastId)->update(['party' => 'ALL USER']);
            }

            $success = true;
            $threads = Messages::threads();
            $threads = view('messenger.parts.inbox_chat', compact('threads', 'color'))->render();
            $messages = Messages::message($lastId);
            $messages = view('messenger.parts.msg_history', compact('messages', 'color', 'lastId', 'who_seen'))->render();
            $subject = Messages::find_subject($lastId);
            
            if(!$subject){
                $subject = "You yourself!";
            }

            $subject = str_limit($subject, $limit = 80, $end = '...');
            $find = Messages::all_participants($lastId);
            $user_id_encrypted = encrypt($find->user_id);
            $people = Messages::accounts($find->user_id);
            $group_name = Messages::party_name($lastId);
            $added = encrypt($find->user_id);
            $thread_id = encrypt($lastId);
            $class = "_" . $lastId . "tId";
            $bg_color = $color[0];
        }

        if($new == 1){
                 SystemLogs::saveLogs('created new thread <b>' . str_limit($subject, $limit = 50, $end = '...') . '</b> in messenger!');
            }else{
                 SystemLogs::saveLogs('send message to <b>' . str_limit($subject, $limit = 50, $end = '...') . '</b> in messenger!');
        }


        return response()->json(compact('success', 'messages', 'threads', 'thread_id', 'user_id_encrypted', 'class', 'bg_color', 'subject', 'people'));
        }
    public function delete_message(Request $request)
        {
        $id = decrypt($request->id);
        $find = DB::table('messenger_messages')->where('id', $id)->first();
        $thread_id = $find->thread_id;
        DB::table('messenger_message_participants')->where('user_id', Auth::id())->where('thread_id', $find->thread_id)->where('message_id', $find->id)->delete();
        $color = Accounts::theme_color();
        $messages = [];
        $threads = [];
        $success = false;
        $user_id_encrypted = "";
        if ($thread_id)
            {
            $success = true;
            $threads = Messages::threads();
            $threads = view('messenger.parts.inbox_chat', compact('threads', 'color'))->render();
            $messages = Messages::message($thread_id);
            $who_seen = Messages::who_seen(encrypt($thread_id));
            $messages = view('messenger.parts.msg_history', compact('messages', 'color', 'who_seen'))->render();
            $subject = Messages::find_subject($thread_id);
            if (!$subject)
                {
                $subject = "You yourself!";
                }
            $subject = str_limit($subject, $limit = 80, $end = '...');
            SystemLogs::saveLogs('deleted a message of <b>' . str_limit($subject, $limit = 50, $end = '...') . '</b> in messenger!');
            $Thread = DB::select("SELECT GROUP_CONCAT(user_id) as user_id FROM messenger_participants as mp WHERE mp.thread_id = " . $thread_id . " AND status = 1") [0];
            $user_id_encrypted = encrypt($Thread->user_id);
            $people = Messages::accounts($Thread->user_id);
            $group_name = Messages::party_name($thread_id);
            $added = encrypt($Thread->user_id);
            $class = "_" . $thread_id . "tId";
            $thread_id = encrypt($thread_id);
            $bg_color = $color[0];
            }
        return response()->json(compact('success', 'messages', 'threads', 'thread_id', 'user_id_encrypted', 'class', 'bg_color', 'subject', 'people'));
        }
    }