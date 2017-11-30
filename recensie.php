<?php require_once 'includes/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
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

                print($naamprint . " 27-10-199" . "<br>" . $quoteprint . "<br>");

                for ($i=1; $i <= $ratingprint; $i++){
                    print("<hartjevol class='ion-ios-heart' style='color: pink; font-size: 30px;'></hartjevol>");
                }

                for ($j=1; $j <= (5 - $ratingprint); $j++){
                    print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 30px;'></hartjeleeg>");
                }
                print("<br>------------------------<br>");
            }
            ?>
        </div>
    </div>
</div>






<?php require_once 'includes/footer.php' ?>

