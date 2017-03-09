<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/header.php");
require_once($cwd[__FILE__] . "/navbar.php");
require_once($cwd[__FILE__] . "/footer.php");
//require_once($cwd[__FILE__] . "/my_query.php");

print_header("MBDH Spoke Project: UASPSE: People");
print_navbar("people");

$people_template = file_get_contents($cwd[__FILE__] . "/templates/people_template.html");
$people_info = array();
$people_info['people'][] = array(
    'name' => 'Travis Desell',
    'source' => './img/travis_desell.png',
    'bio' => 'Some stuff about Travis.'
);

$people_info['people'][] = array(
    'name' => 'Greg Monaco',
    'source' => './img/greg_monaco_small.jpeg',
    'bio' => 'Some stuff about Greg.'
);


$m = new Mustache_Engine;
echo $m->render($people_template, $people_info);


print_footer();

echo "</body></html>";

?>
