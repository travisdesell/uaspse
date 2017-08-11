<?php
	function getPiInfo()
	{
		//This is a stub for a function that will call the mysql database, and pull this data from the database in the future.
		$people_info = array();
		$people_info[0] = array(
			'name' => 'Jennifer Clarke',
			'source' => 'img/jennifer_clarke_80.jpg',
			'bio' => ' Jennifer Clarke, Ph.D., Associate Professor of Food Science and Technology, Research Assistant Professor in Data Science at the University of Nebraska, B.A., Psychology, Skidmore College; B.A., Mathematics, Skidmore College; M.S., Statistics, Carnegie Mellon University, Ph. D., Statistics, The Pennsylvania State University. Dr. Clarke’s research interests encompass statistical methodology (with an emphasis on high dimensional and predictive methods), statistical computation, bioinformatics/computational biology, multi-type data analysis, data mining/machine learning, and bacterial genomics/metagenomics.',
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
			'headline' => 'Vice President for Research & Economic Development at Univ. of North Dakota',
			'bio' => '',
			'email' => '',
			'homepage' => ''
		);

		$peopleText   = "<div class='col-sm-4'>";
		$peopleText  .= "<p class='well' style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; ";
		$peopleText  .= "background-color: #a1d6a0;'>Principle Investigators</p>";
	
		$peopleText .= "<div style='padding: 2px; height: 340px; width: 100%; overflow: auto; border-radius: 5px; ";
		$peopleText .= "border-width: 1px; border-color: #DDDDDD; border-style: solid;'>";
		$peopleText .= "<script type='text/javascript'>";

		$peopleText .= "function getBio(num)";
		$peopleText .= "{";
		$peopleText .= "var html  = \"<div class='well'>\";";

		$peopleText .= "html += \"<table><tr>\";";
		$peopleText .= "html += \"<td style='vertical-align: top; padding-top: 5px; padding-left: 5px; \";";
		$peopleText .= "html += \"padding-bottom: 5px; padding-right: 10px; text-align: left;'><img alt='Image of \";";
		$peopleText .= "html += pArry[num][0]+ \"' style='height:80px; text-align:left;' src='\" + pArry[num][1] + \"' />\";";
		$peopleText .= "html += \"<p style='text-align: center; font-weight: bold; font-size: small; \";";
		$peopleText .= "html += \"padding-top: 5px;'><a href='mailto:\" + pArry[num][4] + \"'>Send Email</a></p></td>\";";
		$peopleText .= "html += \"<td style='vertical-align: top; padding: 5px; text-align: left;'>\";";
		$peopleText .= "html += \"<p style='font-weight: bold; margin-bottom: 0px;'><span style='font-size: x-large'>\";";
		$peopleText .= "html += pArry[num][0] + \"</span>\";";
		$peopleText .= "html += \"<span style='font-size: medium'> - <a href='\";";
		$peopleText .= "html += pArry[num][3] + \"' target='_pis'>Website</a></span></p>\";";
		$peopleText .= "html += \"<p style='font-weight: bold; font-size: medium'>\" + pArry[num][5] + \"</p>\";";
		$peopleText .= "html += \"<p style='font-weight: bold; margin-bottom: 0px;'>Biography</p> <p \";";
		$peopleText .= "html += \"style='font-size: small;'>\" + pArry[num][2] + \"</div></p>\";";

		$peopleText .= "html += \"</td></tr></table>\";";

		$peopleText .= "html += \"</div>\";";
		$peopleText .= "var pdiv = document.getElementById('pdiv');";
		$peopleText .= "var tspn = document.getElementById('uaspse_title');";
		$peopleText .= "tspn.innerHTML = 'Principle Investigator';";
		$peopleText .= "pdiv.innerHTML = html;";
		$peopleText .= "$('#profModal').modal({show:false});";
		$peopleText .= "$('#profModal').modal('show');";
		$peopleText .= "}";




		$peopleText .= "var pArry = [];";
		$peopleText .= "pArry[0] = [];";
		$peopleText .= "pArry[1] = [];";
		$peopleText .= "pArry[2] = [];";
		$peopleText .= "pArry[3] = [];";
		$peopleText .= "pArry[4] = [];";

		shuffle($people_info);

		$peopleText .= "pArry[0][0] = '".$people_info[0]["name"]."';";
		$peopleText .= "pArry[0][1] = '".$people_info[0]["source"]."';";
		$peopleText .= "pArry[0][2] = '".$people_info[0]["bio"]."';";
		$peopleText .= "pArry[0][3] = '".$people_info[0]["homepage"]."';";
		$peopleText .= "pArry[0][4] = '".$people_info[0]["email"]."';";
		$peopleText .= "pArry[0][5] = '".$people_info[0]["headline"]."';";

		$peopleText .= "pArry[1][0] = '".$people_info[1]["name"]."';";
		$peopleText .= "pArry[1][1] = '".$people_info[1]["source"]."';";
		$peopleText .= "pArry[1][2] = '".$people_info[1]["bio"]."';";
		$peopleText .= "pArry[1][3] = '".$people_info[1]["homepage"]."';";
		$peopleText .= "pArry[1][4] = '".$people_info[1]["email"]."';";
		$peopleText .= "pArry[1][5] = '".$people_info[1]["headline"]."';";

		$peopleText .= "pArry[2][0] = '".$people_info[2]["name"]."';";
		$peopleText .= "pArry[2][1] = '".$people_info[2]["source"]."';";
		$peopleText .= "pArry[2][2] = '".$people_info[2]["bio"]."';";
		$peopleText .= "pArry[2][3] = '".$people_info[2]["homepage"]."';";
		$peopleText .= "pArry[2][4] = '".$people_info[2]["email"]."';";
		$peopleText .= "pArry[2][5] = '".$people_info[2]["headline"]."';";

		$peopleText .= "pArry[3][0] = '".$people_info[3]["name"]."';";
		$peopleText .= "pArry[3][1] = '".$people_info[3]["source"]."';";
		$peopleText .= "pArry[3][2] = '".$people_info[3]["bio"]."';";
		$peopleText .= "pArry[3][3] = '".$people_info[3]["homepage"]."';";
		$peopleText .= "pArry[3][4] = '".$people_info[3]["email"]."';";
		$peopleText .= "pArry[3][5] = '".$people_info[3]["headline"]."';";

		$peopleText .= "pArry[4][0] = '".$people_info[4]["name"]."';";
		$peopleText .= "pArry[4][1] = '".$people_info[4]["source"]."';";
		$peopleText .= "pArry[4][2] = '".$people_info[4]["bio"]."';";
		$peopleText .= "pArry[4][3] = '".$people_info[4]["homepage"]."';";
		$peopleText .= "pArry[4][4] = '".$people_info[4]["email"]."';";
		$peopleText .= "pArry[4][5] = '".$people_info[4]["headline"]."';";

		$peopleText .= "</script>";
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
			$peopleText .= ", Ph.D. - <a href='javascript: getBio(\"".$i."\");'>View Bio</a><br></span>";
			$peopleText .= "<span style='font-weight: bold; font-size: small;'>".$headline."</span></p></td>";
			$peopleText .= "</table></div>";
		}

		$peopleText .= "</div></div>";
		return $peopleText;
	}
?>
