<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    <title>Inschrijvingen</title>
</head>
<body>
<?php
// lege variabelen aanmaken
$cursus = $voornaam = $achternaam = $adres = $huisnummer = $woonplaats = $geboortedatum = $telefoonnr = $email = "";
//ingevulde data behouden in formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cursus = ($_POST["cursus"]);
    $voornaam = ($_POST["voornaam"]);
    $achternaam = ($_POST["achternaam"]);
    $adres = ($_POST["adres"]);
    $huisnummer = ($_POST["huisnummer"]);
    $woonplaats = ($_POST["woonplaats"]);
    $geboortedatum = ($_POST["geboortedatum"]);
    $telefoonnr = ($_POST["telefoonnummer"]);
    $email = ($_POST["emailadres"]);
}
?>

<div class="container">
    <div class="header text-center">
        <h1>Inschrijven</h1>
    </div>
    <p><span class="error"><font color="red"> * verplicht veld.</font></span> </p>

<form method="post" action="inschrijving.php">
    cursus: <select name="cursus">
        <option value=" "> </option>
        <option value="naaien">naaien</option>
        <option value="breien">breien</option>
        <option value="koken">koken</option>
        <option value="knutselen">knutselen</option>
    </select><br>

    <div class="form-group">
    cursus: <input type="text" name="cursus" value="<?php print $cursus;?>">
    </div>

    <div class="form-group">
        <label for="voornaam">Voornaam</label>
        <input class="form-control" type="text" name="voornaam" placeholder="Robin" value="<?php print $voornaam;?>">
    </div>

    <div class="form-group">
        <label for="achternaam">Achternaam</label>
        <input class="form-control" type="text" name="achternaam" placeholder="Dekker" value="<?php print $achternaam;?>">
    </div>

    <div class="form-group">
        <label for="adres">Adres</label>
        <input class="form-control" type="text" name="adres" placeholder="Bulderweg" value="<?php print $adres;?>">
    </div>

    <div class="form-group">
        <label for="huisnummer">Huisnummer</label>
        <input class="form-control" type="text" name="huisnummer" placeholder="8" value="<?php print $huisnummer;?>">
    </div>

    <div class="form-group">
        <label for="woonplaats">Woonplaats</label>
        <input class="form-control" type="text" name="woonplaats" placeholder="Ermelo" value="<?php print $woonplaats;?>">
    </div>

    <div class="form-group">
        <label for="geboortedatum">Geboortedatum</label>
        <input class="form-control" type="date" name="geboortedatum" value="<?php print $geboortedatum;?>">
    </div>

    <div class="form-group">
        <label for="telefoonnummer">Telefoonnummer</label>
        <input class="form-control" type="tel" name="telefoonnummer" placeholder="06-12345678" value="<?php print $telefoonnr;?>">
    </div>

    <div class="form-group">
        <label for="email">Emailadres</label>
        <input class="form-control" type="email" name="emailadres" placeholder="naam@voorbeeld.com" value="<?php print $email;?>">
    </div>

    <br>
    <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default">
</form>
</div>
<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
if (isset($_POST["verstuur"])) {
    if (empty($_POST["cursus"]) || empty($_POST["voornaam"]) || empty($_POST["achternaam"]) || empty($_POST["huisnummer"]) || empty($_POST["adres"]) || empty($_POST["woonplaats"]) || empty($_POST["geboortedatum"]) || empty($_POST["telefoonnummer"]) || empty($_POST["emailadres"])) {
        print("Alle velden moeten ingevuld zijn");
    } else {
        print("Bedankt voor uw inschrijving");
    }
}
?>