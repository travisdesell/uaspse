<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once("/var/www/html/mustache.php/src/Mustache/Autoloader.php");
Mustache_Autoloader::register();

require_once($cwd[__FILE__] . "/header.php");
require_once($cwd[__FILE__] . "/navbar.php");
require_once($cwd[__FILE__] . "/jumbotron.php");
require_once($cwd[__FILE__] . "/login.php");
require_once($cwd[__FILE__] . "/main.php");

//check the session
if (session_status() == PHP_SESSION_NONE) session_start();
$_SESSION["LASTPAGE"] = $_SERVER['PHP_SELF'];
require("authorized.php");

$isAuthorized = checkAuthorized();

print_header("UASPSE Leadership");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$people_info['PIs'] = array();
$people_info['PIs'][] = array(
    'name' => 'Jennifer Clarke',
    'source' => 'img/jennifer_clarke_80.jpg',
    'degrees' => ' Jennifer Clarke, Ph.D., Associate Professor of Food Science and Technology, Research Assistant Professor in Data Science at the University of Nebraska, B.A., Psychology, Skidmore College; B.A., Mathematics, Skidmore College; M.S., Statistics, Carnegie Mellon University, Ph. D., Statistics, The Pennsylvania State University.',
    'bio' => 'Dr. Clarke’s research interests encompass statistical methodology (with an emphasis on high dimensional and predictive methods), statistical computation, bioinformatics/computational biology, multi-type data analysis, data mining/machine learning, and bacterial genomics/metagenomics.',
    'homepage' => 'http://bigdata.unl.edu/about',
    'email' => 'jclarke3@unl.edu',
    'headline' => 'Assoc. Professor of Food Science & Technology, Univ. of Nebraska - Lincoln'

);

$people_info['PIs'][] = array(
    'name' => 'Joe Colletti',
    'source' => 'img/joe_colletti_80.jpg',
    'bio' => 'Joe Colletti, Ph.D., is the senior associate dean for the College of Agriculture and Life Sciences at Iowa State University and, the associate director of the Iowa Agriculture and Home Economics Experiment Station. He has served in those positions since 2006. He oversees budgets, research and personnel for the college and Experiment Station. He also facilitates research planning and activities related to the bioeconomy and, in particular, development of Iowa State’s BioCentury Research Farm. His research areas focus on the economics of agroforestry, management of streamside buffer systems on farmland and biorenewable resources. He has taught undergraduate and graduate courses in forestry and natural resources economics, decision-making and management.',
    'homepage' => 'https://www.nrem.iastate.edu/people/joe-colletti',
    'email' => 'colletti@iastate.edu',
    'headline' => 'Sr. Assoc. Dean for the College of Agriculture & Life Sciences, Iowa State Univ.'
);

$people_info['PIs'][] = array(
    'name' => 'Travis Desell',
    'PI' => 1,
    'source' => 'img/travis_desell_80.jpg',
    'degrees' => 'Travis Desell, Ph.D., Computer Science, Rensselaer Polytechnic Institute.',
    'bio' => 'Dr. Desell is an associate professor at the University of North Dakota.  He is a computational scientist specializing in machine learning, computer vision, high performance and distributed computing and is involved in a number of research projects involving the application of unmanned aerial systems and the analysis of data captured by them. He is the PI on the NSF BDSPOKES: Unmanned Aerial Systems, Plant Sciences and Education project.',
    'email' => 'tdesell@cs.und.edu',
    'homepage' => 'http://tdesell.cs.und.edu',
    'headline' => 'Assoc. Professor of Computer Science, Univ. of North Dakota'
);

$people_info['PIs'][] = array(
    'name' => 'Greg Monaco',
    'source' => 'img/greg_monaco_80.jpg',
    'bio' => 'Greg Monaco, Ph.D., has held several positions with the <a href="https://www.greatplains.net/" target="_blank">Great Plains Network</a> since August, 2000, when he joined GPN. He began as Research Collaboration Coordinator, and then was promoted to Director for Research and Education, followed by Executive Director for several years. His passion is to assist to help enable a richer set of shared resources across the region and to help promote the exciting and leading edge activities of GPN member institutions. He appreciates the opportunity to work with the excellent scientists, researchers and educators in the Great Plains region..',
    'homepage' => 'http://confluence.greatplains.net/display/~gmonaco',
    'email' => 'gmonaco@ksu.edu',
    'headline' => 'Great Plains Network - Executive Director'
);

$people_info['PIs'][] = array(
    'name' => 'Grant McGimpsey',
    'source' => 'img/grant_mcgimpsey_80.jpg',
    'headline' => 'Vice President for Research & Economic Development at Univ. of North Dakota',
    'bio' => '',
    'email' => '',
    'homepage' => '',
    'last' => 1
);

for ($i = 0; $i < count($people_info['PIs']); $i++) {
    $people_info['PIs'][$i]['accordion_id'] = $i;
}



$people_info['board'] = array();

$people_info['board'][] = array(
    'name' => 'April Agee Carroll, Ph.D.',
    'source' => 'img/april_carroll_80.jpg',
    'homepage' => 'https://www.linkedin.com/in/aprilageecarroll/',
    'headline' => 'Vice President of Research & Development at AeroFarms'
);

$people_info['board'][] = array(
    'name' => 'Jason Cepela',
    'source' => 'img/jason_cepela_80.jpg',
    'homepage' => 'https://www.linkedin.com/in/jasoncepela/',
    'headline' => 'Crop Computational Biology Lead - Agro Discovery, PepsiCo R&D'
);

$people_info['board'][] = array(
    'name' => 'Jack Cothren, Ph.D.',
    'source' => 'img/jack_cothren_80.jpg',
    'homepage' => 'https://fulbright.uark.edu/departments/geosciences/directory/cothren.php',
    'headline' => 'Director of the Center for Advanced Spatial Technologies'
);

$people_info['board'][] = array(
    'name' => 'Lisa Harper, Ph.D.',
    'source' => 'img/lisa_harper_80.jpg',
    'homepage' => 'https://www.linkedin.com/in/lisa-harper-22260761/',
    'headline' => 'Director, AgBioData Consortium MaizeGDB, USDA-ARS PGEC'
);

$people_info['board'][] = array(
    'name' => 'Thomas Haun',
    'source' => 'img/thomas_haun_80.jpg',
    'homepage' => 'https://www.linkedin.com/in/thomashaun/',
    'headline' => 'Executive Vice President - PrecisionHawk'
);

$people_info['board'][] = array(
    'name' => 'Mark Moran, Ph.D.',
    'source' => 'img/mark_moran_80.jpg',
    'homepage' => 'https://www.linkedin.com/in/moranmarkd/',
    'headline' => 'Associate Director, John Deere Technology Innovation Center',
    'last' => 1
);

$leadership_template = file_get_contents($cwd[__FILE__] . "/templates/leadership_template.html");
$m = new Mustache_Engine;
echo $m->render($leadership_template, $people_info);


require_once("footer.php");
?>
