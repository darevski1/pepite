<?php session_start();?>
<?php        
    require_once('../includes/db.php');
    require_once('../includes/config.php');
    require_once('../includes/generators.php');
    
    
    ConnectToDatabase();
    
?><!doctype html>
<html lang="en" class="h-100">


    <!-- Head -->
    <?=GetHead("Règlement")?>

<body class="d-flex flex-column h-100 bg-crl">
    
    <!-- Navigation -->
    <?=GetHeader()?>
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        </main>
       <div class="row-mgh">
        <div class="container mt-5 mb-5">
            <div style="background-color: white" >
                <h2 class="text-center mb-5 font-weight-bolder bluecolor">Règlement</h2>
                <p class="lead textleftalign">

<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Il s&rsquo;agit d&rsquo;un concours d&rsquo;id&eacute;es pour am&eacute;liorer la vie de votre campus sur l&rsquo;ensemble de la r&eacute;gion Bourgogne Franche Comt&eacute;.&nbsp;</span></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp;</span></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Vous pouvez participer seul ou en &eacute;quipe !&nbsp;</span></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp;</span></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Pr&eacute;senter de fa&ccedil;on courte et percutante une id&eacute;e originale d&rsquo;activit&eacute; / initiative / association / entreprise, en format digital ou papier gr&acirc;ce aux actions des membres de l&rsquo;organisation&nbsp;</span></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp;</span></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:underline;-webkit-text-decoration-skip:none;text-decoration-skip-ink:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Pour pr&eacute;senter l&rsquo;id&eacute;e :</span></p>
<p dir="ltr" style="line-height:1.38;margin-left: 36pt;text-indent: -18pt;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 18pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">-</span><span style="font-size:6.999999999999999pt;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp; &nbsp;</span><span style="font-size:6.999999999999999pt;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;"><span class="Apple-tab-span" style="white-space:pre;">&nbsp; &nbsp;&nbsp;</span></span><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Un nom qui interpelle</span></p>
<p dir="ltr" style="line-height:1.38;margin-left: 36pt;text-indent: -18pt;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 18pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">-</span><span style="font-size:6.999999999999999pt;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp; &nbsp;</span><span style="font-size:6.999999999999999pt;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;"><span class="Apple-tab-span" style="white-space:pre;">&nbsp; &nbsp;&nbsp;</span></span><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Une pr&eacute;sentation de l&rsquo;id&eacute;e (en quelques phrases, sch&eacute;ma ou image possible) avec deux &eacute;l&eacute;ments :</span></p>
<p dir="ltr" style="line-height:1.38;margin-left: 72pt;text-indent: -18pt;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 18pt;"><span style="font-size:12pt;font-family:'Courier New';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">o</span><span style="font-size:6.999999999999999pt;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp; &nbsp;</span><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">quelle est la nature de votre id&eacute;e, en quoi consiste votre solution (produit, service, application, plateforme, action collective, etc.)</span></p>
<p dir="ltr" style="line-height:1.38;margin-left: 72pt;text-indent: -18pt;margin-top:0pt;margin-bottom:0pt;padding:0pt 0pt 0pt 18pt;"><span style="font-size:12pt;font-family:'Courier New';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">o</span><span style="font-size:6.999999999999999pt;font-family:'Times New Roman';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">&nbsp; &nbsp;</span><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">quelle est son utilit&eacute; : qu&rsquo;est-ce que cela apporte aux &eacute;tudiants, &agrave; quel besoin ou probl&egrave;me cela apporte-t-il une solution utile et concr&egrave;te ?</span></p>
<p><br></p>
<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:12pt;font-family:Calibri,sans-serif;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">La soci&eacute;t&eacute; Teewii se garde le droit de supprimer ou de ne pas accepter toute proposition de projet &agrave; caract&egrave;re humiliante/haineuse/d&eacute;plac&eacute; envers une personne ou une communaut&eacute;.&nbsp;</span></p>

</p>

            </div>
        </div>

    </div>

    <!-- Footer --> 
    <?=GetFooter()?>  
</body>

    <!-- Bottom Scripts -->
    <?=GetBottomScripts()?>

</html>