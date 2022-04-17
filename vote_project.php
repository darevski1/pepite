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

	$query = "INSERT INTO users_voted (user_id, project_id)
					VALUES($user_id, $project_id)";

	$rows = QueryInsert($query);
	
	if($rows){
		$query = "UPDATE projects
					SET  votes = votes + 1
				  WHERE id = $project_id";	

		QueryInsert($query);
	}

	exit('2');

}
else
	exit('3');// invalid arguments
