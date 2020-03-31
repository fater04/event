<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 12/30/2018
 * Time: 1:12 PM
 */

namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Event;
use app\DefaultApp\Models\Galeri;
use app\DefaultApp\Models\Slide;
use systeme\Controlleur\Controlleur;

class AdminControlleur extends Controlleur
{
    protected $nom_template = "admin_template";


    public function accueil()
    {
        \app\DefaultApp\Models\Compteur::enregistre('accueil',$_SESSION['utilisateur']);
        $variable = array();
        $variable['titre'] = "HOME";
        $uti = $this->getModel('Event');
        if ($_SESSION['role'] == "admin") { 
        $variable['listerE'] = $uti->lister();
        }else{
            $variable['listerE'] = $uti->lister($_SESSION['utilisateur'] );
        }
        return $this->render("admin/home", $variable);

    }

    public function setting()
    {
        \app\DefaultApp\Models\Compteur::enregistre('setting',$_SESSION['utilisateur']);
        $variable = array();
        $variable['titre'] = "Configuration";
        $variable['id'] = $_SESSION['utilisateur'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id_user = $_SESSION['utilisateur'];
            $phone = trim(addslashes($_POST['phone']));
            $deviceid = trim(addslashes($_POST['deviceid']));
            $message = trim(addslashes($_POST['message']));
            if (isset($_POST['ajouter'])) {

                $s1 = new \app\DefaultApp\Models\Setting();
                $s1->setPhone($phone);
                $s1->setIdUser($id_user);
                $s1->setDeviceId($deviceid);
                $s1->setMessage($message);
                $resultat = $s1->Enregistrer();
            }

            if (isset($_POST['modifier'])) {
                $s2 = new \app\DefaultApp\Models\Setting();
                $s2->setId(trim(addslashes($_POST['idd'])));
                $s2->setPhone($phone);
                $s2->setIdUser($id_user);
                $s2->setDeviceId($deviceid);
                $s2->setMessage($message);
                $resultat = $s2->Modifier();

            }
            if ($resultat == 'ok') {
                $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Configuration</b> Enregistree avec Succes.
                </div><script>setTimeout(\"location.href='configuration';\",0);</script>";
            } else {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $resultat . "
                </div>";
            }

        }
        if (isset($_GET['remove'])) {
            $id = $_GET['remove'];
            $resultat = \app\DefaultApp\Models\Setting::delete($id);
            if ($resultat == "ok") {
                $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Suppression</b> effectuee avec Succes.
                </div><script>setTimeout(\"location.href = 'configuration';\",0);</script>";
            }

        }

        $utilisateur = $this->getModel('Setting');
        if($_SESSION['role']=="admin") {
            $variable['listesetting'] = $utilisateur->lister();

        }else{
            $variable['listesetting'] = $utilisateur->lister($_SESSION['utilisateur']);
        }

        
        return $this->render("admin/setting", $variable);

    }

    public function log()
    {
        $variable = array();
       
        $uti = $this->getModel('Compteur');
        $variable['loglist'] = $uti->lister();
        $variable['titre'] = "LOG  (".count($uti->lister()).")";
        return $this->render("admin/log", $variable);

    }
}