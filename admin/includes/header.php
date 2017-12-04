<!DOCTYPE html>
<?php

include_once('config.php');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Van Elles | Admin panel</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/normalizer.css" />
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-xs-6">Leuk-ER bij Van Elles</div>
            <div class="col-xs-6 text-right"><?php echo 'Welkom ' . $user->getUserName(); ?><a href="?uitloggen=true" title="Uitloggen" class="uitloggen"><i class="fa fa-sign-out"></i></a></div>
        </div>
    </div>
</header>
<nav>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav navbar-nav">
                    <li><a href="dashboard.php">Pagina's</a></li>
                </ul>
            </div>
        </div>
    </div>
    <i class="fa fa-bars barss"></i>
</nav>