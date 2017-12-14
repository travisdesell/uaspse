
function enableSubscribeButton() {
    $("#subscribeButton").click(function(event) {
        console.log("clicked subscribe button!");

        $.ajax({
            type: 'POST',
            url: 'update_account.php',
            data : {
                subscribe : 1,
                userid : $("#accountEmailContent").attr("userid")
            },
            dataType : 'json',
            success : function(response) {
                $("#accountEmailContent").html(response.html);
                enableUnsubscribeButton();
            },
            error : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(jqXHR.responseJSON.message);
                console.log(textStatus);
                $("#errorModalLabel").text(errorThrown);
                $("#errorModalText").text(jqXHR.responseJSON.message);
                $("#errorModal").modal();
            },
            async: true
        });
    });
}

function enableUnsubscribeButton() {
    $("#unsubscribeButton").click(function(event) {
        $.ajax({
            type: 'POST',
            url: 'update_account.php',
            data : {
                subscribe : 0,
                userid : $("#accountEmailContent").attr("userid")
            },
            dataType : 'json',
            success : function(response) {
                $("#accountEmailContent").html(response.html);
                enableSubscribeButton();
            },
            error : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(jqXHR.responseJSON.message);
                console.log(textStatus);

                $("#errorModalLabel").text(errorThrown);
                $("#errorModalText").text(jqXHR.responseJSON.message);
                $("#errorModal").modal();
            },
            async: true
        });
    });
}

$(document).ready(function() {  
    $(".toggler").click(function(event) {
        var text = $(this).html();

        console.log("clicked a toggler, text is '" + text + "'");

        if (text === "show") {
            $(this).html("hide");
        } else {
            $(this).html("show");
        }
    });

    $("#submitKeywordsButton").click(function(event) { 
        var keywords = $("#keywordsInput").val();
        console.log("keywords are: " + keywords);

        if (keywords !== '') {
            $.ajax({
                type: 'POST',
                url: 'update_account.php',
                data : {
                    keywords : keywords,
                    userid : $("#accountEmailContent").attr("userid")
                },
                dataType : 'text',
                success : function(response) {
                    $("#submitKeywordsButton").html("Update");
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(jqXHR.responseJSON.message);
                    console.log(textStatus);

                    $("#errorModalLabel").text(errorThrown);
                    $("#errorModalText").text(jqXHR.responseText.message);
                    $("#errorModal").modal();
                },
                async: true
            });
        }

        event.preventDefault(); 
    }); 

    enableSubscribeButton();
    enableUnsubscribeButton();

});


var vImage = "https://static.licdn.com/scds/common/u/images/themes/katy/ghosts/person/ghost_person_80x80_v1.png";

function proceedToLinkedIn()
{
    var tVal = ""+window.location;
    var array = tVal.split('?');
    console.log("setting window.location to: '" + array[0] + "?oauth=1");
    window.location = array[0] + "?oauth=1";
}

function updateKeywords() {
}

/*
function checkURL(url) {
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

//function checkURL(url) {
//	var txt = "" + url;
//	return(txt.match(/\.(jpeg|jpg|gif|png)$/) != null);
//}

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
					console.log(data[i].pictureUrl);
					html += "<p style='font-weight: bold;'><img id='img_list_" + data[i].id + "' alt='Image of ";
					var tempimg = "" + data[i].pictureUrl;
					if(tempimg == "undefined") tempimg = vImage;
					html += data[i].firstName + " " + data[i].lastName + "' style='height:48px;' src='" + tempimg + "' /> ";
					html += data[i].firstName + " " + data[i].lastName + " - <a href='javascript: closeGetProfile(\"" + data[i].id + "\");'>View Profile</a></p>";
					html += "<script>$('img_user_" + data[i].id +"').load(function(){console.log('loaded');}).error(function(){$('img_user_"+ data[i].id+"').attr('src', '"+ vImage +"'});</script>";
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

                console.log("response from getProfile was:");
                console.log(data);
				
				if(data.hasError == null)
				{
					var html  = "<div class='well'>";
					    html += "<table><tr>";
					    html += "<td style='vertical-align: top; padding-top: 5px; padding-left: 5px; ";
					    html += "padding-bottom: 5px; padding-right: 10px; text-align: left;'><img id='img_user_" + data.id + "' alt='Image of ";
					    var tempimg = "" + data.pictureUrl;
					    if(tempimg == "undefined") tempimg = vImage;
					    html += data.firstName + " " + data.lastName + "' style='height:80px; text-align:left;' src='" + tempimg + "' />";
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
					html += "<script>$('img_user_" + data.id +"').load(function(){console.log('loaded');}).error(function(){$('img_user_"+ data.id+"').attr('src', '"+ vImage +"'});</script></div>";	
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
    console.log("window.location.host: " + window.location.host);

	xhttp.open("GET", ajaxURL, true);
	xhttp.send();

//var ajaxURL = "https://" + window.location.host + "/community.php?profile=" + ui;
//console.log(ajaxURL);
}
