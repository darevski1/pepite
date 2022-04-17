<?php

function GetProjectMembersPage(){
	
	$return_string = '';	
	
	$return_string .= '<div id="content_project_members" class="content" style="display:none" > '; 
	$return_string .= '<h2 class="atitle bgpatter" id="edited_project_members_title">Project Members</h2>';
	$return_string .= '<br/>';
	$return_string .= '<hr class="alt2" />';
	

	$return_string .= GetProjectsCB2();

	

	$return_string .= '<br/>';

	$return_string .= '<table cellspacing="0" cellpadding="0" class="q-as" id="project_members_table">';
	// $return_string .= GetProjectMembersTable();	
	$return_string .= '</table>';
	
	$return_string .= '</div>';
	
	return $return_string;	
}



function GetProjectMembersTable($project_id){
	

	$query = "SELECT title, category, email
			  FROM project_members pm, projects p
			  WHERE pm.project_id = $project_id AND pm.project_id = p.id";
			  
	$rows = QuerySelect($query);
	
	$return_string = '';
	
	
	$return_string .= '<thead><tr>';
	$return_string .= '<th >Member Email</th>';
	$return_string .= '<th >Project Title</th>';
	$return_string .= '<th >Project Category</th>';
	$return_string .= '</tr></thead>';
	$return_string .= '<tbody>';
	
	for($i = 0; $i < count($rows); $i++)	
		$return_string .= GenerateProjectMembersRow($rows[$i]);
		
		
	$return_string .= '</tbody>';
	
	return $return_string;	
}


function GenerateProjectMembersRow($rows){
	
	$return_string = '';

	$return_string .= '<tr>';
	$return_string .= '<td>' . $rows['email'] . '&nbsp;</td>';	
	$return_string .= '<td>' . $rows['title'] . '&nbsp;</td>';	
	$return_string .= '<td>' . $rows['category'] . '&nbsp;</td>';					   
	$return_string .= '</tr>';
	
	return $return_string;	
}


function GetProjectsCB2(){
        
    $return_string = '';
    
    $return_string .= '<span class="mc-1">';
    $return_string .= '<h6>Projects:</h6>';        
    $return_string .= '<select id="project_members_cb" autocomplete="off"
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