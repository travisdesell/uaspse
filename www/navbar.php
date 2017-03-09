<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once $cwd[__FILE__] . '/../../mustache.php/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

function print_navbar($from_page) {
    global $cwd;

    $cwd[__FILE__] = __FILE__;
    if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
    $cwd[__FILE__] = dirname($cwd[__FILE__]);

    $navbar_template = file_get_contents($cwd[__FILE__] . "/templates/navbar_template.html");

    $navbar_info = array();
    $navbar_info['project_name'] = "UASPSE";

    if ($from_page == "home") {
        $navbar_info['home_active'] = true;
    } else if ($from_page == "people") {
        $navbar_info['people_active'] = true;
    } else if ($from_page == "community") {
        $navbar_info['community_active'] = true;
    } else if ($from_page == "resources") {
        $navbar_info['resources_active'] = true;
    }

    $m = new Mustache_Engine;
    echo $m->render($navbar_template, $navbar_info);
}

?>
