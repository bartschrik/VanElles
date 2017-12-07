<div class="content">
    <?php
    include_once('includes/header.php');

    $msg = "";
    $leverancier = new leverancier();

    if(isset($_GET['verid'])) {
        $verleverancier = $leverancier->deleteLev($_GET['verid']);
        if ($verleverancier) {
            $msg = '<div class="feedback success"><p>Leverancier succesvol verwijderd</p></div>';
        } else {
            $msg = '<div class="feedback error"><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>';
        }
    }


    $leverancierlist = $leverancier->getAlllev();
    if(!$leverancierlist && is_bool($leverancierlist)) {
        $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
    }

    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Leveranciers <span>overzicht</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Leveranciers beheren</span>
                </div>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6 text-right"><a href="leverancier_toevoegen.php" id="pvt"><i class="fa fa-plus"></i> voeg leverancier toe</a></div>
                </div>
                <?php
                echo $msg;
                if($leverancierlist != false) {
                    echo '
                        <table class="maintable" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Leverancier</th>
                                    <th style="width: 100px;">Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($leverancierlist as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['lev_id'].'</td>
                                <td>'.$value['naam'].'</td>
                                <td><a href="leverancier_bewerken.php?bewerkid='.$value['lev_id'].'" title="Bewerken" data-id="'.$value['lev_id'].'"><i class="fa fa-pencil"></i></a><a class="confirm" href="leverancier_overzicht.php?verid='.$value['lev_id'].'" title="Verwijderen" data-id="'.$value['lev_id'].'"><i class="fa fa-trash"></i></a></td>
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
        var r = confirm("Weet je zeker dat je deze leverancier wilt verwijderen?");
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
