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

print_header("UASPSE Events");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$show_prior = false;
if (isset($_GET['past'])) {
    $show_prior = true;
}

$events_info = array();

function convert_date($str) {
    $original = $str;
    $year = $str[0] . $str[1] . $str[2] . $str[3];
    $month= $str[5] . $str[6];
    $day = $str[8] . $str[9];
    $str = "$day.$month.$year";

    error_log("converted '$original' to '$str'");
    return $str;
}

$dbase = opendb();
if ($dbase) {
    if ($show_prior) {
        $query = "SELECT * FROM events WHERE start < CURDATE()";
    } else {
        $query = "SELECT * FROM events WHERE start >= CURDATE()";
    }
    $result = $dbase->query($query);

    $i = 0;
    while( ($row = $result->fetch_assoc()) != NULL ) {
        if ($i == 0) {
            $row['first'] = 1;
        }
        $row['number'] = $i;

        if ($row['start'] == $row['stop'] || is_null($row['stop']) ) {
            unset($row['stop']);
            $row['start'] = convert_date($row['start']);
            $row['start'] = date('F jS Y', strtotime($row['start']));
        } else {
            $row['start'] = convert_date($row['start']);
            $row['stop'] = convert_date($row['stop']);

            $row['start'] = date('F jS Y', strtotime($row['start']));
            $row['stop'] = date('F jS Y', strtotime($row['start']));
        }


        $events_info['events'][] = $row;

        $i++;
    }
}


$events_template = file_get_contents($cwd[__FILE__] . "/templates/events_template.html");
$m = new Mustache_Engine;
echo $m->render($events_template, $events_info);

require_once("footer.php");
?>
