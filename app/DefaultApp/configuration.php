<?php
$database=array(
    "serveur"=>"localhost",
    "nom_base"=>"biostmwu_Event",
    "utilisateur"=>"biostmwu_bios",
    "motdepasse"=>"Haiti2019"
);

$from=array(
"email"=>"info@event.bioshaiti.net",
    "nom"=>"B-Event"
);

$configurationEmail = array(
    "host" =>"event.bioshaiti.com",
    "utilisateur" =>"info@event.bioshaiti.com",
    "motdepasse" =>"Haiti2019#",
    "port"=>465,
    "from"=>$from
);

$configuration=array(
    "url"=>$_GET['url'],
    "database"=>$database,
    "configurationEmail"=>$configurationEmail,
    "dossierProjet"=>"",
    "nomApp"=>"DefaultApp"
);

//------------EXEMPLE ENVOYER EMAIL-------------
//une seule adresse email
/*$a="alcindorlos@gmail.com,los";

//plusieur adresse email

$a=array(
   "alcindorlos@gmail.com,los" ,
    "serveurlos@gmail.com,serveurlos"
);
$contenue="<h1>Une contenue en html</h1>";
$m=\systeme\Model\Model::envoyerEmail($a,"test plusier email",$contenue);
if($m=="ok"){
   echo "message envoyer avec success";
}else{
 echo $m;
}*/


