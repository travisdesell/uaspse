<?php

	$dbase = opendb();
	if($dbase)
	{
		$cmd  = "SELECT * FROM profiles ORDER by lastName ASC";
		if($result = $dbase->query($cmd))
		{
			$tnum = $result->num_rows;
			$dnum = $tnum / 3;
			if(($tnum % 3) > 0) $dnum += 1;

			$html = "<ol class='carousel-indicators'>";
			for($i=0; $i<$dnum; $i++)
			{
				$html .= "<li data-target='#profCarousel' data-slide-to='".$i."'";
				if($i==0) $html .= " class='active'";
				$html .= "></li>";
			}
			$html .= "</ol>";
			$html .= "<div class='carousel-inner'>";
			$html .= "<table style='width: 100%;'><tr>";
			$html .= "<td style='width: 30px;'>";

			$html .= "<a class='left carousel-control' style='width: 10px;' href='#profCarousel' data-slide='prev'>";
			$html .= "<span class='glyphicon glyphicon-chevron-left'></span>";
			$html .= "<span class='sr-only'>Previous</span>";
			$html .= "</a>";
	
			$html .= "</td><td style='width: calc(100% - 60px);'>"; 
			$i=0;
			$isFirst = true;
			$isClosed = true;
			while($row = $result->fetch_object())
			{
				if($i==0)
				{
					$isClosed = false;
					$html .= "<div class='item";
					if($isFirst)
					{
						$isFirst = false;
						$html .= " active";
					}
					$html .= "'>";
				}
				$html .= "<div class='well'>";
				$html .=   "<table><tr>\n";
				$html .=   "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of ";
				$html .= $row->firstName." ".$row->lastName."' style='height:40px; width:40px; text-align:left;' src='".$row->pictureUrl."' />";
				$html .=   "</td>\n";
				$html .=   "<td style='vertical-align: top; padding: 5px; text-align: left;'>";
				$html .= "<p style='font-weight: bold; font-size: medium; margin-bottom: 0px;'>".$row->firstName." ".$row->lastName;
				$html .= " - <a href='javascript: getProfile(\"".$row->id."\");'>View Profile</a></p>\n";
				$html .= "<p style='font-weight: bold; font-size: x-small; margin-bottom: 0px;'>".$row->headline."</p>";
				$html .= "</td></tr></table>";
				$html .= "</div>";
				
				if($i == 2)
				{
					$html .= "</div>";
					$i=0;
					$isClosed = true;
				}
				else $i += 1;
			}
			if(!$isClosed) $html .= "</div>";
			$html .="</td><td style='width: 30px;'>";
			$html .= "<a class='right carousel-control' style='width: 10px;' href='#profCarousel' data-slide='next'>";
			$html .= "<span class='glyphicon glyphicon-chevron-right'></span>";
			$html .= "<span class='sr-only'>Next</span>";
			$html .= "</a>";
			$html .= "</td></tr></table>";
			$html .= "</div>";
			
			echo $html;
		}
		else echo "<div class='well'><p>Error: Database not available!</a></div>";
		$dbase->close();
	}
	else echo "<div class='well'><p>Error: Database not available!</a></div>";
		
?>
