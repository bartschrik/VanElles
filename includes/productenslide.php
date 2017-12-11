<div class="container">
        <div class="row">
            <div class="col-xs-12" id="main-product">
                <div class="a-center">
                    <div class="ptitle">
                        <h2>Uitgelichte producten</h2>
                    </div>
                </div>
                <div id="product-slide">
                    <?php
                    require_once 'admin/classes/connection.class.php';
                    $db = new Connection();
                    $db = $db->databaseConnection();

                    $sql = "SELECT * FROM product p JOIN leveranciers l ON p.lev_id=l.lev_id WHERE uitgelicht = 1";
                    $stmt = $db->prepare($sql);

                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        $naam = $row[1];
                        $leverancier = $row["naam"];
                        $inhoud = $row[2];
                        $image = $row["images"];

                     print ("<div class=\"slide\">");

                     print ("<div class=\"card marbot\">");

                     echo "<a href='#' style='background-image: url(".constant("local_url")."/admin/images/product/".$image.");' class='card-img'></a>";

                     print ("<div class=\"card-body\">");

                     print ("<a href=\"#\"><h4 class=\"card-title\">" . $naam ."</h4></a>");

                     print ("<a href=\"#\"><h4 class=\"card-subtitle\">" . "van ". $leverancier ."</h4></a>");

                     print ("<p class=\"card-text\">" . $inhoud. "</p>");

                     print("  <div class=\"a-right\"><a href=\"#\" class=\"btn btn-primary\">Lees meer</a></div>");

                    print (" </div></div></div>");
                    }
                        ?>

                </div>
            </div>
        </div>
    </div>
