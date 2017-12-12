<div class="container">
    <div class="row">
        <div class="col-xs-12" id="main-product">
            <div id="product-slide">
                <?php
                require_once 'admin/classes/connection.class.php';
                $db = new Connection();
                $db = $db->databaseConnection();

                $query1 = $db->prepare('SELECT * FROM blog WHERE activiteit = "1" ORDER BY datum DESC');
                $query1->execute();

                $row = $query1->fetch(PDO::FETCH_ASSOC);
                $id = $row['blog_id'];
                $img_name = $row['img_name'];
                $title = $row['title'];
                $subtitel = $row["subtitle"];

                    print ("<div class=\"card marbot\">");

                    echo "<a href='#' style='background-image: url(".constant("local_url")."/admin/images/blog/".$img_name.");' class='card-img'></a>";

                    print ("<div class=\"card-body\">");

                    print("<a href=\"#\"><h4 class=\"card-title\">" . $title . "</h4></a>");

                    print("<p class=\"card-text\">" . $subtitel . "</p>");

                    print"<a href='blog/$id' title='Details'>Details</a>";

                    print("</div></div></div>");
                ?>
            </div>
        </div>
    </div>
</div>