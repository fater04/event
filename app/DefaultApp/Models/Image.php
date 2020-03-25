<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 16/03/2018
 * Time: 21:42
 */
namespace app\DefaultApp\Models;
use systeme\Application\Application;
use systeme\Model\Model;

class Image extends Model
{

    private $id;
    private $src;
    private $alt;
    private $location;
    private $locatioWeb="app/DefaultApp/public/img/";
    private $typeImage;
    private $dossier_destination;

    const TYPE_ACCEPTER=array(
        "jpg",
        "png",
        "JPG",
        "PNG",
        "gif",
        "jpeg",
        "JPEG"
    );

    public function dossierDestination(){
        return str_replace("\\","/",dirname(__DIR__))."/public/img/";
    }

    /**
     * Image constructor.
     * @param $src
     * @param $alt
     */
    public function __construct($lien_image="")
    {
        $this->alt=basename($lien_image);
        $this->location=$this->dossierDestination().basename($lien_image);
        $this->locatioWeb.=basename($lien_image);
        $this->typeImage= pathinfo($this->location,PATHINFO_EXTENSION);

        if($lien_image==""){

        }else{
            if(!in_array($this->typeImage,self::TYPE_ACCEPTER))
            {
                throw new \Exception("Seulment image de type ".implode(",",self::TYPE_ACCEPTER)." Accepter");
            }
        }

    }

    public function Upload()
    {
        try{
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $this->location)) {
                $this->src=$this->locatioWeb;
                $this->location=$this->locatioWeb;
                return true;
            }else{
                return false;
            }
        }catch (\Exception $ex){
            throw new \Exception($ex->getMessage());
        }

    }

    public function Convert64bite()
    {
        if($this->Upload())
        {
            $type = pathinfo($this->src,PATHINFO_EXTENSION);
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT']."/".Application::nomApp()."/".$this->src);
            unlink($_SERVER['DOCUMENT_ROOT']."/".Application::nomApp()."/".$this->src);
            $this->src='data:image/' . $type . ';base64,' . base64_encode($data);
            return true;
        }else
        {
            return false;
        }
    }

    public function imageToString()
    {
        if($this->Upload())
        {
            $type = pathinfo($this->src,PATHINFO_EXTENSION);
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT']."/".Application::nomApp()."/".$this->src);
            unlink($_SERVER['DOCUMENT_ROOT']."/".Application::nomApp()."/".$this->src);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }else
        {
            return "";
        }
    }


    public function Enregistrer($methode)
    {
        $con=self::connection();
        if($methode=="upload")
        {
            $this->Upload();
        }elseif($methode=="64bit")
        {
            $this->Convert64bite();
        }else{
            throw new \Exception("Methode Inconnu: verifier bien la methode (methode=64bit ou upload)");
        }
        $req="insert into image (src, alt, location, type) VALUES ('".$this->src."'
            ,'".$this->alt."','".$this->locatioWeb."','".$this->typeImage."')";
        $con->query($req);
    }

    public function DernierImageEnregistrer()
    {
        $con=self::connection();
        $req="select *from image order by id desc";
        $rs=$con->query($req);
        if($data=$rs->fetch())
        {
            $i=new Image();
            $i->setId($data['id']);
            $i->setAlt($data['alt']);
            $i->setLocation($data['location']);
            return $i;
        }else{
            return null;
        }
    }

    public function Rechercher($id)
    {
        $con=self::connection();
        $req="select *from image where id='".$id."'";
        $rs=$con->query($req);
        if($data=$rs->fetch())
        {
            $i=new Image();
            $i->setId($data['id']);
            $i->setAlt($data['alt']);
            $i->setLocation($data['location']);
            return $i;
        }else{
            return null;
        }
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getTypeImage()
    {
        return $this->typeImage;
    }

    /**
     * @param mixed $typeImage
     */
    public function setTypeImage($typeImage)
    {
        $this->typeImage = $typeImage;
    }

    /**
     * @return string
     */
    public function getDossierDestination()
    {
        return $this->dossier_destination;
    }

    /**
     * @param string $dossier_destination
     */
    public function setDossierDestination($dossier_destination)
    {
        $this->dossier_destination = $dossier_destination;
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
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param mixed $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }








}