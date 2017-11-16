<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>Inschrijvingen</title>
</head>
<body>
<form method="get" action="index.php">
    cursus: <input type="text" name="cursus"><br>
    Naam: <input type="text" name="naam"><br>
    Achternaam: <input type="text" name="achternaam"><br>
    Adres: <input type="text" name="adres"><br>
    Woonplaats: <input type="text" name="woonplaats"><br>
    geboortedatum: <input type="date" name="geboortedatum"><br>
    Telefoonnummer: <input type="tel" name="telefoonnummer"><br>
    Email: <input type="email" name="emailadres"><br>
    <input type="submit" name="verstuur" value="verstuur">
</form>
</body>
</html>
<?php
if (isset($_GET["verstuur"])) {
    if (empty($_GET["cursus"]) || empty($_GET["naam"]) || empty($_GET["achternaam"]) || empty($_GET["adres"]) || empty($_GET["woonplaats"]) || empty($_GET["geboortedatum"]) || empty($_GET["telefoonnummer"]) || empty($_GET["emailadres"])) {
        print("Alle velden moet ingevuld zijn");
    } else {
        print("Bedankt voor uw inschrijving");
    }
}
?>