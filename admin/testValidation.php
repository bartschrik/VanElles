<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="http://localhost/vanelles/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="http://localhost/vanelles/css/lightbox.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
//session starten
session_start();

//Alles include bestantden
require_once 'classes/connection.class.php';
require_once 'functions.php';
require_once 'classes/user.class.php';
require_once 'classes/validate.class.php';
require_once 'classes/simpleImage.class.php';
require_once 'classes/connection.class.php';

$filePath = "images/test/";
$user = new User();

if(isset($_POST['submit'])) {
    $val = new Validate([
        ['foto',$_FILES['foto'],'validphoto']
    ]);

    if($val->isPassed()) {
        foreach ($_FILES["foto"]["tmp_name"] as $key=>$tmp_name) {
            //Generate image name
            $date = new DateTime();
            $date = $date->format('Y-m-d H:i:s');
            $newFileName = sha1($date.$_FILES["foto"]['name'][$key]);
            $fileExtention = pathinfo($_FILES["foto"]['name'][$key], PATHINFO_EXTENSION);
            $fileWithoutExt = explode('.', $_FILES['foto']['name'][$key])[0];

            //Images load resize and save
            $sImg = new SimpleImage($tmp_name);
            $sImg->resizeToHeight(200);
            $sImg->save($filePath.$newFileName."-card.".$fileExtention, null, 100);

            $sImg->load($tmp_name);
            $sImg->resizeToHeight(200);
            $sImg->cutFromCenter(200, 200);
            $sImg->save($filePath.$newFileName."-thumb.".$fileExtention, null, 100);

            $sImg->load($tmp_name);
            $sImg->save($filePath.$newFileName.".".$fileExtention, null, 100);
            $sImg->saveDB($_FILES["foto"]['name'][$key], $tmp_name, $newFileName.".".$fileExtention, $fileWithoutExt, $user->getUser()['user_id']);
        }
    } else {
        var_dump($val->getErrors());
    }
}

$db = new Connection();
$db = $db->databaseConnection();
$query = $db->prepare('SELECT * FROM media');
$query->execute();
$medias = $query->fetchAll();
//var_dump($medias);
echo '<div class="container"><div class="row">';
foreach ($medias as $media) {
    $file_url = explode(".", $media['file_url']);
    echo '<div class="col-md-4 col-sm-4 col-xs-6"><a href="images/test/'.$file_url[0].'.'.$file_url[1].'" data-lightbox="image-1" data-title="'.$media['title'].'"><img src="images/test/'.$file_url[0].'-thumb.'.$file_url[1].'" class="img-responsive" /></a></div>';
}
echo '</div></div>';

?>
<br>
<form action="#" method="post" enctype="multipart/form-data">
    <input type="file" name="foto[]" multiple>
    <input type="submit" name="submit">
</form>

<script src="http://localhost/vanelles/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="http://localhost/vanelles/js/lightbox.js" type="text/javascript"></script>
</body>
</html>