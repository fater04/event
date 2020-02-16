<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 6/017/2019
 * Time: 14:30 AM
 */

namespace app\DefaultApp\Controlleurs;


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
        if(\app\DefaultApp\Models\Setting::rechercher($deviceid)){
            $s1=\app\DefaultApp\Models\Setting::rechercher($deviceid);
           $e1= \app\DefaultApp\Models\Event::rechercher_config($s1->getId());
           $list = \app\DefaultApp\Models\Participant::rechercherSend( $e1->getId());
            foreach ($list as $p) {
                array_push($participant, array(
                    'telephone' => $p->getTelephone(),
                    'id' => $p->getId(),
                    'sms' => $s1->getMessage(),

                ));
            }
            echo json_encode($participant);
        }else{
            echo json_encode($participant);
        }



    }

    public function updateSend()
    {
        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
        $result = \app\DefaultApp\Models\Participant::updateSend($json->id);
        echo json_encode($result);
    }
    public function checkConfig()
    {
        $json = json_decode(file_get_contents('php://input'));
        header("Access-control-Allow-Origin: *");
        header("Content-Type: Application/json; charset=UTF-8");
       echo json_encode(\app\DefaultApp\Models\Setting::checkDevice(strtolower($json->device_id)));
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

