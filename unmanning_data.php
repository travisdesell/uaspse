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

print_header("UASPSE - UPSiE Unmanning Data Mondays");
print_navbar($isAuthorized);
print_jumbotron();
print_login_modal($isAuthorized);

$webinar_info['webinars'] = array();

$webinar = array(
    'title' => 'Unmanning Data Mondays Kickoff Webinar',
    'location' => 'AE2S Boardroom<br>College of Engineering and Mines<br>University of North Dakota',
    'date' => 'January 22, 2018',
    'time' => '1:00-2:00pm CST',
    'zoom_url' => 'https://und.zoom.us/j/994128817',
    'video_url' => './videos/2018-01-22-unmanning_data.mp4'
);

$slides = array();

$slides[] = array(
    'slide_url' => './slides/2018-01-22-desell.pdf',
    'slide_title' => 'UPSiE and an Open UAS Repository',
    'slide_author' => 'Travis Desell',
    'position' => 'Associate Professor of Computer Science'
);

$slides[] = array(
    'slide_url' => './slides/2018-01-22-ranganathan.pdf',
    'slide_title' => 'Data Driven Autonomous Systems and Controls',
    'slide_author' => 'Prakash Ranganathan', 
    'position' => 'Assistant Professor of Electrical Engineering'
);

$webinar['slides'] = $slides;
$webinar['has_slides'] = true;

$webinar['sessions'][] = array(
    'presenter' => array(
        array(
            'name' => 'Travis Desell, Ph.D.',
            'position' => 'Associate Professor of Computer Science',
            'institute' => 'University of North Dakota'
        ),
    ),
    'title' => 'Developing an Open UAS Repository',
    'description' => 'In conjunction with feedback from participants in the NSF BDSPOKES Unmanned Aerial Systems, Plant Sciences and Education, Dr. Desell has been developing an web based repository for securely and quickly viewing large scale imagery gathered from unmanned aerial systems. The system also allows for the easy markup of imagery and sharing mosaics with your team. Feedback on the system is welcome so that it can become a valuable tool for the digital agriculture community.'
);

$webinar['sessions'][] = array(
    'presenter' => array(
        array(
            'name' => 'Prakash Ranganathan, Ph.D.',
            'position' => 'Assistant Professor of Computer Science',
            'institute' => 'University of North Dakota'
        ),
    ),
    'title' => 'Data Driven Autonomous Systems and Controls',
    'description' => 'In this presentation, Dr. Ranganathan will discuss challenges on the nexus of control, data, and processes for next-generation autonomous systems. The talk will focus on emerging areas such as UAS swarm technologies, and UAS cyber-security challenges. Dr. Ranganathan will share his recent project results on heat-loss quantification from thermal imagery data sets obtained from UAS. If time permits, Dr. Ranganathan will discuss the role of data-driven technologies in smart grid applications.',
    'last' => 1
);

$webinar_info['webinars'][] = $webinar;




$webinar = array(
    'title' => 'What is Precision Agriculture in US Field Crop Production in 2018?',
    'date' => 'February 26, 2018',
    'time' => '1:00-2:00pm CST',
    'zoom_url' => 'https://zoom.us/j/873163966',
    'video_url' => './videos/2018-02-26-unmanning_data.mp4'
);

$webinar['sessions'][] = array(
    'presenter' => array(
        array(
            'name' => 'John Nowatski',
            'position' => 'Extension Ag Machine Systems Specialist',
            'institute' => 'North Dakota State University'
        )
    ),
    'title' => 'What is Precision Agriculture in US Field Crop Production in 2018?',
    'description' => '<p>This presentation will describe precision agriculture practices and technology currently available to crop producers, and how UAS applications fit into precision agriculture on crop farms in the Northern Plains. The presentation will include summaries of current NDSU UAS research, as well as plans for 2018 projects, including NDSU UAV activities, NDSU Smart Farms for 2018 and data management issues.</p>
'
);

$webinar_info['webinars'][] = $webinar;


$webinar = array(
    'title' => 'Unmanned Aerial System based High Throughput Phenotyping System Development',
    'date' => 'March 19, 2018',
    'time' => '1:00-2:00pm CST',
    'video_url' => './videos/2018-03-19-unmanning_data.mp4',
    'zoom_url' => 'https://und.zoom.us/j/386394457'
);

$webinar['sessions'][] = array(
    'presenter' => array(
        array(
            'name' => "<a href='http://sci.tamucc.edu/member.php?who=jjung1&program=encs'>Jinha Jung</a>",
            'position' => 'Assistant Professor of Engineering',
            'institute' => 'Texas A&M University'
        )
    ),
    'title' => 'Unmanned Aerial System based High Throughput Phenotyping System Development',
    'description' => '<p>The acquisition of temporal and spatial crop phenotypic data is critical in agriculture research, but it has been usually performed by strenuous, destructive, expensive, slow, and labor-intensive hand sampling techniques in the past. Such constraints often lead to under-representative crop information due to limited sampling area and the introduction of possible human errors. Although remote sensing technologies have been utilized in some precision agriculture studies, development of an UAS-based phenotyping system and full utilization of the system throughout the whole life-cycle of crops to monitor crop growth, overall health, and particularly yield has been very limited until now. This presentation will illustrate how Unmanned Aerial System (UAS) technologies can be used to develop high throughput phenotyping system and it can help agriculture research scientists utilize advanced tools and methodologies for their research applications. Incorporation of the UAS technologies into their research programs will allow them to significantly increase efficiency. Data gathered using from the UAS will also provide agriculture research scientists a high level of detail (both spatial and temporal) never before possible using manual sampling procedures.</p>
'
);

$webinar_info['webinars'][] = $webinar;





$webinar = array(
    'title' => 'Opportunities, Challenges, and Progress in Managing the sUAS/RPAS Data',
    'date' => 'April 16, 2018',
    'time' => '1:00-2:00pm CST',
    'video_url' => './videos/2018-04-16-unmanning_data.mp4',
    'zoom_url' => 'https://und.zoom.us/j/489829637'
);

$webinar['sessions'][] = array(
    'presenter' => array(
        array(
            'name' => 'Jane Wyngaard, Ph.D',
            'position' => 'Data Scientist',
            'institute' => 'University of Notre Dame'
        ),
        array(
            'name' => 'Andrea Thomer, Ph.D.',
            'position' => 'Assistant Professor of Information',
            'institute' => 'University of Michigan'
        ),
        array(
            'name' => 'Lindsay Barbieri, Ph.D.',
            'position' => 'Gund Graduate Fellow',
            'institute' => 'University of Vermont'
        )
    ),
    'title' => 'Opportunities, Challenges, and Progress in Managing the sUAS/RPAS Data',
    'description' => '<p>Small Unmanned Aircraft Systems (sUAS) (aka “drones”, or RPAS) are rapidly changing how a broad range of researchers in many domains collect data. However, in order for these data to be fully utilised they must be made FAIR (Findable Accessible Interoperable Reusable), and doing so requires addressing multiple challenges as a joint community.  Much can be borrowed and learnt from analogous domains (satellites, sensor networks, underwater gliders, manned aircraft) and various groups around the world are addressing various components of the challenge.  Within the Research Data Alliance sUAS data Interest Group we are working to draw these groups into common conversations.</p>
    
    <p>Additionally, as an initial practical step - under a ESIP Laboratories award - we are working to address the need to augment the data with machine-readable, semantically-rich metadata, and to annotate them in ways that make their provenance (the record of the processes that created the data) explicit. In sUAS-based research this is particularly challenging given the many agents (e.g. people, sUAS, sensors, controllers, computers, software systems), and complex processes (e.g. pre- and post- correction processing, data integration) that work together but within often inexplicit relationships. We will discuss our progress on this effort so far as well as highlighting some of the  other groups globally working on components of the broader challenges.</p>
'
);
$slides = array();

$slides[] = array(
    'slide_url' => './slides/2018-04-16-unmanning_data.pdf',
    'slide_title' => 'Opportunities, Challenges, and Progress in Managing the sUAS/RPAS Data',
    'slide_author' => ''
);

$webinar['slides'] = $slides;
$webinar['has_slides'] = true;

$webinar_info['webinars'][] = $webinar;


$webinar = array(
    'title' => 'Opportunities, Challenges, and Progress in Managing the sUAS/RPAS Data',
    'date' => 'May 21, 2018',
    'time' => '1:00-2:00pm CST',
    'video_url' => './videos/2018-05-21-unmannning_data.mp4',
    'zoom_url' => 'https://zoom.us/webinar/register/WN_Gel89FG6TBO7FMPgaIuhlw'
);

$webinar['sessions'][] = array(
    'presenter' => array(
        array(
            'name' => 'Jianming Yu, Ph.D',
            'position' => 'Professor and Pioneer Distinguished Chair in Maize Breeding',
            'institute' => 'Department of Agronomy, Iowa State University'
        ),
        array(
            'name' => 'Kevin P. Price, Ph.D',
            'position' => 'Executive Vice President - Research and Technology Development, AgPixel, LLC; Professor Emertus, Department of Agronomy, Kansas State University; and Collaborator, Department of Agronomy',
            'institute' => 'Iowa State University'
        )
    ),
    'title' => 'Acquiring Ultra-High-Resolution Imagery using Unmanned Aerial Systems (Drones) and its Applications in High-Throughput Phenotyping',
    'description' => '<p>In this webinar, Dr. Price and Dr. Yu will provide a brief description of unmanned aerial systems technologies, examples of the imagery that can be collected, and applications in crop breeding, particularly applications in high-throughput and how they might be used in crop genetics and breeding.</p>'
);

/*
$slides = array();

$slides[] = array(
    'slide_url' => './slides/2018-04-16-unmanning_data.pdf',
    'slide_title' => 'Opportunities, Challenges, and Progress in Managing the sUAS/RPAS Data',
    'slide_author' => ''
);

$webinar['slides'] = $slides;
$webinar['has_slides'] = true;
*/

$webinar_info['webinars'][] = $webinar;


$webinars_template = file_get_contents($cwd[__FILE__] . "/templates/unmanning_data_template.html");
$m = new Mustache_Engine;
echo $m->render($webinars_template, $webinar_info);


require_once("footer.php");

?>
