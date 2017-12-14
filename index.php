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

print_header("UASPSE Home");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$news[] = array(
    'date' => "December 15, 2017",
    'title' => "Unmanning Data Mondays",
    'html' => "We are pleased to announce we will be hosting a new webinar series about handling data from unmanned aerial systems. Please visit the <a href='./unmanning_data.php'>Unmanning Data Mondays</a> webinar webpage for more information!"
);

$news[] = array(
    'date' => "December 15, 2017",
    'title' => "Updated Website",
    'html' => "The UASPSE website has been upgraded to bootstrap 4.0 and contains a lot more content! Please visit your <a href='./account.php'>Account Information</a> page to set your skills and research interests so we can better connect you with other hub members."
);

$news[] = array(
    'date' => "August 23, 2017",
    'title' => "MBDH All Hands Meeting",
    'html' => "Registration for the <a href='http://midwestbigdatahub.org/2017-all-hands-meeting/'>2017 MBDH All Hands Meeting - Data-Enabled Midwest Resilience</a> in Omaha, Nebraska is now available!</p>"
);

$news[] = array(
    'date' => "August 11, 2017",
    'html' => "New UASPSE Website online!"
);

$news[] = array(
    'date' => "July 24, 2017",
    'title' => "MBDH Digital Ag - All Hands Meeting",
    'html' => "Dates for the <a href='https://digital.ag.iastate.edu/uaspse-all-hands-meeting-sept-14-2017-ames-iowa' target='meeting'>UASPSE All-Hands Meeting</a>, Sept. 14-15, 2017 in Ames, Iowa have been set."
);

$news[] = array(
    'date' => 'July 1, 2017',
    'html' => 'Co-PI Clarke Visits Collaborators in Australia'
);

$news[] = array(
    'date' => "March 12, 2017",
    'html' => "PI Grant McGimpsey and Co-PI Joe Colletti are heading to the National Science Foundation for the Big Data Hub and Spokes meeting this coming Friday.",
    'last' => true
);

print_main($news);

require_once("footer.php");
?>
