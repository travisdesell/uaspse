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
$webinar_info['webinars'][] = array(
    'title' => 'Unmanning Data Mondays',
    'blurb' => '<p>UASPSE and the University of North Dakota are hosting a rotating series of webinars called <b>Unmanning Data Mondays: Getting the human out of unmanned aerial systems data.</b> The webinars are hosted in person from institutions involved with UASPSE and the Midwest Data Hub, and will be streamed online.</p><a href="./unmanning_data.php">Unmanning Data Mondays Webinars</a></p>'
);

$webinar_info['webinars'][] = array(
    'title' => 'Plant Phenomics Phridays',
    'blurb' => '<p>In collaboration with UASPSE, Iowa State University is hosting a seminar series on Plant Phenomics.</p><a href="https://digital.ag.iastate.edu/isu-plant-phenomics-phridays-seminar-series" target="edu_resources">Iowa State University Seminar Series on Plant Phenomics</a></p>'
);

$webinar_info['webinars'][] = array(
    'title' => 'Big Data Zoom Webinars',
    'blurb' => '<p>In collaboration with UASPSE, Zoom webinars involving Big Data are being hosted through Kansas State University, the University of Nebraska-Lincoln, and the Great Plains Network.</p><a href="http://greatplains.wpengine.com/archives/presentations/" target="edu_resources">Great Plains Network - Big Data Zoom Webinars</a></p>'
);


$webinars_template = file_get_contents($cwd[__FILE__] . "/templates/webinars_template.html");
$m = new Mustache_Engine;
echo $m->render($webinars_template, $webinar_info);


require_once("footer.php");

?>
