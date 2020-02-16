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

        $variable = array();
        $variable['titre'] = "Recover";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = trim(addslashes($_POST['email']));
            // \systeme\Application\Application::envoyerEmail($email . "," . $pseudo, "Email de Confirmation", $message);
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

    public function confirme($id)
    {

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

