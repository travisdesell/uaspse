<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/header.php");
require_once($cwd[__FILE__] . "/navbar.php");
require_once($cwd[__FILE__] . "/footer.php");
//require_once($cwd[__FILE__] . "/my_query.php");

print_header("MBDH Spoke Project: UASPSE: Community");
print_navbar("community");

/*
$community_template = file_get_contents($cwd[__FILE__] . "/templates/community_template.html");

$m = new Mustache_Engine;
echo $m->render($community_template, $community_info);
 */


print_footer();

echo "</body></html>";

?>
