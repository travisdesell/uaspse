<?php
	echo "<div class='col-sm-4'>";
	echo "<p class='well' style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; ";
	echo "background-color: #a1d6a0;'>Advisory Committee</p>";

	echo "<div style='padding: 2px; height: 340px; width: 100%; overflow: auto; border-radius: 5px; ";
	echo "border-width: 1px; border-color: #DDDDDD; border-style: solid;'>";

	$adv = array();

	$adv[0]  = "<div style='margin-bottom: 5px;' class='well'><table><tr>";
	$adv[0] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of Jack Cothren' ";
	$adv[0] .= "style='height:48px; width: 48px; text-align:left;' src='img/jack_cothren_80.jpg' /><td>";
	$adv[0] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: medium'>Jack Cothren";
	$adv[0] .= ", Ph.D. - <a href='https://fulbright.uark.edu/departments/geosciences/directory/cothren.php' target='_blank'>Website</a><br></span>";
	$adv[0] .= "<span style='font-weight: bold; font-size: small;'>Director of the Center for Advanced Spatial Technologies</span></p></td>";
	$adv[0] .= "</table></div>"; 

	$adv[1]  = "<div style='margin-bottom: 5px;' class='well'><table><tr>";
	$adv[1] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of April Agee Carroll' ";
	$adv[1] .= "style='height:48px; width: 48px; text-align:left;' src='img/april_carroll_80.jpg' /><td>";
	$adv[1] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: medium'>April Agee Carroll";
	$adv[1] .= ", Ph.D. - <a href='https://www.linkedin.com/in/aprilageecarroll/' ";
	$adv[1] .= "target='_blank'>Website</a><br></span>";
	$adv[1] .= "<span style='font-weight: bold; font-size: small;'>Director of Phenomics for Purdue Agriculture</span></p></td>";
	$adv[1] .= "</table></div>"; 

	$adv[2]  = "<div style='margin-bottom: 5px;' class='well'><table><tr>";
	$adv[2] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of Mark Moran' ";
	$adv[2] .= "style='height:48px; width: 48px; text-align:left;' src='img/mark_moran_80.jpg' /><td>";
	$adv[2] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: medium'>Mark Moran";
	$adv[2] .= ", Ph.D. - <a href='https://www.linkedin.com/in/moranmarkd/' target='_blank'>Website</a><br></span>";
	$adv[2] .= "<span style='font-weight: bold; font-size: small;'>Assoc. Directo, John Deere Technology Innovation Center</span></p></td>";
	$adv[2] .= "</table></div>"; 

	$adv[3]  = "<div style='margin-bottom: 5px;' class='well'><table><tr>";
	$adv[3] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of Lisa Harper' ";
	$adv[3] .= "style='height:48px; width: 48px; text-align:left;' src='img/lisa_harper_80.jpg' /><td>";
	$adv[3] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: medium'>Lisa Harper";
	$adv[3] .= ", Ph.D. - <a href='https://www.linkedin.com/in/lisa-harper-22260761/' target='_blank'>Website</a><br></span>";
	$adv[3] .= "<span style='font-weight: bold; font-size: small;'>Director, AgBioData Consortium MaizeGDB, USDA-ARS PGEC</span></p></td>";
	$adv[3] .= "</table></div>"; 

	$adv[4]  = "<div style='margin-bottom: 5px;' class='well'><table><tr>";
	$adv[4] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of Thomas Haun' ";
	$adv[4] .= "style='height:48px; width: 48px; text-align:left;' src='img/thomas_haun_80.jpg' /><td>";
	$adv[4] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><p><span style='font-weight: bold; font-size: medium'>Thomas Haun ";
	$adv[4] .= "- <a href='https://www.linkedin.com/in/thomashaun/' target='_blank'>Website</a><br></span>";
	$adv[4] .= "<span style='font-weight: bold; font-size: small;'>Executive Vice President - PrecisionHawk</span></p></td>";
	$adv[4] .= "</table></div>"; 

	shuffle($adv);

	$cadv = count($adv);

	for($i=0; $i<$cadv; $i++) echo $adv[$i];
	echo "</div></div>";
?>

