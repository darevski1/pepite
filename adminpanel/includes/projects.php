<?php

function GetProjectsPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_projects" class="content" style="display:none" > '; 
	$return_string .= '<h2 class="atitle bgpatter">Projects</h2>';
	$return_string .= '<br/>';
	
	$return_string .= '<br/>';
	$return_string .= '<hr class="alt2" />';
	$return_string .= CreateProjectForm();
	$return_string .= '<div id="project_table_div">';
	$return_string .= GetProjectsTable();
	$return_string .= '</div>';
	$return_string .= '</div>';
	
	return $return_string;
	
}



function CreateProjectForm($project_id = 0, $where = 'create'){
		
	$title 		 = '';
	$description = '';
	$status 	 = '';
	$category 	 = '';
	$votes 		 = 0;
	
	$return_string  = '';
	
	$display = 'block';
	
	if($where == 'create')
		$display = 'none';

	
	if($project_id != 0){
		
		$query = "SELECT title, description, category, votes, status
				  FROM projects 
				  WHERE id = $project_id";
		
		$rows = QuerySelect($query);
		
		if($rows)
			if(count($rows) > 0){
				$title 		 = $rows[0]['title'];
				$description = br2nl_2($rows[0]['description']);
				$category	 = $rows[0]['category'];
				$votes		 = $rows[0]['votes'];
				$status		 = $rows[0]['status'];		
			}
	}
	
	
	$return_string  .= '<div class="divblock" id="create_project_form_' . $project_id . '" style="width:750px; margin-left:5px; display:' . $display . '" >'; //style="display:none"
	$return_string  .= '<h5 class="atitle">' . ucfirst($where) . ' Project</h5>';
	$return_string  .= '<hr class="alt2" />';

	$return_string  .= '<div>';
	$return_string  .= '<h6>Enter Project Title:</h6>';
	$return_string  .= '<input type="text" id="project_title_txt_' . $project_id . '" autocomplete="off" placeholder="Project Title!"
						 class="inxtl input_style" value="' . $title . '" /> ';
	$return_string  .= '</div>';		

	$return_string  .= '<div>';
	$return_string  .= '<h6>Description</h6>';
	$return_string  .= '<textarea class=" input_style" rows="5" cols="50" id="project_description_txt_' . $project_id . '" >' . $description . '</textarea>';	
	$return_string  .= '</div>';
	
	$return_string .= '<br />';
	$return_string .= '<input class="btn_green btn_l" type="submit" value="Save Project" onClick="SaveProject(' . $project_id . ', \'' . $where . '\')">';
	$return_string .= '&nbsp;&nbsp;&nbsp;&nbsp;';
	$return_string .= '<input class="btn_red btn_l" type="submit" value="Cancel" onClick="ShowEditForm(' . $project_id . ', \'project\')">';
	$return_string .= '</div>';
	
	
	return $return_string;
}



function GetNewRowProjectsTable($rows, $save_project = false, $i){
	
	$return_string = '';
	
		
	if(!$save_project)
		$return_string .= '<tr id="table_row_project_' . $rows['id'] . '">';
	
	$return_string .= '<td>' . ($i + 1) . '.</td>';
	$return_string .= '<td>' . $rows['title'] . '</td>'; 
	$return_string .= '<td>' . $rows['votes'] . '</td>';
	$return_string .= '<td>' . GetProjectCategoryComboBox($rows['category'], $rows['id']) . '</td>';
	$return_string .= '<td>' . GetProjectStatusComboBox($rows['status'], $rows['id']) . '</td>';
	$return_string .= '<td>' . $rows['created_at'] . '</td>';
	
	$return_string .= '<td><button class="edit" onClick="ShowEditForm(' . $rows['id'] . ', \'project\')">EDIT</button></td>';
	$return_string .= '<td><button class="edit" onClick="RemoveProject(' . $rows['id'] . ')">DELETE</button></td>';
	
	if(!$save_project){
		$return_string .= '</tr>';
		$return_string .= '<tr class="spanedit" id="edit_project_row_' . $rows['id'] . '" style="display:none">'; //
	}else
		$return_string .= '<!--a-->';

	$return_string .= '<td colspan="8">';
	$return_string .= CreateProjectForm($rows['id'], 'edit');
	$return_string .= '</td>';
	
	if(!$save_project)
		$return_string .= '</tr>';
	
	return $return_string;
}


function GetProjectRowsFromDB($project_id = 0){
	
	$where = "";

	if($project_id != 0)
		$where = "WHERE id = $project_id";

	$query = "SELECT id, unique_id, title, votes, category, status, created_at
			  FROM projects
			  $where
			  ORDER BY created_at ASC";
	
	$rows = QuerySelect($query);
		
	return $rows;
}


function GetProjectsTable(){
		
	$rows = GetProjectRowsFromDB();
	
	$return_string = '';
		
	$return_string .= '<table cellspacing="0" cellpadding="0" class="q-as" id="projects_table">';
	
	$return_string .= '<thead><tr>';
	$return_string .= '<th style="width:30px">No.</th>';
	$return_string .= '<th>Title</th>';
	$return_string .= '<th style="width:40px">Views</th>';
	$return_string .= '<th style="width:150px">Category</th>';
	$return_string .= '<th style="width:150px">Status</th>';
	$return_string .= '<th style="width:130px">Date Created</th>';
	$return_string .= '<th style="width:70px">Edit </th>';
	$return_string .= '<th style="width:70px">Delete</th>';
	$return_string .= '</tr></thead>';
	
	$return_string .= '<tbody style="font-size:14px;" id="project_table_body">';
	
	
	for($i = 0; $i < count($rows);  $i++)
		$return_string .= GetNewRowProjectsTable($rows[$i], false, $i);
		

	$return_string .= '</tbody>';
	$return_string .= '</table>';
	
	
	return $return_string;
	
}




function GetProjectStatusComboBox($project_status, $project_id){
	
	$project_statuses = ['Waiting Approval', 'Approved', 'Rejected'];
	
    $return_string = '';

    $return_string .= '<select style="width:95%; height:25px; margin-left:0px;" class="inxtc input_style" 
						id="project_status_' . $project_id . '" onChange="ChangeProjectStatus(' . $project_id . ')">';
	
	$return_string .= '<option value="" > - Select - </option>';
	
    for($i = 0; $i < count($project_statuses); $i++)
        if($project_status == $project_statuses[$i])
            $return_string .= '<option value="' . $project_statuses[$i] . '" selected="selected">' . $project_statuses[$i] . '</option>';
        else
            $return_string .= '<option value="' . $project_statuses[$i] . '">' . $project_statuses[$i] . '</option>';

    $return_string .= '</select>';

    return $return_string;
}


function GetProjectCategoryComboBox($category, $project_id){
	
	$categories = ["Alimentation / Santé", "Vie Sociale / Convivialité", "Logement", "Transport / Mobilité", "Citoyenneté / Entraide", "Respect de l'environnement", "Loisirs & Sports / Culture", "International", "Autre"];
	
    $return_string = '';

    $return_string .= '<select style="width:95%; height:25px; margin-left:0px;" class="inxtc input_style" 
						id="project_category_' . $project_id . '" onChange="ChangeProjectCategory(' . $project_id . ')">';
	
	$return_string .= '<option value="" > - Select - </option>';
	
    for($i = 0; $i < count($categories); $i++)
        if($category == $categories[$i])
            $return_string .= '<option value="' . $categories[$i] . '" selected="selected">' . $categories[$i] . '</option>';
        else
            $return_string .= '<option value="' . $categories[$i] . '">' . $categories[$i] . '</option>';

    $return_string .= '</select>';

    return $return_string;
}


?>