<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();

$table 	 = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in){
	if(isset($_POST['pid']) && $_POST['pid'] != ''){
		
		$project_id = check_input($_POST['pid']);
		
		$query = "DELETE FROM projects WHERE id = " . $project_id;
			
		$rows = QueryInsert($query);
			
		if($rows)
			exit('5');
		
		exit('2');			
	}
	else
		exit('3');// invalid arguments
}else
	exit('4');
