<div id='content' style="padding-top: 20px;" class="container-fluid">
	<div class="row">
		<?php
			require("templates/userinfo.php");
		?>
		<?php
			//containst the function stub for calling PI info from database
			require_once("templates/piinfo.php");
			$piInfo = getPiInfo();
			echo $piInfo;

			require_once("templates/advisors.php");
		?>
	</div>
</div>
