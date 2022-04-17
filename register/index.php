<?php session_start();?>
<?php

require_once('../includes/db.php');
require_once('../includes/config.php');
require_once('../includes/generators.php');


ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

$display_error = "none";
$error_message = "";
$display_success = "none";

if($loged_in){
    ?>
        <script type="text/javascript">
            window.location.replace("../");
        </script>
    <?php
}else{
    
    if( isset($_POST["email"])      && $_POST["email"]      != "" &&
        isset($_POST["password"])   && $_POST["password"]   != "" &&
        isset($_POST["last_name"])  && $_POST["last_name"]  != "" &&
        isset($_POST["first_name"]) && $_POST["first_name"] != "") {

        $last_name  = check_input($_POST['last_name']);
        $first_name = check_input($_POST['first_name']);
        $pass       = check_input($_POST['password']);
        $email      = check_input($_POST['email']);

        $password   = GenerateHashedString($pass, '1345');

        if(intval(CheckIfEmailExists($email, $table)) > 0){
            $display_error = "block";
            $error_message = "The email <b>$email</b> is already used";
        }
        else{

            $query = "INSERT INTO users(unique_id, last_name, first_name, email, `password`, created_at, status, registered_from)
                            VALUES(UUID(), '$last_name', '$first_name', '$email', '$password', NOW(), 'Approved', 'site')";

            $rows = QueryInsert($query);

            if($rows)
                $display_success = "block";
            else{
                $display_error = "block";
                $error_message = "Something went wrong. Try again";
            }
        }
    }    
}

?>
<!doctype html>
<html lang="en" class="h-100">

    <!-- Head -->
    <?=GetHead("Register")?>

<body class="d-flex flex-column h-100 bg-crl">

    <!-- Navigation -->
    <?=GetHeader()?>
    

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        
    </main>

    <div class="row-mgh">
        <div class="container center-xy">

            <form class="form-signin p" action="./#form" method="post" onsubmit="return RegisterCheck();">

                <h3 class="h3 mb-5 font-weight-bolder text-center">Register</h3>
                    <a id="form"></a>
                <div class="form-group">
                    <label for="inputEmail">Name:</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Family Name:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Phone number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" required autofocus>
                </div>
                <div class="form-group mt-3">
                    <label for="inputPassword">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group mt-3">
                    <label for="inputPassword">Password Again:</label>
                    <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" required>
                </div>

                <div class="alert alert-danger" role="alert" id="error_message" style="display: <?= $display_error?>;">
                    <?=$error_message?>
                </div>
                <div class="alert alert-success" role="alert" id="success_message" style="display: <?= $display_success?>" >
                    You account is successfully created
                </div>

                <button class="btn btn-lg   btn-block mt-4 btn-blue radius_btn" type="submit">Register</button>
                <div class="form-group mt-5">

                    <p class="text-center">Already have account? <a href="../connexion" class="signup linkform">Log in here</a>
                    </p>
                </div>
            </form>
        </div>

        
    <?=GetFooter()?>  
    </div>

    <!-- Footer -->  
    
</body>

    <!-- Bottom Scripts -->
    <?=GetBottomScripts()?>

</html>