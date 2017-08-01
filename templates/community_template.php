
<!-- Main component for a primary marketing message or call to action -->
<div id='content' style="padding-top: 20px" class='container-fluid'>
	<div class="row">
		<div class='col-lg-2'>
			<div class="well">
			<?php
				require("templates/userinfo.php");
			?>
			</div>
		</div>
		<div class="col-lg-4">
			<?php
				require("templates/memberlist.php");
			?>
		</div>
		<div class="col-lg-6">
			<?php
				require("templates/profdisplay.php");
			?>
		</div>
	</div>
</div> <!-- /container -->
