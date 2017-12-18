<?php

//HET MAIL SYSTEEM

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($ja==1){

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

    $naamincontact = $_POST["naamcontact"];
    $tussencontact = $_POST["tussencontact"];
    $achtercontact = $_POST["achtercontact"];
    $emailincontact = $_POST["emailcontact"];
    $telefooncontact = $_POST["telefoonnummercontact"];
    $berichtcontact = $_POST["berichtcontact"];


    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'bartschrikschool@gmail.com';                     // SMTP username
    $mail->Password = 'KBSopdracht';                                    // SMTP password

    $mail->setFrom( $emailincontact);            // Laat zien wie hem heeft gestuurd
    $mail->addReplyTo($emailincontact);         // Naar wie je replied
    $mail->addAddress('bart.schrik@hotmail.com');                        // De ontvanger van de emails
    $mail->isHTML(true);                                                // Verander het email layout naar html


    $bodyContent = "contact formulier van " . $emailincontact . "<br>";           // wat in de email komt te staan
    $bodyContent .= "Naam: " .$naamincontact . " " . $achtercontact ."<br> ";
    $bodyContent .= "Emailadres: " . $emailincontact. "<br>";
    $bodyContent .= "Telefoonnummer: " . $telefooncontact . "<br>";
    $bodyContent .= "Bericht: " . $berichtcontact .    "<br>";
    $mail->Subject = 'contactformulier van ' . $emailincontact;                   // Het onderwerp van het email zelf
    $mail->Body = $bodyContent;
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);


   if (!$mail->send()) {
       echo "<script>alert('Mail word niet verzend.');</script>";
        echo "<script>alert('Mail Error: . $mail->ErrorInfo ');</script>";
    } else {
        echo "<script>alert('Bedankt dat u contact met ons opneemt.');</script>";
    }
}else{
print "error";
}





