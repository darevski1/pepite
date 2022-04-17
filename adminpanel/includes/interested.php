<?php

function GetUsersInterestedPage(){
	
	$return_string = '';	
	
	$return_string .= '<div id="content_users_interested" class="content" style="display:none" > '; 
	$return_string .= '<h2 class="atitle bgpatter" id="edited_interested_title">Interested Users in Projects</h2>';
	$return_string .= '<br/>';
	$return_string .= '<hr class="alt2" />';
	

	$return_string .= GetProjectsCB();

	

	$return_string .= '<br/>';

	$return_string .= '<table cellspacing="0" cellpadding="0" class="q-as" id="users_interested_table">';
	// $return_string .= GetUsersInterestedTable();	
	$return_string .= '</table>';
	
	$return_string .= '</div>';
	
	return $return_string;	
}



function GetUsersInterestedTable($project_id){
	

	$query = "SELECT title, category, CONCAT(first_name, ' ', last_name) AS username, email
			  FROM users_interested ui, projects p, users u
			  WHERE ui.project_id = $project_id AND u.id = ui.user_id AND ui.project_id = p.id";
			  
	$rows = QuerySelect($query);
	
	$return_string = '';
	
	
	$return_string .= '<thead><tr>';
	$return_string .= '<th >User Name</th>';
	$return_string .= '<th >User Email</th>';
	$return_string .= '<th >Project Title</th>';
	$return_string .= '<th >Project Category</th>';
	$return_string .= '</tr></thead>';
	$return_string .= '<tbody>';
	
	for($i = 0; $i < count($rows); $i++)	
		$return_string .= GenerateUsersInterestedRow($rows[$i]);
		
		
	$return_string .= '</tbody>';
	
	return $return_string;	
}


function GenerateUsersInterestedRow($rows){
	
	$return_string = '';

	$return_string .= '<tr>';
	$return_string .= '<td>' . $rows['username'] . '</td>';
	$return_string .= '<td>' . $rows['email'] . '&nbsp;</td>';	
	$return_string .= '<td>' . $rows['title'] . '&nbsp;</td>';	
	$return_string .= '<td>' . $rows['category'] . '&nbsp;</td>';					   
	$return_string .= '</tr>';
	
	return $return_string;	
}


function GetProjectsCB(){
        
    $return_string = '';
    
    $return_string .= '<span class="mc-1">';
    $return_string .= '<h6>Projects:</h6>';        
    $return_string .= '<select id="projects_cb" autocomplete="off"
                            class="inxtt input_style combo_class" style="width:300px; height:25px">';   
 
    $return_string .= '<option value="0">-Select-</option>';
    
    $query = "SELECT id, unique_id, title
              FROM projects 
              WHERE `status` = 'Approved'
              ORDER BY title DESC";

    $rows = QuerySelect($query);

    for($i = 0; $i < count($rows); $i++)
        $return_string .= '<option value="' . $rows[$i]['id'] . '">' . $rows[$i]['title'] . '</option>';
        
    $return_string .= '</select>';    
    $return_string .= '</span>';
        
    return $return_string;
}



?>