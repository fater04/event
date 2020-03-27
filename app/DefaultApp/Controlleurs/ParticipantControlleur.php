<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/15/2019
 * Time: 1:04 PM
 */

namespace app\DefaultApp\Controlleurs;

use systeme\Controlleur\Controlleur;

class ParticipantControlleur extends Controlleur
{

    protected $nom_template = "admin_template";

    public function ajouter()
    {
        $variable = array();
        $variable['titre'] = "Ajouter Participant";
        $variable['nom'] = 'Participant';
//            $variable['erreur'] = "<div class=\"alert alert-danger alert-dismissable\">
//                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
//                    Veuillez D'abord ajouter une <b>Configuration</b>.
//                </div><script>setTimeout(\"location.href = 'configuration';\",4000);</script>";

        if($_SESSION['role']=="admin"){
            $utilisateur = $this->getModel('Event');
            $variable['lisevent'] = $utilisateur->lister();
        }else{
            $utilisateur = $this->getModel('Event');
            $variable['lisevent'] = $utilisateur->lister($_SESSION['utilisateur']);
        }

        return $this->render("participant/ajouter", $variable);
    }

    public function add($id)
    {
        $variable = array();
        $variable['titre'] = "Ajoute Participant";
        $variable['nom'] = 'Participant';
        $variable['id'] = $id;
        if (\app\DefaultApp\Models\Setting::checkConfig($_SESSION['utilisateur']) == '0' && $_SESSION['role'] != 'registrant') {
            $variable['erreur'] = "<div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    Veuillez D'abord ajouter une <b>Configuration</b>.
                </div><script>setTimeout(\"location.href = 'configuration';\",4000);</script>";
        }
        return $this->render("participant/ajouter", $variable);
    }

    public function lister()
    {
        $variable = array();
        $variable['titre'] = "Lister Utilisateur";
        if($_SESSION['role']=='admin'){
            $event1 = $this->getModel('Event');
            $utilisateur = $this->getModel('Participant');
            $variable['lisevent'] = $event1->lister();
            $variable['listeparticipant'] = $utilisateur->lister();
        }else{
            $event1 = $this->getModel('Event');
            $utilisateur = $this->getModel('Participant');
            $variable['lisevent'] = $event1->lister($_SESSION['utilisateur']);
            $variable['listeparticipant'] = $utilisateur->lister($_SESSION['utilisateur']);
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['event'])) {
                $role = $_GET['event'];
                if($_SESSION['role']=='admin'){
                    if ($role == 'all') {

                        $variable['listeparticipant'] = $utilisateur->lister();
                    } else {
                        $variable['listeparticipant'] = $utilisateur->listerevent($role);
                    }
                }else{
                    if ($role == 'all') {

                        $variable['listeparticipant'] = $utilisateur->lister($_SESSION['utilisateur']);
                    } else {
                        $variable['listeparticipant'] = $utilisateur->lister($_SESSION['utilisateur'], $role);
                    }
                }




            }
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $resultat = \app\DefaultApp\Models\Participant::delete($id);
                if ($resultat == "ok") {

                    $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Suppression</b> effectuee avec Succes.
                </div><script>setTimeout(\"location.href = 'all-participant';\",3000);</script>";
                }

            }
        }


        return $this->render("participant/lister", $variable);
    }

    //personne pour enregistrer
    public function add_registrant()
    {
        $variable = array();
        $variable['titre'] = "Ajouter registrant";
        $variable['nom'] = 'Registrant';
        if($_SESSION['role']=="admin"){
            $utilisateur = $this->getModel('Event');
            $variable['lisevent'] = $utilisateur->lister();
        }else{
            $utilisateur = $this->getModel('Event');
            $variable['lisevent'] = $utilisateur->lister($_SESSION['utilisateur']);
        }



        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $nom = trim(addslashes($_POST['nom']));
            //$prenom = trim(addslashes($_POST['prenom']));
            $event = trim(addslashes($_POST['event']));
            $email = trim(addslashes($_POST['email']));
            $password = trim(addslashes($_POST['password']));
            $user = new \app\DefaultApp\Models\Utilisateur();
            $user->setNom($nom);
            $user->setEmail($email);
            $user->setPseudo($email);
            $user->setMotdepasse($password);
            $user->setActive('OUI');
            $user->setRole('registrant');
            $resultat = $user->Enregistrer();
            if ($resultat == 'ok') {
                $id_user = \app\DefaultApp\Models\Utilisateur::dernierId();
                $r = \app\DefaultApp\Models\Event::event_registrant($event, $id_user);
                if ($r == 'ok') {
                    $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Account</b> create successfully.
                </div>";
                } else {
                    $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $r . ".
                </div>";
                }
            } else {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $resultat . ".
                </div>";
            }
        }
        return $this->render("participant/add_registrant", $variable);
    }

    public function edit_registrant($id)
    {
        $variable = array();
        $variable['titre'] = "Modifier registrant";
        $variable['id'] = $id;
        $utilisateur = $this->getModel('Event');
        $variable['lisevent'] = $utilisateur->lister($_SESSION['utilisateur']);
        $variable['nom'] = 'Registrant';
        return $this->render("participant/edit_registrant", $variable);
    }

    public function all_registrant()
    {
        $variable = array();
        $variable['titre'] = "Liste des registrant";
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $resultat = \app\DefaultApp\Models\Utilisateur::delete($id);
                if ($resultat == "ok") {

                    $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Suppression</b> effectuee avec Succes.
                </div><script>setTimeout(\"location.href = 'all-user';\",3000);</script>";
                }

            }
        }
        $utilisateur = $this->getModel('Utilisateur');
        $variable['listeutilisateur'] = $utilisateur->lister('registrant');
        return $this->render("participant/all_registrant", $variable);
    }
}