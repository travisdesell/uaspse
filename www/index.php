<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/header.php");
require_once($cwd[__FILE__] . "/navbar.php");
require_once($cwd[__FILE__] . "/footer.php");
//require_once($cwd[__FILE__] . "/my_query.php");

print_header("MBDH Spoke Project: Unmanned Aerial Systems, Plant Sciences and Education");
print_navbar("home");

$index_template = file_get_contents($cwd[__FILE__] . "/templates/index_template.html");

$index_info = array();

$m = new Mustache_Engine;
echo $m->render($index_template, $index_info);

print_footer();

echo "</body></html>";

?>
