<?php include_once 'includes/header.php'?>
<div class="container">
    <div class="row">
        <div class="martop marbot">
            <div class="ptitle">
                <h1>Leveranciers</h1>
            </div>

            <?php
                require_once 'admin/classes/connection.class.php';
                $db = new Connection();
                $db = $db->databaseConnection();

                $sql = "SELECT * FROM leveranciers";
                $stmt = $db->prepare($sql);

                $stmt->execute();

                while ($row = $stmt->fetch())
                {
                    $leveranciernaam = $row["naam"];
                    $inhoud = $row["inhoud"];
                    $logo = $row["logo"];

                    print("<div class='card'>");

                    print("<a href=\"#\" style='background-image: url('images/stbr.jpg');' class=\"card-img\"></a>");

                    print("<div class=\"card-body\">");

                    print(" <a href=\"#\"><h4 class=\"card-title\">Nieuw: STBR</h4></a>");

                    print(" <p class=\"card-text\"></p>");

                    print(" <div class=\"a-right\"><a href=\"#\" class=\"btn btn-primary\">Lees meer</a></div>");

                    print("</div></div>");

                }
            ?>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'?>
