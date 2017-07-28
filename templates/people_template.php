<div id='content' style="padding-top: 20px;" class="container-fluid">
	<div class="row">
		<div class='col-lg-2'>
        		<div class="well">
				<?php
					require("templates/userinfo.php");
				?>
			</div>
		</div>
		<div class="col-lg-9">
		<?php
			//containst the function stub for calling PI info from database
			require_once("templates/piinfo.php");
			$piInfo = getPiInfo();
			echo $piInfo;
		?>
		</div>
	</div>
</div>
