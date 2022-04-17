<?php session_start();?>
<?php        
    require_once('../includes/db.php');
    require_once('../includes/config.php');
    require_once('../includes/generators.php');
    
    
    ConnectToDatabase();
    
    $table   = 'users';
    $user_id = 'user_id';
    
    $loged_in = isLogedIn($table, $user_id);
    
    $display = "none";
    $error_message = "Wrong log in details";
    
    if(!$loged_in){
        ?>
            <script type="text/javascript">
                window.location.replace("../connexion");
            </script>               
        <?php
    }

?>
<!doctype html>
<html lang="en" class="h-100">

    <!-- Head -->
    <?=GetHead("Soumettre son projet")?>


<body class="d-flex flex-column h-100 bg-crl">

    
    <!-- Navigation -->
    <?=GetHeader()?>
    
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container mt-5">
            <div class="text-center">
                <h2 class="text-center mb-5 font-weight-bolder bluecolor">Soumettre son projet</h2>


            </div>
        </div>
        </main>
       <div class="row-mgh">
        <div class="container center-xy">
            <div class="submition">
                <div class="submition_box">
                    <form action="" onsubmit="return false;">
                        <div class="form-group">
                            <label for="">Titre</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="20" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <select name="category" id="category" class="form-control">

                                <option value=""> - Sélectionne - </option>
                                <option value="Alimentation / Santé">Alimentation / Santé</option>
                                <option value="Vie Sociale / Convivialité">Vie Sociale / Convivialité</option>
                                <option value="Logement">Logement</option>
                                <option value="Transport / Mobilité">Transport / Mobilité</option>
                                <option value="Citoyenneté / Entraide">Citoyenneté / Entraide</option>
                                <option value="Respect de l'environnement">Respect de l'environnement</option>
                                <option value="Loisirs & Sports / Culture">Loisirs & Sports / Culture</option>
                                <option value="International">International</option>
                                <option value="Autre">Autre</option>                              

                            </select>
                        </div>

                        <div class="form-group">
                            <select name="working" id="working" class="form-control" onchange="CheckWorking()">
                                <option value="alone">Projet en solo</option>
                                <option value="team">Projet en équipe</option>           
                            </select>
                        </div>

                        <div class="form-group" style="display: none; height: 60px" id="working_div">
                            <label for="">Ajoute leur adresse mail:</label>
                            <br />
                            <input type="email" name="team_member" id="team_member" class="form-control" 
                                    style="width: 50%; float: left; margin-right: 20px">

                            <button type="button" class="btn radius_btn_lg2 btn-block btn-blue" onclick="AddTeamMembers()"
                                     style="width: 100px; float: left; margin-top: 0px; padding-right: 20px; padding-left: 20px">Ajouter</button>

                            <p id="team_members" style="float: left; width: 100%; margin-top: 10px; padding-left: 10px;"></p>

                        </div>

                        <div class="alert alert-danger" role="alert" id="error_message" style="display: none;">
                            
                        </div>
                        <div class="alert alert-success" role="alert" id="success_message" style="display: none" >
                            
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn radius_btn_lg2 btn-block btn-purple" onclick="SubmitProject()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Footer -->
    <?=GetFooter()?>    
    </div>

    
</body>

    <!-- Bottom Scripts -->
    <?=GetBottomScripts()?>
</html>