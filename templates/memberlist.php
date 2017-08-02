<?php

	$dbase = opendb();
	if($dbase)
	{
		$cmd  = "SELECT * FROM profiles ORDER by lastName ASC";
		if($result = $dbase->query($cmd))
		{
			$tnum = $result->num_rows;
			$dnum = intdiv($tnum, 3);
			if(($tnum % 3) > 0) $dnum += 1;

			$html = "<ol class='carousel-indicators'>";
			for($i=0; $i<$dnum; $i++)
			{
				$html .= "<li data-target='#profCarousel' data-slide-to='".$i."'";
				if($i==0) $html .= " class='active'";
				$html .= "></li>";
			}
			$html .= "</ol>";

			echo $html;

			$html  = "<div class='carousel-inner' role='listbox'>";
	
			echo $html;
 
			$i=0;
			$isFirst = true;
			$isClosed = true;
			
			while($row = $result->fetch_object())
			{
				if($i==0)
				{
					$isClosed = false;
					$html = "		<div class='item";
					if($isFirst)
					{
						$isFirst = false;
						$html .= " active";
					}
					$html .= "'><table style='width: 100%;'><tr><td style='width: 30px;'></td><td style='width: calc(100% - 60px);'><div class='well' style='margin-top: 20px;'>";
				}
				else	$html .= "			<div class='well'>";
								
				$html .= "					<table>";
				$html .= "						<tr>";
				$html .= "							<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of ";
				$html .= $row->firstName." ".$row->lastName."' style='height:40px; width:40px; text-align:left;' src='".$row->pictureUrl."' />";
				$html .= "							</td>";
				$html .= "							<td style='vertical-align: top; padding: 5px; text-align: left;'>";
				$html .= "								<p style='font-weight: bold; font-size: medium; margin-bottom: 0px;'>".$row->firstName." ".$row->lastName;
				$html .= " - <a href='javascript: getProfile(\"".$row->id."\");'>View Profile</a></p>\n";
				$html .= "								<p style='font-weight: bold; font-size: x-small; margin-bottom: 0px;'>".$row->headline."</p>";
				$html .= "							</td>";
				$html .= "						</tr>";
				$html .= "					</table>";
				$html .= "				</div>";
				
				if($i == 2)
				{
					$html .= "		</td><td style='width: 30px;'></td></tr></table></div>";
					echo $html;

					$i=0;
					$isClosed = true;
				}
				else $i = $i + 1;
			}

			if(!$isClosed)
			{
				
				for($j=2-$i; $j<3; $j++)
				{
					$html .= "			<div class='well'>";
					$html .= "				 <table>";
					$html .= "					<tr>";
					$html .= "						<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of Generic Member' ";
					$html .= "style='height:40px; width:40px; text-align:left;' src='https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_80x80_v1.png' />";
					$html .= "						</td>";
					$html .= "						<td style='vertical-align: top; padding: 5px; text-align: left;'>";
					$html .= "							<p style='font-weight: bold; font-size: medium; margin-bottom: 0px;'>New Members Wanted!</p>";
					$html .= "							<p style='font-weight: bold; font-size: x-small; margin-bottom: 0px;'>Join using your LinkedIn acount.</p>";
					$html .= "						</td>";
					$html .= "					</tr>";
					$html .= "				</table>";
					$html .= "			</div>";
				}
				$html .= "		</td><td style='width: 30px;'></td></tr></table></div>";
			}
			
			$html .= "</div>";
			
			echo $html;

			$html  = "	<a class='left carousel-control' style='width: 30px;' href='#profCarousel' data-slide='prev'>";
			$html .= "	<span class='glyphicon glyphicon-chevron-left'></span>";
			$html .= "	<span class='sr-only'>Previous</span>";
			$html .= "	</a>";

			$html .= "	<a class='right carousel-control' style='width: 30px;' href='#profCarousel' data-slide='next'>";
			$html .= "	<span class='glyphicon glyphicon-chevron-right'></span>";
			$html .= "	<span class='sr-only'>Next</span>";
			$html .= "	</a>";
			
			echo $html;
		}
		else echo "<div class='well'><p>Error: Database not available!</a></div>";
		$dbase->close();
	}
	else echo "<div class='well'><p>Error: Database not available!</a></div>";
		
?>
