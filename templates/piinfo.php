<?php
	function getPiInfo()
	{
		//This is a stub for a function that will call the mysql database, and pull this data from the database in the future.
		$people_info = array();
		$people_info[0] = array(
			'name' => 'Jennifer Clarke',
			'source' => 'img/jennifer_clarke_80.jpg',
			'bio' => ' Jennifer Clarke, Ph.D., Associate Professor of Food Science of Statistics and Food Science and Technology, Research Assistant Professor in Data Science at the University of Nebraska, B.A., Psychology, Skidmore College; B.A., Mathematics, Skidmore College; M.S., Statistics, Carnegie Mellon University, Ph. D., Statistics, The Pennsylvania State University. Dr. Clarke’s research interests encompass statistical methodology (with an emphasis on high dimensional and predictive methods), statistical computation, bioinformatics/computational biology, multi-type data analysis, data mining/machine learning, and bacterial genomics/metagenomics.',
            'homepage' => 'http://bigdata.unl.edu/about',
            'email' => 'jclarke3@unl.edu',
	    'headline' => 'Assoc. Professor of Food Science & Technology, Univ. of Nebraska - Lincoln'

		);

		$people_info[1] = array(
			'name' => 'Joe Colletti',
			'source' => 'img/joe_colletti_80.jpg',
			'bio' => 'Joe Colletti, Ph.D., is the senior associate dean for the College of Agriculture and Life Sciences at Iowa State University and, the associate director of the Iowa Agriculture and Home Economics Experiment Station. He has served in those positions since 2006. He oversees budgets, research and personnel for the college and Experiment Station. He also facilitates research planning and activities related to the bioeconomy and, in particular, development of Iowa State’s BioCentury Research Farm. His research areas focus on the economics of agroforestry, management of streamside buffer systems on farmland and biorenewable resources. He has taught undergraduate and graduate courses in forestry and natural resources economics, decision-making and management.',
            'homepage' => 'https://www.nrem.iastate.edu/people/joe-colletti',
            'email' => 'colletti@iastate.edu',
	    'headline' => 'Sr. Assoc. Dean for the College of Agriculture & Life Sciences, Iowa State Univ.'
		);

		$people_info[2] = array(
			'name' => 'Travis Desell',
			'source' => 'img/travis_desell_80.jpg',
			'bio' => 'Travis Desell, Ph.D., Computer Science, Rensselaer Polytechnic Institute. Dr. Desell is an assistant professor at the University of North Dakota.  He is a computational scientist specializing in machine learning, computer vision, high performance and distributed computing and is involved in a number of research projects involving the application of unmanned aerial systems and the analysis of data captured by them. He a Co-PI on the NSF BDSPOKES: Unmanned Aerial Systems, Plant Sciences and Education project.',
			'email' => 'tdesell@cs.und.edu',
			'homepage' => 'http://tdesell.cs.und.edu',
			'headline' => 'Assoc. Professor of Computer Science, Univ. of North Dakota'
		);

		$people_info[3] = array(
			'name' => 'Greg Monaco',
			'source' => 'img/greg_monaco_80.jpg',
			'bio' => 'Greg Monaco, Ph.D., has held several positions with the <a href="https://www.greatplains.net/" target="_blank">Great Plains Network</a> since August, 2000, when he joined GPN. He began as Research Collaboration Coordinator, and then was promoted to Director for Research and Education, followed by Executive Director for several years. His passion is to assist to help enable a richer set of shared resources across the region and to help promote the exciting and leading edge activities of GPN member institutions. He appreciates the opportunity to work with the excellent scientists, researchers and educators in the Great Plains region..',
            'homepage' => 'http://confluence.greatplains.net/display/~gmonaco',
            'email' => 'gmonaco@ksu.edu',
	    'headline' => 'Great Plains Network - Executive Director'
		);

		$people_info[4] = array(
			'name' => 'Grant McGimpsey',
			'source' => 'img/grant_mcgimpsey_80.jpg',
			'headline' => 'Vice President for Research & Economic Development at Univ. of North Dakota'
		);

		$peopleText   = "<div class='col-lg-4' col-md-4 col-sm-4>";
		$peopleText  .= "<p class='well' style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; ";
		$peopleText  .= "background-color: #a9cff2;'>Principle Investigators</p>";
		for($i=0; $i<5; $i++)
		{
			$name     = $people_info[$i]["name"];
			$source   = $people_info[$i]["source"];
			$bio      = $people_info[$i]["bio"];
			$homepage = $people_info[$i]["homepage"]; 
			$email    = $people_info[$i]["email"];
			$headline = $people_info[$i]["headline"];

			$peopleText .= "<div style='margin-bottom: 5px;' class='well'><table><tr>";
			$peopleText .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of ".$name."' ";
			$peopleText .= "style='height:48px; width: 48px; text-align:left;' src='".$source."' /><td>";
			$peopleText .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: medium'>".$name;
			$peopleText .= ", Ph.D. - <a href='getBio(\"".$name."\")' target='_blank'>View Bio</a><br></span>";
			$peopleText .= "<span style='font-weight: bold; font-size: small;'>".$headline."</span></p></td>";
			$peopleText .= "</table></div>";
		}

		$peopleText .= "</div>";
		return $peopleText;
	}
?>
