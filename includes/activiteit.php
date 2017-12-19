<?php
require_once 'admin/classes/connection.class.php';
require_once 'admin/classes/content.class.php';


$content = new Content();
$nieuwa = $content->getNieuwActiv();

if ($nieuwa) {
    $id = $nieuwa["blog_id"];
    $img_name = $nieuwa["img_name"];
    $title = $nieuwa['title'];
    $subtitel = $nieuwa["subtitle"];
    $inhoudkort = $nieuwa["korte_inhoud"];
    $date = date("j F Y", strtotime($nieuwa["datum"]));
    $time = date("H:i", strtotime($nieuwa["datum"]));
    $page = $content->getUrlbyModule(4);
    $url = constant("local_url").$page."/".$id;
    $aantalPlek = $nieuwa['inschrijving_aantal'] - $nieuwa['inschrijvingen'];
    if($aantalPlek == 1) {
        $plekken = "1 plaats vrij";
    } else {
        $plekken = "$aantalPlek plaatsen vrij";
    }

    echo"
    <div class='ptitle'>
        <h1>Activiteit</h1>
    </div>
    <div class='card marbot'>
        <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
        <span class='date'>$date<br><span>$time</span></span>
        <span class='plaatsen'>$plekken</span>
        <div class='card-body'>
            <a href=$url><h4 class='card-title'>$title</h4></a>
            <p class='card-text'>$inhoudkort</p>
            <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
        </div>
    </div>";
} else {
    $nieuwb = $content->getNieuwBlog();
    if ($nieuwb) {
        $id = $nieuwb["blog_id"];
        $img_name = $nieuwb["img_name"];
        $title = $nieuwb['title'];
        $subtitel = $nieuwb["subtitle"];
        $inhoudkort = $nieuwb["korte_inhoud"];
        $page = $content->getUrlbyModule(4);
        $url = constant("local_url").$page."/".$id;


        echo"
    <div class='ptitle'>
        <h1>Nieuwsbericht</h1>
    </div>           
    <div class='card marbot'>
        <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
        <div class='card-body'>
            <a href=$url><h4 class='card-title'>$title</h4></a>
            <p class='card-text'>$inhoudkort</p>
            <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
        </div>
    </div>";
    }
}
?>