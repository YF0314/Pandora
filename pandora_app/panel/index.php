<?
require_once "main.php";

/**
 * Router
 *
 * @author    @Bhe3spy
 */

session_start();
date_default_timezone_set('Asia/Tokyo');
$s = new \RouteCheck();
$s->preg();
?>