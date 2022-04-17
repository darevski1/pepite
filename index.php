<?php session_start();?>
<?php
require_once './includes/db.php';
require_once './includes/config.php';
require_once './includes/generators.php';

ConnectToDatabase();

?>
<!doctype html>
<html lang="en" class="h-100">


<!-- Head -->
<?=GetHead("Accueil", "")?>

<style type="text/css">
a:link {
    text-decoration: none;
}

a:visited {
    text-decoration: none;
}

a:hover {
    text-decoration: none;
}

a:active {
    text-decoration: none;
}

.popup {
    display: none;
}

.popup.open {
    display: block;
}

.blocker {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    d right: 0;
    content: ' ';
    background: rgba(0, 0, 0, .5);
}

.popup .contents {
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 300px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFF;
    position: fixed;
    padding: 10px;
    top: 50vh;
    left: 50vw;
    transform: translate(-50%, -50%);
}
</style>

<body class="d-flex flex-column h-100">

    <!-- Navigation -->
    <?=GetHeader("")?>

    <!-- Begin page content -->

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="introloader">
            <div class="overboat">
                <div class="overboat-bg">
                    <div class="container-fluid">
                        <div class="row hgs no-gutters">
                            <div class="col-sm-4 themed-grid-col">
                                <img src="./assets/images/waves.png" class="into-logo" alt="" srcset="">
                            </div>
                            <div class="col-sm-8  intro-text-style">
                                <h1 class="small-h1">Entreprends pour ton campus !</h1>
                                <p class="lead font-bold">Propose et vote pour des projets qui feront avancer la vie sur
                                    ton Campus. Pépite t’aidera à te lancer et te permettra de collaborer avec d’autres
                                    étudiants qui souhaitent voir la vie étudiante de leur campus évoluer. Tu possèdes 3
                                    votes pour voter pour tes 3 projets que tu aimerais le plus se voir réaliser.</p>
                                <p class="lead">
                                    <a class="btn btn-primary btn-lg intro-btn radius_btn_lgl negativebtn"
                                        href="./submission" role="button">Propose ton idée pour améliorer le campus
                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-circle"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path fill-rule="evenodd"
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <div class="row-mgh">
        <div class="container">
            <h2 class="text-center main-title mt-4" style="font-size:2.5em">Tente de gagner des tablettes ou des stages
                d’activités à sensation forte en proposant ton projet pour améliorer la vie de ton campus</h2>
            <div class="ceneterl">
                <div class="mt-title "></div>

            </div>
            <a href="./submission">
                <div class="block-assign justify-content-center">

                    <h1 class="text-center">Propose ton idée pour améliorer le campus <svg width="1.5em" height="1.5em"
                            viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path fill-rule="evenodd"
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg></h1>

                </div>
            </a>

            <?=GetProjectsList("");?>

            <!-- Footer -->
        </div>

        <div id="dialog" title="Error Messages" style="display:none">
            <p>This is the default dialog which is useful for displaying information. The dialog window can be moved,
                resized and closed with the 'x' icon.</p>
        </div>

        <div id="dialog_success" title="Success" style="display:none">
            <p>This is the default dialog which is useful for displaying information. The dialog window can be moved,
                resized and closed with the 'x' icon.</p>
        </div>


        <div class="popup">
            <div class="blocker" onclick="hidePopup()"></div>
            <div class="contents" id="popup_div">This is popup</div>
        </div>

        <?=GetFooter("")?>
</body>

<script type="text/javascript">
const popup = document.querySelector('.popup');

function showPopup() {
    popup.classList.add('open');
}

function hidePopup() {
    popup.classList.remove('open');
}
</script>

<!-- Bottom Scripts -->
<?=GetBottomScripts("")?>

</html>