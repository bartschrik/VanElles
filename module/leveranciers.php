<?php
include_once 'admin/classes/leverancier.class.php';
include_once 'admin/classes/content.class.php';

$db = new Connection();
$db = $db->databaseConnection();

    /*LEVERANCIER DETAIL*/
 if($pageId) {
?>
     <div class="container">
         <div class="row">
             <div class="martop marbot">
                 <?php

                 $msg = "";
                 $leverancier = new leverancier();

                 $pid = $_GET['pid'];

                 $sql = "SELECT * FROM leveranciers WHERE lev_id=$pid";
                 $stmt = $db->prepare($sql);

                 $stmt->execute();

                 $row = $stmt->fetch();


                 $id = $row['lev_id'];
                 $leverancier = $row["naam"];
                 $inhoud = $row["inhoud"];
                 $korteinhoud = $row["korte_inhoud"];
                 $img_name = $row['logo'];
                 $description = $row["description"];
                 $kernwoorden = $row["kernwoorden"];

                 echo '
                    
                    <div class="col-md-8 col-sm-6 col-xs-12">
                    
                    <div class="ptitle">
                        <h1 id="webtitle">'. $leverancier .'</h1> 
                    </div>
                    <p>'. $inhoud .'</p>
    
                    </div>
    
                    <div class="col-md-4 col-sm-6 col-xs-12 marbot">
                        <img src="'.constant("local_url").'admin/images/leverancier/'.$img_name.'" class="img-responsive" style="width: 100%; height: 50%;">
                    </div>';
                 ?>

             </div>
         </div>
     </div>
     <?php
     require_once 'includes/levproductenslide.php';

/*     ALLE LEVERANCIERS*/

 } else { ?>
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

            $content = new Content();

            $sql = "SELECT * FROM leveranciers";
            $stmt = $db->prepare($sql);

            $stmt->execute();

            while ($row = $stmt->fetch())
            {
                $lid = $row["lev_id"];
                $leveranciernaam = $row["naam"];
                $inhoud = $row["korte_inhoud"];
                $logo = $row["logo"];

                print("<div class='col-xs-12 col-md-4 col-sm-6 marbot'><div class='card'>");

                $lmid = $content->getUrlbyModule(5);
                $lpage = constant('local_url'). "/$lmid/$lid";

                echo "<a href='$lpage' style='background-image: url(".constant("local_url")."/admin/images/leverancier/".$logo.");' class='card-img'></a>";

                //print("<img class='card-img' src='./admin/images/leverancier/" . "$logo" . "'>");

                print("<div class=\"card-body\">");

                print(" <a href=\"$lpage\"><h4 class=\"card-title\">" . $leveranciernaam . "</h4></a>");

                print(" <p class=\"card-text\">" . $inhoud . "</p>");

                print("  <div class=\"a-right\"><a href=\"$lpage\"class=\"btn btn-primary\">Lees meer</a></div>");

                print("</div></div></div>");

            }
            ?>
        </div>
    </div>
</div>
<?php } ?>

<?php include_once 'includes/footer.php' ?>
