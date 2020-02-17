<?php

require "../pandora_functions/define.php";
require "../pandora_functions/route.php";
require "../pandora_functions/error_handle.php";
require "../pandora_functions/html.php";
require "../pandora_functions/h.php";
/**
 * Router
 *
 * routes[0] = Action
 * routes[1] = Shop Name
 * routes[2] = Shop Access Key
 * routes[3] = Clerk IDm
 */
class RouteCheck
{

        function preg(){
                list ($routes,$count) = route(API_URL);
                                $dsn = 'mysql:host='.DBServer.';dbname='.DBName.';charset=utf8';
                                $db = new PDO($dsn,DBUser,DBPassword);
                                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if ($routes[0] == "") {
                        dead(404);
                }elseif ($routes[0] == "token") {
                        if ($count == 1) {
                        try{
                                $sql = 'SELECT app,expires_in FROM token_requests WHERE token=:token';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':token',$routes[1], PDO::PARAM_STR);
                                $prepare->execute();
                                $token = $prepare->fetchAll(PDO::FETCH_OBJ);
                        }catch (PDOException $e) {
                                echo $e->getMessage();
                                dead(501);
                        }
                        if (!empty($token)) {
                                foreach ($token as $row) {
                                        $oldtime="{$row->expires_in}";
                                        $appid="{$row->app}";
                                }
                                $time = time() - $oldtime;
                                if ($time < 181) {
                                        login($appid,$routes[1]);
                                }else{
                                        dead(403); // over 180sec
                                }
                        }else{
                                dead(401); // Token　なし
                        }
                     }else{dead(402);}
                }elseif($routes[0] == "app"){
                	// https://api.pandora.xere.jp/oauth/app/admin/abc/{HASH}
                        if ($count == 3 and !empty($routes[1]) and !empty($routes[2]) and !empty($routes[3])) {
                                try{
                                        $sql = 'SELECT id,token,website,permission,owner,callback FROM apps WHERE public_token=:token';
                                        $prepare = $db->prepare($sql);
                                        $prepare->bindValue(':token',$routes[2], PDO::PARAM_STR);
                                        $prepare->execute();
                                        $app = $prepare->fetchAll(PDO::FETCH_OBJ);
                                }catch(PDOException $e){
                                        echo $e->getMessage();
                                        dead_json(501);
                                }
                                foreach ($app as $row) {
                                        $id="{$row->id}";
                                        $web="{$row->website}";
                                        $appowner="{$row->owner}";
                                        $apptoken="{$row->token}";
                                        $apppublictoken="{$row->public_token}";
                                        $callback="{$row->callback}";
                                }
                                $URL = API_URL.'app/'.$routes[1].'/'.$routes[2].'/';
                                $sig = hash_hmac('sha256', $URL, $apptoken);
                                // echo $routes[3];
                                // echo "<br>URL:".$URL;
                                // echo "<br>TOKEN:".$apptoken;
                                // echo "<br>SIGNATURE:".$sig;
                                if (!empty($web) and $routes[3] == $sig) {
                                        try{
                                                $sql = 'SELECT type,username FROM users WHERE id=:token';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':token',$appowner, PDO::PARAM_STR);
                                                $prepare->execute();
                                                $ownerok = $prepare->fetchAll(PDO::FETCH_OBJ);
                                        }catch(PDOException $e){
                                                echo $e->getMessage();
                                                dead(501);
                                        }
                                        foreach ($ownerok as $row) {
                                                $type = "{$row->type}";
                                                $owner = "{$row->username}";
                                        }
                                        if ($type == 10 and $routes[1] == $owner) {
                                                $new_token = hash('sha1', bin2hex(openssl_random_pseudo_bytes(64)));
                                                try{
                                                        $sql = 'INSERT INTO token_requests (app,token,callback,expires_in) VALUES (:a,:t,:c,:e)';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':a',$id, PDO::PARAM_STR);
                                                        $prepare->bindValue(':t',$new_token, PDO::PARAM_STR);
                                                        $prepare->bindValue(':c',$callback, PDO::PARAM_STR);
                                                        $prepare->bindValue(':e',time(), PDO::PARAM_STR);
                                                        $prepare->execute();
                                                }catch(PDOException $e){
                                                        dead(501);
                                                }
                                                header('content-type: application/json; charset=utf-8');
                                                $arr = array('code' => 200, 'token' => $new_token);
                                                echo json_encode($arr);
                                        }else{dead_json(504);}
                                }else{dead_json(504);}
                        }else{dead_json(503);}

                }elseif($routes[0] == "resorce"){
                        try {
                            $sql = 'SELECT token,app,user,expires_in FROM app_certifications WHERE token=:token';
                            $prepare = $db->prepare($sql);
                            $prepare->bindValue(':token',$routes[1], PDO::PARAM_STR);
                            $prepare->execute();
                            $appok = $prepare->fetchAll(PDO::FETCH_OBJ);
                        } catch (PDOException $e) {
                            dead_json(501);
                        }
                        foreach ($appok as $row) {
                            $apptoken = "{$row->token}";
                            $appapp = "{$row->app}";
                            $appuser = "{$row->user}";
                            $appexpires_in = "{$row->expires_in}";
                        }
                        $now = time() - $appexpires_in;
                        if ($apptoken == $routes[1] and $now< 6) {// and $now < 11
                            try {
                                $sql = 'SELECT permission FROM apps WHERE id=:token';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':token',$appapp, PDO::PARAM_STR);
                                $prepare->execute();
                                $permissions = $prepare->fetchAll(PDO::FETCH_OBJ);
                                $sql = 'SELECT id,email,username FROM users WHERE id=:token';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':token',$appuser, PDO::PARAM_STR);
                                $prepare->execute();
                                $user = $prepare->fetchAll(PDO::FETCH_OBJ);
                            } catch (PDOException $e) {
                                dead_json(501);
                            }
                            foreach ($permissions as $row) {
                                $permission = "{$row->permission}";
                            }
                            foreach ($user as $row) {
                                $userid = "{$row->id}";
                                $email = "{$row->email}";
                                $name = "{$row->username}";
                            }
                            if ($permission == 1) {
                                header('content-type: application/json; charset=utf-8');
                                $arr = array('code' => 200, 'id' => $userid);
                                echo json_encode($arr);
                            }elseif ($permission == 2) {
                                header('content-type: application/json; charset=utf-8');
                                $arr = array('code' => 200, 'id' => $userid,'email' => $email);
                                echo json_encode($arr);
                            }elseif ($permission == 3) {
                                header('content-type: application/json; charset=utf-8');
                                $arr = array('code' => 200, 'id' => $userid, 'email' => $email, 'name' => $name);
                                echo json_encode($arr);
                            }else{dead_json(401);}
                        }else{dead_json(402);}
                }else{
                        dead_json(404);
                }
                return true;
        }

        function __construct()
        {

        }
}

?>