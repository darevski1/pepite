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

if( isset($_POST['fn']) && $_POST['fn'] != '' &&
  	isset($_POST['ln']) && $_POST['ln'] != ''){
	
	$first_name   = check_input($_POST['fn']);
	$last_name 	  = check_input($_POST['ln']);

	$user_id = $_SESSION['user_id'];

	$query = "UPDATE users
				SET  last_name 	  = '$last_name',
					 first_name   = '$first_name',
					 updated_at   = NOW()
			  WHERE id = $user_id";
	
	$rows = QueryInsert($query);

	if($rows)
		exit('3');

	exit("");
}

exit('4');// invalid arguments