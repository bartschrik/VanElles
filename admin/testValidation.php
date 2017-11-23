<?php
//session starten
session_start();

//Alles include bestantden
require_once 'classes/connection.class.php';
require_once 'functions.php';
require_once 'classes/user.class.php';
require_once 'classes/validate.class.php';
require_once 'classes/simpleImage.class.php';


$val = new Validate([
    ['username','nick','required'],
    ['password','fdjjj','required|min:5|max:6'],
    ['email','nick@twesq.nl','email'],
    ['url','111','num'],
    ['email','nick@twesq.com','max:5|uni:user:email'],
]);


if($val->isPassed()) {
    echo 'ja';
} else {
    var_dump($val->getErrors());
}





// Usage:
// Load the original image
$image = new SimpleImage('images/test.jpg');

// Resize the image to 600px width and the proportional height
$image->resizeToWidth(600);
$image->save('test_resized.jpg', IMAGETYPE_JPEG, 75, 777);

// Output the image to the browser:
$image->output();