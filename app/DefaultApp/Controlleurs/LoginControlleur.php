<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 3/5/2019
 * Time: 11:30 AM
 */

namespace app\DefaultApp\Controlleurs;


use systeme\Controlleur\Controlleur;

class LoginControlleur extends Controlleur
{
    protected $nom_template = "login";

    public function login()
    {

        \app\DefaultApp\Models\Compteur::enregistre('LOGIN','0');
        $variable = array();
        $variable['titre'] = "Login";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pseudo = trim(addslashes($_POST['pseudo']));
            $pass = trim(addslashes($_POST['pass']));
            $utilisateur = $this->getModel('Utilisateur');
            $result = $utilisateur->Connecter($pseudo, $pass);

            if ($result == 'inactif') {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    Account <b>Inactive</b>.
                </div>";

            } else if ($result == 'session') {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    Current <b>Session</b> on another pc.
                </div>";
            } else if ($result == 'incorrect') {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    User or Password <b>Incorrect</b>.
                </div>";
            } else {
                if (isset($_POST["remember"])) {
                    session_start();
                    $_SESSION["remember"] = "ok";
                } else {
                    session_start();
                    $_SESSION["remember"] = "non";
                }
            }
        }

        return $this->render("pages/login", $variable);

    }

    public function lock($id)
    {
        $variable = array();
        $variable['id'] = $id;
        $variable['titre'] = "Lock";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pseudo = trim(addslashes($_POST['pseudo']));
            $pass = trim(addslashes($_POST['password']));
            $utilisateur = $this->getModel('Utilisateur');
            $result = $utilisateur->Connecter($pseudo, $pass);
            if ($result == 'inactif') {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    Account <b>Inactive</b>.
                </div>";

            } else if ($result == 'session') {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    Current <b>Session</b> on another pc.
                </div>";
            } else if ($result == 'incorrect') {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    User or Password <b>Incorrect</b>.
                </div>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == "GET") {

//            $utilisateur = $this->getModel('Utilisateur');
//            $result = $utilisateur->Deconnecter();
            // \app\DefaultApp\DefaultApp::redirection('register');
        }


        return $this->render("pages/lock", $variable);

    }

    public function recover()
    {

        \app\DefaultApp\Models\Compteur::enregistre('Recover','0');
        $variable = array();
        $variable['titre'] = "Recover";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = trim(addslashes($_POST['email']));
            $lien= "http://".$_SERVER['HTTP_HOST']."/reset-".\app\DefaultApp\Models\Utilisateur::return_id_via_email($email);
            $other="Create new password by clicking this link below <br/>  <a href=\"" . $lien . "\" class=\"btn-primary\" itemprop=\"url\"
            style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #3bafda; margin: 0; border-color: #3bafda; border-style: solid; border-width: 10px 20px;\">Reset Password</a>";
            $message = \app\DefaultApp\Models\Utilisateur::email_other($other);
            $pseudo=" ";
            \systeme\Application\Application::envoyerEmail($email . "," . $pseudo, "Email de Recuperation", $message);
            $variable['erreur'] = "<div class=\"alert  alert-info\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b></b>Email</b> sent,verify your <b>email</b> address to follow the instructions.
                </div>";
        } else {
            $variable['erreur'] = "<div class=\"alert alert-success alert-dismissable\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
        Enter your <b>Email</b> and instructions will be sent to you!
    </div>";
        }

        return $this->render("pages/recover", $variable);

    }

    public function recoverPassword($id)
    {
        \app\DefaultApp\Models\Compteur::enregistre('Recover password',$id);
        $variable = array();
        $variable['titre'] = "Recover";
        $variable['id']=$id;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = trim(addslashes($_POST['idd']));
            $pass1 = trim(addslashes($_POST['pass1']));
            $pass2 = trim(addslashes($_POST['pass2']));
            if ($pass1===$pass2) {
                $r = \app\DefaultApp\Models\Utilisateur::changePassword($id, $pass2);
                if ($r == "ok") {
                  
                    $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Modification</b> effectuee avec Succes.<script>setTimeout(\"location.href = 'login';\",2000);</script>
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
                   Les <b>mots de passe </b> ne sont pas <b></b>Identiques.
                </div>";
            }
        }

        return $this->render("pages/newpassword", $variable);

    }

    public function confirme($id)
    {
        \app\DefaultApp\Models\Compteur::enregistre('Confirme Email',$id);
        $variable = array();
        $variable['titre'] = "Confimed Email";
        $variable['id'] = $id;
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            \app\DefaultApp\Models\Utilisateur::confirme($id);
            $variable['erreur'] = "<script>setTimeout(\"location.href = 'login';\",2000);</script>";

        }
        return $this->render("pages/confirme_email", $variable);

    }

    public function register()
    {
        \app\DefaultApp\Models\Compteur::enregistre('Register','0');
        $variable = array();
        $variable['titre'] = "Register";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = trim(addslashes($_POST['email']));
            $pseudo = trim(addslashes($_POST['pseudo']));
            $pass1 = trim(addslashes($_POST['password1']));
            $pass2 = trim(addslashes($_POST['password2']));

            if ($pass1 != $pass2) {
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    The <b>passwords</b> must be the same.
                </div>";
                $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Email</b> already exists.
                </div>";
            } else {
                $user = new \app\DefaultApp\Models\Utilisateur();
                $user->setEmail($email);
                $user->setPseudo($pseudo);
                $user->setMotdepasse($pass2);
                $user->setActive('NON');
                $user->setRole('inviter');
                $resultat = $user->Enregistrer_online();
                if ($resultat == 'ok') {
                    $lien_activivation = "http://" . $_SERVER['HTTP_HOST'] . "/confirme-" . \app\DefaultApp\Models\Utilisateur::dernierId();
                    $message = \app\DefaultApp\Models\Utilisateur::email_confirme($lien_activivation);
                    \systeme\Application\Application::envoyerEmail($email . "," . $pseudo, "Email de Confirmation", $message);
                    $variable['erreur'] = "<div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   <b>Account</b> create successfully,<br/>verify your <b>email</b> address to confirm.
                </div><br/><div class=\"alert  alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                   Redirection to <b>Login</b> in 3 seconds.
                </div><script>setTimeout(\"location.href = 'login';\",3000);</script>";
                } else if ($resultat == 'pseudo') {
                    $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Pseudo</b> already exists.
                </div>";
                } else if ($resultat == 'email') {
                    $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Email</b> already exists.
                </div>";
                } else {

                    $variable['erreur'] = "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $resultat . ".
                </div>";
                }
            }
        }

        return $this->render("pages/register", $variable);

    }

    public function logout()
    {
        \app\DefaultApp\Models\Compteur::enregistre('Logout',$_SESSION['utilisateur']);
        $variable = array();

        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $utilisateur = $this->getModel('Utilisateur');
            $result = $utilisateur->Deconnecter();
            setcookie("utilisateur", "", 0, "/", "event.bioshaiti.net", 0);
            setcookie("pseudo", "", 0, "/", "event.bioshaiti.net", 0);
            setcookie("role", "", 0, "/", "event.bioshaiti.net", 0);
            \app\DefaultApp\DefaultApp::redirection('login');

        }


        $variable['titre'] = "login";

        return $this->render("pages/login", $variable);

    }
}

