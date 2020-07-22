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
            $list=Participant::rechercherEnvoyer($deviceid);
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
        $p1=Participant::rechercher($json->id);
        if($p1->getNom()=="" && $p1->getPrenom()==""){
            $result = \app\DefaultApp\Models\Participant::updateSend($json->id);
            $r=Participant::delete($json->id);
        }else{
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

    public function rechercherUser()
    {

        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");

        if (isset($_GET['token'])) {
            $result = \systeme\Model\Utilisateur::search($_GET['token']);
        } else {
            $result = "Missing varible token";
        }
        echo json_encode($result);


    }

    public function envoyer()
    {
        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
        if (isset($_GET['token']) && isset($_GET['device']) && isset($_GET['phone']) && isset($_GET['message'])) {
            $token = Utilisateur::Rechercher($_GET['token']);
            $device = Setting::rechercher($_GET['device']);
            $phone = $_GET['phone'];
            $message = $_GET['message'];
            $result=Participant::ajouter($phone,$message,$device->getDeviceId(),$token->getId());
        } else {
            $result = "Missing Variable";
        }
        echo json_encode($result);
    }

//    public function login()
//    {
//        header("Access-control-Allow-Origin: *");
//        header("Content-Type: Application/json; charset=UTF-8");
//        $response = array();
//        $users['user']=array();
//        $etud['etud']=array();
//
//        for ($i = 0; $i < 25; $i++) {
//            array_push($users['user'],array(
//                "email" => 'wilker',
//                "password" => 'dor'
//            ) );
//        }
//        for ($i = 0; $i < 25; $i++) {
//            array_push($etud['etud'],array(
//                "email" => 'wilker',
//                "password" => 'dor'
//            ) );
//        }
//        array_push($response,$users);
//        array_push($response,$etud);
//        echo json_encode($response);
//    }
}

