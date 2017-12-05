<div class="content">
    <?php
    include_once('includes/header.php');

    $page = new Page();
    $moduleContent = $page->getModule();

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
                    <i class="fa fa-cog"></i><span>Leveranciers toevoegen</span>
                </div>
                <div class="row">
                    <?php

                    if(isset($_POST['savePage'])) {

                        $errors = [];

                        $val = new Validate([
                            ['naam', $_POST['naam'],'required'],
                            ['seokernwoorden',$_POST['seokernwoorden'],'required'],
                            ['seoinhoud',$_POST['seoinhoud'],'required|min:2']
                        ]);

                        if($val->isPassed()) {
                            $savePage = $page->savePage($_POST, $user->getUser()['user_id']);
                            if (!$savePage)
                                echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze server, probeer het later opnieuw.</p></div></div></div>';
                            die(header('Location: dashboard.php'));
                        } else {
                            $errors = $val->getErrors();
                            $errorList = '';
                            foreach ($errors as $errorcat) {
                                foreach ($errorcat as $error) {
                                    $errorList .= "<li>$error</li>";
                                }
                            }
                            echo '<div class="feedback error container"><div class="col-xs-12"><ul style="padding: 0;">'.$errorList.'</ul></div></div>';
                        }

                        echo '<form action="#" method="post" class="classicform">
                                    <div class="col-md-8">
                                        <input type="text" name="naam" placeholder="bbbb" value="' . InputValue('naam') . '" /> 
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
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
                                            <button type="submit" name="savePage" class="save">Opslaan</button>
                                            <a href="dashboard.php" title="Anuleren" class="annuleer">Anuleren</a>
                                        </div>
                                    </div>
                                </form>';

                    /*ELSE*/
                    } else {
                        echo '<form action="#" method="post" class="classicform">
                                    <div class="col-md-8">
                                        <input type="text" name="naam" placeholder="Leveranciers naam" value="' . InputValue('naam') . '" /> 
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
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
                                            <button type="submit" name="savePage" class="save">Opslaan</button>
                                            <a href="dashboard.php" title="Anuleren" class="annuleer">Anuleren</a>
                                        </div>
                                    </div>
                                </form>';
                            }

                    require_once 'classes/connection.class.php';
                    $db = new Connection();
                    $db = $db->databaseConnection();


                        ?>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>