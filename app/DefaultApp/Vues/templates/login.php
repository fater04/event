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

    <link href="<?php echo app::autre("plugins/switchery/switchery.min.css") ?>" rel="stylesheet">
    <link href="<?php echo app::css("bootstrap.min") ?>" rel="stylesheet">
    <link href="<?php echo app::css("icons") ?>" rel="stylesheet">
    <link href="<?php echo app::css("style") ?>" rel="stylesheet">
    <script src="<?php echo app::js("modernizr.min") ?>"></script>

</head>
<body>

<div class="wrapper-page">

    <?php if(isset($erreur)){echo $erreur;} ?>
    <?php if(isset($contenue)){echo $contenue;} ?>
</div>


<script>
    var resizefunc = [];
</script>

<!-- Plugins  -->
<script src="<?php echo app::js("jquery.min") ?>"></script>
<script src="<?php echo app::js("popper.min") ?>"></script>
<script src="<?php echo app::js("bootstrap.min") ?>"></script>
<script src="<?php echo app::js("detect") ?>"></script>
<script src="<?php echo app::js("fastclick") ?>"></script>
<script src="<?php echo app::js("jquery.slimscroll") ?>"></script>
<script src="<?php echo app::js("jquery.blockUI") ?>"></script>
<script src="<?php echo app::js("waves") ?>"></script>
<script src="<?php echo app::js("wow.min") ?>"></script>
<script src="<?php echo app::js("jquery.nicescroll") ?>"></script>
<script src="<?php echo app::js("jquery.scrollTo.min") ?>"></script>
<script src="<?php echo app::autre("plugins/switchery/switchery.min.js") ?>"></script>
<script src="<?php echo app::js("parsley.min") ?>"></script>
<!-- Custom main Js -->
<script src="<?php echo app::js("jquery.core") ?>"></script>
<script src="<?php echo app::js("jquery.app") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });



    } );

</script>
</body>

</html>
