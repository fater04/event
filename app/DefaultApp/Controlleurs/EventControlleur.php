<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/17/2019
 * Time: 9:31 PM
 */

namespace app\DefaultApp\Controlleurs;


use systeme\Controlleur\Controlleur;

class EventControlleur extends Controlleur
{
    protected $nom_template = "admin_template";
    public function ajouter()
    {
        \app\DefaultApp\Models\Compteur::enregistre('add event',$_SESSION['utilisateur']);
        $variable = array();
        $variable['titre'] = "Ajouter Event";
        if($_SESSION['role']=="admin"){
            $utilisateur = $this->getModel('Event');
            $variable['lisevent'] = $utilisateur->lister();
        }else{
            $utilisateur = $this->getModel('Event');
            $variable['lisevent'] = $utilisateur->lister($_SESSION['utilisateur']);
        }



        if($_SESSION['role']=="admin"){
            $utilisateur = $this->getModel('Setting');
            $variable['listesetting'] = $utilisateur->lister();
        }else{
            $utilisateur = $this->getModel('Setting');
            $variable['listesetting'] = $utilisateur->lister($_SESSION['utilisateur']);
        }



        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $titre = trim(addslashes($_POST['titre']));
            $description = trim(addslashes($_POST['description']));
            $id_setting = trim(addslashes($_POST['setting']));
            $dat = $_POST['datedebut'];
            $titre = trim(addslashes($_POST['titre']));
            $dat = $_POST['datedebut'];

            if (isset($_POST['ajouter'])) {
                $id_user = trim(addslashes($_POST['id_user']));
                $heur = $_POST['heuredebut'];
                $date = $dat . " " . $heur;
                $ev1 = new \app\DefaultApp\Models\Event();
                $ev1->setTitre($titre);
                $ev1->setDescription($description);
                $ev1->setDateDebut($date);
                $ev1->setIdConfig($id_setting);
                $ev1->setIdUser($id_user);
                $r = $ev1->enregistrer();
            } else if (isset($_POST['modifier'])) {
                $idd = trim(addslashes($_POST['idd']));
                $date = $dat;
                $ev1 = new \app\DefaultApp\Models\Event();
                $ev1->setTitre($titre);
                $ev1->setDescription($description);
                $ev1->setDateDebut($date);
                $ev1->setIdConfig($id_setting);
                $ev1->setId($idd);
                $r = $ev1->modifier();            }
            if ($r == "ok") {

                $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Ajout</b> effectuee avec Succes.
                </div>
                <br/><div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   Redirection to <b>Event</b> in 3 seconds.
                </div><script>setTimeout(\"location.href = 'event';\",3000);</script>";
            } else {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $r . ".
                </div>";
            }
        }


        return $this->render("event/ajouter", $variable);
    }
    public function lister()
    {
        \app\DefaultApp\Models\Compteur::enregistre('lister event',$_SESSION['utilisateur']);
        $variable = array();
        $variable['titre'] = 'Event';
        $event1 = $this->getModel('Event');
if($_SESSION['role']=="admin"){
    $variable['lisevent'] = $event1->lister();
}else{
    $variable['lisevent'] = $event1->lister($_SESSION['utilisateur']);
}



        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $resultat = \app\DefaultApp\Models\Event::delete($id);
                if ($resultat == "ok") {

                    $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Suppression</b> effectuee avec Succes.
                </div><script>setTimeout(\"location.href = 'event';\",1000);</script>";
                }

            }
        }
        return $this->render("event/lister", $variable);
    }

    public function modifier($id)
    {
        \app\DefaultApp\Models\Compteur::enregistre('modifier event',$_SESSION['utilisateur']);
        $variable = array();
        $variable['id'] = $id;
        $variable['titre'] = "Modifier Utilisateur";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $nom = trim(addslashes($_POST['nom']));
            $prenom = trim(addslashes($_POST['prenom']));
            $telphone = trim(addslashes($_POST['telephone']));
            $email = trim(addslashes($_POST['email']));
            $pseudo = trim(addslashes($_POST['pseudo']));
            $id_user = trim(addslashes($_POST['idd']));
            $user = new \app\DefaultApp\Models\Utilisateur();
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setPseudo($pseudo);
            $user->setTelephone($telphone);
            $user->setId($id_user);
//            if (isset($_FILES['image']['name'])) {
            if ($_FILES['image']['size'] != 0) {
                $image = new \app\DefaultApp\Models\Image($_FILES['image']['name']);
                $image->Upload();
                $photo = $image->getSrc();
                $user->setPhoto($photo);
                $resultat = $user->modifierP();
            } else {
                $resultat = $user->modifierS();
            }
            if ($resultat == 'ok') {
                $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Modification</b> effectuee avec Succes.
                </div>";
            } else {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $resultat . ".
                </div>";
            }

        }

        return $this->render("utilisateur/modifier", $variable);
    }

}