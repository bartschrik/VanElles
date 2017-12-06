<?php
//Include de connection en de page class
include_once('admin/classes/connection.class.php');
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

    $dir = 'images/blog/';

    $query1 = $db->prepare('SELECT * FROM blog ORDER BY blog_id DESC');

    $query1->execute();

        $row = $query1->fetch(PDO::FETCH_ASSOC);
        $id = $row['blog_id'];
        $img_name = $row['img_name'];
        $title = $row['title'];
        $subtitel = $row["subtitle"];
        $inhoud = $row["inhoud"];
        $beschrijving = $row["beschrijving"];
        $kernwoorden = $row["kernwoorden"];

echo "<form>
            <p>$title</p>
            <p>$subtitel</p>
            <p><img height='250' width='250' src='$dir/$img_name'></p>
            <p>$inhoud</p>
            <p>$beschrijving</p>
            <p>$kernwoorden</p>
            <a href='blog_det.php' title='Details'>Details</a>
            </form>";
?>
<?php
    // lege variabelen aanmaken
    $cursus = $voornaam = $achternaam = $geboortedatum = $telefoonnr = $email = "";
    //ingevulde data behouden in formulier
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cursus = ($_POST["cursus"]);
        $voornaam = ($_POST["voornaam"]);
        $achternaam = ($_POST["achternaam"]);
        $geboortedatum = ($_POST["geboortedatum"]);
        $telefoonnr = ($_POST["telefoonnummer"]);
        $email = ($_POST["emailadres"]);
    }
    ob_start();

    if($inschrijven = 1) {
        echo "<div class='container'>
            <div class='header text-center'>
                <h1>Inschrijven</h1>
            </div class='header text-center'>
        
        <form method='post' action='blog_det.php'>
        
            <div class='form-group'>
                <label for='cursus'>Cursus</label>
                <input class='form-control' type='text' name='cursus' placeholder='Cursus' required value='$cursus'/>
            </div>
        
            <div class='form-group'>
                <label for='voornaam'>Voornaam</label>
                <input class='form-control' type='text' name='voornaam' placeholder='Robin' required value='$voornaam'/>
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

    if (isset($_POST["verstuur"])) {
        if (empty($_POST["cursus"]) || empty($_POST["voornaam"]) || empty($_POST["achternaam"]) || empty($_POST["geboortedatum"]) || empty($_POST["telefoonnummer"]) || empty($_POST["emailadres"])) {
            print("Alle velden moeten ingevuld zijn");
        } else {
            $sql1 = "INSERT INTO user (first_name, last_name, phonenumber, email) VALUES ('$voornaam', '$achternaam', '$geboortedatum', '$telefoonnr', '$email')";
            $smt1 = $db->prepare($sql1);
            $smt1->execute();
            header("location: blog_det.php");
            ob_end_flush();
            die();
        }
    }
require_once 'includes/footer.php';
?>
</body>
</html>