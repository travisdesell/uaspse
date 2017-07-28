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
    'name' => 'Jennifer Clarke',
    'source' => './img/jennifer_clarke_small.jpeg',
    'bio' => ' Jennifer Clarke, Ph.D., Associate Professor of Food Science of Statistics and Food Science and Technology, Research Assistant Professor in Data Science at the University of Nebraska, B.A., Psychology, Skidmore College; B.A., Mathematics, Skidmore College; M.S., Statistics, Carnegie Mellon University, Ph. D., Statistics, The Pennsylvania State University. Dr. Clarke’s research interests encompass statistical methodology (with an emphasis on high dimensional and predictive methods), statistical computation, bioinformatics/computational biology, multi-type data analysis, data mining/machine learning, and bacterial genomics/metagenomics.',
    'homepage' => 'http://bigdata.unl.edu/about'
);

$people_info['people'][] = array(
    'name' => 'Joe Colletti',
    'source' => './img/joe_colletti_small.jpeg',
    'bio' => 'Joe\'s bio here.'
);

$people_info['people'][] = array(
    'name' => 'Travis Desell',
    'source' => './img/travis_desell.png',
    'bio' => 'Travis Desell, Ph.D., Computer Science, Rensselaer Polytechnic Institute. Dr. Desell is an assistant professor at the University of North Dakota.  He is a computational scientist specializing in machine learning, computer vision, high performance and distributed computing and is involved in a number of research projects involving the application of unmanned aerial systems and the analysis of data captured by them. He a Co-PI on the NSF BDSPOKES: Unmanned Aerial Systems, Plant Sciences and Education project.',
    'email' => 'tdesell@cs.und.edu',
    'homepage' => 'http://tdesell.cs.und.edu'
);


$people_info['people'][] = array(
    'name' => 'Greg Monaco',
    'source' => './img/greg_monaco_small.jpeg',
    'bio' => 'Greg\'s bio here.'
);



$m = new Mustache_Engine;
echo $m->render($people_template, $people_info);


print_footer();

echo "</body></html>";

?>
