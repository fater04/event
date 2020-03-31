<?php

namespace app\DefaultApp\Models;

use systeme\Model\Model;

class Compteur extends Model
{
    private $id;     
    private $navigateur;
    private $os;
    private $pages;
    private $device;
    private $ip;
    private $idUser;
    private $date;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of ip
     */ 
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set the value of ip
     *
     * @return  self
     */ 
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get the value of device
     */ 
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * Set the value of device
     *
     * @return  self
     */ 
    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

   
    
    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of os
     */ 
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set the value of os
     *
     * @return  self
     */ 
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }
 /**
     * Get the value of navigateur
     */ 
    public function getNavigateur()
    {
        return $this->navigateur;
    }

    /**
     * Set the value of navigateur
     *
     * @return  self
     */ 
    public function setNavigateur($navigateur)
    {
        $this->navigateur = $navigateur;

        return $this;
    }

    /**
     * Get the value of pages
     */ 
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set the value of pages
     *
     * @return  self
     */ 
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    public function __construct()
    {
        $this->ip = self::getIps();
        $this->device = self::getDevices();
        $this->navigateur = self::getBrowsers();
        $this->os = self::getSystem();
    }

    public static function lister()
    {
        try {
            $con = self::connection();
            $req = "select *from compteurs"; 
            $stmt = $con->prepare($req);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Compteur");
            return $res;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

  

    public static function delete($id)
    {
        $con = self::connection();

        $req = "delete from compteurs";

        $stmt = $con->prepare($req);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "no";
        }
    }
    

    public static function count($id)
    {
        $con=self::connection();
        $req="select COUNT(*) as 'nb' from compteurs";
        $rs = $con->query($req);
        $data=$rs->fetch();
        return $data['nb'];

    }
    public static function getSystem()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform  = "Inconnu";
        $os_array     = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;
        return ucfirst($os_platform);
    }
    public static function getDevices()
    {
        $deviceName = "";
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $devicesTypes = array(
            "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
            "tablet" => array("tablet", "android", "ipad", "tablet.*firefox"),
            "mobile" => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "bot" => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis"),
        );
        foreach ($devicesTypes as $deviceType => $devices) {
            foreach ($devices as $device) {
                if (preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }
        return ucfirst($deviceName);
    }

    public static function getIps()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public static function getBrowsers()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser        = "Inconnu";
        $browser_array = array( '/mobile/i'    => 'Handheld Browser',
                    '/msie/i'      => 'Internet Explorer',
                    '/trident/i'   => 'Internet Explorer',
                    '/firefox/i'   => 'Firefox',
                    '/safari/i'    => 'Safari',
                    '/chrome/i'    => 'Chrome',
                    '/edge/i'      => 'Edge',
                    '/opera/i'     => 'Opera',
                    '/netscape/i'  => 'Netscape',
                    '/maxthon/i'   => 'Maxthon',
                    '/konqueror/i' => 'Konqueror'
        );
        foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;
        return ucfirst($browser);
    }


    public static function rechercher($IP,$page)
    {
        try {
            $con = self::connection();
            $req = "select *from compteurs WHERE ip=:ip and pages=:page order by id DESC limit 1";
            $stmt = $con->prepare($req);
            $stmt->execute(array(":ip" => $IP,":page"=>$page));
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "app\\DefaultApp\\Models\\Compteur");
            if (count($res) > 0) {
                return $res[0];
            } else {
                return "0";;
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function save($page,$idUser)
    {
        $con = self::connection();
        try {
            $req = "INSERT INTO compteurs(navigateur,os,pages,device,ip,idUser) 
            VALUES (:navigateur,:os,:pages,:device,:ip,:idUser)";
            $stmt = $con->prepare($req);
            $param = array(
                ":navigateur" => $this->navigateur,
                ":os" => $this->os,
                ":pages" => $page,
                ":device"=>$this->device,
                ":ip"=>$this->ip,
                ":idUser"=>$idUser
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

    public static function enregistre($page,$idUser)
    {
        $compteur = new Compteur();

        if (self::rechercher(self::getIps(),$page)!="0") {
            $c1 = self::rechercher(self::getIps(),$page);
            $date1 = date_create($c1->getDate());
            $date2 = date_create(date('Y-m-d H:i:s'));
            $diff = date_diff($date1, $date2);
            if ($c1->getPages() == $page) {
                $mois = $diff->format('%m%') * 30 * 24 * 60;
                $jours = $diff->format('%d%') * 24 * 60;
                $heures = $diff->format('%h%') * 60;
                $minut = $diff->format('%i%');
                if (($mois + $jours + $heures + $minut) > 59) {
                    $compteur->save($page,$idUser);
                }
            }
        } else {
            $compteur->save($page,$idUser);
        }
    }
}