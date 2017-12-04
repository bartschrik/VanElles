<div class="content">
    <?php
    include_once('includes/header.php');

    $page = new Page();
    $moduleContent = $page->getModule();

    if(!isset($_POST['savePage'])) {
        $dbPage = $page->getPageById($_GET['bewerkid']);

        $_POST['titel'] = $dbPage['title'];
        $_POST['subtitel'] = $dbPage['subtitle'];
        $_POST['inhoud'] = $dbPage['inhoud'];
        $_POST['module'] = $dbPage['Module_id'];
        $_POST['actief'] = $dbPage['active'];
        $_POST['seoinhoud'] = $dbPage['description'];
        $_POST['seokernwoorden'] = $dbPage['kernwoorden'];
    }

    $msg = '';
    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Pagina <span></span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Pagina's toevoegen</span>
                </div>
                <div class="row">
                    <?php
                    $errors = [];

                    if(isset($_POST['savePage'])) {

                        $val = new Validate([
                            ['titel', $_POST['titel'], 'required'],
                            ['seokernwoorden', $_POST['seokernwoorden'], 'required'],
                            ['seoinhoud', $_POST['seoinhoud'], 'required|min:2']
                        ]);

                        if ($val->isPassed()) {
                            $savePage = $page->updatePage($_POST, $_GET['bewerkid']);
                            if (!$savePage) {
                                echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze serve, probeer het later opnieuw.</p></div></div></div>';
                            } else {
                                echo '<div class="feedback success container"><div class="row"><div class="col-xs-12"><p>Uw wijzigingen zijn succesvol doorgevoerd.</p></div></div></div>';
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
                    }

                    echo '<form action="#" method="post" class="classicform">
                                <div class="col-md-8">
                                    <input type="text" name="titel" placeholder="Titel" value="' . InputValue('titel') . '" class="' . InputErrorClass('titel', $errors) . '" />
                                    <input type="text" name="subtitel" placeholder="Sub Titel" value="' . InputValue('subtitel') . '" />
                                    <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                    <script>
                                        CKEDITOR.replace( "inhoud" );
                                    </script>
                                    <span>Module:</span>';


                    if( $moduleContent == 1 ) {
                        echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er zijn nog geen modules aangemaakt</p></div></div></div>';
                    } elseif($moduleContent == 2) {
                        echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met het ophalen van de gegevens</p></div></div></div>';
                    } else {
                        echo '<select name="module" id="selectmodule">';
                        foreach($moduleContent as $value) {

                            if($value['id'] == InputValue('module')) {
                                $id = $value['id'];
                                $naam = $value['naam'];

                                echo '<option selected value="'.$id.'">'.$naam.'</option>';
                            } else {
                                $id = $value['id'];
                                $naam = $value['naam'];

                                echo '<option value="'.$id.'">'.$naam.'</option>';
                            }

                        }
                        echo '</select>';
                    }

                    if(InputValue('actief') == 0) {
                        $options = '<option value="1">ja</option>
                                        <option selected value="0">nee</option>';
                    } else {
                        $options = '<option selected value="1">ja</option>
                                        <option value="0">nee</option>';
                    }

                    echo '<span>Actief:</span>
                                    <select name="actief">
                                        '.$options.'
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h4>SEO-Informatie</h4>
                                    <input type="text" name="seokernwoorden" class="' . InputErrorClass('seokernwoorden', $errors) . '" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                    <textarea name="seoinhoud" class="' . InputErrorClass('seoinhoud', $errors) . '" placeholder="Website beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seoinhoud') . '</textarea>
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
                                        <button type="submit" name="savePage" class="save">Opslaan</button>
                                        <a href="dashboard.php" title="Anuleren" class="annuleer">Anuleren</a>
                                    </div>
                                </div>
                            </form>';

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>