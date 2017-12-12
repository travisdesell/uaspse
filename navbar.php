<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

function print_navbar($isAuthorized) {
    global $cwd;

    $navbar_info = array();
    if ($isAuthorized) $navbar_info['logged_in'] = true;

	$purl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $purl = substr($purl, strrpos($purl, "/"));

    error_log($purl);

	if($purl == "/" || $purl == "/index.php") $navbar_info['home_active'] = "active";
	if($purl == "/leadership.php") $navbar_info['leadership_active'] = "active";
	if($purl == "/members.php") $navbar_info['members_active'] = "active";
	if($purl == "/meetups.php") $navbar_info['meetups_active'] = "active";
	if($purl == "/resources.php") $navbar_info['resources_active'] = "active";
	if($purl == "/social.php") $navbar_info['social_active'] = "active";
	if($purl == "/events.php") $navbar_info['events_active'] = "active";
	if($purl == "/webinars.php" || $purl == "/unmanning_data.php") $navbar_info['webinars_active'] = "active";
	if($purl == "/account.php") $navbar_info['account_active'] = "active";

    $navbar_template = file_get_contents($cwd[__FILE__] . "/templates/navbar.html");
    $m = new Mustache_Engine;
    echo $m->render($navbar_template, $navbar_info);
}

?>
