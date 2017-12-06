<div class='content'>
    <?php
    require_once 'includes/header.php';
    if(isset($_POST['post'])) {
        require_once 'classes/connection.class.php';
        $db = new Connection();
        $db = $db->databaseConnection();

        $allow = array("jpg", "jpeg", "gif", "png");

        $todir = '../images/blog/';

        if (!empty($_FILES['file']['error'])) {
            echo "Selecteer een afbeelding a.u.b.<br>";
            header("refresh:2;url=blog_up.php");
            exit;
        } else {
            if (!!$_FILES['file']['tmp_name']) {
                $temp = explode(".", $_FILES["file"]["name"]);
                $date = new DateTime();
                $date = $date->format('Y-m-d H:i:s');
                $hash1 = sha1($date);
                $newfilename = $hash1 . '.' . end($temp);
                $img_name = $newfilename;

                if (in_array(end($temp), $allow)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $todir . $newfilename)) {
                    }
                } else {
                    echo "De extentie is niet toegestaan, toegestaan is: (.jpg/.jpeg/.png/.gif.)<br />";
                    header("refresh:2;url=blog_up.php");
                    exit;
                }
                $title = $_POST["titel"];
                $inhoud = $_POST["inhoud"];
                $subtitel = $_POST["subtitel"];
                $activiteit = $_POST["activiteit"];
                $inschrijven = $_POST["inschrijven"];
                $beschrijving = $_POST["beschrijving"];
                $kernwoorden = $_POST["kernwoorden"];
                $userid = $user->getUser()['user_id'];
                $sql1 = "INSERT INTO blog (title, inhoud, subtitle, img_name, user_id, activiteit, inschrijving, beschrijving, kernwoorden) VALUES ('$title', '$inhoud', '$subtitel', '$img_name', '$userid', '$activiteit', '$inschrijven', '$beschrijving', '$kernwoorden')";
                $smt1 = $db->prepare($sql1);

                if ($title == "" || $inhoud == "" || $subtitel = "" || $beschrijving = "" || $kernwoorden = "") {
                    echo "Maak de post a.u.b compleet!";
                    header("refresh:2;url=blog_up.php");
                    exit;
                } else {
                    if ($smt1->execute()) {
                        echo "succes";
                    } else {
                        print_r($smt1->errorinfo());
                    }
                }
            }
        }
    }
?>


    <div class='pagetitel marbot'>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-12'>Pagina <span></span></div>
            </div>
        </div>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12 inhoud'>
                <div class='titel'>
                    <i class='fa fa-cog'></i><span>Blog Posten</span>
                </div>
                <div class='row'>
                    <form action='blog_up.php' method='post' class="classicform" enctype='multipart/form-data'>
                        <div class='col-md-8'>
                            <input type='text' name='titel' placeholder='Titel'/>
                            <input type='text' name='subtitel' placeholder='Sub Titel'/>
                            <textarea name='inhoud' placeholder='Inhoud'></textarea>
                            <input type='text' name='beschrijving' placeholder='Beschrijving'/>
                            <input type='text' name='kernwoorden' placeholder='Kernwoorden'/>
                            <script>
                                CKEDITOR.replace( 'inhoud' );
                            </script>
                            <span>Activiteit:</span>
                            <select name='activiteit' id='selectmodule'>
                                <option value='0'>Nee</option>
                                <option value='1'>Ja</option>
                            </select>
                            <span>Inschrijven:</span>
                            <select name='inschrijven' id='selectmodule'>
                                <option value='0'>Nee</option>
                                <option value='1'>Ja</option>
                            </select>
                            <span>Actief:</span>
                            <select name='actief'>
                                <option value='0'>Nee</option>
                                <option value='1'>Ja</option>
                            </select>
                        </div>
                        <div class='col-md-4'>
                            <p><label for='file'>Afbeelding:</label>
                                <input type='file' name='file' id='file'></p>
                        </div>
                        <div class='row'>
                            <div class='col-xs-12' id='precol'>
                                <div id='preloader1'>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-xs-12'>
                                <button type="submit" name="post" class="save">Opslaan</button>
                                <a href='paginaoverzicht.php' title='Annuleren' class='annuleer'>Anuleren</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</body>
</html>