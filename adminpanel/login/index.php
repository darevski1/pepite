<?php session_start();?>
<?php
		
	require_once('../../includes/db.php');
	require_once('../../includes/config.php');
	
	
	ConnectToDatabase();
	
	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);
	
	$display = "none";
	$login_id = "";
	$email = "";
	$captcha = false;
	# the response from reCAPTCHA
	$resp = null;
	# the error code from reCAPTCHA, if any
	$error = null;
	

	if($loged_in){
		?>
			<script type="text/javascript">
				window.location.replace("../");
			</script>				
		<?php
	}else{
		
		$continue = true;
		
		if(isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "" && $continue){
			
			$email = check_input($_POST['email']);
			$pass  = check_input($_POST['password']);
						
			$login_id = CheckHashedPassword($pass, $email, $table);
						
			if(is_numeric($login_id)){
				
				$query = "SELECT  username FROM admins WHERE id = " . $login_id;
				
				//echo $query;
				
				//exit();
				
				$rows = QuerySelect($query);
				
				
				$logged = false;
				
				if(count($rows) > 0)
					$logged = true;
				
				if($logged){
					$_SESSION['admin_id'] = $login_id;
					$_SESSION['failed_attempts'] = 0;
					$_SESSION['failed_attempt_time'] = 0;
										
					?>
						<script type="text/javascript">
							window.location.replace("../");
						</script>				
					<?php
				}
					
			}else
				$display = "block";
			
			
	
		}else if(isset($_POST['email']) && $_POST["email"] != ""){
			$email = $_POST["email"];
			Check_Failed_attepmts();
			$login_id = "Enter password";
		}else if(isset($_POST['password']) && $_POST["password"] != ""){
			Check_Failed_attepmts();
			$login_id = "Enter email";
		}else{
			
			$display = "none";
			if(isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] == "" && $_POST["password"] == ""){
				Check_Failed_attepmts();
				$login_id = "Enter email and password";
			}
		}
	}
	

?>



<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<title>Pepite® - Log In</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="description" content="" />
  
<link rel="icon" href="../../assets/img/favicon/favicon.ico">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../css/kickstart.css" media="all" />
	<link rel="stylesheet" type="text/css" href="../../style.css" media="all" /> 
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css"/>
    <![endif]-->
	<!-- Javascript -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/kickstart.js"></script>
  <script src="../../js/responsive-nav.js">
  /*
  	input-text{
		font-family: helvetica,sans-serif;
		height: 40px;
		text-indent: 15px;
	}*/
	
  </script>
 </head>
 <body>
 <div id="header">
    
 </div>
  <!-- Content -->
  <div class="grid">
    <div class="col_3"></div>
    <div class="col_6">
      <div class="register">
       <p class="regtitle">Admin - Log In</p>
       <br/>
      <!-- Login Form -->
         <form class="vertical" method="post" action="./">
          <label for="email"></label>
          <input  id="email" name="email" value="<?php echo $email;?>" type="email" class="form-control empty" placeholder="&#xf007; Email" style="font-family:Arial, FontAwesome" autocomplete="off">     
               
          <label for="password"></label>
          <input type="password" id="password" name="password" value="" class="form-control empty" placeholder="&#xf023; Password" style="font-family:Arial, FontAwesome" autocomplete="off">     
                 
          
          <div class="notice error" style="display:<?php echo $display;?>"> <?php echo $login_id;?> </div>
          
				
			<?php
             if($captcha && false)
                echo recaptcha_get_html($publickey, $error);
            ?>
          

          <input type="submit" value="Log In" class="regbtn"/>
            
        </form>
        </div>
      </div>
      <div class="col_3"></div>
    </div>
    <div class="clear"></div>
  </div>
    <!-- Footer -->
   
</body>
</html>
    