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

                        $pid = $value["product_id"];
                        $lid = $value["lev_id"];
                        $naam = $value[1];
                        $leverancier = $value["naam"];
                        $inhoud = $value[3];
                        $image = $value["images"];
                        $url = $value["webshop_url"];

                     print ("<div class=\"slide\">");

                     print ("<div class=\"card marbot\">");

                        $pmid = $content->getUrlbyModule(6);
                        $ppage = constant('local_url'). "/$pmid/$pid";

                     echo "<a href='$ppage' style='background-image: url(".constant("local_url")."/admin/images/product/".$image.");' class='card-img'></a>";

                     print ("<div class=\"card-body\">");

                     print ("<a href=\"$ppage\"><h4 class=\"card-title\">" . $naam ."</h4></a>");

                        $lmid = $content->getUrlbyModule(5);
                        $lpage = constant('local_url'). "/$lmid/$lid";


                     print ("<a href=\"$lpage\"><h4 class=\"card-subtitle\">" . "van ". $leverancier ."</h4></a>");

                     print ("<p class=\"card-text\">$inhoud</p>");

                     print("  <div class=\"a-right\"><a href=\"$ppage\" class=\"btn btn-primary\">Lees meer</a></div>");

                    print (" </div></div></div>");
                    }
                        ?>

                </div>
            </div>
        </div>

    </div>
<?php }?>