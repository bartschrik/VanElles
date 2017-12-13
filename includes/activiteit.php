<?php
require_once 'admin/classes/connection.class.php';
require_once 'admin/classes/content.class.php';


$content = new Content();
$nieuw = $content->getNieuwactiv();
if ($nieuw){
    $id = $nieuw["blog_id"];
    $img_name = $nieuw["img_name"];
    $title = $nieuw['title'];
    $subtitel = $nieuw["subtitle"];
    $inhoud = $nieuw["inhoud"];

    echo '
            <div class="" id="main-product">';

            echo '<div class="a-center">
                    <div class="ptitle">
                        <h2>'.$title.'</h2>
                    </div>
                 </div>';

                    print ("<div class=\"card marbot\">");

                    echo "<a href='#' style='background-image: url(".constant("local_url")."/admin/images/blog/".$img_name.");' class='card-img'></a>";

                    print ("<div class=\"card-body\">");

                    print("<a href=\"#\"><h4 class=\"card-title\">" . $subtitel . "</h4></a>");

                    print("<p class=\"card-text\">" . $inhoud . "</p>");

                    print"<a href='blog/$id' title='Details'>Details</a>";

                    print("</div>");
                ?>
<?php }?>