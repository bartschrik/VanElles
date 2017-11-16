<?php
session_start();

require_once 'classes/connection.class.php';
require_once 'functions.php';
require_once 'classes/user.class.php';

$user = new User();
if($user->isLoggedIn()) {
    die(header('Location: dashboard.php'));
}

if( isset($_POST['submitLogin']) ) {
    $remember = '';
    if(isset($_POST['remember'])) {
        $remember = $_POST['remember'];
    }

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $login = $user->login($_POST['email'], $_POST['wachtwoord'], null, $remember);
    } else {
        $login = $user->login(null, $_POST['wachtwoord'], null, $remember, $_POST['email']);
    }

    $msg = $login;
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <link href="css/normalizer.css" type="text/css" rel="stylesheet" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
</head>
<body class="login">
<div class="logo">
    Leuk-ER bij Van Elles
</div>
<div class="content">
    <form class="login-form" action="#" method="post">
        <h3 class="form-title font-green">Login</h3>
        <?php

        if(isset($msg)) {
            switch ($msg) {
                case 1:
                    $msg = "Vul a.u.b. alle velden in.";
                    break;
                case 2:
                    $msg = "Oepss, er is iets mis gegaan, probeer het later opnieuw.";
                    break;
                case 3:
                    $msg = "Geen geldige inlog gegevens.";
                    break;
            }

            echo '
                    <div class="alert alert-danger">
                        <span>
                            '.$msg.'
                        </span>
                    </div>';
        }

        ?>
        <div class="form-group">
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email adres" name="email">
        </div>
        <div class="form-group">
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Wachtwoord" name="wachtwoord">
        </div>
        <div class="form-actions">
            <button name="submitLogin" type="submit" class="btn green uppercase">Login</button>
            <label class="rememberme check">
                <div class="checker"><span><input type="checkbox" name="remember" value="1"></span></div>Remember
            </label>
        </div>
    </form>
</div>
</body>
</html>
