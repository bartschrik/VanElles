<?php
//session starten
session_start();

//Alles include bestantden
require_once 'classes/connection.class.php';
require_once 'functions.php';
require_once 'classes/user.class.php';
require_once 'classes/validate.class.php';
require_once 'classes/simpleImage.class.php';


if(isset($_POST['submit'])) {
    $val = new Validate([
        ['foto',$_FILES['foto'],'imgrequired|validphoto']
    ]);


    if($val->isPassed()) {
        echo 'ja';
    } else {
        var_dump($val->getErrors());
    }
}

?>

<form action="#" method="post" enctype="multipart/form-data">
    <input type="file" name="foto">
    <input type="submit" name="submit">
</form>
