<div class="content">
    <?php
    include_once('includes/header.php');

    $msg = "";
    $blog = new blog();

    if(isset($_GET['verid'])) {
        $verblog = $blog->deleteBlog($_GET['verid']);
        if ($verblog) {
            $msg = '<div class="feedback success"><p>Blog succesvol verwijderd</p></div>';
        } else {
            $msg = '<div class="feedback error"><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>';
        }
    }

    $bloglist = $blog->getAllblog();
    if(!$bloglist && is_bool($bloglist)) {
        $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
    }

    ?>
<div class="pagetitel marbot">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">Blogs <span>overzicht</span></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 inhoud">
            <div class="titel">
                <i class="fa fa-cog"></i><span>Blogs beheren</span>
            </div>
            <div class="row">
                <div class="col-xs-6"></div>
                <div class="col-xs-6 text-right"><a href="blog_up.php" id="pvt"><i class="fa fa-plus"></i> voeg Blog toe</a></div>
            </div>
            <?php
            echo $msg;
            if($bloglist != false) {
                echo '
                        <table class="maintable" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Blog titel</th>
                                    <th>Activiteit</th>
                                    <th>Deelnemers</th>
                                    <th style="width: 100px;">Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';

                foreach($bloglist as $value) {
                    echo '
                            <tr>
                                <td>#'.$value['blog_id'].'</td>
                                <td>'.$value['title'].'</td>
                    <td>'; if($value["activiteit"] == 1){
                                        echo"Ja";
                                    }else{
                                        echo"Nee";
                                    }
                    echo'</td>
                                <td>'; if($value["activiteit"] == 1){
                                    echo $value['inschrijvingen'];
                                    } else {
                                    echo"Geen";
                                    }
                    echo '</td>
                                <td><a href="blog_bewerk.php?bewerkid='.$value['blog_id'].'" title="Bewerken" data-id="'.$value['blog_id'].'"><i class="fa fa-pencil"></i></a><a class="confirm" href="blog_admin.php?verid='.$value['blog_id'].'" title="Verwijderen" data-id="'.$value['blog_id'].'"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                }
                echo '
                            </tbody>
                        </table>';
            }

            ?>
        </div>
    </div>
</div>
</div>
</body>
<script>
    $(".confirm").click(function(e){
        var r = confirm("Weet je zeker dat je deze blog wilt verwijderen?");
        console.log('pong2');
        if (r == true) {
            console.log('ping');
        } else {
            return false;
            console.log('pong');
        }
    });
</script>
</html>
