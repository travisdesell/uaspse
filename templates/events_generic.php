		<div class="col-sm-4">
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a1d6a0;'>UASPSE Events</p>
			<?php
				$hasUserInfo = false;
				$isAdmin = false;
				if($isAuthorized == true && $_SESSION["USERDATA"] !== null && isset($_SESSION["USERDATA"]) == true) $hasUserInfo = true;
				if($hasUserInfo)
				{
					$userData = json_decode($_SESSION["USERDATA"]);
					$dbase = opendb();
					if($dbase)
					{
						$cmd = "SELECT admin FROM profiles WHERE id='".$userData->id."'";
						if($result = $dbase->query($cmd))
						{
							$row = $result->fetch_object();
							if($row->admin == 1) $isAdmin = true;
						}
						$dbase->close();
					}
				}
				
			?>

			<?php
				if($isAdmin == true)
				{
					echo "<p class='well' style='padding: 0px 20px 0px 2px; text-align: right; margin-bottom: 3px;'>";
					echo "<a href='/events.php?addevent=1'>Add Event</a></p>";
					echo "<div style='height: 315px; padding: 5px; overflow: auto; margin-bottom: 7px;";
					echo "border-radius: 5px; border-width: 1px; border-color: #DDDDDD; border-style: solid;'>";
				}
				else
				{
					echo "<div style='height: 340px; padding: 5px; overflow: auto; margin-bottom: 7px;";
					echo "border-radius: 5px; border-width: 1px; border-color: #DDDDDD; border-style: solid;'>";
				}

				$dbase = opendb();
				if($dbase)
				{
					$cmd = "SELECT * FROM events ORDER by start ASC";
					$tyear = date('Y');
					$tmonth = date('m');
					$tday = date('d');
					$result = $dbase->query($cmd);
					$cDate = date('Y/m/d H:i:s');
					while($row = $result->fetch_object())
					{
						$usershow = $row->live;

						$eDate = date_create($row->stop."23:59:59");

						if($eDate < $cDate) $usershow = 0;
						error_log("eDate: ".$eDate);
						error_log("cDate: ".$cDate);
//						error_log("User Show: ".$usershow);	
//						error_Log("de1: ".intval($row->de3).", tyear: ".intval($tyear).", de3: ".intval($row->de1).", tmonth: ".intval($tmonth).", de2: ".intval($row->de2).", tday: ".intval($tday));

//						if(intval($row->de3) < intval($tyear)) $usershow = 0;
//						else if(intval($row->de1) < intval($tmonth)) $usershow = 0;
//						else if(intval($row->de2) < intval($tday)) $usershow = 0;
						
						if($usershow == 1 || $isAdmin == true)
						{
						echo "<div style='margin-bottom: 5px; padding: 2px;' class='well'><table><tr>";
						echo "<td style='vertical-align: top; padding: 5px; text-align: left;'><img alt='UASPSE Icon' ";
						echo "src='img/uaspse-48.png' style='height: 48px; width: 48px; text-align: left;' />";
						if($isAdmin)
						{
							echo "<p style='font-size: x-small; font-weight: bold; text-align: center;'>";
							echo "<a href='/events.php?edit=".$row->id."'>Edit<br>Event</a></p>";
						}
						echo "</td><td style='vertical-align: top; padding: 5px; text-align: left;'>";
						echo "<p><span style='font-weight: bold; ";
						echo "font-size: medium'>".$row->title."</span><br>Date: ".$row->start;
						echo "<br><a href='/events.php?eventname=".$row->swd."'";
						echo ">View Event Details</a></p></td></tr></table></div>";
						}
					}
					$dbase->close();	
				}
			?>
			</div>
		</div>
		<div class="col-sm-4">
			<p class="well" 
			style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a1d6a0;'>UASPSE Event Spotlight</p>
			<div class="well" style="height: 340px; padding: 5px; overflow: auto; margin-bottom: 7px;">
				<?php
					$dbase = opendb();
					if($dbase)
					{
						$cmd = "SELECT * FROM events WHERE live=1 ORDER BY RAND() LIMIT 1";
						if($result = $dbase->query($cmd))
						{
							$row = $result->fetch_object();
				echo "<p style='font-size: x-large; font-weight: bold;'>".$row->title."</p>";
				echo "<p style='font-size: medium; margin-left: 10px;'><span style='font-weight: bold;'>Location: </span>".$row->location;
				echo "<br><span style='font-weight: bold;'>Dates: </span><span style='font-style: italic;'>".$row->start."</span></p>";
				echo "<p style='font-zise: medium; font-weight: bold; margin-left: 30px'><a href='/events.php?eventname=".$row->swd;
				echo "'>Read More...</a></p><hr style='padding: 0px; margin: 0px; color: #000000'>";
				echo "<p style='font-size: medium; margin-left: 10px;'>".$row->spotlight."</p>";
							$dbase->close();
						}
					}
				?>
        		</div>
		</div>
	
