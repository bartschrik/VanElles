<div class="content">
    <?php
    include_once('includes/header.php');

    $leverancier = new leverancier();

    if(!isset($_POST['savelev'])) {
        $dblev = $leverancier->getLeverancierById($_GET['bewerkid']);

        $_POST['naam'] = $dblev['naam'];
        $_POST['inhoud'] = $dblev['inhoud'];
        $_POST["korteinhoud"] = $dblev['korte_inhoud'];
        $_FILES['logo'] = $dblev['logo'];
        $_POST['seoinhoud'] = $dblev['description'];
        $_POST['seokernwoorden'] = $dblev['kernwoorden'];
    }

    $msg = '';
    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Leveranciers bewerken <span></span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Leveranciers bewerken</span>
                </div>
                <div class="row">
                    <?php
                    if (isset($_POST['savelev'])) {

                        $errors = [];

                        $val = new Validate([
                            ['naam', $_POST['naam'], 'required'],
                            ['inhoud', $_POST['inhoud'], 'required'],
                            ['korteinhoud', $_POST['korteinhoud'], 'required'],
                            ['seokernwoorden', $_POST['seokernwoorden'], 'required'],
                            ['seoinhoud', $_POST['seoinhoud'], 'required|min:2']
                        ]);


                        if ($val->isPassed()) {
                            $savelev = $leverancier->updateLev($_POST, $_FILES['logo'], $_GET['bewerkid']);
                            if (!$savelev) {
                                echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze server, probeer het later opnieuw.</p></div></div></div>';
                            } else {
                                die(header('Location: leverancier_overzicht.php'));
                                /*var_dump($_FILES['logo']);*/
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
                                        <input type="text" name="naam" class="' . InputErrorClass('naam', $errors) . '" placeholder="Leverancier naam" value="' . InputValue('naam') . '" /> 
                                        <textarea name="inhoud" class="' . InputErrorClass('inhoud', $errors) . '" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                        <textarea name="korteinhoud" maxlength="250" style="height: 75px;" class="' . InputErrorClass('korteinhoud', $errors) . '" placeholder="Korte inhoud">' . InputValue('korteinhoud') . '</textarea>
                                        <input type="file" name="logo"  placeholder="Logo" value="' . InputValue('naam') . '" />
                                       
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script>    
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4>SEO-Informatie</h4>
                                        <input type="text" name="seokernwoorden" class="' . InputErrorClass('seokernwoorden', $errors) . '" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                        <textarea name="seoinhoud" class="' . InputErrorClass('seoinhoud', $errors) . '" placeholder="Leverancier beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seoinhoud') . '</textarea>
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
                                            <button type="submit" name="savelev" class="save">Opslaan</button>
                                            <a href="leverancier_overzicht.php" title="Anuleren" class="annuleer">Annuleren</a>
                                        </div>
                                    </div>
                                </form>';

                        /*ELSE*/
                    } else {
                        echo '<form action="#" method="post" class="classicform" enctype="multipart/form-data">
                                    <div class="col-md-8">
                                        <input type="text" name="naam" placeholder="Leveranciers naam" value="' . InputValue('naam') . '" /> 
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                         <textarea name="korteinhoud" maxlength="250" style="height: 75px;" placeholder="Korte inhoud">' . InputValue('korteinhoud') . '</textarea>
                                        <input type="file" name="logo" placeholder="Logo" value="' . InputValue('naam') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script>    
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4>SEO-Informatie</h4>
                                        <input type="text" name="seokernwoorden" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                        <textarea name="seoinhoud"  placeholder="Leverancier beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seoinhoud') . '</textarea>
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
                                            <button type="submit" name="savelev" class="save">Opslaan</button>
                                            <a href="leverancier_overzicht.php" title="Anuleren" class="annuleer">Annuleren</a>
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