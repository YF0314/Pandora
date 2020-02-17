<?php

require_once "../../pandora_functions/define.php";
require_once "../../pandora_functions/error_handle.php";
require_once "../../pandora_functions/sendmail.php";
require_once "../../pandora_functions/h.php";
require_once "../../pandora_functions/html.php";
require_once "../../pandora_functions/route.php";
/**
 * Router
 *
 *
 * routes[1] = Action
 * routes[2] = Shop Name
 * routes[3] = Shop Access Key
 * routes[4] = Clerk IDm
 *                                               $_SESSION['auth'] = true;
 *                                               $_SESSION['userid'] = $userid;
 *                                               $_SESSION['username'] = $name;
 */
class RouteCheck
{
        function preg(){
                $dsn = 'mysql:host='.DBServer.';dbname='.DBName.';charset=utf8';
                $db = new PDO($dsn,DBUser,DBPassword);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                list ($routes,$count) = route(APP_URL);
// var_dump($routes);
// echo $count;
                if ($routes[1] == "") {
                        if ($_SESSION["auth"]) {
                                panel($_SESSION["userid"]);
                        }else{
                                index();
                        }
                }elseif ($routes[1] == "login") {
                        if ($_SESSION["auth"]) {
                                header("Location: ".APP_URL);
                        }else{
                                login(0,0);
                        }
                }elseif ($routes[1] == "logout") {
                        if ($_SESSION["auth"]) {
                        $_SESSION = array();
                        session_destroy();
                        header("Location: ".APP_URL);
                        }else{
                                header("Location: ".APP_URL);
                        }
                }elseif ($routes[1] == "apps") {
                        if ($_SESSION["auth"]) {
                                app($_SESSION["userid"]);
                        }else{header("Location: ".APP_URL);}
                }elseif ($routes[1] == "doc") {
                        doc();
                }elseif ($routes[1] == "agree") {
                        agree();
                }elseif($routes[1] == "register"){
                         if ($_SESSION["auth"]) {
                                header("Location: ".APP_URL);
                        }else{
                                register();
                        }
                }elseif ($routes[1] == "setting") {
                        if (!$_SESSION["auth"]) {
                                dead(403);
                        }
                        if ($_POST["action"] == "developer_update") {
                                if ($_SESSION["auth"] and csrf_check()) {
                                        $apptoken = base64_encode(hash('sha1', bin2hex(openssl_random_pseudo_bytes(64))));
                                        $appsecrettoken = base64_encode(hash('sha1', bin2hex(openssl_random_pseudo_bytes(64))));
                                        try {
                                                $sql = 'UPDATE apps SET public_token=:image WHERE owner=:userid';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':image', $apptoken, PDO::PARAM_STR);
                                                $prepare->bindValue(':userid',$_SESSION["userid"], PDO::PARAM_STR);
                                                $prepare->execute();
                                                $sql = 'UPDATE apps SET token=:image WHERE owner=:userid';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':image', $appsecrettoken, PDO::PARAM_STR);
                                                $prepare->bindValue(':userid',$_SESSION["userid"], PDO::PARAM_STR);
                                                $prepare->execute();
                                        } catch (PDOException $e) {
                                                dead(501);
                                        }
                                        header("Location: ".APP_URL);
                                }else{dead(502);}

                        }
                        elseif ($_POST["action"] == "developer_agree") {
                                if ($_SESSION["auth"] and csrf_check()) {
                                        try {
                                                $sql = 'UPDATE users SET type=:image WHERE id=:userid';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':image', 10, PDO::PARAM_STR);
                                                $prepare->bindValue(':userid',$_SESSION['userid'], PDO::PARAM_STR);
                                                $prepare->execute();
                                        } catch (PDOException $e) {
                                                echo $e->getMessage();
                                                dead(501);
                                        }
                                        header("Location: ".APP_URL."panel/apps/");
                                }else{dead(502);}
                        }elseif ($_POST["action"] == "developer") {
                                if ($_SESSION["auth"] and csrf_check()) {
                                        if (!empty($_POST["app"]) and !empty($_POST["website"]) and !empty($_POST["callback"]) and !empty($_POST["description"]) and !empty($_POST["Permission"])) {
                                                try {
                                                        $sql = 'SELECT id FROM apps WHERE owner=:email OR website=:web OR callback=:call OR name=:name';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':email',$_SESSION["userid"], PDO::PARAM_STR);
                                                        $prepare->bindValue(':web',$_POST["website"], PDO::PARAM_STR);
                                                        $prepare->bindValue(':call',$_POST["callback"], PDO::PARAM_STR);
                                                        $prepare->bindValue(':name',$_POST["app"], PDO::PARAM_STR);
                                                        $prepare->execute();
                                                        $app = $prepare->fetchAll(PDO::FETCH_OBJ);
                                                } catch (PDOException $e) {
                                                        dead(501);
                                                }
                                                if (empty($app)) {
                                                        $p = $_POST["Permission"];
                                                        if ($p == 1 or $p == 2) {
                                                        $token = base64_encode(hash('sha1', bin2hex(openssl_random_pseudo_bytes(64))));
                                                        try {
                                                                $sql = 'INSERT INTO apps (name,owner,token,website,callback,description,permission) VALUES (:app,:user,:token,:reg,:call,:des,:per)';
                                                                $prepare = $db->prepare($sql);
                                                                $prepare->bindValue(':app',$_POST["app"], PDO::PARAM_STR);
                                                                $prepare->bindValue(':user',$_SESSION["userid"], PDO::PARAM_STR);
                                                                $prepare->bindValue(':token',$token, PDO::PARAM_STR);
                                                                $prepare->bindValue(':reg',$_POST["website"], PDO::PARAM_STR);
                                                                $prepare->bindValue(':call',$_POST["callback"], PDO::PARAM_STR);
                                                                $prepare->bindValue(':des',$_POST["description"], PDO::PARAM_STR);
                                                                $prepare->bindValue(':per',$_POST["Permission"], PDO::PARAM_STR);
                                                                $prepare->execute();
                                                        } catch (PDOException $e) {
                                                                dead(501);
                                                        }
                                                        header("Location: ".APP_URL."panel/apps/");
                                                        }
                                                }else{dead(403);}
                                        }else{dead(402);}
                                }else{dead(502);}
                        }elseif($_POST["action"] == "setting"){dead(250);}
    /*                    elseif ($_POST["action"] == "update") {
                                if (!empty($_POST["password"])
                                        and !empty($_POST["displayname"])
                                        and !empty($_POST["email"])
                                        and !empty($_POST["public_email"])
                                        and csrf_check() == true
                                        and $_SESSION["auth"] == true) {
                                        try {
                                                $sql = 'SELECT * FROM users WHERE id=:email';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':email',$_SESSION["userid"], PDO::PARAM_STR);
                                                $prepare->execute();
                                                $user = $prepare->fetchAll(PDO::FETCH_OBJ);
                                        } catch (PDOException $e) {
                                                dead(501);
                                        }
                                        foreach ($user as $row) {
                                                $password="{$row->password}";
                                                $email="{$row->email}";
                                                $public_email="{$row->public_email}";
                                                $name="{$row->username}";
                                                $displayname="{$row->displayname}";
                                        }
                                        if (!empty($user) and password_verify($_POST["password"],$password)) {
                                                if () {
                                                        # code...
                                                }
                                                $sql = 'UPDATE users SET image=:image WHERE userid=:userid';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':image', $image, PDO::PARAM_LOB);
                                                $prepare->bindValue(':userid',$_SESSION['name'], PDO::PARAM_STR);
                                                $prepare->execute();
                                        }
                                }else{dead(401);}
                        }elseif ($_POST["action"] == "developers") {
                                # code...
                        }else{
                                dead(404);
                        }*/
                }elseif($routes[1] == "confirm"){
                        if (!empty($routes[2])) {
                                confirm($routes[2]);
                        }else{dead(503);}
                }elseif($routes[1] == "sessions"){
                    if ($_POST["submit"] == 'cancel') {
                        try {
                            $sql = 'SELECT * FROM token_requests WHERE token=:token';
                            $prepare = $db->prepare($sql);
                            $prepare->bindValue(':token',$_POST["token"], PDO::PARAM_STR);
                            $prepare->execute();
                            $apppp = $prepare->fetchAll(PDO::FETCH_OBJ);
                        } catch (PDOException $e) {
                            dead(501);
                        }
                        foreach ($apppp as $row) {
                            $callback = "{$row->callback}";
                        }
                        header('Location: https://'.$callback.'?token=canceled');
                        die();
                    }
                        if (!empty($_POST["email"]) and !empty($_POST["password"]) and !empty($_POST["csrf_token"]) and !empty($_POST["action"])) {
                                if ($_POST["action"] == "confirm" and !empty($_POST["token"])) {

                                        if (csrf_check() == true) {
                                        try {
                                                $sql = 'SELECT * FROM temp_account WHERE token=:email';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':email',$_POST["token"], PDO::PARAM_STR);
                                                $prepare->execute();
                                                $temp = $prepare->fetchAll(PDO::FETCH_OBJ);
                                        } catch (PDOException $e) {
                                                dead(501);
                                        }
                                        foreach ($temp as $row) {
                                                $password="{$row->password}";
                                                $email="{$row->email}";
                                                $token="{$row->token}";
                                                $name="{$row->name}";
                                                $expires_in="{$row->expires_in}";
                                        }
                                        $now = time() - $expires_in;
                                        if ($token == $_POST["token"]
                                        and $email == $_POST["email"]
                                        and password_verify($_POST['password'], $password)) {
                                                if ($now < 3600) {
                                                try {
                                                        $sql = 'INSERT INTO users (public_email,email,password,type,username,displayname) VALUES (:pemail,:email,:pass,:type,:userid,:username)';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':pemail',$email, PDO::PARAM_STR);
                                                        $prepare->bindValue(':email',$email, PDO::PARAM_STR);
                                                        $prepare->bindValue(':pass',$password, PDO::PARAM_STR);
                                                        $prepare->bindValue(':type',1, PDO::PARAM_STR);
                                                        $prepare->bindValue(':userid',$name, PDO::PARAM_STR);
                                                        $prepare->bindValue(':username',"にゃーん君(はーと)", PDO::PARAM_STR);
                                                        $prepare->execute();
                                                        $userid = $db->lastInsertId();
                                                        $sql = 'DELETE FROM temp_account WHERE token = :id';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':id', $_POST["token"], PDO::PARAM_STR);
                                                        $result = $prepare->execute();
                                                        session_regenerate_id(true);
                                                        $_SESSION['auth'] = true;
                                                        $_SESSION['userid'] = $userid;
                                                        $_SESSION['username'] = $name;
                                                        header("Location: ".APP_URL);
                                                }catch (PDOException $e) {
                                                        dead(501);
                                                }
                                        }else{
                                                $sql = 'DELETE FROM temp_account WHERE token = :id';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':id', $_POST["token"], PDO::PARAM_STR);
                                                $result = $prepare->execute();
                                                dead(405);
                                        }
                                        }else{dead(504);}
                                        }else{dead(502);}//Invalid CSRF token
                                }elseif ($_POST["action"] == "login") {
                                try{
                                        $sql = 'SELECT id,password,displayname FROM users WHERE email=:email';
                                        $prepare = $db->prepare($sql);
                                        $prepare->bindValue(':email',$_POST["email"], PDO::PARAM_STR);
                                        $prepare->execute();
                                        $user = $prepare->fetchAll(PDO::FETCH_OBJ);
                                }catch (PDOException $e) {
                                        echo $e->getMessage();
                                        dead(501);
                                }
                                foreach ($user as $row) {
                                        $password="{$row->password}";
                                        $userid="{$row->id}";
                                        $name="{$row->displayname}";
                                }//password_verify($_POST['password'], $password)
                                if (password_verify($_POST['password'], $password)) {
                                        // ユーザー認証済みコード
                                        if (!empty($_POST["token"])) {
                                                //アプリ認証処理
                                                try{
                                                        $sql = 'SELECT * FROM token_requests WHERE token=:token';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':token',$_POST["token"], PDO::PARAM_STR);
                                                        $prepare->execute();
                                                        $app = $prepare->fetchAll(PDO::FETCH_OBJ);
                                                }catch(PDOException $e){
                                                        echo $e->getMessage();
                                                        dead(501);
                                                }
                                                foreach ($app as $row) {
                                                        $appcertification="{$row->token}";
                                                        $appid="{$row->app}";
                                                        $oldtime="{$row->expires_in}";
                                                        $callback="{$row->callback}";
                                                }
                                                $time = time() - $oldtime;
                                                if ($appcertification == $_POST["token"] and $time < 181) {
                                                        $new_token = hash('sha1', bin2hex(openssl_random_pseudo_bytes(64)));
                                                try {
                                                        $sql = 'INSERT INTO app_certifications (app,user,token,expires_in) VALUES (:app,:user,:token,:reg)';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':app',$appid, PDO::PARAM_STR);
                                                        $prepare->bindValue(':user',$userid, PDO::PARAM_STR);
                                                        $prepare->bindValue(':token',$new_token, PDO::PARAM_STR);
                                                        $prepare->bindValue(':reg',time(), PDO::PARAM_STR);
                                                        $prepare->execute();
                                                } catch (PDOException $e) {
                                                        dead(501);
                                                }
                                                header('Location: https://'.$callback.'?token='.$new_token);
                                                }else{
                                                        dead(404); // TOKENの大文字と小文字を分別 and 3分以内かの確認
                                                }
                                        }elseif(empty($_POST["token"])){
                                        if (csrf_check()) {
                                                session_regenerate_id(true);
                                                $_SESSION['auth'] = true;
                                                $_SESSION['userid'] = $userid;
                                                $_SESSION['username'] = $name;
                                                header('Location: '.APP_URL);
                                                exit();
                                        }else{
                                                dead(400); // Password doesn't much
                                        }
                                }else{dead(402);}
                                        }else{dead(403);}
                                }
                                elseif($_POST["action"] == "register"){
                                        if (!empty($_POST["name"]) and csrf_check() == true) {
                                        try{
                                                $sql = 'SELECT id FROM users WHERE email=:email OR username=:name';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':email',$_POST["email"], PDO::PARAM_STR);
                                                $prepare->bindValue(':name',$_POST["name"], PDO::PARAM_STR);
                                                $prepare->execute();
                                                $user = $prepare->fetchAll(PDO::FETCH_OBJ);
                                                $sql = 'SELECT id FROM temp_account WHERE email=:email OR name=:name';
                                                $prepare = $db->prepare($sql);
                                                $prepare->bindValue(':email',$_POST["email"], PDO::PARAM_STR);
                                                $prepare->bindValue(':name',$_POST["name"], PDO::PARAM_STR);
                                                $prepare->execute();
                                                $temp_user = $prepare->fetchAll(PDO::FETCH_OBJ);
                                        }catch(PDOException $e){
                                                dead(501);
                                        }
                                        if (empty($user) and empty($temp_user)) {
                                                $email_pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
                                                $pass_pattern =  '/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i';
                                                $name_pattern =  '/^[a-z\d_]{3,20}$/i';
                                                if (preg_match($email_pattern, $_POST['email'])) {
                                                    if (!preg_match($pass_pattern, $_POST['password'])) {
                                                    dead_text('パスワードが弱いです。');
                                                }
                                                if (!preg_match($name_pattern, $_POST['name'])) {
                                                    dead_text('その名前は使えません。');
                                                }
                                                $options = array('cost' => 10);
                                                $hash = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);
                                                $token = hash('sha1', bin2hex(openssl_random_pseudo_bytes(64)));
                                                try {
                                                        $sql = 'INSERT INTO temp_account (email,password,expires_in,token,name) VALUES (:app,:user,:reg,:token,:name)';
                                                        $prepare = $db->prepare($sql);
                                                        $prepare->bindValue(':app',$_POST["email"], PDO::PARAM_STR);
                                                        $prepare->bindValue(':user',$hash, PDO::PARAM_STR);
                                                        $prepare->bindValue(':reg',time(), PDO::PARAM_STR);
                                                        $prepare->bindValue(':token',$token, PDO::PARAM_STR);
                                                        $prepare->bindValue(':name',$_POST["name"], PDO::PARAM_STR);
                                                        $prepare->execute();
                                                } catch (PDOException $e) {
                                                        echo $e->getMessage();
                                                        dead(501);
                                                }
                                                mb_language('ja');
                                                mb_internal_encoding('UTF-8');
                                                $mailTo  = $_POST["email"];
                                                $subject = 'Pandora 会員登録確認メール';
                                                $returnMail = $mailTo;
                                                $name = "ようこそ、". $_POST["name"];
                                                $email = "noreplay@pandora.xere.jp";
                                                $comment = "

Pandora 会員登録確認メールです。

アカウントの登録意思がない場合はこのメールを無視してください。
一時間以内に確認できなかった場合、このメールは無効となり、もう一度登録していただく必要があります。


アカウントの作成は".APP_URL."panel/confirm/".$token." にアクセスし、ログインすることで完了します。";
                                                $result = sendmail($name, $email, $mailTo, $subject, $comment, $returnMail);
                                                if ($result) {
                                                        $_SESSION = array();
                                                        session_destroy();
                                                        email_comp();
                                                    } else {
                                                        dead(505);
                                                }
                                                }else{dead_text('そのメールアドレスは使えません。');}
                                        }else{
                                                dead(402); // Email alredy exsist
                                        }
                                         }else{dead(502);}
                                }
                        }else{dead(503);}
                }else{
                        dead(404);
                }
                return true;
        }

        function __construct()
        {

        }


}