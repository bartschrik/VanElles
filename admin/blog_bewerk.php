<html>
<head>
</head>
<?php
    require_once 'classes/connection.class.php';
    $db = new Connection();
    $db = $db->databaseConnection();

    if(!isset($_GET['pid'])){
        header("Location: ../blog.php");
    }

    $pid = $_GET['pid'];

    if(isset($_POST['update'])) {
        $title = strip_tags($_POST['titel']);
        $inhoud = strip_tags($_POST['inhoud']);
        $sub = strip_tags($_POST['subtitel']);
        $bes = strip_tags($_POST['beschrijving']);
        $kern = strip_tags($_POST['kernwoorden']);

        $allow = array("jpg", "jpeg", "gif", "png");

        $todir = '../images/blog/';

        $img_name = $_FILES["file"]["name"];

        if (!!$_FILES['file']['tmp_name']) {
            $info = explode('.', strtolower($_FILES['file']['name']));

            if (in_array(end($info), $allow))
            {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $todir .  $_FILES["file"]["name"])) {
                }
            }
            else
            {
                echo "De extentie is niet toegestaan, toegestaan is: (.jpg/.jpeg/.png/.gif.)<br />";
                header("refresh:3;url=../blog.php");
            }
        }

        $sql1 = "UPDATE blog SET title='$title', inhoud='$inhoud', img_name='$img_name', subtitle='$sub', beschrijving='$bes', kernwoorden='$kern' WHERE blog_id='$pid'";
        $sql2 = "UPDATE blog SET title='$title', inhoud='$inhoud', subtitle='$sub', beschrijving='$bes', kernwoorden='$kern' WHERE blog_id='$pid'";

        $smt1 = $db->prepare($sql1);
        $smt2 = $db->prepare($sql2);

        if ($title == "" || $inhoud == "") {
            echo "Maak de post a.u.b compleet!";
            exit;
        }
        if (!!$_FILES['file']['tmp_name']) {
            $smt1->execute();
            if($smt1->execute()){
                header("Location: ../blog.php");
            } else {
                print_r($smt1->errorinfo());
            }
        } else {
            $smt2->execute();
            if($smt2->execute()){
                header("Location: ../blog.php");
            } else {
                print_r($smt2->errorinfo());
            }
        }
    }
?>
<body>
<?php
$sql_get = "SELECT * FROM blog";
$res = mysqli_query($db, $sql_get);
$db = mysqli_connect("localhost", "root", "", "vanelles");

    if(!mysqli_num_rows($res) > 0) {
        echo "geen posts gevonden";
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            $title = $row['title'];
            $sub = $row['subtitle'];
            $inhoud = $row['inhoud'];
            $bes = $row['beschrijving'];
            $kern = $row['kernwoorden'];
            $img_name = $row['img_name'];
            $image = "<img height='250' width='250' src='../images/blog/$img_name'>";

            echo("<div class='content'>
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
                            <i class='fa fa-cog'></i><span>Blog Bewerken</span>
                        </div>
                        <div class='row'>
                            <form action='blog_bewerk.php?pid=$pid' method='post' enctype='multipart/form-data'>
                                <div class='col-md-8'>
                                    <input type='text' name='titel' placeholder='Titel' value='$title' />
                                    <input type='text' name='subtitel' placeholder='Sub Titel' value='$sub'/>
                                    <textarea name='inhoud' placeholder='Inhoud'>$inhoud</textarea>
                                    <input type='text' name='beschrijving' placeholder='Beschrijving' value='$bes'/>
                                    <input type='text' name='kernwoorden' placeholder='Kernwoorden' value='$kern'/>
                                    <script>
                                        CKEDITOR.replace( 'inhoud' );
                                    </script>
                                    <span>Module:</span>
                                    <select name='module' id='selectmodule'>
                                        <option value='1'>test1</option>
                                        <option value='2'>test2</option>
                                        <option value='3'>test3</option>
                                    </select>
                                    <span>Aktief:</span>
                                    <select name='aktief'>
                                        <option value='1'>Ja</option>
                                        <option value='2'>Nee</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <p><label for='file'>Afbeelding:</label>
                                    <input type='file' name='file' id='file'></p>$image
                                    <p>Huidig bestand: $img_name</p>
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
                                        <a href='paginaoverzicht.php' title='Annuleren' class='annuleer'>Anuleren</a>
                                    </div>
                                    <input name='update' type='submit' value='Bijwerken'>;
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>");
        }
    }
?>
</body>
</html>