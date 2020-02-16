<?php

namespace app\DefaultApp\Controlleurs;

use systeme\Controlleur\Controlleur;

class UtilisateurControlleur extends Controlleur
{
    protected $nom_template = "admin_template";

    public function ajouter()
    {
        $variable = array();
        $variable['titre'] = "Ajouter Utilisateur";
        $variable['entete'] = "<div class=\"row\">
                    <div class=\"col-sm-12\">
                        <div class=\"page-title-box\">
                            <h4 class=\"page-title\">Utilisateur</h4>
                            <ol class=\"breadcrumb float-right\">
                                <li class=\"breadcrumb-item\"><a href=\"#\">B-EVENT</a></li>
                                <li class=\"breadcrumb-item active\">User</li>
                            </ol>
                            <div class=\"clearfix\"></div>
                        </div>
                    </div>
                </div>";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $nom = trim(addslashes($_POST['nom']));
            $prenom = trim(addslashes($_POST['prenom']));
            $telphone = trim(addslashes($_POST['telephone']));
            $email = trim(addslashes($_POST['email']));
            $pseudo = trim(addslashes($_POST['pseudo']));
            $password = trim(addslashes($_POST['password']));
            $user = new \app\DefaultApp\Models\Utilisateur();
            $photo = "";
            if (isset($_FILES['image']['name'])) {
                $image = new \app\DefaultApp\Models\Image($_FILES['image']['name']);
                $image->Upload();
                $photo = $image->getSrc();
            }
            $user->setPhoto($photo);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setPseudo($pseudo);
            $user->setTelephone($telphone);
            $user->setMotdepasse($password);
            $user->setActive('NON');
            $user->setRole('Administrateur');
            $resultat = $user->Enregistrer();
            if ($resultat == 'ok') {
                $lien_activivation = "http://" . $_SERVER['HTTP_HOST'] . "/confirme-" . \app\DefaultApp\Models\Utilisateur::dernierId();
                $message = \app\DefaultApp\Models\Utilisateur::email_confirme($lien_activivation);
                \systeme\Application\Application::envoyerEmail($email . "," . $pseudo, "Email de Confirmation", $message);
                $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Account</b> create successfully.
                </div>";
            } else {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $resultat . ".
                </div>";
            }


        }


        return $this->render("utilisateur/ajouter", $variable);
    }

    public function modifier($id)
    {
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

    public function profile()
    {
        $variable = array();
        $variable['id'] = $_SESSION['utilisateur'];
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

    public function lister()
    {
        $variable = array();
        $variable['titre'] = "Lister Utilisateur";
        $variable['entete'] = "<div class=\"row\">
                    <div class=\"col-sm-12\">
                        <div class=\"page-title-box\">
                            <h4 class=\"page-title\">Utilisateur</h4>
                            <ol class=\"breadcrumb float-right\">
                                <li class=\"breadcrumb-item\"><a href=\"#\">B-EVENT</a></li>
                                <li class=\"breadcrumb-item active\">User</li>
                            </ol>
                            <div class=\"clearfix\"></div>
                        </div>
                    </div>
                </div>";
        $utilisateur = $this->getModel('Utilisateur');
        $variable['listeutilisateur'] = $utilisateur->lister();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $utilisateur = $this->getModel('Utilisateur');
            if(isset($_GET['role'])){
                $role=$_GET['role'];
                if($role=='admin'){
                    $variable['listeutilisateur'] = $utilisateur->lister('admin');
                }elseif ($role=='client'){
                    $variable['listeutilisateur'] = $utilisateur->lister('client');
                }elseif($role=='registrant'){
                    $variable['listeutilisateur'] = $utilisateur->lister('registrant');
                }elseif($role=='tous'){
                    $variable['listeutilisateur'] = $utilisateur->lister();
                }
            }
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



        return $this->render("utilisateur/lister", $variable);
    }

    public function change()
    {
        $variable = array();
        $variable['titre'] = "Change-Password";
        $variable['id'] = $_SESSION['utilisateur'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = trim(addslashes($_POST['idd']));
            $pass1 = trim(addslashes($_POST['pass1']));
            $pass2 = trim(addslashes($_POST['pass2']));
            $pass3 = trim(addslashes($_POST['pass3']));
            if (password_verify($pass1, \app\DefaultApp\Models\Utilisateur::password())) {
                $r = \app\DefaultApp\Models\Utilisateur::changePassword($id, $pass3);
                if ($r == "ok") {
                    $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Modification</b> effectuee avec Succes.
                </div>";
                } else {
                    $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $r . ".
                </div>";
                }
            } else {
                $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Current</b> password Incorrect.
                </div>";
            }
        }
        return $this->render("admin/change-password", $variable);
    }
}