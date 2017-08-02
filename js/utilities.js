function getProfile(ui)
{

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			var pdiv = document.getElementById("pdiv");
			if(pdiv != null)
			{
				var data = JSON.parse(this.responseText);
				
				if(data.hasError == null)
				{
					var html  = "<div class='well'>";
					    html += "<table><tr>";
					    html += "<td style='vertical-align: top; padding-top: 5px; padding-left: 5px; ";
					    html += "padding-bottom: 5px; padding-right: 10px; text-align: left;'><img alt='Image of ";
					    html += data.firstName + " " + data.lastName + "' style='height:80px; text-align:left;' src='" + data.pictureUrl + "' />";
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
					    html += "<a href='https://" + window.location.host + "/?delete=" + data.id + "'>Delete UASPSE Account</a></p>";
					}

					html += "</td></tr></table>";
					html += "</div>";
	
					pdiv.innerHTML = html;
					$('#profModal').modal({show:false});
					$('#profModal').modal('show');
				}
			}
		}
	};

	var ajaxURL = "https://" + window.location.host + "/community.php?profile=" + ui;
	console.log(ajaxURL);

	xhttp.open("GET", ajaxURL, true);
	xhttp.send();

//var ajaxURL = "https://" + window.location.host + "/community.php?profile=" + ui;
//console.log(ajaxURL);
}
