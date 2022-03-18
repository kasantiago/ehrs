<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;
use App\FAQ;

class FAQController extends Controller
{
  
   public function index(){

    SystemLogs::saveLogs('visited manage faq page!'); 

    $color = Accounts::theme_color();
  
    $faq = FAQ::all();

    //echo "<pre>";
    //print_r($faq);exit;

    return view('faq',['faq' => $faq, 'color' => $color]);
  }

}
