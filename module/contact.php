<head>


    <!--haalt de recaotch op-->
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
    <script type="text/javascript">
        var CaptchaCallback = function() {
            grecaptcha.render('RecaptchaField1', {'sitekey' : '6LevEzsUAAAAACTTY0PQXdlxvv1lXY4QkFLnU7-1'});
            grecaptcha.render('RecaptchaField2', {'sitekey' : '6LevEzsUAAAAACTTY0PQXdlxvv1lXY4QkFLnU7-1'});
        };
    </script>

<?php

    if(isset($_POST['verstuurcontact'])) {

        $privatekey = "6LevEzsUAAAAAGvQJ1EDrE-eL5aNBKHteM83OywN";
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $response = file_get_contents($url . "?secret=" . $privatekey . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $data = json_decode($response);

        if (isset($data->success) AND $data->success == true) {

            require_once 'admin/classes/connection.class.php';
            $db = new Connection();
            $db = $db->databaseConnection();


            if (isset($_POST["verstuurcontact"])) {
                if (empty($_POST["naamcontact"]) || empty($_POST["achtercontact"]) || empty($_POST["telefoonnummercontact"]) || empty($_POST["emailcontact"]) || empty($_POST["berichtcontact"])) {
                    echo "<script>alert('vul a.u.b alle velden in.');</script>";

                } else {
                    try {
                        $naamincontact = $_POST["naamcontact"];
                        $tussencontact = $_POST["tussencontact"];
                        $achtercontact = $_POST["achtercontact"];
                        $emailincontact = $_POST["emailcontact"];
                        $telefooncontact = $_POST["telefoonnummercontact"];
                        $berichtcontact = $_POST["berichtcontact"];

                        //query: check of email in user bestaat en selecteer id
                        $query = $db->prepare("SELECT user_id FROM user WHERE email = :email");
                        $query->bindValue(":email", $emailincontact);
                        $query->execute();
                        $last_id = $query->fetch()['user_id'];

                        if($last_id) {
                            //Zoja: update user info van bestaade user
                            $query = $db->prepare("UPDATE user SET first_name = :first_name , insertion = :insertion , last_name = :last_name phonenumber = :phonenumber WHERE user_id = :userid");
                            $query->bindValue(":first_name", $naamincontact);
                            $query->bindValue(":insertion", $tussencontact);
                            $query->bindValue(":last_name", $achtercontact);
                            $query->bindValue(":phonenumber", $telefooncontact);
                            $query->bindValue(":userid", $last_id);
                            $query->execute();
                        } else {
                            //insert nieuw user en insert contact
                            $query = $db->prepare("INSERT INTO user (first_name , insertion , last_name , email , phonenumber) VALUES (:first_name , :insertion , :last_name , :email , :phonenumber)");
                            $query->bindValue(":first_name", $naamincontact);
                            $query->bindValue(":insertion", $tussencontact);
                            $query->bindValue(":last_name", $achtercontact);
                            $query->bindValue(":email", $emailincontact);
                            $query->bindValue(":phonenumber", $telefooncontact);
                            $query->execute();
                            $last_id = $db->lastInsertId();
                        }

                        $sql = "INSERT INTO contact (name, inhoud, user_id) VALUES ('$naamincontact', '$berichtcontact', '$last_id')";
                        $stmt = $db->prepare($sql);


                        if ($stmt->execute()) {
                            $ja=1;
                            include_once 'mail/mail_contact.php';



                            } else {
                            echo "<script>alert('Sorry er is iets fout gegaan, probeer het later nog een keer.');</script>";
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
            }
        echo " <meta http-equiv=\"refresh\" content=\"0;\" />";
            return true;



        } else {

            echo "<script>alert('Vul Recaptcha in.');</script>";
          echo " <meta http-equiv=\"refresh\" content=\"0;\" />";


            return false;

        }
    }

    ?>


</head>

<?php require_once 'includes/header.php';?>
<div class="martop">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="ptitle">
                    <h1><?php echo $pageContent['title']; ?></h1>
                    <h2><?php echo $pageContent['subtitle']; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12 marbot">
                <div class="ptitle">
                    <h2>Algemene informatie</h2>
                </div>
                <ul style="list-style: none; padding: 0; margin: 0 0 10px 0;">
                    <li>Van Elles WoonKado&Zo</li>
                    <li>Rozengaarde 77 </li>
                    <li>7461 DA Rijssen</li>
                </ul>
                <table style="width: 100%;" class="marbot">
                    <tr><td>Telefoon: </td><td><a href="tel:0613653118">06 13 65 31 18</a></td></tr>
                    <tr><td>E-mail: </td><td><a href="mailto:info@vanelles.nl">info@vanelles.nl</a></td></tr>
                    <tr><td>Kvk: </td><td>0613653118</td></tr>
                    <tr><td>BTW: </td><td>208147895B01</td></tr>
                </table>
                <table style="width: 100%;">
                    <tr><td>Maandag: </td><td>9:30 t/m 17:30</td></tr>
                    <tr><td>Dinsdag: </td><td>9:30 t/m 17:30</td></tr>
                    <tr><td>Woensdag: </td><td>9:30 t/m 17:30</td></tr>
                    <tr><td>Donderdag: </td><td>9:30 t/m 21:00</td></tr>
                    <tr><td>Vrijdag: </td><td>9:30 t/m 17:30</td></tr>
                    <tr><td>Zaterdag: </td><td>9:30 t/m 17:00</td></tr>
                    <tr><td>Zondag: </td><td>Gesloten</td></tr>
                </table>

                <?php echo $pageContent['inhoud']; ?>
            </div>

            <div class="col-md-6">
                <div class="ptitle">
                    <h2>Contact formulier</h2>

                <form method="post" action="">

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                        <input class="form-control" type="text" name="naamcontact" placeholder="Voornaam" ><br>
                    </div>
                                <div class="col-md-6 col-sm-6 col-xs-5">
                        <input class="form-control" type="text" name="tussencontact" placeholder="tussenvoegsel" ><br>
                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="text" name="achtercontact" placeholder="Achternaam" ><br>
                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="tel" name="telefoonnummercontact" placeholder="Telefoonnummer" ><br>
                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control" type="email" name="emailcontact" placeholder="naam@voorbeeld.com" ><br>
                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" id="textarea" placeholder="Bericht" name="berichtcontact"></textarea><br>
                    </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="RecaptchaField1"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                        <input class="btn btn-default" type="submit" name="verstuurcontact" value="verstuur"><br>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <iframe width="100%" height="450" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ5V02qP_2x0cRW1sToOEGWTw&key=AIzaSyApMHLgYCLkBT1N0ww0-52xlCQRG-eg7Rw"
            allowfullscreen>
    </iframe>

</div>

    <!--ingevulde gegevens behouden-->
<?php
$naam = $email = $omschrijving = "";
//ingevulde data behouden in formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = test_input($_POST["naam"]);
    $email = test_input($_POST["emailadres"]);
    $omschrijving = test_input($_POST["omschrijving"]);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> <!--database connection -->
<?php
require_once 'admin/classes/connection.class.php';
$db = new Connection();
$db = $db->databaseConnection();
/*Recensie insert */


if(isset($_POST['verstuur'])) {

    $privatekey = "6LevEzsUAAAAAGvQJ1EDrE-eL5aNBKHteM83OywN";
    $url = 'https://www.google.com/recaptcha/api/siteverify';


    $response = file_get_contents($url . "?secret=" . $privatekey . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $data = json_decode($response);

    if (isset($data->success) AND $data->success == true) {

        require_once 'admin/classes/connection.class.php';
        $db = new Connection();
        $db = $db->databaseConnection();
        if (isset($_POST["verstuur"])) {
            if (empty($_POST["naam"]) || empty($_POST["emailadres"]) || empty($_POST["omschrijving"])) {
                echo "<script>alert('vul a.u.b alle velden in.');</script>";

            } else {
                try {
                    $naamin = $_POST["naam"];
                    $emailin = $_POST["emailadres"];
                    $quotein = $_POST["omschrijving"];
                    $ratingin = $_POST["sterren"];

                    //query: check of email in user bestaat en selecteer id
                    $query = $db->prepare("SELECT user_id FROM user WHERE email = :email");
                    $query->bindValue(":email", $emailin);
                    $query->execute();
                    $last_id = $query->fetch()['user_id'];

                    if ($last_id) {
                        //Zoja: update user info van bestaade user
                        $query = $db->prepare("UPDATE user SET first_name = :voornaam WHERE user_id = :userid");
                        $query->bindValue(":voornaam", $naamin);
                        $query->bindValue(":userid", $last_id);
                        $query->execute();
                    } else {
                        //insert nieuw user en inser revies
                        $query = $db->prepare("INSERT INTO user (first_name, email) VALUES (:voornaam, :email)");
                        $query->bindValue(":voornaam", $naamin);
                        $query->bindValue(":email", $emailin);
                        $query->execute();
                        $last_id = $db->lastInsertId();
                    }

                    $sql = "INSERT INTO review (quote, rating, user_id) VALUES ('$quotein', '$ratingin', '$last_id')";
                    $stmtin = $db->prepare($sql);


                    if ($stmtin->execute()) {
                        echo "<script>alert('Bedankt voor uw beoordeling.');</script>";
                        $naam = $email = $omschrijving = "";
                    } else {
                        echo "<script>alert('Sorry er is iets fout gegaan, probeer het later nog een keer.');</script>";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
        echo " <meta http-equiv=\"refresh\" content=\"0;\" />";
        return true;



    } else {

        echo "<script>alert('Vul Recaptcha in.');</script>";
        echo " <meta http-equiv=\"refresh\" content=\"0;\" />";


        return false;

    }
}
        ?>

    <!--Invoervelden-->
    <div class="container">
        <div class="marbot martop col-xs-12 col-md-6">
            <form method="post" action="" id="resform">
                <div class="ptitle">
                    <h2>Laat uw mening achter!</h2>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="naam" placeholder="Voornaam">
                </div>

                <div class="form-group">
                    <input class="form-control" type="email" name="emailadres" placeholder="naam@voorbeeld.com">
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="textarea" name="omschrijving" placeholder="Omschrijving"></textarea>
                </div>
                <br>
                <x-star-rating value="3" number="5"></x-star-rating>

                <input type="hidden" name="sterren" id="ster" value="3">



                <br><br>



                <div id="RecaptchaField2"></div><br>


                <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default">

            </form>



        </div>

        <div class="marbot martop col-xs-12 col-md-6">
            <div class="ptitle">
                <h2>Recensies van anderen!</h2>
            </div>
            <div>
                <?php

                $sql3 = "SELECT * FROM review JOIN user ON review.user_id=user.user_id WHERE active= 1 ORDER BY RAND() LIMIT 3";
                $stmtout = $db->prepare($sql3);

                $stmtout->execute();

                while ($row = $stmtout->fetch())
                {
                    $naamprint = $row["first_name"];
                    $datumprint = $row["datum"];
                    $quoteprint = $row["quote"];
                    $ratingprint = $row["rating"];


                    print("<div class='recensiekaart'>");
                    print($naamprint . ", " . date("j F Y", strtotime($datumprint)) . "<br><br>" . $quoteprint . "<br><br>");

                    for ($i=1; $i <= $ratingprint; $i++){
                        print("<hartjevol class='ion-ios-heart' style='color: #ff00ff; font-size: 30px;'></hartjevol>");
                    }

                    for ($j=1; $j <= (5 - $ratingprint); $j++){
                        print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 30px;'></hartjeleeg>");
                    }
                    print("</div>");
                }
                ?>
                <br>
<!--                <a href="./recensie.php" class="btn btn-default">Lees meer recensies!</a>-->
            </div>
        </div>
    </div>


<?php require_once 'includes/footer.php';?>