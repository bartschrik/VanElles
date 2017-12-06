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

            $sql3 = "SELECT * FROM review JOIN user ON review.user_id=user.user_id WHERE active=1";
            $stmtout = $db->prepare($sql3);

            $stmtout->execute();

            while ($row = $stmtout->fetch())
            {
                $naamprint = $row["first_name"];
                $datumprint = $row["datum"];
                $quoteprint = $row["quote"];
                $ratingprint = $row["rating"];

                print("<div class='col-xs-12 col-md-6'><div class='card recensiekaart'>");

                print($naamprint . ", " . date("j F Y", strtotime($datumprint)) . "<br><br>" . $quoteprint . "<br><br>");

                for ($i=1; $i <= $ratingprint; $i++){
                    print("<hartjevol class='ion-ios-heart' style='color: #ff00ff; font-size: 30px;'></hartjevol>");
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

