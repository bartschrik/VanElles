
<head>
    <meta http-equiv="refresh" content="0; url=../contact.php" />
</head>

<?php

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

    $mail->setFrom($_POST["email"] . $_POST["naam"]);            // Laat zien wie hem heeft gestuurd
    $mail->addReplyTo($_POST["email"] . $_POST["naam"]);         // Naar wie je replied
    $mail->addAddress('bartschrik@hotmail.com');                        // De ontvanger van de emails
    $mail->isHTML(true);                                                // Verander het email layout naar html



    $bodyContent = "mail van: " . $_POST["naam"] . "<br>";           // wat in de email komt te staan
    $mail->Subject = 'Contact van ' . $_POST["email"];                   // Het onderwerp van het email zelf
    $mail->Body = $bodyContent;


    if (!$mail->send()) {
        echo "<script>alert('Sommige velden zijn niet goed ingevuld.');</script>";
        echo "<script>alert('Mail Error: . $mail->ErrorInfo ');</script>";
    } else{
        echo "<script>alert('Het formulier is verstuurd.');</script>";
    }


