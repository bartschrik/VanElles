<div class="content">
    <?php
    include_once('includes/header.php');

    $msg = "";
    $producten = new product();

    if(isset($_GET['verid'])) {
        $verproduct = $producten->deleteProduct($_GET['verid']);
        if ($verproduct) {
            $msg = '<div class="feedback success"><p>Product succesvol verwijderd</p></div>';
        } else {
            $msg = '<div class="feedback error"><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>';
        }
    }


    $productlist = $producten->getAllproduct();
    if(!$productlist && is_bool($productlist)) {
        $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
    }

    //var_dump($productlist);

    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Product <span>overzicht</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Product beheren</span>
                </div>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6 text-right"><a href="product_toevoegen.php" id="pvt"><i class="fa fa-plus"></i> voeg product toe</a></div>
                </div>
                <?php
                echo $msg;
                if($productlist != false) {
                    echo '
                        <table class="maintable" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product</th>
                                    <th>Inhoud</th>
                                    <th>Leverancier</th>
                                    <th style="width: 100px;">Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($productlist as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['product_id'].'</td>
                                <td>'.$value[1].'</td>
                                <td>'.$value['inhoud'].'</td>
                                <td>'.$value[3].'</td>
                                <td><a href="product_bewerken.php?bewerkid='.$value['product_id'].'" title="Bewerken" data-id="'.$value['product_id'].'"><i class="fa fa-pencil"></i></a><a class="confirm" href="product_overzicht.php?verid='.$value['product_id'].'" title="Verwijderen" data-id="'.$value['product_id'].'"><i class="fa fa-trash"></i></a></td>
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
        var r = confirm("Weet je zeker dat je dit product wilt verwijderen?");
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
