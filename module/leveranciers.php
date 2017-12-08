<?php include_once 'includes/header.php' ?>
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

                    print("<div class='col-xs-12 col-md-4 marbot'><div class='card'>");

                   /* print("<a href=\"#\" class='card-img' style='background-image: url('/stbr.jpg');' ></a>");*/
                    print("<img class='card-img' src='./admin/images/leverancier/" . "$logo" . "'>");

                    print("<div class=\"card-body\">");

                    print(" <a href=\"#\"><h4 class=\"card-title\">" . $leveranciernaam . "</h4></a>");

                    print(" <p class=\"card-text\">" . $inhoud . "</p>");

                    print("</div></div></div>");

                }
            ?>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php' ?>
