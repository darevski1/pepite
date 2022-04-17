<?php session_start(); ?>
<?php
require_once('../../includes/config.php');
require_once('../../includes/db.php');

ConnectToDatabase();

		$fullname 	= 'Romain Kieffer';
		$email 		= 'admin@pepite.com';
		
		$password 	= GenerateHashedString('admin^%%*65', '1345');
		
		
		$query = "INSERT INTO admins(unique_id, username, email, password)
					VALUES(UUID(), '" . $fullname . "', '" . $email . "', '" . $password . "')";
		
		$rows = QueryInsert($query);
			

?>
