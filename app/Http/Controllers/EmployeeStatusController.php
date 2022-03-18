<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\EmployeeStatus as EmployeeStatus;
use Validator;
use App\User as User;
use DB;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;

class EmployeeStatusController extends Controller
{
   	public function index(){
      $color = Accounts::theme_color();
      SystemLogs::saveLogs('visited manage employee status page!'); 
  		$employee_status = EmployeeStatus::where('flag',1)->get();
      return view('employee-status-manage',['employee_status' => $employee_status, 'color' => $color]);
    }

    public function create(){
      SystemLogs::saveLogs('visited create employee status page!'); 
      $color = Accounts::theme_color();
    	return view('employee-status-create', ['color' => $color]);
    }

    public function store(Request $request){
    	  $validation = Validator::make($request->all(), [
  
            'name' => 'required|unique:employee_status',
  
            ],[
            	'name.required' => 'The employee status field is required.',
            ]);


      if($validation->passes())

        {
        
            $save = New EmployeeStatus;
            $save->name = strtoupper($request->name);
            $save->details = strtoupper($request->details);
             if($save->save()) {
                  SystemLogs::saveLogs('successfully created '.$request->name.' employee status!'); 
                  $msg =  $request->name.' employee status has been successfully added!';
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('accounts/employee-status/manage') ]);
             }
        }

     
        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }

    public function edit($id){
     
    	$id = decrypt($id);
      $employee_status = EmployeeStatus::find($id);
      SystemLogs::saveLogs('visited edit '.$employee_status->name.' employee status page!');
      $color = Accounts::theme_color();
      return view('employee-status-edit',['employee_status' => $employee_status,'color'=> $color]);
    }

    public function update(Request $request, $id)
    {
     
      $id = decrypt($id);
    	 
      $validation = Validator::make($request->all(), [
  
            'name' => 'required|unique:employee_status,id,'.$id,
  
            ],[
            	'name.required' => 'The employee status field is required.',
            ]);


      if($validation->passes())

        {
        
              $save = EmployeeStatus::find($id);
              DB::table('users')->where('employee_status',$save->name)->update(['employee_status' => $request->name]);
              
              $save->name = strtoupper($request->name);
              $save->details = strtoupper($request->details);

             if($save->save()) {
              SystemLogs::saveLogs('successfully updated '.$request->name.' employee status!'); 
              $msg = $request->name.' employee status has been successfully updated!';
              $request->session()->flash('msg',$msg);

                  return response()->json([ 'success' => true,'message' => 'record updated','url' => url('accounts/employee-status/manage') ]);

             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }

      public function destroy(Request $request, $id)
    {
         $id = decrypt($request->id);
         $update = EmployeeStatus::find($id);
         $update->flag = 0;

         $count_employee_status = User::where('employee_status',$update->name)->count();
         User::where('employee_status',$update->name)->update(['employee_status'=> '']);

         $name = $update->name;
         $update->name = '';
       
        if($update->save()){
           SystemLogs::saveLogs('successfully deleted '.$update->name.' employee status!'); 
            $msg = '<strong><font size="3" color="green">'.$name.' employee status has been successfully deleted! <br> <b>('.$count_employee_status.')</b> employee/s number of records affected. </font></strong>';
            return response()->json(['success' => true,'message' => $msg,'page' => url('accounts/employee-status/manage/table')]);
        }
        return response()->json(['success' => false,'message' => '<strong><font size="3" color="red">An error has occurred while  updating record! </font></strong>','page' => url('accounts/employee-status/manage/table')]);

    }

  
    public function table(){
        $employee_status = EmployeeStatus::where('flag',1)->get();
        $color = Accounts::theme_color();
        $html =  view('employee-status-table',['employee_status' => $employee_status,'color' => $color])->render();
        return response()->json(['html' => $html]);
    }
    
  
}
