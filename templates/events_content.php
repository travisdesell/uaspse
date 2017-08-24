<div class="col-sm-8">
	<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a1d6a0;'>UASPSE Event</p>
	<div style='height: 340px; padding: 5px; overflow: auto; margin-bottom: 7px;
	border-radius: 5px; border-width: 1px; border-color: #DDDDDD; border-style: solid;'>
<?php
	$dbase = opendb();
	if($dbase)
	{
		$cmd = "SELECT * FROM events WHERE swd='".$_GET["eventname"]."'";
		if($result = $dbase->query($cmd))
		{
			if($result->num_rows !== 0)
			{
				$isAdmin = getIsAdmin();
				$row = $result->fetch_object();
				if($row->live == 1 || $isAdmin == true)
				{
				echo "<p style='font-size: xx-large; font-weight: bold;'>".$row->title."</p>";
				echo "<p style='font-size: medium; margin-left: 10px;'><span style='font-weight: bold;'>Location: </span>".$row->location;
				echo "<br><span style='font-weight: bold;'>Dates: </span><span style='font-style: italic;'>".$row->start;
				echo "</span><span style='font-weight: bold;'> TO </span><span style='font-style: italic;'>".$row->stop."</span></span>";
				$linktype = "mailto:";
				if($row->ltype == 1) $linktype = "";
				echo "<br><span style='font-weight: bold;'>Register: </span><a style='font-weight: bold;' href='".$linktype.$row->rlink;
				echo "' target='uaspse_event'>Click for Registration Info</a></p>";
				echo "<p style='font-size: medium; margin-left: 10px;'>".$row->spotlight."</p>";
				echo "<p style='font-size: medium; margin-left: 10px;'>".$row->addition."</p>";
				}
				else redirect_script();
			}
			else redirect_script();
		}
		else redirect_script();
	}
	else redirect_script();
?>
	</div>
</div>
