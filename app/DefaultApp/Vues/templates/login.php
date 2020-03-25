<?php
use systeme\Application\Application as app;
if(\app\DefaultApp\Models\Utilisateur::session()){
    if($_SESSION['role']=='registrant'){
        $idevent=\app\DefaultApp\Models\Event::rechercher_registrant($_SESSION['utilisateur']);
        if($idevent!=""){

       echo "<script>setTimeout(\"location.href = 'add_participant-".$idevent."';\",0);</script>";

        }else{
            echo "<script>setTimeout(\"location.href = 'ajouter-participant';\",0);</script>";
        }
    }else {
        \app\DefaultApp\DefaultApp::redirection("Home");
    }
}else {
    
    if(isset($_COOKIE['utilisateur']) && isset($_COOKIE['pseudo']) && isset($_COOKIE['role'])) {
        session_start();
        $_SESSION['utilisateur'] = $_COOKIE['utilisateur'];
        $_SESSION['pseudo'] = $_COOKIE['pseudo'];
        $_SESSION['role'] =$_COOKIE['role'];
        \app\DefaultApp\DefaultApp::redirection('login');
    }else{

    $utilisateur = $this->getModel('Utilisateur');
    $result = $utilisateur->Deconnecter();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
   <title> B-EVENT ~ <?php if (isset($titre)) echo $titre ?></title>

        <link href="<?= app::autre('assets/css/bootstrap.min.css')?>"  rel="stylesheet" type="text/css" />
        <link href="<?= app::autre('assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?= app::autre('assets/css/app.min.css')?>" rel="stylesheet" type="text/css" />

</head>
<body>

<div class="account-pages mt-5 mb-5">
            <div class="container">
            

            
    <?php if(isset($erreur)){echo $erreur;} ?>
    <?php if(isset($contenue)){echo $contenue;} ?>

</div>
        </div>
         <footer class="footer footer-alt">
        <?= date('Y')?> &copy; B-EVENT by <a href="https://www.bioshaiti.com" class="text-muted">BIOS</a> 
        </footer>
        <script src="<?= app::autre('assets/js/vendor.min.js')?>"></script>
        <script src="<?= app::autre('assets/js/app.min.js')?>"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });



    } );

</script>
</body>

</html>
