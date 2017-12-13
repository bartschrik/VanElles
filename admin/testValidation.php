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
        ['foto',$_FILES['foto'],'validphoto']
    ]);
    if($val->isPassed()) {
        echo 'ja';
    } else {
        var_dump($val->getErrors());
    }

    //var_dump($_FILES['foto']);
    echo "<br><br>";

    foreach ($_FILES["foto"]["tmp_name"] as $key=>$tmp_name) {
        echo $_FILES["foto"]["name"][$key] . "<br />";
        echo $_FILES["foto"]["error"][$key] . "<br />";
    }
}

?>
<br>
<form action="#" method="post" enctype="multipart/form-data">
    <input type="file" name="foto[]" multiple>
    <input type="submit" name="submit">
</form>
