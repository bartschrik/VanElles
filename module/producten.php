<?php
    require_once 'admin/classes/connection.class.php';
    include_once 'admin/classes/product.class.php';
    include_once 'admin/classes/content.class.php';


    $db = new Connection();
    $db = $db->databaseConnection();


?>

<!--PRODUCT DETAIL-->
<?php if($pageId) { ?>
    <div class="container">
        <div class="row">
            <div class="martop marbot">
                <?php

                if(!isset($_GET['pid'])){
                    die(header("Location: ".constant("local_url")."404"));
                }

                $msg = "";
                $product = new product();

                $pid = $_GET['pid'];

                $sql = "SELECT * FROM product p JOIN leveranciers l ON p.lev_id=l.lev_id WHERE p.product_id=$pid";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                $row = $stmt->fetch();


                $id = $row['product_id'];
                $product = $row[1];
                $inhoud = $row[2];
                $korteinhoud = $row["korte_inhoud"];
                $img_name = $row['images'];
                $url = $row["webshop_url"];
                $description = $row["description"];
                $kernwoorden = $row["kernwoorden"];
                $leverancier = $row[11];
                $pageContent['pagetitle'] = $product;
                $pageContent['description'] = $row["description"];
                $pageContent['kernwoorden'] = $row["kernwoorden"];

                if(!$id == $pid){
                    die(header("Location: ".constant("local_url")."404"));
                }

                echo '
                    
                    <div class="col-md-8 col-sm-6 col-xs-12">
                    
                    <div class="ptitle">
                        <h1 id="webtitle">'. $product .'</h1>
                        <h2>'. $leverancier.'</h2>
                    </div>
                    
                    <p>'. $inhoud .'</p>
                    
                    <div class="martop marbot">
                    <h3>Interesse in dit product?</h3>
                    
                    
                    <a href='.$url.' target=\'_blank\' class="btn btn-primary">Breng me naar de webshop!</a>
                    </div></div>

                    <div class="col-md-4 col-sm-6 col-xs-12 marbot">
                        <a href="'.constant("local_url").'admin/images/product/'.$img_name.'" data-lightbox="image-1" data-title="'.$product.'"><img src="'.constant("local_url").'admin/images/product/'.$img_name.'" class="img-responsive" style=""></a>
                    </div>
                    <div id="seo_des" style="display: none;">'.$description.'</div>
                    <div id="seo_kern" style="display: none;">'.$kernwoorden.'</div>';
                ?>
            </div>
        </div>
    </div>

    <!--ALLE PRODUCTEN-->

<?php } else { ?>
    <div class="container">
        <div class="row">
            <div class="martop marbot">
                <div class="col-xs-12">
                    <div class="ptitle">
                        <h1>Producten</h1>
                    </div>
                </div>

                <?php

                $content = new Content();

                $sql = "SELECT * FROM product";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                while ($row = $stmt->fetch())
                {
                    $pid = $row["product_id"];
                    $productnaam = $row["naam"];
                    $inhoud = $row["korte_inhoud"];
                    $foto = $row["images"];
                    $url = $row["webshop_url"];

                    print("<div class='col-xs-12 col-lg-3 col-md-4 col-sm-6 marbot'><div class='card pro-card'>");

                    $pmid = $_GET['page'];
                    $ppage = constant('local_url'). "$pmid/$pid";

                    echo "<a href='$ppage' style='background-image: url(".constant("local_url")."/admin/images/product/".$foto.");' class='card-img'></a>";


                    print("<div class=\"card-body\">");

                    print(" <a href=\"$ppage\"><h4 class=\"card-title\">" . $productnaam . "</h4></a>");

                    print(" <p class=\"card-text\">" . $inhoud . "</p>");


                    print("  <div class=\"a-right\"><a href=\"$ppage\" class=\"btn btn-primary\">Lees meer</a></div>");

                    print("</div></div></div>");

                }
                ?>
            </div>
        </div>
    </div>

<?php }
