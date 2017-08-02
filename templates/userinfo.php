<?php
	$hasUserInfo = false;
	if($isAuthorized == true && $_SESSION["USERDATA"] !== null && isset($_SESSION["USERDATA"]) == true) $hasUserInfo = true;
	if($hasUserInfo)
	{
//		error_log($_SESSION["USERDATA"]);
		$userData  = json_decode($_SESSION["USERDATA"]);
//		echo $_SESSION["USERDATA"];
		$userImage = $userData->pictureUrl;
		$firstname = $userData->firstName;
		$lastname  = $userData->lastName;
		$profLink  = $userData->publicProfileUrl; 
		$headline  = $userData->headline;
		$userId    = $userData->id;

		$isMember  = checkForMembership($userId);
		insertUserInfo($isMember, $userData);
		
		$hasUser  = "<div id='".$userId."' style='text-align: center;'>";
		$hasUser .= "<img 'Linkedin.com User Profile Image' style='padding-bottom: 10px' src='".$userImage."' />";
		
		$hasUser .= "<p>";
			
		$hasUser .= "<a href='javascript: getProfile(\"".$userId."\");'";
		$hasUser .= "style='border-radius: 2px;";
		$hasUser .= "background-color: #11ad40; font-weight: bold;";
		$hasUser .= "font-size: 0.8em; color: #FFFFFF; padding: 2px 5px;'>";
		$hasUser .= "Display Member Profile</a>";

		$hasUser .= "</p>";

		$hasUser .= "<p><a style='font-weight: bold;' href='".$profLink."' ";
		$hasUser .= "target='_blank'>".$firstname." ".$lastname."</a><br>";

		$hasUser .= $headline."</p><img alt='Linkedin.com Logo' src='img/in14.png' />&nbsp;<a href='?logout=1' ";
		$hasUser .= "style='text-decoration: none; border-radius: 2px; ";
		$hasUser .= "background-color: #0077B5; font-weight: bold; ";
		$hasUser .= "font-size: 0.8em; color: #FFFFFF; padding: 1px 1px;'>";
		$hasUser .= "Sign out of LinkedIn&nbsp;</a></div>";

		echo $hasUser;
	}
	else
	{
		$_SESSION["VISITS"] = 0;

		$noUserImage = "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_80x80_v1.png";

		$noUser      = "<div style='text-align: center;'><img alt='No User Profile Image Available' style='padding-bottom: 10px;' src='".$noUserImage;
		$noUser     .= "' /><p style='font-weight: bold;'>Sign-in using LinkedIn<br>to access<br>UASPSE Community</p>";
		$noUser     .= "<img alt='Linkedin.com Logo' src='img/in14.png' />&nbsp;<a href='?oauth=1' ";
                $noUser     .= "style='border-radius: 2px; ";
                $noUser     .= "background-color: #0077B5; font-weight: bold; ";
                $noUser     .= "font-size: 0.8em; color: #FFFFFF; padding: 1px 1px;'>";
                $noUser     .= "Sign-in using LinkedIn&nbsp;</a></div>";

		echo $noUser;
	}
?>
