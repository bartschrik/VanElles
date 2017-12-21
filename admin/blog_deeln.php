<div class="content">
    <?php
    include_once('includes/header.php');

    $msg = "";
    $blog = new blog();

    if(isset($_GET['verid'])) {
        $verid = $blog->deleteInsch($_GET['verid']);
        if($verid) {
            $msg = '<div class="feedback success"><div class="row"><div class="col-xs-12"><p>De inschrijving is succesvol verwijderd.</p></div></div></div>';
        } else {
            $msg = '<div class="feedback error"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
        }
    }

    $blog_id = ($_GET['overzichtid']);

    $deelnemers = $blog->getDeelnOver($blog_id);
    if(!$deelnemers && is_bool($deelnemers)) {
        $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
    }
    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Deelnemers <span>overzicht</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Deelnemers beheren</span>
                </div>
                <div class="row">
                    <div class="col-xs-6"></div>
                </div>
                <?php
                echo $msg;
                if($deelnemers != false) {
                    echo '
                        <table class="maintable" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Email</th>
                                    <th style="width: 100px;">Opties</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($deelnemers['values'] as $value) {
                        echo'
                            <tr>
                                <td>#'.$value['user_id'].'</td>
                                <td><div>'.$value['first_name']." ". $value['insertion'] . " " . $value['last_name'].'</div></td>
                                <td>'.$value['email'].'</td>
                                <td><a class="confirm" href="blog_deeln.php?overzichtid='.$blog_id.'&verid='.$value['inschijving_id'].'" title="Verwijderen" data-id="'.$value['inschijving_id'].'"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                    }
                    echo '
                            </tbody>
                        </table>';
                }

                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(".confirm").click(function(e){
        var r = confirm("Weet je zeker dat je deze inschrijving wilt verwijderen?");
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