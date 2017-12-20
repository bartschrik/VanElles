<?php
$db = new Connection();
$db = $db->databaseConnection();

if($pageId) { echo'
    <div class="container">
        <div class="row">
            <div class="martop">
                <div class="col-xs-12">
                  
                </div>';

                //Include de connection en de page class
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


                if(!isset($_GET['pid'])){
                    die(header("Location: ".constant("local_url")."404"));
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
                $datum = $row["datum"];
                $beschrijving = $row["beschrijving"];
                $kernwoorden = $row["kernwoorden"];
                $inschrijven = $row["inschrijving"];
                $maxinschrijf = $row["inschrijving_aantal"];
                $deeln = $blog->getDeelnemers($id);
                $pageContent['pagetitle'] = $title;
                $pageContent['description'] = $row["beschrijving"];
                $pageContent['kernwoorden'] = $row["kernwoorden"];

                if(!$id == $pid){
                    die(header("Location: ".constant("local_url")."404"));
                }

    echo'<div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="ptitle">
                        <h1>'.$title.'</h1>
                    </div>
                        <p>'. $datum .'</p>
                        <h5 id="webtitle">'. $subtitel .'</h5>
                         <p>'. $inhoud .'</p>
                        </div>
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

    $id = $pageId;

    if (isset($_POST["verstuur"])) {
        if (empty($_POST["voornaam"]) || empty($_POST["achternaam"]) || empty($_POST["geboortedatum"]) || empty($_POST["telefoonnummer"]) || empty($_POST["emailadres"])) {
            print("Alle velden moeten ingevuld zijn");
        } else {
            if ($deeln >= $maxinschrijf) {
                echo '<div class="header text-center martop marbot" style="color: #ff00ff;">Helaas, er zijn geen plekken meer vrij voor deze activiteit.</div>';
                echo '<meta http-equiv="refresh" content="2;" />';
            } else {
                if(isset($_POST["tussenvoegsel"])== "") {
                    $sql = "INSERT INTO user (first_name, last_name, email, birthday, phonenumber) VALUES ('$voornaam', '$achternaam', '$email', '$geboortedatum', '$telefoonnr')";
                } else {
                    $sql = "INSERT INTO user (first_name, insertion, last_name, email, birthday, phonenumber) VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$geboortedatum', '$telefoonnr')";
                }
                $stmt = $db->prepare($sql);
                if ($stmt->execute()) {
                    echo '<div class="header text-center marbot martop" style="color: green;">Succesvol ingeschreven!</div>';
                    echo '<meta http-equiv="refresh" content="2;" />';
                }

                $last_id = $db->lastInsertId();

                $sql2 = "INSERT INTO inschrijvingen (blog_id, user_id) VALUES ('$id', '$last_id')";
                $smt2 = $db->prepare($sql2);
                if ($smt2->execute()) {

                } else {
                    echo '<div class="header text-center marbot martop" style="color: red;">Het huidige e-mail adres is reeds geregistreerd.</div>';
                }
            }
        }
    }

    if($inschrijven == 1) {
        if ($deeln >= $maxinschrijf) {
            echo '<div class="header text-center martop marbot" style="color: #ff00ff;">Helaas, er zijn geen plekken meer vrij voor deze activiteit.</div>';
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
                <input class='form-control' type='text' name='tussenvoegsel' placeholder='Van'/>
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
  ?>

<?php } else { ?>
    <div class="container">
        <div class="row">
            <div class="martop">
                <?php
                $dir = 'admin/images/blog/';

                echo"<div class='col-xs-12 ptitle'>
                	<h1>Blogs</h1>
                </div>
                <div class='col-xs-12 sorteer marbot'>
                     <form action='#' method='post' class='classicform'>
                <select name='sorteer' onchange='this.form.submit();'>
                            <option value='0' ";
                            if(isset($_POST['sorteer'])) {
                                $sort = ($_POST['sorteer']);
                                if ($sort == '0') {
                                    echo 'selected';
                                }
                            }
                            echo">Alles</option>

                            <option value='1' ";
                        if(isset($_POST['sorteer'])) {
                            $sort = ($_POST['sorteer']);
                            if ($sort == '1') {
                                echo 'selected';
                            }
                        }
                            echo">Activiteiten</option>
                        </select>
                    </form></div>";

                if (!isset($_POST['sorteer']) || ($_POST['sorteer'] == "0")) {
                    $query1 = $db->prepare('SELECT * FROM blog ORDER BY blog_id DESC');
                    $query1->execute();

                    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['blog_id'];
                        $img_name = $row['img_name'];
                        $title = $row['title'];
                        $inhoudkort = $row['korte_inhoud'];
                        $subtitel = $row["subtitle"];
                        $datum = $row['datum'];
                        $url = constant("local_url").$_GET['page']."/".$id;

                        echo"<div class='col-xs-8 col-sm-4 marbot'>

                        <div class='card card-inverse'>
                    
                        <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
                    
                        <div class='card-body'>
                    
                        <div class='card-img-overlay'>
                        <a href=$url><h4 class='card-title'>$title</h4></a></div>
                    
                        <p class='card-text'>$inhoudkort</p>
                    
                        <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
                    
                        </div></div></div>";

                    }
                } else {
                    if ($_POST['sorteer'] == "1") {
                        $query2 = $db->prepare('SELECT * FROM blog WHERE activiteit = "1" ORDER BY blog_id DESC');
                        $query2->execute();
                        while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['blog_id'];
                            $img_name = $row['img_name'];
                            $title = $row['title'];
                            $inhoudkort = $row['korte_inhoud'];
                            $datum = $row['datum'];
                            $subtitel = $row["subtitle"];
                            $url = constant("local_url").$_GET['page']."/".$id;

                        echo" <div class='col-xs-8 col-sm-4 marbot'>
 
                        <div class='card card-inverse'>
                    
                        <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
                        
                        <div class='card-body'>
                    
                        <div class='card-img-overlay'>
                        <a href=$url><h4 class='card-title'>$title</h4></a></div>
                    
                        <p class='card-text'>$inhoudkort</p>
                    
                        <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
                    
                        </div></div></div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

<?php } ?>