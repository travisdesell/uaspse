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

print_header("UPSiE Meetups");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$meetup_info = array();
$meetup_info['meetups'][] = array(
    'link' => "https://www.meetup.com/ND-RR-Valley-North-UAS-Digital-Precision-Ag-Big-Data",
    'title' => "ND RR Valley (North) : UAS Digital/Precision Ag & Big Data",
    'location' => "Grand Forks, ND",
    'img' => 'img/grand_forks_nd.png'
);


$meetup_info['meetups'][] = array(
    'link' => "https://www.meetup.com/ND-RRValley-UAS-Precision-Agriculture",
    'title' => "ND RR Valley (South) : UAS Digital/Precision Ag & Big Data",
    'location' => "Fargo, ND",
    'img' => 'img/fargo_nd.png'
);

$meetup_info['meetups'][] = array(
    'link' => "https://www.meetup.com/Data-Science-and-Big-Data-South-Dakota",
    'title' => "Data Science and Big Data - South Dakota",
    'location' => "Sioux Falls, SD",
    'img' => 'img/sioux_falls_sd.png'
);

$meetup_info['meetups'][] = array(
    'link' => "https://www.meetup.com/Nebraska-UAS-Precision-Agriculture-and-Big-Data-Meetup",
    'title' => "Nebraska - UAS Precision Agriculture and Big Data Meetup",
    'location' => "Lincoln, NE",
    'img' => 'img/lincoln_ne.png'
);

$meetup_info['meetups'][] = array(
    'link' => "https://www.meetup.com/UAS-Digital-and-Precision-Ag-and-Big-Data-Meetup",
    'title' => "Kansas UAS Digital/Precision Ag and Big Data Meetup",
    'location' => "Manhattan, KS",
    'img' => 'img/manhattan_ks.png'
);

$meetup_info['meetups'][] = array(
    'link' => "https://www.meetup.com/Rolla-Big-Data-Meetup",
    'title' => "Missouri UAS Digital/Precision Ag and Big Data Meetup",
    'location' => "Rolla, MO",
    'img' => 'img/rolla_mo.png'
);

$meetups_template = file_get_contents($cwd[__FILE__] . "/templates/meetups_template.html");
$m = new Mustache_Engine;
echo $m->render($meetups_template, $meetup_info);


require_once("footer.php");

?>
