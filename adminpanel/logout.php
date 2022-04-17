<?php session_start();

	require_once('../includes/db.php');
	require_once('../includes/config.php');

if(isset($_SESSION['admin_id']))
	
	ConnectToDatabase();
	
	unset($_SESSION['admin_id']);
	

	?>
		<script type="text/javascript">
			window.location.replace("./");
		</script>				
	  <?php

?>


