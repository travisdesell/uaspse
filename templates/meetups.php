<?php
//	require_once('../php_scripts/simple_html_dom.php');
//	$mupurl = "https://www.meetup.com/pro/producers";
	
//	$options = array('http' => array('header' => 'Content-Type: text/html; charset=utf-8','method' => 'GET'));
// 	$context = stream_context_create($options);
//	$page = file_get_html($mupurl);

//	$response = file_get_contents($mupurl);

//	$chop = explode('groups', $response);

//	$grpChop = explode('<h3', $chop[1]);
/*
	$bkchop = explode('<ul class="list">', $chop[1]);
	$endchop = explode('</ul>', $bkchop[1]);

	$lichop = explode('</li>', $endchop[0]);
*/
//	$cnt = count($grpChop);

	$mLink = array("https://www.meetup.com/ND-RR-Valley-North-UAS-Digital-Precision-Ag-Big-Data",
			"https://www.meetup.com/ND-RRValley-UAS-Precision-Agriculture",
			"https://www.meetup.com/Data-Science-and-Big-Data-South-Dakota",
			"https://www.meetup.com/Nebraska-UAS-Precision-Agriculture-and-Big-Data-Meetup",
			"https://www.meetup.com/UAS-Digital-and-Precision-Ag-and-Big-Data-Meetup",
			"https://www.meetup.com/Rolla-Big-Data-Meetup");
	$mTitle= array("ND RR Valley (North) : UAS Digital/Precision Ag & Big Data",
			"ND RR Valley (South) : UAS Digital/Precision Ag & Big Data",
			"Data Science and Big Data - South Dakota",
			"Nebraska - UAS Precision Agriculture and Big Data Meetup",
			"Kansas UAS Digital/Precision Ag and Big Data Meetup",
			"Missouri UAS Digital/Precision Ag and Big Data Meetup");
	$mLoc = array("Grand Forks, ND",
			"Fargo, ND",
			"Sioux Falls, SD",
			"Lincoln, NE",
			"Manhattan, KS",
			"Rolla, MO");
	$html = "";
	for($i=0; $i<6; $i++)
	{
//		$subGrp = explode('</p>',$grpChop[$i]);
//		$reconst = "<h3".$subGrp[0]."</p>";
/*
		$gtrchop = explode('>', $lichop[$i]);
		
		$urlchop = explode('"', $gtrchop[3]);
		$chpchop = explode('<', $gtrchop[4]);
		$memchop = explode('<', $gtrchop[7]);
		$locchop = explode('<', $gtrchop[9]);

		$chapurl = trim($urlchop[1], "\n");
		$chapnme = trim($chpchop[0], "\n");
		$chapcnt = trim($memchop[0], "\n");
		$chaploc = trim($locchop[0], "\n");
*/
		$html .= "<div style='margin-top: 5px; margin-bottom: 5px;'><table><tr><td style='padding: 5px; width: 32px; vertical-align: top; align: left;'>";
		$html .= "<img alt='UASPSE Icon' style='height: 32px;' src='img/uaspse-48.png' /></td>";
		$html .= "<td style='padding: 5px; vertical-align: top; align: left;'>";
		$html .= "<p style='font-weight: bold;'>".$mTitle[$i]."<br>";
		$html .= "Location: ".$mLoc[$i]."<br><a href='".$mLink[$i]."' target='meetups'>";
		$html .= "Group Meetup Page</a></p></td></tr></table></div>";

	}

	echo $html;

?>
