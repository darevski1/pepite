<?php session_start(); ?>
<?php

include('./includes/db.php');
include('./includes/config.php');

ConnectToDatabase();

$loged_in = isLogedIn();

if(!$loged_in)	
	exit('1');//not logged in

	
	
if( isset($_POST['pid']) && $_POST['pid'] != ''){
	
	$project_id = check_input($_POST['pid']);

	$user_id = $_SESSION['user_id'];

	$query = "INSERT INTO users_interested (user_id, project_id)
					VALUES($user_id, $project_id)";

	$rows = QueryInsert($query);
	
	if($rows)
		exit('2');

	exit("");
}
else
	exit('3');// invalid arguments
