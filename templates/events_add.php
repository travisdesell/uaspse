<?php
$hasUserInfo = false;
if($isAuthorized == true && $_SESSION["USERDATA"] !== null && isset($_SESSION["USERDATA"]) == true) $hasUserInfo = true;

if($hasUserInfo)
{
	$isAdmin = getIsAdmin();
	if($isAdmin == true)
	{
		if(isset($_GET["addevent"])) require('templates/events_add_form.php');
		else if(isset($_GET["edit"])) require('templates/events_edit_form.php');
		else redirect_script();
	}
	else redirect_script();
}
else redirect_script();

function getNewId()
{
	$dbase = opendb();

	$value = -1;
	$cmd = "SELECT id FROM events ORDER by id DESC";
	$result = $dbase->query($cmd);

	if($result)
	{
		if($result->num_rows !== 0)
		{
			$row = $result->fetch_object();
			$value = $row->id + 1;
		}
		else $value = 0;
	}
	else $value = -2;

	return $value;
}

?>
