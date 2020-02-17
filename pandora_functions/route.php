<?php
/**
 * Router
 *
 */ 


function route($endpoint){
    $uri = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $len = strlen($uri) - strlen($endpoint);
    $uri = substr($uri, - $len);
    $founder = "/";
    $str = rawurldecode(substr($uri, $appname));
    $count = mb_substr_count($str, $founder); 
    $routes = explode($founder, $str); 

    return array ($routes,$count);
}