<!-- Main component for a primary marketing message or call to action -->
<div id='content' class='container-fluid'>
	<div class="row">
		<?php
			require("templates/userinfo.php");
		?>
		<div class="col-lg-4 col-md-4 col-sm-4">
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a9cff2;'>UASPSE Membership - <a href='javascript: listAllMembers();'>List All Members</a></p>
			<div style='padding: 1px; height: 4px; border-radius: 5px 5px 0px 0px; background-color: #777777;'></div>
			<div id="profCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
			<!-- <div class="row"> -->
			<?php
				require("templates/memberlist.php");
			?>
			</div>
			<div style='padding: 1px; height: 4px; border-radius: 0px 0px 5px 5px; background-color: #777777;'></div>
		</div>
		<div class='col-lg-4'>
			<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a9cff2'>UASPSE Meetups</p>
			<div class="well">
				<?php
					require("templates/meetups.php");
				?>
			</div>
		</div>
	</div>
</div> <!-- /container -->
