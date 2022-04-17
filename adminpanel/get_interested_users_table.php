<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/interested.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){
		
		exit('1');
	}
	
	
if(isset($_POST['pid']) && $_POST['pid'] != ''){
	
	$project_id = check_input($_POST['pid']);

	
	exit(GetUsersInterestedTable($project_id));
	
}
else
	exit('4');// invalid arguments
