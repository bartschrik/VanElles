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
                            <h1>Volgende activiteit</h1>
                            <h2>Workshop</h2>
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
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                            <div id="quote-slider">
                                <div>
                                    <span class="quote">"Geweldige en vernieuwende winkel, een aanwinst voor het prachtige Rijssen!"</span>
                                    <hr>
                                    <span class="naam">Nick Simons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12" id="main-product">
                        <div class="a-center">
                            <div class="ptitle">
                                <h2>Uitgelichte producten</h2>
                            </div>
                        </div>
                        <div id="product-slide">
                            <div class="slide">
                                <div class="card marbot">
                                    <a href="#" style="background-image: url('images/stbr.jpg');" class="card-img"></a>
                                    <div class="card-body">
                                        <a href="#"><h4 class="card-title">Nieuw: STBR</h4></a>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae commodi consectetur doloribus ducimus earum et eum hic inventore iusto magnam nam, nobis quas quasi recusandae repellendus saepe, soluta tempora.</p>
                                        <div class="a-right"><a href="#" class="btn btn-primary">Lees meer</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                                <div class="card marbot">
                                    <a href="#" style="background-image: url('images/stbr.jpg');" class="card-img"></a>
                                    <div class="card-body">
                                        <a href="#"><h4 class="card-title">Nieuw: STBR</h4></a>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae commodi consectetur doloribus ducimus earum et eum hic inventore iusto magnam nam, nobis quas quasi recusandae repellendus saepe, soluta tempora.</p>
                                        <div class="a-right"><a href="#" class="btn btn-primary">Lees meer</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                                <div class="card marbot">
                                    <a href="#" style="background-image: url('images/stbr.jpg');" class="card-img"></a>
                                    <div class="card-body">
                                        <a href="#"><h4 class="card-title">Nieuw: STBR</h4></a>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae commodi consectetur doloribus ducimus earum et eum hic inventore iusto magnam nam, nobis quas quasi recusandae repellendus saepe, soluta tempora.</p>
                                        <div class="a-right"><a href="#" class="btn btn-primary">Lees meer</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide">
                                <div class="card marbot">
                                    <a href="#" style="background-image: url('images/stbr.jpg');" class="card-img"></a>
                                    <div class="card-body">
                                        <a href="#"><h4 class="card-title">Nieuw: STBR</h4></a>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae commodi consectetur doloribus ducimus earum et eum hic inventore iusto magnam nam, nobis quas quasi recusandae repellendus saepe, soluta tempora.</p>
                                        <div class="a-right"><a href="#" class="btn btn-primary">Lees meer</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id="main-footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 ft-item">
                            <div class="ptitle">
                                <h2 class="dark">Leuk-ER conceptstore</h2>
                            </div>
                            <p>Leuk-ER is een conceptstore binnen Van Elles, voor meer informatie <a href="#">klik hier.</a></p>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 ft-item">
                            <div class="ptitle">
                                <h2 class="dark">Van Elles Webshop</h2>
                            </div>
                            <p>Geen tijd om gezellig in Rijssen te shoppen? Een aantal van onze producten kan u nu online bestellen, <a href="#">klik hier.</a></p>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 ft-item">
                            <div class="ptitle">
                                <h2 class="dark">Winkel Locatie</h2>
                            </div>
                            <p>Van Elles ligt aan de Rozengaarde 77 in Rijssen, bekijk de locatie <a href="#">hier.</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 f-item">
                        <div class="ptitle">
                            <h2>Openingstijden</h2>
                        </div>
                        <table style="width: 100%;">
                            <tr><td>Maandag: </td><td>9:30 t\m 17:30</td></tr>
                            <tr><td>Dinsdag: </td><td>9:30 t\m 17:30</td></tr>
                            <tr><td>Woensdag: </td><td>9:30 t\m 17:30</td></tr>
                            <tr><td>Donderdag: </td><td>9:30 t\m 21:00</td></tr>
                            <tr><td>Vrijdag: </td><td>9:30 t\m 17:30</td></tr>
                            <tr><td>Zaterdag: </td><td>9:30 t\m 17:00</td></tr>
                            <tr><td>Zondag: </td><td>Gesloten</td></tr>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 f-item">
                        <div class="ptitle">
                            <h2>Algemene informatie</h2>
                        </div>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li>Van Elles WoonKado&Zo</li>
                            <li>Rozengaarde 77 7461 DA Rijssen</li>
                        </ul>
                        <table style="width: 100%;">
                            <tr><td>Telefoon: </td><td><a href="tel:0613653118">06 13 65 31 18</a></td></tr>
                            <tr><td>E-mail: </td><td><a href="mailto:info@vanelles.nl">info@vanelles.nl</a></td></tr>
                            <tr><td>Kvk: </td><td>0613653118</td></tr>
                            <tr><td>BTW: </td><td>208147895B01</td></tr>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 f-item">
                        <div class="ptitle">
                            <h2>Nieuwsbrief</h2>
                        </div>
                        <p>Schrijf je nu in voor de nieuwsbrief en blijf op de hoogte van aanbiedingen en nieuws.</p>
                        <form action="#">
                            <input type="text" placeholder="E-mailadres">
                            <input type="submit" value="Aanmelden" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </footer>
        <!--JS Includes-->
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/moment.js" type="text/javascript"></script>
        <script src="js/lightbox.js" type="text/javascript"></script>
        <script src="js/slick.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </body>
</html>
