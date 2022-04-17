// JavaScript Document

function verifyEmail(e){
	
	var status = false;     
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	
	if (e.search(emailRegEx) != -1)          
		status = true;
	
	return status;
}



function PoUpMessageSuccess(message){
	
	$("#dialog_success").html(message);
	$("#dialog_success").dialog();
	
	setTimeout(function(){
        $('#dialog_success').dialog('close');                
    }, 5000);
}

function PoUpMessage(message){
	
	$("#dialog").html(message);
	$("#dialog").dialog();
		
	setTimeout(function(){
        $('#dialog').dialog('close');                
    }, 5000);
}

function CheckForDuplicate(array, pom){
	
	for(i = 0; i < array.length; i++)
		if(array[i] == pom)
			return true;
	
	return false;
}


function ChangeProjectCategory(project_id){
	
	category = $("#project_category_" + project_id).val()
	
	$.post( "./change_project_category.php", {c: category, pid: project_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2){
            // PoUpMessageSuccess('Successful change');
		}else if(data == 1)
            PoUpMessage('You are not logged in');
        else
            PoUpMessage('Something went wrong');
    });		
}



function SaveProject(project_id){
	
	title = $("#project_title_txt_" + project_id).val()
	description = $("#project_description_txt_" + project_id).val().replace(/\n/g, '<br />');
	
	$.post( "./save_project.php", {t: title, d: description, pid: project_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2)
            PoUpMessage('Database error');
		else if(data == 1)
            PoUpMessage('You are not logged in');
        else if(data == 4)
            PoUpMessage('Database error');
        else{
        	elements = data.split('<!--a-->');
			if(elements.length > 1){			
				$("#table_row_project_"	+ project_id).html(elements[0]);					
				$("#edit_project_row_"	+ project_id).html(elements[1]);
				$("#edit_project_row_"	+ project_id).hide()
			}
        }
    });		
}



function ChangeProjectStatus(project_id){
	
	status = $("#project_status_" + project_id).val()
	
	$.post( "./change_project_status.php", {s: status, pid: project_id}, function(data) {
        if(data == 3)
            PoUpMessage('Invalid arguments');
        else if(data == 2){
            // PoUpMessageSuccess('Successful change');
		}else if(data == 1)
            PoUpMessage('You are not logged in');
        else
            PoUpMessage('Something went wrong');
    });		
}



	
function ChangeSideMenu(id_name){
	
	side_menu_elements = document.getElementsByClassName('admin_side_menu');
	
	console.log(id_name)

	for(i = 0; i < side_menu_elements.length; i++){
		
		if(side_menu_elements[i].id == 'side_menu_' + id_name){
			side_menu_elements[i].className = 'active admin_side_menu';
			
			if(id_name == 'my_tablets')
				GetMyTabletsContent();
			
			document.getElementById('content_' + id_name).style.display = 'block';
		}
		else{
			side_menu_elements[i].className = 'admin_side_menu';
			content_ids = side_menu_elements[i].id.split('side_menu_')
			content_id = 'content_'+content_ids[1];
			//alert(content_id)
			document.getElementById(content_id).style.display = 'none';
		}			
	}
}


function RemoveProject(project_id){
	
	$.post( "./remove_project.php", {pid: project_id}, function(data) {
		
		if(data == 4)
			PoUpMessage('You are not logged in');
		else if(data == 3)
			PoUpMessage('Missing arguments');
		else if(data == 2)
			PoUpMessage('Something went wrong');
		else if(data == 5){
			$("#table_row_project_" + project_id).html('')
		}else
			PoUpMessage('Something went wrong');
	});	
}


function ShowEditForm(element_id, type, element_unique_id){
	
	id_pom = 'create_' + type + '_form_';
	display = 'block';
	
	if(element_id > 0){	
		id_pom = 'edit_' + type + '_row_';
		display = 'table-row';		
	}
		
	display_val = document.getElementById(id_pom + element_id).style.display
	
	if(display_val == 'none')		
		document.getElementById(id_pom + element_id).style.display = display;
	else
		document.getElementById(id_pom + element_id).style.display = 'none';	
}




function ChangeInterestedTable(){

	project_id = $("#projects_cb").val();

	title = $("#projects_cb option:selected ").text();


	if(project_id > 0){
		$("#loading_image_id").show()
		$.post("./get_interested_users_table.php", {pid: project_id}, function(data) {			
				
				$("#loading_image_id").hide();
				if(data == 1)
					PoUpMessage('You are not logged in');
				else if(data == 4)	
					PoUpMessage('Missing arguments');
				else{
					$("#users_interested_table").html(data);
					$("#edited_interested_title").html("Interested Users in Project: " + title)
				}
			});
	}
	else
		$("#edited_interested_title").html("Interested Users in Projects");

}


function ChangeProjectMembersTable(){

	project_id = $("#project_members_cb").val();

	title = $("#project_members_cb option:selected ").text();


	if(project_id > 0){
		$("#loading_image_id").show()
		$.post("./get_project_members_table.php", {pid: project_id}, function(data) {			
				
				$("#loading_image_id").hide();
				if(data == 1)
					PoUpMessage('You are not logged in');
				else if(data == 4)	
					PoUpMessage('Missing arguments');
				else{
					$("#project_members_table").html(data);
					$("#edited_project_members_title").html("Project Members in Project: " + title)
				}
			});
	}
	else
		$("#edited_project_members_title").html("Project Members");

}



function limitIntegerReal(limitField, zero) {
	
	if(zero == 1){
		if(limitField.value != 0)	
			limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');
	}else
		limitField.value = limitField.value.replace(/[^\d.]/g, "").replace('-','').replace(/^[0]+/g,"").replace('.','');	
}




