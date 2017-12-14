<div class="container">
    <div class="row">
        <div class="martop marbot">
            <div class="ptitle">
                <h1>Blog</h1>
            </div>
<?php
//Include de connection en de page class
include_once('admin/classes/connection.class.php');
include_once('admin/classes/blog.class.php');
include_once('admin/classes/page.class.php');

$page = new Page();

$pageContent = [
    "pagetitle"     => "",
    "title"         => "",
    "subtitle"      => "",
    "inhoud"        => "",
    "description"   => "",
    "kernwoorden"   => "",
    "path"          => ""
];

include_once('includes/header.php');

$db = new Connection();
$db = $db->databaseConnection();

if(!isset($_GET['pid'])){
    header("Location: blog");
}

$msg = "";
$blog = new blog();

$pid = $_GET['pid'];

    $dir = 'admin/images/blog/';

    $query1 = $db->prepare("SELECT * FROM blog WHERE blog_id = '$pid' ORDER BY blog_id DESC");

    $query1->execute();

        $row = $query1->fetch(PDO::FETCH_ASSOC);
        $id = $row['blog_id'];
        $img_name = $row['img_name'];
        $title = $row['title'];
        $subtitel = $row["subtitle"];
        $inhoud = $row["inhoud"];
        $beschrijving = $row["beschrijving"];
        $kernwoorden = $row["kernwoorden"];
        $inschrijven = $row["inschrijving"];
        $maxinschrijf = $row["inschrijving_aantal"];
        $deeln = $blog->getDeelnemers($id);

    echo'<div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="ptitle">
                        <h2 id="webtitle">'. $title .'</h2>
                        <h5 id="webtitle">'. $subtitel .'</h5>
                        </div>
                        <p>'. $inhoud .'</p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 marbot">
                        <img src="'.constant("local_url").'admin/images/blog/'.$img_name.'" class="img-responsive">
                    </div>';
?>
        </div>
    </div>
</div>
<?php
    // lege variabelen aanmaken
    $voornaam = $tussenvoegsel = $achternaam = $geboortedatum = $telefoonnr = $email = "";
    //ingevulde data behouden in formulier
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $voornaam = ($_POST["voornaam"]);
        $tussenvoegsel = ($_POST["tussenvoegsel"]);
        $achternaam = ($_POST["achternaam"]);
        $geboortedatum = ($_POST["geboortedatum"]);
        $telefoonnr = ($_POST["telefoonnummer"]);
        $email = ($_POST["emailadres"]);
    }
    ob_start();

    if($inschrijven == 1) {
        if ($deeln >= $maxinschrijf) {
            echo '<div class="header text-center">Helaas zijn er geen plekken meer vrij voor deze activiteit.</div>';
        } else {
            echo "<div class='container'>
            <div class='header text-center'>
                <h1>Inschrijven</h1>
            </div class='header text-center'>
        
        <form method='post' action='$id'>
        
            <div class='form-group'>
                <label for='voornaam'>Voornaam</label>
                <input class='form-control' type='text' name='voornaam' placeholder='Robin' required value='$voornaam'/>
            </div>
        
            <div class='form-group'>
                <label for='tussenvoegsel'>Tussenvoegsel</label>
                <input class='form-control' type='text' name='tussenvoegsel' placeholder='Van' required value='$tussenvoegsel'/>
            </div>
        
            <div class='form-group'>
                <label for='achternaam'>Achternaam</label>
                <input class='form-control' type='text' name='achternaam' placeholder='Dekker' required value='$achternaam'/>
            </div>
        
            <div class='form-group'>
                <label for='geboortedatum'>Geboortedatum</label>
                <input class='form-control' type='date' name='geboortedatum' required value='$geboortedatum'/>
            </div>
        
            <div class='form-group'>
                <label for='telefoonnummer'>Telefoonnummer</label>
                <input class='form-control' type='tel' name='telefoonnummer' placeholder='0612345678' required value='$telefoonnr'/>
            </div>
        
            <div class='form-group'>
                <label for='email'>Emailadres</label>
                <input class='form-control' type='email' name='emailadres' placeholder='naam@voorbeeld.com' required value='$email'/>
            </div>
        
            <br>
            <p><input type='submit' name='verstuur' value='Verstuur' class='btn btn-default'/></p>
        </form>
        </div>";
        }
    }
    $id = $_GET['pid'];

        if (isset($_POST["verstuur"])) {
            if (empty($_POST["voornaam"]) || empty($_POST["achternaam"]) || empty($_POST["geboortedatum"]) || empty($_POST["telefoonnummer"]) || empty($_POST["emailadres"])) {
                print("Alle velden moeten ingevuld zijn");
            } else {
                if ($deeln >= $maxinschrijf) {
                    echo '<div class="header text-center">Helaas zijn er geen plekken meer vrij voor deze activiteit.</div>';
                    echo '<meta http-equiv="refresh" content="2;" />';
                } else {
                    $sql = "INSERT INTO user (first_name, insertion, last_name, email, birthday, phonenumber) VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$geboortedatum', '$telefoonnr')";
                    $stmt = $db->prepare($sql);
                    if ($stmt->execute()) {
                        echo '<div id="blogfoutm">Succesvol ingeschreven!</div>';
                        echo '<meta http-equiv="refresh" content="2;" />';
                    }

                    $last_id = $db->lastInsertId();

                    $sql2 = "INSERT INTO inschrijvingen (blog_id, user_id) VALUES ('$id', '$last_id')";
                    $smt2 = $db->prepare($sql2);
                    if ($smt2->execute()) {

                    } else {
                        echo "Het e-mail adres is al in gebruik.";
                    }
                }
            }
        }
require_once 'includes/footer.php';
?>
</body>
</html>