<div class="col-sm-8">
<p class="well" style='font-size: small; font-weight: bold; padding: 3px; margin-bottom: 2px; background-color: #a1d6a0;'>Add UPSiE Events</p>
<div style='height: 340px; padding: 5px; overflow: auto; margin-bottom: 7px; border-radius: 5px; border-width: 1px; border-color: 
#DDDDDD; border-style: solid;'>
<span id="formspan">
<section>
<style scoped>
<?php
	require('css/view.css');
?>
</style>
<img id="top" src="img/top.png" alt="">
<div id="form_container">

<form id="form_46648" class="appnitro"  method="post" action="/events.php">
	<div class="form_description">
		<h2>Add UPSiE Event</h2>
		<p>This is a form to add a UPSiE Event</p>
	</div>						
	<ul >
		<li id="li_1" >
			<label class="description" for="event_title">Title </label>
			<div>
				<input id="event_title" name="event_title" class="element text large" type="text" maxlength="255" value=""/> 
			</div>
			<p class="guidelines" id="guide_1"><small>Title of the Event</small></p> 
		</li>

		<li id="li_2" >
			<label class="description" for="swd">Single Word Description </label>
			<div>
				<input id="swd" name="swd" class="element text small" type="text" maxlength="255" value=""/> 
			</div>
			<p class="guidelines" id="guide_2">
				<small>A unique single word description with no whitespace, with a maximum of 20 characters in length.</small>
			</p> 
		</li>

		<li id="li_3" >
			<label class="description" for="spotlight">Short Description of Event </label>
			<div>
				<textarea id="spotlight" name="spotlight" class="element textarea small"></textarea> 
			</div> 
		</li>

		<li id="li_4" >
			<label class="description" for="addition">Additional Information about Event </label>
			<div>
				<textarea id="addition" name="addition" class="element textarea medium"></textarea> 
			</div> 
		</li>

		<li id="li_5" >
			<label class="description" for="location">Location of Event </label>
			<div>
				<textarea id="location" name="location" class="element textarea small"></textarea> 
			</div>
		</li>

		<li id="li_6" >
			<label class="description" for="register">Registration Link </label>
			<div>
				<input id="register" name="register" class="element text large" type="text" maxlength="255" value=""/> 
			</div> 
		</li>

		<li id="li_9" >
			<label class="description" for="linktype">Registration Link Type </label>
			<span>
				<input id="webpage" name="linktype" class="element radio" type="radio" value="1" checked />
					<label class="choice" for="webpage">Web Page</label>
					<input id="email" name="linktype" class="element radio" type="radio" value="0" />
					<label class="choice" for="email">Email</label>

			</span> 
		</li>

		<li id="li_10" >
			<label class="description" for="makelive">Make Event Live </label>
			<span>
				<input id="live" name="makelive" class="element radio" type="radio" value="1" />
				<label class="choice" for="live">Live</label>
				<input id="notlive" name="makelive" class="element radio" type="radio" value="0" checked />
				<label class="choice" for="notlive">Not Live</label>

			</span>
			<p class="guidelines" id="guide_10">
				<small>Event will only be displayed on non-admin user event pages, if the "Live" radio button is selected.</small>
			</p> 
		</li>

		<li id="li_7" >
			<label class="description" for="date_beg">Start Date </label>
			<span>
				<input id="date_beg_1" name="date_beg_1" class="element text" size="2" maxlength="2" value="" type="text"> /
				<label for="date_beg_1">MM</label>
			</span>
			<span>
				<input id="date_beg_2" name="date_beg_2" class="element text" size="2" maxlength="2" value="" type="text"> /
				<label for="date_beg_2">DD</label>
			</span>
			<span>
	 			<input id="date_beg_3" name="date_beg_3" class="element text" size="4" maxlength="4" value="" type="text">
				<label for="date_beg_3">YYYY</label>
			</span>
	
			<span id="date_beg_cal">
				<img id="date_beg_img" class="datepicker" src="img/calendar.gif" alt="Pick a date.">	
			</span>

			<script type="text/javascript">
			Calendar.setup({
			inputField	 : "date_beg_3",
			baseField    : "date_beg",
			displayArea  : "date_beg_cal",
			button		 : "date_beg_img",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
			</script>
		 
		</li>

		<li id="li_8" >
			<label class="description" for="date_end">Stop Date </label>
			<span>
				<input id="date_end_1" name="date_end_1" class="element text" size="2" maxlength="2" value="" type="text"> /
				<label for="date_end_1">MM</label>
			</span>
			<span>
				<input id="date_end_2" name="date_end_2" class="element text" size="2" maxlength="2" value="" type="text"> /
				<label for="date_end_2">DD</label>
			</span>
			<span>
	 			<input id="date_end_3" name="date_end_3" class="element text" size="4" maxlength="4" value="" type="text">
				<label for="date_end_3">YYYY</label>
			</span>
	
			<span id="date_end_cal">
				<img id="date_end_img" class="datepicker" src="img/calendar.gif" alt="Pick a date.">	
			</span>
			<script type="text/javascript">
			Calendar.setup({
			inputField	 : "date_end_3",
			baseField    : "date_end",
			displayArea  : "date_end_cal",
			button		 : "date_end_img",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
			</script>
		 
		</li>
			
		<li class="buttons">
			<input type="hidden" name="form_id" value="46648" />
			<?php
				$value = getNewId();
				echo "<input type='hidden' name='id' value='".$value."' />";
			?>
			<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
	</ul>
</form>
</div>
</section>
</span>
</div>	
</div>
