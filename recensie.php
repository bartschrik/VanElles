<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recensie</title>
</head>
<body>
<form method="get" action="recensie.php">
    Naam:<br><input type="text" name="naam"><br>
    Emailadres:<br><input type="email" name="emailadres"><br>
    Titel:<br><input type="text" name="titel"><br>
    Omschrijving:<br><textarea name="omschrijving"></textarea><br>
    Geef uw beoordeling:<br>

    <input type="image" name="hart1" src="img/hartje.png" height="35" width="35">
    <input type="image" name="hart2" src="img/hartje.png" height="35" width="35">
    <input type="image" name="hart3" src="img/hartje.png" height="35" width="35">
    <input type="image" name="hart4" src="img/hartje.png" height="35" width="35">
    <input type="image" name="hart5" src="img/hartje.png" height="35" width="35">
    <br>

    <input type="submit" name="verstuur" value="Verstuur">
</form>


</body>
</html>

<?php
if (isset($_GET["verstuur"])) {
    if (empty($_GET["naam"]) || empty($_GET["emailadres"]) || empty($_GET["titel"]) || empty($_GET["omschrijving"])) {
        print("Alle velden moet ingevuld zijn");
    } else {
        print("Bedankt voor uw beoordeling");
    }
}
?>


<!--/**
 * Created by PhpStorm.
 * User: Ties
 * Date: 15-11-2017
 * Time: 16:03
 */-->