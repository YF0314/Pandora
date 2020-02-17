<?php
function csrf_gen(){
  //if (empty($_SESSION['CSRF_EXPIRE'])) {
      session_regenerate_id(true);
//}
  unset($_SESSION['csrf_token']);
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
        output_add_rewrite_var('csrf_token', $_SESSION['csrf_token']);
    return  true;
}

function csrf_gen_v2(){
      session_regenerate_id(true);
  unset($_SESSION['csrf_token']);
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
    return  $_SESSION['csrf_token'];
}

function csrf_check(){
       if($_POST['csrf_token'] == $_SESSION['csrf_token']){
   return true;
    }else{
//echo "ABC-".$_POST['csrf_token']."<br><br><br>BCD-".$_SESSION['csrf_token']."<br><br><br>";
   return false;
}

}
?>