<?php
include_once('includes/header.php');
?>
<div class="content">
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
                    <div class="col-xs-6 text-right"><a href="paginatoevoegen.php" id="pvt"><i class="fa fa-plus"></i> voeg pagina toe</a></div>
                </div>
                <table class="maintable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titel</th>
                        <th>Aangemaakt door</th>
                        <th>aktief</th>
                        <th>optie's</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#1</td>
                        <td>Homepage</td>
                        <td><div>Nick Simons</div></td>
                        <td>Ja</td>
                        <td><a href="#" title="Bewerken" data-id="1"><i class="fa fa-pencil"></i></a><a class="confirm" href="#" title="Verwijderen" data-id="1"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>Over ons</td>
                        <td><div>Nick Simons</div></td>
                        <td>Ja</td>
                        <td><a href="#" title="Bewerken" data-id="1"><i class="fa fa-pencil"></i></a><a class="confirm" href="#" title="Verwijderen" data-id="1"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>Producten</td>
                        <td><div>Nick Simons</div></td>
                        <td>Ja</td>
                        <td><a href="#" title="Bewerken" data-id="1"><i class="fa fa-pencil"></i></a><a class="confirm" href="#" title="Verwijderen" data-id="1"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    </tbody>
                </table>
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