<?php

/**
 * Router
 *
 * @author    Bhe3spy
 */
define("VERSION", "v2"); // RESTFULではないので、現在は使用されていません。
define("APP_URL", "https://siennafawn13.sakura.ne.jp/pandora_app/"); //AppのEndpoint 設定しなおしてください
define("API_URL", "https://siennafawn13.sakura.ne.jp/pandora/"); //APIのEndpoint 設定しなおしてください



define("DBServer", "{DBSERVER}");
define("DBUser", "{DBUSER}");
define("DBName", "{DBNAME}");
define("DBPassword", "{DBUSER'S PASSWORD}");


// メッセージの設定
define("200", "Email Send!");
define("250", "Now developping...");


define("400", "Something wrong");
define("401", "Authrize required");
define("402", "そのメールアドレスまたはユーザーIDは既に使用されている可能性があります。");
define("403", "Permission Denied");
define("404", "File Not Found");
define("405", "メールアドレスが確認できませんでした。もう一度登録してお試しください。");
define("500", "Internal Server Error");
define("501", "Databaser Error");

define("502", "無効なCSRFトークンです。お手数をおかけしますが再度、送信してください。");
define("503", "必要なデータがありません");
define("504", "認証に失敗しました");
define("505", "メールを送信できませんでした。");
