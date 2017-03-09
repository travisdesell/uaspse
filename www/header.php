<?php

function print_header($page_title, $additional_scripts = "") {
    echo "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
        <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>

            <title>$page_title</title>

            <!-- Latest compiled and minified CSS -->
            <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <!-- <link rel='stylesheet' href='./css/bootstrap-slate.min.css'> -->

            <!-- Optional theme
            <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css'>
            -->

            <!-- Custom styles for this template -->
            <link href='css/custom.css' rel='stylesheet'>
            <link href='css/navbar-fixed-top.css' rel='stylesheet'>

            <!-- jQuery (required by Bootstrap's JavaScript plugins) -->
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>


            <!-- Google Charts API -->
            <script type=\"text/javascript\" src=\"https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['timeline']}]}\"></script>

            <!-- Latest compiled and minified JavaScript -->
            <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

            $additional_scripts
        </head>
        <body>";
}

?>
