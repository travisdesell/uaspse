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

print_header("UPSiE Members");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

if ($isAuthorized) $members_info['logged_in'] = 1;



$dbase = opendb();
if ($dbase) {
    $current_number = 1;

    error_log("_GET: " . json_encode($_GET));

    if (isset($_GET['number'])) {
        $current_number = mysqli_real_escape_string($dbase, $_GET['number']);
        error_log("after escape string, current_number: " . $current_number);
        if (!ctype_digit($current_number)) {
            error_log("not integer!");
            $current_number = 1;
        }
    }

    $start_row = ($current_number - 1) * 10;
    $query = "SELECT * FROM profiles ORDER BY lastName LIMIT $start_row, 10";
    $result = $dbase->query($query);
    while (($row = $result->fetch_assoc()) != NULL) {
        $row['profile'] = unserialize($row['profile']);
        $country_code = $row['profile']->location->country->code;
        $row['profile']->location->country = code_to_country($country_code);

        if ($row['pictureUrl'] == NULL || $row['pictureUrl'] == '') unset($row['pictureUrl']);
        if ($row['keywords'] == NULL || $row['keywords'] == '') unset($row['keywords']);

        $members_info['members'][] = $row;
    }

    $members_info['prev_number'] = $current_number - 1;
    $members_info['next_number'] = $current_number + 1;

    $query = "SELECT count(*) FROM profiles";
    $result = $dbase->query($query);
    $row = $result->fetch_assoc();
    $number_members = $row['count(*)'];

    error_log("number members: $number_members, div 10: ". ($number_members / 10));
    error_log("current number: $current_number, max number: " . ceil($number_members / 10));
    error_log("equal?" . ($current_number == ceil($number_members / 10)));

    if ($current_number == 1) {
        $members_info['previous_disabled'] = 'disabled';
    }
    if ($current_number == ceil($number_members / 10)) {
        $members_info['next_disabled'] = 'disabled';
    }

    $members_info['numbers'] = array();

    error_log("current number: $current_number");
    for ($i = 1; $i <= ($number_members / 10) + 1; $i++) {
        if ($i == $current_number) {
            $members_info['numbers'][] = array(
                'number' => $i,
                'current' => 1
            );
        } else {
            $members_info['numbers'][] = array(
                'number' => $i
            );
        }
    }
}




$members_template = file_get_contents($cwd[__FILE__] . "/templates/members_template.html");
$m = new Mustache_Engine;
echo $m->render($members_template, $members_info);

require_once("footer.php");
?>
