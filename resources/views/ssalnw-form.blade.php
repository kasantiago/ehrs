@extends('layouts.app')
@section('title','SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH FORM')

@section('content')

    <!-- Basic Example | Vertical Layout -->
            <div class="row clearfix" id="body-container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3>{!! strtoupper(App\Http\Models\PersonalInformation::get_name(decrypt($uid))) !!}</h3>
                            <h2>SWORN STATEMENT OF ASSETS, LIABILITIES AND NET WORTH FORM</h2>

                            <hr style="margin-top: 20px; margin-bottom: 20px; border: 0; border-top: 1px solid #eee;">

                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-xs-12" align="right">

                                    @if(Auth::user()->role == 'user')
                                        <a type="button" href="{{ url('sworn-statement-assets-liabilities-net-worth') }}/archived/{{$uid}}" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;" >
                                            <i class="material-icons">picture_as_pdf</i> &nbsp; Notarized SSALNW &nbsp;  <i class="material-icons">archive</i> 
                                        </a>
                                    @endif

                                     <a type="button" href="{{ url('sworn-statement-assets-liabilities-net-worth') }}/download/{{$uid}}" class="btn {!! $color[2] !!} waves-effect" style="padding: 0px 2px 5px 2px;" target="_blank">
                                    <i class="material-icons">picture_as_pdf</i> &nbsp; SSALNW &nbsp;  <i class="material-icons">file_download</i> 
                                    </a>

                                </div>
                              </div>
                            </div>

                        </div>
                        <div class="body">
                            <div id="wizard_vertical">

                                <h2><small>INFORMATION</small></h2>
                                <section class="disabled">
                                  
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>INFORMATION</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                 
                                                
                                                        <h5>DECLARANT</h5>
                                                        <br>
                                                        <div class="form-group form-float">
                                                          <div class="col-md-6">
                                                            <div class="form-line {!! $personal_information->surname ? 'add-focused' : '' !!}">
                                                                <input type="text" class="form-control all-caps" name="surname" value="{!! $personal_information->surname !!}" required aria-required="true" maxlength="255">
                                                                <label class="form-label">Surname</label> 
                                                            </div>
                                                            <label id="surname-error" class="error" for="surname"></label>
                                                          </div>
                                              
                                                          <div class="col-md-6">
                                                            <div class="form-line {!! $personal_information->first_name ? 'add-focused' : '' !!}">
                                                                <input type="text" class="form-control all-caps" name="first_name" value="{!! $personal_information->first_name !!}" required aria-required="true" maxlength="255">
                                                                <label class="form-label">First Name</label>
                                                            </div>
                                                            <label id="first_name-error" class="error" for="first_name"></label>
                                                          </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-line {!! $personal_information->middle_name ? 'add-focused' : '' !!}">
                                                                    <input type="text" class="form-control all-caps" name="middle_name" value="{!! $personal_information->middle_name !!}" required aria-required="true" maxlength="255">
                                                                    <label class="form-label">Middle Name</label>
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

                                                        <h5>ADDRESS</h5>
                                                        <br>
                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-line {!! $personal_information->r_address_house_block_lot_number ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" value="{!! $personal_information->r_address_house_block_lot_number !!}" class="form-control all-caps" name="r_address_house_block_lot_number"  aria-required="true">
                                                                        <label class="form-label">House/Block/Lot No.</label>
                                                                    </div>
                                                                      <label id="r_address_house_block_lot_number-error" class="error" for="r_address_house_block_lot_number"></label>
                                                                  </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-line {!! $personal_information->r_address_street ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->r_address_street !!}" name="r_address_street"  aria-required="true">
                                                                        <label class="form-label">Street</label>
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
                                                                        <label class="form-label">Subdivision/Village</label>
                                                                    </div>
                                                                      <label id="r_address_subdivision_village-error" class="error" for="r_address_subdivision_village"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-line {!! $personal_information->r_address_barangay ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" name="r_address_barangay" value="{!! $personal_information->r_address_barangay !!}"  aria-required="true">
                                                                        <label class="form-label">Barangay</label>
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
                                                                        <label class="form-label">City/Municipality</label>
                                                                    </div>
                                                                      <label id="r_address_city_municipality-error" class="error" for="r_address_city_municipality"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="form-line {!! $personal_information->r_address_province ? 'add-focused' : '' !!}">
                                                                        <input type="text" maxlength="255" class="form-control all-caps" value="{!! $personal_information->r_address_province !!}" name="r_address_province"  aria-required="true">
                                                                        <label class="form-label">Province</label>
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
                                                                        <label class="form-label">ZIP Code</label>
                                                                    </div>
                                                                      <label id="r_address_zipcode-error" class="error" for="r_address_zipcode"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                   
                                                        <div class="form-group form-float">
                                                          <div class="col-md-12">
                                                            <div class="form-line {!! $work_experience->position_title ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255" class="form-control" value="{!! $work_experience->position_title !!}" name="position_title" required aria-required="true">
                                                                <label class="form-label">Position</label> 
                                                            </div>
                                                            <label id="position_title-error" class="error" for="position_title"></label>
                                                          </div>
                                                       
                                                          <div class="col-md-12">
                                                            <div class="form-line {!! $work_experience->dept_agency_office_company ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255" class="form-control  mobile_number" name="mobile_number" value="{!! $work_experience->dept_agency_office_company!!}" required aria-required="true">
                                                                <label class="form-label">Agency/Office</label> 
                                                            </div>
                                                            <label id="dept_agency_office_company-error" class="error" for="dept_agency_office_company"></label>
                                                          </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                          <div class="col-md-12">
                                                            <div class="form-line {!! $work_experience->office_address ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255" class="form-control" value="{!! $work_experience->office_address !!}" name="office_address" required aria-required="true">
                                                                <label class="form-label">Office Address</label> 
                                                            </div>
                                                            <label id="office_address-error" class="error" for="office_address"></label>
                                                          </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                        <h5 style="height: 33px;">SPOUSE</h5>
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
                                                          <div class="col-md-12">
                                                            <div class="form-line {!! $family_background->spouse_occupation ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255" class="form-control all-caps" name="spouse_occupation" value="{!! $family_background->spouse_occupation !!}">
                                                                <label class="form-label">Position</label> 
                                                            </div>
                                                            <label id="spouse_occupation-error" class="error" for="spouse_occupation"></label>
                                                          </div>
                                                       
                                                          <div class="col-md-12">
                                                            <div class="form-line {!! $family_background->spouse_employer_business_name ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255" class="form-control all-caps" name="spouse_employer_business_name" value="{!! $family_background->spouse_employer_business_name !!}">
                                                                <label class="form-label">Agency/Office</label> 
                                                            </div>
                                                            <label id="spouse_employer_business_name-error" class="error" for="spouse_employer_business_name"></label>
                                                          </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                          <div class="col-md-12">
                                                            <div class="form-line {!! $family_background->spouse_business_address ? 'add-focused' : '' !!}">
                                                                <input type="text" maxlength="255" class="form-control all-caps" name="spouse_business_address" value="{!! $family_background->spouse_business_address !!}">
                                                                <label class="form-label">Office Address</label> 
                                                            </div>
                                                            <label id="spouse_business_address-error" class="error" for="spouse_business_address"></label>
                                                          </div>
                                                        </div>

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->
                                                        
                                                        <div style="width: 100%; text-align: right; margin-top: -5px; display: none;">
                                                            <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                        </div>

                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2><small>UNMARRIED CHILDREN BELOW EIGHTEEN (18) YEARS OF AGE LIVING IN DECLARANTS HOUSEHOLD</small></h2>
                                <section  class="disabled">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>UNMARRIED CHILDREN BELOW EIGHTEEN (18) YEARS OF AGE LIVING IN DECLARANTS HOUSEHOLD</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                           
                                                    <h5>CHILDREN</h5>

                                                    <div class="clone-container">
                                                    <?php $cnt = count($childrens)-1; ?>
                                                    @for($count=0; $count <= $cnt; $count++) 

                                                        <div class="clone">

                                                            <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line {!! $childrens[$count]->fullname ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255" class="form-control all-caps" name="fullname[]" value="{!! $childrens[$count]->fullname !!}">
                                                                    <label class="form-label">Name of Child</label> 
                                                                </div>
                                                                <label id="fullname{!! $count !!}-error" class="error" for="fullname{!! $count !!}"></label>
                                                              </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                                <div class="col-md-6">
                                                                    <div class="form-line {!! $childrens[$count]->date_of_birth ? 'add-focused' : '' !!}">
                                                                        <input type="text" class="form-control date" name="date_of_birth[]" value="{!! $childrens[$count]->date_of_birth ? date('m/d/Y', strtotime($childrens[$count]->date_of_birth))  : '' !!}" required aria-required="true" maxlength="10">
                                                                        <label class="form-label">Date of Birth (mm/dd/yyyy)</label>
                                                                    </div>
                                                                    <label id="date_of_birth.{!! $count !!}-error" class="error auto-arrange" for="date_of_birth{!! $count !!}"></label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-float">
                                                              <div class="col-md-6">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255" class="form-control all-caps" name="age[]" value="{!! $childrens[$count]->age !!}">
                                                                    <label class="form-label" style="top: -10px; left: 0; font-size: 12px;">Age</label> 
                                                                </div>
                                                                <label id="age{!! $count !!}-error" class="error" for="age{!! $count !!}"></label>
                                                              </div>
                                                            </div>

                                                            <div class="form-group form-float" style="display: none;">
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
                                                                        
                                                    <div style="width: 100%; text-align: right; margin-top: -5px; display: none;">
                                                        <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                    </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2><small>ASSETS <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; A. REAL PROPERTIES*</small></h2>
                                <section>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>A. REAL PROPERTIES*</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('sworn-statement-assets-liabilities-net-worth/store-assets-real-properties') !!}">
                                            
                                                <div class="clone-container">

                                                {!! csrf_field() !!}
                                                <input name="uid" type="hidden" value="{!! $uid !!}">

                                                    <?php $cnt = count($assets_real_properties)-1; ?>
                                                    @for($count=0; $count <= $cnt; $count++) 
                                              
                                                    <div class="clone">
                                                
                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_description all-caps" name="description{!! $count !!}" value="{!! $assets_real_properties[$count]->description !!}">
                                                                    <label class="form-label" ><small>DESCRIPTION</small></label> 
                                                                </div>
                                                                <label id="description{!! $count !!}-error" class="error" for="description{!! $count !!}"></label>
                                                            </div>
                                                      
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_kind all-caps" name="kind{!! $count !!}" value="{!! $assets_real_properties[$count]->kind !!}">
                                                                    <label class="form-label" ><small>KIND</small></label> 
                                                                </div>
                                                                <label id="kind{!! $count !!}-error" class="error" for="kind{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_exact_location all-caps" name="exact_location{!! $count !!}" value="{!! $assets_real_properties[$count]->exact_location !!}">
                                                                    <label class="form-label" ><small>EXACT LOCATION</small></label> 
                                                                </div>
                                                                <label id="exact_location{!! $count !!}-error" class="error" for="exact_location{!! $count !!}"></label>
                                                            </div>
                                                      
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_assessed_value all-caps money" name="assessed_value{!! $count !!}" value="{!! $assets_real_properties[$count]->assessed_value !!}">
                                                                    <label class="form-label" ><small>ASSESSED VALUE</small></label> 
                                                                </div>
                                                                <label id="assessed_value{!! $count !!}-error" class="error" for="assessed_value{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_current_fair_market_value all-caps money" name="current_fair_market_value{!! $count !!}" value="{!! $assets_real_properties[$count]->current_fair_market_value !!}">
                                                                    <label class="form-label" ><small>CURRENT FAIR MARKET VALUE</small></label> 
                                                                </div>
                                                                <label id="current_fair_market_value{!! $count !!}-error" class="error" for="current_fair_market_value{!! $count !!}"></label>
                                                            </div>
                                                      
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text"  class="form-control arp_acquisition_year all-caps" name="acquisition_year{!! $count !!}" value="{!! $assets_real_properties[$count]->acquisition_year !!}">
                                                                    <label class="form-label" ><small>ACQUISITION YEAR</small></label> 
                                                                </div>
                                                                <label id="acquisition_year{!! $count !!}-error" class="error" for="acquisition_year{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_acquisition_mode all-caps" name="acquisition_mode{!! $count !!}" value="{!! $assets_real_properties[$count]->acquisition_mode !!}">
                                                                    <label class="form-label" ><small>ACQUISITION MODE</small></label> 
                                                                </div>
                                                                <label id="acquisition_mode{!! $count !!}-error" class="error" for="acquisition_mode{!! $count !!}"></label>
                                                            </div>
                                                      
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control arp_acquisition_cost all-caps money" name="acquisition_cost{!! $count !!}" value="{!! $assets_real_properties[$count]->acquisition_cost !!}">
                                                                    <label class="form-label" ><small>ACQUISITION COST</small></label> 
                                                                </div>
                                                                <label id="acquisition_cost{!! $count !!}-error" class="error" for="acquisition_cost{!! $count !!}"></label>
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

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                    </div>

                                                    @endfor

                                                </div>
                
                                                <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2><small>ASSETS <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; B. PERSONAL PROPERTIES*</small></h2>
                                <section >
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dis">
                                        <div class="card">
                                            <div class="header">
                                                <h2>B. PERSONAL PROPERTIES*</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('sworn-statement-assets-liabilities-net-worth/store-assets-personal-properties') !!}">
                                            
                                                <div class="clone-container">

                                                {!! csrf_field() !!}
                                                <input name="uid" type="hidden" value="{!! $uid !!}">

                                                    <?php $cnt = count($assets_personal_properties)-1; ?>
                                                    @for($count=0; $count <= $cnt; $count++) 
                                              
                                                    <div class="clone">
                                                
                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control app_description all-caps" name="description{!! $count !!}" value="{!! $assets_personal_properties[$count]->description !!}">
                                                                    <label class="form-label" ><small>DESCRIPTION</small></label> 
                                                                </div>
                                                                <label id="description{!! $count !!}-error" class="error" for="description{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text"  class="form-control app_year_acquired all-caps" name="year_acquired{!! $count !!}" value="{!! $assets_personal_properties[$count]->year_acquired !!}">
                                                                    <label class="form-label" ><small>YEAR ACQUIRED</small></label> 
                                                                </div>
                                                                <label id="year_acquired{!! $count !!}-error" class="error" for="year_acquired{!! $count !!}"></label>
                                                            </div>
                                                      
                                                            <div class="col-md-6">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control app_acquisition_cost all-caps money" name="acquisition_cost{!! $count !!}" value="{!! $assets_personal_properties[$count]->acquisition_cost !!}">
                                                                    <label class="form-label" ><small>ACQUISITION COST/AMOUNT</small></label> 
                                                                </div>
                                                                <label id="acquisition_cost{!! $count !!}-error" class="error" for="acquisition_cost{!! $count !!}"></label>
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

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                    </div>

                                                    @endfor

                                                </div>
                
                                                <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2><small>LIABILITIES*</small></h2>
                                <section>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>LIABILITIES*</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('sworn-statement-assets-liabilities-net-worth/store-liabilities') !!}">
                                            
                                                <div class="clone-container">

                                                {!! csrf_field() !!}
                                                <input name="uid" type="hidden" value="{!! $uid !!}">

                                                    <?php $cnt = count($assets_liabilities)-1; ?>
                                                    @for($count=0; $count <= $cnt; $count++) 
                                              
                                                    <div class="clone">
                                                
                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control nature all-caps" name="nature{!! $count !!}" value="{!! $assets_liabilities[$count]->nature !!}">
                                                                    <label class="form-label" ><small>NATURE</small></label> 
                                                                </div>
                                                                <label id="nature{!! $count !!}-error" class="error" for="nature{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control name_of_creditors all-caps" name="name_of_creditors{!! $count !!}" value="{!! $assets_liabilities[$count]->name_of_creditors !!}">
                                                                    <label class="form-label" ><small>NAME OF CREDITORS</small></label> 
                                                                </div>
                                                                <label id="name_of_creditors{!! $count !!}-error" class="error" for="name_of_creditors{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line ">
                                                                    <input type="text" maxlength="255"  class="form-control outstanding_balance all-caps money" name="outstanding_balance{!! $count !!}" value="{!! $assets_liabilities[$count]->outstanding_balance !!}">
                                                                    <label class="form-label" ><small>OUTSTANDING BALANCE</small></label> 
                                                                </div>
                                                                <label id="outstanding_balance{!! $count !!}-error" class="error" for="outstanding_balance{!! $count !!}"></label>
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

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                    </div>

                                                    @endfor

                                                </div>
                
                                                <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2><small>BUSINESS INTERESTS AND FINANCIAL CONNECTIONS</small></h2>
                                <section>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>BUSINESS INTERESTS AND FINANCIAL CONNECTIONS</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">
                                                <form method="POST" novalidate="novalidate" action="{!! url('sworn-statement-assets-liabilities-net-worth/store-business-interest-and-financial') !!}">
                                            
                                                <div class="clone-container">

                                                {!! csrf_field() !!}
                                                <input name="uid" type="hidden" value="{!! $uid !!}">

                                                    <?php $cnt = count($business_interest_and_financial)-1; ?>
                                                    @for($count=0; $count <= $cnt; $count++) 
                                              
                                                    <div class="clone">
                                                
                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255"  class="form-control name_of_business     all-caps" name="name_of_business {!! $count !!}" value="{!! $business_interest_and_financial[$count]->name_of_business  !!}">
                                                                    <label class="form-label" ><small>NAME OF ENTITY/BUSINESS ENTERPRISE</small></label> 
                                                                </div>
                                                                <label id="name_of_business {!! $count !!}-error" class="error" for="name_of_business  {!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255"  class="form-control business_address all-caps" name="business_address  {!! $count !!}" value="{!! $business_interest_and_financial[$count]->business_address   !!}">
                                                                    <label class="form-label" ><small>BUSINESS ADDRESS</small></label> 
                                                                </div>
                                                                <label id="business_address{!! $count !!}-error" class="error" for="business_address{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255"  class="form-control nature_of_business all-caps" name="nature_of_business{!! $count !!}" value="{!! $business_interest_and_financial[$count]->nature_of_business !!}">
                                                                    <label class="form-label" ><small>NATURE OF BUSINESS INTEREST & /OR FINANCIAL CONNECTION</small></label> 
                                                                </div>
                                                                <label id="nature_of_business{!! $count !!}-error" class="error" for="nature_of_business{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255"  class="form-control date_of_acquisition  all-caps" name="date_of_acquisition    {!! $count !!}" value="{!! $business_interest_and_financial[$count]->date_of_acquisition    !!}">
                                                                    <label class="form-label" ><small>DATE OF ACQUISITION OF INTEREST OR CONNECTION</small></label> 
                                                                </div>
                                                                <label id="date_of_acquisition  {!! $count !!}-error" class="error" for="date_of_acquisition {!! $count !!}"></label>
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

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                    </div>

                                                    @endfor

                                                </div>
                
                                                <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2><small>RELATIVES IN THE GOVERNMENT SERVICE</small></h2>
                                <section>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>RELATIVES IN THE GOVERNMENT SERVICE</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="body">

                                             <form method="POST" novalidate="novalidate" action="{!! url('sworn-statement-assets-liabilities-net-worth/store-relatives-government-service') !!}">
                                              {!! csrf_field() !!}
                                                <div class="clone-container">

                                               
                                                <input name="uid" type="hidden" value="{!! $uid !!}">

                                                    <?php $cnt = count($relatives_government_service)-1; ?>
                                                    @for($count=0; $count <= $cnt; $count++) 
                                              
                                                    <div class="clone">
                                                
                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line {!! $relatives_government_service[$count]->name_of_relative ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control name_of_relative all-caps" name="name_of_relative{!! $count !!}" value="{!! $relatives_government_service[$count]->name_of_relative!!}">
                                                                    <label class="form-label" ><small>NAME OF RELATIVE</small></label> 
                                                                </div>
                                                                <label id="name_of_relative{!! $count !!}-error" class="error" for="name_of_relative{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line {!! $relatives_government_service[$count]->relationship ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control relationship all-caps" name="relationship{!! $count !!}" value="{!! $relatives_government_service[$count]->relationship!!}">
                                                                    <label class="form-label" ><small>RELATIONSHIP</small></label> 
                                                                </div>
                                                                <label id="relationship{!! $count !!}-error" class="error" for="relationship{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line {!! $relatives_government_service[$count]->position ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control position all-caps" name="position{!! $count !!}" value="{!! $relatives_government_service[$count]->position !!}">
                                                                    <label class="form-label" ><small>POSITION</small></label> 
                                                                </div>
                                                                <label id="position{!! $count !!}-error" class="error" for="position{!! $count !!}"></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group form-float">
                                                            <div class="col-md-12">
                                                                <div class="form-line {!! $relatives_government_service[$count]->agency_and_address ? 'add-focused' : '' !!}">
                                                                    <input type="text" maxlength="255"  class="form-control agency_and_address all-caps" name="agency_and_address{!! $count !!}" value="{!! $relatives_government_service[$count]->agency_and_address !!}">
                                                                    <label class="form-label" ><small>NAME OF AGENCY/OFFICE AND ADDRESS</small></label> 
                                                                </div>
                                                                <label id="agency_and_address{!! $count !!}-error" class="error" for="agency_and_address{!! $count !!}"></label>
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

                                                        <div class="clearfix"></div><div class="divider-separator"></div> <!-- divider-separator -->

                                                    </div>

                                                    @endfor

                                                </div>
                
                                                <div style="width: 100%; text-align: right; margin-top: -5px;">
                                                    <button class="btn {{ $color[2] }} waves-effect" type="submit" >&nbsp; SAVE INFORMATION &nbsp;</button>
                                                </div>

                                                </form>    
                                            </div>
                                        </div>
                                    </div>
                                </section>


                                <h2><small>GOVERMENT ISSUED ID</small></h2>
                                <section class="disabled">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">

                                            <div class="header">
                                                <h2>GOVERMENT ISSUED ID</h2>
                                                <ul class="header-dropdown m-r--5">
                                                    <li class="dropdown">
                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                    
                                                    </li>
                                                </ul>
                                            </div>

                                           <div class="body">
                                                   

                                                    <h2 class="card-inside-title">DECLARANT <small>(i.e. Passport, GSIS, SSS, PRC, Driver's License etc.)</small> <br> PLEASE INDICATE ID Number and Date of Issuance</h2>

                                                       <div class="form-group form-float">
                                                              <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255" class="form-control  all-caps" name="government_issued_id" value="{!! $survey->government_issued_id !!}" required aria-required="true">
                                                                    <label class="form-label" >Government Issue ID</label> 
                                                                </div>
                                                                <label id="government_issued_id-error" class="error" for="government_issued_id"></label>
                                                              </div>
                                                             
                                                           

                                                  
                                                              <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255" class="form-control  all-caps" name="id_license_passport_number" value="{!! $survey->id_license_passport_number !!}" required aria-required="true">
                                                                    <label class="form-label" >ID/License/Passport No.</label> 
                                                                </div>
                                                                <label id="id_license_passport_number-error" class="error" for="id_license_passport_number"></label>
                                                              </div>
                                                             
                    
                                                              <div class="col-md-12">
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
                                                              <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255" class="form-control  all-caps" name="co_government_issued_id" value="{!! $survey->co_government_issued_id !!}" required aria-required="true">
                                                                    <label class="form-label" >Government Issue ID</label> 
                                                                </div>
                                                                <label id="co_government_issued_id-error" class="error" for="co_government_issued_id"></label>
                                                              </div>
                                                             
                                                           

                                                  
                                                              <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255" class="form-control  all-caps" name="co_id_license_passport_number" value="{!! $survey->co_id_license_passport_number !!}" required aria-required="true">
                                                                    <label class="form-label" >ID/License/Passport No.</label> 
                                                                </div>
                                                                <label id="co_id_license_passport_number-error" class="error" for="co_id_license_passport_number"></label>
                                                              </div>
                                                             
                    
                                                              <div class="col-md-12">
                                                                <div class="form-line">
                                                                    <input type="text" maxlength="255" class="form-control  all-caps" name="co_date_place_of_issuance" value="{!! $survey->co_date_place_of_issuance !!}" required aria-required="true">
                                                                    <label class="form-label" >Date/Place of Issuance</label> 
                                                                </div>
                                                                 <label id="co_date_place_of_issuance-error" class="error" for="co_date_place_of_issuance"></label>
                                                              </div>

                                                              <div class="clearfix"></div><div class="divider-separator"></div>
                                                      </div>
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

@endsection

@section('styles')
    <!-- Bootstrap Select Css -->
    <link href="{!! asset('admin-assets/plugins/bootstrap-select/css/bootstrap-select.css') !!}" rel="stylesheet">

    <link href="{!! asset('admin-assets/css/customized-styles.css') !!}" rel="stylesheet">

    <style type="text/css">
        .form-group .form-line.add-focused .form-label {top: -10px;left: 0;font-size: 12px;}
        hr { border-top: 1px solid #000; }
        
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
                                

                            //setTimeout($('html, body').animate({scrollTop : 0},800), 1000);
                                
                            //$("#wizard_vertical").steps("next"); 
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
          clone.find('input').val("");
          $(this).parent().parent().parent().parent().find('.focused').removeClass('focused')
          $(this).parent().parent().parent().parent().find('.add-focused').removeClass('add-focused')



            clone.find('.auto-arrange').text('');
            clone.find('.auto-arrange').prev().removeClass('error');
           // clone.find('.auto-arrange').prev().addClass('focused');


            clone.find('.action-button a:nth-child(2)').show();
            clone.prev().find('.action-button a:nth-child(1)').hide();
            clone.prev().find('.action-button a:nth-child(2)').show(); 


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


// assets real properties
            $(".arp_description").each(function(index){
                 $(this).attr('name', 'description['+index+']');
                 $(this).parent().next().attr("id","description."+index+"-error");
                 $(this).parent().next().attr("for","description."+index+"-error");
            });

      
            $(".arp_kind").each(function(index){
                 $(this).attr('name', 'kind['+index+']');
                 $(this).parent().next().attr("id","kind."+index+"-error");
                 $(this).parent().next().attr("for","kind."+index+"-error");
            });

            $(".arp_exact_location").each(function(index){
                 $(this).attr('name', 'exact_location['+index+']');
                 $(this).parent().next().attr("id","exact_location."+index+"-error");
                 $(this).parent().next().attr("for","exact_location."+index+"-error");
            });

            $(".arp_assessed_value").each(function(index){
                 $(this).attr('name', 'assessed_value['+index+']');
                 $(this).parent().next().attr("id","assessed_value."+index+"-error");
                 $(this).parent().next().attr("for","assessed_value."+index+"-error");
            });


            $(".arp_current_fair_market_value").each(function(index){
                 $(this).attr('name', 'current_fair_market_value['+index+']');
                 $(this).parent().next().attr("id","current_fair_market_value."+index+"-error");
                 $(this).parent().next().attr("for","current_fair_market_value."+index+"-error");
            });
          
            $(".arp_acquisition_year").each(function(index){
                 $(this).attr('name', 'acquisition_year['+index+']');
                 $(this).parent().next().attr("id","acquisition_year."+index+"-error");
                 $(this).parent().next().attr("for","acquisition_year."+index+"-error");
            });


            $(".arp_acquisition_mode").each(function(index){
                 $(this).attr('name', 'acquisition_mode['+index+']');
                 $(this).parent().next().attr("id","acquisition_mode."+index+"-error");
                 $(this).parent().next().attr("for","acquisition_mode."+index+"-error");
            });

            $(".arp_acquisition_cost").each(function(index){
                 $(this).attr('name', 'acquisition_cost['+index+']');
                 $(this).parent().next().attr("id","acquisition_cost."+index+"-error");
                 $(this).parent().next().attr("for","acquisition_cost."+index+"-error");
            });

// assets personal properties
            
            $(".app_description").each(function(index){
                 $(this).attr('name', 'description['+index+']');
                 $(this).parent().next().attr("id","description."+index+"-error");
                 $(this).parent().next().attr("for","description."+index+"-error");
            });

            $(".app_year_acquired").each(function(index){
                 $(this).attr('name', 'year_acquired['+index+']');
                 $(this).parent().next().attr("id","year_acquired."+index+"-error");
                 $(this).parent().next().attr("for","year_acquired."+index+"-error");
            });

            $(".app_acquisition_cost").each(function(index){
                 $(this).attr('name', 'acquisition_cost['+index+']');
                 $(this).parent().next().attr("id","acquisition_cost."+index+"-error");
                 $(this).parent().next().attr("for","acquisition_cost."+index+"-error");
            });

// liabilities

            $(".nature").each(function(index){
                 $(this).attr('name', 'nature['+index+']');
                 $(this).parent().next().attr("id","nature."+index+"-error");
                 $(this).parent().next().attr("for","nature."+index+"-error");
            });

            $(".name_of_creditors").each(function(index){
                 $(this).attr('name', 'name_of_creditors['+index+']');
                 $(this).parent().next().attr("id","name_of_creditors."+index+"-error");
                 $(this).parent().next().attr("for","name_of_creditors."+index+"-error");
            });

            $(".outstanding_balance").each(function(index){
                 $(this).attr('name', 'outstanding_balance['+index+']');
                 $(this).parent().next().attr("id","outstanding_balance."+index+"-error");
                 $(this).parent().next().attr("for","outstanding_balance."+index+"-error");
            });



 // assets business interest and financial connection

            $(".name_of_business").each(function(index){
                 $(this).attr('name', 'name_of_business['+index+']');
                 $(this).parent().next().attr("id","name_of_business."+index+"-error");
                 $(this).parent().next().attr("for","name_of_business."+index+"-error");
            });

            $(".business_address").each(function(index){
                 $(this).attr('name', 'business_address['+index+']');
                 $(this).parent().next().attr("id","business_address."+index+"-error");
                 $(this).parent().next().attr("for","business_address."+index+"-error");
            });

            $(".nature_of_business").each(function(index){
                 $(this).attr('name', 'nature_of_business['+index+']');
                 $(this).parent().next().attr("id","nature_of_business."+index+"-error");
                 $(this).parent().next().attr("for","nature_of_business."+index+"-error");
            });

              $(".date_of_acquisition").each(function(index){
                 $(this).attr('name', 'date_of_acquisition['+index+']');
                 $(this).parent().next().attr("id","date_of_acquisition."+index+"-error");
                 $(this).parent().next().attr("for","date_of_acquisition."+index+"-error");
            });


 // relative in th govermenet service

            $(".name_of_relative").each(function(index){
                 $(this).attr('name', 'name_of_relative['+index+']');
                 $(this).parent().next().attr("id","name_of_relative."+index+"-error");
                 $(this).parent().next().attr("for","name_of_relative."+index+"-error");
            });

            $(".relationship").each(function(index){
                 $(this).attr('name', 'relationship['+index+']');
                 $(this).parent().next().attr("id","relationship."+index+"-error");
                 $(this).parent().next().attr("for","relationship."+index+"-error");
            });

            $(".position").each(function(index){
                 $(this).attr('name', 'position['+index+']');
                 $(this).parent().next().attr("id","position."+index+"-error");
                 $(this).parent().next().attr("for","position."+index+"-error");
            });

              $(".agency_and_address").each(function(index){
                 $(this).attr('name', 'agency_and_address['+index+']');
                 $(this).parent().next().attr("id","agency_and_address."+index+"-error");
                 $(this).parent().next().attr("for","agency_and_address."+index+"-error");
            });

 // work exp

            // $(".wp_inclusive_date_from").each(function(index){
            //      $(this).attr('name', 'inclusive_date_from['+index+']');
            //      $(this).parent().next().attr("id","inclusive_date_from."+index+"-error");
            //      $(this).parent().next().attr("for","inclusive_date_from."+index+"-error");
            // });

            // $(".wp_inclusive_date_to").each(function(index){
            //      $(this).attr('name', 'inclusive_date_to['+index+']');
            //      $(this).parent().next().attr("id","inclusive_date_to."+index+"-error");
            //      $(this).parent().next().attr("for","inclusive_date_to."+index+"-error");
            // });

            // $(".position_title").each(function(index){
            //      $(this).attr('name', 'position_title['+index+']');
            //      $(this).parent().next().attr("id","position_title."+index+"-error");
            //      $(this).parent().next().attr("for","position_title."+index+"-error");
            // });

            // $(".dept_agency_office_company").each(function(index){
            //      $(this).attr('name', 'dept_agency_office_company['+index+']');
            //      $(this).parent().next().attr("id","dept_agency_office_company."+index+"-error");
            //      $(this).parent().next().attr("for","dept_agency_office_company."+index+"-error");
            // });

            // $(".name_of_office_unit").each(function(index){
            //      $(this).attr('name', 'name_of_office_unit['+index+']');
            //      $(this).parent().next().attr("id","name_of_office_unit."+index+"-error");
            //      $(this).parent().next().attr("for","name_of_office_unit."+index+"-error");
            // });

            // $(".immediate_supervisor").each(function(index){
            //      $(this).attr('name', 'immediate_supervisor['+index+']');
            //      $(this).parent().next().attr("id","immediate_supervisor."+index+"-error");
            //      $(this).parent().next().attr("for","immediate_supervisor."+index+"-error");
            // });

            // $(".monthly_salary").each(function(index){
            //      $(this).attr('name', 'monthly_salary['+index+']');
            //      $(this).parent().next().attr("id","monthly_salary."+index+"-error");
            //      $(this).parent().next().attr("for","monthly_salary."+index+"-error");
            // });

            // $(".paygrade").each(function(index){
            //      $(this).attr('name', 'paygrade['+index+']');
            //      $(this).parent().next().attr("id","paygrade."+index+"-error");
            //      $(this).parent().next().attr("for","paygrade."+index+"-error");
            // });
            
            // $(".status_of_appointment").each(function(index){
            //      $(this).attr('name', 'status_of_appointment['+index+']');
            //      $(this).parent().next().attr("id","status_of_appointment."+index+"-error");
            //      $(this).parent().next().attr("for","status_of_appointment."+index+"-error");
            // });

            // $(".govt_service").each(function(index){
            //      $(this).attr('name', 'govt_service['+index+']');
            //      $(this).parent().next().attr("id","govt_service."+index+"-error");
            //      $(this).parent().next().attr("for","govt_service."+index+"-error");
            // });

            // $(".service_record_salary").each(function(index){
            //      $(this).attr('name', 'service_record_salary['+index+']');
            //      $(this).parent().next().attr("id","service_record_salary."+index+"-error");
            //      $(this).parent().next().attr("for","service_record_salary."+index+"-error");
            // });

            // $(".agency_type").each(function(index){
            //      $(this).attr('name', 'agency_type['+index+']');
            //      $(this).parent().next().attr("id","agency_type."+index+"-error");
            //      $(this).parent().next().attr("for","agency_type."+index+"-error");
            // });

            // $(".pay").each(function(index){
            //      $(this).attr('name', 'pay['+index+']');
            //      $(this).parent().next().attr("id","pay."+index+"-error");
            //      $(this).parent().next().attr("for","pay."+index+"-error");
            // });            
            
            // $(".cause").each(function(index){
            //      $(this).attr('name', 'cause['+index+']');
            //      $(this).parent().next().attr("id","cause."+index+"-error");
            //      $(this).parent().next().attr("for","cause."+index+"-error");
            // });        


            // $('.monthly_salary').on('keyup',function(){
            //     var annual = $(this).val().replace(/,/g, '') * 12;
            //     $(this).parent().parent().parent().parent().find('.service_record_salary').val(annual.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            //     $(this).parent().parent().parent().next().find('.srs-focus').addClass('focused');
            // });

            // $('.monthly_salary').on('click',function(){
            //     var annual = $(this).val().replace(/,/g, '') * 12;
            //     $(this).parent().parent().parent().parent().find('.service_record_salary').val(annual.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            //     $(this).parent().parent().parent().next().find('.srs-focus').addClass('focused');
            // });

            // $(".summary_of_duties").each(function(index){
            //      $(this).attr('name', 'summary_of_duties['+index+']');
            //      $(this).parent().next().attr("id","summary_of_duties."+index+"-error");
            //      $(this).parent().next().attr("for","summary_of_duties."+index+"-error");
            // });



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
        window.open("{{ url('sworn-statement-assets-liabilities-net-worth') }}/download/{{$uid}}", '_blank');
    });

// only user can edit pds

    @if(Auth::user()->id != decrypt($uid))
         $(document).ready(function(){
            $('form').find('input, textarea, button, select').attr('disabled','disabled');
            $('form').attr('action', '');
            $('.feet-to-meter-calculator,.add_row,.delete_row,input[name="uid"],input[name="_token"],form > button,input[type="hidden"]').remove();
         });
     @endif

     $('.disabled').find('select').prop('disabled',true);
     $('.disabled').find('input').prop('disabled',true);

   </script>
@endsection