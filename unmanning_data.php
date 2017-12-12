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

print_header("UASPSE Meetups");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$webinar_info['webinars'] = array();

$webinar = array(
    'title' => 'Unmanning Data Mondays Kickoff Webinar',
    'location' => 'AE2S Boardroom<br>College of Engineering and Mines<br>University of North Dakota',
    'date' => 'January 22, 2017',
    'time' => '1:00-2:00pm CST'
);

$webinar['sessions'][] = array(
    'presenter' => 'Travis Desell, Ph.D.',
    'position' => 'Associate Professor of Computer Science',
    'title' => 'Developing an Open UAS Repository',
    'description' => 'In conjunction with feedback from participants in the NSF BDSPOKES Unmanned Aerial Systems, Plant Sciences and Education, Dr. Desell has been developing an web based repository for securely and quickly viewing large scale imagery gathered from unmanned aerial systems. The system also allows for the easy markup of imagery and sharing mosaics with your team. Feedback on the system is welcome so that it can become a valuable tool for the digital agriculture community.'
);

$webinar['sessions'][] = array(
    'presenter' => 'Prakash Ranganathan, Ph.D.',
    'position' => 'Assistant Professor of Computer Science',
    'title' => 'Data Driven Autonomous Systems and Controls',
    'description' => 'In this presentation, Dr. Ranganathan will discuss challenges on the nexus of control, data, and processes for next-generation autonomous systems. The talk will focus on emerging areas such as UAS swarm technologies, and UAS cyber-security challenges. Dr. Ranganathan will share his recent project results on heat-loss quantification from thermal imagery data sets obtained from UAS. If time permits, Dr. Ranganathan will discuss the role of data-driven technologies in smart grid applications.',
    'last' => 1
);

$webinar_info['webinars'][] = $webinar;

$webinars_template = file_get_contents($cwd[__FILE__] . "/templates/unmanning_data_template.html");
$m = new Mustache_Engine;
echo $m->render($webinars_template, $webinar_info);


require_once("footer.php");

?>
