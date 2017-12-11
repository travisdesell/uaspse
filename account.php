<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once("/var/www/html/mustache.php/src/Mustache/Autoloader.php");
Mustache_Autoloader::register();

require_once($cwd[__FILE__] . "/header.php");
require_once($cwd[__FILE__] . "/navbar.php");
require_once($cwd[__FILE__] . "/jumbotron.php");
require_once($cwd[__FILE__] . "/login.php");
require_once($cwd[__FILE__] . "/main.php");

//check the session
if (session_status() == PHP_SESSION_NONE) session_start();
$_SESSION["LASTPAGE"] = $_SERVER['PHP_SELF'];
require("authorized.php");

$isAuthorized = checkAuthorized();

print_header("UASPSE Account Information");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

function code_to_country( $code ){

	$code = strtoupper($code);

	$countryList = array(
		'AF' => 'Afghanistan',
		'AX' => 'Aland Islands',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua and Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas the',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BA' => 'Bosnia and Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island (Bouvetoya)',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory (Chagos Archipelago)',
		'VG' => 'British Virgin Islands',
		'BN' => 'Brunei Darussalam',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros the',
		'CD' => 'Congo',
		'CG' => 'Congo the',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'CI' => 'Cote d\'Ivoire',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FO' => 'Faroe Islands',
		'FK' => 'Falkland Islands (Malvinas)',
		'FJ' => 'Fiji the Fiji Islands',
		'FI' => 'Finland',
		'FR' => 'France, French Republic',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia the',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island and McDonald Islands',
		'VA' => 'Holy See (Vatican City State)',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IM' => 'Isle of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KP' => 'Korea',
		'KR' => 'Korea',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyz Republic',
		'LA' => 'Lao',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libyan Arab Jamahiriya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'AN' => 'Netherlands Antilles',
		'NL' => 'Netherlands the',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PS' => 'Palestinian Territory',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn Islands',
		'PL' => 'Poland',
		'PT' => 'Portugal, Portuguese Republic',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russian Federation',
		'RW' => 'Rwanda',
		'BL' => 'Saint Barthelemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint Lucia',
		'MF' => 'Saint Martin',
		'PM' => 'Saint Pierre and Miquelon',
		'VC' => 'Saint Vincent and the Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome and Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia (Slovak Republic)',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia, Somali Republic',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia and the South Sandwich Islands',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard & Jan Mayen Islands',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland, Swiss Confederation',
		'SY' => 'Syrian Arab Republic',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States of America',
		'UM' => 'United States Minor Outlying Islands',
		'VI' => 'United States Virgin Islands',
		'UY' => 'Uruguay, Eastern Republic of',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VE' => 'Venezuela',
		'VN' => 'Vietnam',
		'WF' => 'Wallis and Futuna',
		'EH' => 'Western Sahara',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe'
	);

	if( !$countryList[$code] ) return $code;
	else return $countryList[$code];
}

$account_info = array();
if ($isAuthorized) {

    //error_log(print_r($_SESSION["USERDATA"], true));
    //error_log($_SESSION["USERDATA"]);

    $userdata = json_decode($_SESSION["USERDATA"]);
    //error_log(print_r($userdata, true));
    $id = $userdata->id;

    $dbase = opendb();
    if ($dbase) {
        $cmd = "SELECT * FROM profiles WHERE id = '" . $id . "'";

        if ($result = $dbase->query($cmd)) {
            $row  = $result->fetch_assoc();

            $account_info = $row;
            //error_log(print_r($account_info, true));
            $account_info['logged_in'] = true;
            if ($account_info['allowEmail'] == 1) {
                $account_info['allow_emails'] = 1;
            } else {
                $account_info['deny_emails'] = 1;
            }

            if ($account_info['keywords'] != NULL) {
                $account_info['has_keywords'] = 1;
                //$account_info['keywords'] = "Big Data; Machine Learning; Computer Vision";
            } else {
                $account_info['keywords'] = "";
            }

            $account_info['profile'] = unserialize($row['profile']);
            $country_code = $account_info['profile']->location->country->code;
            $account_info['profile']->location->country = code_to_country($country_code);
            //$account_info['all'] = "<pre>" . print_r(unserialize($row['profile']), true) . "</pre>";
        } else {
        }
        $dbase->close();
    }

}

$account_template = file_get_contents($cwd[__FILE__] . "/templates/account_template.html");
$m = new Mustache_Engine;
echo $m->render($account_template, $account_info);


require_once("footer.php");
?>
