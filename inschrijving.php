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
<h1>Inschrijven</h1>
<p><span class="error">* verplicht veld.</span> </p>
<form method="post" action="inschrijving.php">
    cursus: <input type="text" name="cursus" value="<?php print $cursus;?>"><br>
    Voornaam: <input type="text" name="voornaam" placeholder="Robin" value="<?php print $voornaam;?>"><br>
    Achternaam: <input type="text" name="achternaam" placeholder="Dekker" value="<?php print $achternaam;?>"><br>
    Adres: <input type="text" name="adres" placeholder="Bulderweg" value="<?php print $adres;?>"><br>
    Huisnummer: <input type="text" name="huisnummer" placeholder="8" value="<?php print $huisnummer; ?>"><br>
    Woonplaats: <input type="text" name="woonplaats" placeholder="Ermelo" value="<?php print $woonplaats;?>"><br>
    geboortedatum: <input type="date" name="geboortedatum" value="<?php print $geboortedatum;?>"><br>
    Telefoonnummer: <input type="tel" name="telefoonnummer" placeholder="06-12345678" value="<?php print $telefoonnr;?>"><br>
    Email: <input type="email" name="emailadres" placeholder="naam@voorbeeld.com" value="<?php print $email;?>"><br>
    <input type="submit" name="verstuur" value="verstuur">
</form>
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