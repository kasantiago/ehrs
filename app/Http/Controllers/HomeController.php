<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User as User;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Dashboard as Dashboard;
use App\Http\Models\Accounts as Accounts;
use Carbon\Carbon as Carbon;
use App\Http\Models\Notifications as Notifications;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        Notifications::menu();

        $task =  Notifications::task(Auth::id());
 
        SystemLogs::saveLogs('visited dashboard page!');
        $color = Accounts::theme_color();

        $user_id = Auth::user()->id;
        $emp_status = Dashboard::emp_status_users();
        $pds_progress = Dashboard::pds_progress_users();
        $my_pds_progress = Dashboard::my_pds_progress($user_id);
        $pds = Dashboard::dashboard_pds();
        $bday = Dashboard::current_birthday_list();
        $age = Dashboard::retirees_list();
        $audit = Dashboard::audit_trail();
        $month_now = Carbon::now()->format('m');
        $retirees_age = '65';
        $eula = "asd asd asd asdas d";

        return view('dashboard',[
            'emp_status' => $emp_status,
            'pds_progress' => $pds_progress,
            'my_pds_progress' => $my_pds_progress,
            'pds' => $pds,
            'bday' => $bday,
            'age' => $age,
            'audit' => $audit,
            'month_now' => $month_now,
            'retirees_age' => $retirees_age,
            'color' => $color,
            'eula' => $eula,
        ]);

        // echo "<pre>";
        // print_r($pds);exit;
    }


}
