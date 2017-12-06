<div class="content">
    <?php
    include_once('includes/header.php');

    $msg = "";
    $recensie = new recensie();

    if(isset($_GET['verid'])) {
        $verrecensie = $recensie->deleterecensie($_GET['verid']);
        if ($verrecensie) {
            $msg = '<div class="feedback success"><p>Recensie succesvol verwijderd</p></div>';
        } else {
            $msg = '<div class="feedback error"><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>';
        }
    }

    if(isset($_GET['accepid'])) {
        $acceprecensie = $recensie->acceprecensie($_GET['accepid']);
        if ($acceprecensie) {
            $msg = '<div class="feedback success"><p>Recensie succesvol goedgekeurd</p></div>';
        } else {
            $msg = '<div class="feedback error"><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>';
        }
    }


    $recensieListActive = $recensie->getAllrecensie(1);
    $recensieLIstInActive = $recensie->getAllrecensie(0);
    if(!$recensieListActive && is_bool($recensieListActive) || !$recensieLIstInActive && is_bool($recensieLIstInActive) ) {
        $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
    }

    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Recensie <span>overzicht</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Recensies beheren</span>
                </div>
                <?php
                echo $msg;

                if($recensieLIstInActive != false) {
                    echo '
                        <table class="maintable"  style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Quote</th>
                                    <th>Naam</th>
                                    <th>Aantal sterren</th>
                                    <th>Goedgekeurd</th>
                                    <th style="width: 100px;">Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($recensieLIstInActive as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['review_id'].'</td>
                                <td>'.$value['quote'].'</td>
                                <td>'.$value['first_name'].'</td>             
                                <td>'.$value['rating'].'</td>
                                <td>Nee</td>
                                <td><a href="recensie_goedkeuren.php?accepid='.$value['review_id'].'" title="Goedkeuren" data-id="'.$value['review_id'].'"><i class="fa fa-check"></i></a><a class="confirm" href="recensie_goedkeuren.php?verid='.$value['review_id'].'" title="Verwijderen" data-id="'.$value['review_id'].'"><i class="fa fa-trash"></i></a></td>
                            </tr>';

                    }
                    echo '
                            </tbody>
                        </table>';
                }




                if($recensieListActive != false) {
                    echo '
                        <table class="maintable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Quote</th>
                                    <th>Naam</th>
                                    <th>Aantal sterren</th>
                                    <th>Goedgekeurd</th>
                                    <th style="width: 100px;">Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($recensieListActive as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['review_id'].'</td> 
                                <td>'.$value['quote'].'</td>
                                <td>'.$value['first_name'].'</td>
                                <td>'.$value['rating'].'</td>
                                <td>Ja</td>
                                <td><a class="confirm" href="recensie_goedkeuren.php?verid='.$value['review_id'].'" title="Verwijderen" data-id="'.$value['review_id'].'"><i class="fa fa-trash"></i></a></td>
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
        var r = confirm("Weet je zeker dat je deze recensie wilt verwijderen?");
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