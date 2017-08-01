<?php

	$dbase = opendb();
	if($dbase)
	{
		$cmd  = "SELECT * FROM profiles ORDER by lastName ASC";
		if($result = $dbase->query($cmd))
		{
			while($row = $result->fetch_object())
			{
				$html  = "<div class='well'>";
				$html .= "<table><tr>\n";
				$html .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of ";
				$html .= $row->firstName." ".$row->lastName."' style='height:80px; text-align:left;' src='".$row->pictureUrl."' />";
				$html .= "</td>\n";
				$html .= "<td style='vertical-align: top; padding: 5px; text-align: left;'>";
				$html .= "<p style='font-weight: bold; font-size: x-large'>".$row->firstName." ".$row->lastName." - <a href='/community.php?profile=".$row->id."'>View Profile</a></p>\n";
				$html .= "<p style='font-weight: bold; font-size: medium; margin-bottom: 0px;'>".$row->headline."</p>";
				$html .= "</td></tr></table>";
				$html .= "</div>";
				
				echo $html;
			}
		}
		else echo "<div class='well'><p>Error: Database not available!</a></div>";
		$dbase->close();
	}
	else echo "<div class='well'><p>Error: Database not available!</a></div>";
		
?>
