<?php

require "csrf.php";
require "define.php";

function index()
{
    echo '<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
    <link href="'.APP_URL.'cover.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">Pandora</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link" href="'.APP_URL.'panel/login/">Sign in</a>
        <a class="nav-link" href="'.APP_URL.'panel/doc/">Document</a>
        <a class="nav-link" href="'.APP_URL.'panel/agree/">Terms of service</a>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
    <h1 class="cover-heading">Pandoraとは</h1>
    <p class="lead">Pandoraは、あなたがWebアプリを開発するにあたってWebアプリのユーザーログイン機能を簡単に実装できるAPIです。
                    セキュアなシステムが、ユーザー認証処理を行います。<br />PandoraのユーザーはPandoraに情報を一度登録するだけで、複数のWebサイトでユーザー登録やログインをすることができます。また、複数のWebサイトに渡す自分の情報を細かく設定することもできます。</p>
<!--    <p class="lead">
      <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
    </p>-->
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Made by Bhe3spy. special thanks <a href="https://getbootstrap.com">Bootstrap</a></p>
    </div>
  </footer>
</div>
</body>
</html>';
}

function nologin_nav()
{
    $nav = '<nav class="navbar navbar-expand-md navbar-dark mb-4 fixed-top bg-primary">
    <a class="navbar-brand" href="'.APP_URL.'panel/">Pandora</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="'.APP_URL.'panel/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.APP_URL.'panel/register/">Sign up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.APP_URL.'panel/login/">Sign in</a>
            </li>
        </ul>
    </div>
</nav>';
return $nav;
}
function login_nav()
{
    $nav = '<nav class="navbar navbar-expand-md navbar-dark mb-4 fixed-top bg-dark">
    <a class="navbar-brand" href="'.APP_URL.'panel/">Pandora</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="'.APP_URL.'panel/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.APP_URL.'panel/apps/">App</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.APP_URL.'panel/logout/">Sign out</a>
            </li>
        </ul>
    </div>
</nav>';
return $nav;
}


function login($id,$route)
{
  if ($id == 0) {
    // The normal login
    csrf_gen();
echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora - ログイン</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.nologin_nav().'
    <form class="form-signin" method="post" action="'.APP_URL.'panel/sessions/">
    <input type="hidden" name="action" value="login" />
      <div class="text-center mb-4">
        <img class="mb-4" src="'.APP_URL.'icon.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Pandora ログイン</h1>
      </div>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
<p class="h3 mb-3 font-weight-normal">※ アクセスしているURLが<a href="'.APP_URL.'panel/login/">'.APP_URL.'</a>であることを確かめてからログインしてください。</p>
  <button class="btn btn-danger btn-block" type="submit">ログイン</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

</body>
</html>
';
  }else{
                        try{

                                $dsn = 'mysql:host='.DBServer.';dbname='.DBName.';charset=utf8';
                                $db = new PDO($dsn,DBUser,DBPassword);
                                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = 'SELECT name,description,website,permission FROM apps WHERE id=:id';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':id',$id, PDO::PARAM_STR);
                                $prepare->execute();
                                $app = $prepare->fetchAll(PDO::FETCH_OBJ);
                        }catch (PDOException $e) {
                          dead(501);
                        }
                                foreach ($app as $row) {
                                        $name="{$row->name}";
                                        $description="{$row->description}";
                                        $website="{$row->website}";
                                        $permission="{$row->permission}";
                                }
//csrf_gen();
//echo $_SESSION["csrf_token"];
                                if ($permission == 1) {
                                  $permission_message = "このAppはあなたの情報をユーザーIDのみ取得します。";
                                }elseif ($permission == 2) {
                                  $permission_message = "このAppはあなたの情報をユーザーIDとメールアドレスを取得します。";
                                }else{$permission_message ="何かおかしいです情報を入力するのやめましょう。";}
    echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>アプリケーション認証</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.nologin_nav().'
    <form class="form-signin" method="post" action="'.APP_URL.'panel/sessions/">
        <input type="hidden" name="action" value="login" />
      <div class="text-center mb-4">
        <img class="mb-4" src="'.APP_URL.'icon.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">'.h($name).'にアカウント情報の利用を許可しますか？</h1>
  <p>'.h($description).'<br>
  Website:<a href="'.$website.'">'.h($website).'</a><br>
  '.h($permission_message).'</p>
      </div>
<input type="hidden" name="token" value="'.h($route).'" />
<input type="hidden" name="csrf_token" value="noToken" />
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
  <button class="btn btn-danger btn-block" type="submit" name="submit" value="confirm">連携アプリを認証</button>
  <button class="btn btn-danger btn-block" type="submit" name="submit" value="cancel">キャンセル</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>
';
}}


function register()
{

csrf_gen();
    echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora - 登録</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.nologin_nav().'
    <form class="form-signin" method="post" action="'.APP_URL.'panel/sessions/">
        <input type="hidden" name="action" value="register" />
      <div class="text-center mb-4">
        <img class="mb-4" src="'.APP_URL.'icon.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Pandora 登録</h1>
<h3 class="h3 mb-3 font-weight-normal">今アクセスしているドメインが<a href="'.APP_URL.'panel/login/">'.APP_URL.'</a>であることを確かめてから登録してください。</h3>
      </div>

  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
            <label class="sr-only" for="inlineFormInputGroup">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">@</div>
        </div>
        <input type="text" name="name" class="form-control" id="inlineFormInputGroup" placeholder="Username">
      </div>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <button class="btn btn-danger btn-block" type="submit">登録</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

</body>
</html>
';
}

function confirm($route)
{
    csrf_gen();
echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora - ログイン</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.nologin_nav().'
    <form class="form-signin" method="post" action="'.APP_URL.'panel/sessions/">
    <input type="hidden" name="action" value="confirm" />
    <input type="hidden" name="token" value="'.h($route).'" />
      <div class="text-center mb-4">
        <img class="mb-4" src="'.APP_URL.'icon.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Pandora メールアドレス確認</h1>
<h3 class="h3 mb-3 font-weight-normal">今アクセスしているURLが<a href="'.APP_URL.'panel/confirm/">'.APP_URL.'</a>であることを確かめてからメールアドレスを認証してください。</h3>
      </div>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <button class="btn btn-danger btn-block" type="submit">確認</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

</body>
</html>
';
}

function email_comp(){
  echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pandora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
    <style>

        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
        }

        p {
            margin: 0 auto;
            width: 280px;
        }

        @media only screen and (max-width: 280px) {

            body, p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }

        }

    </style>
</head>
<body>
    <h1>登録案内メールを送信しました。迷惑メールフォルダも併せてご確認ください。</h1>
</body>
</html>';
  die();
}

function panel($id)
{
                          try{

                                $dsn = 'mysql:host='.DBServer.';dbname='.DBName.';charset=utf8';
                                $db = new PDO($dsn,DBUser,DBPassword);
                                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = 'SELECT * FROM users WHERE id=:id';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':id',$id, PDO::PARAM_STR);
                                $prepare->execute();
                                $user = $prepare->fetchAll(PDO::FETCH_OBJ);
                        }catch (PDOException $e) {
                          dead(501);
                        }
                                foreach ($user as $row) {
                                        $name="{$row->username}";
                                        $displayname="{$row->displayname}";
                                        $email="{$row->email}";
                                        $publicemail="{$row->public_email}";
                                }
    csrf_gen();
echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora ユーザー情報編集</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.login_nav().'
    <form class="form-signin" method="post" action="'.APP_URL.'panel/setting/">
    <input type="hidden" name="action" value="setting" />
      <div class="text-center mb-2">
  <h1 class="h3 mb-3 font-weight-normal">ユーザー情報編集</h1><!-- ユーザー情報を変更する場合は必ず全ての項目を入力して送信してください。-->
  <p>お帰りなさい @'.h($name).'<br />ユーザー情報の変更は現在は実装していません。</p>
      </div>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="メールアドレス" value="'.h($email).'" required autofocus>
  <label for="inputEmail" class="sr-only">Business email address</label>
  <input type="email" id="inputEmail" name="public_email" class="form-control" placeholder="公開用メールアドレス" value="'.h($publicemail).'" required autofocus>
  <label for="inputName" class="sr-only">Displayname</label>
  <input type="text" id="inputName" name="displayname" class="form-control" placeholder="名前" value="'.h($displayname).'" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <button class="btn btn-danger btn-block" type="submit">変更</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

</body>
</html>
';

}

function app($id)
{
                          try{

                                $dsn = 'mysql:host='.DBServer.';dbname='.DBName.';charset=utf8';
                                $db = new PDO($dsn,DBUser,DBPassword);
                                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = 'SELECT type FROM users WHERE id=:id';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':id',$id, PDO::PARAM_STR);
                                $prepare->execute();
                                $sqltype = $prepare->fetchAll(PDO::FETCH_OBJ);

                                $sql = 'SELECT * FROM apps WHERE owner=:id';
                                $prepare = $db->prepare($sql);
                                $prepare->bindValue(':id',$id, PDO::PARAM_STR);
                                $prepare->execute();
                                $app = $prepare->fetchAll(PDO::FETCH_OBJ);
                        }catch (PDOException $e) {
                          dead(501);
                        }
                                foreach ($sqltype as $row) {
                                        $type="{$row->type}";
                                }
    csrf_gen();
    if ($type == 10) {

      echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora Developer Console</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.login_nav();

if (empty($app)) {
echo '    <form class="form-signin" method="post" action="'.APP_URL.'panel/setting/">
    <input type="hidden" name="action" value="developer" />
      <div class="text-center mb-2">
  <h1 class="h3 mb-3 font-weight-normal">新規App</h1>
  <p>※一つのアカウントに一つしかAppは登録できません。<br />現在はAppの編集機能を提供していませんので慎重にAppをお作りください。</p>
      </div>
  <label class="sr-only">App Name</label>
  <input type="text" name="app" class="form-control" placeholder="Appの名前" required autofocus>
  <label class="sr-only">Website</label>
  <input type="text" name="website" class="form-control" placeholder="ウェブサイトドメイン" required autofocus>
  <label for="inputName" class="sr-only">Callback URL</label>
  <input type="text" id="inputName" name="callback" class="form-control" placeholder="ウェブサイトコールバックURL" required autofocus>
  <label for="inputPassword" class="sr-only">Description</label>
  <input type="text" name="description" class="form-control" placeholder="Appの説明" required>
  <label for="inputPassword">Permission</label>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="Permission" id="inlineRadio1" value="1">
  <label class="form-check-label" for="inlineRadio1">ID only</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="Permission" id="inlineRadio2" value="2">
  <label class="form-check-label" for="inlineRadio2">ID and Email</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="Permission" id="inlineRadio3" value="3" disabled>
  <label class="form-check-label" for="inlineRadio3">Coming soon</label>
</div>
  <button class="btn btn-danger btn-block" type="submit">登録</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>';
}else{
  foreach ($app as $row) {
    $name="{$row->name}";
    $token="{$row->token}";
    $public_token="{$row->public_token}";
    $website="{$row->website}";
    $callback="{$row->callback}";
    $description="{$row->description}";
    $permission="{$row->permission}";
  }
  echo '   <form class="form-signin" method="post" action="'.APP_URL.'panel/setting/">
    <input type="hidden" name="action" value="developer_update" />
      <div class="text-center mb-2">
  <h1 class="h3 mb-3 font-weight-normal">Appの編集</h1>
  <p>※現在はTokenの再発行以外の編集機能を提供しておりません。</p>
  <p>また、ウェブサイトのドメインとコールバックURLはhttps://を除いたもの(例えばhttps://example.com/はexample.com)にしてください。</p>
      </div>
  <label class="sr-only">App Name</label>
  <input type="text" id="disabledTextInput" name="app" class="form-control" placeholder="Appの名前" value="'.h($name).'" required autofocus>
  <label class="sr-only">Website</label>
  <input type="text" id="disabledTextInput" name="website" class="form-control" placeholder="ウェブサイトドメイン" value="'.h($website).'" required autofocus>
  <label for="inputName" class="sr-only">Callback URL</label>
  <input type="text" id="disabledTextInput" name="callback" class="form-control" placeholder="ウェブサイトコールバックURL" value="'.h($callback).'" required autofocus>
  <label for="inputPassword" class="sr-only">Description</label>
  <input type="text" id="disabledTextInput" name="description" class="form-control" placeholder="Appの説明" value="'.h($description).'" required>
  <label for="inputPassword">Token</label>
  <input type="text" id="disabledTextInput" name="public_token" class="form-control" placeholder="Token" value="'.h($public_token).'" required>
  <label for="inputPassword">SecretToken</label>
  <input type="text" id="disabledTextInput" name="description" class="form-control" placeholder="Token" value="'.h($token).'" required>
  <button class="btn btn-danger btn-block" type="submit">トークン再発行</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>';
  }'

</body>
</html>
';
    }else{
      echo '<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora ユーザー情報編集</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="'.APP_URL.'signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
'.login_nav().'
    <form class="form-signin" method="post" action="'.APP_URL.'panel/setting/">
    <input type="hidden" name="action" value="developer_agree" />
      <div class="text-center mb-2">
  <h1 class="h3 mb-3 font-weight-normal">デベロッパー登録しちゃう？</h1>
  <p>デベロッパー規約を読んで規約に同意した方のみ登録してくださいね❤</p>
      </div>
  <button class="btn btn-danger btn-block" type="submit">デベロッパー登録</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>

</body>
</html>
';
    }
}




function doc()
{
    echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pandora Developer Console</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>

  <body>

    <main role="main" class="container text-center">
      <div class="starter-template">
        <h1 class="mb-2">Pandora Document</h1>
        <h2>Used library and used technology</h2>
        <li>MySQL</li>
        <li>PHP</li>
        <li>Bootstrap</li>
        <h2>What is this?</h2>
        <p class="lead"><strong>開発者向けの説明</strong><br />
        これは、あなたが作るウェブサイト上でログイン機能を作る時、楽をしたいだとか、ユーザーにとって使いやすいシステムを作りたいと考えた時に必要になるシステムです。セキュアなシステムがPandoraに登録済みのユーザーの情報を提供します。<br />
        <strong>ユーザー向けの説明</strong><br />
        これは、あなたがあまり信頼していないサイトや、色々なサイトのアカウント情報が散乱する事を防ぐ為の仕組みです。Pandoraに登録済みのウェブサイトに一回のログインにつき一度だけPandoraに登録済みのウェブサイトにあなたの情報を与え、Pandoraに登録済みのウェブサイト側でユーザー認証してもらいます。</p>
        <h2>Specification</h2>
        <p class="lead">一つのサーバーしか持ってないのですけど、一応分けたので綴っておきます。<br>APIサーバーと管理サーバーとで分けています。APIサーバーは小さく二つに分けるとリソースサーバーと認証サーバーに分けています。管理サーバーはウェブアプリです。<br>何かエラーが起こった場合はエラーコードを返して処理を終了するようにしています。エラーコードは独自の部分も結構あるので、厳密にHTTPの仕様に従ってはないです。そのうち綺麗にします。<br>APIサーバーのエンドポイントはhttps://api.'. $GLOBALS["uri"] .'/oauth/ です。</p>
        <h2>How to use?(developer)</h2>
        <p class="lead">全体の流れを説明します。<br>まず管理サーバーでユーザー登録してApp登録を行い、ユーザーがPandoraでログインしたい場合は認証サーバーでトークンを発行してもらい、そのトークンを含めたPandoraのURLにユーザーをリダイレクトさせ、ユーザーがPandoraで認証するとAppのコールバックに登録しておいたコールバックURLにユーザーがリソースキーを持ちながら帰ってきます。そのリソースキーを受け取り、5秒以内にリソースサーバーからユーザーの情報を取得してください。ユーザーがPandoraで認証するのをキャンセルした場合、canceledという値が返ってきます。詳しくは https://github.com/YF0314/pandora_example を参考にしてください。</p>
        <h2>How to use?(user)</h2>
        <p class="lead">まず管理サーバーでユーザー登録をしてください。その後、Pandoraに登録済みのウェブサイトでPandoraを使ってログインすると、あなたの情報がPandoraに登録済みのウェブサイトに一度だけ渡され、その情報でユーザー認証などを行うことができます。</p>
        <h2>Authenication Flow</h2>
        <p class="lead">詳しい認証の流れを説明します。<br>Appトークンとシークレットトークンとユーザーネームとハッシュ化したものを順に、{TOKEN},{SECRET_TOKEN},{USERID},{HASHED}とおいておきます。<br>
        まず、シークレットトークンとリクエストするURLをHMAC使って署名を生成します。アルゴリズムはSha256を使用しています。シークレットトークンをキーにして、リクエストするURL(https://api.'. $GLOBALS["uri"] .'/oauth/app/{USERID}/{TOKEN}/)を本文とします。<br>
        次に、https://api.'. $GLOBALS["uri"] .'/oauth/app/{USERID}/{TOKEN}/{HASHED} にアクセスします。アクセス後、正常に処理が完了するとJsonでtoken値が返ってきます。その値を{TOKEN値}とおきます。<br>次に、ユーザーをhttps://api.'. $GLOBALS["uri"] .'/oauth/token/{TOKEN値}/ にリダイレクトさせ、ユーザーがPandoraにログインして認証します。<br>
          認証が正常に処理されるとApp登録時に登録したコールバックURLにユーザーがGETでリソースキーを保持して返ってきます。リソースキーを{key}とおきます。<br>
          そして6秒以内にhttps://api.'. $GLOBALS["uri"] .'/oauth/resorce/{key}/ にGETリクエストを送り、正常に処理が終了するとJsonでユーザー情報が返ってきます。</p>
<p><a href="https://github.com/yf0314/">Github</a>にはPHPによるPandoraへのアクセスのサンプルコードが上がっています。</p>
      </div>

    </main>
  </body>
</html>


    ';
}

function agree()
{
    echo '
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>利用規約</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>

  <body>

    <main role="main" class="container text-center">
      <div class="starter-template">
        <h1 class="mb-2">Pandora 利用規約</h1>
        <h2>プライバシーについて</h2>
        <p class="lead">私たちが取得する情報はユーザーエージェントなどのブラウザ情報、IPアドレス、アクセス日時を取得します。また、会員の個人情報(Email等)はPandoraのデータベースで管理され、APIでの提供と日本国の個人情報提供要請以外、会員の個人情報を第三者に提供することはありません。また、パスワードはハッシュ化して保存している為、データベースがクラックされた場合でもパスワード情報は守られます。会員の個人情報以外の取得した情報はgoogle　analyticsで管理される可能性があります。</p>
        <h2>免責事項</h2>
        <p class="lead">厳重なセキュリティー対策を取っていますが、このシステムがクラッキングされてもこのサイトの製作者は一切の責任をとりません。各自の責任で判断をしてください。</p>
        <h2>退会について</h2>
        <p class="lead">現在は退会の機能を作っていません。システムに悪影響を与えるユーザーは強制退会させる場合があります。</p>
      </div>

    </main>
  </body>
</html>


    ';
}

?>