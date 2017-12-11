<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

//check the session
if (session_status() == PHP_SESSION_NONE) session_start();
$_SESSION["LASTPAGE"] = $_SERVER['PHP_SELF'];
require("authorized.php");

$isAuthorized = checkAuthorized();
$account_info = array();

if ($isAuthorized) {
    $userdata = json_decode($_SESSION["USERDATA"]);
    $id = $userdata->id;

    //make sure the ID of the submitting webpage is the as the ID for the session, otherwise someone
    //may be trying to mess with another person's data

    $dbase = opendb();
    $submitter_id = mysqli_real_escape_string($dbase, $_POST["userid"]);

    error_log("id: $id, submitter_id: $submitter_id");

    if ($submitter_id != $id) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Invalid User Id. Please reload the page and try again.')));
    }

    if ($dbase) {
        if (isset($_POST['subscribe'])) {
            $subscribe = $_POST['subscribe'];
            if ($subscribe == '0' || $subscribe == '1') {
                $cmd = "UPDATE profiles SET allowEmail = $subscribe WHERE id = '$id'";
                error_log("$cmd");
                $dbase->query($cmd);

                $response = array();
                if ($subscribe == '0') {
                    $response['html'] = "<p>The UASPSE team can occasionally send you emails involving UASPSE events and activities. We will not share your email address with third parties or email you without your permission. You can opt in to our emails with the following button.</p>
                        <button id='subscribeButton' type='button' class='btn btn-primary' href='https://digitalag.org/opt_in.php?id={{id}}'>Subscribe to UASPSE E-Mails</button>";
                } else if ($subscribe == '1') {
                    $response['html'] = "<p>You have subscribed to emails about UASPSE events and activities. You can unsubscribe at any time with the following button.</p>
                        <button id='unsubscribeButton' type='button' class='btn btn-danger' href='https://digitalag.org/opt_in.php?id={{id}}'>Unsubscribe from UASPSE E-Mails</button>";  
                }

                echo json_encode($response);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('message' => 'Invalid subscribe parameter. Please reload the page and try again.')));
            }
            $dbase->close();
        } else if (isset($_POST['keywords'])) {
            $keywords = mysqli_real_escape_string($dbase, $_POST['keywords']);
            $cmd = "UPDATE profiles SET keywords = '$keywords' WHERE id = '$id'";
            error_log("$cmd");
            $dbase->query($cmd);
        }

    } else {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Could not connect to the database. Please reload the page and try again.')));
    }
} else {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'User is not logged in. Session may have expired. Please reload the page, log in and try again.')));
}
?>
