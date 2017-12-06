<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo $pageContent['description']; ?>">
    <meta name="keywords" content="<?php echo $pageContent['kernwoorden']; ?>">
    <meta name="author" content="Van Elles">
    <title>VanElles | <?php echo $pageContent['pagetitle']; ?></title>

    <!--Google font includes-->
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>

    <!--CSS Includes-->
    <link href="<?php echo constant("local_url"); ?>css/lightbox.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo constant("local_url"); ?>css/slick/slick.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo constant("local_url"); ?>css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php echo constant("local_url"); ?>css/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
    <link href="http://nl.allfont.net/allfont.css?fonts=franklin-gothic-medium" rel="stylesheet" type="text/css" />
    <link href="<?php echo constant("local_url"); ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo constant("local_url"); ?>css/overig.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo constant("local_url"); ?>css/StarRating.css" rel="stylesheet" type="text/css"/>
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
                    <a href="#" id="main-logo"><img src="<?php echo constant("local_url"); ?>images/vanelles.jpg" alt=""></a>
                    <?php require_once 'menu.php'; ?>
                </div>
            </div>
        </div>
    </div>
</header>