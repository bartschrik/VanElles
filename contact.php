<head>
    <!--haalt de recaotch op-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    if(isset($_POST['verstuurcontact'])) {

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $privatekey = "6LevEzsUAAAAAGvQJ1EDrE-eL5aNBKHteM83OywN";

        $response = file_get_contents($url . "?secret=" . $privatekey . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $data = json_decode($response);

        if (isset($data->success) AND $data->success == true) {

            require_once 'admin/classes/connection.class.php';
            $db = new Connection();
            $db = $db->databaseConnection();



            if (isset($_POST["verstuurcontact"])) {
                if (empty($_POST["naamcontact"]) || empty($_POST["telefoonnummercontact"]) || empty($_POST["emailcontact"]) || empty($_POST["berichtcontact"])) {
                    print("Vul a.u.b. alle velden in");
                } else {
                    try {
                        $naamincontact = $_POST["naamcontact"];
                        $emailincontact = $_POST["emailcontact"];
                        $telefooncontact = $_POST["telefoonnummercontact"];
                        $berichtcontact = $_POST["berichtcontact"];

                        $stmt = $user = $db->prepare("SELECT user_id from USER where email = ':email'");
                        $stmt->bindParam(":email", $emailincontact);
                        $stmt->execute();

                        if($stmt->rowCount() > 0)
                        {
                            $sql = "UPDATE USER SET phonenumber=?,   WHERE _email=$emailincontact";
                            $stmt = $db->prepare($sql);

                            $stmt->bind_param('d',$telefooncontact );
                            $stmt->execute();


                            $sql="INSERT INTO contact (name, inhoud, user_id)VALUES (?, ?, ? )";
                            $stmt->bind_param("ssd", $naamincontact, $berichtcontact, $user);
                            $stmt->execute();

                        }else{


                            db->query("INSERT INTO user (email, first_name) VALUES ('$emailin', '$naamin')");

                        $last_id = $db->lastInsertId();

                        $sql = "INSERT INTO review (quote, rating, user_id) VALUES ('$quotein', '$ratingin', '$last_id')";
                        $stmtin = $db->prepare($sql);



                        }


                        if ($stmt->execute()) {
                            print("Bedankt dat u contact opneemt");


                        } else {
                            print_r($stm->errorInfo());
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
            }
            return true;


        } else {

            echo "<script>alert('Vul Recaptcha in.');</script>";
            echo " <meta http-equiv=\"refresh\" content=\"0; url=contact.php\" />";
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
                    <h1>Contact</h1>
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
                <table style="width: 100%;">
                    <tr><td>Telefoon: </td><td><a href="tel:0613653118">06 13 65 31 18</a></td></tr>
                    <tr><td>E-mail: </td><td><a href="mailto:info@vanelles.nl">info@vanelles.nl</a></td></tr>
                    <tr><td>Kvk: </td><td>0613653118</td></tr>
                    <tr><td>BTW: </td><td>208147895B01</td></tr>
                </table>
            </div>


            <div class="col-md-6 col-xs-12 marbot">
                <div class="ptitle">
                    <h2>Contact formulier</h2>
                </div>
                <form method="post" action="?">
                    <div class="form-group">
                        <input class="form-control" type="text" name="naamcontact" placeholder="Naam" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="tel" name="telefoonnummercontact" placeholder="Telefoonnummer" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="emailcontact" placeholder="naam@voorbeeld.com" >
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="textarea" placeholder="Bericht" name="berichtcontact"></textarea>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LevEzsUAAAAACTTY0PQXdlxvv1lXY4QkFLnU7-1"></div>

                    <div class="form-group">
                        <input class="btn btn-default" type="submit" name="verstuurcontact" value="verstuur">
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
?>

    <!--Invoervelden-->
    <div class="container">
        <div class="marbot martop col-xs-12 col-md-6">
            <form method="post" action="contact.php">
                <div class="ptitle">
                    <h2>Laat uw mening achter!</h2>
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="naam" placeholder="Naam" value="<?php print $naam;?>">
                </div>

                <div class="form-group">
                    <input class="form-control" type="email" name="emailadres" placeholder="naam@voorbeeld.com" value="<?php print $email;?>">
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="textarea" name="omschrijving" placeholder="Omschrijving"><?php print $omschrijving;?></textarea>
                </div>
                <br>
                <x-star-rating value="3" number="5"></x-star-rating>

                <input type="hidden" name="sterren" id="ster" value="3">



                <br><br>
                <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default">

            </form>



            <!--database connection -->
            <?php
            require_once 'admin/classes/connection.class.php';
            $db = new Connection();
            $db = $db->databaseConnection();

            if (isset($_POST["verstuur"])) {
                if (empty($_POST["naam"]) || empty($_POST["emailadres"]) || empty($_POST["omschrijving"])) {
                    print("Vul a.u.b. alle velden in");
                } else {
                    try {
                        $naamin = $_POST["naam"];
                        $emailin = $_POST["emailadres"];
                        $quotein = $_POST["omschrijving"];
                        $ratingin = $_POST["sterren"];

                        $db->query("INSERT INTO user (email, first_name) VALUES ('$emailin', '$naamin')");

                        $last_id = $db->lastInsertId();

                        $sql = "INSERT INTO review (quote, rating, user_id) VALUES ('$quotein', '$ratingin', '$last_id')";
                        $stmtin = $db->prepare($sql);



                        if($stmtin->execute()) {
                            print("Bedankt voor uw beoordeling");
                            $naam = $email = $omschrijving = "";
                        } else {
                            print_r($stmtin->errorInfo());
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
            }
            ?>
        </div>

        <div class="marbot martop col-xs-12 col-md-6">
            <div class="ptitle">
                <h2>Recensies van anderen!</h2>
            </div>
            <div>
                <?php

                $sql3 = "SELECT * FROM review JOIN user ON review.user_id=user.user_id ORDER BY RAND() LIMIT 3";
                $stmtout = $db->prepare($sql3);

                $stmtout->execute();

                while ($row = $stmtout->fetch())
                {
                    $naamprint = $row["first_name"];
                    $datumprint = $row["datum"];
                    $quoteprint = $row["quote"];
                    $ratingprint = $row["rating"];


                    print("<div class='recensiekaart'>");
                    print($naamprint . ", " . $datumprint . "<br><br>" . $quoteprint . "<br><br>");

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
                <a href="recensie.php" class="btn btn-default">Lees meer recensies!</a>
            </div>
        </div>
    </div>


<?php require_once 'includes/footer.php';?>