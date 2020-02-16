<?php
use systeme\Application\Application as app;
if(\app\DefaultApp\Models\Utilisateur::session()){
    \app\DefaultApp\DefaultApp::redirection("login");
}
//?>
