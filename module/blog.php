<?php
    require_once 'admin/classes/connection.class.php';
    $db = new Connection();
    $db = $db->databaseConnection();
?>
    <div class="container">
        <div class="row">
            <div class="martop marbot">
                <div class="ptitle">
                    <h1>Blogs</h1>
                </div>
                <div><form action="#" method="post" class="classicform">
                    Activiteiten: <select name="sorteer" id="selectmodule">
                                  <option value="0">Nee</option>
                                  <option value="1">Ja</option>
                                  </select>
                    <button type="submit" name="savesort" class="save">Opslaan</button>
                </form></div><br>
<?php
    $dir = 'admin/images/blog/';

    if (!isset($_POST['sorteer']) || ($_POST['sorteer'] == "0")) {
            $query1 = $db->prepare('SELECT * FROM blog WHERE activiteit = "0" ORDER BY blog_id DESC');
            $query1->execute();

            while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['blog_id'];
                $img_name = $row['img_name'];
                $title = $row['title'];
                $subtitel = $row["subtitle"];

                print("<div class='col-xs-12 col-sm-6 marbot'><div class='card'>");

                echo "<a href='#' style='background-image: url(" . constant("local_url") . "$dir/$img_name" . ");' class='card-img'></a>";

                print("<div class='card-body'>");

                print("<a href=\"#\"><h4 class=\"card-title\">" . $title . "</h4></a>");

                print("<p class=\"card-text\">" . $subtitel . "</p>");

                print"<a href='blog/$id' title='Details'>Details</a>";

                print("</div></div></div>");
            }
    } else {
        if ($_POST['sorteer'] == "1") {
            $query2 = $db->prepare('SELECT * FROM blog WHERE activiteit = "1" ORDER BY blog_id DESC');
            $query2->execute();
            while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['blog_id'];
                $img_name = $row['img_name'];
                $title = $row['title'];
                $subtitel = $row["subtitle"];

                print("<div class='col-xs-12 col-sm-6 marbot'><div class='card'>");

                echo "<a href='#' style='background-image: url(" . constant("local_url") . "$dir/$img_name" . ");' class='card-img'></a>";

                //print("<img class='card-img' src='./admin/images/product/" . "$foto" . "'>");

                print("<div class='card-body'>");

                print("<a href=\"#\"><h4 class=\"card-title\">" . $title . "</h4></a>");

                print("<p class=\"card-text\">" . $subtitel . "</p>");

                print"<a href='blog/$id' title='Details'>Details</a>";

                print("</div></div></div>");
            }
        }
    }
?>
            </div>
        </div>
    </div>
