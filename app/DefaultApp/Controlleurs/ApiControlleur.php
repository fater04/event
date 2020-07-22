<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 6/017/2019
 * Time: 14:30 AM
 */

namespace app\DefaultApp\Controlleurs;


use app\DefaultApp\Models\Participant;
use app\DefaultApp\Models\Setting;
use app\DefaultApp\Models\Utilisateur;
use systeme\Controlleur\Controlleur;

class ApiControlleur extends Controlleur
{
    /////////////////////////////API APk///////////////////////////////////////////

    public function login()
    {
        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
        $utilisateur = new Utilisateur();
        $result = $utilisateur->apiLogin($json->email, $json->password);
        echo json_encode($result);
    }

    public function check()
    {
        $participant = array();

        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
        $json = json_decode(file_get_contents('php://input'));
        $deviceid = $json->device;
        if (\app\DefaultApp\Models\Setting::rechercher($deviceid)) {
            $list = Participant::rechercherEnvoyer($deviceid);
            foreach ($list as $p) {
                array_push($participant, array(
                    'telephone' => $p->getTelephone(),
                    'id' => $p->getId(),
                    'sms' => $p->getMessage(),

                ));
            }
            echo json_encode($participant);
        } else {
            echo json_encode($participant);
        }


    }

    public function updateSend()
    {
        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
        $p1 = Participant::rechercher($json->id);
        if ($p1->getNom() == "" && $p1->getPrenom() == "") {
            $result = \app\DefaultApp\Models\Participant::updateSend($json->id);
            $r = Participant::delete($json->id);
        } else {
            $result = \app\DefaultApp\Models\Participant::updateSend($json->id);
        }

        echo json_encode($result);
    }

    public function checkConfig()
    {
        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
        echo json_encode(\app\DefaultApp\Models\Setting::checkDevice(strtolower($json->device_id)));
    }

    ////////////////////FIN////////////////////////////////

    public function rechercherUser()
    {

        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");

        if (isset($_GET['token'])) {
            $result = \systeme\Model\Utilisateur::search($_GET['token']);
        } else {
            $result = "Missing variable token";
        }
        echo json_encode($result);


    }


    public function send()
    {

//        {
//            "send": {
//            "token": "a71409b1e713c7eb83411c6cace2eeddb6bf8430332bcc30",
//            "device": "FA64259758",
//            "phone": "31110731",
//            "message": "test 1 2 3 "
//         }
//        }
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $data = json_decode(file_get_contents("php://input"), true);

        $token = $data['send']['token'];
        $device = $data['send']['device'];
        $phone = $data['send']['phone'];
        $message = $data['send']['message'];


        //test si vide
        if ($token == "" && $device == "" && $phone == "" && $message == "") {
            http_response_code(503);
            echo json_encode(array("message" => "Donnees Manquantes !", "status" => "no"));
        } else {
            //rechercher utilisateur
            $user = Utilisateur::RechercherToken($token);
            if ($user !=null) {
               //rechercher appareil
                $device = Setting::rechercher($device);
                if ($device != "0") {
                    $result = Participant::ajouter($phone, $message, $device->getDeviceId(), $user->getId());
                    if ($result == 'ok') {
                        http_response_code(200);
                        echo json_encode(array("message" => "envoyer avec succes", "status" => "ok"));
                    }else{
                        http_response_code(503);
                        echo json_encode(array("message" => $result, "status" => "no"));
                    }
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Device Introuvable !", "status" => "no"));

                }
            } else {

                http_response_code(503);
                echo json_encode(array("message" => "Token Inccorect !", "status" => "no"));
            }

        }

    }
    public function sends()
    {

//        {
//            "send": {
//            "token": "a71409b1e713c7eb83411c6cace2eeddb6bf8430332bcc30",
//            "device": "FA64259758",
//            "phones": [
//      {
//        "phone": "31110731"
//      },
//      {
//        "phone": "3111959"
//      }
//    ],
//            "message": "test 1 2 3 "
//         }
//        }
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $data = json_decode(file_get_contents("php://input"), true);

        $token = $data['send']['token'];
        $device = $data['send']['device'];
        $phones = $data['send']['phones'];
        $message = $data['send']['message'];


        //test si vide
        if ($token == "" && $device == ""  && $message == "") {
            http_response_code(503);
            echo json_encode(array("message" => "Donnees Manquantes !", "status" => "no"));
        } else {
            //rechercher utilisateur
            $user = Utilisateur::RechercherToken($token);
            if ($user !=null) {
               //rechercher appareil
                $device = Setting::rechercher($device);
                if ($device != "0") {
                    foreach ($phones as $p1){
                         Participant::ajouter($p1['phone'], $message, $device->getDeviceId(), $user->getId());
                    }
                        http_response_code(200);
                        echo json_encode(array("message" => count($phones)." envoyer avec succes", "status" => "ok"));

                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "Device Introuvable !", "status" => "no"));

                }
            } else {

                http_response_code(503);
                echo json_encode(array("message" => "Token Inccorect !", "status" => "no"));
            }

        }

    }

}

