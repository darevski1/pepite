<?php session_start();?>
<?php
require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();

$table = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

$display = "none";
$error_message = "Wrong log in details";

if ($loged_in) {
    ?>
<script type="text/javascript">
window.location.replace("../");
</script>
<?php
} else {

    if (isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "") {

        $email = check_input($_POST['email']);
        $pass = check_input($_POST['password']);

        $login_id = CheckHashedPassword($pass, $email);

        if (is_numeric($login_id)) {

            $_SESSION['user_id'] = $login_id;

            if (isset($_POST['remember_me'])) {
                $expire_time = time() + 60 * 60 * 24 * 30;
                $user_unique_id = GetUniqueID_FromID($login_id, 'users');
                setcookie("uud", $user_unique_id, $expire_time, "/", ".entreprendspourtoncampus.com");
            }

            ?>
<script type="text/javascript">
window.location.replace("../profile");
</script>
<?php

        } else {
            $display = "block";
        }

    }
}
?>

<!doctype html>
<html lang="en" class="h-100">


<head>

    <meta name="google-signin-client_id"
        content="931323747999-kmfmhkmbc4n7ab11teqvrbscj3n4pujt.apps.googleusercontent.com">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>Connexion</title>


    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- font awesome styles -->
    <link rel="stylesheet" href="../assets/css/all.css">
    <!-- font awesome js  -->
    <script src="../assets/js/all.js"></script>

</head>


<body class="d-flex flex-column h-100 bg-crl">

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=969618246852728&autoLogAppEvents=1"
        nonce="eXm3daGP"></script>

    <!-- Navigation -->
    <?=GetHeader()?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">

    </main>
    <div class="row-mgh">
        <div class="container center-xy">
            <form class="form-signin" action="./#form" method="post" onsubmit="return LoginCheck();">
                <h3 class="h3 mb-5 font-weight-bolder text-center">Connexion</h3>
                <div class="row mb-5" style="padding-left: 100px">

                    <div class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default"
                        data-auto-logout-link="false" data-use-continue-as="false" data-width=""
                        data-scope="public_profile, email" data-onlogin="checkLoginState()">

                    </div>

                    <br />
                    <br />
                    <br />

                    <div id="my-signin2"></div>

                </div>
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                        required autofocus>
                </div>
                <div class="form-group mt-3">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="alert alert-danger" role="alert" id="error_message" style="display: <?=$display?>;">
                    <?=$error_message?>
                </div>

                <button class="btn btn-lg   btn-block mt-4 btn-blue radius_btn" type="submit">Sign in</button>
                <div class="form-group mt-5">
                    <!-- <p class="text-center"><a href="#" class="linkform">Forgot password</a></p> -->

                    <p class="text-center">Don't have account? <a href="../register" class="signup linkform">Sign up
                            here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>


    <!-- Footer -->
    <?=GetFooter()?>

    <script>
    function onSuccess(googleUser) {

        var profile = googleUser.getBasicProfile();

        username = profile.getName()
        email = profile.getEmail()

        RegisterUserAPI('google', username, email);
    }

    function onFailure(error) {
        console.log(error);
    }

    function renderButton() {
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'border-radius': 15,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }


    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function() {
            console.log('User signed out.');
        });
    }
    </script>

    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

</body>

<!-- Bottom Scripts -->
<?=GetBottomScripts()?>


<script>
function statusChangeCallback(response) { // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response); // The current login status of the person.
    if (response.status === 'connected') { // Logged into your webpage and Facebook.
        testAPI();
    } else { // Not logged into your webpage or we are unable to tell.
        document.getElementById('status').innerHTML = 'Please log ' + 'into this webpage.';
    }
}


function checkLoginState() { // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) { // See the onlogin handler
        statusChangeCallback(response);
    });
}




window.fbAsyncInit = function() {
    FB.init({
        appId: '969618246852728',
        cookie: true, // Enable cookies to allow the server to access the session.
        xfbml: true, // Parse social plugins on this webpage.
        version: 'v8.0' // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) { // Called after the JS SDK has been initialized.
        // statusChangeCallback(response);        // Returns the login status.
    });
};

function testAPI() { // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', {
        fields: 'name, email'
    }, function(response) {
        console.log('Successful login for: ' + response.name);
        console.log('Email: ' + response.email);


        RegisterUserAPI('facebook', response.name, response.email);

    });
}
</script>

</html>