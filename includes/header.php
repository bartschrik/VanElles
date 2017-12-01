<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VanElles</title>

    <!--Google font includes-->
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>

    <!--CSS Includes-->
    <link href="css/lightbox.css" rel="stylesheet" type="text/css"/>
    <link href="css/slick/slick.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
    <link href="http://nl.allfont.net/allfont.css?fonts=franklin-gothic-medium" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/overig.css" rel="stylesheet" type="text/css"/>
    <link href="css/StarRating.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
</head>
<body>
<header id="main-header">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="icon-list">
                        <li><a target="_blank" href="<?php echo constant("facebook_vanelles"); ?>"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="<?php echo constant("twitter_vanelles"); ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="<?php echo constant("linkedin_elles"); ?>"><i class="fa fa-linkedin"></i></a></li>
                        <li><a target="_blank" href="<?php echo constant("instagram_vanelles"); ?>"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="#" id="main-logo"><img src="images/vanelles.jpg" alt=""></a>
                    <ul id="main-menu">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li class="has-sub"><a href="#">Over ons</a>
                            <ul>
                                <li><a href="#">Over Van Elles</a></li>
                                <li><a href="#">Over Leuk-ER</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="#">Producten</a></li>
                        <li class=""><a href="#">Leveranciers</a></li>
                        <li class=""><a href="contact.php">Contact</a></li>
                    </ul>
                    <div class="menuBtn"><div id="menubtn"><div class="bar"></div></div></div>
                </div>
            </div>
        </div>
    </div>
</header>