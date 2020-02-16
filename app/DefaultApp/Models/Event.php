<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/18/2019
 * Time: 9:33 PM
 */

namespace app\DefaultApp\Models;


use systeme\Model\Model;

class Event extends Model
{
    private $id;
    private $titre;
    private $description;
    private $date_debut;
    private $date;
    private $id_user;
    private $id_config;

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
    public function getIdConfig()
    {
        return $this->id_config;
    }

    /**
     * @param mixed $id_config
     */
    public function setIdConfig($id_config)
    {
        $this->id_config = $id_config;
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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param mixed $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param mixed $date_fin
     */
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
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
    public function DeviceExiste($nom)
    {
        $con=self::connection();
        $req = "SELECT *FROM event WHERE id_config='".$nom."' ";
        $rs = $con->query($req);
        if ($data = $rs->fetch()) {
            return true;
        } else {
            return false;
        }

    }


    public function enregistrer()
    {
        $con = self::connection();
        try {
            $req = "INSERT INTO event(titre,description,date_debut,id_user,id_config) 
            VALUES (:titre,:description,:date_debut,:id_user,:id_config) ";
            $stmt = $con->prepare($req);
            if($this->DeviceExiste($this->id_config))
            {
                return "cet appareil est deja attache a un autre evenement";
            }
            $param = array(
                ":titre" => $this->titre,
                ":description" => $this->description,
                ":date_debut" => $this->date_debut,
                ":id_user"=>$this->id_user,
                ":id_config"=>$this->id_config
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

    /**
     * @param $id_event
     * @param $id_participant
     * @return string
     * @throws \Exception
     */

    public static function event_registrant($id_event, $id_user)
    {
        $con = self::connection();
        try {
            $req = "INSERT INTO event_registrant(id_event,id_user) 
            VALUES (:id_event,:id_user) ";
            $stmt = $con->prepare($req);
            $param = array(
                ":id_event" => $id_event,
                ":id_user" => $id_user
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

    /**
     * @return string
     * @throws \Exception
     */
    public function modifier()
    {
        $con = self::connection();
        try {
            $req = "update event set titre=:titre,description=:description,date_debut=:date_debut ,id_config=:id_config WHERE id=:id";
            $stmt = $con->prepare($req);
            if($this->DeviceExiste($this->id_config))
            {
                return "cet appareil est deja attache a un autre evenement";
            }
            $param = array(
                ":titre" => $this->titre,
                ":description" => $this->description,
                ":date_debut" => $this->date_debut,
                ":id_config"=>$this->id_config,
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

    public  function lister($id_user= "")
    {
        try {
            $con = self::connection();
            if($id_user==""){
                $req = "select *from event";
            }else {
                $req = "select *from event where id_user='" . $id_user . "'";
            }

            $stmt = $con->prepare($req);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Event");
            return $res;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }



    public static function rechercher($id)
    {
        try {
            $con = self::connection();
            $req = "select *from event WHERE id=:id";
            $stmt = $con->prepare($req);
            $stmt->execute(array(":id" => $id));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Event");
            if (count($res) > 0) {
                return $res[0];
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function rechercher_config($id)
    {
        try {
            $con = self::connection();
            $req = "select *from event where id_config=:id ";
            $stmt = $con->prepare($req);
            $stmt->execute(array(":id" => $id));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Event");
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
        $req = "select id from event order by id desc LIMIT 1";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['id'];


    }

    public static function return_Nom($id)
    {
        $con = self::connection();
        $req = "select * from event where id='".$id."'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['titre'];


    }
    public static function return_Event($id)
    {
        $con = self::connection();
        $req = "select * from event where id='".$id."'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['id_user'];


    }
    public static function delete($id)
    {
        $con = self::connection();

        $req = "delete from event where id='" . $id . "'";

        $stmt = $con->prepare($req);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "no";
        }
    }
    public static function rechercher_registrant($id_registrant)
    {
        $con = self::connection();
        $req = "select * from event_registrant where id_user='".$id_registrant."'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['id_event'];


    }

    /**
     * @param $id_event
     * @return mixed
     */
    public static function rechercher_user($id_event)
    {
        $con = self::connection();
        $req = "select * from event where id='".$id_event."'";
        $rs = $con->query($req);
        $data = $rs->fetch();
        return $data['id_user'];


    }
    public static function delete_event_user($id)
    {
        $con = self::connection();

        $req = "delete from event_user where id_config='" . $id . "'";

        $stmt = $con->prepare($req);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "no";
        }
    }

}
