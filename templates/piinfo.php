<?php
	function getPiInfo()
	{
		//This is a stub for a function that will call the mysql database, and pull this data from the database in the future.
		$people_info = array();
		$people_info[0] = array(
			'name' => 'Jennifer Clarke',
			'source' => 'img/jennifer_clarke_small.jpeg',
			'bio' => ' Jennifer Clarke, Ph.D., Associate Professor of Food Science of Statistics and Food Science and Technology, Research Assistant Professor in Data Science at the University of Nebraska, B.A., Psychology, Skidmore College; B.A., Mathematics, Skidmore College; M.S., Statistics, Carnegie Mellon University, Ph. D., Statistics, The Pennsylvania State University. Dr. Clarke’s research interests encompass statistical methodology (with an emphasis on high dimensional and predictive methods), statistical computation, bioinformatics/computational biology, multi-type data analysis, data mining/machine learning, and bacterial genomics/metagenomics.',
            'homepage' => 'http://bigdata.unl.edu/about',
            'email' => 'jclarke3@unl.edu'

		);

		$people_info[1] = array(
			'name' => 'Joe Colletti',
			'source' => 'img/joe_colletti_small.jpeg',
			'bio' => 'Joe Colletti, Ph.D., is the senior associate dean for the College of Agriculture and Life Sciences at Iowa State University and, the associate director of the Iowa Agriculture and Home Economics Experiment Station. He has served in those positions since 2006. He oversees budgets, research and personnel for the college and Experiment Station. He also facilitates research planning and activities related to the bioeconomy and, in particular, development of Iowa State’s BioCentury Research Farm. His research areas focus on the economics of agroforestry, management of streamside buffer systems on farmland and biorenewable resources. He has taught undergraduate and graduate courses in forestry and natural resources economics, decision-making and management.',
            'homepage' => 'https://www.nrem.iastate.edu/people/joe-colletti',
            'email' => 'colletti@iastate.edu'
		);

		$people_info[2] = array(
			'name' => 'Travis Desell',
			'source' => 'img/travis_desell.png',
			'bio' => 'Travis Desell, Ph.D., Computer Science, Rensselaer Polytechnic Institute. Dr. Desell is an assistant professor at the University of North Dakota.  He is a computational scientist specializing in machine learning, computer vision, high performance and distributed computing and is involved in a number of research projects involving the application of unmanned aerial systems and the analysis of data captured by them. He a Co-PI on the NSF BDSPOKES: Unmanned Aerial Systems, Plant Sciences and Education project.',
			'email' => 'tdesell@cs.und.edu',
			'homepage' => 'http://tdesell.cs.und.edu'
		);

		$people_info[3] = array(
			'name' => 'Greg Monaco',
			'source' => 'img/greg_monaco_small.jpeg',
			'bio' => 'Greg Monaco, Ph.D., has held several positions with the <a href="https://www.greatplains.net/" target="_blank">Great Plains Network</a> since August, 2000, when he joined GPN. He began as Research Collaboration Coordinator, and then was promoted to Director for Research and Education, followed by Executive Director for several years. His passion is to assist to help enable a richer set of shared resources across the region and to help promote the exciting and leading edge activities of GPN member institutions. He appreciates the opportunity to work with the excellent scientists, researchers and educators in the Great Plains region..',
            'homepage' => 'http://confluence.greatplains.net/display/~gmonaco',
            'email' => 'gmonaco@ksu.edu'
		);

		$peopleText  = "<h2 style='padding-top: 0cm; margin-top: 0cm;'>Principle Investigators</h2>\n";
		for($i=0; $i<4; $i++)
		{
			$name     = $people_info[$i]["name"];
			$source   = $people_info[$i]["source"];
			$bio      = $people_info[$i]["bio"];
			$homepage = $people_info[$i]["homepage"]; 
			$email    = $people_info[$i]["email"];

			$peopleText .= "<div class='well'><table><tr>\n";
			$peopleText .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of ".$name."' style='height:160px; text-align:left;' src='".$source."' /><td>\n";
			$peopleText .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: x-large'>";
			if($homepage !== null) $peopleText .= "<a href='".$homepage."' target='_blank'>";
			$peopleText .= $name;
			if($homepage !== null) $peopleText .= "</a>";
			$peopleText .= "</span>";
			if($email !== null)    $peopleText .= "<span style='font-weight: bold; font-size: small;'><br><a href='mailto:".$email."'>".$email."</a></span>";
			$peopleText .= "<br>\n";
			$peopleText .= $bio."</p></td>\n";
			$peopleText .= "</table></div>\n";
		}

		return $peopleText;
	}
?>
