<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>VanElles</title>

        <!--CSS Includes-->
        <link href="css/lightbox.css" rel="stylesheet" type="text/css"/>
        <link href="css/slick/slick.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
        <link href="http://nl.allfont.net/allfont.css?fonts=franklin-gothic-medium" rel="stylesheet" type="text/css" />
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
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
                                <li class="active"><a href="#">Home</a></li>
                                <li class="has-sub"><a href="#">Over ons</a>
                                    <ul>
                                        <li><a href="#">Over Van Elles</a></li>
                                        <li><a href="#">Over Leuk-ER</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="#">Producten</a></li>
                                <li class=""><a href="#">Leveranciers</a></li>
                                <li class=""><a href="#">Contact</a></li>
                            </ul>
                            <div class="menuBtn"><div id="menubtn"><div class="bar"></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="content">
            <div id="main-slider">
                <div>
                    <div class="slide" style="background-image: url('images/hk-living-banner_2048x2048.jpg')">

                    </div>
                </div>
                <div>
                    <div class="slide" style="background-image: url('images/stbr.jpg')">

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <section class="col-md-8 col-sm-7 col-xs-12 marbot">
                        <div class="ptitle">
                            <h1>Over de winkel</h1>
                            <h2>En Leuk-er conceptstore</h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam asperiores corporis exercitationem expedita ipsam modi molestias, non numquam perferendis porro quia quos voluptatum? Consectetur, dicta doloremque dolores eaque excepturi exercitationem ipsa ipsum iste laborum libero magni maxime minus natus nesciunt nisi officiis, optio, quam quia recusandae sapiente velit vero?</p>
                        <b>Leuk-Er bij van Elles</b>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium architecto delectus dolorem enim fuga, fugit harum, id illo laborum magnam molestiae nam non nulla reiciendis rem repellat. Eum, iusto?</p>
                    </section>
                    <aside class="col-md-4 col-sm-5 col-xs-12 marbot">
                        <div class="ptitle">
                            <h1>Uitgelichte</h1>
                            <h2>Producten</h2>
                        </div>
                        <div class="card">
                            <a href="#" style="background-image: url('images/stbr.jpg');" class="card-img"></a>
                            <div class="card-body">
                                <a href="#"><h4 class="card-title">Nieuw: STBR</h4></a>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae commodi consectetur doloribus ducimus earum et eum hic inventore iusto magnam nam, nobis quas quasi recusandae repellendus saepe, soluta tempora.</p>
                                <div class="a-right"><a href="#" class="btn btn-primary">Lees meer</a></div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <div id="main-quote" style="background-image: url('images/stbr2.jpg');">

            </div>
        </div>
        <footer id="main-footer">

        </footer>
        <!--JS Includes-->
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/moment.js" type="text/javascript"></script>
        <script src="js/lightbox.js" type="text/javascript"></script>
        <script src="js/slick.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </body>
</html>
