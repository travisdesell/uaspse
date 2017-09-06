<?php
	$mupurl = "https://www.meetup.com/pro/producers";
	
	$options = array('http' => array('header' => 'Content-Type: text/html; charset=utf-8','method' => 'GET'));
 	$context = stream_context_create($options);
	$response = file_get_contents($mupurl, false, $context);

	$chop = explode('Meetup Groups Nearby', $response);
	$bkchop = explode('<ul class="list">', $chop[1]);
	$endchop = explode('</ul>', $bkchop[1]);

	$lichop = explode('</li>', $endchop[0]);

	$cnt = count($lichop)-1;

	$html = "";

	for($i=0; $i<$cnt; $i++)
	{
		$gtrchop = explode('>', $lichop[$i]);
		
		$urlchop = explode('"', $gtrchop[3]);
		$chpchop = explode('<', $gtrchop[4]);
		$memchop = explode('<', $gtrchop[7]);
		$locchop = explode('<', $gtrchop[9]);

		$chapurl = trim($urlchop[1], "\n");
		$chapnme = trim($chpchop[0], "\n");
		$chapcnt = trim($memchop[0], "\n");
		$chaploc = trim($locchop[0], "\n");

		$html .= "<div style='margin-top: 5px; margin-bottom: 5px;'><table><tr><td style='padding: 5px; width: 32px; vertical-align: top; align: left;'>";
		$html .= "<img alt='UASPSE Icon' style='height: 32px;' src='img/uaspse-48.png' /></td>";
		$html .= "<td style='padding: 5px; vertical-align: top; align: left;'>";
		$html .= "<p style='font-weight: bold;'>".$chapnme."<br>";
		$html .= "Location: ".$chaploc.", ".$chapcnt."<br><a href='".$chapurl."' target='meetups'>";
		$html .= "Group Meetup Page</a></p></td></tr></table></div>";
	}

	echo $html;
//	echo "<ul class='list'>".$endchop[0]."</ul>";

?>
