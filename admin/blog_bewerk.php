<div class="content">
    <?php
    include_once('includes/header.php');

    $blog = new blog();

    if(!isset($_POST['saveblog'])) {
        $dbblog = $blog->getBlogById($_GET['bewerkid']);

        $_POST['titel'] = $dbblog['title'];
        $_POST['subtitel'] = $dbblog['subtitle'];
        $_POST['inhoud'] = $dbblog['inhoud'];
        $_POST['korte_inhoud'] = $dbblog['korte_inhoud'];
        $_POST['seobeschrijving'] = $dbblog['beschrijving'];
        $_POST['seokernwoorden'] = $dbblog['kernwoorden'];
        $_POST['plaatje'] = $dbblog['img_name'];
        $_POST['activiteit'] = $dbblog['activiteit'];
        $_POST['inschrijven'] = $dbblog['inschrijving'];
    }

    $msg = '';
    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Blogs bewerken <span></span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Blogs bewerken</span>
                </div>
                <div class="row">
                    <?php
                    if (isset($_POST['saveblog'])) {

                        $errors = [];

                        $val = new Validate([
                            ['titel', $_POST['titel'], 'required'],
                            ['subtitel', $_POST['subtitel'], 'required'],
                            ['inhoud', $_POST['inhoud'], 'required'],
                            ['korte_inhoud', $_POST['korte_inhoud'], 'required'],
                            ['afbeelding', $_FILES['afbeelding'], 'imgrequired|validphoto'],
                            ['seokernwoorden', $_POST['seokernwoorden'], 'required'],
                            ['seobeschrijving', $_POST['seobeschrijving'], 'required|min:2']
                        ]);


                        if ($val->isPassed()) {
                            $saveblog = $blog->updateBlog($_POST, $_FILES['afbeelding'], $_GET['bewerkid']);
                            if (!$saveblog) {
                                echo '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze server, probeer het later opnieuw.</p></div></div></div>';
                            } else {
                                die(header('Location: blog_admin.php'));
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
                                        <input type="text" name="titel" class="' . InputErrorClass('titel', $errors) . '" placeholder="Blog titel" value="' . InputValue('titel') . '" />
                                        <input type="text" name="subtitel" class="' . InputErrorClass('subtitel', $errors) . '" placeholder="Blog sub titel" value="' . InputValue('subtitel') . '" />  
                                        <textarea name="inhoud" placeholder="Inhoud">' . InputValue('inhoud') . '</textarea>
                                        <input type="text" name="korte_inhoud" class="' . InputErrorClass('korte_inhoud', $errors) . '" placeholder="Korte inhoud" value="' . InputValue('korte_inhoud') . '" />  
                                        <input type="file" name="afbeelding" class="' . InputErrorClass('afbeelding', $errors) . '" placeholder="Afbeelding" value="' . InputValue('afbeelding') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script> 
                                    </div>
                                    <div class="col-md-4">
                                    <table style="width: 100%">
                                     <tr>
                                         <td>Activiteit</td> 
                                         <td>Inschrijven</td>
                                         <td>Max. deelnemers</td>
                                     </tr><tr>
                                    <td><select name="activiteit" onchange="this.form.submit();">
                                    <option value="0" '; if(isset($_POST["activiteit"])) {
                            $kies = ($_POST["activiteit"]);
                            if ($kies == '0') {
                                echo "selected";
                            }
                        }echo'>Nee</option>
                                    <option value="1" '; if(isset($_POST["activiteit"])) {
                            $kies = ($_POST["activiteit"]);
                            if ($kies == '1') {
                                echo "selected";
                            }
                        }echo'>Ja</option>
                                        </select></td>
                                        <td><select name="inschrijven" id="selectmodule">
                                            <option value="0">Nee</option>
                                            <option value="1">Ja</option>
                                        </select></td>
                                        <td><input id="nrsel" type="number" min="0" name="maxdeeln" value="0" value="' . InputValue('maxdeeln') . '" /><br>
                                        </td></tr></table>';
                        if(isset($_POST['activiteit'])) {
                            if ($_POST['activiteit'] == "1") {
                                echo '
                                      <span>Activiteit Datum</span>
                                      <div class="form-group" >
                                      <input name = "actidatum" id = "datetime"  value="' . InputValue('actidatum') . '">
                                      </div >';
                            }
                        }
                        echo'
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
                                             <a href="blog_admin.php" title="Annuleren" class="annuleer">Annuleren</a>
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
                                        <input type="text" name="korte_inhoud" placeholder="Korte inhoud" value="' . InputValue('korte_inhoud') . '" />  
                                        <input type="file" name="afbeelding" placeholder="Afbeelding" value="' . InputValue('afbeelding') . '" />
                                        <script>
                                            CKEDITOR.replace( "inhoud" );
                                        </script>
                                    </div>    
                                    <div class="col-md-4">
                                     <table style="width: 100%">
                                     <tr>
                                         <td>Activiteit</td> 
                                         <td>Inschrijven</td>
                                         <td>Max. deelnemers</td>
                                     </tr><tr>
                                    <td><select name="activiteit" onchange="this.form.submit();">
                                    <option value="0" '; if(isset($_POST["activiteit"])) {
                            $kies = ($_POST["activiteit"]);
                            if ($kies == '0') {
                                echo "selected";
                            }
                        }echo'>Nee</option>
                                    <option value="1" '; if(isset($_POST["activiteit"])) {
                            $kies = ($_POST["activiteit"]);
                            if ($kies == '1') {
                                echo "selected";
                            }
                        }echo'>Ja</option>
                                        </select></td>
                                        <td>
                                        <select name="inschrijven" id="selectmodule">
                                            <option value="0">Nee</option>
                                            <option value="1">Ja</option>
                                        </select>
                                        </td>
                                        <td>
                                        <input id="nrsel" type="number" min="0" name="maxdeeln" value="0" value="' . InputValue('maxdeeln') . '" />
                                        </td></tr></table>';
                        if(isset($_POST['activiteit'])) {
                            if ($_POST['activiteit'] == "1") {
                                echo '
                                      <span>Activiteit Datum</span>
                                      <div class="form-group" >
                                      <input name = "actidatum" id = "datetime" value="' . InputValue('actidatum') . '">
                                      </div >';
                            }
                        }
                        echo'
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
                                            <a href="blog_admin.php" title="Annuleren" class="annuleer">Annuleren</a>
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
<script src="../js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script>
    $("#datetime").datetimepicker({
        step: 30
    });
</script>
</html>