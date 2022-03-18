<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Division as Division;
use Validator;
use App\User as User;
use DB;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\Messages as Messages;

class DivisionController extends Controller
{
    public function index(){

      $color = Accounts::theme_color();
      SystemLogs::saveLogs('visited manage division page!'); 

      $division = Division::where('flag',1)->get();
      return view('division-manage',['division' => $division, 'color' => $color]);
    }

    public function create(){

      $accounts = Accounts::accounts();
      SystemLogs::saveLogs('visited create division page!');
      $color = Accounts::theme_color();

      return view('division-create', ['color'=> $color,'accounts' => $accounts]);
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
  
            'name' => 'required|unique:division',
  
            ],[
              'name.required' => 'The division field is required.',
            ]);


      if($validation->passes())

        {
        
            $save = New Division;
            $save->name = strtoupper($request->name);
            $save->details = strtoupper($request->details);
            $save->unit_head = $request->unit_head;
            $save->leave_approval_setting = $request->leave_approval_setting ? $request->leave_approval_setting : 0;
             if($save->save()) {
                  SystemLogs::saveLogs('successfully created '.$request->name.' division!'); 
                  $msg =  $request->name.' division has been successfully added!';
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('accounts/division/manage') ]);
             }
        }

     
        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }

    public function edit($id){
      
        $id = decrypt($id);
        $division = Division::find($id);
        SystemLogs::saveLogs('visited edit '.$division->name.' division page!'); 
        $color = Accounts::theme_color();
    
        $selected_uid = $division->unit_head ? $division->unit_head : '';
        $accounts = Accounts::accounts_selected($selected_uid);
        
        return view('division-edit',['division' => $division,'color'=> $color,'accounts' => $accounts,'selected_uid' => $selected_uid] );
    }

    public function update(Request $request, $id)
    {
     
      $id = decrypt($id);
       
      $validation = Validator::make($request->all(), [
  
            'name' => 'required|unique:division,id,'.$id,
  
            ],[
              'name.required' => 'The division field is required.',
            ]);


      if($validation->passes())

        {
        
            $save = Division::find($id);
            DB::table('users')->where('division',$save->name)->update(['division' => $request->name]);

            $save->name = strtoupper($request->name);
            $save->details = $request->details;
            $save->unit_head = $request->unit_head;
            $save->leave_approval_setting = $request->leave_approval_setting ? $request->leave_approval_setting : 0;
             if($save->save()) {
              SystemLogs::saveLogs('successfully updated '.$request->name.' division!'); 
              $msg = $request->name.' division has been successfully updated!';
              $request->session()->flash('msg',$msg);

                  return response()->json([ 'success' => true,'message' => 'record updated','url' => url('accounts/division/manage') ]);

             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }

      public function destroy(Request $request, $id)
    {
        $id = decrypt($request->id);
        $update = Division::find($id);
        $update->flag = 0;


         $count_division = User::where('division',$update->name)->count();
         User::where('division',$update->name)->update(['division'=> '']);

         $name = $update->name;
         $update->name = '';

        if($update->save()){
          SystemLogs::saveLogs('successfully deleted '.$update->name.' division!'); 
            $msg = '<strong><font size="3" color="green">'.$name.' division has been successfully deleted! <br> <b>('.$count_division.')</b> employee/s number of records affected. </font></strong>';
            return response()->json(['success' => true,'message' => $msg,'page' => url('accounts/division/table')]);
        }
        return response()->json(['success' => false,'message' => '<strong><font size="3" color="red">An error has occurred while  updating record! </font></strong>','page' => url('accounts/division/table')]);

    }

  
    public function table(){
        $division = Division::where('flag',1)->get();
        $color = Accounts::theme_color();
        $html =  view('division-table',['division' => $division,'color' => $color])->render();
        return response()->json(['html' => $html]);
    }
    
 
}
