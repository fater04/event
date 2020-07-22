<?php
$database=array(
    "serveur"=>"localhost",
    "nom_base"=>"biostmwu_Event",
    "utilisateur"=>"biostmwu_bios",
    "motdepasse"=>"Haiti2019"
);

//  "serveur"=>"localhost",
//     "nom_base"=>"event",
//     "utilisateur"=>"root",
//     "motdepasse"=>"root"
 

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



// \systeme\Application\Application::Backup() ;
