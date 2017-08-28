function preLoginInfo()
{
	var pdiv = document.getElementById("pdiv");
	var tspn = document.getElementById("uaspse_title");

	tspn.innerHTML = "Notice about LinkedIn Profile Information";
	
	var body  = "<p><span style='font-weight: bold;'>Data Collection</span><br>Using your LinkedIn credentials to create a UASPSE Member Account will give ";
	    body += "DigitalAg.org access to all the information in your linked in profile. By clicking ";
	    body += "the 'Proceed' button, you authorize DigitalAg.org to collect this information and ";
	    body += "store it in a database.<br> <br><span style='font-weight: bold;'>Data Removal</span><br>To remove your LinkedIn profile information from ";
	    body += "the DigitalAg.org database and disenroll as a UASPSE Member, click the 'Remove UASPSE ";
	    body += "Account' located on your UASPSE Member Profile. Doing so will perminently remove your LinkedIn ";
            body += "data from the database. You may re-join the UASPSE Membership at any time.<br> <br><span style='font-weight: bold'>";
	    body += "For what purpose will my data be used?</span><br>DigitalAg.org will use this data to identify and suggest potential partnerships ";
	    body += "and disseminate project information to UASPSE Members.<br> <br><span style='font-weight: bold;'>Do you wish to proceed?</span></p>";
	    body += "<p>";
	    body += "<a style='border-radius: 5px; background-color: #c6b535; font-weight: bold; font-size: 1.0em; color: #FFFFFF; padding: 3px 3px; ";
	    body += "border-style: solid; border-color: #000000; border-width: 1px' href='javascript: doNotProceed();'>Cancel</a> &nbsp; ";
	    body += "<a style='border-radius: 5px; background-color: #23bc4a; font-weight: bold; font-size: 1.0em; color: #FFFFFF; padding: 3px 3px; ";
	    body += "border-style: solid; border-color: #000000; border-width: 1px' href='javascript: proceedToLinkedIn()'>Proceed</a></p>";

	pdiv.innerHTML = body;

	$('#profModal').modal({show:false});
	$('#profModal').modal('show');
}

function proceedToLinkedIn()
{
	var tVal = ""+window.location;
	var array = tVal.split('?');
	window.location = array[0] + "?oauth=1";
}

function doNotProceed()
{
	$('#profModal').modal('hide');
}

/*
function checkUrl(url) {
        var request = false;
        if (window.XMLHttpRequest) {
                request = new XMLHttpRequest;
        } else if (window.ActiveXObject) {
                request = new ActiveXObject("Microsoft.XMLHttp");
        }

        if (request) {
                request.open("GET", url);
                if (request.status == 200) { return true; }
        }

        return false;
}
*/

function checkURL(url) {
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

function listAllMembers()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var pdiv = document.getElementById("swpdiv");
			var tspn = document.getElementById("swuaspse_title");
			


			tspn.innerHTML = "All UASPSE Member Profiles";

			var data = JSON.parse(this.responseText);
				
			if(data.hasError == null)
			{
				var html = "<div style='height: 400px; overflow: auto; margin: 0px; padding: 0px;'>";
				for(i=0;i<data.length;i++)
				{
					var tImage = "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_80x80_v1.png";
					if(checkURL(data[i].pictureUrl)) tImage = data[i].pictureUrl;
					html += "<p style='font-weight: bold;'><img alt='Image of ";
					html += data[i].firstName + " " + data[i].lastName + "' style='height:48px;' src='" + tImage + "' /> ";
					html += data[i].firstName + " " + data[i].lastName + " - <a href='javascript: closeGetProfile(\"" + data[i].id + "\");'>View Profile</a></p>";
				}
				pdiv.innerHTML = html + "</div>";
			}
			else
			{
				pdiv.innerHTML = "<p>Sorry, you must be logged into your UASPSE Member account in order to view the entire UASPSE Member list.<p>";
			}
			$('#swModal').modal({show:false});
			$('#swModal').modal('show');
		}
	};

	var ajaxURL = "https://" + window.location.host + "/community.php?list=1";

	xhttp.open("GET", ajaxURL, true);
	xhttp.send();
}

function closeGetProfile(ui)
{
	$('#swModal').on('hidden', getProfile(ui));
	$('#swModal').modal('hide');
}

function clearBodyPadding()
{
	document.body.style.paddingRight = '0px';
}

function getProfile(ui)
{

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var pdiv = document.getElementById("pdiv");
			var tspn = document.getElementById("uaspse_title");
			
			if(pdiv != null)
			{
				var data = JSON.parse(this.responseText);
				
				if(data.hasError == null)
				{
					var html  = "<div class='well'>";
					    html += "<table><tr>";
					    html += "<td style='vertical-align: top; padding-top: 5px; padding-left: 5px; ";
					    html += "padding-bottom: 5px; padding-right: 10px; text-align: left;'><img alt='Image of ";

					    var tImage = "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_80x80_v1.png";
					    if(checkURL(data[i].pictureUrl)) tImage = data[i].pictureUrl;
	
					    html += data.firstName + " " + data.lastName + "' style='height:80px; text-align:left;' src='" + tImage + "' />";
					    html += "<p style='text-align: center; font-weight: bold; font-size: small; ";
					    html += "padding-top: 5px;'><a href='mailto:" + data.emailAddress + "'>Send Email</a></p></td>";
					    html += "<td style='vertical-align: top; padding: 5px; text-align: left;'>";
					    html += "<p style='font-weight: bold; margin-bottom: 0px;'><span style='font-size: x-large'>";
					    html += data.firstName + " " + data.lastName + "</span>";
					    html += "<span style='font-size: medium'> - <a href='";
					    html += data.publicProfileUrl + "' target='_linkedin'>Linkedin Profile</a></span></p>";
					    html += "<p style='font-weight: bold; font-size: medium'>" + data.headline + "</p>";
					if(data.summary != null)
					{
					    html += "<p style='font-weight: bold; margin-bottom: 0px;'>Summary</p> <p ";
					    html += "style='font-size: small;'>" + data.summary + "</div></p>";
					}

					if(data.positions != null)
					{
					    var clen = data.positions._total;
					    if(clen > 0) html += "<p style='font-weight: bold; margin-bottom: 0px;'>Positions</p>";

					    var pos = data.positions.values;
					    for(var i=0; i<clen; i++)
					    {
					        html += "<p style='margin-bottom: 0px; margin-left: 25px; font-size: small;'>";
					        html += "<span style='font-weight: bold; '>" + pos[i].title + "</span></p>";
					        html += "<p style='margin-bottom: 0px;  margin-left: 25px; font-size: small;'>";
						html += "<span style='font-style: italic; font-size: small'>";
					        html += "<span style='font-weight: bold;'>Institution - </span>" + pos[i].company.name + "</span></p>";
					        if(pos[i].summary != null)
						{
							html += "<p style='margin-left: 25px; margin-bottom: 25px; font-size: small;'>";
							html += pos[i].summary + "</p>";
						}
					    }
					}
					
					var cid = "" + data.id;
					if(document.getElementById(cid) != null)
					{
					    html += "<p style='font-weight: bold; font-size: medium; text-align: right;'>";
					    html += "<a href='https://" + window.location.host + "/?remove=" + data.id + "'>Remove UASPSE Account</a></p>";
					}

					html += "</td></tr></table>";
					html += "</div>";
	
					tspn.innerHTML = "UASPSE Member Profile";
					pdiv.innerHTML = html;
					$('#profModal').on('hidden', clearBodyPadding());
					$('#profModal').modal({show:false});
					$('#profModal').modal('show');
				}
				else
				{

					tspn.innerHTML = "UASPSE Member Profile - Error";
					pdiv.innerHTML = "<p>Sorry, you must be logged into your UASPSE Member account in order to view UASPSE Member profiles.<p>";
					$('#profModal').on('hidden', clearBodyPadding());
					$('#profModal').modal({show:false});
					$('#profModal').modal('show');
				}
			}
		}
	};

	var ajaxURL = "https://" + window.location.host + "/community.php?profile=" + ui;

	xhttp.open("GET", ajaxURL, true);
	xhttp.send();

//var ajaxURL = "https://" + window.location.host + "/community.php?profile=" + ui;
//console.log(ajaxURL);
}
