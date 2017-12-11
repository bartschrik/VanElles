<?php include_once 'includes/header.php' ?>
    <div class="container">
        <div class="row">
            <div class="martop marbot">
                <div class="ptitle">
                    <h1>Producten</h1>
                </div>

                <?php
                require_once 'admin/classes/connection.class.php';
                $db = new Connection();
                $db = $db->databaseConnection();

                $sql = "SELECT * FROM product";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                while ($row = $stmt->fetch())
                {
                    $productnaam = $row["naam"];
                    $inhoud = $row["inhoud"];
                    $foto = $row["images"];

                    print("<div class='col-xs-12 col-md-3 col-sm-6 marbot'><div class='card'>");

                    echo "<a href='#' style='background-image: url(".constant("local_url")."/admin/images/product/".$foto.");' class='card-img'></a>";

                    //print("<img class='card-img' src='./admin/images/product/" . "$foto" . "'>");

                    print("<div class=\"card-body\">");

                    print(" <a href=\"#\"><h4 class=\"card-title\">" . $productnaam . "</h4></a>");

                    print(" <p class=\"card-text\">" . $inhoud . "</p>");

                    print("</div></div></div>");

                }
                ?>
            </div>
        </div>
    </div>

<?php include_once 'includes/footer.php' ?>