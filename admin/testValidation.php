<?php
//session starten
session_start();

//Alles include bestantden
require_once 'classes/connection.class.php';
require_once 'functions.php';
require_once 'classes/user.class.php';
require_once 'classes/validate.class.php';


$val = new Validate([
    ['username','nick','required|uni:database'],
    ['password','fdjhjjj','required|min:5|max:6'],
    ['email','nick@twesq.nl','email'],
    ['url','111','num'],
]);


if($val->isPassed()) {
    echo 'ja';
} else {
    var_dump($val->getErrors());
}

