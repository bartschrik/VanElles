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
                $date = date("j F Y", strtotime($row["datum"]));
                $time = date("H:i", strtotime($row["datum"]));
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
                        <h2>'.$subtitel.'</h2>
                    </div>
                        <p>'. $date .' <br>'. $time .'</p>
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
        include_once('admin/classes/page.class.php');

        $val = new Validate([
            ['voornaam', $_POST['voornaam'],'required'],
            ['achternaam', $_POST['achternaam'],'required'],
            ['geboortedatum', $_POST['geboortedatum'],'required'],
            ['telefoonnummer', $_POST['telefoonnummer'],'required'],
            ['emailadres', $_POST['emailadres'],'required|email']
        ]);

        if ($val->isPassed()) {
            try {
                $voornaam       = filter($_POST['voornaam']);
                $tussenvoegsel  = filter($_POST['tussenvoegsel']);
                $achternaam     = filter($_POST['achternaam']);
                $geboortedatum  = filter(date("Y/m/d", strtotime($_POST['geboortedatum'])));
                $telefoonnr     = filter($_POST['telefoonnummer']);
                $email          = filter($_POST['emailadres']);

                //query: check of email in user bestaat en selecteer id
                $query = $db->prepare("SELECT user_id FROM user WHERE email = :email");
                $query->bindValue(":email", $email);
                $query->execute();
                $last_id = $query->fetch()['user_id'];

                if ($last_id) {
                    //Zoja: update user info van bestaade user
                    $query = $db->prepare("UPDATE user SET first_name = :voornaam, insertion = :tussen, last_name = :achternaam, birthday = :geboorte, phonenumber = :tel WHERE user_id = :userid");
                    $query->bindValue(":voornaam", $voornaam);
                    $query->bindValue(":tussen", $tussenvoegsel);
                    $query->bindValue(":achternaam", $achternaam);
                    $query->bindValue(":geboorte", $geboortedatum);
                    $query->bindValue(":tel", $telefoonnr);
                    $query->bindValue(":userid", $last_id);
                    $query->execute();
                } else {
                    //insert nieuw user en inser revies
                    $query = $db->prepare("INSERT INTO user (email, first_name, insertion, last_name, birthday, phonenumber) VALUES (:email, :voornaam, :tussen, :achternaam, :geboorte, :tel)");
                    $query->bindValue(":voornaam", $voornaam);
                    $query->bindValue(":tussen", $tussenvoegsel);
                    $query->bindValue(":achternaam", $achternaam);
                    $query->bindValue(":geboorte", $geboortedatum);
                    $query->bindValue(":tel", $telefoonnr);
                    $query->bindValue(":email", $email);
                    $query->execute();
                    $last_id = $db->lastInsertId();
                }
                if ($deeln >= $maxinschrijf) {
                    $msg = '<div class="feedback error row"><div class="col-xs-12">Helaas, er zijn geen plekken meer vrij voor deze activiteit</div></div>';
                } else {
                    $query = $db->prepare("SELECT user_id FROM inschrijvingen WHERE blog_id = :blogid AND user_id = :user;");
                    $query->bindValue(":blogid", $id);
                    $query->bindValue(":user", $last_id);
                    $query->execute();
                    if($query->rowCount() > 0) {
                        $msg = '<div class="feedback error row"><div class="col-xs-12">U heeft zich al ingeschreven voor deze activiteit</div></div>';
                    } else {
                        $stmtin = $db->prepare("INSERT INTO inschrijvingen (blog_id, user_id) VALUES (:blogid, :user)");
                        $stmtin->bindValue(":blogid", $id);
                        $stmtin->bindValue(":user", $last_id);
                        if ($stmtin->execute()) {
                            $msg = '<div class="feedback success row"><div class="col-xs-12">Uw reservering is succesvol geplaatst</div></div>';
                        } else {
                            $msg = '<div class="feedback error row"><div class="col-xs-12">Er is iets fout gegaan tijdens het reserveren, probeer het later opnieuw</div></div>';
                        }
                    }
                }
            } catch (PDOException $e) {
                $msg = '<div class="feedback error row"><div class="col-xs-12">Er is iets fout gegaan tijdens het reserveren, probeer het later opnieuw</div></div>';
                echo $e->getMessage();
            }
        } else {
            $errors = $val->getErrors();
            $errorList = '';
            foreach ($errors as $errorcat) {
                foreach ($errorcat as $error) {
                    $errorList .= "<li>$error</li>";
                }
            }
            //date("Y/m/d", strtotime($_POST['geboorte'])),
            $msg = '<div class="feedback error"><div class="col-xs-12"><ul style="padding: 0;">' . $errorList . '</ul></div></div>';
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
        $msg
        <form method='post' action='$id' class='marbot'>
        
            <div class='row'>
                <div class='form-group'>
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                        <label for='voornaam'>Voornaam</label>
                        <input class='form-control' type='text' name='voornaam' placeholder='Robin' required value='$voornaam'/>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                        <label for='tussenvoegsel'>Tussenvoegsel</label>
                    <input class='form-control' type='text' name='tussenvoegsel' placeholder='Van'/>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                        <label for='achternaam'>Achternaam</label>
                        <input class='form-control' type='text' name='achternaam' placeholder='Dekker' required value='$achternaam'/>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='form-group'>
                    <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
                        <label for='geboortedatum'>Geboortedatum</label>
                        <input class='form-control' type='text' name='geboortedatum' id='date' required value='$geboortedatum'/>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
                        <label for='telefoonnummer'>Telefoonnummer</label>
                        <input class='form-control' type='tel' name='telefoonnummer' placeholder='0612345678' required value='$telefoonnr'/>
                    </div>
                    <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                        <label for='email'>Emailadres</label>
                        <input class='form-control' type='email' name='emailadres' placeholder='naam@voorbeeld.com' required value='$email'/>
                    </div>
                </div>
            </div>
            <div class='a-right'>
                <input type='submit' name='verstuur' value='Verstuur' class='btn btn-default'/>
            </div>
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
                    $query1 = $db->prepare('
                        SELECT b.blog_id, b.user_id, b.title, b.subtitle, b.inhoud, b.korte_inhoud, b.datum, b.beschrijving, b.kernwoorden, b.img_name, b.activiteit, b.inschrijving, b.inschrijving_aantal, b.verwijderd, COUNT(i.inschijving_id) inschrijvingen
                        FROM blog b
                        LEFT JOIN inschrijvingen i ON b.blog_id = i.blog_id
                        GROUP BY b.blog_id
                        ORDER BY b.datum DESC, b.blog_id DESC;
                    ');
                    $query1->execute();

                    while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['blog_id'];
                        $img_name = $row['img_name'];
                        $title = $row['title'];
                        $inhoudkort = $row['korte_inhoud'];
                        $date = date("j F Y", strtotime($row["datum"]));
                        $time = date("H:i", strtotime($row["datum"]));
                        $subtitel = $row["subtitle"];
                        $url = constant("local_url").$_GET['page']."/".$id;
                        $aantalPlek = $row['inschrijving_aantal'] - $row['inschrijvingen'];
                        if($aantalPlek == 1) {
                            $plekken = "1 plaats vrij";
                        } else {
                            $plekken = "$aantalPlek plaatsen vrij";
                        }

                        if($row['activiteit'] == 0) {
                            echo"
                            <div class='col-xs-8 col-sm-4 marbot'>
                                <div class='card blog-card marbot'>
                                    <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
                                    <div class='card-body'>
                                        <a href=$url><h4 class='card-title'>$title</h4></a>
                                        <p class='card-text'>$inhoudkort</p>
                                        <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
                                    </div>
                                </div>
                            </div>";
                        } else {
                            if($row['inschrijving'] == 0) {
                                echo"
                                <div class='col-xs-8 col-sm-4 marbot'>
                                    <div class='card blog-card marbot'>
                                        <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
                                        <span class='date'>$date<br><span>$time</span></span>
                                        <div class='card-body'>
                                            <a href=$url><h4 class='card-title'>$title</h4></a>
                                            <p class='card-text'>$inhoudkort</p>
                                            <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
                                        </div>
                                    </div>
                                </div>";
                            } else {
                                echo"
                                <div class='col-xs-8 col-sm-4 marbot'>
                                    <div class='card blog-card marbot'>
                                        <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
                                        <span class='date'>$date<br><span>$time</span></span>
                                        <span class='plaatsen'>$plekken</span>
                                        <div class='card-body'>
                                            <a href=$url><h4 class='card-title'>$title</h4></a>
                                            <p class='card-text'>$inhoudkort</p>
                                            <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
                                        </div>
                                    </div>
                                </div>";
                            }
                        }

                    }
                } else {
                    if ($_POST['sorteer'] == "1") {
                        $query2 = $db->prepare('
                            SELECT b.blog_id, b.user_id, b.title, b.subtitle, b.inhoud, b.korte_inhoud, b.datum, b.beschrijving, b.kernwoorden, b.img_name, b.activiteit, b.inschrijving, b.inschrijving_aantal, b.verwijderd, COUNT(i.inschijving_id) inschrijvingen
                            FROM blog b
                            LEFT JOIN inschrijvingen i ON b.blog_id = i.blog_id
                            WHERE b.activiteit = 1
                            GROUP BY i.blog_id
                            ORDER BY b.blog_id DESC;
                        ');
                        $query2->execute();
                        while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['blog_id'];
                            $img_name = $row['img_name'];
                            $title = $row['title'];
                            $inhoudkort = $row['korte_inhoud'];
                            $date = date("j F Y", strtotime($row["datum"]));
                            $time = date("H:i", strtotime($row["datum"]));
                            $subtitel = $row["subtitle"];
                            $url = constant("local_url").$_GET['page']."/".$id;
                            $aantalPlek = $row['inschrijving_aantal'] - $row['inschrijvingen'];
                            if($aantalPlek == 1) {
                                $plekken = "1 plaats vrij";
                            } else {
                                $plekken = "$aantalPlek plaatsen vrij";
                            }

                        echo"
                        <div class='col-xs-8 col-sm-4 marbot'>
                            <div class='card marbot'>
                                <a href='$url' style='background-image: url(".constant("local_url")."/admin/images/blog/$img_name);' class='card-img'></a>
                                <span class='date'>$date<br><span>$time</span></span>
                                <span class='plaatsen'>$plekken</span>
                                <div class='card-body'>
                                    <a href=$url><h4 class='card-title'>$title</h4></a>
                                    <p class='card-text'>$inhoudkort</p>
                                    <div class='a-right'><a href='$url' title='Details' class='btn btn-primary'>Lees meer</a></div>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

<?php } ?>