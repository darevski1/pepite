
function verifyEmail(e){
	
	var status = false;     
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	
	if (e.search(emailRegEx) != -1)          
		status = true;
	
	return status;
}

function limitIntegerReal(limitField, zero) {
	
	if(zero == 1){
		if(limitField.value != 0)	
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');
	}else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');	
}



function PoUpMessageSuccess(message){
	
	$("#dialog_success").html(message);
	$("#dialog_success").dialog();
}


function PoUpMessage(message){
	
	$("#dialog").html(message);
	$("#dialog").dialog();
}



function LoginCheck(){
	
	var errorMessage = ''	
	var errorMessage2 = ""	
			
    var password = $('#password').val() 
	var email 	 = $('#email').val()
	
    $("#error_message").hide()
	
	if(email=='')
		errorMessage2 += "-Email<br />"	
	else if(!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"
			

	if(password=='')
		errorMessage2 += "-Password<br />"
	
	if(errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;
	
		
	if(errorMessage2 != "")
		if(errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else			
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
	
	if(errorMessage != ""){
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}
	
	return true;		
}

function CheckWorking(){

	var working = $('#working').val();

	if(working == "alone")
		$("#working_div").hide()
	else
		$("#working_div").show()
}

function AddTeamMembers(){

	var team_member = $('#team_member').val();
	
	$("#error_message").hide()

	errorMessage = '';

	if(team_member != ""){

		if(!verifyEmail(team_member) && team_member != "")
			errorMessage += "-Email address is not valid! <br />"

		if(errorMessage != ''){			
			$("#error_message").show()
			$("#error_message").html(errorMessage)
			return false;
		}

		team_members = $("#team_members").html()

		team_members += team_member + "<br />";

		$("#team_members").html(team_members)
		$('#team_member').val("");
	}

}

function InterestProject(project_id, dot){
		
	$.post( dot + "./interested_in_project.php", {pid: project_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2){
            $("#interested_button_" + project_id).html('<i class="fas fa-check"></i>');
            $("#interested_button_" + project_id).removeAttr('onclick');
			
			$("#popup_div").html('En cliquant ici, tu souhaites te porter volontaire pour aider le ou les proposeur(s) s’ils décident de poursuivre l’aventure');
			showPopup();

            // PoUpMessageSuccess('En cliquant ici, tu souhaites te porter volontaire pour aider le ou les proposeur(s) s’ils décident de poursuivre l’aventure');
		}else if(data == 1)
            PoUpMessage('You are not logged in');
        else
            PoUpMessage('Something went wrong');
    });		
}

function VoteProject(project_id, dot){
		
	$.post( dot + "./vote_project.php", {pid: project_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2){

            number_of_votes = parseInt($("#number_of_votes_" + project_id).html())
            $("#number_of_votes_" + project_id).html(++number_of_votes)
            
            $("#vote_button_" + project_id).html('<i class="fas fa-sort-up fnt-aws1"></i>');
            $("#vote_button_" + project_id).removeAttr('onclick');

            $("#popup_div").html('Merci pour ton vote');
			showPopup();
            // PoUpMessageSuccess('Merci pour ton vote')
            

		}else if(data == 1)
            PoUpMessage('You are not logged in');
        else
            PoUpMessage('Something went wrong');
    });		
}


function SaveUserDetails(){

	var errorMessage = ""	

    var last_name  = $('#last_name').val();
    var first_name = $('#first_name').val();
	
	$("#error_message").hide()
	$("#success_message").hide()
		
	if(first_name=='')
		errorMessage += "-Name<br />"
	
	if(last_name=='')
		errorMessage += "-Family name<br />"	

		
	if(errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage;
	
	if(errorMessage != ""){
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	}else{
		$.post("./save_user_details.php", {fn: first_name, ln: last_name}, function(data) {			
			
			if(data == 1){
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			}else if(data == 4){
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			}	
			else if(data == 3){				
				$("#success_message").html('User details successfully saved');
				$("#success_message").show()
			}else{
				$("#error_message").html('Something went wrong');
				$("#error_message").show()
			}
		});
	}
}



function SubmitProject(){

	var errorMessage = ""	

    var title 		= $('#title').val();
    var description = $('#description').val().replace(/\n/g, '<br />');
    var category 	= $('#category').val();
    var working 	= $('#working').val();
	
	$("#error_message").hide()
	$("#success_message").hide()
		
	if(title=='')
		errorMessage += "- Title<br />"
	
	if(description=='')
		errorMessage += "- Description<br />"	

	if(category=='')
		errorMessage += "- Category<br />"	

	team_members = '';

	if(working == 'team'){
		team_members = $("#team_members").html()

		team_members = team_members.replace(/<br\s*\/?>/gi,'#');
	}
		
	if(errorMessage != "")
		errorMessage = 'The following information is missing:<br /><br />' + errorMessage;
	
	if(errorMessage != ""){
		$("#error_message").show()
		$("#error_message").html(errorMessage)
	}else{
		$.post("./submit_project.php", {t: title, d: description, c: category, tm: team_members}, function(data) {			
			
			if(data == 1){
				$("#error_message").html('You are not logged in');
				$("#error_message").show()
			}else if(data == 4){
				$("#error_message").html('Missing arguments');
				$("#error_message").show()
			}	
			else if(data == 3){

				$('#title').val("");
    			$('#description').val('');
    			$('#category').val("");
    			$("#team_members").html("")

				$("#success_message").html('The project is successfully submited');
				$("#success_message").show()
			}else{
				$("#error_message").html('Something went wrong');
				$("#error_message").show()
			}
		});
	}
}



function RegisterCheck(){
	
	var errorMessage = ''	
	var errorMessage2 = ""	
			
    var password 	 = $('#password').val()
    var confirm_pass = $('#confirm_pass').val()
    var first_name 	 = $('#first_name').val()
    var last_name  	 = $('#last_name').val()
	var email 		 = $('#email').val()
	var phone_number = $('#phone_number').val()


    $("#error_message").hide()
	
	if(email=='')
		errorMessage2 += "-Email<br />"	
	else if(!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"
		
	
	if(first_name=='')
		errorMessage2 += "-Name<br />"	

	if(last_name=='')
		errorMessage2 += "-Family name<br />"	

	if(phone_number=='')
		errorMessage2 += "-Phone number<br />"	
	

	if(password=='')
		errorMessage2 += "-Password<br />"
	else if(confirm_pass=='')		
		errorMessage2 += "-Confirmation Password<br />"					
	else if(password != confirm_pass)
		errorMessage += "-The passwords do not match<br />";

	
	if(errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;
	
		
	if(errorMessage2 != "")
		if(errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else			
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
	
	if(errorMessage != ""){
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}
	
	return true;		
}



function ForgotCheck(){
	
	var errorMessage = ''	
	var errorMessage2 = ""	
			
	var email = $('#txt_email').val()
	
    $("#error_message").hide()
	
	if(email=='')
		errorMessage2 += "-Email<br />"	
	else if(!verifyEmail(email) && email != "")
		errorMessage += "-Your email address is not valid! <br />"
			

	if(errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;
	
		
	if(errorMessage2 != "")
		if(errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else			
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
	
	if(errorMessage != ""){
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}
	
	return true;		
}



function RecoverCheck(){
	
	var errorMessage = ''	
	var errorMessage2 = ""	
			
    var password 	 = $('#password').val() 
	var confirm_pass = $('#confirm_password').val()
	
    $("#error_message").hide()
	
	if(password=='')
		errorMessage2 += "-Password<br />"
	else if(confirm_pass=='')		
		errorMessage2 += "-Confirmation Password<br />"					
	else if(password != confirm_pass)
		errorMessage += "-The passwords do not match<br />";


	if(errorMessage != "")
		errorMessage = '<p style=" font-size:18px;">Please correct the following errors:</p>' + errorMessage;
	
		
	if(errorMessage2 != "")
		if(errorMessage != "")
			errorMessage += '<br /><p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
		else			
			errorMessage += '<p style=" font-size:18px;">The following information is missing:</p>' + errorMessage2;
	
	if(errorMessage != ""){
		$("#error_message").show()
		$("#error_message").html(errorMessage)
		return false;
	}	
		
	return true;		
}


function RegisterUserAPI(registered_from, username, email){

	$.post("./register_user_api.php", {rf: registered_from, u: username, e: email}, function(data) {			
			
		if(data == 1){
			window.location.replace("../");
		}else if(data == 4){
			$("#error_message").html('Missing arguments');
			$("#error_message").show()
		}	
		else if(data == 3){				
			window.location.replace("../");
		}else{
			$("#error_message").html('Something went wrong');
			$("#error_message").show()
		}
	});
}




