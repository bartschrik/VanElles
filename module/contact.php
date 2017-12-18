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
                            echo "<script>alert('Bedankt dat u contact met ons opneemt.');</script>";
                            // include_once 'includes/mailfunctions.php';
                            // contactmail($emailincontact, $naamincontact, $berichtcontact, $telefooncontact);




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
<?php if (!$pageId) { ?>
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
                        <li>Rozengaarde 77</li>
                        <li>7461 DA Rijssen</li>
                    </ul>
                    <table style="width: 100%;" class="marbot">
                        <tr>
                            <td>Telefoon:</td>
                            <td><a href="tel:0613653118">06 13 65 31 18</a></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td><a href="mailto:info@vanelles.nl">info@vanelles.nl</a></td>
                        </tr>
                        <tr>
                            <td>Kvk:</td>
                            <td>0613653118</td>
                        </tr>
                        <tr>
                            <td>BTW:</td>
                            <td>208147895B01</td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td>Maandag:</td>
                            <td>9:30 t/m 17:30</td>
                        </tr>
                        <tr>
                            <td>Dinsdag:</td>
                            <td>9:30 t/m 17:30</td>
                        </tr>
                        <tr>
                            <td>Woensdag:</td>
                            <td>9:30 t/m 17:30</td>
                        </tr>
                        <tr>
                            <td>Donderdag:</td>
                            <td>9:30 t/m 21:00</td>
                        </tr>
                        <tr>
                            <td>Vrijdag:</td>
                            <td>9:30 t/m 17:30</td>
                        </tr>
                        <tr>
                            <td>Zaterdag:</td>
                            <td>9:30 t/m 17:00</td>
                        </tr>
                        <tr>
                            <td>Zondag:</td>
                            <td>Gesloten</td>
                        </tr>
                    </table>

                    <?php echo $pageContent['inhoud']; ?>
                </div>


                <div class="col-md-6 col-xs-12 marbot">
                    <div class="ptitle">
                        <h2>Contact formulier</h2>
                    </div>
                    <form method="post" action="">
                        <div class="form-group">
                            <input class="form-control" type="text" name="naamcontact" placeholder="Voornaam">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="tussencontact" placeholder="tussenvoegsel">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="achtercontact" placeholder="Achternaam">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="tel" name="telefoonnummercontact"
                                   placeholder="Telefoonnummer">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="emailcontact"
                                   placeholder="naam@voorbeeld.com">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="textarea" placeholder="Bericht"
                                      name="berichtcontact"></textarea>
                        </div>

                        <div id="RecaptchaField1"></div>

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
    function test_input($data)
    {
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


    if (isset($_POST['verstuur'])) {

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
}

include_once 'includes/recensie.php';
        ?>

    </div>


<?php require_once 'includes/footer.php';?>