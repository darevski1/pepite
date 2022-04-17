<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in == false){
    exit("1");
}

if( isset($_POST['c']) && $_POST['c'] != '' &&
 	isset($_POST['d']) && $_POST['d'] != '' &&
  	isset($_POST['t']) && $_POST['t'] != '' &&
  	isset($_POST['tm']) && $_POST['tm'] != ''){
	
	$category	 = check_input($_POST['c']);
	$description = check_input(nl2br($_POST['d']));
	$title		 = check_input($_POST['t']);
	$team_members= check_input($_POST['tm']);

	$user_id = $_SESSION['user_id'];

	
    $query = "INSERT INTO projects(unique_id, title, description, user_id, category, created_at, status)
                    VALUES(UUID(), '$title', '$description', $user_id, '$category', NOW(), 'Waiting Approval')";
	
	$rows = QueryInsert($query);

	if($rows){

		$project_id = $mysqli_link->insert_id;

		$members = explode("#", $team_members);

		for($i = 0; $i < count($members) -1; $i++){

			$query = "INSERT INTO project_members (project_id, user_id, email)
						VALUES($project_id, $user_id, '" . $members[$i] . "')";

			QueryInsert($query);
		}

		exit('3');
	}

	exit("");
}

exit('4');// invalid arguments