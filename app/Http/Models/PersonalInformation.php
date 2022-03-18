<?php

namespace App\Http\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table = 'personal_information';

    public static function find_data($uid){
    	$find = DB::table('personal_information')->where('user_id',$uid)->where('flag',1)->first();
    	if($find){
    		$find = $find->id;
    	}
    	return $find;
    }

    public static function get_data($uid){
    	$find = DB::table('personal_information')->where('id',$uid)->where('flag',1)->first();
    	return $find;
    }

    public static function get_user_data($uid){
 
    	$find = DB::table('personal_information')->where('user_id',$uid)->where('flag',1)->first();
    	return $find;
    }


    public static function get_name($uid){
    	if(!$uid){
    		return "";
    	}
        $full_name = DB::table('personal_information')->where('user_id',$uid)->where('flag',1)->first();
        
        if($full_name){
        	$ext_name = '';
        	
        	($full_name->name_extension) ? $ext_name = ', '.strtoupper($full_name->name_extension) : '';

        	$full_name = strtoupper($full_name->surname).', '.strtoupper($full_name->first_name).' '.strtoupper($full_name->middle_name[0]).'.'.$ext_name;
        }else{
			$full_name = DB::table('users')->where('id',$uid)->first();
			$full_name = $full_name ? strtoupper($full_name->name) : '';
        }
        return $full_name;
    }


    public static function generate_blank_data(){

    	$data= new \stdClass();
    	$data->user_id = '';
		$data->surname = '';
		$data->first_name = '';
		$data->name_extension = '';
		$data->middle_name = '';
		$data->date_of_birth = '';
		$data->place_of_birth = '';
		$data->sex = '';
		$data->civil_status = '';
		$data->height = '';
		$data->weight = '';
		$data->blood_type = '';
		$data->gsis_id_number = '';
		$data->pagibig_id_number = '';
		$data->philhealth_number = '';
		$data->sss_number = '';
		$data->tin_number = '';
		$data->agency_employee_number = '';
		$data->citizenship = '';
		$data->country = '';
		$data->duplicate_address = 0;
		$data->r_address_house_block_lot_number = '';
		$data->r_address_street = '';
		$data->r_address_subdivision_village = '';
		$data->r_address_barangay = '';
		$data->r_address_city_municipality = '';
		$data->r_address_province = '';
		$data->r_address_zipcode = '';
		$data->p_address_house_block_lot_number = '';
		$data->p_address_street = '';
		$data->p_address_subdivision_village = '';
		$data->p_address_barangay = '';
		$data->p_address_city_municipality = '';
		$data->p_address_province = '';
		$data->p_address_zipcode = '';
		$data->telephone_number = '';
		$data->mobile_number = '';
		$data->email_address = '';

		return $data;
    }


      public static function pdf_generate_blank_data(){

    	$data= new \stdClass();
    	$data->user_id = 'N/A';
		$data->surname = 'N/A';
		$data->first_name = 'N/A';
		$data->name_extension = 'N/A';
		$data->middle_name = 'N/A';
		$data->date_of_birth = 'N/A';
		$data->place_of_birth = 'N/A';
		$data->sex = 'N/A';
		$data->civil_status = 'N/A';
		$data->height = 'N/A';
		$data->weight = 'N/A';
		$data->blood_type = 'N/A';
		$data->gsis_id_number = 'N/A';
		$data->pagibig_id_number = 'N/A';
		$data->philhealth_number = 'N/A';
		$data->sss_number = 'N/A';
		$data->tin_number = 'N/A';
		$data->agency_employee_number = 'N/A';
		$data->citizenship = 'N/A';
		$data->country = 'N/A';
		$data->r_address_house_block_lot_number = 'N/A';
		$data->r_address_street = 'N/A';
		$data->r_address_subdivision_village = 'N/A';
		$data->r_address_barangay = 'N/A';
		$data->r_address_city_municipality = 'N/A';
		$data->r_address_province = 'N/A';
		$data->r_address_zipcode = 'N/A';
		$data->p_address_house_block_lot_number = 'N/A';
		$data->p_address_street = 'N/A';
		$data->p_address_subdivision_village = 'N/A';
		$data->p_address_barangay = 'N/A';
		$data->p_address_city_municipality = 'N/A';
		$data->p_address_province = 'N/A';
		$data->p_address_zipcode = 'N/A';
		$data->telephone_number = 'N/A';
		$data->mobile_number = 'N/A';
		$data->email_address = 'N/A';

		return $data;
    }



    public static function countries(){
    	   $country_array = array(
    	   				""   => "If holder of dual citizenship",
						"AF" => "Afghanistan",
						"AL" => "Albania",
						"DZ" => "Algeria",
						"AS" => "American Samoa",
						"AD" => "Andorra",
						"AO" => "Angola",
						"AI" => "Anguilla",
						"AQ" => "Antarctica",
						"AG" => "Antigua and Barbuda",
						"AR" => "Argentina",
						"AM" => "Armenia",
						"AW" => "Aruba",
						"AU" => "Australia",
						"AT" => "Austria",
						"AZ" => "Azerbaijan",
						"BS" => "Bahamas",
						"BH" => "Bahrain",
						"BD" => "Bangladesh",
						"BB" => "Barbados",
						"BY" => "Belarus",
						"BE" => "Belgium",
						"BZ" => "Belize",
						"BJ" => "Benin",
						"BM" => "Bermuda",
						"BT" => "Bhutan",
						"BO" => "Bolivia",
						"BA" => "Bosnia and Herzegovina",
						"BW" => "Botswana",
						"BV" => "Bouvet Island",
						"BR" => "Brazil",
						"BQ" => "British Antarctic Territory",
						"IO" => "British Indian Ocean Territory",
						"VG" => "British Virgin Islands",
						"BN" => "Brunei",
						"BG" => "Bulgaria",
						"BF" => "Burkina Faso",
						"BI" => "Burundi",
						"KH" => "Cambodia",
						"CM" => "Cameroon",
						"CA" => "Canada",
						"CT" => "Canton and Enderbury Islands",
						"CV" => "Cape Verde",
						"KY" => "Cayman Islands",
						"CF" => "Central African Republic",
						"TD" => "Chad",
						"CL" => "Chile",
						"CN" => "China",
						"CX" => "Christmas Island",
						"CC" => "Cocos [Keeling] Islands",
						"CO" => "Colombia",
						"KM" => "Comoros",
						"CG" => "Congo - Brazzaville",
						"CD" => "Congo - Kinshasa",
						"CK" => "Cook Islands",
						"CR" => "Costa Rica",
						"HR" => "Croatia",
						"CU" => "Cuba",
						"CY" => "Cyprus",
						"CZ" => "Czech Republic",
						"CI" => "Côte d’Ivoire",
						"DK" => "Denmark",
						"DJ" => "Djibouti",
						"DM" => "Dominica",
						"DO" => "Dominican Republic",
						"NQ" => "Dronning Maud Land",
						"DD" => "East Germany",
						"EC" => "Ecuador",
						"EG" => "Egypt",
						"SV" => "El Salvador",
						"GQ" => "Equatorial Guinea",
						"ER" => "Eritrea",
						"EE" => "Estonia",
						"ET" => "Ethiopia",
						"FK" => "Falkland Islands",
						"FO" => "Faroe Islands",
						"FJ" => "Fiji",
						"FI" => "Finland",
						"FR" => "France",
						"GF" => "French Guiana",
						"PF" => "French Polynesia",
						"TF" => "French Southern Territories",
						"FQ" => "French Southern and Antarctic Territories",
						"GA" => "Gabon",
						"GM" => "Gambia",
						"GE" => "Georgia",
						"DE" => "Germany",
						"GH" => "Ghana",
						"GI" => "Gibraltar",
						"GR" => "Greece",
						"GL" => "Greenland",
						"GD" => "Grenada",
						"GP" => "Guadeloupe",
						"GU" => "Guam",
						"GT" => "Guatemala",
						"GG" => "Guernsey",
						"GN" => "Guinea",
						"GW" => "Guinea-Bissau",
						"GY" => "Guyana",
						"HT" => "Haiti",
						"HM" => "Heard Island and McDonald Islands",
						"HN" => "Honduras",
						"HK" => "Hong Kong SAR China",
						"HU" => "Hungary",
						"IS" => "Iceland",
						"IN" => "India",
						"ID" => "Indonesia",
						"IR" => "Iran",
						"IQ" => "Iraq",
						"IE" => "Ireland",
						"IM" => "Isle of Man",
						"IL" => "Israel",
						"IT" => "Italy",
						"JM" => "Jamaica",
						"JP" => "Japan",
						"JE" => "Jersey",
						"JT" => "Johnston Island",
						"JO" => "Jordan",
						"KZ" => "Kazakhstan",
						"KE" => "Kenya",
						"KI" => "Kiribati",
						"KW" => "Kuwait",
						"KG" => "Kyrgyzstan",
						"LA" => "Laos",
						"LV" => "Latvia",
						"LB" => "Lebanon",
						"LS" => "Lesotho",
						"LR" => "Liberia",
						"LY" => "Libya",
						"LI" => "Liechtenstein",
						"LT" => "Lithuania",
						"LU" => "Luxembourg",
						"MO" => "Macau SAR China",
						"MK" => "Macedonia",
						"MG" => "Madagascar",
						"MW" => "Malawi",
						"MY" => "Malaysia",
						"MV" => "Maldives",
						"ML" => "Mali",
						"MT" => "Malta",
						"MH" => "Marshall Islands",
						"MQ" => "Martinique",
						"MR" => "Mauritania",
						"MU" => "Mauritius",
						"YT" => "Mayotte",
						"FX" => "Metropolitan France",
						"MX" => "Mexico",
						"FM" => "Micronesia",
						"MI" => "Midway Islands",
						"MD" => "Moldova",
						"MC" => "Monaco",
						"MN" => "Mongolia",
						"ME" => "Montenegro",
						"MS" => "Montserrat",
						"MA" => "Morocco",
						"MZ" => "Mozambique",
						"MM" => "Myanmar [Burma]",
						"NA" => "Namibia",
						"NR" => "Nauru",
						"NP" => "Nepal",
						"NL" => "Netherlands",
						"AN" => "Netherlands Antilles",
						"NT" => "Neutral Zone",
						"NC" => "New Caledonia",
						"NZ" => "New Zealand",
						"NI" => "Nicaragua",
						"NE" => "Niger",
						"NG" => "Nigeria",
						"NU" => "Niue",
						"NF" => "Norfolk Island",
						"KP" => "North Korea",
						"VD" => "North Vietnam",
						"MP" => "Northern Mariana Islands",
						"NO" => "Norway",
						"OM" => "Oman",
						"PC" => "Pacific Islands Trust Territory",
						"PK" => "Pakistan",
						"PW" => "Palau",
						"PS" => "Palestinian Territories",
						"PA" => "Panama",
						"PZ" => "Panama Canal Zone",
						"PG" => "Papua New Guinea",
						"PY" => "Paraguay",
						"YD" => "People's Democratic Republic of Yemen",
						"PE" => "Peru",
						"PH" => "Philippines",
						"PN" => "Pitcairn Islands",
						"PL" => "Poland",
						"PT" => "Portugal",
						"PR" => "Puerto Rico",
						"QA" => "Qatar",
						"RO" => "Romania",
						"RU" => "Russia",
						"RW" => "Rwanda",
						"RE" => "Réunion",
						"BL" => "Saint Barthélemy",
						"SH" => "Saint Helena",
						"KN" => "Saint Kitts and Nevis",
						"LC" => "Saint Lucia",
						"MF" => "Saint Martin",
						"PM" => "Saint Pierre and Miquelon",
						"VC" => "Saint Vincent and the Grenadines",
						"WS" => "Samoa",
						"SM" => "San Marino",
						"SA" => "Saudi Arabia",
						"SN" => "Senegal",
						"RS" => "Serbia",
						"CS" => "Serbia and Montenegro",
						"SC" => "Seychelles",
						"SL" => "Sierra Leone",
						"SG" => "Singapore",
						"SK" => "Slovakia",
						"SI" => "Slovenia",
						"SB" => "Solomon Islands",
						"SO" => "Somalia",
						"ZA" => "South Africa",
						"GS" => "South Georgia and the South Sandwich Islands",
						"KR" => "South Korea",
						"ES" => "Spain",
						"LK" => "Sri Lanka",
						"SD" => "Sudan",
						"SR" => "Suriname",
						"SJ" => "Svalbard and Jan Mayen",
						"SZ" => "Swaziland",
						"SE" => "Sweden",
						"CH" => "Switzerland",
						"SY" => "Syria",
						"ST" => "São Tomé and Príncipe",
						"TW" => "Taiwan",
						"TJ" => "Tajikistan",
						"TZ" => "Tanzania",
						"TH" => "Thailand",
						"TL" => "Timor-Leste",
						"TG" => "Togo",
						"TK" => "Tokelau",
						"TO" => "Tonga",
						"TT" => "Trinidad and Tobago",
						"TN" => "Tunisia",
						"TR" => "Turkey",
						"TM" => "Turkmenistan",
						"TC" => "Turks and Caicos Islands",
						"TV" => "Tuvalu",
						"UM" => "U.S. Minor Outlying Islands",
						"PU" => "U.S. Miscellaneous Pacific Islands",
						"VI" => "U.S. Virgin Islands",
						"UG" => "Uganda",
						"UA" => "Ukraine",
						"SU" => "Union of Soviet Socialist Republics",
						"AE" => "United Arab Emirates",
						"GB" => "United Kingdom",
						"US" => "United States",
						"ZZ" => "Unknown or Invalid Region",
						"UY" => "Uruguay",
						"UZ" => "Uzbekistan",
						"VU" => "Vanuatu",
						"VA" => "Vatican City",
						"VE" => "Venezuela",
						"VN" => "Vietnam",
						"WK" => "Wake Island",
						"WF" => "Wallis and Futuna",
						"EH" => "Western Sahara",
						"YE" => "Yemen",
						"ZM" => "Zambia",
						"ZW" => "Zimbabwe",
						"AX" => "Åland Islands",
						);

    	  return $country_array;
    }


   
    public static function find_countries($id){
    	   $country_array = array(
						"Afghanistan"   => "AF",
						"Albania"   => "AL",
						"Algeria"   => "DZ",
						"American Samoa"   => "AS",
						"Andorra"   => "AD",
						"Angola"   => "AO",
						"Anguilla"   => "AI",
						"Antarctica"   => "AQ",
						"Antigua and Barbuda"   => "AG",
						"Argentina"   => "AR",
						"Armenia"   => "AM",
						"Aruba"   => "AW",
						"Australia"   => "AU",
						"Austria"   => "AT",
						"Azerbaijan"   => "AZ",
						"Bahamas"   => "BS",
						"Bahrain"   => "BH",
						"Bangladesh"   => "BD",
						"Barbados"   => "BB",
						"Belarus"   => "BY",
						"Belgium"   => "BE",
						"Belize"   => "BZ",
						"Benin"   => "BJ",
						"Bermuda"   => "BM",
						"Bhutan"   => "BT",
						"Bolivia"   => "BO",
						"Bosnia and Herzegovina"   => "BA",
						"Botswana"   => "BW",
						"Bouvet Island"   => "BV",
						"Brazil"   => "BR",
						"British Antarctic Territory"   => "BQ",
						"British Indian Ocean Territory"   => "IO",
						"British Virgin Islands"   => "VG",
						"Brunei"   => "BN",
						"Bulgaria"   => "BG",
						"Burkina Faso"   => "BF",
						"Burundi"   => "BI",
						"Cambodia"   => "KH",
						"Cameroon"   => "CM",
						"Canada"   => "CA",
						"Canton and Enderbury Islands"   => "CT",
						"Cape Verde"   => "CV",
						"Cayman Islands"   => "KY",
						"Central African Republic"   => "CF",
						"Chad"   => "TD",
						"Chile"   => "CL",
						"China"   => "CN",
						"Christmas Island"   => "CX",
						"Cocos [Keeling] Islands"   => "CC",
						"Colombia"   => "CO",
						"Comoros"   => "KM",
						"Congo - Brazzaville"   => "CG",
						"Congo - Kinshasa"   => "CD",
						"Cook Islands"   => "CK",
						"Costa Rica"   => "CR",
						"Croatia"   => "HR",
						"Cuba"   => "CU",
						"Cyprus"   => "CY",
						"Czech Republic"   => "CZ",
						"Côte d’Ivoire"   => "CI",
						"Denmark"   => "DK",
						"Djibouti"   => "DJ",
						"Dominica"   => "DM",
						"Dominican Republic"   => "DO",
						"Dronning Maud Land"   => "NQ",
						"East Germany"   => "DD",
						"Ecuador"   => "EC",
						"Egypt"   => "EG",
						"El Salvador"   => "SV",
						"Equatorial Guinea"   => "GQ",
						"Eritrea"   => "ER",
						"Estonia"   => "EE",
						"Ethiopia"   => "ET",
						"Falkland Islands"   => "FK",
						"Faroe Islands"   => "FO",
						"Fiji"   => "FJ",
						"Finland"   => "FI",
						"France"   => "FR",
						"French Guiana"   => "GF",
						"French Polynesia"   => "PF",
						"French Southern Territories"   => "TF",
						"French Southern and Antarctic Territories"   => "FQ",
						"Gabon"   => "GA",
						"Gambia"   => "GM",
						"Georgia"   => "GE",
						"Germany"   => "DE",
						"Ghana"   => "GH",
						"Gibraltar"   => "GI",
						"Greece"   => "GR",
						"Greenland"   => "GL",
						"Grenada"   => "GD",
						"Guadeloupe"   => "GP",
						"Guam"   => "GU",
						"Guatemala"   => "GT",
						"Guernsey"   => "GG",
						"Guinea"   => "GN",
						"Guinea-Bissau"   => "GW",
						"Guyana"   => "GY",
						"Haiti"   => "HT",
						"Heard Island and McDonald Islands"   => "HM",
						"Honduras"   => "HN",
						"Hong Kong SAR China"   => "HK",
						"Hungary"   => "HU",
						"Iceland"   => "IS",
						"India"   => "IN",
						"Indonesia"   => "ID",
						"Iran"   => "IR",
						"Iraq"   => "IQ",
						"Ireland"   => "IE",
						"Isle of Man"   => "IM",
						"Israel"   => "IL",
						"Italy"   => "IT",
						"Jamaica"   => "JM",
						"Japan"   => "JP",
						"Jersey"   => "JE",
						"Johnston Island"   => "JT",
						"Jordan"   => "JO",
						"Kazakhstan"   => "KZ",
						"Kenya"   => "KE",
						"Kiribati"   => "KI",
						"Kuwait"   => "KW",
						"Kyrgyzstan"   => "KG",
						"Laos"   => "LA",
						"Latvia"   => "LV",
						"Lebanon"   => "LB",
						"Lesotho"   => "LS",
						"Liberia"   => "LR",
						"Libya"   => "LY",
						"Liechtenstein"   => "LI",
						"Lithuania"   => "LT",
						"Luxembourg"   => "LU",
						"Macau SAR China"   => "MO",
						"Macedonia"   => "MK",
						"Madagascar"   => "MG",
						"Malawi"   => "MW",
						"Malaysia"   => "MY",
						"Maldives"   => "MV",
						"Mali"   => "ML",
						"Malta"   => "MT",
						"Marshall Islands"   => "MH",
						"Martinique"   => "MQ",
						"Mauritania"   => "MR",
						"Mauritius"   => "MU",
						"Mayotte"   => "YT",
						"Metropolitan France"   => "FX",
						"Mexico"   => "MX",
						"Micronesia"   => "FM",
						"Midway Islands"   => "MI",
						"Moldova"   => "MD",
						"Monaco"   => "MC",
						"Mongolia"   => "MN",
						"Montenegro"   => "ME",
						"Montserrat"   => "MS",
						"Morocco"   => "MA",
						"Mozambique"   => "MZ",
						"Myanmar [Burma]"   => "MM",
						"Namibia"   => "NA",
						"Nauru"   => "NR",
						"Nepal"   => "NP",
						"Netherlands"   => "NL",
						"Netherlands Antilles"   => "AN",
						"Neutral Zone"   => "NT",
						"New Caledonia"   => "NC",
						"New Zealand"   => "NZ",
						"Nicaragua"   => "NI",
						"Niger"   => "NE",
						"Nigeria"   => "NG",
						"Niue"   => "NU",
						"Norfolk Island"   => "NF",
						"North Korea"   => "KP",
						"North Vietnam"   => "VD",
						"Northern Mariana Islands"   => "MP",
						"Norway"   => "NO",
						"Oman"   => "OM",
						"Pacific Islands Trust Territory"   => "PC",
						"Pakistan"   => "PK",
						"Palau"   => "PW",
						"Palestinian Territories"   => "PS",
						"Panama"   => "PA",
						"Panama Canal Zone"   => "PZ",
						"Papua New Guinea"   => "PG",
						"Paraguay"   => "PY",
						"People's Democratic Republic of Yemen"   => "YD",
						"Peru"   => "PE",
						"Philippines"   => "PH",
						"Pitcairn Islands"   => "PN",
						"Poland"   => "PL",
						"Portugal"   => "PT",
						"Puerto Rico"   => "PR",
						"Qatar"   => "QA",
						"Romania"   => "RO",
						"Russia"   => "RU",
						"Rwanda"   => "RW",
						"Réunion"   => "RE",
						"Saint Barthélemy"   => "BL",
						"Saint Helena"   => "SH",
						"Saint Kitts and Nevis"   => "KN",
						"Saint Lucia"   => "LC",
						"Saint Martin"   => "MF",
						"Saint Pierre and Miquelon"   => "PM",
						"Saint Vincent and the Grenadines"   => "VC",
						"Samoa"   => "WS",
						"San Marino"   => "SM",
						"Saudi Arabia"   => "SA",
						"Senegal"   => "SN",
						"Serbia"   => "RS",
						"Serbia and Montenegro"   => "CS",
						"Seychelles"   => "SC",
						"Sierra Leone"   => "SL",
						"Singapore"   => "SG",
						"Slovakia"   => "SK",
						"Slovenia"   => "SI",
						"Solomon Islands"   => "SB",
						"Somalia"   => "SO",
						"South Africa"   => "ZA",
						"South Georgia and the South Sandwich Islands"   => "GS",
						"South Korea"   => "KR",
						"Spain"   => "ES",
						"Sri Lanka"   => "LK",
						"Sudan"   => "SD",
						"Suriname"   => "SR",
						"Svalbard and Jan Mayen"   => "SJ",
						"Swaziland"   => "SZ",
						"Sweden"   => "SE",
						"Switzerland"   => "CH",
						"Syria"   => "SY",
						"São Tomé and Príncipe"   => "ST",
						"Taiwan"   => "TW",
						"Tajikistan"   => "TJ",
						"Tanzania"   => "TZ",
						"Thailand"   => "TH",
						"Timor-Leste"   => "TL",
						"Togo"   => "TG",
						"Tokelau"   => "TK",
						"Tonga"   => "TO",
						"Trinidad and Tobago"   => "TT",
						"Tunisia"   => "TN",
						"Turkey"   => "TR",
						"Turkmenistan"   => "TM",
						"Turks and Caicos Islands"   => "TC",
						"Tuvalu"   => "TV",
						"U.S. Minor Outlying Islands"   => "UM",
						"U.S. Miscellaneous Pacific Islands"   => "PU",
						"U.S. Virgin Islands"   => "VI",
						"Uganda"   => "UG",
						"Ukraine"   => "UA",
						"Union of Soviet Socialist Republics"   => "SU",
						"United Arab Emirates"   => "AE",
						"United Kingdom"   => "GB",
						"United States"   => "US",
						"Unknown or Invalid Region"   => "ZZ",
						"Uruguay"   => "UY",
						"Uzbekistan"   => "UZ",
						"Vanuatu"   => "VU",
						"Vatican City"   => "VA",
						"Venezuela"   => "VE",
						"Vietnam"   => "VN",
						"Wake Island"   => "WK",
						"Wallis and Futuna"   => "WF",
						"Western Sahara"   => "EH",
						"Yemen"   => "YE",
						"Zambia"   => "ZM",
						"Zimbabwe"   => "ZW",
						"Åland Islands"   => "AX",
						);

   
		 return array_search(strtoupper($id),$country_array);
    }

}
