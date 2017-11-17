<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <title>Recensie</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/StarRating.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
<div class="container">
    <div class="header text-center  ">
        <h1>Laat uw mening achter!</h1>
    </div>

    <form method="post" action="recensie.php">

        <div class="form-group">
            <label for="naam">Naam</label>
            <input class="form-control" type="text" name="naam" placeholder="Jan van Veen">
        </div>

        <div class="form-group">
            <label for="email">Emailadress</label>
            <input class="form-control" type="email" name="emailadres" placeholder="voorbeeld@gmail.com">
        </div>

        <div class="form-group">
            <label for="titel">Titel</label>
            <input class="form-control" type="text" name="titel" placeholder="Titel">
        </div>

        <div class="form-group">
            <label for="omschrijving">Omschrijving</label>
            <textarea class="form-control" name="omschrijving" placeholder="Omschrijving"></textarea>
        </div>

        <x-star-rating value="3" number="5"></x-star-rating>


        <br>
        <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default">

    </form>

    <?php
    require_once 'admin/classes/connection.class.php';
    $db = new Connection();
    $db = $db->databaseConnection();

    if (isset($_POST["verstuur"])) {
        if (empty($_POST["naam"]) || empty($_POST["emailadres"]) || empty($_POST["titel"]) || empty($_POST["omschrijving"])) {
            print("Vul a.u.b. alle velden in");
        } else {
            try {
                $naam = $_POST["naam"];
                $email = $_POST["emailadres"];
                $titel = $_POST["titel"];
                $omschrijving = $_POST["omschrijving"];

                $stmt = $db->prepare("INSERT INTO review (review_name, email, review_title, review_description) VALUES (?, ?, ?, ?)");

                if($stmt->execute(array($naam, $email, $titel, $omschrijving))) {
                    print("Bedankt voor uw beoordeling");
                } else {
                    print_r($stmt->errorInfo());
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    ?>
</div>
<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
<!--jquery-->
<script src="js/jquery-3.2.1.js"></script>
<script src="js/StarRating.js"></script>
</body>
</html>

