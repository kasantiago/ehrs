@extends('layouts.app')
@section('title','PERSONAL DATA INFORMATION FORM')

@section('content')

    <!-- Basic Example | Vertical Layout -->
            <div class="row clearfix" id="body-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3>{!! strtoupper(App\Http\Models\PersonalInformation::get_name(decrypt($uid))) !!}</h3>
                            <h2>PERSONAL DATA SHEET FORM </h2>

                            <hr style="margin-top: 20px; margin-bottom: 20px; border: 0; border-top: 1px solid #eee;">

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-xs-12" align="right">
                                    <a type="button" href="{{ url('personal-data-sheet') }}/download/{{$uid}}" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;" target="_blank">
                                    <i class="material-icons">picture_as_pdf</i> &nbsp; PDS &nbsp;  <i class="material-icons">file_download</i> 
                                    </a>
                                </div>
                              </div>
                            </div>

                        </div>
                        <div class="body">
                            <div id="wizard_vertical">

                                <h2><small>PERSONAL INFORMATION</small></h2>
                                <section>
                                  

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>PERSONAL INFORMATION</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-personal-information') !!}">
                                                
                                                    {!! csrf_field() !!}
                                                    <input name="uid" type="hidden" value="{!! $uid !!}">
                                   

                                                       
                                                         <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->surname ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control all-caps" name="surname" value="{!! $personal_information->surname !!}" required aria-required="true" maxlength="255">
                                                                    <label class="form-label" >Surname</label> 
                                                                </div>
                                                                <label id="surname-error" class="error" for="surname"></label>
                                                              </div>
                                                  
                                                             <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->first_name ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control all-caps" name="first_name" value="{!! $personal_information->first_name !!}" required aria-required="true" maxlength="255">
                                                                    <label class="form-label" >First Name</label>
                                                                </div>
                                                                <label id="first_name-error" class="error" for="first_name"></label>
                                                             </div>
                                                            </div>




                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->middle_name ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control all-caps" name="middle_name" value="{!! $personal_information->middle_name !!}" required aria-required="true" maxlength="255">
                                                                    <label class="form-label" >Middle Name</label>
                                                                </div>
                                                                <label id="middle_name-error" class="error" for="middle_name"></label>
                                                              </div>
                                                         
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->name_extension ? 'focused' : '' !!}">
                                                                    
                                                                      <select class="form-control show-tick" name="name_extension">
                                                                        <option {!! !$personal_information->name_extension ? 'selected' : '' !!} disabled> Name Extension (JR./SR.)</option>
                                                                        <option value="" {!! $personal_information->name_extension == '' ? 'selected' : '' !!} > Name Extension (N/A) </option>
                                                                        <option value="JR." {!! $personal_information->name_extension == 'JR.' ? 'selected' : '' !!} >JR.</option>
                                                                        <option value="SR." {!! $personal_information->name_extension == 'SR.' ? 'selected' : '' !!} >SR.</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                                <label id="name_extension-error" class="error" for="name_extension"></label>
                                                              </div>
                                                            </div> 

                                                            <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                    
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->date_of_birth ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control date" name="date_of_birth" value="{!! $personal_information->date_of_birth ? date('m/d/Y', strtotime($personal_information->date_of_birth))  : '' !!}" required aria-required="true" maxlength="10">
                                                                    <label class="form-label" >Date of Birth (mm/dd/yyyy)</label>
                                                                </div>
                                                                <label id="date_of_birth-error" class="error" for="date_of_birth"></label>
                                                              </div>
                                                          
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->place_of_birth ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control all-caps" value="{!! $personal_information->place_of_birth !!}" name="place_of_birth" required aria-required="true" maxlength="255">
                                                                    <label class="form-label" >Place of Birth</label>
                                                                </div>
                                                                <label id="place_of_birth-error" class="error" for="place_of_birth"></label>
                                                              </div>
                                                            </div>  

                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line">
                                                                    <input type="radio" name="sex" id="male" value="1" class="with-gap" {!! $personal_information->sex == 1 ? 'checked' : '' !!}>
                                                                    <label for="male">Male</label>

                                                                    <input type="radio" name="sex" id="female" value="2" class="with-gap" {!! $personal_information->sex == 2 ? 'checked' : '' !!}>
                                                                    <label for="female" class="m-l-20">Female</label>
                                                                </div>
                                                                <label id="sex-error" class="error" for="sex"></label>
                                                              </div>
                                                            
                                                                <div class="col-md-6">
                                                                <div class="form-line">
                                                                    <select class="form-control show-tick" name="civil_status">
                                                                        <option {!! !$personal_information->civil_status  ? 'selected' : '' !!} disabled>Select Civil Status</option>
                                                                        <option value="1" {!! $personal_information->civil_status == '1'  ? 'selected' : '' !!} >Single</option>
                                                                        <option value="2" {!! $personal_information->civil_status == '2'  ? 'selected' : '' !!} >Widowed</option>
                                                                        <option value="3" {!! $personal_information->civil_status == '3'  ? 'selected' : '' !!} >Married</option>
                                                                        <option value="4" {!! $personal_information->civil_status == '4'  ? 'selected' : '' !!} >Seperated</option>
                                                                        <option value="5" {!! $personal_information->civil_status == '5'  ? 'selected' : '' !!} >Other/s</option>
                                                                    </select>
                                                                </div>
                                                                <label id="civil_status-error" class="error" for="civil_status"></label>
                                                              </div>
                                                            </div>  

                                                            <div class="form-group form-float">

                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->weight ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control number" maxlength="4" value="{!! $personal_information->weight !!}" name="weight" required aria-required="true">
                                                                    <label class="form-label" >Weight (kg)</label>
                                                                </div>
                                                                <label id="weight-error" class="error" for="weight"></label>
                                                              </div>

                                                                <div class="col-md-5" data-toggle="tooltip" title="Click icon beside to compute feet and inches to meter!">
                                                                <div class="form-line {!! $personal_information->height ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control height number" value="{!! $personal_information->height !!}" name="height" required aria-required="true" maxlength="3">
                                                                    <label class="form-label" >Height (m) </label>
                                                                </div>
                                                                 <label id="height-error" class="error" for="height"></label>
                                                                </div>
                                                                
                                                                  <div class="col-md-1" data-toggle="tooltip" title="Click here to compute!">
                                                                    <div>
                                                                        <a class="feet-to-meter-calculator" data-toggle="modal" data-target="#calculate-height" >
                                                                           <div class="demo-google-material-icon"> <i class="material-icons kboard-icon-open">keyboard</i></div>
                                                                        </a>
                                                                    </div>
                                                                  </div>
                                                              
                                                              </div>  

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->blood_type ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control" name="blood_type" value="{!! $personal_information->blood_type !!}" maxlength="3" required aria-required="true">
                                                                    <label class="form-label" >Blood Type </label>
                                                                </div>
                                                                <label id="blood_type-error" class="error" for="blood_type"></label>
                                                              </div>
                                                            </div>  

                                                            <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->gsis_id_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control number" value="{!! $personal_information->gsis_id_number !!}" name="gsis_id_number" required aria-required="true">
                                                                    <label class="form-label" >GSIS ID NO. </label>
                                                                </div>
                                                                <label id="gsis_id_number-error" class="error" for="gsis_id_number"></label>
                                                              </div>
                                                          
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->pagibig_id_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" value="{!! $personal_information->pagibig_id_number !!}" class="form-control  number" name="pagibig_id_number" required aria-required="true">
                                                                    <label class="form-label" >PAG-IBIG ID NO. </label>
                                                                </div>
                                                                <label id="pagibig_id_number-error" class="error" for="pagibig_id_number"></label>
                                                              </div>
                                                            </div>  
                                                         
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->philhealth_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control number" value="{!! $personal_information->philhealth_number !!}" name="philhealth_number" required aria-required="true">
                                                                    <label class="form-label" > PHILHEALTH NO. </label>
                                                                </div>
                                                                <label id="philhealth_number-error" class="error" for="philhealth_number"></label>
                                                              </div>
                                                            
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->sss_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control number" value="{!! $personal_information->sss_number !!}" name="sss_number" required aria-required="true">
                                                                    <label class="form-label" > SSS NO. </label>
                                                                </div>
                                                                <label id="sss_number-error" class="error" for="sss_number"></label>
                                                              </div>
                                                            </div>  
                                                                                                                          
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->tin_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control number" value="{!! $personal_information->tin_number !!}" name="tin_number" required aria-required="true">
                                                                    <label class="form-label" > TIN NO. </label>
                                                                </div>
                                                                <label id="tin_number-error" class="error" for="tin_number"></label>
                                                              </div>
                                                        
                                                                <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->agency_employee_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->agency_employee_number  !!}" name="agency_employee_number" required aria-required="true">
                                                                    <label class="form-label" > AGENCY EMPLOYEE NO. </label>
                                                                </div>
                                                                <label id="agency_employee_number-error" class="error" for="agency_employee_number"></label>
                                                              </div>
                                                            </div>  

                                                            <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line">
                                                                    <select class="form-control show-tick" name="citizenship">
                                                                        <option {!! !$personal_information->citizenship  ? 'selected' : '' !!}  disabled>Select Citizenship</option>
                                                                        <option value="1" {!! $personal_information->citizenship == '1'  ? 'selected' : '' !!}>Filipino</option>
                                                                        <option value="2" {!! $personal_information->citizenship == '2'  ? 'selected' : '' !!}>Dual Citizen/By Birth</option>
                                                                        <option value="3" {!! $personal_information->citizenship == '3'  ? 'selected' : '' !!}>Dual Citizen/By Naturalization</option>
                                                                    </select>
                                                                </div>
                                                                <label id="citizenship-error" class="error" for="civil_status"></label>
                                                              </div>
                                                         
                                                                <div class="col-md-6">
                                                                <div class="form-line  ">
                                                                     <select class="form-control show-tick" name="country">
                                                                        <option {!! !$personal_information->country  ? 'selected' : '' !!}  disabled>Select Country</option>
                                                                        @foreach($countries as $key => $row)
                                                                        <option value="{!! $key !!}" {!! strtolower($personal_information->country) == strtolower($key ) ? 'selected' : '' !!}>{!! $row !!}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <label id="country-error" class="error" for="country"></label>
                                                              </div>
                                                            </div> 

                                                            <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                            
                                                            <h5>RESIDENTIAL ADDRESS</h5>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->r_address_house_block_lot_number ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" value="{!! $personal_information->r_address_house_block_lot_number !!}" class="form-control all-caps" name="r_address_house_block_lot_number"  aria-required="true">
                                                                            <label class="form-label" >House/Block/Lot No.</label>
                                                                        </div>
                                                                          <label id="r_address_house_block_lot_number-error" class="error" for="r_address_house_block_lot_number"></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->r_address_street ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->r_address_street !!}" name="r_address_street"  aria-required="true">
                                                                            <label class="form-label" >Street</label>
                                                                        </div>
                                                                         <label id="r_address_street-error" class="error" for="r_address_street"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->r_address_subdivision_village ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->r_address_subdivision_village !!}"  name="r_address_subdivision_village"  aria-required="true">
                                                                            <label class="form-label" >Subdivision/Village</label>
                                                                        </div>
                                                                          <label id="r_address_subdivision_village-error" class="error" for="r_address_subdivision_village"></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->r_address_barangay ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="r_address_barangay" value="{!! $personal_information->r_address_barangay !!}"  aria-required="true">
                                                                            <label class="form-label"  >Barangay</label>
                                                                        </div>
                                                                         <label id="r_address_barangay-error" class="error" for="r_address_barangay"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->r_address_city_municipality ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->r_address_city_municipality !!}" name="r_address_city_municipality"  aria-required="true">
                                                                            <label class="form-label" >City/Municipality</label>
                                                                        </div>
                                                                          <label id="r_address_city_municipality-error" class="error" for="r_address_city_municipality"></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->r_address_province ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->r_address_province !!}" name="r_address_province"  aria-required="true">
                                                                            <label class="form-label" >Province</label>
                                                                        </div>
                                                                         <label id="r_address_province-error" class="error" for="r_address_province"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  
                                                                        <div class="form-group">
                                                                            <div class="form-line {!! $personal_information->r_address_zipcode ? 'add-focused' : '' !!}">
                                                                                <input type="text" maxlength="255" value="{!! $personal_information->r_address_zipcode !!}" class="form-control number" name="r_address_zipcode"  aria-required="true">
                                                                                <label class="form-label" >ZIP Code</label>
                                                                            </div>
                                                                              <label id="r_address_zipcode-error" class="error" for="r_address_zipcode"></label>
                                                                        </div>
                                                                </div>
                                                            </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="duplicate_address" value="1" id="copy_to_permanent_address" class="filled-in" {!! $personal_information->duplicate_address ? 'checked' : '' !!}>
                                                                        <label for="copy_to_permanent_address">Copy to Permanent Address</label>                                 
                                                                    </div>
                                                                </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                            <h5>PERMANENT ADDRESS</h5>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_house_block_lot_number ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" value="{!! $personal_information->p_address_house_block_lot_number !!}" class="form-control all-caps" name="p_address_house_block_lot_number"  aria-required="true">
                                                                            <label class="form-label" >House/Block/Lot No.</label>
                                                                        </div>
                                                                          <label id="p_address_house_block_lot_number-error" class="error" for="p_address_house_block_lot_number"></label>
                                                                      </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_street ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" value="{!! $personal_information->p_address_street !!}" class="form-control all-caps" name="p_address_street"  aria-required="true">
                                                                            <label class="form-label" >Street</label>
                                                                        </div>
                                                                         <label id="p_address_street-error" class="error" for="p_address_street"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_subdivision_village ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" value="{!! $personal_information->p_address_subdivision_village !!}" class="form-control all-caps" name="p_address_subdivision_village"  aria-required="true">
                                                                            <label class="form-label" >Subdivision/Village</label>
                                                                        </div>
                                                                          <label id="p_address_subdivision_village-error" class="error" for="p_address_subdivision_village"></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_barangay ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->p_address_barangay !!}" name="p_address_barangay"  aria-required="true">
                                                                            <label class="form-label" >Barangay</label>
                                                                        </div>
                                                                         <label id="p_address_barangay-error" class="error" for="{!! $personal_information->p_address_barangay !!}"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_city_municipality ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="p_address_city_municipality" value="{!! $personal_information->p_address_city_municipality !!}"  aria-required="true">
                                                                            <label class="form-label" >City/Municipality</label>
                                                                        </div>
                                                                          <label id="p_address_city_municipality-error" class="error" for="p_address_city_municipality"></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_province ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="p_address_province" value="{!! $personal_information->p_address_province !!}" aria-required="true">
                                                                            <label class="form-label" >Province</label>
                                                                        </div>
                                                                         <label id="p_address_province-error" class="error" for="p_address_province"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                             <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form-line {!! $personal_information->p_address_zipcode ? 'add-focused' : '' !!}">
                                                                            <input type="text" maxlength="255" class="form-control number" name="p_address_zipcode"  value="{!! $personal_information->p_address_zipcode  !!}" aria-required="true">
                                                                            <label class="form-label" >ZIP Code</label>
                                                                        </div>
                                                                          <label id="p_address_zipcode-error" class="error" for="p_address_zipcode "></label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                   
                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->telephone_number ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control phone_with_ddd" value="{!! $personal_information->telephone_number !!}" name="telephone_number" required aria-required="true">
                                                                    <label class="form-label" >Telephone No.</label> 
                                                                </div>
                                                                <label id="telephone_number-error" class="error" for="telephone_number"></label>
                                                              </div>
                                                           
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->telephone_number ? 'add-focused' : '' !!}" >
                                                                    <input type="text" maxlength="255" class="form-control  mobile_number number" name="mobile_number" value="{!! $personal_information->mobile_number!!}" required aria-required="true">
                                                                    <label class="form-label" >Mobile No.</label> 
                                                                </div>
                                                                <label id="mobile_number-error" class="error" for="mobile_number"></label>
                                                              </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->email_address ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control" value="{!! $personal_information->email_address !!}" name="email_address" required aria-required="true">
                                                                    <label class="form-label" >Email Address (if any)</label> 
                                                                </div>
                                                                <label id="email_address-error" class="error" for="email_address"></label>
                                                              </div>
                                                            </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                          
                                                        <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                        </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                
                                <h2><small>FAMILY BACKGROUND</small></h2>
                                <section>
                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2>FAMILY BACKGROUND</h2>
                                                    <ul class="header-dropdown m-r--5">
                                                        <li class="dropdown">
                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                        
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="body">
                                                    <form method="POST" id="family_background" novalidate="novalidate" action="{!! url('personal-data-sheet/store-family-background') !!}">
                                                    
                                                        {!! csrf_field() !!}
                                                        <input name="uid" type="hidden" value="{!! $uid !!}">

                                                            <h5>SPOUSE</h5>
                                                           
                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_surname ? 'add-focused' : '' !!}">
                                                                        <input type="text"  maxlength="255" class="form-control all-caps" name="spouse_surname" value="{!! $family_background->spouse_surname !!}">
                                                                        <label class="form-label" >Surname</label> 
                                                                    </div>
                                                                    <label id="spouse_surname-error" class="error" for="spouse_surname"></label>
                                                                  </div>
                                                                </div>
                                                                
                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_first_name ? 'add-focused' : '' !!}">
                                                                        <input type="text"  maxlength="255" class="form-control all-caps" name="spouse_first_name" value="{!! $family_background->spouse_first_name !!}"  style="margin-top: -15px;">
                                                                        <label class="form-label" >First Name</label> 
                                                                    </div>
                                                                    <label id="spouse_first_name-error" class="error" for="spouse_first_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_middle_name ? 'add-focused' : '' !!}">
                                                                        <input type="text"  maxlength="255" class="form-control all-caps" name="spouse_middle_name" value="{!! $family_background->spouse_middle_name !!}">
                                                                        <label class="form-label" >Middle Name</label> 
                                                                    </div>
                                                                    <label id="spouse_middle_name-error" class="error" for="spouse_middle_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line">
                                                                        <select class="form-control show-tick" name="spouse_name_extension">
                                                                            <option {!! !$family_background->spouse_name_extension ? 'selected' : '' !!} disabled>Name Extension (JR./SR.)</option>
                                                                            <<option value="N/A" {!! $personal_information->name_extension == 'N/A' ? 'selected' : '' !!} > Name Extension (N/A) </option>
                                                                            <option value="JR." {!! $family_background->spouse_name_extension == 'JR.' ? 'selected' : '' !!} >JR.</option>
                                                                            <option value="SR." {!! $family_background->spouse_name_extension == 'SR.' ? 'selected' : '' !!} >SR.</option>
                                                                        </select>
                                                                    </div>
                                                                    <label id="spouse_name_extension-error" class="error" for="spouse_name_extension"></label>
                                                                  </div>
                                                                </div> 

                                                                <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_occupation ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="spouse_occupation" value="{!! $family_background->spouse_occupation !!}">
                                                                        <label class="form-label">Occupation</label> 
                                                                    </div>
                                                                    <label id="spouse_occupation-error" class="error" for="spouse_occupation"></label>
                                                                  </div>
                               
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_employer_business_name ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="spouse_employer_business_name" value="{!! $family_background->spouse_employer_business_name !!}">
                                                                        <label class="form-label">Employer/Business Name</label> 
                                                                    </div>
                                                                    <label id="spouse_employer_business_name-error" class="error" for="spouse_employer_business_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_business_address ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="spouse_business_address" value="{!! $family_background->spouse_business_address !!}">
                                                                        <label class="form-label">Business Address</label> 
                                                                    </div>
                                                                    <label id="spouse_business_address-error" class="error" for="spouse_business_address"></label>
                                                                 </div> 
                                                                </div>
      
                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->spouse_telephone_number ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control phone_with_ddd" name="spouse_telephone_number" value="{!! $family_background->spouse_telephone_number !!}">
                                                                        <label class="form-label" >Telephone No.</label> 
                                                                    </div>
                                                                    <label id="spouse_telephone_number-error" class="error" for="spouse_telephone_number"></label>
                                                                   </div>     
                                                                  </div>

                                                                <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                                <h5>FATHER</h5>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->fathers_surname ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="fathers_surname" value="{!! $family_background->fathers_surname !!}">
                                                                        <label class="form-label" >Surname</label> 
                                                                    </div>
                                                                    <label id="fathers_surname-error" class="error" for="fathers_surname"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->fathers_first_name ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="fathers_first_name" value="{!! $family_background->fathers_first_name !!}" style="margin-top: -15px;">
                                                                        <label class="form-label" >First Name</label> 
                                                                    </div>
                                                                    <label id="fathers_first_name-error" class="error" for="fathers_first_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->fathers_middle_name ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="fathers_middle_name" value="{!! $family_background->fathers_middle_name !!}">
                                                                        <label class="form-label" >Middle Name</label> 
                                                                    </div>
                                                                    <label id="fathers_middle_name-error" class="error" for="fathers_middle_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line">
                                                                        
                                                                          <select class="form-control show-tick" name="fathers_name_extension">
                                                                            <option {!! !$family_background->fathers_name_extension ? 'selected' : '' !!} disabled>Name Extension (JR./SR.)</option>
                                                                            <option value="N/A" {!! $personal_information->name_extension == 'N/A' ? 'selected' : '' !!} > Name Extension (N/A) </option>
                                                                            <option value="JR." {!! $family_background->fathers_name_extension == 'JR.' ? 'selected' : '' !!} >JR.</option>
                                                                            <option value="SR." {!! $family_background->fathers_name_extension == 'SR.' ? 'selected' : '' !!} >SR.</option>
                                                                        </select>
                                                                    </div>
                                                                    <label id="fathers_name_extension-error" class="error" for="fathers_name_extension"></label>
                                                                  </div>
                                                                </div> 

                                                                <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                                <h5>MOTHER</h5>
                                                            
                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->mothers_maiden_name ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="mothers_maiden_name" value="{!! $family_background->mothers_maiden_name !!}">
                                                                        <label class="form-label" >Maiden Name</label> 
                                                                    </div>
                                                                    <label id="mothers_maiden_name-error" class="error" for="mothers_maiden_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->mothers_surname ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="mothers_surname" value="{!! $family_background->mothers_surname !!}" style="margin-top: -15px;">
                                                                        <label class="form-label" >Surname</label> 
                                                                    </div>
                                                                    <label id="mothers_surname-error" class="error" for="mothers_surname"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->mothers_first_name ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="mothers_first_name" value="{!! $family_background->mothers_first_name !!}">
                                                                        <label class="form-label" >First Name</label> 
                                                                    </div>
                                                                    <label id="mothers_first_name-error" class="error" for="mothers_first_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group form-float">
                                                                  <div class="col-md-6">
                                                                    <div class="form-line {!! $family_background->mothers_middle_name ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="mothers_middle_name" value="{!! $family_background->mothers_middle_name !!}">
                                                                        <label class="form-label" >Middle Name</label> 
                                                                    </div>
                                                                    <label id="mothers_middle_name-error" class="error" for="mothers_middle_name"></label>
                                                                  </div>
                                                                </div>

                                                                <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                                <h5>CHILDREN</h5>

                                                                <div class="clone-container">
                                                                <?php $cnt = count($childrens)-1; ?>
                                                                @for($count=0; $count <= $cnt; $count++) 

                                                                    <div class="clone">

                                                                        <div class="form-group form-float">
                                                                          <div class="col-md-5">
                                                                            <div class="form-line {!! $childrens[$count]->fullname ? 'add-focused' : '' !!}">
                                                                                <input type="text" maxlength="255" class="form-control all-caps" name="fullname[]" value="{!! $childrens[$count]->fullname !!}">
                                                                                <label class="form-label" >Name of Child</label> 
                                                                            </div>
                                                                            <label id="fullname{!! $count !!}-error" class="error" for="fullname{!! $count !!}"></label>
                                                                          </div>
                                                                        </div>

                                                                        <div class="form-group form-float">
                                                                                <div class="col-md-5">
                                                                                <div class="form-line {!! $childrens[$count]->date_of_birth ? 'add-focused' : '' !!}">
                                                                                    <input type="text" class="form-control date" name="date_of_birth[]" value="{!! $childrens[$count]->date_of_birth ? date('m/d/Y', strtotime($childrens[$count]->date_of_birth))  : '' !!}" required aria-required="true" maxlength="10">
                                                                                    <label class="form-label" >Date of Birth (mm/dd/yyyy)</label>
                                                                                </div>
                                                                                <label id="date_of_birth.{!! $count !!}-error" class="error auto-arrange" for="date_of_birth{!! $count !!}"></label>
                                                                              </div>
                                                                        </div>  

                                                                        <div class="form-group form-float">
                                                                                <div class="col-md-2 action-button">
                                                                                    @if($cnt == $count)
                                                                                        @if($cnt == 0)
                                                                                         <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                                         <a style="cursor:pointer;display:none;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                                        @else
                                                                                         <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                                         <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                                        @endif
                                                                                    @else

                                                                                     <a style="cursor:pointer;display:none;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                                     <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 

                                                                                    @endif
                                                                                </div>
                                                                        </div> 

                                                                     </div>
                                                                
                                                                @endfor
                                                                </div>
                
                                                                <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                              
                                                                <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                                </div>
                                               
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </section>

                                <h2><small>EDUCATIONAL BACKGROUND</small></h2>
                                <section>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="card">
                                          <div class="header">
                                              <h2>EDUCATIONAL BACKGROUND</h2>
                                              <ul class="header-dropdown m-r--5">
                                                  <li class="dropdown">
                                                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                          <i class="material-icons">more_vert</i>
                                                      </a>
                                                  
                                                  </li>
                                              </ul>
                                          </div>
                                          <div class="body">
                                              <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-educational-background') !!}">
                                              
                                                  {!! csrf_field() !!}
                                                  <input name="uid" type="hidden" value="{!! $uid !!}">

                                                        <h5>ELEMENTARY</h5>

                                                     
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_name_of_school ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255" class="form-control all-caps" name="elem_name_of_school" value="{!! $educational_background->elem_name_of_school !!}">
                                                                      <label class="form-label" ><small>Name of School (Write in full)</small></label> 
                                                                  </div>
                                                                  <label id="elem_name_of_school-error" class="error" for="elem_name_of_school"></label>
                                                                 </div>
                                                        
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_basic_ed_degree_course ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255" class="form-control all-caps" name="elem_basic_ed_degree_course" value="{!! $educational_background->elem_basic_ed_degree_course !!}">
                                                                      <label class="form-label" ><small>Basic Education (Write in full)</small></label> 
                                                                  </div>
                                                                  <label id="elem_basic_ed_degree_course-error" class="error" for="elem_basic_ed_degree_course"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_period_from ? 'add-focused' : '' !!}">
                                                                      <input type="text" class="form-control" name="elem_period_from" value="{!! $educational_background->elem_period_from !!}">
                                                                      <label class="form-label" ><small>Period of Attendance (From)</small></label> 
                                                                  </div>
                                                                  <label id="elem_period_from-error" class="error" for="elem_period_from"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_period_to ? 'add-focused' : '' !!}">
                                                                      <input type="text" class="form-control" name="elem_period_to" value="{!! $educational_background->elem_period_to !!}">
                                                                      <label class="form-label" ><small>Period of Attendance (To)</small></label> 
                                                                  </div>
                                                                  <label id="elem_period_to-error" class="error" for="elem_period_to"></label>
                                                                </div>
                                                            </div>
         
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_highest_lvl_units_earned ? 'add-focused' : '' !!}">
                                                                      <input type="text"  maxlength="255" class="form-control all-caps" name="elem_highest_lvl_units_earned" value="{!! $educational_background->elem_highest_lvl_units_earned !!}">
                                                                      <label class="form-label" ><small>Highest Level (if not graduated)</small></label> 
                                                                  </div>
                                                                  <label id="elem_highest_lvl_units_earned-error" class="error" for="elem_highest_lvl_units_earned"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_year_graduated ? 'add-focused' : '' !!}">
                                                                      <input type="text" class="form-control number" name="elem_year_graduated" value="{!! $educational_background->elem_year_graduated !!}" maxlength="4">
                                                                      <label class="form-label" ><small>Year Graduated</small></label> 
                                                                  </div>
                                                                  <label id="elem_year_graduated-error" class="error" for="elem_year_graduated"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $educational_background->elem_scholarship_academic_honors ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255" class="form-control all-caps" name="elem_scholarship_academic_honors" value="{!! $educational_background->elem_scholarship_academic_honors !!}">
                                                                      <label class="form-label" ><small>Scholarship/Academic Honors Received</small></label> 
                                                                  </div>
                                                                  <label id="elem_scholarship_academic_honors-error" class="error" for="elem_scholarship_academic_honors"></label>
                                                                </div>
                                                            </div>


                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                      
                                                        <h5>SECONDARY</h5>
                                                     
                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->second_name_of_school ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="second_name_of_school" value="{!! $educational_background->second_name_of_school !!}">
                                                                  <label class="form-label" ><small>Name of School (Write in full)</small></label> 
                                                              </div>
                                                              <label id="second_name_of_school-error" class="error" for="second_name_of_school"></label>
                                                            </div>
                                                           
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->second_basic_ed_degree_course ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="second_basic_ed_degree_course" value="{!! $educational_background->second_basic_ed_degree_course !!}">
                                                                  <label class="form-label" ><small>Basic Education (Write in full)</small></label> 
                                                              </div>
                                                              <label id="second_basic_ed_degree_course-error" class="error" for="second_basic_ed_degree_course"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->second_period_from ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="second_period_from" value="{!! $educational_background->second_period_from !!}">
                                                                  <label class="form-label" ><small>Period of Attendance (From)</small></label> 
                                                              </div>
                                                              <label id="second_period_from-error" class="error" for="second_period_from"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->second_period_to ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="second_period_to" value="{!! $educational_background->second_period_to !!}">
                                                                  <label class="form-label" ><small>Period of Attendance (To)</small></label> 
                                                              </div>
                                                              <label id="second_period_to-error" class="error" for="second_period_to"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->elem_highest_lvl_units_earned ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="elem_highest_lvl_units_earned" value="{!! $educational_background->elem_highest_lvl_units_earned !!}">
                                                                  <label class="form-label" ><small>Highest Level (if not graduated)</small></label> 
                                                              </div>
                                                              <label id="elem_highest_lvl_units_earned-error" class="error" for="elem_highest_lvl_units_earned"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->second_year_graduated ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control number" name="second_year_graduated" value="{!! $educational_background->second_year_graduated !!}" maxlength="4">
                                                                  <label class="form-label" ><small>Year Graduated</small></label> 
                                                              </div>
                                                              <label id="second_year_graduated-error" class="error" for="second_year_graduated"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->second_scholarship_academic_honors ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="second_scholarship_academic_honors" value="{!! $educational_background->second_scholarship_academic_honors !!}">
                                                                  <label class="form-label" ><small>Scholarship/Academic Honors Received</small></label> 
                                                              </div>
                                                              <label id="second_scholarship_academic_honors-error" class="error" for="second_scholarship_academic_honors"></label>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                        <h5>VOCATIONAL / TRADE COURSE</h5>
                                                     
                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_name_of_school ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="vocational_name_of_school" value="{!! $educational_background->vocational_name_of_school !!}">
                                                                  <label class="form-label" ><small>Name of School (Write in full)</small></label> 
                                                              </div>
                                                              <label id="vocational_name_of_school-error" class="error" for="vocational_name_of_school"></label>
                                                            </div>
                                                           
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_basic_ed_degree_course ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="vocational_basic_ed_degree_course" value="{!! $educational_background->vocational_basic_ed_degree_course !!}">
                                                                  <label class="form-label" ><small>Course (Write in full)</small></label> 
                                                              </div>
                                                              <label id="vocational_basic_ed_degree_course-error" class="error" for="vocational_basic_ed_degree_course"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_period_from ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="vocational_period_from" value="{!! $educational_background->vocational_period_from !!}" >
                                                                  <label class="form-label" ><small>Period of Attendance (From)</small></label> 
                                                              </div>
                                                              <label id="vocational_period_from-error" class="error" for="vocational_period_from"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_period_to ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="vocational_period_to" value="{!! $educational_background->vocational_period_to !!}" >
                                                                  <label class="form-label" ><small>Period of Attendance (To)</small></label> 
                                                              </div>
                                                              <label id="vocational_period_to-error" class="error" for="vocational_period_to"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_highest_lvl_units_earned ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="vocational_highest_lvl_units_earned" value="{!! $educational_background->vocational_highest_lvl_units_earned !!}">
                                                                  <label class="form-label" ><small>Units Earned (if not graduated)</small></label> 
                                                              </div>
                                                              <label id="vocational_highest_lvl_units_earned-error" class="error" for="vocational_highest_lvl_units_earned"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_year_graduated ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="vocational_year_graduated" value="{!! $educational_background->vocational_year_graduated !!}" >
                                                                  <label class="form-label" ><small>Year Graduated</small></label> 
                                                              </div>
                                                              <label id="vocational_year_graduated-error" class="error" for="vocational_year_graduated"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->vocational_scholarship_academic_honors ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="vocational_scholarship_academic_honors" value="{!! $educational_background->vocational_scholarship_academic_honors !!}">
                                                                  <label class="form-label" ><small>Scholarship/Academic Honors Received</small></label> 
                                                              </div>
                                                              <label id="vocational_scholarship_academic_honors-error" class="error" for="vocational_scholarship_academic_honors"></label>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                      
                                                        <h5>COLLEGE</h5>
                                                     
                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_name_of_school ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps"  name="college_name_of_school" value="{!! $educational_background->college_name_of_school !!}">
                                                                  <label class="form-label" ><small>Name of School (Write in full)</small></label> 
                                                              </div>
                                                              <label id="college_name_of_school-error" class="error" for="college_name_of_school"></label>
                                                            </div>
                                                          
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_basic_ed_degree_course ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="college_basic_ed_degree_course" value="{!! $educational_background->college_basic_ed_degree_course !!}">
                                                                  <label class="form-label" ><small>Degree (Write in full)</small></label> 
                                                              </div>
                                                              <label id="college_basic_ed_degree_course-error" class="error" for="college_basic_ed_degree_course"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_period_from ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="college_period_from" value="{!! $educational_background->college_period_from !!}" >
                                                                  <label class="form-label" ><small>Period of Attendance (From)</small></label> 
                                                              </div>
                                                              <label id="college_period_from-error" class="error" for="college_period_from"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_period_to ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="college_period_to" value="{!! $educational_background->college_period_to !!}" >
                                                                  <label class="form-label" ><small>Period of Attendance (To)</small></label> 
                                                              </div>
                                                              <label id="college_period_to-error" class="error" for="college_period_to"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_highest_lvl_units_earned ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="college_highest_lvl_units_earned" value="{!! $educational_background->college_highest_lvl_units_earned !!}">
                                                                  <label class="form-label" ><small>Units Earned (if not graduated)</small></label> 
                                                              </div>
                                                              <label id="college_highest_lvl_units_earned-error" class="error" for="college_highest_lvl_units_earned"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_year_graduated ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="college_year_graduated" value="{!! $educational_background->college_year_graduated !!}">
                                                                  <label class="form-label" ><small>Year Graduated</small></label> 
                                                              </div>
                                                              <label id="college_year_graduated-error" class="error" for="college_year_graduated"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->college_scholarship_academic_honors ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="college_scholarship_academic_honors" value="{!! $educational_background->college_scholarship_academic_honors !!}">
                                                                  <label class="form-label" ><small>Scholarship/Academic Honors Received</small></label> 
                                                              </div>
                                                              <label id="college_scholarship_academic_honors-error" class="error" for="college_scholarship_academic_honors"></label>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->                                              
                                                  
                                                        <h5>GRADUATE STUDIES</h5>
                                                     
                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_name_of_school ? 'add-focused' : '' !!}">
                                                                  <input type="text"  maxlength="255" class="form-control all-caps" name="graduate_name_of_school" value="{!! $educational_background->graduate_name_of_school !!}">
                                                                  <label class="form-label" ><small>Name of School (Write in full)</small></label> 
                                                              </div>
                                                              <label id="graduate_name_of_school-error" class="error" for="graduate_name_of_school"></label>
                                                            </div>
                                                         
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_basic_ed_degree_course ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control all-caps" name="graduate_basic_ed_degree_course" value="{!! $educational_background->graduate_basic_ed_degree_course !!}">
                                                                  <label class="form-label" ><small>Degree (Write in full)</small></label> 
                                                              </div>
                                                              <label id="graduate_basic_ed_degree_course-error" class="error" for="graduate_basic_ed_degree_course"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_period_from ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255" class="form-control" name="graduate_period_from" value="{!! $educational_background->graduate_period_from !!}">
                                                                  <label class="form-label" ><small>Period of Attendance (From)</small></label> 
                                                              </div>
                                                              <label id="graduate_period_from-error" class="error" for="graduate_period_from"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_period_to ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control" name="graduate_period_to" value="{!! $educational_background->graduate_period_to !!}">
                                                                  <label class="form-label" ><small>Period of Attendance (To)</small></label> 
                                                              </div>
                                                              <label id="graduate_period_to-error" class="error" for="graduate_period_to"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_highest_lvl_units_earned ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255"  class="form-control all-caps" name="graduate_highest_lvl_units_earned" value="{!! $educational_background->graduate_highest_lvl_units_earned !!}">
                                                                  <label class="form-label" ><small>Units Earned (if not graduated)</small></label> 
                                                              </div>
                                                              <label id="graduate_highest_lvl_units_earned-error" class="error" for="graduate_highest_lvl_units_earned"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_year_graduated ? 'add-focused' : '' !!}">
                                                                  <input type="text" class="form-control number" name="graduate_year_graduated" value="{!! $educational_background->graduate_year_graduated !!}" maxlength="4">
                                                                  <label class="form-label" ><small>Year Graduated</small></label> 
                                                              </div>
                                                              <label id="graduate_year_graduated-error" class="error" for="graduate_year_graduated"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                              <div class="form-line {!! $educational_background->graduate_scholarship_academic_honors ? 'add-focused' : '' !!}">
                                                                  <input type="text" maxlength="255"  class="form-control all-caps" name="graduate_scholarship_academic_honors" value="{!! $educational_background->graduate_scholarship_academic_honors !!}">
                                                                  <label class="form-label" ><small>Scholarship/Academic Honors Received</small></label> 
                                                              </div>
                                                              <label id="graduate_scholarship_academic_honors-error" class="error" for="graduate_scholarship_academic_honors"></label>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                        
                                                        <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                        </div>
                                                     
                                              </form>
                                          </div>
                                      </div>
                                    </div>
                                </section>
                                 
                                <h2><small>CIVIL SERVICE ELIGIBILITY</small></h2>
                                <section>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                              <div class="header">
                                                  <h2>CIVIL SERVICE ELIGIBITY</h2>
                                                  <small>Career Service/RA 1080 (Board/Bar) Under Special Laws/ CES/ CSEE Barangay Eligibility/ Driver's License </small>
                                                  <ul class="header-dropdown m-r--5">
                                                      <li class="dropdown">
                                                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                              <i class="material-icons">more_vert</i>
                                                          </a>
                                                      
                                                      </li>
                                                  </ul>
                                              </div>
                                              <div class="body">
                                                  <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-civil-service-eligibility') !!}">
                                                  

                                                   <div class="clone-container">


                                                      {!! csrf_field() !!}
                                                      <input name="uid" type="hidden" value="{!! $uid !!}">

                                                        <?php $cnt = count($civil_service_eligibility)-1; ?>
                                                        @for($count=0; $count <= $cnt; $count++) 

                                                        <div class="clone" style="margin-bottom: -40px;">
                                                             
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $civil_service_eligibility[$count]->cs_board_bar_ces_csee_barangay_drivers ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255"  class="form-control cs_board_bar_ces_csee_barangay_drivers all-caps"  name="cs_board_bar_ces_csee_barangay_drivers all-caps" value="{!! $civil_service_eligibility[$count]->cs_board_bar_ces_csee_barangay_drivers !!}">
                                                                      <label class="form-label" ><small>Name of Eligibility</small></label> 
                                                                  </div>
                                                                  <label id="cs_board_bar_ces_csee_barangay_drivers.{!! $count !!}-error" class="error auto-arrange" for="cs_board_bar_ces_csee_barangay_drivers{!! $count !!}"></label>
                                                                </div>
                                                           
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $civil_service_eligibility[$count]->rating ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255"  class="form-control rating all-caps"  name="rating" value="{!! $civil_service_eligibility[$count]->rating !!}">
                                                                      <label class="form-label" ><small>Rating (If Applicable)</small></label> 
                                                                  </div>
                                                                  <label id="rating.{!! $count !!}-error" class="error auto-arrange" for="rating{!! $count !!}"></label>
                                                                </div>
                                                            </div>
                                                   
                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $civil_service_eligibility[$count]->date_of_exam_conferment ? 'add-focused' : '' !!}">
                                                                      <input type="text" class="form-control date date_of_exam_conferment"  name="date_of_exam_conferment" value="{!! $civil_service_eligibility[$count]->date_of_exam_conferment ? date('m/d/Y', strtotime($civil_service_eligibility[$count]->date_of_exam_conferment))  : '' !!}">
                                                                      <label class="form-label" ><small>Date of Examination/Conferment (mm/dd/yyyy)</small></label> 
                                                                  </div>
                                                                  <label id="date_of_exam_conferment.{!! $count !!}-error" class="error auto-arrange" for="date_of_exam_conferment{!! $count !!}"></label>
                                                                </div>
                                                           
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $civil_service_eligibility[$count]->place_of_exam_conferment ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255"  class="form-control place_of_exam_conferment all-caps"  name="place_of_exam_conferment" value="{!! $civil_service_eligibility[$count]->place_of_exam_conferment !!}">
                                                                      <label class="form-label" ><small>Place of Examination/Conferment</small></label> 
                                                                  </div>
                                                                  <label id="place_of_exam_conferment.{!! $count !!}-error" class="error auto-arrange" for="place_of_exam_conferment{!! $count !!}"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $civil_service_eligibility[$count]->license_number ? 'add-focused' : '' !!}">
                                                                      <input type="text" maxlength="255"  class="form-control  license_number"  name="license_number" value="{!! $civil_service_eligibility[$count]->license_number !!}">
                                                                      <label class="form-label" ><small>License Number (if applicable)</small></label> 
                                                                  </div>
                                                                  <label id="license_number.{!! $count !!}-error" class="error auto-arrange" for="license_number{!! $count !!}"></label>
                                                                </div>
                                                              
                                                                <div class="col-md-6">
                                                                  <div class="form-line {!! $civil_service_eligibility[$count]->license_date_of_validity ? 'add-focused' : '' !!}">
                                                                      <input type="text" class="form-control date license_date_of_validity"  name="license_date_of_validity" value="{!! $civil_service_eligibility[$count]->license_date_of_validity ? date('m/d/Y', strtotime($civil_service_eligibility[$count]->license_date_of_validity))  : '' !!}">
                                                                      <label class="form-label" ><small>License Date of Validity  (if applicable)</small></label> 
                                                                  </div>
                                                                  <label id="license_date_of_validity.{!! $count !!}-error" class="error auto-arrange" for="license_date_of_validity{!! $count !!}"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-12 action-button" style="margin-bottom: 0px;">
                                                                    @if($cnt == $count)
                                                                        @if($cnt == 0)
                                                                         <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                         <a style="cursor:pointer;display:none;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                        @else
                                                                         <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                         <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                        @endif
                                                                    @else

                                                                     <a style="cursor:pointer;display:none;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                     <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 

                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div><br> <!-- divider-separator -->

                                                        </div>

                                                        @endfor

                                                        </div>

                                                        <div style="width: 100%; text-align: right; margin-top: 15px;">
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                        </div>
                                             
                                                  </form>
                                              </div>
                                            </div>
                                        </div>
                                </section>

                                <h2><small>WORK EXPERIENCE / SERVICE RECORD</small></h2>
                                <section>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="card">
                                    <div class="header">
                                        <h2>WORK EXPERIENCE / SERVICE RECORD</h2>
                                        <b>Include private employment. Start from your recent work</b> <br><small>Description of duties should be indicated in the attached Work Experience form. </small>
                                        <br><small>(Write in full / Do not Abbreviate / Please fillup all data for Service Record Report)</small>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                            
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-work-experience') !!}">
                                        
                                        <div class="clone-container">

                                            {!! csrf_field() !!}
                                            <input name="uid" type="hidden" value="{!! $uid !!}">


                                                <!-- <h5>ELEMENTARY</h5> -->
                                                <?php $cnt = count($work_experience)-1; ?>
                                                @for($count=0; $count <= $cnt; $count++) 
                                              
                                                <div class="clone">


                                                  <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                    <div class="form-group form-float">
                                                        <div class="col-md-12">
                                                            <div class="form-line {!! $work_experience[$count]->tag_work == 'dohro2' ? 'add-focused' : '' !!}">
                                                               <input type="checkbox" checked value="dohro2" id="tag_work{!! $count !!}" class="tag_work" {!! $work_experience[$count]->tag_work == 'dohro2' ? 'checked' : '' !!}  name="tag_work{!! $count !!}" />
                                                               <label for="tag_work{!! $count !!}"><b><font color="red">Uncheck if you are not working under the <u> CAGAYAN VALLEY CENTER FOR HEALTH DEVELOPMENT</u></font></b></label>
                                                            </div>
                                                            <!-- <label id="tag_work{!! $count !!}-error" class="error" for="tag_work{!! $count !!}"></label> -->
                                                        </div>
                                                    </div>



                                                    <div class="form-group form-float">
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->inclusive_date_from ? 'add-focused' : '' !!}">
                                                            <input type="text" class="form-control date wp_inclusive_date_from" name="inclusive_date_from{!! $count !!}" value="{!! $work_experience[$count]->inclusive_date_from ? date('m/d/Y', strtotime($work_experience[$count]->inclusive_date_from))  : '' !!}">
                                                            <label class="form-label" >From: <small>INCLUSIVE DATES (mm/dd/yyyy) </small></label> 
                                                        </div>
                                                        <label id="inclusive_date_from{!! $count !!}-error" class="error" for="inclusive_date_from{!! $count !!}"></label>
                                                    </div>
                                                   
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->inclusive_date_to ? 'add-focused' : '' !!}">
                                                            <input type="text" class="form-control wp_inclusive_date_to all-caps" name="inclusive_date_to{!! $count !!}" value="{!! $work_experience[$count]->inclusive_date_to !!}">
                                                            <label class="form-label" >To: <small>INCLUSIVE DATES (mm/dd/yyyy) / present </small></label> 
                                                        </div>
                                                        <label id="inclusive_date_to{!! $count !!}-error" class="error" for="inclusive_date_to{!! $count !!}"></label>
                                                      </div>
                                                   </div>
                                                

                                                    <div class="form-group form-float">
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->position_title ? 'add-focused' : '' !!}">
                                                            <input type="text" maxlength="255"  class="form-control position_title all-caps" name="position_title{!! $count !!}" value="{!! $work_experience[$count]->position_title!!}">
                                                            <label class="form-label" ><small>POSITION TITLE </small></label> 
                                                        </div>
                                                        <label id="position_title{!! $count !!}-error" class="error" for="position_title{!! $count !!}"></label>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->dept_agency_office_company ? 'add-focused' : '' !!}">
                                                            <input type="text" maxlength="255"  class="ignore form-control dept_agency_office_company all-caps" name="dept_agency_office_company{!! $count !!}" value="{!! $work_experience[$count]->dept_agency_office_company !!}">
                                                            <label class="form-label" ><small>Department/Agency/Office/Company</small></label> 
                                                        </div>
                                                        <label id="dept_agency_office_company{!! $count !!}-error" class="error" for="dept_agency_office_company{!! $count !!}"></label>
                                                      </div>
                                                    </div>



                                                    <div class="form-group form-float">
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->name_of_office_unit ? 'add-focused' : '' !!}">
                                                            <input type="text" maxlength="255"  class="ignore form-control name_of_office_unit all-caps" name="name_of_office_unit{!! $count !!}" value="{!! $work_experience[$count]->name_of_office_unit!!}">
                                                            <label class="form-label" ><small>Name of Office/Unit</small></label> 
                                                        </div>
                                                        <label id="name_of_office_unit{!! $count !!}-error" class="error" for="name_of_office_unit{!! $count !!}"></label>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->immediate_supervisor ? 'add-focused' : '' !!}">
                                                            <input type="text" maxlength="255"  class="ignore form-control immediate_supervisor all-caps" name="immediate_supervisor{!! $count !!}" value="{!! $work_experience[$count]->immediate_supervisor !!}">
                                                            <label class="form-label" ><small>Immediate Supervisor</small></label> 
                                                        </div>
                                                        <label id="immediate_supervisor{!! $count !!}-error" class="error" for="immediate_supervisor{!! $count !!}"></label>
                                                      </div>
                                                    </div>



                                                    <div class="form-group form-float">
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->monthly_salary ? 'add-focused' : '' !!}">
                                                            <input type="text" maxlength="255"  class="form-control monthly_salary money" name="monthly_salary{!! $count !!}" value="{!! $work_experience[$count]->monthly_salary !!}">
                                                            <label class="form-label" ><small>Monthly Salary</small></label> 
                                                        </div>
                                                        <label id="monthly_salary-error{!! $count !!}" class="error" for="monthly_salary{!! $count !!}"></label>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                        <div class="form-line {!! $work_experience[$count]->paygrade ? 'add-focused' : '' !!}">
                                                            <input type="text" maxlength="255"  class="form-control paygrade all-caps" name="paygrade{!! $count !!}" value="{!! $work_experience[$count]->paygrade !!}">
                                                            <label class="form-label" ><small>Salary/Job/Pay/Grade (if applicable)</small></label> 
                                                        </div>
                                                        <label id="paygrade{!! $count !!}-error" class="error" for="paygrade{!! $count !!}"></label>
                                                      </div>
                                                    </div>




                                                     <div class="form-group form-float">
                                                          <div class="col-md-6">
                                                            <div class="form-line srs-focus {!! $work_experience[$count]->service_record_salary ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255"  class="form-control money service_record_salary all-caps" name="service_record_salary{!! $count !!}" value="{!! $work_experience[$count]->service_record_salary !!}">
                                                                <label class="form-label" ><small>Annual Income</small></label> 
                                                            </div>
                                                            <label id="service_record_salary{!! $count !!}-error" class="error" for="service_record_salary{!! $count !!}"></label>
                                                          </div>
                                    
                                                           <div class="col-md-6">
                                                                <div class="form-line {!! $work_experience[$count]->agency_type ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="ignore form-control agency_type all-caps" name="agency_type{!! $count !!}" value="{!! $work_experience[$count]->agency_type !!}">
                                                                    <label class="form-label" ><small>Type of Agency</small></label> 
                                                                </div>
                                                                <label id="agency_type{!! $count !!}-error" class="error" for="agency_type{!! $count !!}"></label>
                                                            </div>
                                                      </div>



                                                     <div class="form-group form-float">
                                                          <div class="col-md-6">
                                                            <div class="form-line {!! $work_experience[$count]->pay ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255"  class="form-control pay all-caps" name="pay{!! $count !!}" value="{!! $work_experience[$count]->pay !!}">
                                                                <label class="form-label" ><small>W/Out Pay</small></label> 
                                                            </div>
                                                            <label id="pay{!! $count !!}-error" class="error" for="pay{!! $count !!}"></label>
                                                          </div>
                                    
                                                           <div class="col-md-6">
                                                                <div class="form-line {!! $work_experience[$count]->cause ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control cause all-caps" name="cause{!! $count !!}" value="{!! $work_experience[$count]->cause !!}">
                                                                    <label class="form-label" ><small>Cause</small></label> 
                                                                </div>
                                                                <label id="cause{!! $count !!}-error" class="error" for="cause{!! $count !!}"></label>
                                                            </div>
                                                      </div>



                                                    <div class="form-group form-float">
                                                        <div class="col-md-6">
                                                            <div class="form-line {!! $work_experience[$count]->status_of_appointment ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255"  class="ignore form-control status_of_appointment all-caps" name="status_of_appointment{!! $count !!}" value="{!! $work_experience[$count]->status_of_appointment !!}">
                                                                <label class="form-label" ><small>Status of Appointment</small></label> 
                                                            </div>
                                                            <label id="status_of_appointment{!! $count !!}-error" class="error" for="status_of_appointment{!! $count !!}"></label>
                                                        </div>
                                    
                                                        <div class="col-md-6">
                                                            <div class="form-line {!! $work_experience[$count]->govt_service ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="1"  class="ignore form-control govt_service option_yn" name="govt_service{!! $count !!}" value="{!! $work_experience[$count]->govt_service !!}">
                                                                <label class="form-label" ><small>Goverment Service (Y/N)</small></label> 
                                                            </div>
                                                                <label id="govt_service{!! $count !!}-error" class="error" for="govt_service{!! $count !!}"></label>
                                                        </div>
                                                    </div>



                                                    <div class="form-group form-float">
                                                        <div class="col-md-12">
                                                            <div class="form-line {!! $work_experience[$count]->summary_of_duties ? 'add-focused' : '' !!}">
                                                                <label class="form-label" ><small>Summary of Actual Duties</small></label>
                                                                <br>
                                                                <textarea class="form-control summary_of_duties all-caps no-resize auto-growth" name="summary_of_duties{!! $count !!}">{!! $work_experience[$count]->summary_of_duties !!}</textarea>
                                                            </div>
                                                            <label id="summary_of_duties{!! $count !!}-error" class="error" for="summary_of_duties{!! $count !!}"></label>
                                                        </div>
                                                    </div>



                                                    <div class="form-group form-float">
                                                        <div class="col-md-12">
                                                            <div class="form-line {!! $work_experience[$count]->office_address ? 'add-focused' : '' !!}">
                                                                <label class="form-label" ><small>Office Address</small></label>
                                                                <br>
                                                                <textarea class="ignore form-control office_address all-caps no-resize auto-growth" name="office_address{!! $count !!}">{!! $work_experience[$count]->office_address !!}</textarea>
                                                            </div>
                                                            <label id="office_address{!! $count !!}-error" class="error" for="office_address{!! $count !!}"></label>
                                                        </div>
                                                    </div>




                                                     <div class="form-group form-float">
                                                            <div class="col-md-12 action-button">
                                                                @if($cnt == $count)
                                                                    @if($cnt == 0)
                                                                     <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                     <a style="cursor:pointer;display:none;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                    @else
                                                                     <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                     <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                    @endif
                                                                @else

                                                                 <a style="cursor:pointer;display:none;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                 <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 

                                                                @endif
                                                            </div>
                                                    </div> 



                                                </div>



                                                
                                                    @endfor

                                                </div>
                                              
                                                    <div class="clearfix"></div><div class="divider-separator"></div><br> <!-- divider-separator -->
                                                  
                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit"  style="float: right;top:-20px;">&nbsp; SAVE INFORMATION &nbsp;</button>
                                               
                                        </form>
                                    </div>
                                  </div>
                                  </div>
                                </section>

                                 <h2><small>VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</small></h2>
                                 <section>
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <div class="card">
                                            <div class="header">
                                                <b> VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</b>
                                                <br><small>(Write in full / Do not Abbreviate)</small>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-voluntary-work-involvement') !!}">
                                                
                                                <div class="clone-container">

                                                    {!! csrf_field() !!}
                                                    <input name="uid" type="hidden" value="{!! $uid !!}">


                                                        <!-- <h5>ELEMENTARY</h5> -->
                                                        <?php $cnt = count($voluntart_work_involvement)-1; ?>
                                                        @for($count=0; $count <= $cnt; $count++) 
                                                      
                                                        <div class="clone">

                                                          <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                            <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $voluntart_work_involvement[$count]->name_address_of_org ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control name_address_of_org all-caps" name="name_address_of_org{!! $count !!}" value="{!! $voluntart_work_involvement[$count]->name_address_of_org !!}">
                                                                    <label class="form-label" ><small>Name & Address of Organization (Write in full)</small></label> 
                                                                </div>
                                                                <label id="name_address_of_org{!! $count !!}-error" class="error" for="name_address_of_org{!! $count !!}"></label>
                                                            </div>
                                                           </div>

                                                         

                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $voluntart_work_involvement[$count]->inclusive_date_from ? 'add-focused' : '' !!}">
                                                                    <input  type="text" class="form-control date vwe_inclusive_date_from" name="inclusive_date_from{!! $count !!}" value="{!! $voluntart_work_involvement[$count]->inclusive_date_from ? date('m/d/Y', strtotime($voluntart_work_involvement[$count]->inclusive_date_from))  : '' !!}">
                                                                    <label class="form-label" >From: <small>INCLUSIVE DATES (mm/dd/yyyy) </small></label> 
                                                                </div>
                                                                <label id="inclusive_date_from{!! $count !!}-error" class="error" for="inclusive_date_from{!! $count !!}"></label>
                                                            </div>
                                                         
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $voluntart_work_involvement[$count]->inclusive_date_to ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control date vwe_inclusive_date_to" name="inclusive_date_to{!! $count !!}" value="{!! $voluntart_work_involvement[$count]->inclusive_date_to ? date('m/d/Y', strtotime($voluntart_work_involvement[$count]->inclusive_date_to))  : '' !!}">
                                                                    <label class="form-label" >To: <small>INCLUSIVE DATES (mm/dd/yyyy) </small></label> 
                                                                </div>
                                                                <label id="inclusive_date_to{!! $count !!}-error" class="error" for="inclusive_date_to{!! $count !!}"></label>
                                                            </div>
                                                           </div>


                                                           <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $voluntart_work_involvement[$count]->number_of_hours ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control number vwe_number_of_hours" name="number_of_hours{!! $count !!}" value="{!! $voluntart_work_involvement[$count]->number_of_hours !!}">
                                                                    <label class="form-label" ><small>Number of Hour/s</small></label> 
                                                                </div>
                                                                <label id="number_of_hours{!! $count !!}-error" class="error" for="number_of_hours{!! $count !!}"></label>
                                                            </div>
                                                     
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $voluntart_work_involvement[$count]->position_work ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control position_work all-caps" name="position_work{!! $count !!}" value="{!! $voluntart_work_involvement[$count]->position_work !!}">
                                                                    <label class="form-label" ><small>Position / Nature of Work</small></label> 
                                                                </div>
                                                                <label id="position_work{!! $count !!}-error" class="error" for="position_work{!! $count !!}"></label>
                                                            </div>
                                                           </div>




                                                           <div class="form-group form-float">
                                                                    <div class="col-md-12 action-button">
                                                                        @if($cnt == $count)
                                                                            @if($cnt == 0)
                                                                             <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                             <a style="cursor:pointer;display:none;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                            @else
                                                                             <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                             <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                            @endif
                                                                        @else

                                                                         <a style="cursor:pointer;display:none;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                         <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 

                                                                        @endif
                                                                    </div>
                                                            </div> 



                                                        </div>



                                                        
                                                            @endfor

                                                        </div>
                                                      
                                                            <div class="clearfix"></div><div class="divider-separator"></div><br> <!-- divider-separator -->
                                                          
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit"  style="float: right;top:-20px;">&nbsp; SAVE INFORMATION &nbsp;</button>
                                                       
                                                </form>
                                            </div>
                                          </div>
                                      </div>
                                 </section>

                                 <h2><small>LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED</small></h2>
                                 <section>
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <div class="card">
                                            <div class="header">
                                                <b> LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED</b>
                                                <br><small>(Start from the most recent L&D/training program and include only the relevant L&D/training taken for the last five (5) years for Division Chief/Executive/Managerial positions)</small>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-learning-development-intervention') !!}">
                                                
                                                <div class="clone-container">

                                                    {!! csrf_field() !!}
                                                    <input name="uid" type="hidden" value="{!! $uid !!}">


                                                        <!-- <h5>ELEMENTARY</h5> -->
                                                        <?php $cnt = count($learning_development_interventions)-1; ?>
                                                        @for($count=0; $count <= $cnt; $count++) 
                                                      
                                                        <div class="clone">

                                                          <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                            <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $learning_development_interventions[$count]->title_of_learning ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control title_of_learning all-caps" name="title_of_learning{!! $count !!}" value="{!! $learning_development_interventions[$count]->title_of_learning !!}">
                                                                    <label class="form-label" >Title of L&D/ Programs <small>(Write in Full)</small></label> 
                                                                </div>
                                                                <label id="title_of_learning{!! $count !!}-error" class="error" for="title_of_learning{!! $count !!}"></label>
                                                            </div>
                                                           </div>

                                                         

                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $learning_development_interventions[$count]->inclusive_date_from ? 'add-focused' : '' !!}">
                                                                    <input  type="text" class="form-control date ldt_inclusive_date_from" name="inclusive_date_from{!! $count !!}" value="{!! $learning_development_interventions[$count]->inclusive_date_from ? date('m/d/Y', strtotime($learning_development_interventions[$count]->inclusive_date_from))  : '' !!}">
                                                                    <label class="form-label" >From: <small>INCLUSIVE DATES (mm/dd/yyyy) </small></label> 
                                                                </div>
                                                                <label id="inclusive_date_from{!! $count !!}-error" class="error" for="inclusive_date_from{!! $count !!}"></label>
                                                            </div>
                                                           </div>


                                                           <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $learning_development_interventions[$count]->inclusive_date_to ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control date ldt_inclusive_date_to" name="inclusive_date_to{!! $count !!}" value="{!! $learning_development_interventions[$count]->inclusive_date_to ? date('m/d/Y', strtotime($learning_development_interventions[$count]->inclusive_date_to))  : '' !!}">
                                                                    <label class="form-label" >To: <small>INCLUSIVE DATES (mm/dd/yyyy) </small></label> 
                                                                </div>
                                                                <label id="inclusive_date_to{!! $count !!}-error" class="error" for="inclusive_date_to{!! $count !!}"></label>
                                                            </div>
                                                           </div>


                                                           <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $learning_development_interventions[$count]->number_of_hours ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control number ldt_number_of_hours" name="number_of_hours{!! $count !!}" value="{!! $learning_development_interventions[$count]->number_of_hours !!}">
                                                                    <label class="form-label" ><small>Number of Hour/s</small></label> 
                                                                </div>
                                                                <label id="number_of_hours{!! $count !!}-error" class="error" for="number_of_hours{!! $count !!}"></label>
                                                            </div>
                                                           </div>


                                                           <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line {!! $learning_development_interventions[$count]->type_of_ld ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control type_of_ld all-caps" name="type_of_ld{!! $count !!}" value="{!! $learning_development_interventions[$count]->type_of_ld !!}">
                                                                    <label class="form-label" ><small>Type of LD (Managerial/Supervisory/Technical/etc)</small></label> 
                                                                </div>
                                                                <label id="type_of_ld{!! $count !!}-error" class="error" for="type_of_ld{!! $count !!}"></label>
                                                            </div>
                                                           </div>


                                                         <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $learning_development_interventions[$count]->conducted_sponsored_by ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control conducted_sponsored_by  all-caps" name="conducted_sponsored_by{!! $count !!}" value="{!! $learning_development_interventions[$count]->conducted_sponsored_by !!}">
                                                                    <label class="form-label" >Conducted/Sponsored By <small>(Write in full)</small></label> 
                                                                </div>
                                                                <label id="conducted_sponsored_by{!! $count !!}-error" class="error" for="conducted_sponsored_by{!! $count !!}"></label>
                                                            </div>
                                                           </div>




                                                           <div class="form-group form-float">
                                                                    <div class="col-md-12 action-button">
                                                                        @if($cnt == $count)
                                                                            @if($cnt == 0)
                                                                             <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                             <a style="cursor:pointer;display:none;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                            @else
                                                                             <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                             <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                            @endif
                                                                        @else

                                                                         <a style="cursor:pointer;display:none;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                         <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 

                                                                        @endif
                                                                    </div>
                                                            </div> 



                                                        </div>



                                                        
                                                            @endfor

                                                        </div>
                                                      
                                                            <div class="clearfix"></div><div class="divider-separator"></div><br> <!-- divider-separator -->
                                                          
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit"  style="float: right;top:-20px;">&nbsp; SAVE INFORMATION &nbsp;</button>
                                                       
                                                </form>
                                            </div>
                                          </div>
                                      </div>
                                 </section>

                                 <h2><small>OTHER INFORMATION</small></h2>
                                 <section>
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <div class="card">
                                            <div class="header">
                                                <h2>OTHER INFORMATION </h2>
                                               
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-other-information') !!}">
                                                
                                                <div class="clone-container">

                                                    {!! csrf_field() !!}
                                                    <input name="uid" type="hidden" value="{!! $uid !!}">


                                                        <!-- <h5>ELEMENTARY</h5> -->
                                                        <?php $cnt = count($other_inforamtion)-1; ?>
                                                        @for($count=0; $count <= $cnt; $count++) 
                                                      
                                                        <div class="clone">

                                                          <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                            <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $other_inforamtion[$count]->special_skills_hobbies ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control special_skills_hobbies all-caps" name="special_skills_hobbies{!! $count !!}" value="{!! $other_inforamtion[$count]->special_skills_hobbies !!}">
                                                                    <label class="form-label" >Special Skills and Hobbies</label> 
                                                                </div>
                                                                <label id="special_skills_hobbies{!! $count !!}-error" class="error" for="special_skills_hobbies{!! $count !!}"></label>
                                                            </div>
                                                           </div>

                                                          <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $other_inforamtion[$count]->none_academic_distinctions ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control none_academic_distinctions  all-caps" name="none_academic_distinctions{!! $count !!}" value="{!! $other_inforamtion[$count]->none_academic_distinctions !!}">
                                                                    <label class="form-label" >Non-Academic Distinctions/Recognition <small>(Write in full)</small></label> 
                                                                </div>
                                                                <label id="none_academic_distinctions{!! $count !!}-error" class="error" for="none_academic_distinctions{!! $count !!}"></label>
                                                            </div>
                                                           </div>

                                                           <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $other_inforamtion[$count]->membership_in_assoc_org ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control membership_in_assoc_org  all-caps" name="membership_in_assoc_org{!! $count !!}" value="{!! $other_inforamtion[$count]->membership_in_assoc_org !!}">
                                                                    <label class="form-label" >Membership in Association/Organization <small>(Write in full)</small></label> 
                                                                </div>
                                                                <label id="membership_in_assoc_org{!! $count !!}-error" class="error" for="membership_in_assoc_org{!! $count !!}"></label>
                                                            </div>
                                                           </div>                                           


                                                           <div class="form-group form-float">
                                                                    <div class="col-md-12 action-button">
                                                                        @if($cnt == $count)
                                                                            @if($cnt == 0)
                                                                             <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                             <a style="cursor:pointer;display:none;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                            @else
                                                                             <a style="cursor:pointer;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                             <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 
                                                                            @endif
                                                                        @else

                                                                         <a style="cursor:pointer;display:none;" class="add_row"><i class="material-icons">add_to_photos</i></a>
                                                                         <a style="cursor:pointer;" class="delete_row"><i class="material-icons">delete_forever</i></a> 

                                                                        @endif
                                                                    </div>
                                                            </div> 



                                                        </div>



                                                        
                                                            @endfor

                                                        </div>
                                                      
                                                            <div class="clearfix"></div><div class="divider-separator"></div><br> <!-- divider-separator -->
                                                          
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit"  style="float: right;top:-20px;">&nbsp; SAVE INFORMATION &nbsp;</button>
                                                       
                                                </form>
                                            </div>
                                          </div>
                                      </div>
                                 </section>
                                
                                 <h2><small>SURVEY</small></h2>
                                 <section> 
                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h2>SURVEY</h2>
                                                        <ul class="header-dropdown m-r--5">
                                                            <li class="dropdown">
                                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="material-icons">more_vert</i>
                                                                </a>
                                                            
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="body">
                                                        <form method="POST" novalidate="novalidate" action="{!! url('personal-data-sheet/store-survey') !!}">
                                                        
                                                            {!! csrf_field() !!}
                                                            <input name="uid" type="hidden" value="{!! $uid !!}">
                                           

                                                               

                                                            <h2 class="card-inside-title">Are you related by consanguinity of affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, Bureau or Department where you will be appointed,</h2>
                                                            <div>  <small><b>a. </b>within the third degree?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_four_a" type="radio" id="34_a_y" value="1" {!! $survey->thirty_four_a == 1 ? 'checked' : '' !!}   class="with-gap">
                                                                <label for="34_a_y">Yes</label>
                                                           
                                                                <input name="thirty_four_a" type="radio" id="34_a_n" value="2" {!! $survey->thirty_four_a == 2 ? 'checked' : '' !!}   class="with-gap">
                                                                <label for="34_a_n">No</label>
                                                            </div>
                                                            </div>

                                                            <br>
                                                                  
                                                           <div>  <small><b>b. </b>within the fourth degree (for Local Goverment Unit - Career Employees)?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_four_b" type="radio" id="34_b_y" value="1" {!! $survey->thirty_four_b == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="34_b_y">Yes</label>
                                                           
                                                                <input name="thirty_four_b" type="radio" id="34_b_n" value="2" {!! $survey->thirty_four_b == 2 ? 'checked' : '' !!}  class="with-gap">
                                                                <label for="34_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_four_a_b_if_yes" name="thirty_four_a_b_if_yes" value="{!! $survey->thirty_four_a_b_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div>



                                                            <div>  <small><b>a. </b>Have you ever been found guilty of any administrative offense?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_five_a" type="radio" id="35_a_y" value="1" {!! $survey->thirty_five_a == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="35_a_y">Yes</label>
                                                           
                                                                <input name="thirty_five_a" type="radio" id="35_a_n" value="2" {!! $survey->thirty_five_a == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="35_a_n">No</label>
                                                            </div>
                                                            </div>

                                                           <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_five_a_if_yes" name="thirty_five_a_if_yes" value="{!! $survey->thirty_five_a_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                            <br>
                                                            <div class="blank"></div>
                                                            <div> <small><b>b. </b>Have you been criminally charged before any court?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_five_b" type="radio" id="35_b_y" value="1" {!! $survey->thirty_five_b == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="35_b_y">Yes</label>
                                                           
                                                                <input name="thirty_five_b" type="radio" id="35_b_n" value="2" {!! $survey->thirty_five_b == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="35_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small>Date Filed:</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" id="thirty_five_b_if_yes_date" name="thirty_five_b_if_yes_date" value="{!! $survey->thirty_five_b_if_yes_date !!}" class="form-control date">

                                                            </div>
                                                           <div class="blank"></div>
                                                           <small>Status of Case/s:</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_five_b_if_yes_case" name="thirty_five_b_if_yes_case" value="{!! $survey->thirty_five_b_if_yes_case !!}" class="form-control all-caps">

                                                            </div>
                                                            <div class="clearfix"></div><div class="divider-separator"></div>

     
                                                           <h2 class="card-inside-title">Have you ever been convicted of any crime or violation of any law, decree, ordinace or regulation by any court or tribunal?</h2>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_six" type="radio" id="36_b_y" value="1" {!! $survey->thirty_six == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="36_b_y">Yes</label>
                                                           
                                                                <input name="thirty_six" type="radio" id="36_b_n" value="2" {!! $survey->thirty_six == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="36_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_six_if_yes" name="thirty_six_if_yes" value="{!! $survey->thirty_six_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div>


                                                           <h2 class="card-inside-title">Have you ever been seperated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?</h2>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_seven" type="radio" id="37_b_y" value="1" {!! $survey->thirty_seven == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="37_b_y">Yes</label>
                                                           
                                                                <input name="thirty_seven" type="radio" id="37_b_n" value="2" {!! $survey->thirty_seven == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="37_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_seven_if_yes" name="thirty_seven_if_yes" value="{!! $survey->thirty_seven_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div> 


                                                            <div>  <small><b>a. </b>Have you ever been a candidate in a national or local election held within the last year <br> (except Barangay election)?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_eight_a" type="radio" id="38_a_y" value="1" {!! $survey->thirty_eight_a == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="38_a_y">Yes</label>
                                                           
                                                                <input name="thirty_eight_a" type="radio" id="38_a_n" value="2" {!! $survey->thirty_eight_a == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="38_a_n">No</label>
                                                            </div>
                                                            </div>
                                                           <small><b>If YES,</b> give details</small>
                                                            <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_eight_a_if_yes" name="thirty_eight_a_if_yes" value="{!! $survey->thirty_eight_a_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                         <br>

                                                         <div class="blank"></div>
                                                           <div>  <small><b>b. </b>Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_eight_b" type="radio" id="38_b_y" value="1" {!! $survey->thirty_eight_b == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="38_b_y">Yes</label>
                                                           
                                                                <input name="thirty_eight_b" type="radio" id="38_b_n" value="2" {!! $survey->thirty_eight_b == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="38_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small><b>If YES,</b> give details</small>
                                                            <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_eight_b_if_yes" name="thirty_eight_b_if_yes" value="{!! $survey->thirty_eight_b_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div>


                                                           <h2 class="card-inside-title">Have you acquired the status of an immigrant or permanent resident of another country?</h2>

                                                     <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="thirty_nine" type="radio" id="39_b_y" value="1" {!! $survey->thirty_nine == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="39_b_y">Yes</label>
                                                           
                                                                <input name="thirty_nine" type="radio" id="39_b_n" value="2" {!! $survey->thirty_nine == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="39_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="thirty_nine_if_yes" name="thirty_nine_if_yes" value="{!! $survey->thirty_nine_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>

                                                            <div class="clearfix"></div><div class="divider-separator"></div>


                                                           <h2 class="card-inside-title">Pursuant to: (a) Indigenous People's Act (RA 9371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), <br> <small>please answer the following items:</small></h2>
                                                            
                                                           <div class="blank"></div>
                                                           <div>  <small><b>a. </b> Are you a member of any indigenous group?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="fourty_a" type="radio" id="40_a_y" value="1" {!! $survey->fourty_a == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="40_a_y">Yes</label>
                                                           
                                                                <input name="fourty_a" type="radio" id="40_a_n" value="2" {!! $survey->fourty_a == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="40_a_n">No</label>
                                                            </div>
                                                            </div>


                                                            
                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="fourty_a_if_yes" name="fourty_a_if_yes" value="{!! $survey->fourty_a_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>
                                                            <br>
                                                            <div class="blank"></div>
                                                           <div>  <small><b>b. </b> Are you a person with disability?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="fourty_b" type="radio" id="40_b_y" value="1" {!! $survey->fourty_b == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="40_b_y">Yes</label>
                                                           
                                                                <input name="fourty_b" type="radio" id="40_b_n" value="2" {!! $survey->fourty_b == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="40_b_n">No</label>
                                                            </div>
                                                            </div>
                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="fourty_b_if_yes" name="fourty_b_if_yes" value="{!! $survey->fourty_b_if_yes !!}"  class="form-control all-caps">
                                                             
                                                            </div>
                                                            <br>

                                                          <div class="blank"></div>
                                                           <div>  <small><b>c. </b> Are you a solo parent?</small></div>
                                                            <div class="demo-radio-button">
                                                            <div> 
                                                                <input name="fourty_c" type="radio" id="40_c_y" value="1" {!! $survey->fourty_c == 1 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="40_c_y">Yes</label>
                                                           
                                                                <input name="fourty_c" type="radio" id="40_c_n" value="2" {!! $survey->fourty_c == 2 ? 'checked' : '' !!} class="with-gap">
                                                                <label for="40_c_n">No</label>
                                                            </div>
                                                            </div>

                                                            <small><b>If YES,</b> give details</small>
                                                           <div class="demo-radio-button">
                                                                <input type="text" maxlength="255"  id="fourty_c_if_yes" name="fourty_c_if_yes" value="{!! $survey->fourty_c_if_yes !!}" class="form-control all-caps">
                                                             
                                                            </div>


                                                            <div class="clearfix"></div><div class="divider-separator"></div>

                                                            <h2 class="card-inside-title">References <small>(Person not related by consanguinity or affinity to applicant/appointee)</small></h2>

                                                               <div class="form-group form-float">
                                                                      <div class="col-md-5">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="references_name_one" value="{!! $survey->references_name_one !!}" required aria-required="true">
                                                                            <label class="form-label" >Full name</label> 
                                                                        </div>
                                                                         <label id="references_name_one-error" class="error" for="references_name_one"></label>
                                                                      </div>
                                                                     
                                                                   

                                                          
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="references_address_one" value="{!! $survey->references_address_one !!}" required aria-required="true">
                                                                            <label class="form-label" >Address</label> 
                                                                        </div>
                                                                        <label id="references_address_one-error" class="error" for="references_address_one"></label>
                                                                      </div>
                                                                     

                                                        
                                                                      <div class="col-md-3">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control number" name="references_telephone_one" value="{!! $survey->references_telephone_one !!}"  required aria-required="true">
                                                                            <label class="form-label" >Tel. No.</label> 
                                                                        </div>
                                                                            <label id="references_telephone_one-error" class="error" for="references_telephone_one"></label>
                                                                      </div>
                                                              </div>

                                                               <div class="form-group form-float">
                                                                      <div class="col-md-5">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="references_name_two" value="{!! $survey->references_name_two !!}"  required aria-required="true">
                                                                            <label class="form-label" >Full name</label> 
                                                                        </div>
                                                                         <label id="references_name_two-error" class="error" for="references_name_two"></label>
                                                                      </div>
                                                                     
                                                                   

                                                          
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="references_address_two" value="{!! $survey->references_address_two !!}" required aria-required="true">
                                                                            <label class="form-label" >Address</label> 
                                                                        </div>
                                                                         <label id="references_address_two-error" class="error" for="references_address_two"></label>
                                                                      </div>
                                                                     

                                                        
                                                                      <div class="col-md-3">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control number" name="references_telephone_two" value="{!! $survey->references_telephone_two !!}"  required aria-required="true">
                                                                            <label class="form-label" >Tel. No.</label> 
                                                                        </div>
                                                                        <label id="references_telephone_two-error" class="error" for="references_telephone_two"></label>
                                                                      </div>
                                                              </div>

                                                              <div class="form-group form-float">
                                                                      <div class="col-md-5">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="references_name_three" value="{!! $survey->references_name_three !!}"  required aria-required="true">
                                                                            <label class="form-label" >Full name</label> 
                                                                        </div>
                                                                         <label id="references_name_three-error" class="error" for="references_name_three"></label>
                                                                      </div>
                                                                     
                                                                   

                                                          
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control all-caps" name="references_address_three"  value="{!! $survey->references_address_three !!}"  required aria-required="true">
                                                                            <label class="form-label" >Address</label> 
                                                                        </div>
                                                                         <label id="references_address_three-error" class="error" for="references_address_three"></label>
                                                                      </div>
                                                                     

                                                        
                                                                      <div class="col-md-3">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control number" name="references_telephone_three" value="{!! $survey->references_telephone_three !!}" required aria-required="true">
                                                                            <label class="form-label" >Tel. No.</label> 
                                                                        </div>
                                                                         <label id="references_telephone_three-error" class="error" for="references_telephone_three"></label>
                                                                      </div>
                                                              </div>




                                                            <div class="clearfix"></div><div class="divider-separator"></div>

                                                            <h2 class="card-inside-title">DECLARANT <small>(i.e. Passport, GSIS, SSS, PRC, Driver's License etc.)</small> <br> PLEASE INDICATE ID Number and Date of Issuance</h2>

                                                               <div class="form-group form-float">
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control  all-caps" name="government_issued_id" value="{!! $survey->government_issued_id !!}" required aria-required="true">
                                                                            <label class="form-label" >Government Issue ID</label> 
                                                                        </div>
                                                                        <label id="government_issued_id-error" class="error" for="government_issued_id"></label>
                                                                      </div>
                                                                     
                                                                   

                                                          
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control  all-caps" name="id_license_passport_number" value="{!! $survey->id_license_passport_number !!}" required aria-required="true">
                                                                            <label class="form-label" >ID/License/Passport No.</label> 
                                                                        </div>
                                                                        <label id="id_license_passport_number-error" class="error" for="id_license_passport_number"></label>
                                                                      </div>
                                                                     
                            
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control  all-caps" name="date_place_of_issuance" value="{!! $survey->date_place_of_issuance !!}" required aria-required="true">
                                                                            <label class="form-label" >Date/Place of Issuance</label> 
                                                                        </div>
                                                                         <label id="date_place_of_issuance-error" class="error" for="date_place_of_issuance"></label>
                                                                      </div>
                                                              </div>


                                                              <div class="clearfix"></div><div class="divider-separator"></div>

                                                            <h2 class="card-inside-title">CO-DECLARANT/SPOUSE <small>(i.e. Passport, GSIS, SSS, PRC, Driver's License etc.)</small> <br> PLEASE INDICATE ID Number and Date of Issuance</h2>

                                                               <div class="form-group form-float">
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control  all-caps" name="co_government_issued_id" value="{!! $survey->co_government_issued_id !!}" required aria-required="true">
                                                                            <label class="form-label" >Government Issue ID</label> 
                                                                        </div>
                                                                        <label id="co_government_issued_id-error" class="error" for="co_government_issued_id"></label>
                                                                      </div>
                                                                     
                                                                   

                                                          
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control  all-caps" name="co_id_license_passport_number" value="{!! $survey->co_id_license_passport_number !!}" required aria-required="true">
                                                                            <label class="form-label" >ID/License/Passport No.</label> 
                                                                        </div>
                                                                        <label id="co_id_license_passport_number-error" class="error" for="co_id_license_passport_number"></label>
                                                                      </div>
                                                                     
                            
                                                                      <div class="col-md-4">
                                                                        <div class="form-line">
                                                                            <input type="text" maxlength="255" class="form-control  all-caps" name="co_date_place_of_issuance" value="{!! $survey->co_date_place_of_issuance !!}" required aria-required="true">
                                                                            <label class="form-label" >Date/Place of Issuance</label> 
                                                                        </div>
                                                                         <label id="co_date_place_of_issuance-error" class="error" for="co_date_place_of_issuance"></label>
                                                                      </div>
                                                              </div>




                                                            <div class="clearfix"></div><div class="divider-separator"></div>

                                                            <h2 class="card-inside-title"><font color="red"><i>ID photo / Right Thumbmark / Signature (to follow)</i></font></h2>   

                                                            <div class="clearfix"></div><div class="divider-separator"></div><br> <!-- divider-separator -->
                                                                  
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit"  style="float: right;top:-20px;">&nbsp; SAVE INFORMATION &nbsp;</button>
                                                               
                                                        </form>
                                                    </div>
                                                </div>
                                       </div>
                                 </section>
                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Example | Vertical Layout -->




<!-- Height calculator -->
        <div class="modal fade" id="calculate-height" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-green">
                          <h4 class="modal-title" ><center>Height Calculator<center></h4>
                          <h5><center>(Feet and Inches to Meter)</center></h5>
                      </div>
                      <div class="modal-body">

                        <div class="form-group form-float">

                            <div class="col-md-6">
                                <div class="form-line">
                                    <input type="text" class="form-control number input-feet"  value="" name="feet" required aria-required="true" maxlength="2">
                                    <label class="form-label" >Feet (ft.)</label>
                                </div>
                                     <label id="feet-error" class="error" for="feet"></label>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-line">
                                    <input type="text" class="form-control number input-inches" name="inches" value="" required aria-required="true" maxlength="2">
                                    <label class="form-label" >Inches (Inch) </label>
                                </div>
                                     <label id="height-error" class="error" for="height"></label>
                            </div>
                        
                          
                        </div>  


                      </div>
                      <div class="modal-footer">
                           <button type="button" class="btn btn-link waves-effect kboard-icon-close" data-dismiss="modal">CLOSE</button> 
                      </div>
                  </div>
              </div>
          </div>

    <!-- #END calculator -->


@endsection
@section('styles')
    <!-- Bootstrap Select Css -->
    <link href="{!! asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') !!}" rel="stylesheet">

    <link href="{!! asset('admin-assets/css/customized-styles.css') !!}" rel="stylesheet">

    <style type="text/css">
        .form-group .form-line.add-focused .form-label {top: -10px;left: 0;font-size: 12px;}
        hr { border-top: 1px solid #000; }

        a.feet-to-meter-calculator {color: #000;cursor:pointer;}
        
        .divider-separator {
            height: 5px;
            border-top: 2px solid #eee;
            border-bottom: 2px solid #eee;
            margin-left: -15px;
            margin-right: -15px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>

@endsection
@section('scripts')

<script src="{!! asset('admin-assets/plugins/jquery-validation/jquery.validate.js') !!}"></script>
<script src="{!! asset('admin-assets/plugins/jquery-steps/jquery.steps.js') !!}"></script>
<script src="{!! asset('admin-assets/plugins/sweetalert/sweetalert.min.js') !!}"></script>
<script src="{!! asset('admin-assets/js/jquery.allmask.min.js') !!}"></script>
<script src="{!! asset('admin-assets/plugins/autosize/autosize.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
        autosize($('textarea.auto-growth'));

    });

    $(document).ready(function(){


        setTimeout(function() {
            $('.bootstrap-select').parent().removeClass('focused');
        }, 130);

        $('.txtOnly').bind('keyup blur',function(){ 
            $(this).val($(this).val().toUpperCase());
            var node = $(this);
            node.val(node.val().replace(/[^A-Z]/g,'') ); }
        );
      
    });

    $(document).ready(function(){
        $('.wizard .steps .done a').addClass('{{ $color[0] }}');
        $('.wizard .steps .current a').removeClass('{{ $color[0] }}');
        $('.wizard .steps .current a').addClass('{{ $color[2] }}');

        $('.wizard .steps .done a').on('click',function(){
            $('.wizard .steps .done a').addClass('{{ $color[0] }}');
            $(this).removeClass('{{ $color[0] }}');
            $(this).addClass('{{ $color[2] }}');

            $('.wizard > .actions a').addClass('{{ $color[2] }}');
            $('.wizard > .actions .disabled a').removeClass('{{ $color[2] }}');
        });


        $('.wizard > .actions a').addClass('{{ $color[2] }}');
        $('.wizard > .actions .disabled a').removeClass('{{ $color[2] }}');

        $('.wizard > .actions a').on('click',function(){
            $('.wizard > .actions a').addClass('{{ $color[2] }}');
            $('.wizard > .actions .disabled a').removeClass('{{ $color[2] }}');
        });
        
    });

    //Vertical form basic
    $('#wizard_vertical').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        stepsOrientation: 'vertical',
        onInit: function (event, currentIndex) {
            setButtonWavesEffect(event);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        }
    });

    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
    }


    $('form').submit(function(e) {
        
        apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src={{ asset('admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif') }} width='20' height='20' /></center>");
        $('.aButtons').hide();
      
        var form = $(this);
           $.ajax({
                    url: form.attr("action"),
                    type: form.attr("method"),
                    data: form.serialize(), 
                    success: function(data)
                        {
                                

                                // //setTimeout($('html, body').animate({scrollTop : 0},800), 1000);
                                
                                //  /$("#wizard_vertical").steps("next"); 
                        //apprise('close');

                          $('.appriseInner button').click();

                          if(data.success == true){

                            apprise('<strong><font size="3" color="green">'+data.message+'</font></strong>');
                            if(data.action == 1){

                                  // $("html, body").animate({ 
                                  //       scrollTop: $("#body-container").scrollTop() 
                                  //   }, 500);

                                 // $('.wizard.vertical > .actions > ul > li:nth-child(2)').click();

                                   // setTimeout($('html, body').animate({scrollTop : 0},800), 1000);
                                   //$("#wizard_vertical").steps("next"); 
                            }
                           
                              
                            update_task();
                            
                          }else{
                            console.log(data.message);
                            $.each( data.message, function( key, value ) {
                               $('label[id="'+key+'-error"]').text(value[0]);
                               $('label[id="'+key+'-error"]').prev().addClass('error focused');
                            });
                          }
                        }

                });
 
        return false;
    });
    

    function update_task(){
           $.ajax({
            url: '{{ url("tasks/list") }}',
            type:'POST',
            data:  {'_token':'{{ csrf_token() }}'},
            async: true,
            success: function(data)
                {
                 $('.task-container').html('');
                 $('.task-container').html(data.html);
                 $('.task-label').text(data.count);
                 if(data.count == 0){
                    $('.task-label').fadeOut();
                 }
                }
            });
    }

    $('input').on('focusout',function(){
        $(this).parent().removeClass('error');
        $(this).parent().next().text('');
        if(!$.trim(this.value).length) { // zero-length string AFTER a trim
            $(this).parents().removeClass('add-focused');
        }
    });


    $('body').on('click','.bootstrap-select',function(){
        $(this).parent().removeClass('error');
        $(this).parent().next().text('');
    });




     setTimeout(function() {
         $('.form-line').removeClass('focused');
     }, 100);

     $('.steps ul li').removeClass('disabled');
     $('.steps ul li').addClass('done');
     //$('.actions ').attr("style", "display:none");   



   $(document).ready(function () {

    reLoadMasking();

     $(document).on('click','.add_row',function(){

         
         var clone = $(this).parent().parent().parent().clone(true,true);
         $(this).parent().parent().parent().parent().append(clone);
         
          clone.find('input').not('.ignore').val("");
          clone.find('textarea').not('.ignore').val("");

          //clone.find('checkbox').prop( "checked", false );

          $(this).parent().parent().parent().parent().find('.focused').removeClass('focused')
          $(this).parent().parent().parent().parent().find('.add-focused').removeClass('add-focused')



            clone.find('.auto-arrange').text('');
            clone.find('.auto-arrange').prev().removeClass('error');
           // clone.find('.auto-arrange').prev().addClass('focused');

            clone.find('.action-button a:nth-child(2)').show();
            clone.prev().find('.action-button a:nth-child(1)').hide();
            clone.prev().find('.action-button a:nth-child(2)').show(); 

            //    clone.find('select.govt_service > option:selected').prop("selected", false);
            //    clone.find('select.govt_service > option:first').prop("selected", "selected");
            //    clone.find('.bootstrap-select.btn-group .dropdown-toggle .filter-option').text("Goverment Service (Y/N)");
            //    clone.find('.bootstrap-select.btn-group .dropdown-toggle').attr('title', 'Goverment Service (Y/N)');
            // //   clone.find('select.govt_service').selectpicker('destroy');
            // $('select.govt_service').selectpicker('destroy');
            // $('select.govt_service').selectpicker({showIcon: false});

            $('html, body').animate({ 
                scrollTop: $(document).height()-$(window).height()
            });

          
          reLoadMasking();
          reArrangeID();
           
          
     }); 


     function reArrangeID(){
           
        $('.clone-container').each(function(){
          $('.auto-arrange',this).each(function(index){
            var str =$(this).attr('id');
                var ret = str.split(".");
                var str1 = ret[0];
                var str2 = ret[1];
                $(this).attr("id",str1+"."+index+"-error");
                $(this).attr("for",str1+"."+index+"-error");
          });
        });
      

// civil service

            $(".cs_board_bar_ces_csee_barangay_drivers").each(function(index){
                 $(this).attr('name','cs_board_bar_ces_csee_barangay_drivers['+index+']');
                 $(this).parent().next().attr("id","cs_board_bar_ces_csee_barangay_drivers."+index+"-error");
                 $(this).parent().next().attr("for","cs_board_bar_ces_csee_barangay_drivers."+index+"-error");
            });
            $(".rating").each(function(index){
                 $(this).attr('name', 'rating['+index+']');
                 $(this).parent().next().attr("id","rating."+index+"-error");
                 $(this).parent().next().attr("for","rating."+index+"-error");
            });
            $(".date_of_exam_conferment").each(function(index){
                 $(this).attr('name', 'date_of_exam_conferment['+index+']');
                 $(this).parent().next().attr("id","date_of_exam_conferment."+index+"-error");
                 $(this).parent().next().attr("for","date_of_exam_conferment."+index+"-error");
            });
            $(".place_of_exam_conferment").each(function(index){
                 $(this).attr('name', 'place_of_exam_conferment['+index+']');
                 $(this).parent().next().attr("id","place_of_exam_conferment."+index+"-error");
                 $(this).parent().next().attr("for","place_of_exam_conferment."+index+"-error");
            });
            $(".license_number").each(function(index){
                 $(this).attr('name', 'license_number['+index+']');
                 $(this).parent().next().attr("id","license_number."+index+"-error");
                 $(this).parent().next().attr("for","license_number."+index+"-error");
            });
            $(".license_date_of_validity").each(function(index){
                 $(this).attr('name', 'license_date_of_validity['+index+']');
                 $(this).parent().next().attr("id","license_date_of_validity."+index+"-error");
                 $(this).parent().next().attr("for","license_date_of_validity."+index+"-error");
            });

 // work exp

            $(".tag_work").each(function(index){
                 $(this).attr("id","tag_work-"+index);
                 $(this).next().attr("for","tag_work-"+index);

                 $(this).attr('name', 'tag_work['+index+']');
                 // $(this).parent().next().attr("id","tag_work."+index+"-error");
                 // $(this).parent().next().attr("for","tag_work."+index+"-error");
            });


            $(".wp_inclusive_date_from").each(function(index){
                 $(this).attr('name', 'inclusive_date_from['+index+']');
                 $(this).parent().next().attr("id","inclusive_date_from."+index+"-error");
                 $(this).parent().next().attr("for","inclusive_date_from."+index+"-error");
            });

            $(".wp_inclusive_date_to").each(function(index){
                 $(this).attr('name', 'inclusive_date_to['+index+']');
                 $(this).parent().next().attr("id","inclusive_date_to."+index+"-error");
                 $(this).parent().next().attr("for","inclusive_date_to."+index+"-error");
            });

            $(".position_title").each(function(index){
                 $(this).attr('name', 'position_title['+index+']');
                 $(this).parent().next().attr("id","position_title."+index+"-error");
                 $(this).parent().next().attr("for","position_title."+index+"-error");
            });

            $(".dept_agency_office_company").each(function(index){
                 $(this).attr('name', 'dept_agency_office_company['+index+']');
                 $(this).parent().next().attr("id","dept_agency_office_company."+index+"-error");
                 $(this).parent().next().attr("for","dept_agency_office_company."+index+"-error");
            });

            $(".name_of_office_unit").each(function(index){
                 $(this).attr('name', 'name_of_office_unit['+index+']');
                 $(this).parent().next().attr("id","name_of_office_unit."+index+"-error");
                 $(this).parent().next().attr("for","name_of_office_unit."+index+"-error");
            });

            $(".immediate_supervisor").each(function(index){
                 $(this).attr('name', 'immediate_supervisor['+index+']');
                 $(this).parent().next().attr("id","immediate_supervisor."+index+"-error");
                 $(this).parent().next().attr("for","immediate_supervisor."+index+"-error");
            });

            $(".monthly_salary").each(function(index){
                 $(this).attr('name', 'monthly_salary['+index+']');
                 $(this).parent().next().attr("id","monthly_salary."+index+"-error");
                 $(this).parent().next().attr("for","monthly_salary."+index+"-error");
            });

            $(".paygrade").each(function(index){
                 $(this).attr('name', 'paygrade['+index+']');
                 $(this).parent().next().attr("id","paygrade."+index+"-error");
                 $(this).parent().next().attr("for","paygrade."+index+"-error");
            });
            
            $(".status_of_appointment").each(function(index){
                 $(this).attr('name', 'status_of_appointment['+index+']');
                 $(this).parent().next().attr("id","status_of_appointment."+index+"-error");
                 $(this).parent().next().attr("for","status_of_appointment."+index+"-error");
            });

            $(".govt_service").each(function(index){
                 $(this).attr('name', 'govt_service['+index+']');
                 $(this).parent().next().attr("id","govt_service."+index+"-error");
                 $(this).parent().next().attr("for","govt_service."+index+"-error");
            });

            $(".service_record_salary").each(function(index){
                 $(this).attr('name', 'service_record_salary['+index+']');
                 $(this).parent().next().attr("id","service_record_salary."+index+"-error");
                 $(this).parent().next().attr("for","service_record_salary."+index+"-error");
            });

            $(".agency_type").each(function(index){
                 $(this).attr('name', 'agency_type['+index+']');
                 $(this).parent().next().attr("id","agency_type."+index+"-error");
                 $(this).parent().next().attr("for","agency_type."+index+"-error");
            });

            $(".pay").each(function(index){
                 $(this).attr('name', 'pay['+index+']');
                 $(this).parent().next().attr("id","pay."+index+"-error");
                 $(this).parent().next().attr("for","pay."+index+"-error");
            });            
            
            $(".cause").each(function(index){
                 $(this).attr('name', 'cause['+index+']');
                 $(this).parent().next().attr("id","cause."+index+"-error");
                 $(this).parent().next().attr("for","cause."+index+"-error");
            });        


            $('.monthly_salary').on('keyup',function(){
                var annual = $(this).val().replace(/,/g, '') * 12;
                $(this).parent().parent().parent().parent().find('.service_record_salary').val(annual.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                $(this).parent().parent().parent().next().find('.srs-focus').addClass('focused');
            });

            $('.monthly_salary').on('click',function(){
                var annual = $(this).val().replace(/,/g, '') * 12;
                $(this).parent().parent().parent().parent().find('.service_record_salary').val(annual.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                $(this).parent().parent().parent().next().find('.srs-focus').addClass('focused');
            });

            $(".summary_of_duties").each(function(index){
                 $(this).attr('name', 'summary_of_duties['+index+']');
                 $(this).parent().next().attr("id","summary_of_duties."+index+"-error");
                 $(this).parent().next().attr("for","summary_of_duties."+index+"-error");
            });

            $(".office_address").each(function(index){
                 $(this).attr('name', 'office_address['+index+']');
                 $(this).parent().next().attr("id","office_address."+index+"-error");
                 $(this).parent().next().attr("for","office_address."+index+"-error");
            });
 

 


// voluntary work exeperience

           $(".name_address_of_org").each(function(index){
                 $(this).attr('name', 'name_address_of_org['+index+']');
                 $(this).parent().next().attr("id","name_address_of_org."+index+"-error");
                 $(this).parent().next().attr("for","name_address_of_org."+index+"-error");
            });


           $(".vwe_inclusive_date_from").each(function(index){
                 $(this).attr('name', 'inclusive_date_from['+index+']');
                 $(this).parent().next().attr("id","inclusive_date_from."+index+"-error");
                 $(this).parent().next().attr("for","inclusive_date_from."+index+"-error");
            });

           $(".vwe_inclusive_date_to").each(function(index){
                 $(this).attr('name', 'inclusive_date_to['+index+']');
                 $(this).parent().next().attr("id","inclusive_date_to."+index+"-error");
                 $(this).parent().next().attr("for","inclusive_date_to."+index+"-error");
            });

            $(".vwe_number_of_hours").each(function(index){
                 $(this).attr('name', 'number_of_hours['+index+']');
                 $(this).parent().next().attr("id","number_of_hours."+index+"-error");
                 $(this).parent().next().attr("for","number_of_hours."+index+"-error");
            });

            $(".position_work").each(function(index){
                 $(this).attr('name', 'position_work['+index+']');
                 $(this).parent().next().attr("id","position_work."+index+"-error");
                 $(this).parent().next().attr("for","position_work."+index+"-error");
            });


// learning and development intervention

            $(".title_of_learning").each(function(index){
                 $(this).attr('name', 'title_of_learning['+index+']');
                 $(this).parent().next().attr("id","title_of_learning."+index+"-error");
                 $(this).parent().next().attr("for","title_of_learning."+index+"-error");
            });


           $(".ldt_inclusive_date_from").each(function(index){
                 $(this).attr('name', 'inclusive_date_from['+index+']');
                 $(this).parent().next().attr("id","inclusive_date_from."+index+"-error");
                 $(this).parent().next().attr("for","inclusive_date_from."+index+"-error");
            });

           $(".ldt_inclusive_date_to").each(function(index){
                 $(this).attr('name', 'inclusive_date_to['+index+']');
                 $(this).parent().next().attr("id","inclusive_date_to."+index+"-error");
                 $(this).parent().next().attr("for","inclusive_date_to."+index+"-error");
            });

            $(".ldt_number_of_hours").each(function(index){
                 $(this).attr('name', 'number_of_hours['+index+']');
                 $(this).parent().next().attr("id","number_of_hours."+index+"-error");
                 $(this).parent().next().attr("for","number_of_hours."+index+"-error");
            });

            $(".type_of_ld").each(function(index){
                 $(this).attr('name', 'type_of_ld['+index+']');
                 $(this).parent().next().attr("id","type_of_ld."+index+"-error");
                 $(this).parent().next().attr("for","type_of_ld."+index+"-error");
            });

            $(".conducted_sponsored_by").each(function(index){
                 $(this).attr('name', 'conducted_sponsored_by['+index+']');
                 $(this).parent().next().attr("id","conducted_sponsored_by."+index+"-error");
                 $(this).parent().next().attr("for","conducted_sponsored_by."+index+"-error");
            });


// other information
            $(".special_skills_hobbies").each(function(index){
                 $(this).attr('name', 'special_skills_hobbies['+index+']');
                 $(this).parent().next().attr("id","special_skills_hobbies."+index+"-error");
                 $(this).parent().next().attr("for","special_skills_hobbies."+index+"-error");
            });

            $(".none_academic_distinctions").each(function(index){
                 $(this).attr('name', 'none_academic_distinctions['+index+']');
                 $(this).parent().next().attr("id","none_academic_distinctions."+index+"-error");
                 $(this).parent().next().attr("for","none_academic_distinctions."+index+"-error");
            });

            $(".membership_in_assoc_org").each(function(index){
                 $(this).attr('name', 'membership_in_assoc_org['+index+']');
                 $(this).parent().next().attr("id","membership_in_assoc_org."+index+"-error");
                 $(this).parent().next().attr("for","membership_in_assoc_org."+index+"-error");
            });


         number_validate();
         option_yn();
         all_caps();


     }

     reArrangeID();

    

     $(document).on('click','.delete_row',function(){

        var remove = $(this).parent().parent().parent();

        var parent = $(this).parent().parent().parent().parent();

        if(parent.find('.clone').length === 1){

            parent.find('.action-button a:nth-child(1)').show();
            parent.find('.action-button a:nth-child(2)').hide();

        }else{

            parent.find('.action-button a:nth-child(1)').hide();

            if(parent.find('.clone').length == 2){
                 parent.find('.action-button a:nth-child(2)').hide();
            }else{
                 parent.find('.action-button a:nth-child(2)').show();
            }
           
            remove.remove();
            parent.find('.clone').last().find('.action-button a:nth-child(1)').show();
        
        }
          
         
          //clearErrorMessage();
          reLoadMasking();
           reArrangeID();

           
     }); 

  
    });


        function reLoadMasking(){

             //  reinitialize javascipt

            var docHeadObj = document.getElementsByTagName("head")[0];
            var newScript= document.createElement("script");
            newScript.type = "text/javascript";
            newScript.src = public_url+"admin-assets/plugins/jquery/jquery.min.js";///
            docHeadObj.appendChild(newScript);

            var docHeadObj = document.getElementsByTagName("head")[0];
            var newScript= document.createElement("script");
            newScript.type = "text/javascript";
            newScript.src = public_url+"admin-assets/plugins/jquery-slimscroll/jquery.slimscroll.js";///
            docHeadObj.appendChild(newScript);

            var docHeadObj = document.getElementsByTagName("head")[0];
            var newScript= document.createElement("script");
            newScript.type = "text/javascript";
            newScript.src = public_url+"admin-assets/js/custom-admin.js";///
            docHeadObj.appendChild(newScript);

            var docHeadObj = document.getElementsByTagName("head")[0];
            var newScript= document.createElement("script");
            newScript.type = "text/javascript";
            newScript.src = public_url+"admin-assets/js/jquery.allmask.min.js";///
            docHeadObj.appendChild(newScript);

            // select

            // var docHeadObj = document.getElementsByTagName("head")[0];
            // var newScript= document.createElement("script");
            // newScript.type = "text/javascript";
            // newScript.src = public_url+"admin-assets/plugins/bootstrap-select/js/bootstrap-select.js";///
            // docHeadObj.appendChild(newScript);


            $('.date').mask('00/00/0000');
            $('.phone_with_ddd').mask('(000) 000-0000');
            $('.money').mask('000,000,000,000,000.00', {reverse: true});
           
              $('input').on('focusout',function(){
                $(this).parent().removeClass('error');
                $(this).parent().next().text('');
                if(!$.trim(this.value).length) { // zero-length string AFTER a trim
                    $(this).parents().removeClass('add-focused');
                 }
                });



        }

        
        function option_yn(){


         $('.option_yn').blur(function() {
                var val = this.value.toLowerCase();
                if(val != "yes" && val != "no") {
                    //this.value = '';
                   // alert( "'Yes' or 'No' is required. \n Please try again.");
                }
            })
            .keypress(function() {
                var val = this.value.toLowerCase();
                if(val != "yes" && val != "no") {
                    this.value = '';
                }
            })
            .keyup(function() {
                  $(this).val($(this).val().toUpperCase());
                var val = this.value.toLowerCase();
                if("yes".indexOf(val) != 0 &&
                   "no".indexOf(val) != 0) {
                       this.value = this.value.substr(0,this.value.length - 1);
                   }
            });
     
       }

       option_yn();


       function number_validate(){

            $(".number").keypress(function (e) {
                if(e.which == 46){
                    if($(this).val().indexOf('.') != -1) {
                        return false;
                    }
                }

                if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        

       }
       number_validate();
    
 
        function all_caps(){
            $('.all-caps').bind('keyup blur',function(){ 
             $(this).val($(this).val().toUpperCase());
            });
        }
         all_caps();



    $('.input-feet,.input-inches').on('keyup',function(){
           
            var cm;
            var meters;
            var inches2;
            var readout;
            var ifeet = parseInt($('.input-feet').val());
            var iinches = parseInt($('.input-inches').val());

            if(!iinches){
                iinches = 0;
            }

            if(!ifeet){
                ifeet = 0;
            }
        
        
            if(isNaN(ifeet)||isNaN(iinches)){

                // alert("Please enter numbers only");
                return false;
            }
            cm = ((ifeet * 30.48) + (iinches * .0254) * 100);
            meters = (cm)/100;

            $('.height').val((Math.round((meters * 1000)/10)/100).toFixed(2));
            $('.height').parent().addClass('focused');
            //$('.height').effect("highlight", {}, 3000);

           console.log(iinches);
          
           console.log((Math.round((meters * 1000)/10)/100).toFixed(2));

    });

    $(document).ready(function(){

        $('.feet-to-meter-calculator').on('click', function () {
        var color = $(this).data('color');
            $('#calculate-height .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
            
            $('.kboard-icon-open').html('keyboard_hide');

        });

        $('.kboard-icon-close').on('click',function(){
            $('.kboard-icon-open').html('keyboard');
        });

    });  

    
    $('#copy_to_permanent_address').on('click',function(){
        if($(this).is(":checked")){
            $('input[name="p_address_house_block_lot_number"]').val($('input[name="r_address_house_block_lot_number"]').val());
            $('input[name="p_address_house_block_lot_number"]').parent().addClass('focused');
            $('input[name="p_address_street"]').val($('input[name="r_address_street"]').val());
            $('input[name="p_address_street"]').parent().addClass('focused');
            $('input[name="p_address_subdivision_village"]').val($('input[name="r_address_subdivision_village"]').val());
            $('input[name="p_address_subdivision_village"]').parent().addClass('focused');
            $('input[name="p_address_barangay"]').val($('input[name="r_address_barangay"]').val());
            $('input[name="p_address_barangay"]').parent().addClass('focused');
            $('input[name="p_address_city_municipality"]').val($('input[name="r_address_city_municipality"]').val());
            $('input[name="p_address_city_municipality"]').parent().addClass('focused');
            $('input[name="p_address_province"]').val($('input[name="r_address_province"]').val());
            $('input[name="p_address_province"]').parent().addClass('focused');
            $('input[name="p_address_zipcode"]').val($('input[name="r_address_zipcode"]').val());
            $('input[name="p_address_zipcode"]').parent().addClass('focused');
        }else{
            $('input[name="p_address_house_block_lot_number"]').val('');
            $('input[name="p_address_house_block_lot_number"]').parent().removeClass('focused');
            $('input[name="p_address_street"]').val('');
            $('input[name="p_address_street"]').parent().removeClass('focused');
            $('input[name="p_address_subdivision_village"]').val('');
            $('input[name="p_address_subdivision_village"]').parent().removeClass('focused');
            $('input[name="p_address_barangay"]').val('');
            $('input[name="p_address_barangay"]').parent().removeClass('focused');
            $('input[name="p_address_city_municipality"]').val('');
            $('input[name="p_address_city_municipality"]').parent().removeClass('focused');
            $('input[name="p_address_province"]').val('');
            $('input[name="p_address_province"]').parent().removeClass('focused');
            $('input[name="p_address_zipcode"]').val('');
            $('input[name="p_address_zipcode"]').parent().removeClass('focused');
        }

            $('input[name="p_address_house_block_lot_number"]').parent().next().text('');
            $('input[name="p_address_house_block_lot_number"]').parent().removeClass('error');
            $('input[name="p_address_street"]').parent().next().text('');
            $('input[name="p_address_street"]').parent().removeClass('error');
            $('input[name="p_address_subdivision_village"]').parent().next().text('');
            $('input[name="p_address_subdivision_village"]').parent().removeClass('error');
            $('input[name="p_address_barangay"]').parent().next().text('');
            $('input[name="p_address_barangay"]').parent().removeClass('error');
            $('input[name="p_address_city_municipality"]').parent().next().text('');
            $('input[name="p_address_city_municipality"]').parent().removeClass('error');
            $('input[name="p_address_province"]').parent().next().text('');
            $('input[name="p_address_province"]').parent().removeClass('error');
            $('input[name="p_address_zipcode"]').parent().next().text('');
            $('input[name="p_address_zipcode"]').parent().removeClass('error');

    });


    $('input[name="r_address_house_block_lot_number"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_house_block_lot_number"]').val($(this).val());
            $('input[name="p_address_house_block_lot_number"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_house_block_lot_number"]').val('');
            $('input[name="p_address_house_block_lot_number"]').parent().removeClass('focused');
       }
            $('input[name="p_address_house_block_lot_number"]').parent().next().text('');
            $('input[name="p_address_house_block_lot_number"]').parent().removeClass('error');
    });

    $('input[name="r_address_street"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_street"]').val($(this).val());
            $('input[name="p_address_street"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_street"]').val('');
            $('input[name="p_address_street"]').parent().removeClass('focused');
       }
            $('input[name="p_address_street"]').parent().next().text('');
            $('input[name="p_address_street"]').parent().removeClass('error');
    });
   $('input[name="r_address_subdivision_village"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_subdivision_village"]').val($(this).val());
            $('input[name="p_address_subdivision_village"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_subdivision_village"]').val('');
            $('input[name="p_address_subdivision_village"]').parent().removeClass('focused');
       }
            $('input[name="p_address_subdivision_village"]').parent().next().text('');
            $('input[name="p_address_subdivision_village"]').parent().removeClass('error');
    });
    $('input[name="r_address_barangay"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_barangay"]').val($(this).val());
            $('input[name="p_address_barangay"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_barangay"]').val('');
            $('input[name="p_address_barangay"]').parent().removeClass('focused');
       }
            $('input[name="p_address_barangay"]').parent().next().text('');
            $('input[name="p_address_barangay"]').parent().removeClass('error'); 
    });
    $('input[name="r_address_city_municipality"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_city_municipality"]').val($(this).val());
            $('input[name="p_address_city_municipality"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_city_municipality"]').val('');
            $('input[name="p_address_city_municipality"]').parent().removeClass('focused');
       }
            $('input[name="p_address_city_municipality"]').parent().next().text('');
            $('input[name="p_address_city_municipality"]').parent().removeClass('error');
    });
   
    $('input[name="r_address_province"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_province"]').val($(this).val());
            $('input[name="p_address_province"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_province"]').val('');
            $('input[name="p_address_province"]').parent().removeClass('focused');
       }
            $('input[name="p_address_province"]').parent().next().text('');
            $('input[name="p_address_province"]').parent().removeClass('error');
    });
   $('input[name="r_address_zipcode"]').on('keyup',function(){
      if($('#copy_to_permanent_address').is(":checked")){
            $('input[name="p_address_zipcode"]').val($(this).val());
            $('input[name="p_address_zipcode"]').parent().addClass('focused');
       }else{
            $('input[name="p_address_zipcode"]').val('');
            $('input[name="p_address_zipcode"]').parent().removeClass('focused');
       }
            $('input[name="p_address_zipcode"]').parent().next().text('');
            $('input[name="p_address_zipcode"]').parent().removeClass('error');
    });

 
 $('.wizard.vertical > .steps > ul > li > a > span.number').each(function(){
   num = parseInt($(this).text().split(".")[0]);
   $(this).text(integer_to_roman(num)+'.');
 });




  
 function integer_to_roman(num) {
    if (typeof num !== 'number') 
    return false; 

        var digits = String(+num).split(""),
        key = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
        "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
        "","I","II","III","IV","V","VI","VII","VIII","IX"],
        roman_num = "",
        i = 3;
        while (i--)
        roman_num = (key[+digits.pop() + (i * 10)] || "") + roman_num;
        return Array(+digits.join("") + 1).join("M") + roman_num;
    }

   
    $(document).on('click','.wizard.vertical > .steps > ul > li',function(){
        $("html, body").animate({ 
            scrollTop: $("#body-container").scrollTop() 
        }, 500);
    });



 // create acronym

    const toAbbr = (str) => {
      var num = str.replace(/[^0-9]/g,'');
      if(num){
         num = '#'+num;
      }

      return str.match(/(?<=(\s|^))[a-z]/gi)
                .join('')
                .toUpperCase()+num
    };


    $('a[href="#finish"]').on('click',function(){
        window.open("{{ url('personal-data-sheet') }}/download/{{$uid}}", '_blank');
    });

// only user can edit pds

    @if(Auth::user()->id != decrypt($uid))
         $(document).ready(function(){
            $('form').find('input, textarea, button, select').attr('disabled','disabled');
            $('form').attr('action', '');
            $('.feet-to-meter-calculator,.add_row,.delete_row,input[name="uid"],input[name="_token"],form > button,input[type="hidden"]').remove();
         });
     @endif

   </script>


@endsection