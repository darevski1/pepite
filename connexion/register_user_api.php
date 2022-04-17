<?php session_start(); ?>
<?php

include('../includes/db.php');
include('../includes/config.php');

ConnectToDatabase();

$table   = 'users';
$user_id = 'user_id';

$loged_in = isLogedIn($table, $user_id);

if($loged_in){
    exit("1");
}

if( isset($_POST['u']) && $_POST['u'] != '' && isset($_POST['rf']) && $_POST['rf'] != '' &&
  	isset($_POST['e']) && $_POST['e'] != ''){
	
	$registered = check_input($_POST['rf']);
	$username 	= check_input($_POST['u']);
	$email 	  	= check_input($_POST['e']);

	$user_id = CheckIfEmailExists($email, 'users');

	if(!$user_id){

		$user_name = explode(" ", $username);

		$first_name = $user_name[0];
		$last_name = $first_name;

		if(count($user_name) > 1)
			$last_name = $user_name[count($user_name) - 1];

        $query = "INSERT INTO users(unique_id, last_name, first_name, email, registered_from, created_at, status)
                    VALUES(UUID(), '$last_name', '$first_name', '$email', '$registered', NOW(), 'Approved')";
	
		$rows = QueryInsert($query);

		$user_id = $mysqli_link->insert_id;
	}	

	$_SESSION['user_id'] = $user_id;

	exit('3');

}

exit('4');// invalid arguments