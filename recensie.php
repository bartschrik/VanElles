<?php require_once 'includes/header.php' ?>

<div class="container">
    <div class="row">
        <div class="marbot martop">
            <div class="ptitle">
                <h1>Recensies</h1>
            </div>
            <?php
            require_once 'admin/classes/connection.class.php';
            $db = new Connection();
            $db = $db->databaseConnection();

            $sql3 = "SELECT * FROM review";
            $stmtout = $db->prepare($sql3);

            $stmtout->execute();

            while ($row = $stmtout->fetch())
            {
                $naamprint = $row["naam"];
                $datumprint = $row["datum"];
                $quoteprint = $row["quote"];
                $ratingprint = $row["rating"];

                print("<div class='col-xs-12 col-md-6'><div class='card recensiekaart'>");

                print($naamprint . " 27-10-1999" . "<br><br>" . $quoteprint . "<br><br>");

                for ($i=1; $i <= $ratingprint; $i++){
                    print("<hartjevol class='ion-ios-heart' style='color: pink; font-size: 30px;'></hartjevol>");
                }

                for ($j=1; $j <= (5 - $ratingprint); $j++){
                    print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 30px;'></hartjeleeg>");
                }
                print("</div></div>");
            }
            ?>
        </div>
    </div>
</div>






<?php require_once 'includes/footer.php' ?>

