<?php
require_once 'classes/connection.class.php';
require_once 'classes/user.class.php';

$user = new User();
$reg = $user->regiser("test@email2.nl", "Ties", "-", "Pol", "0699382393", "Rijssen", "Entoshof 23", "7462 VV", 1, "tiespol", "Hallo123");

if($reg) {
    echo "Passed";
} else {
    echo "Nope";
}