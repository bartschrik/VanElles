<?php
//Database connectie
require_once 'classes/connection.class.php';
$db = new Connection();
$db = $db->databaseConnection();

//Post value of sortable
$sectionids = $_POST["sectionsid"];
$count = 1;

if (is_array($sectionids)) {
    foreach ($sectionids as $sectionid) {
        $query = $db->prepare("UPDATE page SET page_order = :count WHERE id = :id");
        $query->bindValue(":count", $count);
        $query->bindValue(":id", $sectionid);

        $query->execute();

        $count++;
    }

    echo '{"status":"success"}';
} else {
    echo '{"status":"failure", "message":"No Update happened. Could be an internal error, please try again."}';
}