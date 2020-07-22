<?php

use app\DefaultApp\DefaultApp as App;

//Api
App::post("/apiLogin", "Api.login", "apilogin");
App::post("/check", "Api.check", "check");
App::post("/updatesend", "Api.updatesend", "updatesend");
App::post("/check-config", "Api.checkConfig", "check-config");
App::get("/user","api.rechercherUser");
App::post("envoyer","api.envoyer");


//bios_sms_sender_v1.0.0.apk
//App::get("/", "Admin.accueil");


App::get("/", "Admin.accueil");
//App::post("/", "pages.accueil");
//App::post("/accueil", "pages.accueil","home");
App::get("/Home", "Admin.accueil","Home");

//log
App::get("/logs", "Admin.log","logs");

///root login
App::get("/login", "Login.login", "login");
App::post("/login", "Login.login", "login");
App::get("/logout", "Login.logout","logout");
App::get("/lock-:id", "Login.lock", "lock")->avec("id","['0-9']+");
App::post("/lock-:id", "Login.lock", "lock")->avec("id","['0-9']+");
App::get("/recover", "Login.recover", "recover");
App::post("/recover", "Login.recover", "recover");
App::get("/confirme-:id", "Login.confirme", "confirme")->avec("id","['0-9']+");
App::get("/register", "Login.register", "register");
App::post("/register", "Login.register", "register");
App::get("/reset-:id", "Login.recoverPassword", "reset")->avec("id","['0-9']+");
App::post("/reset-:id", "Login.recoverPassword", "reset")->avec("id","['0-9']+");

//configuration
App::get("/configuration", "Admin.setting", "configuration");
App::post("/configuration", "Admin.setting", "configuration");

//utilisateur
App::get("/add-user", "utilisateur.ajouter", "add-user");
App::post("/add-user", "utilisateur.ajouter", "add-user");
//participant
App::get("/ajouter-participant", "participant.ajouter", "ajouter-participant");
App::post("/add-participant", "participant.ajouter", "add-participant");
App::get("/all-participant", "participant.lister","all-participant");
App::get("/add-participant-:id", "participant.add","add-participant")->avec("id","['0-9']+");
App::post("/add-participant-:id", "participant.add","add-participant")->avec("id","['0-9']+");

//registrant
App::get("/add-registrant", "participant.add_registrant", "add-registrant");
App::post("/add-registrant", "participant.add_registrant", "add-registrant");
App::get("/all-registrant", "participant.all_registrant", "all-registrant");
App::post("/all-registrant", "participant.all_registrant", "all-registrant");
App::get("/edit-registrant-:id", "participant.edit_registrant","edit-registrant")->avec("id","['0-9']+");
App::post("/edit-registrant-:id", "participant.edit_registrant","edit-registrant")->avec("id","['0-9']+");

App::get("/edit-user-:id", "utilisateur.modifier","edit-user")->avec("id","['0-9']+");
App::post("/edit-user-:id", "utilisateur.modifier","edit-user")->avec("id","['0-9']+");
App::get("/all-user", "utilisateur.lister","all-user");

//profile
App::get("/profile", "utilisateur.profile","profile");
App::post("/profile", "utilisateur.profile","profile");

//change password change-password
App::get("/change-password", "utilisateur.change","change-password");
App::post("/change-password", "utilisateur.change","change-password");

//events
App::get("/add-event", "Event.ajouter","add-event");
App::post("/add-event", "Event.ajouter","add-event");
App::get("/event", "Event.lister","event");
App::post("/event", "Event.lister","event");
App::get("/edit-event-:id", "Event.modifier","edit-event")->avec("id","['0-9']+");
App::post("/edit-event-:id", "Event.modifier","edit-event")->avec("id","['0-9']+");
App::get("/all-event", "Event.lister","all-event");
App::post("/all-event", "Event.lister","all-event");


