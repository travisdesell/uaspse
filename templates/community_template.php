<!-- Main component for a primary marketing message or call to action #155b27 #497f57-->
<div id='content' class='container-fluid'>
	<div class="row">
		<?php
			require("templates/userinfo.php");
		?>
		<div class="col-sm-4">
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; 
			background-color: #a1d6a0;'>UASPSE Membership - <a style='color: #155b27;' href='javascript: listAllMembers();'>List All Members</a></p>
			<div style=' height: 340px; border-radius: 5px 5px 5px 5px; border-style: solid none solid none; border-width: 5px; border-color: #DDDDDD; overflow:hidden;'>
				<div id="profCarousel" class="carousel slide" data-ride="carousel"  data-interval="false">
				<!-- <div class="row"> -->
				<?php
					require("templates/memberlist.php");
				?>
				</div>
			</div>
		</div>
		<div class='col-sm-4'>
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a1d6a0;'>UASPSE Meetups</p>
			<div class="well" style='height: 340px; overflow: auto;'>
				<?php
					require("templates/meetups.php");
				?>
			</div>
		</div>
	</div>
</div> <!-- /container -->
