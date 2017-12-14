<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

function print_jumbotron() {
    global $cwd, $isAuthorized;


    $userdata = json_decode($_SESSION["USERDATA"]);
    $id = $userdata->id;

    $has_keywords = true;

    if ($isAuthorized) {
        $dbase = opendb();
        if ($dbase) {
            $query = "SELECT keywords FROM profiles WHERE id = '$id'";
            $result = $dbase->query($query);
            $row = $result->fetch_assoc();

            error_log("keywords row: " . json_encode($row));
            $keywords = $row['keywords'];

            error_log("keywords: '$keywords'");

            if ($keywords == NULL || $keywords == '') {
                $has_keywords = false;
            }
            $dbase->close();
        }
    }

     $purl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
     $purl = substr($purl, strrpos($purl, "/"));
     error_log($purl);

     //don't print the alert if we're already on the account page
    if($purl == "/account.php") $has_keywords = true;


    $jumbotron_info = array();
    if ($has_keywords) $jumbotron_info['has_keywords'] = 1;

    $jumbotron_template = file_get_contents($cwd[__FILE__] . "/templates/jumbotron.html");
    $m = new Mustache_Engine;
    echo $m->render($jumbotron_template, $jumbotron_info);
}

?>

