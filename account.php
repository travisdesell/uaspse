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
require_once($cwd[__FILE__] . "/code_to_country.php");

//check the session
if (session_status() == PHP_SESSION_NONE) session_start();
$_SESSION["LASTPAGE"] = $_SERVER['PHP_SELF'];
require("authorized.php");

$isAuthorized = checkAuthorized();

print_header("UPSiE Account Information");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

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
