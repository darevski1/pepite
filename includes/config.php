<?php


function SendEmail($email_subject, &$message, $email_from, $email_to){

    $email_subscribe = '';
    //$headers = "From: $email_from; 
//        		Content-Type: text/html; charset=UTF-8";
	
	//$headers = 'From: ' . $email_from . "\r\n" . 'Content-Type: text/html; charset=UTF-8';
	
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=UTF-8';

	// Additional headers
	$headers[] = 'From: ' . $email_from;
	
    $email_message = $message . $email_subscribe;

    return mail($email_to, $email_subject, $email_message, implode("\r\n", $headers));

}


function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}  

function br2nl_2($string)
{
	$breaks = array("<br />","<br>","<br/>");  
    return str_ireplace($breaks, "\r\n", $string);
}  


function Redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}


function GetID_FromUniqueID($unique_id, $table){
		
	$query = "SELECT id FROM $table WHERE unique_id = '$unique_id'";			
	$rows = QuerySelect($query);
		
	if(is_array($rows))
		if(count($rows)==1)			
			return $rows[0]["id"];
	
	return false;
}



function in_array_r($item , $array){
    return preg_match('/"'.$item.'"/i' , json_encode($array));
}





function GetUniqueID_FromID($id, $table){
		
	$query = "SELECT unique_id FROM $table WHERE id = " . $id;			
	$rows = QuerySelect($query);
	
	if(is_array($rows))
		if(count($rows)==1)			
			return $rows[0]["unique_id"];				
	
	return false;			
}


function GenerateHashedString($string, $Rounds){
		
	$Salt = uniqid(); 
	$Algo = '6';
			
	$CryptSalt = '$' . $Algo . '$rounds=' . $Rounds . '$' . $Salt;
	
	$HashedString = crypt($string, $CryptSalt);
	
	$stringArray = explode("$", $HashedString);
	
	return $stringArray[count($stringArray)-2]."$".$stringArray[count($stringArray)-1];	
}

function CheckHashedString($string, $HashedString, $Rounds){
				
	$Algo = '6';
		
	$CryptAlgo = '$' . $Algo . '$rounds=' . $Rounds . '$';			
	
	$HashedString = $CryptAlgo . $HashedString;										
				
	if(crypt($string, $HashedString) == $HashedString)
		return true;
	else{				
		return false;
	}	
}

function CheckIfEmailExists($email, $table){
	
	$query = "SELECT id FROM " . $table . " WHERE email = '".$email . "'";			
	$rows  = QuerySelect($query);
	
	if(is_array($rows))
		if(count($rows)==1)
			return $rows[0]["id"];				
				
	return false;			
}


function CheckHashedPassword($password, $email, $table = 'users'){
		
	$query = "SELECT password, id FROM " . $table . " WHERE email = '".$email . "'";			
	$rows = QuerySelect($query);
	
	
	if(is_array($rows)){
		if(count($rows)==1){
			
			$databasePass = $rows[0]["password"];
			
			if(CheckHashedString($password, $databasePass, '1345')){
				
				return $rows[0]["id"];
			}
			else
                return "Incorrect Password.";										
		}else
			return "That email does not exist in our database.";
	}
	
}


function isLogedIn($table = 'users', $user_id = 'user_id'){
	
	if(isset($_SESSION[$user_id])){

		if($table == 'admins')
			$query = "SELECT username FROM " . $table . " WHERE id = " . $_SESSION[$user_id];
		else
			$query = "SELECT CONCAT(first_name, last_name) AS username FROM " . $table . " WHERE id = " . $_SESSION[$user_id];
		
		$rows = QuerySelect($query);
		
		if (is_array($rows)){
			if(count($rows)==1){
				
				return $rows[0]["username"];
			}
			else
				return false;	    
		}else
			return false;	
			
	}else if(isset($_COOKIE["uud"]) && $table != 'admins'){
		
		if($_COOKIE["uud"] != ""){
		
			if($table == "admins")
				$query = "SELECT id, username FROM " . $table . " WHERE unique_id = '" . $_COOKIE["uud"] . "'";
			else
				$query = "SELECT id, CONCAT(first_name, last_name) AS username FROM " . $table . " WHERE unique_id = '" . $_COOKIE["uud"] . "'";

			$rows = QuerySelect($query);
			
			if (is_array($rows)){
				if(count($rows)==1){
					$_SESSION[$user_id] = $rows[0]["id"];			
					return $rows[0]["username"];						
				} else
					return false;	    
			}else
				return false;
			
		}else
			return false;
	}
	else
		return false;
}


function Check_Failed_attepmts(){

	global $display;
	global $captcha;
	
	$display = "block";
	
	if(isset($_SESSION['failed_attempts'])){
		if($_SESSION['failed_attempts']>0)
			$_SESSION['failed_attempts'] += 1;
		else{
			$_SESSION['failed_attempts'] = 1;
			$_SESSION['failed_attempt_time'] = time();
		}
		
			
		if($_SESSION['failed_attempts'] >= 3){
			if(time() - $_SESSION['failed_attempt_time'] <= 60*15){		
				$captcha = true;		
				$display = "none";		
				
			}else{
				$_SESSION['failed_attempts'] = 1;
				$_SESSION['failed_attempt_time'] = time();
			}
		}
	}
	else{
		$_SESSION['failed_attempts'] = 1;
		$_SESSION['failed_attempt_time'] = time();
	}
}


function checkEmailRecoverPassword($email){

    $query = "SELECT unique_id, id FROM users WHERE email = N'" . $email . "'";

    $rows = QuerySelect($query);

    if(is_array($rows)){
        if(count($rows)>0){

            $recovery_pass_unique_id = uniqid();

            $query = "INSERT INTO recover_pass VALUES(NULL, '" . $recovery_pass_unique_id . "', " . $rows[0]['id'] . ", '" . $rows[0]['unique_id'] . "', NOW())";

            if(QueryInsert($query))
                return $recovery_pass_unique_id; // successfull generating recover pass
            else
                return 1; // unsuccessfull generating recover pass

        }else
            return 0; // no such mail in the database
    }else
        return 0; // no such mail in the database
}


function GetUsernameFromUser($user_id){

	$query = "SELECT username FROM users WHERE id = " . $user_id;

	$rows = QuerySelect($query);

	if(count($rows) > 0)
		return $rows[0]["username"];

	return false;
}



