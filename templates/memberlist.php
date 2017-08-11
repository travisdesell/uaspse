<?php

	$dbase = opendb();
	if($dbase)
	{
		$cmd  = "SELECT * FROM profiles ORDER by lastName ASC";
		if($result = $dbase->query($cmd))
		{
			$tnum = $result->num_rows;
			$dnum = intdiv($tnum, 3);
			$lover = $tnum % 3;
			if($lover > 0) $dnum += 1;

			$lover = 3 - $lover;

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

			
			$marr = array(""); //$tnum
			$members = array_pad($marr, $tnum, "");
			$iarr = array("");
			$items = array_pad($iarr, $dnum, ""); //$dnum;

			$m = 0;
			while($row = $result->fetch_object())
			{
				$members[$m] .= "<div class='well' style='margin-top: 13px; margin-bottom: 13px;'>";
				$members[$m] .= "<table><tr><td style='vertical-align: top; padding: 5px; text-align: left;'>";
				$members[$m] .= "<img alt='Image of ".$row->firstName." ".$row->lastName;
				$members[$m] .= "' style='height:40px; width:40px; text-align:left;' src='".$row->pictureUrl."' /></td>";
				$members[$m] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'>";
				$members[$m] .= "<p style='font-weight: bold; font-size: medium; margin-bottom: 0px;'>".$row->firstName." ".$row->lastName;
				$members[$m] .= " - <a href='javascript: getProfile(\"".$row->id."\");'>View Profile</a></p>\n";
				$members[$m] .= "<p style='font-weight: bold; font-size: x-small; margin-bottom: 0px;'>".$row->headline."</p>";
				$members[$m] .= "</td></tr></table></div>";
				$m = $m + 1;
			}

			shuffle($members);

			$m = 0;
			for($n=0; $n<$tnum; $n++)
			{
				$items[$m] .= $members[$n];
				$i = $i + 1;
				if($i == 3)
				{
					$i = 0;
					$m = $m + 1;
				}
			}

			if($lover < 3)
			{
				for($n=0; $n<$lover; $n++)
				{
					$items[$m] .= "<div class='well' style='margin-top: 13px; margin-bottom: 13px;'><table><tr>";
					$items[$m] .= "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='Image of Generic Member' ";
					$items[$m] .= "style='height:40px; width:40px; text-align:left;' ";
					$items[$m] .= "src='https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_80x80_v1.png' />";
					$items[$m] .= "</td><td style='vertical-align: top; padding: 5px; text-align: left;'>";
					$items[$m] .= "<p style='font-weight: bold; font-size: medium; margin-bottom: 0px;'>New Members Wanted!</p>";
					$items[$m] .= "<p style='font-weight: bold; font-size: x-small; margin-bottom: 0px;'>";
					$items[$m] .= "<a href='javascript: preLoginInfo();'>Join using your LinkedIn acount.</a></p>";
					$items[$m] .= "</td></tr></table></div>";
				}
		
				$m =  $m + 1;
			}

			for($n=0; $n<$m; $n++)
			{
				$html  = "<div class='item";
				if($n == 0) $html .= " active";
				$html .= "'><table style='width: 100%;'><tr><td style='width: 30px;'></td><td style='width: calc(100% - 60px);'>";
				$html .= $items[$n];
				$html .= "</td><td style='width: 30px;'></td></tr></table></div>";
				echo $html;
			}
			
			echo "</div>";

			$html  = "	<a class='left carousel-control' style='width: 30px; height: 330px;' href='#profCarousel' data-slide='prev'>";
			$html .= "	<span class='glyphicon glyphicon-chevron-left'></span>";
			$html .= "	<span class='sr-only'>Previous</span>";
			$html .= "	</a>";

			$html .= "	<a class='right carousel-control' style='width: 30px; height: 330px;' href='#profCarousel' data-slide='next'>";
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
