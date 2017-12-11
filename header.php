<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

function print_header($title, $additional_js = "", $additional_css = "") {
    global $cwd;

    $header_info['page_title'] = $title;
    $header_info['js' ] = $additional_js;
    $header_info['css'] = $additional_css;

    $header_template = file_get_contents($cwd[__FILE__] . "/templates/header.html");
    $m = new Mustache_Engine;
    echo $m->render($header_template, $header_info);
}

?>
