<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/16/2019
 * Time: 12:41 PM
 */
require_once "../../../vendor/autoload.php";

if (isset($_POST['addP'])) {
   $telephone= trim(addslashes($_POST['telephone']));
    if(!preg_match('/^[0-9]{8}+$/', $telephone)){
          echo "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button> Phone number error
                </div>";
    }else{

    $id_user = trim(addslashes($_POST['idd']));
    $id_event = trim(addslashes($_POST['id_event']));
    $nom = trim(addslashes($_POST['nom']));
    $prenom = trim(addslashes($_POST['prenom']));
    $email = trim(addslashes($_POST['email']));
    $tel = "+509" . $telephone;
    $sexe = trim(addslashes($_POST['sexe']));
    $profession = trim(addslashes($_POST['profession']));

    $ev1=\app\DefaultApp\Models\Event::rechercher($id_event);
    $appareil=\app\DefaultApp\Models\Setting::rechercher($ev1->getIdConfig());

    $p = new \app\DefaultApp\Models\Participant();
    $p->setNom($nom);
    $p->setEmail($email);
    $p->setPrenom($prenom);
    $p->setSexe($sexe);
    $p->setTelephone($tel);
    $p->setIdEvent($id_event);
    $p->setIdUser(\app\DefaultApp\Models\Event::rechercher_user($id_event));
    $p->setProfession($profession);
    $p->setMessage($appareil->getMessage());
    $p->setDevice($appareil->getDeviceId());
    $resultat = $p->Enregistrer();
    if ($resultat == "ok") {
        if ($_SESSION['role'] == "admin") {
            $setting = new \app\DefaultApp\Models\Setting();
            $s = $setting->rechercher_user($id_user);
        } else {
            $setting = new \app\DefaultApp\Models\Setting();
            $s = $setting->rechercher_user(app\DefaultApp\Models\Event::return_Event(\app\DefaultApp\Models\Event::rechercher_registrant($id_user)));

        }
        if ($email != "") {
            //\systeme\Application\Application::envoyerEmail($email, app\DefaultApp\Models\Event::return_Nom($id_event), $s->getMessage());
        }
        echo "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Ajouter</b> avec Succes.
                </div><script type=\"text/javascript\">
    $(document).ready(function() {

        $(\".alert\").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
    } );

</script>";

    } else if ($resultat == 'phone_existe') {
        echo "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Telephone</b> already exists.
                </div>";
    } else if ($resultat == 'email_existe') {
        echo "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b>Email</b> already exists.
                </div>";
    } else {
        echo "<div class=\"alert alert-warning alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    " . $resultat . ".
                </div>";
    }
    }

}

if (isset($_POST['globale'])) {
    $event = trim(addslashes($_POST['event']));
    $message = trim(addslashes($_POST['message']));
    $e1 = \app\DefaultApp\Models\Event::rechercher($event);
    //update message du configuration
    $r = \app\DefaultApp\Models\Setting::updateMessage($e1->getIdConfig(), $message);
    if ($r == "ok") {
        $r1 = \app\DefaultApp\Models\Participant::updateSendAll($e1->getId());
        if ($r1 == "ok") {
            $list = \app\DefaultApp\Models\Participant::rechercherSend($e1->getId(), "OUI");
            foreach ($listeparticipant as $p) {
                if ($p->getEmail() != "") {
                    //\systeme\Application\Application::envoyerEmail($p->getEmail(), $e1->getTitre(), $message);
                }
            }
            echo "ok";
        }


    }
}
