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

print_header("UPSiE Home");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$news[] = array(
    'date' => "May 18, 2018",
    'title' => 'Save the date for the 2018 UPSiE All Hands Meeting',
    'html' => 'The 2018 Digital Agriculture: Unmanned Aerial Systems, Plant Sciences and Education All Hands meeting will be held at the University of Nebraska-Lincoln on September 20th and 21st. Please mark your calendars!<br><b>Please note that the dates were previously noted as September 6th and 7th but have been updated to September 20th and 21st.</b>'
);


$news[] = array(
    'date' => "March 1, 2018",
    'title' => "Announcing the 2018 UPSiE UAS Data Workshop",
    'html' => "We are pleased to announce a date and initial agenda for the 2018 UPSiE UAS Data Workshop which will be hosted this year by the University of North Dakota. The workshop will be held on April 18th at the University of North Dakota Tech Accelerator. More details and registration can be found <a href='./workshop.php'>here</a>. A poster session will be held and we are providing up to $1,000 in travel funding to those who wish present a poster at the workshop for up to 30 individuals.  Preference will be given to early registrations. Stay posted as we line up speakers!"
);


$news[] = array(
    'date' => "February 10, 2018",
    'title' => "Unmanning Data Mondays Date Update",
    'html' => "We apologize for a wrong date. John Nowatzki's talk will be on Monday, February 26th (not February 22nd).  We apologize for any inconvenience!"
);


$news[] = array(
    'date' => "February 2, 2018",
    'title' => "New Speakers for Unmanning Data Mondays",
    'html' => "We are pleased to announce two new sesions for the <a href='./unmanning_data.php'>Unmanning Data Mondays</a> webinar seres! John Nowatzki of North Dakota State University will be presenting on 'What is Precision Agriculture in US Field Crop Production in 2018?' on February 26, 1-2pm CST and Jane Wyngaard (University of Notre Dame), Andrea Thomer (University of Michigan) and Lindsay Barbieri (University of Vermont) will presenting on 'Opportunities, Challenges, and Progress in Managing the sUAS/RPAS Data' on April 16th, 1-2pm CST. Please visit the <a href='./unmanning_data.php'>Unmanning Data Mondays</a> webpage for more information."
);

$news[] = array(
    'date' => "December 15, 2017",
    'title' => "Unmanning Data Mondays",
    'html' => "We are pleased to announce we will be hosting a new webinar series about handling data from unmanned aerial systems. Please visit the <a href='./unmanning_data.php'>Unmanning Data Mondays</a> webinar webpage for more information!"
);

$news[] = array(
    'date' => "December 15, 2017",
    'title' => "Updated Website",
    'html' => "The UPSiE website has been upgraded to bootstrap 4.0 and contains a lot more content! Please visit your <a href='./account.php'>Account Information</a> page to set your skills and research interests so we can better connect you with other hub members."
);

$news[] = array(
    'date' => "August 23, 2017",
    'title' => "MBDH All Hands Meeting",
    'html' => "Registration for the <a href='http://midwestbigdatahub.org/2017-all-hands-meeting/'>2017 MBDH All Hands Meeting - Data-Enabled Midwest Resilience</a> in Omaha, Nebraska is now available!</p>"
);

$news[] = array(
    'date' => "August 11, 2017",
    'html' => "New UPSiE Website online!"
);

$news[] = array(
    'date' => "July 24, 2017",
    'title' => "MBDH Digital Ag - All Hands Meeting",
    'html' => "Dates for the <a href='https://digital.ag.iastate.edu/uaspse-all-hands-meeting-sept-14-2017-ames-iowa' target='meeting'>UPSiE All-Hands Meeting</a>, Sept. 14-15, 2017 in Ames, Iowa have been set."
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
