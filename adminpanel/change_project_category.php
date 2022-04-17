<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){
		
		exit('1');//not logged in
	}
	
	
if( isset($_POST['pid']) && $_POST['pid'] != '' && isset($_POST['c']) && $_POST['c'] != ''){
	
	$project_id = check_input($_POST['pid']);
	$category	= check_input($_POST['c']);


	$query = "UPDATE projects
				SET  category = '$category',
					 updated_at   = NOW()
			  WHERE id = $project_id";

	$rows = QueryInsert($query);
	
	if($rows)
		exit('2');

	exit("");
}
else
	exit('3');// invalid arguments
