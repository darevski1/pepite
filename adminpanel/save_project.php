<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');
include('./includes/projects.php');

ConnectToDatabase();
	

	$table 	 = 'admins';
	$user_id = 'admin_id';
	
	$loged_in = isLogedIn($table, $user_id);

	if(!$loged_in){		
		exit('1');//not logged in
	}
	
	
if( isset($_POST['t']) && $_POST['t'] != '' && isset($_POST['pid']) && $_POST['pid'] != '' &&
	isset($_POST['d']) && $_POST['d'] != ''){
	
	$project_id = check_input($_POST['pid']);
	$title		= check_input($_POST['t']);
	$description= check_input(nl2br($_POST['d']));


	$query = "UPDATE projects
				SET  title 		 = '$title',
					 description = '$description',
					 updated_at   = NOW()
			  WHERE id = $project_id";

	$rows = QueryInsert($query);
	
	if($rows){
		
		$rows = GetProjectRowsFromDB($project_id);
				
		if(is_array($rows))
			if(count($rows) > 0){
				$table_row = GetNewRowProjectsTable($rows[0], true, 0);
				exit($table_row);
			}				
		exit('4');// database error
	}

	exit("2");
}
else
	exit('3');// invalid arguments
