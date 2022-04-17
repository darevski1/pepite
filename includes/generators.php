<?php

 

function GetFooter($dot = "."){

	$return_html = '';


    $return_html .= '<div id="dialog" title="Error Messages" style="display:none">';
    $return_html .= '  <p>This is the default dialog</p>';
    $return_html .= '</div>';

    $return_html .= '<div id="dialog_success" title="Success Message" style="display:none">';
    $return_html .= '  <p>This is the default dialog</p>';
    $return_html .= '</div>';


    $return_html .= '<footer class="footer">';
    $return_html .= '  <div class="container-fluid">';
    $return_html .= '    <div class="row disp-hsh no-gutters">';
    $return_html .= '      <div class="col-sm-3 themed-grid-col  center-s">';
    $return_html .= '        <img src="' . $dot . './assets/images/logo.png" class="into-logo-footer" alt="">';
    $return_html .= '      </div>';
    $return_html .= '      <div class="col-sm-6 themed-grid-col">';
    $return_html .= '        <div class="col">';
    $return_html .= '          <ul class="nav nav-footer">';
    $return_html .= '            <li class="nav-item">';
    $return_html .= '              <a class="nav-link active" href="' . $dot . './condition">Règlement</a>';
    $return_html .= '            </li>';
    $return_html .= '            <li class="nav-item">';
    $return_html .= '              <a class="nav-link" href="' . $dot . './privacy">Politique de confidentialité</a>';
    $return_html .= '            </li>';
    $return_html .= '          </ul>';
    $return_html .= '        </div>';
    $return_html .= '        <div class="col">';
    $return_html .= '          <p class="text-center mt-3 greycolor">Tous droits réservés &copy; ' . date("Y") . ' </p>';
    $return_html .= '        </div>';
    $return_html .= '      </div>';
    $return_html .= '      <div class="col-sm-3 themed-grid-col center-s">';
    $return_html .= '        <img src="' . $dot . './assets/images/waves-footer.png" class="into-logo-footer-1" alt="">';
    $return_html .= '      </div>';
    $return_html .= '    </div>';
    $return_html .= '  </div>';
    $return_html .= '</footer>';

    return $return_html;
}    


function GetHead($title = "", $dot = "."){

	$return_html = '';


    $return_html .= '<head>';
    $return_html .= '    <meta charset="utf-8">';
    $return_html .= '    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';


    $return_html .= '    <link rel="apple-touch-icon" sizes="180x180" href="' . $dot . './assets/images/favicon/apple-touch-icon.png">';
    $return_html .= '    <link rel="icon" type="image/png" sizes="32x32" href="' . $dot . './assets/images/favicon/favicon-32x32.png">';
    $return_html .= '    <link rel="icon" type="image/png" sizes="16x16" href="' . $dot . './assets/images/favicon/favicon-16x16.png">';
    $return_html .= '    <link rel="manifest" href="/site.webmanifest">';


    $return_html .= '    <title>' . $title . '</title>';


    $return_html .= '    <!-- Bootstrap core CSS -->';
    $return_html .= '    <link href="' . $dot . './assets/css/bootstrap.min.css" rel="stylesheet">';
    $return_html .= '    <link href="' . $dot . './assets/css/main.css" rel="stylesheet">';
    $return_html .= '    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" ';
    $return_html .= 'rel="stylesheet">';
    $return_html .= '    <!-- font awesome styles -->';
    $return_html .= '    <link rel="stylesheet" href="../assets/css/all.css">';
    $return_html .= '    <!-- font awesome js  -->';
    $return_html .= '    <script src="' . $dot . './assets/js/all.js"></script>';

    $return_html .= '</head>';


    return $return_html;
}


function GetBottomScripts($dot = "."){

	$return_html = '';

	$return_html .= '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"';
    $return_html .= '    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"';
    $return_html .= '    crossorigin="anonymous"></script>';
    $return_html .= '<script src="../assets/js/bootstrap.bundle.min.js"></script>';
    $return_html .= '<link rel="stylesheet" href="' . $dot . './js/jquery-ui-1.12.1.custom/jquery-ui.css">';
    $return_html .= '<script src="' . $dot . './js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>';
    $return_html .= '<script src="' . $dot . './js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>';
    $return_html .= '<script src="' . $dot . './assets/js/bootstrap.min.js"></script>';
    $return_html .= '<script src="' . $dot . './js/script.js"></script>';


    return $return_html;
}


function GetHeader($dot = "."){

	$return_html = '';

    $username = isLogedIn();

    $return_html .= '<nav class="nav justify-content-between nav-spacer">';
    $return_html .= '    <a class="navbar-brand" href="' . $dot . './"><img src="' . $dot . './assets/images/logo.png" style="width: 120px" alt=""></a>';
    $return_html .= '    <form class="form-inline my-2 my-lg-0">';

    if($username == false){
        $return_html .= '   <a href="' . $dot . './connexion"><button class="btn btn-secondary my-2 my-sm-0 radius_btn btn-purple" type="button">Connexion</button></a>';
        $return_html .= '   <a href="' . $dot . './register"><button class="btn btn-secondary my-2 my-sm-0 ml-2 radius_btn btn-blue" type="button">Connection</button></a>';
    }
    else{
        $return_html .= '   <a href="' . $dot . './profile"><button class="btn btn-secondary my-2 my-sm-0 ml-2 radius_btn btn-purple" type="button">';
        $return_html .= '   <i class="far fa-user"></i> &nbsp;&nbsp;&nbsp;' . $username . '</button></a>';
        $return_html .= '   <a href="' . $dot . './logout.php"><button class="btn btn-secondary my-2 my-sm-0 ml-2 radius_btn btn-blue" type="button">Log out</button></a>';
    }
    
    $return_html .= '    </form>';
    $return_html .= '</nav>';

    return $return_html;
}


function GetProjectsList($dot = ".", $user_id = 0){

    $voted = '0';
    $interested = '0';
    $where = "";

    $logged_in = isLogedIn();

    if($logged_in){
        $voted      = "(SELECT COUNT(project_id) FROM users_voted      WHERE user_id = " . $_SESSION['user_id'] . " AND project_id = p.id)";
        $interested = "(SELECT COUNT(project_id) FROM users_interested WHERE user_id = " . $_SESSION['user_id'] . " AND project_id = p.id)";
    }

    if($user_id != 0)
        $where = " AND user_id = $user_id ";

    $query = "SELECT id, title, description, category, votes, $voted AS voted, $interested AS interested
              FROM projects p
              WHERE status = 'Approved' $where
              ORDER BY votes DESC";


    $rows = QuerySelect($query);

    $return_html = '';

    for($i = 0; $i < count($rows); $i++){
        
        $voted_class = "fnt-aws";
        if(intval($rows[$i]['voted']) > 0)
            $voted_class = "fnt-aws1";
        
        if($i > 0)
            $return_html .= '<hr class="new1">';
        
        $return_html .= '<div class="post_block mt-5 mb-5">';
        $return_html .= '    <div class="lblock">';
        $return_html .= '        <div class="media p-2">';
        $return_html .= '            <div class="media-body">';
        $return_html .= '               <div class="category">';
        $return_html .= '                    <p>' . $rows[$i]['category'] . '</p>';
        $return_html .= '               </div>';
        $return_html .= '               <h4 class="mt-0 title-p">' . $rows[$i]['title'] . '</h4>';
        $return_html .= '               <p class="kbtext">' . $rows[$i]['description'] . '</p>';
        $return_html .= '            </div>';
        $return_html .= '       </div>';
        $return_html .= '       <div class="push-btn">';


        if(intval($rows[$i]['interested']) > 0)
            $return_html .= '       <button class="btn btn-secondary my-2 my-sm-0 ml-2 radius_btn btn-blue mt-5"><i class="fas fa-check"></i></button>';
        else{
            if($logged_in)
                $return_html .= '   <button class="btn btn-secondary my-2 my-sm-0 ml-2 radius_btn btn-blue mt-5" id="interested_button_' . $rows[$i]['id'] . '"
                                        onclick="InterestProject(' . $rows[$i]['id'] . ', \'' . $dot . '\')">Je rejoins le projet ! / Le projet m’intéresse</button>';
            else{
                $return_html .= '   <a href="' . $dot . './connexion">';     
                $return_html .= '       <button class="btn btn-secondary my-2 my-sm-0 ml-2 
                                            radius_btn btn-blue mt-5">Je rejoins le projet ! / Le projet m’intéresse</button>';
                $return_html .= '   </a>';
            }
        }

        $return_html .= '       </div>';
        $return_html .= '   </div>';
        $return_html .= '   <div class="rblock">';
        $return_html .= '       <div class="vote">';

        if(intval($rows[$i]['voted']) > 0){
            $return_html .= '       <div class="col vote-row">';
            $return_html .= '           <i class="fas fa-sort-up fnt-aws1"></i>';            
            $return_html .= '       </div>';
        }else{
            if($logged_in){
                $return_html .= '   <div class="col vote-row" style="cursor: pointer" id="vote_button_' . $rows[$i]['id'] . '"
                                            onclick="VoteProject(' . $rows[$i]['id'] . ', \'' . $dot . '\')">';
                $return_html .= '       <i class="fas fa-sort-up fnt-aws"></i>';            
                $return_html .= '   </div>';
            }
            else{
                $return_html .= '   <a href="' . $dot . './connexion">';
                $return_html .= '       <div class="col vote-row">';
                $return_html .= '           <i class="fas fa-sort-up fnt-aws"></i>';            
                $return_html .= '       </div>';       
                $return_html .= '   </a>';
            }
        }
        
        $return_html .= '           <div class="col vote-row" id="number_of_votes_' . $rows[$i]['id'] . '">';
        $return_html .=                 $rows[$i]['votes'];
        $return_html .= '           </div>';
        $return_html .= '       </div>';
        $return_html .= '   </div>';
        $return_html .= '</div>';
    }

    return $return_html;
}

