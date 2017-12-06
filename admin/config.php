<?php
//session starten
session_start();

//Alles include bestantden
require_once 'classes/connection.class.php';
require_once 'functions.php';
require_once 'classes/user.class.php';
require_once 'classes/page.class.php';
require_once 'classes/validate.class.php';
require_once 'classes/leverancier.class.php';
require_once 'classes/recensie.class.php';

//General classes
$user = new User();

//Als er op de uitlog knop word geklikt word deze functie aangeroepen, de sessie word verbroken en de cookie word weggehaalt.
if(isset($_GET['uitloggen'])) {
    if(isset($_COOKIE['remember'])) {
        unset($_COOKIE['remember']);
        setcookie( "remember", '', strtotime( '-30 days' ) );
    }
    session_destroy();
    die(header('Location: index.php'));
}

//Check als er een sessie is, wanneer hij dr niet is check hij of er een cookie bestaat met de juiste hash.
if(!$user->isLoggedIn()) {
    die(header("Location: index.php"));
}