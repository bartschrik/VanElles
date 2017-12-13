<?php
require_once 'admin/classes/connection.class.php';
require_once 'admin/classes/content.class.php';


$content = new Content();
$uitgelicht = $content->getProductuitgelicht();
if ($uitgelicht){
    echo '<div class="container">
        <div class="row">
            <div class="col-xs-12" id="main-product">';

                echo '<div class="a-center">
                    <div class="ptitle">
                        <h2>Uitgelichte producten</h2>
                    </div>
                </div>';

                echo '<div id="product-slide">';
                    //var_dump($uitgelicht);

                    foreach ($uitgelicht as $value) {

                        $naam = $value[1];
                        $leverancier = $value["naam"];
                        $inhoud = $value[3];
                        $image = $value["images"];

                     print ("<div class=\"slide\">");

                     print ("<div class=\"card marbot\">");

                     echo "<a href='#' style='background-image: url(".constant("local_url")."/admin/images/product/".$image.");' class='card-img'></a>";

                     print ("<div class=\"card-body\">");

                     print ("<a href=\"#\"><h4 class=\"card-title\">" . $naam ."</h4></a>");

                     print ("<a href=\"#\"><h4 class=\"card-subtitle\">" . "van ". $leverancier ."</h4></a>");

                     print ("<p class=\"card-text\">$inhoud</p>");

                     print("  <div class=\"a-right\"><a href=\"#\" class=\"btn btn-primary\">Lees meer</a></div>");

                    print (" </div></div></div>");
                    }
                        ?>

                </div>
            </div>
        </div>
    </div>
<?php }?>