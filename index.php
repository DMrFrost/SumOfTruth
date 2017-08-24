<!DOCTYPE html>
<html>
	<head>
		<title>SumOne</title>
    <meta charset="utf-8">

	</head>


	<body>
		<script>
			//This function checks to see if the client browser is currently using cookies
			//returns true if cookies are enabled
			function are_cookies_enabled(){
				var cookieEnabled = (navigator.cookieEnabled) ? true : false;
				if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled){
					document.cookie="testcookie";
					cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
				}
				return (cookieEnabled);
			}
			var cookie = are_cookies_enabled();


			function setCookie(cname, cvalue, exdays) {
		    var d = new Date();
		    d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+ d.toUTCString();
		    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}

			function getCookie(cname) {
			    var name = cname + "=";
			    var decodedCookie = decodeURIComponent(document.cookie);
			    var ca = decodedCookie.split(';');
			    for(var i = 0; i <ca.length; i++) {
			        var c = ca[i];
			        while (c.charAt(0) == ' ') {
			            c = c.substring(1);
			        }
			        if (c.indexOf(name) == 0) {
			            return c.substring(name.length, c.length);
			        }
			    }
			    return "";
			}
			var welcome = getCookie("welcome_cookie");


			//this will check if cookies are disabled and if client has visited the
			//welcome site before.  If either of these are the case user is directed to home
			//otherwise firstime cookie enabled users are directed to Welcome
			if(welcome || cookie === false){
				window.location = "home.php";
			}else{
				setCookie("welcome_cookie", true, 365);
				window.location = "welcome.html";
			}

		</script>



	</body>
</html>
