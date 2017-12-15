<?php
require_once 'admin/classes/connection.class.php';
require_once 'admin/classes/content.class.php';


$content = new Content();
$nieuwa = $content->getNieuwActiv();
$nieuwb = $content->getNieuwBlog();

if ($nieuwa) {
    $id = $nieuwa["blog_id"];
    $img_name = $nieuwa["img_name"];
    $title = $nieuwa['title'];
    $subtitel = $nieuwa["subtitle"];
    $inhoud = $nieuwa["inhoud"];
    $page = $content->getUrlbyModule(4);
    $url = constant("local_url").$page."/".$id;

    echo '
              <div class="ptitle">
                    <h1>Nieuws</h1>
                    <h2>' . $title . '</h2>
                </div>
            <div class="" id="main-product">';

    print ("<div class=\"card marbot\">");

    echo "<a href='$url' style='background-image: url(" . constant("local_url") . "/admin/images/blog/" . $img_name . ");' class='card-img'></a>";

    print ("<div class=\"card-body\">");

    print("<a href=\"$url\"><h4 class=\"card-title\">" . $subtitel . "</h4></a>");

    print("<p class=\"card-text\">" . $inhoud . "</p>");

    print"<a href='$url' title='Details'>Lees meer</a>";

    print("</div>");
} else {
    if ($nieuwb) {
        $id = $nieuwb["blog_id"];
        $img_name = $nieuwb["img_name"];
        $title = $nieuwb['title'];
        $subtitel = $nieuwb["subtitle"];
        $inhoud = $nieuwb["inhoud"];
        $page = $content->getUrlbyModule(4);
        $url = constant("local_url").$page."/".$id;


        echo '
              <div class="ptitle">
                    <h1>Nieuws</h1>
                    <h2>' . $title . '</h2>
                </div>
            <div class="" id="main-product">';

        print ("<div class=\"card marbot\">");

        echo "<a href='$url' style='background-image: url(" . constant("local_url") . "/admin/images/blog/" . $img_name . ");' class='card-img'></a>";

        print ("<div class=\"card-body\">");

        print("<a href=\"$url\"><h4 class=\"card-title\">" . $subtitel . "</h4></a>");

        print("<p class=\"card-text\">" . $inhoud . "</p>");

        print"<a href='$url' title='Details'>Lees meer</a>";

        print("</div>");
    }
}
?>