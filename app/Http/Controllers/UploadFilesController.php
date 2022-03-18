<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User as User;
use Validator;
use App\Http\Models\Accounts as Accounts;
use App\Http\Models\PersonalInformation as PersonalInformation;
use App\Http\Models\SystemLogs as SystemLogs;
use App\Http\Models\EmailNotification as EmailNotification;
use App\Http\Models\Notifications as Notifications;
use App\Http\Models\Messages as Messages;
use App\Http\Models\Upload as Upload;
use DB;
use PDF;
use Auth;
use File;
use Session;

class UploadFilesController extends Controller
{
    public function index()
    {
        $color = Accounts::theme_color();
        $filesId = Auth::id();
        $folder_name = public_path().'/storage/files/' . $filesId . '/';
        $scan_folder = public_path().'/storage/files/' . $filesId;
        File::makeDirectory($folder_name, $mode = 0777, true, true);

        if(!empty($_FILES))
        {
          $file_name = $_FILES['file']['name'];
          $temp_file = $_FILES['file']['tmp_name'];

          $tmp_file_ext = explode('.', $file_name);
          $file_ext = strtolower(end($tmp_file_ext));
          $saved_name = date('Y-m-d').'.'.$file_ext;

          $location = $folder_name . $saved_name;
          SystemLogs::saveLogs('uploaded a Notarized SSALNW! ('.$saved_name.')');
          move_uploaded_file($temp_file, $location);
        }

        if(isset($_POST["name"]))
        {
          $filename = $folder_name.$_POST["name"];
          SystemLogs::saveLogs('deleted a Notarized SSALNW! ('.$_POST["name"].')');
          unlink($filename);
        }

        $result = array();

        $files = scandir($scan_folder);

        $output = '<div class="row">';

        if(false !== $files)
        {
         foreach($files as $file)
         {
          if('.' !=  $file && '..' != $file)
          {
            $pdf_thmb = substr($file, -3);

            if ($pdf_thmb == "pdf"){
              $output .= '
                
                <div class="col-sm-6 col-md-4">
                  <figure class="effect-terry">
                    <img src="'.asset('storage/files/pdf-logo.png').'"/>
                    <figcaption>
                      <h2 style="margin-left: 0px;">'.$file.'</h2>
                      <p>
                        <a href="'.url('image/download/'.encrypt($file)).'" class="btn '.$color[0].' btn-circle waves-effect waves-grey waves-circle waves-float" title="Download File"><i class="material-icons">file_download</i></a>
                        <a href="#" type="button" class="btn '.$color[0].' remove_file btn-circle waves-effect waves-grey waves-circle waves-float" id="'.$file.'" title="Delete Forever"><i class="material-icons">delete_forever</i></a>
                      </p>
                    </figcaption>     
                  </figure>
                </div>
                
                ';
            }
            else{
              $output .= '

                <div class="col-sm-6 col-md-4">
                  <figure class="effect-terry">
                    <img src="'.asset('storage/files/'.$filesId.'/'.$file.'/').'"/>
                    <figcaption>
                      <h2>'.$file.'</h2>
                      <p>
                        <a href="'.url('image/download/'.encrypt($file)).'" class="btn '.$color[0].' btn-circle waves-effect waves-grey waves-circle waves-float" title="Download File"><i class="material-icons">file_download</i></a>
                        <a href="#" type="button" class="btn '.$color[0].' remove_file btn-circle waves-effect waves-grey waves-circle waves-float" id="'.$file.'" title="Delete Forever"><i class="material-icons">delete_forever</i></a>
                      </p>
                    </figcaption>     
                  </figure>
                </div>

                ';
            }
          }
         }
        }
        $output .= '</div>';
        echo $output;
    }

    public function download_file($id)
    {
        $id = decrypt($id);
        $filesId = Auth::id();
        $folder_name = public_path().'/storage/files/' . $filesId . '/' . $id;
        $name = basename($folder_name);

        if (file_exists($folder_name)) {
          return response()->download($folder_name, $name);
        }
        
    }
    
    public function fileCreate()
    {
        return view('ssalnw_archived');
    }

    public function fileStore(Request $request)
    {
        $filesId = Auth::id();
        $path = public_path().'/storage/files/' . $filesId;
        File::makeDirectory($path, $mode = 0777, true, true);

        $image = $request->file('file');
        $fileName = $image->getClientOriginalName();
        $image->move($path, $fileName);

        $upload = new Upload();
        $upload->filename = $fileName;
        $upload->user_id = Auth::id();
        $upload->save();
        return response()->json(['success'=>$fileName]);
    }

    public function fileDestroy(Request $request)
    {
        $filesId = Auth::id();
        $filename =  $request->get('filename');
        $path = public_path().'/storage/files/' . $filesId . '/' . $filename;

        Upload::where('filename', $filename)->delete();
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }

    public function upload_form(){

      $color = Accounts::theme_color();
      SystemLogs::saveLogs('visited upload employees attendance (.dat extension file)) page!');
      return view('upload-attendance',['color' => $color]);

    }

    public function upload_attendance(Request $request){

      $color = Accounts::theme_color();
      $filesId = Auth::id();

    if ($request->input('submit') != null ){

      $file = $request->file('file');

      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("dat");

      // 2MB in Bytes
      $maxFileSize = 2097152; 

      // Check file extension
      if(in_array(strtolower($extension),$valid_extension)){

        // Check file size
        if($fileSize <= $maxFileSize){

          // File upload location
          $location = public_path().'/storage/files/' . $filesId;

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = public_path().'/storage/files/' . $filesId . '/' .$filename;

          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 1000, " ")) !== FALSE) {
             $num = count($filedata );
             
             // Skip first row (Remove below comment if you want to skip the first row)
             /*if($i == 0){
                $i++;
                continue; 
             }*/
             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
          }
          fclose($file);

          // Insert to MySQL database
          foreach($importData_arr as $importData){

            if ($importData[3] == ""){

              $insertData = array(
               "bio_id"=>$importData[4],
               "bio_date"=>$importData[5],
               "bio_time"=>$importData[6],
               "bio_one"=>$importData[7],
               "bio_two"=>$importData[8],
               "bio_three"=>$importData[9],
               "bio_four"=>$importData[10]);
              Upload::insertData($insertData);

            }else{

              $insertData = array(
               "bio_id"=>$importData[3],
               "bio_date"=>$importData[4],
               "bio_time"=>$importData[5],
               "bio_one"=>$importData[6],
               "bio_two"=>$importData[7],
               "bio_three"=>$importData[8],
               "bio_four"=>$importData[9]);
              Upload::insertData($insertData);

            }
            
          }

          Session::flash('message','Import Successful.');
        }else{
          Session::flash('message','File too large. File must be less than 2MB.');
        }

      }else{
         Session::flash('message','Invalid File Extension.');
      }

    }

    // Redirect to index
    return redirect()->action('UploadFilesController@upload_form');
  }

}
