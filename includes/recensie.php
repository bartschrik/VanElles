<!--ALLE RECENSIES OP DETAIL-->
<?php
if ($pageId) {
    $contact = constant('local_url') . "contact#terug";
    ?>
    <div class="container">
        <div class="row">
            <div class="marbot martop">
                <div class="col-xs-12">
                    <div class="ptitle">
                        <h1>Recensies</h1>
                    </div>
                </div>
                <a href="<?php echo $contact;?>">
                <div class="col-xs-12 col-md-12">
                    <div class="card terugkaart">
                        <i class="ion-arrow-left-c" aria-hidden="true"></i>
                    </div>
                </a>
                </div>
                <?php
                require_once 'admin/classes/connection.class.php';
                $db = new Connection();
                $db = $db->databaseConnection();

                $sql3 = "SELECT * FROM review JOIN user ON review.user_id=user.user_id WHERE active=1";
                $stmtout = $db->prepare($sql3);

                $stmtout->execute();

                while ($row = $stmtout->fetch()) {
                    $naamprint = $row["first_name"];
                    $datumprint = $row["datum"];
                    $quoteprint = $row["quote"];
                    $ratingprint = $row["rating"];

                    print("<div class='col-xs-12 col-md-6'><div class='card recensiekaart'>");

                    print($naamprint . ", " . date("j F Y", strtotime($datumprint)) . "<br><br>" . $quoteprint . "<br><br>");

                    for ($i = 1; $i <= $ratingprint; $i++) {
                        print("<hartjevol class='ion-ios-heart' style='color: #ff00ff; font-size: 30px;'></hartjevol>");
                    }

                    for ($j = 1; $j <= (5 - $ratingprint); $j++) {
                        print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 30px;'></hartjeleeg>");
                    }
                    print("</div></div>");
                }
                ?>
            </div>
        </div>
    </div>

    <?php
} else {
    ?>
    <!--RECENSIE PLAATSEN-->
    <div class="container" id="terug">
        <div class="marbot martop col-xs-12 col-md-6">
            <form method="post" action="" id="resform">
                <div class="ptitle">
                    <h2>Laat uw mening achter!</h2>
                </div>
            <?php
                if($recensieinvullen==1){
                echo '<ul >' . $errorList . '</ul>';
                };

                if($recensierecaptcha==1){
                echo 'Vul a.u.b de recaptcha in.';
                };

                if($recensiefout==1){
                echo 'Sorry er is iets fout gaan probeer het later opnieuw.';
                };

                if($recensieverstuurd==1){
                echo 'Bedankt voor het achterlaten van een recensie.';
                };
                ?>
                <div class="form-group">
                    <input class="form-control" type="text" name="naam" placeholder="Voornaam"
                           value="<?php if($recensieinvullen==1 || $recensierecaptcha==1 || $recensiefout==1) {
                               echo isset($_POST['naam']) ? $_POST['naam'] : '';
                           }
                           ?>" />
                </div>

                <div class="form-group">
                    <input class="form-control" type="email" name="emailadres" placeholder="naam@voorbeeld.com"
                           value="<?php if($recensieinvullen==1 || $recensierecaptcha==1 || $recensiefout==1) {
                               echo isset($_POST['emailadres']) ? $_POST['emailadres'] : '';
                           }
                           ?>" />
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="textarea" name="omschrijving"
                              placeholder="Omschrijving(max 200 woorden)" maxlength="200"><?php
                        if($invullen==1 || $recaptcha==1 || $geenmail==1){
                            echo isset($_POST['omschrijving']) ? $_POST['omschrijving'] : '';
                        }
                        ?></textarea>
                </div>
                <br>
                <x-star-rating value="3" number="5"></x-star-rating>

                <input type="hidden" name="sterren" id="ster" value="3">


                <br><br>


                <div id="RecaptchaField2"></div>
                <br>


                <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default">

            </form>


        </div>

        <!--RECENSIES VAN ANDEREN (3)-->
        <div class="marbot martop col-xs-12 col-md-6">
            <div class="ptitle">
                <h2>Recensies van anderen!</h2>
            </div>
            <div>
                <?php

                $sql3 = "SELECT * FROM review JOIN user ON review.user_id=user.user_id WHERE active= 1 ORDER BY RAND() LIMIT 3";
                $stmtout = $db->prepare($sql3);

                $stmtout->execute();

                while ($row = $stmtout->fetch()) {
                    $naamprint = $row["first_name"];
                    $datumprint = $row["datum"];
                    $quoteprint = $row["quote"];
                    $ratingprint = $row["rating"];


                    print("<div class='recensiekaart3'>");
                    print($naamprint . ", " . date("j F Y", strtotime($datumprint)) . "<br><br>" . $quoteprint . "<br><br>");

                    for ($i = 1; $i <= $ratingprint; $i++) {
                        print("<hartjevol class='ion-ios-heart' style='color: #ff00ff; font-size: 30px;'></hartjevol>");
                    }

                    for ($j = 1; $j <= (5 - $ratingprint); $j++) {
                        print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 30px;'></hartjeleeg>");
                    }
                    print("</div>");
                }
                $lmid = $_GET['page'];
                $lpage = constant('local_url') . "$lmid/overzicht";
                ?>
                <br>
                <a href="<?php echo $lpage; ?>" id="" class="btn btn-default">Bekijk hier alle recensies!</a>
            </div>
        </div>
    </div>

    <?php
}

