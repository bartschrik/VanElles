<!--Database connectie-->
<?php
    require_once 'admin/classes/connection.class.php';
    $db = new Connection();
    $db = $db->databaseConnection();
?>



<div id="main-quote" style="background-image: url('images/stbr2.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
                <div id="quote-slider">
                    <div>
                        <?php
                        $nix = "SELECT COUNT(*) from review";
                        $statement = $db->query($nix);
                        $result = $statement->fetch();

                        if($result == 0){
                            print("<div class='quote' style='height: 150px;'></div>");
                        } else {
                            $sql3 = "SELECT * FROM review JOIN user ON review.user_id=user.user_id ORDER BY RAND() LIMIT 1";
                            $stmtout = $db->prepare($sql3);

                            $stmtout->execute();

                            while ($row = $stmtout->fetch()) {
                                $naamprint = $row["first_name"];
                                $quoteprint = $row["quote"];
                                $ratingprint = $row["rating"];


                                print("<div class='quote'>" . $quoteprint . "<br>");
                                for ($i = 1; $i <= $ratingprint; $i++) {
                                    print("<hartjevol class='ion-ios-heart' style='color: #ff00ff; font-size: 60px;'></hartjevol>");
                                }

                                for ($j = 1; $j <= (5 - $ratingprint); $j++) {
                                    print("<hartjeleeg class='ion-ios-heart-outline' style='color: #777; font-size: 60px;'></hartjeleeg>");
                                }
                                print("</div>");

                                print("<div class='naam'>" . $naamprint . "</div>");
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

