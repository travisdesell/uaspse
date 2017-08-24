<!-- Main component for a primary marketing message or call to action -->
<div id='content' class='container-fluid'>
	<div class="row">
		<?php
			require("templates/userinfo.php");
			if(isset($_GET["eventname"])) require("templates/events_content.php");
			else if(isset($_GET["addevent"]) == true || isset($_GET["edit"]) == true) require("templates/events_add.php");
			else if(isset($_GET["remevent"]) == true)
			{
				if(getIsAdmin())
				{
					$cmd = "DELETE FROM events WHERE id=".$_GET["remevent"];

					$dbase = opendb();
					if($dbase)
					{
						$result = $dbase->query($cmd);
						$dbase->close();
					}
				}
				require("templates/events_generic.php");
			}
			else require("templates/events_generic.php");
		?>
	</div>
</div> <!-- /container -->
