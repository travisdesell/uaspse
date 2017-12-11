<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

function print_jumbotron() {
    global $cwd;

    echo file_get_contents($cwd[__FILE__] . "/templates/jumbotron.html");
}

?>

