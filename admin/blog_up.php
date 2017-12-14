<div class="content">
    <?php
    include_once('includes/header.php');

    $blog = new blog();

    $msg = '';
    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Blog<span></span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Blog toevoegen</span>
                </div>
                <div class="row">
                    <?php
                    if (isset($_POST['saveblog'])) {

                        $errors = [];

                        $val = new Validate([
                            ['titel', $_POST['titel'], 'required'],
                            ['subtitel', $_POST['subtitel'], 'required'],
                            ['inhoud', $_POST['inhoud'], 'required'],
                            ['maxdeeln', $_POST['maxdeeln'], 'required|min:1'],
                            ['seokernwoorden', $_POST['seokernwoorden'], 'required'],
                            ['seobeschrijving', $_POST['seobeschrijving'], 'required|min:2']
                        ]);

                        if ($val->isPassed()) {
                            $saveblog = $blog->saveblog($_POST, $_FILES['plaatje'], $user->getUser()['user_id']);
                            if (!$saveblog) {
                                echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze server, probeer het later opnieuw.</p></div></div></div>';
                            } else {
                                die(header('Location: blog_admin.php'));
                            } } else {
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
                                        <input type="text" name="titel" placeholder="Blog titel" value="' . InputValue('titel') . '" />
                                        <input type="text" name="subtitel" placeholder="Blog sub titel" value="' . InputValue('subtitel') . '" />  
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                        <input type="file" name="plaatje" placeholder="Plaatje" value="' . InputValue('plaatje') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script> 
                                          <span>Activiteit:</span>
                                        <select name="activiteit" id="selectmodule">
                                            <option value="0">Nee</option>
                                            <option value="1">Ja</option>
                                        </select>
                                        
                                        <span>Inschrijven:</span>
                                        <select name="inschrijven" id="selectmodule">
                                            <option value="0">Nee</option>
                                            <option value="1">Ja</option>
                                        </select>
                                        Max. deelnemers: <input id="nrsel" type="number" min="0" name="maxdeeln" value="0" value="' . InputValue('maxdeeln') . '" /> 
                                    </div>
                                    <div class="col-md-4">
                                        <h4>SEO-Informatie</h4>
                                        <input type="text" name="seokernwoorden" class="' . InputErrorClass('seokernwoorden', $errors) . '" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                        <textarea name="seobeschrijving" class="' . InputErrorClass('seobeschrijving', $errors) . '" placeholder="Blog beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seobeschrijving') . '</textarea>
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
                                            <button type="submit" name="saveblog" class="save">Opslaan</button>
                                            <a href="../blog" title="Annuleren" class="annuleer">Annuleren</a>
                                        </div>
                                    </div>
                                </form>';

                        /*ELSE*/
                    } else {
                        echo '<form action="#" method="post" class="classicform" enctype="multipart/form-data">
                                    <div class="col-md-8">
                                        <input type="text" name="titel" placeholder="Blog titel" value="' . InputValue('titel') . '" />
                                        <input type="text" name="subtitel" placeholder="Blog sub titel" value="' . InputValue('subtitel') . '" />  
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                        <input type="file" name="plaatje" placeholder="Plaatje" value="' . InputValue('plaatje') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script>
                                        <span>Activiteit:</span>
                                        <select name="activiteit" id="selectmodule">
                                            <option value="0">Nee</option>
                                            <option value="1">Ja</option>
                                        </select>
                                        <span>Inschrijven:</span>
                                        <select name="inschrijven" id="selectmodule">
                                            <option value="0">Nee</option>
                                            <option value="1">Ja</option>
                                        </select>    
                                        Max. deelnemers: <input id="nrsel" type="number" min="0" name="maxdeeln" value="0" value="' . InputValue('maxdeeln') . '" /> 
                                    </div>    
                                    <div class="col-md-4">
                                        <h4>SEO-Informatie</h4>
                                        <input type="text" name="seokernwoorden" placeholder="Kernwoorden, bijv: vanelles, woonwinkel ect." value="' . InputValue('seokernwoorden') . '" />
                                        <textarea name="seobeschrijving"  placeholder="Blog beschrijving" style="max-width: 100%; height: 200px;">' . InputValue('seobeschrijving') . '</textarea>
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
                                            <button type="submit" name="saveblog" class="save">Opslaan</button>
                                            <a href="../blog" title="Annuleren" class="annuleer">Annuleren</a>
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