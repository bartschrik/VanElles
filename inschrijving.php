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
$cursus = $naam = $adres = $woonplaats = $geboortedatum = $telefoonnr = $email = "";
//ingevulde data behouden in formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cursus = test_input($_POST["cursus"]);
    $naam = test_input($_POST["naam"]);
    $adres = test_input($_POST["adres"]);
    $woonplaats = test_input($_POST["woonplaats"]);
    $geboortedatum = test_input($_POST["geboortedatum"]);
    $telefoonnr = test_input($_POST["telefoonnummer"]);
    $email = test_input($_POST["emailadres"]);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<form method="post" action="inschrijving.php">
    cursus: <input type="text" name="cursus" value="<?php print $cursus;?>"><br>
    Naam: <input type="text" name="naam" placeholder="Voornaam Achternaam" value="<?php print $naam;?>"><br>
    Adres: <input type="text" name="adres" placeholder="Adres huisnummer" value="<?php print $adres;?>"><br>
    Woonplaats: <input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php print $woonplaats;?>"><br>
    geboortedatum: <input type="date" name="geboortedatum" value="<?php print $geboortedatum;?>"><br>
    Telefoonnummer: <input type="tel" name="telefoonnummer" placeholder="06-12345678" value="<?php print $telefoonnr;?>"><br>
    Email: <input type="email" name="emailadres" placeholder="naam@voorbeeld.com" value="<?php print $email;?>"><br>
    <input type="submit" name="verstuur" value="verstuur">
</form>
</body>
</html>
<?php
if (isset($_POST["verstuur"])) {
    if (empty($_POST["cursus"]) || empty($_POST["naam"]) || empty($_POST["adres"]) || empty($_POST["woonplaats"]) || empty($_POST["geboortedatum"]) || empty($_POST["telefoonnummer"]) || empty($_POST["emailadres"])) {
        print("Alle velden moet ingevuld zijn");
    } else {
        print("Bedankt voor uw inschrijving");
    }
}
?>