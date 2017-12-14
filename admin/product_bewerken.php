<div class="content">
    <?php
    include_once('includes/header.php');

    $producten = new product();
    $leverancierContent = $producten->getLev();

    if(!isset($_POST['saveproduct'])) {
        $dblev = $producten->getProductById($_GET['bewerkid']);

        $_POST['naam'] = $dblev['naam'];
        $_POST['inhoud'] = $dblev['inhoud'];
        $_POST['korteinhoud'] = $dblev['korte_inhoud'];
        $_FILES['logo'] = $dblev['images'];
        $_POST['url'] = $dblev['webshop_url'];
        $_POST['leverancier'] = $dblev['lev_id'];
        $_POST['seoinhoud'] = $dblev['description'];
        $_POST['seokernwoorden'] = $dblev['kernwoorden'];
    }
    $msg = '';
    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Producten bewerken <span></span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Producten bewerken</span>
                </div>
                <div class="row">
                    <?php
                    if (isset($_POST['saveproduct'])) {

                        $errors = [];

                        $val = new Validate([
                            ['naam', $_POST['naam'], 'required'],
                            ['inhoud', $_POST['inhoud'], 'required'],
                            ['korteinhoud', $_POST['korteinhoud'], 'required'],
                            ['foto', $_FILES['foto'], 'validphoto'],
                            // ['leverancier', $_POST['Leverancier'], 'required'],
                            ['seokernwoorden', $_POST['seokernwoorden'], 'required'],
                            ['seoinhoud', $_POST['seoinhoud'], 'required|min:2'],
                        ]);


                        if ($val->isPassed()) {
                            $saveproduct = $producten->updateProduct($_POST, $_FILES['foto'], $_GET['bewerkid']);
                            if (!$saveproduct) {
                                echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze server, probeer het later opnieuw.</p></div></div></div>';

                            } else {
                                die(header('Location: product_overzicht.php'));

                            }
                        } else {
                            $errors = $val->getErrors();
                            $errorList = '';
                            foreach ($errors as $errorcat) {
                                foreach ($errorcat as $error) {
                                    $errorList .= "<li>$error</li>";
                                }
                            }
                            echo '<div class="feedback error container"><div class="col-xs-12"><ul style="padding: 0;">' . $errorList . '</ul></div></div>';
                        }

                        echo '<form action="#" method="post" class="classicform" enctype="multipart/form-data">
                                    <div class="col-md-8">
                                        <input type="text" name="naam" class="' . InputErrorClass('naam', $errors) . '" placeholder="Product naam" value="' . InputValue('naam') . '" /> 
                                        <textarea name="inhoud" class="' . InputErrorClass('inhoud', $errors) . '" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                        <textarea name="korteinhoud" maxlength="250" class="' . InputErrorClass('korteinhoud', $errors) . '" style="height: 75px;"  placeholder="Korte inhoud" >' . InputValue('korteinhoud') . '</textarea>
                                        <input type="file" name="foto" class="' . InputErrorClass('foto', $errors) . '" placeholder="foto" value="' . InputValue('foto') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script>';



                        echo '</div>
                                    
                                    <div class="col-md-4">  
                                        <h4>Product verbinden</h4>';

                                        if( $leverancierContent == 1 ) {
                                            echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er zijn nog geen leveranciers aangemaakt</p></div></div></div>';
                                        } elseif($leverancierContent == 2) {
                                            echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met het ophalen van de gegevens</p></div></div></div>';
                                        } else {
                                            echo '<select name="leverancier" id="selectleverancier">';
                                            echo '<option value="0" selected="true" disabled="disabled">Kies leverancier</option> ';
                                            foreach($leverancierContent as $value) {

                                                if($value['lev_id'] == InputValue('leverancier')) {
                                                    $id = $value['lev_id'];
                                                    $naam = $value['naam'];
                                                    echo '<option selected value="'.$id.'">'.$naam.'</option>';
                                                } else {
                                                    $id = $value['lev_id'];
                                                    $naam = $value['naam'];

                                                    echo '<option value="'.$id.'">'.$naam.'</option>';
                                                }

                                            }
                                            echo '</select>';
                                        }

                                  echo '<input type="text" name="url" class="' . InputErrorClass('url', $errors) . '" placeholder="Link naar product" value="' . InputValue('url') . '" />

                                        <h4>SEO-Informatie</h4>
                                        <input type="text" name="seokernwoorden" class="' . InputErrorClass('seokernwoorden', $errors) . '" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                        <textarea name="seoinhoud" class="' . InputErrorClass('seoinhoud', $errors) . '" placeholder="Product beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seoinhoud') . '</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" id="precol">
                                            <div id="preloader1">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="submit" name="saveproduct" class="save">Opslaan</button>
                                            <a href="product_overzicht.php" title="Anuleren" class="annuleer">Annuleren</a>
                                        </div>
                                    </div>
                                </form>';

                        /*ELSE*/
                    } else {
                        echo '<form action="#" method="post" class="classicform" enctype="multipart/form-data">
                                    <div class="col-md-8">
                                        <input type="text" name="naam" placeholder="Product naam" value="' . InputValue('naam') . '" /> 
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                        <textarea name="korteinhoud" maxlength="250" style="height: 75px;"  placeholder="Korte inhoud" >' . InputValue('korteinhoud') . '</textarea>
                                        <input type="file" name="foto" placeholder="foto" value="' . InputValue('foto') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script>';


                        echo '</div>
                                    
                                    <div class="col-md-4">
                                    <h4>Product verbinden</h4>';

                                    if( $leverancierContent == 1 ) {
                                        echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er zijn nog geen leveranciers aangemaakt</p></div></div></div>';
                                    } elseif($leverancierContent == 2) {
                                        echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met het ophalen van de gegevens</p></div></div></div>';
                                    } else {
                                        echo '<select name="leverancier" id="selectleverancier">';
                                        echo '<option value="0" selected="true" disabled="disabled">Kies leverancier</option> ';
                                        foreach($leverancierContent as $value) {

                                            if($value['lev_id'] == InputValue('leverancier')) {
                                                $id = $value['lev_id'];
                                                $naam = $value['naam'];

                                                echo '<option selected value="'.$id.'">'.$naam.'</option>';
                                            } else {
                                                $id = $value['lev_id'];
                                                $naam = $value['naam'];

                                                echo '<option value="'.$id.'">'.$naam.'</option>';
                                            }

                                        }
                                        echo '</select>';
                                    }

                                  echo '<input type="text" name="url"  placeholder="Link naar product" value="' . InputValue('url') . '" />
                                        
                                        <h4>SEO-Informatie</h4>
                                        <input type="text" name="seokernwoorden" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                        <textarea name="seoinhoud"  placeholder="Product beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seoinhoud') . '</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" id="precol">
                                            <div id="preloader1">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="submit" name="saveproduct" class="save">Opslaan</button>
                                            <a href="product_overzicht.php" title="Anuleren" class="annuleer">Annuleren</a>
                                        </div>
                                    </div>
                                </form>';
                    }



                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>