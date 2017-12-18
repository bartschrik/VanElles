<?php

//HET MAIL SYSTEEM

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    require 'mail/Exception.php';
    require 'mail/PHPMailer.php';
    require 'mail/SMTP.php';
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'bartschrikschool@gmail.com';                     // SMTP username
    $mail->Password = 'KBSopdracht';                                    // SMTP password


    //require_once 'admin/classes/connection.class.php';
    //$db = new Connection();
    //$db = $db->databaseConnection();

   // $query = $db->prepare("SELECT email FROM user WHERE newsletter = 1");


    //if($query->execute()) {
      //  $query = $query->fetchAll();
        //foreach ($query as $value) {
          //  $mail->AddCC($value);

//        }
  //  }
$mail->AddCC('bart.schrik@hotmail.com');
$mail->AddCC('s1105662@student.windesheim.nl');

    $mail->setFrom("noreply@vanelles.nl");            // Laat zien wie hem heeft gestuurd
    $mail->isHTML(true);                               // Verander het email layout naar html







    $bodyContent .= "Bericht:  <br>";


    $mail->Subject = 'contactformulier van ';                   // Het onderwerp van het email zelf
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








