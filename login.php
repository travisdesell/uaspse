<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

function print_login_modal($isAuthorized) {
    global $cwd;

    $login_info = array();

	$hasUserInfo = false;
	if($isAuthorized == true && $_SESSION["USERDATA"] !== null && isset($_SESSION["USERDATA"]) == true) $hasUserInfo = true;

	$userData = json_decode($_SESSION["USERDATA"]);

    if ($hasUserInfo == true && $userData->id !== null) {
        $user_info['user_image'] = $userData->pictureUrl;
        $user_info['firstname'] = $userData->firstName;
        $user_info['lastname'] = $userData->lastName;
        $user_info['prof_link'] = $userData->publicProfileUrl; 
        $user_info['headline'] = $userData->headline;
        $user_info['user_id'] = $userData->id;

        $login_info['user'] = $user_info;

        $isMember  = checkForMembership($userData->id);
        insertUserInfo($isMember, $userData);
    } else {
        $_SESSION["VISITS"] = 0;
    }

    $login_template = file_get_contents($cwd[__FILE__] . "/templates/login_modal.html");
    $m = new Mustache_Engine;
    echo $m->render($login_template, $login_info);
}

?>
