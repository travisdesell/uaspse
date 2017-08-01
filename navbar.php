<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class='navbar-brand' style='margin: 0px 0px 0px 0px; padding: 0px 5px 0px 0px;'><a href='/'><img alt='Digital Agriculture: Unmanned Aircraft Systems, Plant Sciences, and Educaiton - Project Logo' src='img/uaspse-48-nob.png' /></a></span><a class='navbar-brand' href="/">UASPSE</a></span>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="navbuttons">
<?php
	$arr = array();
	$purl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$classact= " class='active' ";

	if($purl == "/" || $purl == "/index.php") $arr[0] = $classact;
	else $arr[0] = "";

	if($purl == "/people.php") $arr[1] = $classact;
	else $arr[1] = "";

	if($purl == "/community.php") $arr[2] = $classact;
	else $arr[2] = "";
	
	if($purl == "/resources.php") $arr[3] = $classact;
	else $arr[3] = "";

	echo "<li".$arr[0]."><a href='/index.php'>Home</a></li>";
	echo "<li".$arr[1]."><a href='/people.php'>People</a></li>";
	if($isAuthorized)
	{
		echo "<li".$arr[2]."><a href='community.php'>Community</a></li>";
		echo "<li".$arr[3]."><a href='resources.php'>Resources</a></li>";
	}
?>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

