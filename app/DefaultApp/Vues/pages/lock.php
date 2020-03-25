<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 3/5/2019
 * Time: 11:44 AM
 */
$user = new \app\DefaultApp\Models\Utilisateur();
$u1 = $user->rechercher($id);
?>
<div class="text-center">
    <a href="#" class="logo-lg"><i class="mdi mdi-calendar-multiple-check"></i>&nbsp;<span>B-EVENT</span> </a>
</div>

<form method="post" action="#" role="form" class="text-center m-t-20">
    <div class="user-thumb">
        <img src="<?=$u1->getPhoto()?>" class="rounded-circle img-thumbnail"
             alt="thumbnail">
    </div>
    <div class="form-group">
        <h5 class="text-uppercase mt-2"><?=$u1->getPrenom()?>&nbsp;<?=$u1->getNom()?></h5>
        <p class="text-muted">Enter your password to access.</p>
        <div class="input-group m-t-30">

            <input type="password" class="form-control"  name="password"/>
            <input type="hidden" class="form-control"  name="pseudo" value="<?=$u1->getPseudo()?>"/>
            <i class="md md-vpn-key form-control-feedback l-h-34" style="left:6px;z-index: 99;"></i>
            <span class="input-group-append">
                            <button type="submit" class="btn btn-email btn-primary waves-effect waves-light"> Log In </button>
                        </span>
        </div>
    </div>
    <div class="text-right">
        <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("login")?>" class="text-muted">Not <?=$u1->getPrenom()?>&nbsp;<?=$u1->getNom()?> ?</a>
    </div>
</form>

