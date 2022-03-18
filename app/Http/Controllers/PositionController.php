<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Position as Position;
use Validator;
use App\User as User;
use DB;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\Accounts as Accounts;

class PositionController extends Controller
{
   	public function index(){
      $color = Accounts::theme_color();
      SystemLogs::saveLogs('visited manage position page!'); 
		  $position = Position::where('flag',1)->get();
      return view('position-manage',['position' => $position, 'color' => $color]);
    }

    public function create(){
      $color = Accounts::theme_color();
    	return view('position-create',['color' => $color]);
    }

    public function store(Request $request){
       SystemLogs::saveLogs('visited create position page!'); 
    	  $validation = Validator::make($request->all(), [
  
            'name' => 'required|unique:position',
            // 'details' => 'required',
  
            ],[
            	'name.required' => 'The position field is required.',
            ]);


      if($validation->passes())

        {
        
            $save = New Position;
            $save->name = strtoupper($request->name);
            $save->details = strtoupper($request->details);
             if($save->save()) {
                SystemLogs::saveLogs('successfully created '.$request->name.' position!'); 
                  $msg =  $request->name.' position has been successfully added!';
                  $request->session()->flash('msg',$msg);
                  return response()->json([ 'success' => true,'message' => 'record added','url' => url('accounts/position/manage') ]);
             }
        }

     
        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);

    }

    public function edit($id){
       
    	$id = decrypt($id);
      $position = Position::find($id);
      SystemLogs::saveLogs('visited edit '.$position->name.' position page!'); 
      $color = Accounts::theme_color();
      return view('position-edit',['position' => $position,'color' => $color]);
    }

    public function update(Request $request, $id)
    {
     
      $id = decrypt($id);
    	 
      $validation = Validator::make($request->all(), [
  
            'name' => 'required|unique:position,id,'.$id,
            // 'details' => 'required',
  
            ],[
            	'name.required' => 'The position field is required.',
            ]);


      if($validation->passes())

        {
        
            $save = Position::find($id);
            DB::table('users')->where('position',$save->name)->update(['position' => $request->name]);

            $save->name = strtoupper($request->name);
            $save->details = strtoupper($request->details);
             if($save->save()) {
              SystemLogs::saveLogs('successfully updated '.$request->name.' position!'); 
              $msg = $request->name.' position has been successfully updated!';
              $request->session()->flash('msg',$msg);

                  return response()->json([ 'success' => true,'message' => 'record updated','url' => url('accounts/position/manage') ]);

             }
        }

     

        $errors = $validation->errors();
        $errors =  json_decode($errors); 
        
        return response()->json(['success' => false,'message' => $errors]);
    }

      public function destroy(Request $request, $id)
    {
        $id = decrypt($request->id);
        $update = Position::find($id);
        $update->flag = 0;

         $count_position = User::where('position',$update->name)->count();
         User::where('position',$update->name)->update(['position'=> '']);

         $name = $update->name;
         $update->name = '';

        if($update->save()){
          SystemLogs::saveLogs('successfully deleted '.$update->name.' position!'); 
            $msg = '<strong><font size="3" color="green">'.$name.' position has been successfully deleted! <br> <b>('.$count_position.')</b> employee/s number of records affected. </font></strong>';
            return response()->json(['success' => true,'message' => $msg,'page' => url('accounts/position/table')]);
        }
        return response()->json(['success' => false,'message' => '<strong><font size="3" color="red">An error has occurred while  updating record! </font></strong>','page' => url('accounts/position/table')]);

    }

  
    public function table(){
        $position = Position::where('flag',1)->get();
        $color = Accounts::theme_color();
        $html =  view('position-table',['position' => $position,'color' => $color])->render();
        return response()->json(['html' => $html]);
    }
    
  
}
