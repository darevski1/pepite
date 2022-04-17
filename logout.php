<?php session_start();

	require_once('./includes/db.php');
	require_once('./includes/config.php');

if(isset($_SESSION['user_id']))
	
	ConnectToDatabase();

	unset($_SESSION['user_id']);
	
	setcookie("uud", "", time() - 3600, "/", ".entreprendspourtoncampus.com/");

		?>
			

<!DOCTYPE html>
<html>
<head>
	<meta name="google-signin-client_id" content="931323747999-kmfmhkmbc4n7ab11teqvrbscj3n4pujt.apps.googleusercontent.com">
</head>
<body>

	
<script type="text/javascript">

	function onSuccess(googleUser) {
          
            var profile = googleUser.getBasicProfile();
           
            google_id = profile.getId()
            username = profile.getName()
            email = profile.getEmail()
        }
        function onFailure(error) {
          console.log(error);
        }

	function renderButton() {
          gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
          });
          signOut()
        }
	function signOut() {
          var auth2 = gapi.auth2.getAuthInstance();
          auth2.signOut().then(function () {
              window.location.replace("./connexion");
          });
        }

        // signOut();

        // window.location.replace("./connexion");

        function OnLoad(){
        	gapi.load('auth2', function() {
	            gapi.auth2.init().then(function(){
	                var auth2 = gapi.auth2.getAuthInstance();
	                auth2.signOut().then(function(){
              			window.location.replace("./connexion");
	                });
	            });

	        });
        }

</script>


	<script src="https://apis.google.com/js/platform.js?onload=OnLoad" async defer></script>
</body>
</html>

