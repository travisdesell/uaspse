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
	require_once("/var/www/html/php_scripts/logout.php");

	$redirHost =  $_SERVER['HTTP_HOST'];
	$redirPath =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);  
	
	if(isset($_GET["lastpage"])) header('Location: '.$_SESSION["LASTPAGE"]);
	elseif(isset($_GET["oauth"])) authenticate($_GET, $response_type, $client_id, $redirect_uri, $scope);
	elseif(isset($_GET["state"]) == 1 && $_GET["state"] ==  $_SESSION['LNK_STATE'] && isset($_GET["code"]) == 1) getAccessKey($_GET, $redirect_uri, $client_id, $client_secret);
	elseif(isset($_GET["error"])) handleError($_GET);
	elseif(isset($_GET["logout"])) logout($redirect_uri);
	elseif(isset($_GET["profile"])) profilePage($_GET["profile"]);
	elseif(isset($_GET["list"])) listAllProfiles($_GET["list"]);
	elseif(isset($_GET["remove"])) removeProfile($_GET["remove"]);
	elseif(isset($_POST["event_title"])) updateEvents($_POST);
	elseif($redirPath == "/authorized.php") header('Location:https://'.$redirHost);


	function redirect_script()
	{
		echo '<div class="col-sm-8">';
		echo "<script>window.location='https://".$_SERVER['HTTP_HOST']."/events.php';</script>";
		echo '</div>';
	}

	function updateEvents($values)
	{
		if($_SERVER["PHP_SELF"] == "/events.php" && isset($_SESSION["ACCESS_TOKEN"]) == true && isset($_SESSION["USERDATA"]) == true)
		{

			$isAdmin = getIsAdmin();
			if($isAdmin)
			{
				//event_title
				//swd
				//spotlight
				//additional
				//location
				//register
				//linktype
				//makelive
				//date_beg_1, date_beg_2, date_beg_3
				//date_end_1, date_end_2, date_end_3
				//id

				$db1 = $values["date_beg_1"];
				$db2 = $values["date_beg_2"];
				if(intval($db2) < 10) $db2 = "0".intval($db2);
				$db3 = $values["date_beg_3"];
				if(intval($db3) < 10) $db3 = "0".intval($db3);
				$start = $db3."-".$db1."-".$db2;
				$de1 = $values["date_end_1"];
				$de2 = $values["date_end_2"];
				if(intval($de2) < 10) $de2 = "0".intval($de2);
				$de3 = $values["date_end_3"];
				if(intval($de3) < 10) $de3 = "0".intval($de3);
				$stop = $de3."-".$de1."-".$de2;

				$title = $values["event_title"];
				$swd = $values["swd"];
				$spotlight = $values["spotlight"];
				$addition = $values["addition"];
				$location = $values["location"];
				$rlink = $values["register"];
				$ltype = $values["linktype"];
				$id = $values["id"];
				$live = $values["makelive"];

				$cmd = "";
				if(getIsEvent($id))
				{
					$cmd  = "UPDATE events SET ";
					$cmd .= "title='".$title."',"; 
					$cmd .= "swd='".$swd."',"; 
					$cmd .= "spotlight='".$spotlight."',";
					$cmd .= "addition='".$addition."',";
					$cmd .= "location='".$location."',";
					$cmd .= "rlink='".$rlink."',";
					$cmd .= "ltype=".$ltype.",";
					$cmd .= "live=".$live.",";
					$cmd .= "db1='".$db1."',";
					$cmd .= "db2='".$db2."',";
					$cmd .= "db3='".$db3."',";
					$cmd .= "start='".$start."',";
					$cmd .= "de1='".$de1."',";
					$cmd .= "de2='".$de2."',";
					$cmd .= "de3='".$de3."',";
					$cmd .= "stop='".$stop."' ";
					$cmd .= "WHERE id=".$id;
				}
				else
				{
					$cmd  = "INSERT INTO events (title,swd,spotlight,addition,location,rlink,ltype,id,live,db1,db2,db3,";
					$cmd .= "start,de1,de2,de3,stop) VALUES (";
					$cmd .= "'".$title."',";
					$cmd .= "'".$swd."',";
					$cmd .= "'".$spotlight."',";
					$cmd .= "'".$addition."',";
					$cmd .= "'".$location."',";
					$cmd .= "'".$rlink."',";
					$cmd .= $ltype.",";
					$cmd .= $id.",";
					$cmd .= $live.",";
					$cmd .= "'".$db1."',";
					$cmd .= "'".$db2."',";
					$cmd .= "'".$db3."',";
					$cmd .= "'".$start."',";
					$cmd .= "'".$de1."',";
					$cmd .= "'".$de2."',";
					$cmd .= "'".$de3."',";
					$cmd .= "'".$stop."'";
					$cmd .= ")";
				}


				$dbase = opendb();
				if($dbase)
				{
					error_log($cmd);
					$dbase->query($cmd);
					$dbase->close();
				}
			}	
		}
	}


	function getEventInfo($tid)
	{
		if(getIsEvent($tid))
		{
			$dbase = opendb();
			if($dbase)
			{
				$cmd = "SELECT * FROM events WHERE id=".$tid;
				if($result = $dbase->query($cmd))
				{
					$row = $result->fetch_object();
					$dbase->close();
					return $row;
				}
				else return null;
			}
			else return null;
		}
		else return null;
	}

	function getIsEvent($tid)
	{
		$isEvent = false;
		$dbase = opendb();

		if($dbase)
		{
			$cmd = "SELECT id FROM events WHERE id=".$tid;
			if($result = $dbase->query($cmd))
			{
				$row = $result->fetch_object();
				if($row->id == $tid) $isEvent = true;
			}
			$dbase->close();
		}

		return $isEvent;
	}

	function getIsAdmin()
	{
		$userData = json_decode($_SESSION["USERDATA"]);
		$isAdmin = false;
		
		$dbase = opendb();
		if($dbase)
		{
			$cmd = "SELECT admin FROM profiles WHERE id='".$userData->id."'";
			if($result = $dbase->query($cmd));
			{
				$row = $result->fetch_object();
				if($row->admin == 1) $isAdmin = true;
			}
			$dbase->close();
		}
		return $isAdmin;
	}

	function listAllProfiles($lst)
	{
		$json = '{"error":"not_authenticated","hasError":false}';

		//$pv is $_GET["profile"]
		if($_SERVER["PHP_SELF"] == "/community.php" && $lst == 1 && isset($_SESSION["ACCESS_TOKEN"]) == true)
		{
			$dbase = opendb();
			if($dbase)
			{
				$allProfs = array();
				$cmd = "SELECT * FROM profiles ORDER by lastName ASC";
				if($result = $dbase->query($cmd))
				{
					$tnum = $result->num_rows;
					for($i=0; $i<$tnum; $i++)
					{
						$row  = $result->fetch_object();
						$allProfs[$i] = unserialize($row->profile);
					}
					$json = json_encode($allProfs);
				} else $json = '{"error":"database_no_data_found","hasError":false}';
	
				$dbase->close();
			}
			else $json = '{"error":"database_conn_failure","hasError":false}';
		}

		echo $json;
		exit();
	}

	function profilePage($pv)
	{
		$json = '{"error":"not_authenticated","hasError":false}';

		//$pv is $_GET["profile"]
		if($_SERVER["PHP_SELF"] == "/community.php" && isset($_SESSION["ACCESS_TOKEN"]) == true)
		{
			$dbase = opendb();
			if($dbase)
			{
				$cmd = "SELECT * FROM profiles WHERE id = '".$pv."'";
				if($result = $dbase->query($cmd))
				{
					$row  = $result->fetch_object();
					$prof = unserialize($row->profile);
					$json = json_encode($prof);
				} else $json = '{"error":"database_no_data_found","hasError":false}';
				$dbase->close();
			}
			else $json = '{"error":"database_conn_failure","hasError":false}';
		}

		echo $json;
		exit();
	}

	function removeProfile($mid)
	{
		$hasUserInfo = false;
		$isa = checkAuthorized();
		if($isa == true && $_SESSION["USERDATA"] !== null && isset($_SESSION["USERDATA"]) == true) $hasUserInfo = true;
		if($hasUserInfo == true)
        	{
			$userData = json_decode($_SESSION["USERDATA"]);
			if( $mid == $userData->id)
			{
				$dbase = opendb();
				if($dbase)
				{
					$sql="DELETE FROM profiles WHERE id='".$mid."'";
					$dbase->query($sql);
					$dbase->close();
					logout($_SESSION["LASTPAGE"]);
				}
			}
		}
	}

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
			$_SESSION['LNK_STATE'] = stateHash();
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
/*
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
*/
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
		if(isset($_SESSION["VISITS"]))
		{
			if($_SESSION["VISITS"] == 0)
			{
				$dbase = opendb();
				$iucmd  = "";
	
				$uid        = mysqli_real_escape_string($dbase, $ui->id);
				$fName      = mysqli_real_escape_string($dbase, $ui->firstName);
				$lName      = mysqli_real_escape_string($dbase, $ui->lastName);
				$headline   = mysqli_real_escape_string($dbase, $ui->headline);
				$picUrl     = mysqli_real_escape_string($dbase, $ui->pictureUrl);
				error_log("Here is the PIC URL: ".$picUrl);
				$pubProfUrl = mysqli_real_escape_string($dbase, $ui->publicProfileUrl);
				$emailAdd   = mysqli_real_escape_string($dbase, $ui->emailAddress);

				$s = mysqli_real_escape_string($dbase, serialize($ui));

				if($im)
				{
					$iucmd .= "UPDATE profiles SET ";
					$iucmd .= "firstName = '".$fName."', ";
					$iucmd .= "lastName = '".$lName."', ";
					$iucmd .= "headline = '".$headline."', ";
					$iucmd .= "pictureUrl = '".$picUrl."', ";
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
			
				$_SESSION["VISITS"] = 1;
				$dbase->close();
			}
			else error_log("User Profile already updated this session for: ".$ui->firstName." ".$ui->lastName);
		}
	}

	function removeProfileFromDBI($id)
	{
	}
?>
