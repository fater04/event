<?php require_once "../../../vendor/autoload.php";
if (isset($_POST['ajouter_utilisateur'])) {
    $nom = trim(addslashes($_POST['nomcomplet']));
    $pseudo = trim(addslashes($_POST['pseudo']));
    $email = trim(addslashes($_POST['email']));
    $role = trim(addslashes($_POST['role']));
    $password = trim(addslashes($_POST['password']));
    $user = new \app\DefaultApp\Models\Utilisateur();
    $user->setNom($nom);
    $user->setEmail($email);
    $user->setPseudo($pseudo);
    $user->setRole($role);
    $user->setActive('oui');
    $user->setMotdepasse($password);
    $resultat = $user->Enregistrer();
    echo $resultat;
}
if (isset($_POST['modifier_utilisateur'])) {
    $id = $_POST['id_utilisateur'];
    $nom = trim(addslashes($_POST['nomcomplet']));
    $pseudo = trim(addslashes($_POST['pseudo']));
    $email = trim(addslashes($_POST['email']));
    $role = trim(addslashes($_POST['role']));
    $password = trim(addslashes($_POST['password']));
    $user = new \app\DefaultApp\Models\Utilisateur();
    $user->setNom($nom);
    $user->setEmail($email);
    $user->setPseudo($pseudo);
    $user->setRole($role);
    $user->setId($id);
    if ($password != "00000") {
        $user->setMotdepasse($password);
        $resultat = $user->Modifier();
    } else {
        $resultat = $user->Modifierr();
    }
    echo $resultat;
}
if (isset($_POST['modifier_password'])) {
    $nouvo_password = trim(addslashes($_POST['password2']));
    $confirmed_password = trim(addslashes($_POST['password3']));
    $id_utilisateur = $_POST['id_user'];
    if ($nouvo_password != $confirmed_password) {
        echo 'Les mots de passe ne sont pas identiques !';
    } else {
        $r = \app\DefaultApp\Models\Utilisateur::changePassword($id_utilisateur, $confirmed_password);
        /** if ($resultat->getMotdepasse() != $ancien_password) {            echo 'Ancien Mot de passe,Incorrect !';        } else {}        */
        echo $r;
    }
}
if (isset($_POST['loginn'])) {
    $email = trim(addslashes($_POST['email']));

    $password = trim(addslashes($_POST['password']));

    $utilisateur = new \app\DefaultApp\Models\Utilisateur();

    $result = $utilisateur->Connecter($email, $password);

    if ($result == 'ok') {
        echo "ok";
    } else {
        //echo "Email ou mot de passe Incorrect !!!";
        echo $result;
    }

}