<a href="https://event.bioshaiti.com/">Event</a>
===================

[EVENT](https://event.bioshaiti.com) est une application cree,pour enregistrer les participants d'une evenement, et de leur envoyer une email ou un smsm de bienvenue grace a une api qui la relie avec une app android.

<p align="center">
  <a href="#dashboard">Dashboard</a> --
  <a href="#participant">Particiapant</a> --
  <a href="#registrant">Registrant</a> --
  <a href="#configuration">Configuration</a> --
  <a href="#send Globale">Send Globale</a> --
  <a href="#evennmenet">Evennment</a> --
  <a href="api">API</a>
</p>
  <img src="./public/images/Screenshot_2020-10-07 B-EVENT - HOME.png" with="100%" alt="dashboard de l'application" />
  
  
  [API] voici les api utiliser
  
   http 
  
  
   $ http GET https://event.bioshaiti.com/v1/user token=a61499960f807e19728547d8f2bdb33e3f5cd9e98450324w
   
   #exemple
   ````http
   [
    {
        "id": "1",
        "pseudo": "user1",
        "email": "jhonsmith@test.com",
        "nom": "jhon",
        "prenom": "smith",
        "role": "admin",
        "active": "oui",
        "statut": "1",
        "date": "2019-04-11 15:18:04",
        "telephone": "99 99 99 99",
        "photo": "https://event.bioshaiti.com/app/DefaultApp/public/img/pp.jpg"
    }
]


`````
#envoiyez un sms 
$ http POST https://event.bioshaiti.com/v1/send  message = "bnjr" token="jdijdijd" phone="3939393" device=AW1111
````http 
``````
.......

``````
