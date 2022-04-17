<?php session_start();?>
<?php        
    require_once('../includes/db.php');
    require_once('../includes/config.php');
    require_once('../includes/generators.php');
    
    
    ConnectToDatabase();
    
    $table   = 'users';
    $user_id = 'user_id';
    
    $loged_in = isLogedIn($table, $user_id);
        
    if(!$loged_in){
        ?>
            <script type="text/javascript">
                window.location.replace("../connexion");
            </script>               
        <?php
    }

    $user_id = $_SESSION['user_id'];

    $query = "SELECT first_name, last_name, email
              FROM users
              WHERE id = $user_id";

    $rows = QuerySelect($query);



?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Head -->
    <?=GetHead("Profile")?>

</head>

<body class="d-flex flex-column h-100">

    <!-- Navigation -->
    <?=GetHeader()?>

    <!-- Begin page content -->
   
    <div class="row-mgh">
 <main role="main" class="flex-shrink-0">

        <div class="container mt-5">
            <div class="submition">
                <div class="submition_box">
                    <div class="container">
                        <div class="text-center">
                            <span>
                                <h3>Profile <!-- <button class="btn btn-link btn-sm">Edit <i class="fas fa-pen"></i></button> -->
                                </h3>
                            </span>

                        </div>
                    </div>
                    <form action="" onsubmit="return false">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" value="<?=$rows[0]['first_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="">Family Name:</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" value="<?=$rows[0]['last_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="">E-Mail</label>
                            <input type="email" name="email" class="form-control" disabled="" value="<?=$rows[0]['email']?>">
                        </div>

                        <div class="alert alert-danger" role="alert" id="error_message" style="display: none;">
                            
                        </div>
                        <div class="alert alert-success" role="alert" id="success_message" style="display: none" >
                            You account is successfully updated
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn radius_btn_lg2 btn-block btn-purple" onclick="SaveUserDetails()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>
    <div class="row-mgh">

        <div class="container">
            <h2 class="text-center font-weight-bolder bluecolor fontbold">Upvoted 3/3</h2>

            <?=GetProjectsList(".", $user_id);?>

        </div>


    <!-- Footer -->
    <?=GetFooter()?>    
    </div>


</body>

    <!-- Bottom Scripts -->
    <?=GetBottomScripts()?>

</html>