<?php

	$marq = array();
	$marq[0]  = "The projected growth in the global population will be <span style='font-style: italic; font-weight: bold;'>9.5 billion people by 2050</span>, which will require ";
	$marq[0] .= "the global agricultural workforce to produce 70% more food than our farmers do today. ";
	$marq[0] .= "<span style='font-weight: bold'>[<a style='font-weight: bold' href='http://www.fao.org/fileadmin/templates/wsfs/docs/expert_paper/How_to_Feed_the_World_in_2050.pdf' target='digiagfact'>UN - FAO Report</a>]</span>";

	echo "<div class='well' style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a1d6a0;'>Digital Ag Fact</div>";
	echo "<div class='well' style='padding: 5px; height: 60px; margin-bottom: 7px;overflow: auto;'>";
	echo "<p id='agfact'>";
	echo $marq[rand(0,count($marq)-1)];
	echo "</p>";
	echo "</div>";
?>
