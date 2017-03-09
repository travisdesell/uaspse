<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once $cwd[__FILE__] . '/../../mustache.php/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

function print_footer() {
    global $cwd;

    $year = date("Y");

    $footer_template = file_get_contents($cwd[__FILE__] . "/templates/footer_template.html");
    $footer_info = array();

    $m = new Mustache_Engine;
    echo $m->render($footer_template, $footer_info);
}

?>
