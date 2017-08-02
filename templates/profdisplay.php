<?php

function noProfile()
{
}

function activeUserProfile()
{
	$dbase = opendb();
	if(isset($_SESSION["PROFDISPLAY"]))
	{
		if($dbase)
		{
			$cmd  = "SELECT * FROM profiles WHERE id = '".$_SESSION["PROFDISPLAY"]."'";
			if($result = $dbase->query($cmd))
			{
				$row = $result->fetch_object();
				$prof = unserialize($row->profile);
				
				$html  = "<div class='well'>";
				$html .= "<table><tr>\n";
				$html .= "<td style='vertical-align: top; padding-top: 5px; padding-left: 5px; ";
				$html .= "padding-bottom: 5px; padding-right: 10px; text-align: left;'><img alt='Image of ";
				$html .= $prof->firstName." ".$prof->lastName."' style='height:80px; text-align:left;' src='".$prof->pictureUrl."' />";
				$html .= "<p style='text-align: center; font-weight: bold; font-size: small; ";
				$html .= "padding-top: 5px;'><a href='mailto:".$prof->emailAddress."'>Send Email</a></p></td>\n";
				$html .= "<td style='vertical-align: top; padding: 5px; text-align: left;'>";
				$html .= "<p style='font-weight: bold; margin-bottom: 0px;'>";
				$html .= "<span style='font-size: x-large'>".$prof->firstName." ".$prof->lastName."</span>";
				$html .= "<span style='font-size: medium'> - <a href='".$prof->publicProfileUrl."' target='_linkedin'>Linkedin Profile</a></span></p>\n";
				$html .= "<p style='font-weight: bold; font-size: medium'>".$prof->headline."</p>";
				
				if($prof->summary !== null)
				{
				    $html .= "<p style='font-weight: bold; margin-bottom: 0px;'>Summary</p> ";
				    $html .= "<p style='font-size: small;'>".$prof->summary."</div></p>";
				}

				if($prof->positions !== null)
				{
					$clen = $prof->positions->_total;
					if($clen > 0) $html .= "<p style='font-weight: bold; margin-bottom: 0px;'>Positions</p>";
					$pos = $prof->positions->values;
					for($i=0; $i<$clen; $i++)
					{
						$html .= "<p style='margin-bottom: 0px; margin-left: 25px; font-size: small;'>";
						$html .= "<span style='font-weight: bold; '>".$pos[$i]->title."</span>";
						$html .= "<span style='font-style: italic; font-size: small; margin-left: 25px;'>";
						$html .= "<span style='font-weight: bold;'>Institution - </span>".$pos[$i]->company->name."</span></p>";
						$html .= "<p style='margin-left: 25px; margin-bottom: 25px;'>".$pos[$i]->summary."</p>";
					}
				}
				
				$ui = json_decode($_SESSION["USERDATA"]);

				if($prof->id == $ui->id)
				{
					$html .= "<p style='font-weight: bold; font-size: medium; text-align: right;'>";
					$html .= "<a href='/?remove=".$prof->id."'>Cancel Registration</a></p>";
				}
				$html .= "</td></tr></table>";
				$html .= "</div>";
	
				echo $html;
			}
			else echo "<div class='well'><p>Error: Database not available!</a></div>";
			$dbase->close();
		}
		else echo "<div class='well'><p>Error: Database not available!</a></div>";
	}
	else
	{
		$html  = "<div class='well'>";
		$html .= "<p>Place Holder Text</p>";
		$html .= "</div>";
		echo $html;
	}
}
?>
