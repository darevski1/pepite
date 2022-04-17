<?php session_start(); ?>
<?php
require_once('../includes/config.php');
require_once('../includes/db.php');
require_once('./includes/projects.php');
require_once('./includes/interested.php');
require_once('./includes/project_members.php');

ConnectToDatabase();

$table 	 = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);


if(!$loged_in){	
	?>
		<script type="text/javascript">
            window.location.replace("./login");
        </script>				
    <?php
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<!-- META -->
<title>Pepite Admin Panel</title>
<meta charset="UTF-8">
<meta id="vp" name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="" />
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="./css/style.css" media="all" /> 

<style type="text/css">

    .active{
    	background-color:#ddd !important;
    }


        /* Switch Slider CSS */
            .switch {
              position: relative;
              display: inline-block;
              width: 70px;
              height: 34px;
            }

            .switch input { 
              opacity: 0;
              width: 0;
              height: 0;
            }

            .slider {
              position: absolute;
              cursor: pointer;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background-color: #bbb;
              -webkit-transition: .4s;
              transition: .4s;
            }

            .slider:before {
              position: absolute;
              content: "";
              height: 26px;
              width: 26px;
              left: 4px;
              bottom: 4px;
              background-color: white;
              -webkit-transition: .4s;
              transition: .4s;
            }

            input:checked + .slider {
              background-color: #34a234;
            }

            input:focus + .slider {
              box-shadow: 0 0 1px #34a234;
            }

            input:checked + .slider:before {
              -webkit-transform: translateX(46px);
              -ms-transform: translateX(46px);
              transform: translateX(46px);
            }

            /* Rounded sliders */
            .slider.round {
              border-radius: 34px;
            }

            .slider.round:before {
              border-radius: 50%;
            }











    /*Image upload styling*/
    .bgColor {
        max-width: 440px;
        height: 400px;
        background-color: #c3e8cb;
        padding: 30px;
        border-radius: 4px;
    	text-align: center;    
    }
    #targetOuter{	
    	position:relative;
        text-align: center;
        background-color: #F0E8E0;
        margin: 20px auto;
        width: 200px;
        height: 200px;
    	border-radius: 4px;
    }
    .btnSubmit {
        background-color: #565656;
        border-radius: 4px;
        padding: 10px;
        border: #333 1px solid;
        color: #FFFFFF;
        width: 200px;
    	cursor:pointer;
    }
    .inputFile {
        /*padding: 5px 0px;
    	margin-top:8px;	*/
        background-color: #FFFFFF;
        width: 200px;	
    	height: 200px;
        overflow: hidden;
    	opacity: 0;	
    	cursor:pointer;
    }
    .icon-choose-image2 {
        position: absolute;
        opacity: 0.1;
        top: 0%;
        left: 0%;
    }
    .icon-choose-image {
        position: absolute;
        opacity: 0.1;
        top: 50%;
        left: 50%;
        margin-top: -24px;
        margin-left: -24px;
        width: 48px;
        height: 48px;
    }
    .upload-preview {border-radius:4px;}
    #body-overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
    #body-overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}

</style>



<style>
body {font-family: calibri;}

td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

</style>
<script src="../js/admin.js"></script>
  <script src="../js/jquery-321.js"></script>
  
  
	<link rel="stylesheet" href="../js/jquery-ui-1.12.1.custom/jquery-ui.css">
    
  <script src="../js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
  <script src="../js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
 

<script type="text/javascript" src="../js/kickstart.js"></script>
</head>
<body style="min-width:1024px;">
<div class="header">





<div class="logs" style="float:right; line-height:120px">
	<a href="logout.php" style="margin-right:20px;">
    	<i class="fa fa-sign-out fa-2x tooltip-right" title="Log Out"></i><?php echo $loged_in;?> Log Out
   	</a>
</div>
</div>

<img src="../loading.gif" style="display:none; position:absolute; left:50%; top: 50%" id="loading_image_id" />

<div class="left-sidebar" style="width:200px"> 
    <ul class="menu vertical navadmin">

        <li class="admin_side_menu" id="side_menu_projects" onClick="ChangeSideMenu('projects')"><a href="#">Projects</a></li>
        <li class="admin_side_menu" id="side_menu_users_interested" onClick="ChangeSideMenu('users_interested')"><a href="#">Users Interested</a></li>
        <li class="admin_side_menu" id="side_menu_project_members" onClick="ChangeSideMenu('project_members')"><a href="#">Project Members</a></li>


</ul>
</div>


<?= GetProjectsPage() ?>
<?= GetUsersInterestedPage() ?>
<?= GetProjectMembersPage() ?>


<div id="dialog" title="Error Messages" style="display:none">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>

<div id="dialog_success" title="Success Message" style="display:none">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>


</body>
  
  <script type="text/javascript">
      ChangeSideMenu('projects')
  </script>
  
</html>

<script type="text/javascript">
    $(".combo_class").selectmenu(); 

        $('#projects_cb').on('selectmenuchange', function() {            
            ChangeInterestedTable()
        });

        $('#project_members_cb').on('selectmenuchange', function() {            
            ChangeProjectMembersTable()
        });
</script>
