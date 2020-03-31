<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/15/2019
 * Time: 12:43 PM
 */

namespace app\DefaultApp\Models;

use systeme\Model\Model;

class Participant extends Model
{
    private $id;
    private $nom;
    private $prenom;
    private $sexe;
    private $profession;
    private $telephone;
    private $email;
    private $date;
    private $id_event;
    private $id_user;
    private $send;

    /**
     * @return mixed
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * @param mixed $send
     */
    public function setSend($send)
    {
        $this->send = $send;
    }



    /**
     * @return mixed
     */
    public function getIdEvent()
    {
        return $this->id_event;
    }

    /**
     * @param mixed $id_event
     */
    public function setIdEvent($id_event)
    {
        $this->id_event = $id_event;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function mailExiste($prenom, $id_user)
    {
        $con = self::connection();
        $req = "SELECT *FROM participant WHERE  email='" . $prenom . "' and email!=''  and id_user='" . $id_user . "'";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function phoneExiste($prenom, $id_user)
    {
        $con = self::connection();
        $req = "SELECT *FROM participant WHERE  telephone='" . $prenom . "' and telephone!='' and id_user='" . $id_user . "'";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function ExistPhone($telephone){
        try{

            $con = self::connection();
            $req = "SELECT *FROM participant WHERE  telephone='" . $telephone . "' ";
            $rs = $con->query($req);
            if ($data = $rs->fetch()) {
                return true;
            } else {
                return false;
            }
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }
    public function enregistrer()
    {
        $con = self::connection();
        try {
            $req = "INSERT INTO participant(nom,prenom,sexe,telephone,email,profession,id_event,id_user) 
            VALUES (:nom,:prenom,:sexe,:telephone,:email,:profession,:event,:users) ";
            $stmt = $con->prepare($req);
            $param = array(
                ":nom" => $this->nom,
                ":prenom" => $this->prenom,
                ":sexe" => $this->sexe,
                ":telephone" => $this->telephone,
                ":email" => $this->email,
                ":event" => $this->id_event,
                ":users" => $this->id_user,
                ":profession" => $this->profession
            );
if($this->ExistPhone($this->telephone)){
    $req0 = "update participant set send=:send WHERE telephone=:telephone";
    $stmt0 = $con->prepare($req0);
    $param = array(
        ":send" => 'NON',
        ":telephone" => $this->telephone
    );

    $stmt0->execute($param);
    return " Participant(e) deja Enregistre(e)";
}


            if ($stmt->execute($param)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function modifier()
    {
        $con = self::connection();
        try {
            $req = "update participant set nom=:nom,prenom=:prenom,sexe=:sexe,telephone=:telephone,email=:email,profession=:profession WHERE id=:id";
            $stmt = $con->prepare($req);

            $param = array(
                ":nom" => $this->nom,
                ":prenom" => $this->prenom,
                ":sexe" => $this->sexe,
                ":telephone" => $this->telephone,
                ":email" => $this->email,
                ":profession" => $this->profession,
                ":id" => $this->id
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

    public function lister($id = "", $event = "")
    {
        try {
            $con = self::connection();
            if ($id == "") {
                $req = "select *from participant";
            } elseif ($id != "" && $event != "") {
                $req = "select *from participant where id_user='" . $id . "' and id_event='" . $event . "'";
            }  else {
                $req = "select *from participant where id_user='" . $id . "'";
            }

            $stmt = $con->prepare($req);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Participant");
            return $res;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function listerevent($id = "")
    {
        try {
            $con = self::connection();
            if ($id == "") {
                $req = "select *from participant";
            }  else {
                $req = "select *from participant where id_event='" . $id . "'";
            }

            $stmt = $con->prepare($req);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Participant");
            return $res;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }


    public static function rechercher($id)
    {
        try {
            $con = self::connection();
            $req = "select *from participant WHERE id=:id";
            $stmt = $con->prepare($req);
            $stmt->execute(array(":id" => $id));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Participant");
            if (count($res) > 0) {
                return $res[0];
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }


    public static function rechercher_user($id = "")
    {
        try {
            $con = self::connection();
            $req = "select *from participant ";
            $stmt = $con->prepare($req);
            $stmt->execute(array(":id" => $id));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Participant");
            if (count($res) > 0) {
                return $res[0];
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }


    public static function dernierId()
    {
        $con = self::connection();
        $req = "select id from participant order by id desc LIMIT 1";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['id'];


    }

    public static function delete($id)
    {
        $con = self::connection();

        $req = "delete from participant where id='" . $id . "'";

        $stmt = $con->prepare($req);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "no";
        }
    }
    public static function rechercherSend($id_event,$send=""){
        try {
            $con = self::connection();
            if($send=="") {
                $req = "select *from participant where send='NON' and id_event='" . $id_event . "'";
            }else{
                $req = "select *from participant where  id_event='" . $id_event . "'";
            }
            $stmt = $con->prepare($req);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Participant");
            if (count($res) > 0) {
                return $res;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
    public static  function updateSend($id)
    {
        $con = self::connection();
        try {
            $req = "update participant set send=:send WHERE id=:id";
            $stmt = $con->prepare($req);

            $param = array(
                ":send" => 'OUI',
                ":id" => $id
            );

            if ($stmt->execute($param)) {
                return array('r'=>'ok');
            } else {
                return array('r'=>'no');
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
    public static  function updateSendAll($id)
    {
        $con = self::connection();
        try {
            $req = "update participant set send=:send WHERE id_event=:id";
            $stmt = $con->prepare($req);

            $param = array(
                ":send" => 'NON',
                ":id" => $id
            );

            if ($stmt->execute($param)) {
                return 'ok';
            } else {
                return 'no';
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function countP($id)
    {
        $con=self::connection();
        $req="select COUNT(*) as 'nb' from participant  WHERE id_event='".$id."'";
        $rs = $con->query($req);
        $data=$rs->fetch();
        return $data['nb'];

    }
    public static function countParticipant($id="")
    {
        $con=self::connection();
        if($id=="") {
            $req="select COUNT(*) as 'nb' from participant ";
        }else{
            $req="select COUNT(*) as 'nb' from participant  WHERE id_user='".$id."'";
        }
       
        $rs = $con->query($req);
        $data=$rs->fetch();
        return $data['nb'];

    }
    public static function countSexe($sexe="",$id="")
    {
        $con=self::connection();
        if($id=="") {
            $req="select COUNT(*) as 'nb' from participant  WHERE sexe='".$sexe."'";
        }else{
            $req="select COUNT(*) as 'nb' from participant  WHERE sexe='".$sexe."' and id_user='".$id."'";
        }
       
        $rs = $con->query($req);
        $data=$rs->fetch();
        return $data['nb'];

    }
}