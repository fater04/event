<?php
/**
 * Created by PhpStorm.
 * User: ALCINDOR LOSTHELVEN
 * Date: 08/06/2018
 * Time: 14:17
 */

namespace app\DefaultApp\Models;


class Utilisateur extends \systeme\Model\Utilisateur
{

    public static function apiLogin($critere, $motdepasse)
    {
        try {
            $req = "select *from utilisateur where (pseudo='" . $critere . "' or email='" . $critere . "' or telephone='" . $critere . "') ";
            $rs = self::connection()->query($req);
            if ($data = $rs->fetch()) {
                if (password_verify($motdepasse, $data['motdepasse'])) {
                    if (isset($_SESSION['utilisateur'])) {
                        return "session";
                    } else {
                        $user = array();
                        $user['id'] = $data['id'];
                        $user['pseudo'] = $data['pseudo'];
                        $user['role'] = $data['role'];
                        $user['status']="ok";
                        $user['deviceID']=strtoupper(substr($data['pseudo'],0,2).rand(00000000, 99999999));
                        return $user;

                    }
                }else {
                    $user = array();
                    $user['id'] = "";
                    $user['pseudo'] = "";
                    $user['role'] = "";
                    $user['status']="incorrect";
                    $user['deviceID']="";
                return $user;
            }
        } else {
                return array('status'=>'incorrect');
    }
        } catch (Exception $ex)
{
throw new Exception($ex->getMessage());
}

}
public
static function delete($id)
{
    $con = self::connection();

    $req = "delete from utilisateur where id='" . $id . "'";

    $stmt = $con->prepare($req);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "no";
    }
}

public
function siBloquerDebloquer($id)
{
    $con = self::connection();
    $req = "select active from utilisateur WHERE id='" . $id . "'";
    $res = $con->query($req);
    $data = $res->fetch();
    return $data['active'];
}

public
static function rechercheUtilisateur($critere)
{
    $con = self::connection();
    $req = "select * from utilisateur WHERE 
                pseudo like '%" . $critere . "%' or 
                email like '%" . $critere . "%' or 
                nom like '%" . $critere . "%' or 
                prenom like '%" . $critere . "%'or 
                role like '%" . $critere . "%'or 
                telephone like '%" . $critere . "%'";
    $a = '';
    $res = $con->query($req);
    while ($data = $res->fetch()) {
        $a .= '<tr>

                <td class="mailbox-star"><i class="fa fa-info"></i></td>
                <td class="mailbox-name">' . $data['pseudo'] . '</td>
                <td class="mailbox-name">' . $data['nom'] . '&nbsp;' . $data['prenom'] . '</td>
                <td class="mailbox-name">' . $data['email'] . '</td>
                <td class="mailbox-name">' . $data['telephone'] . '</td>
                <td class="mailbox-name">' . $data['role'] . '</td>
                <td class=""><a href="lister_utilisateur" class="btn btn-info btn-xs">Afficher</a></td>
            </tr>';
    }
    return '<table class="table table-hover table-striped"><h5><strong>Utilisateur</strong></h5><tbody>' . $a . '</tbody></table>';

}

public
function lister($statut = "")
{
    try {
        $con = self::connection();
        if ($statut == "") {
            $req = "select *from utilisateur";
        } else {
            $req = "select *from utilisateur where role='" . $statut . "'";
        }

        $stmt = $con->prepare($req);
        $stmt->execute();
        $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "systeme\Model\Utilisateur");
        return $res;
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }
}

public
static function confirme($id)
{
    $req = "update utilisateur set active='oui' WHERE id='" . $id . "'";
    self::connection()->query($req);
    $con = null;
}
    public static function genereToken($id,$key)
    {
        try {
            $req = "update utilisateur set token='" .$key. "' WHERE id='" . $id . "'";
            $con = self::connection();
            if ($con->query($req)) {
                return "ok";
            } else {
                return "no";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


public
static function email_confirme($url)
{
    $val = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\"
      style=\"font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta name=\"viewport\" content=\"width=device-width\"/>
    
    <title>B-EVENT</title>
    <style type=\"text/css\">
        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6em;
        }

        body {
            background-color: #f6f6f6;
        }

        @media only screen and (max-width: 640px) {
            body {
                padding: 0 !important;
            }

            h1 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h2 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h3 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h4 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            .container {
                padding: 0 !important;
                width: 100% !important;
            }

            .content {
                padding: 0 !important;
            }

            .content-wrap {
                padding: 10px !important;
            }

            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;\"
      bgcolor=\"#f6f6f6\">

<table class=\"body-wrap\"
       style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\"
       bgcolor=\"#f6f6f6\">
    <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
        <td style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"
            valign=\"top\"></td>
        <td class=\"container\" width=\"600\"
            style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\"
            valign=\"top\">
            <div class=\"content\"
                 style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">
                <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" itemprop=\"action\" itemscope
                       itemtype=\"http://schema.org/ConfirmAction\"
                       style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\"
                       bgcolor=\"#fff\">
                    <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                        <td class=\"content-wrap\"
                            style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;\"
                            valign=\"top\">
                            <meta itemprop=\"name\" content=\"Confirm Email\"
                                  style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>
                            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"
                                   style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                    <td class=\"content-block\"
                                        style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"
                                        valign=\"top\">
                                        Please confirm your email address by clicking the link below.
                                    </td>
                                </tr>

                                <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                    <td class=\"content-block\" itemprop=\"handler\" itemscope
                                        itemtype=\"http://schema.org/HttpActionHandler\"
                                        style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"
                                        valign=\"top\">
                                        <a href=\"" . $url . "\" class=\"btn-primary\" itemprop=\"url\"
                                           style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #3bafda; margin: 0; border-color: #3bafda; border-style: solid; border-width: 10px 20px;\">Confirm
                                            email address</a>
                                    </td>
                                </tr>
                                <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                    <td class=\"content-block\"
                                        style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"
                                        valign=\"top\">
                                       ~B-EVENT
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class=\"footer\"
                     style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">
                    <table width=\"100%\"
                           style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                        <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                            <td class=\"aligncenter content-block\"
                                style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;\"
                                align=\"center\" valign=\"top\">&copy;2019&nbsp;<a href=\"https://event.bioshaiti.com/\"
                                                               style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;\">B-EVENT</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"
            valign=\"top\"></td>
    </tr>
</table>
</body>
</html>
";
    return $val;
}

public
static function email_other($text)
{
    $val = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\"
      style=\"font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
<head>
    <meta name=\"viewport\" content=\"width=device-width\"/>
    
    <title>B-EVENT</title>
    <style type=\"text/css\">
        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6em;
        }

        body {
            background-color: #f6f6f6;
        }

        @media only screen and (max-width: 640px) {
            body {
                padding: 0 !important;
            }

            h1 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h2 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h3 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h4 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            .container {
                padding: 0 !important;
                width: 100% !important;
            }

            .content {
                padding: 0 !important;
            }

            .content-wrap {
                padding: 10px !important;
            }

            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;\"
      bgcolor=\"#f6f6f6\">

<table class=\"body-wrap\"
       style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\"
       bgcolor=\"#f6f6f6\">
    <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
        <td style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"
            valign=\"top\"></td>
        <td class=\"container\" width=\"600\"
            style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\"
            valign=\"top\">
            <div class=\"content\"
                 style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">
                <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" itemprop=\"action\" itemscope
                       itemtype=\"http://schema.org/ConfirmAction\"
                       style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\"
                       bgcolor=\"#fff\">
                    <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                        <td class=\"content-wrap\"
                            style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;\"
                            valign=\"top\">
                            <meta itemprop=\"name\" content=\"Confirm Email\"
                                  style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>
                            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"
                                   style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                    <td class=\"content-block\"
                                        style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"
                                        valign=\"top\">
                                       " . $text . "
                                    </td>
                                </tr>

                            
                                <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                                    <td class=\"content-block\"
                                        style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"
                                        valign=\"top\">
                                       - B-EVENT
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class=\"footer\"
                     style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">
                    <table width=\"100%\"
                           style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                        <tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
                            <td class=\"aligncenter content-block\"
                                style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;\"
                                align=\"center\" valign=\"top\">&copy;2019&nbsp;<a href=\"https://event.bioshaiti.com/\"
                                                               style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;\">B-EVENT </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"
            valign=\"top\"></td>
    </tr>
</table>
</body>
</html>
";
    return $val;
}

public
static function ajouter_user_event($id_user, $id_event)
{
    try {

        $req = "insert into event_user (id_user, id_event) VALUES  ('" . $id_user . "','" . $id_event . "')";
        if (self::connection()->query($req)) {
            $con = null;
            return "ok";
        } else {
            $con = null;
            return "no";
        }

    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

public
static function return_id_via_email($email)
{
    $con = self::connection();
    $req = "SELECT id FROM  utilisateur where email='" . $email. "'";
    $rps = $con->query($req);
    $data = $rps->fetch();
    $id = $data['id'];
    $con = null;
    return $id;
}
public
static function return_event($id)
{
    $con = self::connection();
    $req = "SELECT *FROM event_user where id_user='" . $id . "'";
    $rps = $con->query($req);
    $data = $rps->fetch();
    $id = $data['id_event'];
    $con = null;
    return $id;
}

public
static function return_user($id)
{
    $con = self::connection();
    $req = "SELECT *FROM event_user where id_event='" . $id . "'";
    $rps = $con->query($req);
    $data = $rps->fetch();
    $id = $data['id_user'];
    $con = null;
    return $id;
}
public
static function return_user_pseudo($id)
{
    $con = self::connection();
    $req = "SELECT pseudo FROM utilisateur where id='" . $id . "'";
    $rps = $con->query($req);
    $data = $rps->fetch();
    $id = $data['pseudo'];
    $con = null;
    return $id;
}
}