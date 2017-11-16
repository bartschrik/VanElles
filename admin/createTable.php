<?php
require_once 'classes/connection.class.php';
//require_once 'classes/user.class.php';
//
//$user = new User();
//$user->regiser("Admin", "KBS", "nick@twesq.com", "Hallo12345", "admin");
$db = new Connection();
$table = $db->createTables();

if(!empty($table['done'])) {
    echo '<h1>New table(s) inserted</h1><ul>';
    foreach ($table['done'] as $value) {
        echo "<li>$value</li>";
    }
    echo "</ul>";
}

if (!empty($table['error'])) {
    echo '<h1>Allready existing table(s)</h1><ul>';
    foreach ($table['error'] as $value) {
        echo "<li>$value</li>";
    }
    echo "</ul>";
}