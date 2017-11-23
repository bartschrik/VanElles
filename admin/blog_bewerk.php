<?php
include_once('includes/header.php');
?>
<div class="content">
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
                    <i class="fa fa-cog"></i><span>Pagina Bewerken</span>
                </div>
                <div class="row">
                    <form action="#" method="post" class="classicform">
                        <div class="col-md-8">
                            <input type="text" name="titel" placeholder="Titel" value="" class="' . InputErrorClass('titel', $savePage['ErrorCon']) . '" />
                            <input type="text" name="subtitel" placeholder="Sub Titel" value="" />
                            <textarea name="inhoud" placeholder="Inhoud" value=""></textarea>
                            <script>
                                CKEDITOR.replace( "inhoud" );
                            </script>
                            <input type="text" name="studentlink" id="studentlink" placeholder="Studenten link" value="' . InputValue('studentlink') . '" />
                            <span>Module:</span>
                            <select name="module" id="selectmodule">
                                <option value="1">test1</option>
                                <option value="1">test2</option>
                                <option value="1">test3</option>
                            </select>
                            <span>Aktief:</span>
                            <select name="aktief">
                                <option value="1">Ja</option>
                                <option value="2">Nee</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <!--Afbeelding uploader oid-->
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
                                <a href="paginaoverzicht.php" title="Anuleren" class="annuleer">Anuleren</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>