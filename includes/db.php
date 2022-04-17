<?php

$mysqli_link = "";

function ConnectToDatabase(){

	global $mysqli_link;
    
    $mysqli_link = new mysqli('localhost', 'root', '', 'pepite');
    // $mysqli_link = new mysqli('localhost', 'romain_user', 's)!,^(Vb!-aI', 'romain_pepite');
	
	if($mysqli_link->connect_errno) {
    	die("Failed to connect to MySQL: (" . $mysqli_link->connect_errno . ") " . $mysqli_link->connect_error);
	}	
	
	if(!$mysqli_link->set_charset("utf8")) {
    	printf("Error loading character set utf8: %s\n", $mysqli_link->error);
	} else {
		//printf("Current character set: %s\n", $mysqli_link->character_set_name());
	}
} 

function CloseDBConnection(){
	global $mysqli_link;
	mysqli_close($mysqli_link);
}





function InstertError($text1, $text2){
	global $mysqli_link;
	$pom3 = str_replace("'", "\'", $text1);
	$pom4 = str_replace("'", "\'", $text2);
	mysqli_query($mysqli_link, "INSERT INTO query_errors VALUES(null, '" . $pom3 . "', '" . $pom4 . "', NOW())");	
}



function QueryInsert($query, $success_message = "", $redirect_URL = "", $with_message = false){
	global $mysqli_link;			
	$result = mysqli_query($mysqli_link, $query);
	
	if (!$result) {					
		InstertError($query, $mysqli_link->error);
		if($with_message){		
			?>
				<script type="text/javascript">
					alert("We are sorry, We have encountered an error. \n our team will see what is the problem.");				
				</script>
			<?php
		}	
		return false;	
	}
	else{
		if($success_message != "" || $redirect_URL != ""){		 
			?>
				<script type="text/javascript">				
					var success_message = "<?php echo $success_message?>"
					if(success_message != "")
						alert("<?php echo $success_message?>");
					
					var redirect_URL = "<?php echo $redirect_URL?>"
					if(redirect_URL != '')
						top.window.location.href=redirect_URL;
				</script>            
			<?php
		}
		return true; 	
	}	
}




function QuerySelect($query, $fetch_type = 'MYSQLI_BOTH', $with_message = false){
		
	global $mysqli_link;			
	$result = mysqli_query($mysqli_link, $query);
	
	if (!$result) {					
		InstertError($query, $mysqli_link->error);
		if($with_message)	{
			?>
				<script type="text/javascript">
					alert("We are sorry, We have encountered an error. \n our team will see what is the problem.");				
				</script>
			<?php
		}
		return false; 	
	}
	else{
		$rows = array();
		if(!is_bool($result)) {
            while ($row = $result->fetch_array(constant($fetch_type))) {
                $rows[] = $row;
            }
            $result->close();
        }
		return $rows;		
	}	
}
function QueryProcedure($query, $with_message = false){
		
	global $mysqli_link;
	
	$result = mysqli_query($mysqli_link, $query);
	//print_r($result);
	if(!$result){
		InstertError($query, $mysqli_link->error);
		if($with_message)	{
			?>
				<script type="text/javascript">
					alert("We are sorry, We have encountered an error. \n our team will see what is the problem.");				
				</script>
			<?php
		}
		return false; 	
	}
	else{
		$rows = array();
		
		while($mysqli_link->more_results()){
			$result = $mysqli_link->store_result();
			//echo "___" . $result . "___";
			$mysqli_link->next_result();
		}
			
		if(is_object($result) && property_exists($result, 'field_count') && $result->field_count > 0){
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$rows[] = $row;
			}	
				
			$result->close();
		}
		return $rows;		
	}	
}

function check_input($value)
{
	global $mysqli_link;
	// Stripslashes
	if (get_magic_quotes_gpc())
	  {
	  	$value = stripslashes($value);
	  }
	// Quote if not a number
	if (!is_numeric($value))
	  {
	  $value = mysqli_real_escape_string($mysqli_link, $value);
	  }
	return $value;
}
?>