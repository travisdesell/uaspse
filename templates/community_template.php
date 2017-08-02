
<!-- Main component for a primary marketing message or call to action -->
<div id='content' style="padding-top: 20px" class='container-fluid'>
	<div class="row">
		<div class='col-lg-2'>
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a9cff2;'>UASPSE User Details</p>
			<div class="well">
			<?php
				require("templates/userinfo.php");
			?>
			</div>
		</div>
		<div class="col-lg-4">
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a9cff2;'>UASPSE Membership</p>
			<div id="profCarosel" class="carousel slide" data-ride="carousel">
			<!-- <div class="row"> -->
			<?php
				require("templates/memberlist.php");
			?>
			</div>
		</div>
		<div class='col-lg-4'>
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a9cff2'>UASPSE Meetups</p>
			<div class="well">
				<p>Place Holder</p>
			</div>
		</div>
	</div>
</div> <!-- /container -->
