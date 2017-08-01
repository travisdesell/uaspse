<?php
//
	if (session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}

	/*	OAuth2 Variables for LinkedIn API found in basicdata.php - not kept in this file so this can be uploaded to github
		$response_type
		$client_id
		$client_secret
		$redirect_uri
		$scope

		Also includes the stateHash function.
	*/
	require_once("/var/www/html/php_scripts/basicdata.php");

	$redirHost =  $_SERVER['HTTP_HOST'];
	$redirPath =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);  
	
	if(isset($_GET["lastpage"])) header('Location: '.$_SESSION["LASTPAGE"]);
	elseif(isset($_GET["oauth"])) authenticate($_GET, $response_type, $client_id, $redirect_uri, $scope);
	elseif(isset($_GET["state"]) == 1 && $_GET["state"] ==  $_SESSION['LNK_STATE'] && isset($_GET["code"]) == 1) getAccessKey($_GET, $redirect_uri, $client_id, $client_secret);
	elseif(isset($_GET["error"])) handleError($_GET);
	elseif(isset($_GET["logout"])) logout($redirect_uri);
	elseif(isset($_GET["register"])) registerProfile();
	elseif($redirPath == "/authorized.php") header('Location:https://'.$redirHost);

	function handleError($errvals)
	{
		//errvals is $_GET
		return;
	}

	function authenticate($values, $rt, $ci, $ru, $sp)
	{
		//$values is $_GET
		//$rt is Response Type
		//$ci is Client ID
		//$ru is Redirect URI
		//$sp is Scope
		$oAuth = intval(trim($values["oauth"]));
		if($oAuth == 1)
		{
			$_SESSION['LNK_STATE'] = stateHash(22);
			$oauthurl="https://www.linkedin.com/oauth/v2/authorization?response_type=".$rt;
			$oauthurl.="&client_id=".$ci;
			$oauthurl.="&redirect_uri=".$ru;
			$oauthurl.="&state=".$_SESSION['LNK_STATE'];
			$oauthurl.="&scope=".$sp;
			header('Location:'.$oauthurl);
			return;
		}
		else
		{
			echo "PHP ERROR";
			return;
		}

	}

	function checkAuthorized()
	{
		if(isset($_SESSION['ACCESS_TOKEN']))
		{

			//$at is access token
			$authrequrl = "https://api.linkedin.com";
			$resources  = "/v1/people/~:(id,first-name,last-name,formatted-name,phonetic-first-name,";
			$resources .= "phonetic-last-name,headline,location,current-share,num-connections,";
			$resources .= "num-connections-capped,summary,specialties,positions,picture-url,";
			$resources .= "public-profile-url,email-address)?";

			$params = array(
				'oauth2_access_token'=>$_SESSION['ACCESS_TOKEN'],
				'format'=>'json'
			);

			$authrequrl = $authrequrl.$resources.http_build_query($params);
			$options = array(
				'http' => array(
					'header' => 'Content-Type: application/json',
					'method' => 'GET',
				)
			);
			$context = stream_context_create($options);
			$response = file_get_contents($authrequrl, false, $context);
	
			$_SESSION["USERDATA"] = $response;

			if($response !== null)
			{
				return true;
			}
			else
			{
				$_SESSION["USERDATA"] = null;
				$_SESSION["ACCESS_TOKEN"] = null;
				return false;
			}
		}
		else
		{
			$_SESSION["USERDATA"] = null;
			$_SESSION["ACCESS_TOKEN"] = null;
			return false;
		}
	}

	function grabMembershipData($ast)
	{
		//$ast means return as text and is an 'int' value, either 1 or 0
		if(isset($_SESSION['ACCESS_TOKEN']))
		{
			//$at is access token
			$authrequrl = "https://api.linkedin.com";
			$resources  = "/v1/people/~:(id,first-name,last-name,formatted-name,phonetic-first-name,";
			$resources .= "phonetic-last-name,headline,location,current-share,num-connections,";
			$resources .= "num-connections-capped,summary,specialties,positions,picture-url,";
			$resources .= "public-profile-url,email-address)?";

			$params = array(
				'oauth2_access_token'=>$_SESSION['ACCESS_TOKEN'],
				'format'=>'json'
			);

			$authrequrl = $authrequrl.$resources.http_build_query($params);
			$options = array(
				'http' => array(
					'header' => 'Content-Type: application/json',
					'method' => 'GET',
				)
			);
			$context = stream_context_create($options);
			$response = file_get_contents($authrequrl, false, $context);
			if($ast == 1) return $response;
			else return json_decode($response);
		}
		else return null;	
	}

	function getAccessKey($getval, $ru, $ci, $cs)
	{
		//$getval is $_GET
		//$ru is Redirect URI
		//$ci is Client ID
		//$cs is Client Secret
		$oaURL = "https://www.linkedin.com/oauth/v2/accessToken";
		$ctPost = array(
			'grant_type' => 'authorization_code',
			'code' => $getval['code'],
			'redirect_uri' => $ru,
			'client_id' => $ci,
			'client_secret' => $cs
		);

		// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => 'Authorization',
				'method'  => 'POST',
				'content' => http_build_query($ctPost)
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($oaURL, false, $context);
		if ($result === false) { /* Handle error */ }

		$token = json_decode($result);
		//Temporarily Commenting out JSON Response
		$_SESSION["ACCESS_TOKEN"] = $token->access_token;
		$_SESSION["EXPIRES_IN"] = $token->expires_in;
		$_SESSION["EXPIRES_AT"] = time() + $_SESSION["EXPIRES_IN"];
		$_SESSION["LOGGEDOUT"] = null;
		header("Location: ".$_SESSION["LASTPAGE"]);
		return;
	}

	function logout($ru)
	{
		$_SESSION = array();
		if (ini_get("session.use_cookies"))
		{
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
		session_destroy();
		header("Location: https://www.linkedin.com/m/logout");
	}

	function opendb()
	{
		$dbase = new mysqli($GLOBALS['dbase_host'], $GLOBALS['dbase_user'], $GLOBALS['dbase_pass']);
		$dbase->select_db($GLOBALS['dbase_name']);
		
		return $dbase;
	}

	function checkForMembership($userId)
	{
		//$userId is the verified id of the current logged in user
		$dbase = opendb();
		
		$idFound = false;

		if($dbase !== false) 
		{
			$cmd = "SELECT id FROM profiles WHERE id = '".$userId."'";

			if($result = $dbase->query($cmd))
			{
				$row = $result->fetch_row();
				if($row[0] == $userId) $idFound = true;
			}
			else
			{
				error_log("Result returned false");
			}
			
		}
		else
		{
			error_log("======================================");
			error_log("DB NOT OPEN");
			error_log("======================================");
		}

		$dbase->close();
		return $idFound;
	}

	function insertUserInfo($im, $ui)
	{
		$dbase = opendb();
		$iucmd  = "";
	
		$uid        = mysqli_real_escape_string($dbase, $ui->id);
		$fName      = mysqli_real_escape_string($dbase, $ui->firstName);
		$lName      = mysqli_real_escape_string($dbase, $ui->lastName);
		$headline   = mysqli_real_escape_string($dbase, $ui->headline);
		$picUrl     = mysqli_real_escape_string($dbase, $ui->pictureUrl);
		$pubProfUrl = mysqli_real_escape_string($dbase, $ui->publicProfileUrl);
		$emailAdd   = mysqli_real_escape_string($dbase, $ui->emailAddress);

		$s = mysqli_real_escape_string($dbase, serialize($ui));

		if($im)
		{
			$iucmd .= "UPDATE profiles SET ";
			$iucmd .= "firstName = '".$fName."', ";
			$iucmd .= "lastName = '".$lName."', ";
			$iucmd .= "headline = '".$headline."', ";
			$iucmd .= "pictureUrl = '".$pictureUrl."', ";
			$iucmd .= "publicProfileUrl = '".$pubProfUrl."', ";
			$iucmd .= "emailAddress = '".$emailAdd."', ";
			$iucmd .= "profile = '".$s."' ";
			$iucmd .= "WHERE id = '".$uid."'";
		}
		else
		{
			$iucmd .= "INSERT INTO profiles (id, firstName, lastName, headline, ";
			$iucmd .= "pictureUrl, publicProfileUrl, emailAddress, profile) ";
			$iucmd .= "VALUES ('".$uid."', '".$fName."', '".$lName."', '".$headline."', '".$picUrl."', '";
			$iucmd .= $pubProfUrl."', '".$emailAdd."', '".$s."')";
		}

		$dbase->query($iucmd);
		$dbase->close();
	}

	function removeProfileFromDBI($id)
	{
	}
?>
