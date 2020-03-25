<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/12/2019
 * Time: 1:53 PM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Setting extends Model
{
private $id;
private $id_user;
private $device_id;
private $email;
private $motdepasse;
private $message;
private $token;
private $phone;

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getDeviceId()
    {
        return $this->device_id;
    }

    /**
     * @param mixed $device_id
     */
    public function setDeviceId($device_id)
    {
        $this->device_id = $device_id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * @param mixed $motdepasse
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }


    public function PhoneExiste($nom)
    {
        $con=self::connection();
        $req = "SELECT *FROM setting WHERE phone='".$nom."' ";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return true;
        } else {
            return false;
        }

    }
    public function DeviceExiste($nom)
    {
        $con=self::connection();
        $req = "SELECT *FROM setting WHERE device_id='".$nom."' ";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return true;
        } else {
            return false;
        }

    }
    public static function return_Nom($id)
    {
        $con = self::connection();
        $req = "select * from setting where id='".$id."'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['email']." : ".$data['device_id'];


    }
    public static function updateMessage($id,$message)
    {
        $con = self::connection();
        try {
            $req = "update setting set message=:message WHERE id=:id";
            $stmt = $con->prepare($req);

            $param = array(
                ":message" => $message,
                ":id" => $id
            );

            if ($stmt->execute($param)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
    public function enregistrer()
    {
        $con=self::connection();
        try {
            $req = "INSERT INTO setting(id_user,device_id,phone,message) 
            VALUES (:id_user,:device_id,:phone,:message) ";
            $stmt = $con->prepare($req);

            if($this->PhoneExiste($this->phone))
            {
                return "Phone existe sur le systeme";
            }
            if($this->DeviceExiste($this->device_id))
            {
                return "Phone existe sur le systeme";
            }

            $param=array(
                ":id_user" => $this->id_user,
                ":device_id" => $this->device_id,
                ":phone" => $this->phone,
                ":message" => $this->message
            );

            if ($stmt->execute($param)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public  function lister($id_user=""){
        try{
            $con=self::connection();
            if($id_user=="") {
                $req = "select *from setting";
            }else{
                $req="select * from setting where id_user='".$id_user."'";
            }
            $stmt=$con->prepare($req);
            $stmt->execute();
            $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\\DefaultApp\\Models\\Setting");
            return $res;
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    public static function rechercher($id){
        try{
            $con=self::connection();
            $req="select *from setting WHERE id=:id or device_id=:id";
            $stmt=$con->prepare($req);
            $stmt->execute(array(":id"=>$id));
            $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\\DefaultApp\\Models\\Setting");
            if(count($res)>0){
                return $res[0];
            }else{
                return null;
            }
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
    public static function rechercher_user($id){
        try{
            $con=self::connection();
            $req="select *from setting WHERE id_user=:id";
            $stmt=$con->prepare($req);
            $stmt->execute(array(":id"=>$id));
            $res=$stmt->fetchAll(\PDO::FETCH_CLASS,"app\\DefaultApp\\Models\\Setting");
            if(count($res)>0){
                return $res[0];
            }else{
                return 'rien';
            }
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    public function modifier()
    {
        $con=self::connection();
        try {
            $req = "update setting set id_user=:id_user,device_id=:device_id,phone=:phone,message=:message WHERE id=:id";
            $stmt = $con->prepare($req);

            $param=array(
                ":id_user" => $this->id_user,
                ":device_id" => $this->device_id,
                ":phone" => $this->phone,
                ":message" => $this->message,

                ":id"=>$this->id
            );

            if ($stmt->execute($param)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function dernierId()
    {
        $con=self::connection();
        $req="select id from setting order by id desc LIMIT 1";
        $rs = $con->query($req);
        $data=$rs->fetch();
        return $data['id'];

    }
    public static function checkConfig($id)
    {
        $con=self::connection();
        $req="select COUNT(*) as 'nb' from setting where id_user='".$id."' ";
        $rs = $con->query($req);
        $data=$rs->fetch();
        return $data['nb'];

    }
    public static function delete($id)
    {
        $con = self::connection();

        $req = "delete from setting where id='" . $id . "'";

        $stmt = $con->prepare($req);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "no";
        }
    }
    public static function checkDevice($id){
        $con=self::connection();
        $req = "SELECT *FROM setting WHERE device_id='".$id."' ";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return array(
                'resultat'=>'OUI');
        } else {
            return array(
                'resultat'=>'NON');
        }
    }
}