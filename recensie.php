<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <title>Recensie</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/StarRating.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
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
    <div class="marbot martop col-xs-6">
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

            <x-star-rating value="3" number="5"></x-star-rating>

            <input type="hidden" name="sterren" id="ster" value="3">



            <br>
            <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default">

        </form>
    </div>


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
                $naam = $_POST["naam"];
                $email = $_POST["emailadres"];
                $omschrijving = $_POST["omschrijving"];
                $sterren = $_POST["sterren"];

                $sql1 = "INSERT INTO review (quote, rating, naam) VALUES ('$omschrijving', '$sterren', '$naam')";
                $stmt1 = $db->prepare($sql1);

                $sql2 = "INSERT INTO user (email) VALUES ('$email')";
                $stmt2 = $db->prepare($sql2);

                if($stmt->execute()) {
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

    <div class="marbot martop col-xs-6">
        <div class="ptitle">
            <h2>Recensies van anderen!</h2>
        </div>
        <div>
            <?php
            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            $sql3 = "SELECT quote, rating, naam, datum FROM review";
            $stmt3 = $db->prepare($sql3);

            if ($stmt3->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>Name</th></tr>";
                // output data of each row
                while($row = $stmt3->fetch_assoc()) {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>



<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
<!--jquery-->
<script src="js/jquery-3.2.1.js"></script>
<script src="js/StarRating.js"></script>

</body>
</html>

