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
	require_once("../php_scripts/basicdata.php");

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
			$cURL = "https://api.linkedin.com/v1/people/~:(id,first-name,last-name,headline,public-profile-url,picture-url)?oauth2_access_token=".$_SESSION['ACCESS_TOKEN']."&format=json";
			$options = array(
				'http' => array(
					'header' => 'Content-Type: application/json',
					'method' => 'GET',
				)
			);
			$context = stream_context_create($options);
			$response = file_get_contents($cURL, false, $context);
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
		if ($result === FALSE) { /* Handle error */ }

		$token = json_decode($result);
		//Temporarily Commenting out JSON Response
		$_SESSION["ACCESS_TOKEN"] = $token->access_token;
		$_SESSION["EXPIRES_IN"] = $token->expires_in;
		$_SESSION["EXPIRES_AT"] = time() + $_SESSION["EXPIRES_IN"];
		$_SESSION["LOGGEDOUT"] = null;
//		echo $result;
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
		$dbase = mysqli_connect($GLOBALS['dbase_host'], $GLOBALS['dbase_user'], $GLOBALS['dbase_pass'] );
		$dbf = mysqli_select_db($dbase, $GLOBALS['dbase_name']);
		$darr = array();
		$darr[0] = $dbf;
		$darr[1] = $dbase;
		return $darr;
	}

	function closedb($dbase)
	{
		mysqli_close($dbase);	
	}

	function checkForMembership($userId)
	{
		//$userId is the verified id of the current logged in user
		$darr = opendb();
		$dbf = $darr[0];
		$dbase = $darr[1];
		
		$idFound = false;
		if($dbf) 
		{
			$cmd = "SELECT id FROM profile";
			$result = mysqli_query($dbase, $cmd);
			while($row=mysqli_fetch_assoc($result))
			{
				$idFound = in_array($userId, $row);
				if($idFound == true) break;
			}
		}
		closedb($dbase);

		return $idFound;
	}

	function idExists($cmd, $id)
	{
		$isThere = false;

		return $isThere;
	}

	function registerProfile()
	{
		$userText = grabMembershipData(1);
		$userProf = json_decode($userText);
		
		if($userProf !== null)
		{
			$darr = opendb();
			$dbf = $darr[0];
			$dbase = $darr[1];
			if($dbf)
			{
				$iucmd  = "INSERT INTO profiles (id, firsName, lastName, headline, summary, pictureUrl, publicProfileUrl, emailAddress, profile) ";
	
	
				$uid = $userProf->id;
				$fName = $userProf->firstName;
				$lName = $userProf->lastName;
				$headline = $userProf->headline;
				$summary  = $userProf->summary;
				$picUrl   = $userProf->pictureUrl;
				$pubProfUrl = $userProf->publicProfileUrl;
				$emailAdd = $userProf->emailAddress;

				$iuVals = "VALUES ('".$uid."', '".$fName."', '".$lName."', '".$headline."', '".$summary."', '".$picUrl."', '".$pubProfUrl."', '".$emailAdd."', ".$userProfile.")";

				$iucmd .= $iuVals;
				$dbase->query($iucmd);
			}
			closedb($dbase);
		}
		else print($userText);
		
		error_log("This is userText: ".$userText, 0);
	}

	function unRegisterProfile()
	{
	}
?>
