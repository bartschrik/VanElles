<div class="content">
    <?php
        include_once('includes/header.php');

        $msg = "";
        $page = new Page();

        if(isset($_GET['verid'])) {
            $verpagina = $page->deletePagina($_GET['verid']);
            if ($verpagina) {
                $msg = '<div class="feedback success"><p>Pagina succesvol verwijderd</p></div>';
            } else {
                $msg = '<div class="feedback error"><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>';
            }
        }


        $pageListActive = $page->getAllMin(1);
        $pageLIstInActive = $page->getAllMin(0);
        if(!$pageListActive && is_bool($pageListActive) || !$pageLIstInActive && is_bool($pageLIstInActive) ) {
            $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
        }

    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Pagina <span>overzicht</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Pagina's beheren</span>
                </div>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6 text-right"><a href="pagina_toevoegen.php" id="pvt"><i class="fa fa-plus"></i> voeg pagina toe</a></div>
                </div>
                <?php
                echo $msg;
                if($pageListActive != false) {
                    echo '
                        <table class="maintable" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titel</th>
                                    <th>Aangemaakt door</th>
                                    <th>Actief</th>
                                    <th>Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($pageListActive as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['id'].'</td>
                                <td>'.$value['title'].'</td>
                                <td><div>'.$value['first_name']." ". $value['insertion'] . " " . $value['last_name'].'</div></td>
                                <td>Ja</td>
                                <td><a href="pagina_bewerken.php?bewerkid='.$value['id'].'" title="Bewerken" data-id="'.$value['id'].'"><i class="fa fa-pencil"></i></a><a class="confirm" href="dashboard.php?verid='.$value['id'].'" title="Verwijderen" data-id="'.$value['id'].'"><i class="fa fa-trash"></i></a></td>
                            </tr>';

                    }
                    echo '
                            </tbody>
                        </table>';
                }


                if($pageLIstInActive != false) {
                    echo '
                        <table class="maintable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titel</th>
                                    <th>Aangemaakt door</th>
                                    <th>Actief</th>
                                    <th>Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($pageLIstInActive as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['id'].'</td>
                                <td>'.$value['title'].'</td>
                                <td><div>'.$value['first_name']." ". $value['insertion'] . " " . $value['last_name'].'</div></td>
                                <td>Nee</td>
                                <td><a href="pagina_bewerken.php?bewerkid='.$value['id'].'" title="Bewerken" data-id="'.$value['id'].'"><i class="fa fa-pencil"></i></a><a class="confirm" href="dashboard.php?verid='.$value['id'].'" title="Verwijderen" data-id="'.$value['id'].'"><i class="fa fa-trash"></i></a></td>
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
        var r = confirm("Weet je zeker dat je deze pagina wilt verwijderen?");
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