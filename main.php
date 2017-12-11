<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

function print_main($news) {
    global $cwd;

    $main_info = array();
    $main_info['news'] = $news;

    $main_template = file_get_contents($cwd[__FILE__] . "/templates/main.html");
    $m = new Mustache_Engine;
    echo $m->render($main_template, $main_info);
}

?>
