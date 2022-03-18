<?php
use NotificationChannels\Facebook\FacebookMessage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('bioweb','BiometricController@bioweb');

Route::any('data/test/daily-time-records','BiometricController@daily_time_records_test');

Route::post('data/daily-time-records','BiometricController@daily_time_records');

Route::get('logout','AccountsController@logout');

Route::get('registration','AccountsController@registration');
Route::post('registration/store','AccountsController@registration_store');
Route::post('registration/faq','AccountsController@registration_faq_store');

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('eula','AccountsController@eula');
Route::post('eula-response','AccountsController@eula_response');




Auth::routes();

Route::group(['middleware' => 'eula'], function () {

		Route::group(['prefix' => 'messages'], function () {
		     Route::get('inbox', ['as' => 'messages', 'uses' => 'MessagesController@index']);
		     Route::post('inbox', ['as' => 'messages', 'uses' => 'MessagesController@inbox']);
		     Route::post('all-user', ['as' => 'messages', 'uses' => 'MessagesController@all_user']);
		     Route::post('search', ['as' => 'messages', 'uses' => 'MessagesController@search']);
		     Route::post('refresh', ['as' => 'messages', 'uses' => 'MessagesController@refresh']);
		     Route::post('history', ['as' => 'messages', 'uses' => 'MessagesController@history']);
		     Route::post('new', ['as' => 'messages', 'uses' => 'MessagesController@new_compose']);
		     Route::post('remove/people', ['as' => 'messages', 'uses' => 'MessagesController@remove_people']);
		     Route::post('add/people', ['as' => 'messages', 'uses' => 'MessagesController@add_people']);
		     Route::post('group/update', ['as' => 'messages', 'uses' => 'MessagesController@group_update']);
		     Route::post('added/peoples', ['as' => 'messages', 'uses' => 'MessagesController@added_people_list']);
		     Route::post('compose', ['as' => 'messages.create', 'uses' => 'MessagesController@store']);
		     Route::post('delete/message', ['as' => 'messages', 'uses' => 'MessagesController@delete_message']);
		     // Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
		     // Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
		     // Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
		});

		// Route::get('messages/inbox','MessagesController@index');
		// Route::get('messages/compose','MessagesController@create');

	Route::group(['middleware' => 'is.admin'], function () {	


		Route::get('faq/list','FAQController@index');

		Route::get('accounts/for/approval','AccountsController@for_approval');

		Route::get('account/create','AccountsController@create');
		Route::post('account/store','AccountsController@store');
		Route::get('accounts/manage','AccountsController@index');
		Route::post('account/status-change','AccountsController@change_status');
		Route::post('account/status-change/approved','AccountsController@change_status_approved');
		Route::post('account/destroy/{id}','AccountsController@destroy');
		Route::get('account/edit/{id}','AccountsController@edit');
		Route::post('account/update/{id}','AccountsController@update');
		Route::get('accounts/manage/table','AccountsController@table');

		Route::post('accounts/security-password','AccountsController@security_password');

	    Route::get('accounts/employee-status/manage','EmployeeStatusController@index');
	    Route::get('account/employee-status/create','EmployeeStatusController@create');
		Route::post('account/employee-status/store','EmployeeStatusController@store');
		Route::get('account/employee-status/edit/{id}','EmployeeStatusController@edit');
		Route::post('account/employee-status/update/{id}','EmployeeStatusController@update');
		Route::post('account/employee-status/destroy/{id}','EmployeeStatusController@destroy');
	    Route::get('accounts/employee-status/manage/table','EmployeeStatusController@table');



	    Route::get('accounts/division/manage','DivisionController@index');
	    Route::get('accounts/division/create','DivisionController@create');
		Route::post('account/division/store','DivisionController@store');
		Route::get('account/division/edit/{id}','DivisionController@edit');
		Route::post('account/division/update/{id}','DivisionController@update');
		Route::post('account/division/destroy/{id}','DivisionController@destroy');
	    Route::get('accounts/division/table','DivisionController@table');

	    Route::get('accounts/position/manage','PositionController@index');
	    Route::get('account/position/create','PositionController@create');
		Route::post('account/position/store','PositionController@store');
		Route::get('account/position/edit/{id}','PositionController@edit');
		Route::post('account/position/update/{id}','PositionController@update');
		Route::post('account/position/destroy/{id}','PositionController@destroy');
	    Route::get('accounts/position/table','PositionController@table');

		Route::get('personal-data-sheet-table','PDSTableController@index');
		Route::post('personal-data-sheet-table/send-request','PDSTableController@send_request');
		// Route::post('reports/personal-data-sheet-table/send-request','PDSTableController@send_request');
		Route::post('personal-data-sheet-table/send-request-to-all','PDSTableController@send_request_to_all');
		Route::post('personal-data-sheet-table/send-request-selected-unit','PDSTableController@send_request_to_selected_unit');

		Route::get('personal-data-sheet-table/employees-table','AccountsController@employees_table');
		Route::get('sworn-statement-assets-liabilities-net-worth/employees-table','AccountsController@employees_table');

		Route::get('sworn-statement-assets-liabilities-net-worth','SSALNWController@index');
		// Route::post('sworn-statement-assets-liabilities-net-worth/upload-file','PDSTableController@upload_file');

		Route::get('service-records','ServiceRecordController@index');
		//Route::get('reports/service-record/list/{id}','ServiceRecordController@service_record_list');
		
		Route::get('reports/service-record/work-exp/{id}','ServiceRecordController@service_record_work_exp');
		Route::get('reports/service-record/certification/{id}','ServiceRecordController@service_record_certification');
	
		Route::get('reports/civil-service-eligibilty','ReportsController@civil_service_eligibilty');
		Route::get('reports/work-experience','ReportsController@work_experience');
		Route::get('reports/voluntary-works','ReportsController@voluntary_works');
		Route::get('reports/learning-development-training','ReportsController@learning_development_training');

		Route::get('reports/employees/birthday/{month}','ReportsController@birthday_celebrants');
	
		Route::get('reports/employees/age/{from}/{to}','ReportsController@employees_age_list');
		Route::post('reports/employees/age/range','ReportsController@employees_age_range');

		Route::get('reports/employees/years/{from}/{to}','ReportsController@employees_years_list');
		Route::post('reports/employees/years/range','ReportsController@employees_years_range');

		Route::get('reports/employees/menu','ReportsController@employees_list_menu');
		Route::any('reports/employees-list','ReportsController@employees_list');
		
		// Route::post('reports/certification-one','ReportsController@service_record_cert_one');
		Route::post('reports/certification','ReportsController@service_record_cert');
		Route::get('reports/leave-card','LeaveApplicationController@leave_card');
		Route::get('reports/leave-info/{id}','LeaveApplicationController@leave_info');
		Route::get('leave-management/make','LeaveApplicationController@leave_card_make');
		Route::get('leave-management/applications','LeaveApplicationController@leave_applications');

		//Route::get('leave-management/details','LeaveCardController@details'); ///////////////////////

		Route::get('leave-management/applications/{id}/{status}','LeaveApplicationController@leave_applications_status_update');
		Route::get('reports/leave/{status}','LeaveApplicationController@report_leave_status');
		
		Route::get('leave-management/details/{year}/{uid}','LeaveCardController@details');
		Route::post('leave-management/details/{year}/{uid}','LeaveCardController@year_filter');
		Route::get('leave-management/employees','LeaveCardController@leave_card_users_management');

		Route::get('leave-management/create/{uid}','LeaveCardController@create');

		Route::post('leave-management/leave-card/store','LeaveCardController@store');

		Route::get('upload/form','UploadFilesController@upload_form');
		Route::post('upload/attendance','UploadFilesController@upload_attendance');

		Route::get('employee-biometric-attendance','EmployeeBiometricAttendanceController@index');
		Route::get('employee-biometric-attendance/user/{uid}','EmployeeBiometricAttendanceController@biometric_view');
	    Route::post('employee-biometric-attendance/data','EmployeeBiometricAttendanceController@biometric_data');


	});

		Route::get('reports/civil-service-eligibilty/{id}','ReportsController@find_civil_service_eligibilty');
	    Route::get('reports/work-experience/{id}','ReportsController@find_work_experience');
		Route::get('reports/voluntary-works/{id}','ReportsController@find_voluntary_works');
		Route::get('reports/learning-development-training/{id}','ReportsController@find_learning_development_training');

		Route::post('reports/pdf/service-record','ReportsController@pdf_service_record');
		Route::post('reports/service-record/update','ServiceRecordController@service_record_update');

		Route::get('reports/service-record/list/{agency_type}/{id}','ServiceRecordController@service_record_list_selected');

		Route::get('reports/audit-trail/{id}','ReportsController@audit_trail');

		Route::get('reports/daily-time-record/monthly','BiometricController@dtr_monthly');

		Route::get('notifications','NotificationController@index');
		Route::post('notifications/list','NotificationController@notification_list');
		Route::post('notifications/seen','NotificationController@notification_seen');
		Route::post('tasks/list','NotificationController@task_list');
		Route::post('settings/change-theme','AccountsController@change_theme');
		Route::post('settings/gmail-notification/{switch}','AccountsController@gmail_notification');
		Route::post('settings/fb-messenger-notification/{switch}','AccountsController@fb_messenger_notification');
		Route::post('settings/send-verification-code','AccountsController@send_verification_code');

		
	Route::get('personal-data-sheet-table/view/confirm/{thread_id}','PDSTableController@pds_view_request_confirmation');
	Route::post('personal-data-sheet-table/confirm','PDSTableController@pds_request_confirmation');

	Route::get('personal-data-sheet/download/{id}','PDSTableController@download_pds');

	Route::get('sworn-statement-assets-liabilities-net-worth/download/{id}','SSALNWController@download_ssalnw');

	Route::get('/dashboard','HomeController@index');


	Route::get('/manage-accounts/name','UpdatePersonalAccountController@name');
	Route::get('/manage-accounts/username','UpdatePersonalAccountController@username');
	Route::get('/manage-accounts/password','UpdatePersonalAccountController@password');
	Route::get('/manage-accounts/email','UpdatePersonalAccountController@email');
	Route::get('/manage-accounts/first-login','UpdatePersonalAccountController@first_login');
	Route::get('/manage-accounts/profile-picture','UpdatePersonalAccountController@profile_picture');


	Route::post('/manage-accounts/update-name','UpdatePersonalAccountController@update_name');
	Route::post('/manage-accounts/update-username','UpdatePersonalAccountController@update_username');
	Route::post('/manage-accounts/update-password','UpdatePersonalAccountController@update_password');
	Route::post('/manage-accounts/update-email','UpdatePersonalAccountController@update_email');
	Route::post('/manage-accounts/update-first-login','UpdatePersonalAccountController@update_first_login_password');
	Route::post('/manage-accounts/update-profile-picture','UpdatePersonalAccountController@update_profile_picture');

	Route::post('/manage-accounts/admin/{set}','UpdatePersonalAccountController@change_account');


	Route::get('personal-data-sheet/{id}','PDSController@index');
	Route::post('personal-data-sheet/store-personal-information','PDSController@store_personal_information');
	Route::post('personal-data-sheet/store-family-background','PDSController@store_family_background');
	Route::post('personal-data-sheet/store-educational-background','PDSController@store_educational_background');
	Route::post('personal-data-sheet/store-civil-service-eligibility','PDSController@store_civil_service_eligibility');
	Route::post('personal-data-sheet/store-work-experience','PDSController@store_work_experience');
	Route::post('personal-data-sheet/store-voluntary-work-involvement','PDSController@store_voluntary_work_involvement');
	Route::post('personal-data-sheet/store-learning-development-intervention','PDSController@store_learning_development_intervention');
	Route::post('personal-data-sheet/store-other-information','PDSController@store_other_information');
	Route::post('personal-data-sheet/store-survey','PDSController@store_survey');

	Route::get('sworn-statement-assets-liabilities-net-worth/{id}','SSALNWController@ssalnw');
	Route::post('sworn-statement-assets-liabilities-net-worth/store-assets-real-properties','SSALNWController@assets_real_properties');
	Route::post('sworn-statement-assets-liabilities-net-worth/store-assets-personal-properties','SSALNWController@assets_personal_properties');
	Route::post('sworn-statement-assets-liabilities-net-worth/store-liabilities','SSALNWController@assets_liabilities');
	Route::post('sworn-statement-assets-liabilities-net-worth/store-business-interest-and-financial','SSALNWController@business_interest_and_financial');
	Route::post('sworn-statement-assets-liabilities-net-worth/store-relatives-government-service','SSALNWController@relatives_government_service');

	Route::get('sworn-statement-assets-liabilities-net-worth/archived/{id}','SSALNWController@archived');

	Route::post('sworn-statement-assets-liabilities-net-worth/send-request','SSALNWController@send_request');
	Route::post('sworn-statement-assets-liabilities-net-worth/send-request-to-all','SSALNWController@send_request_to_all');
	Route::post('sworn-statement-assets-liabilities-net-worth/send-request-selected-unit','SSALNWController@send_request_to_selected_unit');

	Route::get('sworn-statement-assets-liabilities-net-worth/view/confirm/{thread_id}','SSALNWController@ssalnw_view_request_confirmation');
	Route::post('sworn-statement-assets-liabilities-net-worth/confirm','SSALNWController@ssalnw_request_confirmation');

	Route::get('leave/application','LeaveApplicationController@index');
	Route::get('leave/application/{id}','LeaveApplicationController@edit');
	Route::post('leave/application/update','LeaveApplicationController@update');
	Route::get('leave/pdf/application/{id}','LeaveApplicationController@application_printout');
	Route::get('leave/all-request/{id}','LeaveApplicationController@request');
	Route::post('leave/application/store','LeaveApplicationController@store');


	// Route::get('image/upload','UploadFilesController@fileCreate');
	// Route::post('image/upload/store','UploadFilesController@fileStore');
	// Route::post('image/delete','UploadFilesController@fileDestroy');
	Route::any('image/upload','UploadFilesController@index');
	Route::get('image/download/{id}','UploadFilesController@download_file');

	Route::post('salary/autocompute','AccountsController@salary_autocompute');

	Route::get('facebook-challenge','FacebookController@push_facebook');


	
	Route::get('email-test',function(){

	 		FacebookMessage::create('test message')->to("kristianangelo.santiago");

	// 	$to_name = 'John Doe';
 //        $to_email = ['dohro2ehrs@gmail.com','mark.palig@gmail.com','kristianangelosantiago@gmail.com','testinglang@gmail.com','kristianangelosantiago@yahoo.com','mkpalig@spup.edu.ph,emailnotification349@gmail.com'];
 //        $from_email = 'dohro2ehrs@gmail.com';
 //        $data = array('name'=>"Mark", "body" => "hello mark");

 //        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email,$from_email) {
 //        $message->to($to_email, $to_name)
 //             ->subject('Web Testing Mail');
 //        $message->from($from_email,'Artisans Web');
 //        });
 //        dd("Testing Email!");//Sending Email
 //        echo 1;exit;
 });





});