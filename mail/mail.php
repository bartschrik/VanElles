<head>
    <meta http-equiv="refresh" content="0; url=../contact.php" />
</head>

<?php
$allowed =  array('gif', 'png' ,'jpg');
$filename = $_FILES['file']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!empty($_FILES['file']['name']) && (!in_array($ext,$allowed))) {
    echo "<script>alert('Kies een foto met een .jpg, .png of .gif extensie en probeer opnieuw.');</script>";
}elseif(in_array($ext,$allowed) || empty($_FILES['file']['name'])) {
    move_uploaded_file($_FILES["file"]["tmp_name"],"./fotos/upload/" . $_FILES["file"]["name"]);
    $patroon = "./fotos/upload/" . $_FILES["file"]["name"];

//BEGIN CONNECTIE DATABASE
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $database = "mydb";
    $host = "localhost";
    $port = "3307";

// Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$database;port=$port", $username, $password);


// uploaden naar de database

    date_default_timezone_set('Europe/Amsterdam');
    $date = date('Y-m-d h:i:s', time());

    if (isset($_POST["ContactButton"]) && isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("INSERT INTO contact (subject, first_name, last_name, email,phonenumber, message, `date`, user_id) VALUES (?, ?, ?, ?, ?, ?, '$date', ?)");
        $stmt->execute(array($_POST["Onderwerp"], $_POST["Voornaam"], $_POST["Achternaam"], $_POST["E-mail"], $_POST["Telefoonnummer"], $_POST["Bericht"],$_SESSION['user_id']));
    } elseif (isset($_POST["ContactButton"])) {
        $stmt = $pdo->prepare("INSERT INTO contact (subject, first_name, last_name, email, phonenumber, message, `date`) VALUES (?, ?, ?, ?, ?, ?, '$date' )");
        $stmt->execute(array($_POST["Onderwerp"], $_POST["Voornaam"], $_POST["Achternaam"], $_POST["E-mail"], $_POST["Telefoonnummer"], $_POST["Bericht"]));
    }else{
        echo 'niet ingevuld';
    }


//HET MAIL SYSTEEM
    require "PHPMailerAutoload.php";

    $mail = new PHPMailer;

    $mail->isSMTP();                                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                                     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                             // Enable SMTP authentication
    $mail->Username = 'bartschrikschool@gmail.com';                     // SMTP username
    $mail->Password = 'KBSopdracht';                                    // SMTP password
    $mail->SMTPSecure = 'tls';                                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                                  // TCP port to connect to

    $mail->setFrom($_POST["E-mail"] . $_POST["Achternaam"]);            // Laat zien wie hem heeft gestuurd
    $mail->addReplyTo($_POST["E-mail"] . $_POST["Achternaam"]);         // Naar wie je replied
    $mail->addAddress('janpannen@hotmail.com');                        // De ontvanger van de emails
    $mail->AddAttachment($patroon);
    $mail->isHTML(true);                                                // Verander het email layout naar html



    $bodyContent = "Onderwerp: " . $_POST["Onderwerp"] . "<br>";           // wat in de email komt te staan
    $bodyContent .= "Naam: " . $_POST["Voornaam"] . " ";
    $bodyContent .= $_POST["Achternaam"] . "<br>";
    $bodyContent .= "E-mailadres: " . $_POST["E-mail"] . "<br>";
    $bodyContent .= "Telefoonnummer: " . $_POST["Telefoonnummer"] . "<br>";
    $bodyContent .= "Bericht: " . $_POST["Bericht"] . "<br>";
    $mail->Subject = 'Contact van ' . $_POST["E-mail"];                   // Het onderwerp van het email zelf
    $mail->Body = $bodyContent;


    if (!$mail->send()) {
        echo "<script>alert('Sommige velden zijn niet goed ingevuld.');</script>";
        echo "<script>alert('Mail Error: . $mail->ErrorInfo ');</script>";
    } else{
        echo "<script>alert('Het formulier is verstuurd.');</script>";
    }
}


