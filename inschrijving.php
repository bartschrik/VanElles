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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Inschrijvingen</title>
</head>
<body>
<?php
require_once 'admin/classes/connection.class.php';
$db = new connection();
$db = $db->databaseConnection();
require_once 'includes/header.php';
// lege variabelen aanmaken
$cursus = $voornaam = $achternaam = $geboortedatum = $telefoonnr = $email = "";
//ingevulde data behouden in formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cursus = ($_POST["cursus"]);
    $voornaam = ($_POST["voornaam"]);
    $achternaam = ($_POST["achternaam"]);
    $geboortedatum = ($_POST["geboortedatum"]);
    $telefoonnr = ($_POST["telefoonnummer"]);
    $email = ($_POST["emailadres"]);
}
ob_start();
?>
<div class="container">
    <div class="header text-center">
        <h1>Inschrijven</h1>
    </div>

<form method="post" action="inschrijving.php">

<!--    cursus: <select name="cursus">-->
<!--        <option value=" "> </option>-->
<!--        <option value="naaien">naaien</option>-->
<!--        <option value="breien">breien</option>-->
<!--        <option value="koken">koken</option>-->
<!--        <option value="knutselen">knutselen</option>-->
<!--    </select><br>-->

    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Cursus
        <span class="caret"></span> </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Naaien </a></li>
            <li>Breien</li>
            <li>Koken</li>
        </ul>
    </div>


    <div class="form-group">
        <label for="cursus">Cursus</label>
        <input class="form-control" type="text" name="cursus" placeholder="Cursus" required value="<?php print $cursus;?>">
    </div>

    <div class="form-group">
        <label for="voornaam">Voornaam</label>
        <input class="form-control" type="text" name="voornaam" placeholder="Robin" required value="<?php print $voornaam;?>">
    </div>

    <div class="form-group">
        <label for="achternaam">Achternaam</label>
        <input class="form-control" type="text" name="achternaam" placeholder="Dekker" required value="<?php print $achternaam;?>">
    </div>

    <div class="form-group">
        <label for="geboortedatum">Geboortedatum</label>
        <input class="form-control" type="date" name="geboortedatum" required value="<?php print $geboortedatum;?>">
    </div>

    <div class="form-group">
        <label for="telefoonnummer">Telefoonnummer</label>
        <input class="form-control" type="tel" name="telefoonnummer" placeholder="0612345678" required value="<?php print $telefoonnr;?>">
    </div>

    <div class="form-group">
        <label for="email">Emailadres</label>
        <input class="form-control" type="email" name="emailadres" placeholder="naam@voorbeeld.com" required value="<?php print $email;?>">
    </div>

    <br>
    <input type="submit" name="verstuur" value="Verstuur" class="btn btn-default"><br>
</form>
</div>
<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>
<?php
if (isset($_POST["verstuur"])) {
    if (empty($_POST["cursus"]) || empty($_POST["voornaam"]) || empty($_POST["achternaam"]) || empty($_POST["geboortedatum"]) || empty($_POST["telefoonnummer"]) || empty($_POST["emailadres"])) {
        print("Alle velden moeten ingevuld zijn");
    } else {

        header("location: index.php");
        ob_end_flush();
        die();
    }
}
require_once 'includes/footer.php'
;?>
</body>
</html>
<?php
//Database connectie
require_once 'admin/classes/connection.class.php';
$db = new connection();
$db = $db->databaseConnection();
?>