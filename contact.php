<?php require_once 'includes/header.php';?>



<div class="martop">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="ptitle">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 marbot">
                <div class="ptitle">
                    <h2>Algemene informatie</h2>
                </div>
                <ul style="list-style: none; padding: 0; margin: 0 0 10px 0;">
                    <li>Van Elles WoonKado&Zo</li>
                    <li>Rozengaarde 77 </li>
                    <li>7461 DA Rijssen</li>
                </ul>
                <table style="width: 100%;">
                    <tr><td>Telefoon: </td><td><a href="tel:0613653118">06 13 65 31 18</a></td></tr>
                    <tr><td>E-mail: </td><td><a href="mailto:info@vanelles.nl">info@vanelles.nl</a></td></tr>
                    <tr><td>Kvk: </td><td>0613653118</td></tr>
                    <tr><td>BTW: </td><td>208147895B01</td></tr>
                </table>
            </div>
            <div class="col-xs-6 marbot">
                <div class="ptitle">
                    <h2>Contact formulier</h2>
                </div>
                <form method="post" action="mail/Mail_contact.php">
                    <div class="form-group">
                        <input class="form-control" type="text" name="naam" placeholder="Naam">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="tel" name="telefoonnummer" placeholder="Telefoonnummer">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="naam@voorbeeld.com">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Bericht" name="Bericht"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default" type="submit" name="verstuur" value="verstuur">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <iframe width="100%" height="450" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ5V02qP_2x0cRW1sToOEGWTw&key=AIzaSyApMHLgYCLkBT1N0ww0-52xlCQRG-eg7Rw"
            allowfullscreen>

    </iframe>

</div>

<?php require_once 'recensie.php';?>


<?php require_once 'includes/footer.php';?>