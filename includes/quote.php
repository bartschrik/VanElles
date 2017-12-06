<!--Database connectie-->
<?php
    require_once 'admin/classes/connection.class.php';
    require_once 'admin/classes/content.class.php';

    $content = new Content();
    $random = $content->getOneRandomReview();
    ?>
<?php if ($random){?>
        <div id="main-quote" style="background-image: url('images/stbr2.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                        <div id="quote-slider">

                            <div>
                               <?php
                                    $naamprint = $random["first_name"];
                                    $quoteprint = $random["quote"];
                                    $ratingprint = $random["rating"];


                                    print("<div class='quote'>" . $quoteprint . "<br>");
                                    for ($i = 1; $i <= $ratingprint; $i++) {
                                        print("<hartjevol class='ion-ios-heart' style='color: #ff00ff; font-size: 40px;'></hartjevol>");
                                    }

//                                    for ($j = 1; $j <= (5 - $ratingprint); $j++) {
//                                        print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 40px;'></hartjeleeg>");
//                                    }
                                    print("</div>");

                                    print("<div class='naam'>" . $naamprint . "</div>");
                                 ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } else {
    print("<div class='quote'>hoi</div>");
} ?>






