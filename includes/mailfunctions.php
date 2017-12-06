<?php

function contactmail($emailincontact, $naamincontact, $berichtcontact, $telefooncontact){
// Multiple recipients
$to = 'bart.schrik@hotmail.com'; // note the comma

// Subject
$subject = 'Contact ';

// Message
$berichtcontact = $berichtcontact . $telefooncontact;

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Vanelles <bart.schrik@hotmail.com>';
$headers[] = 'From:' . $naamincontact . $emailincontact;

// Mail it
mail($to, $subject, $berichtcontact, implode("\r\n", $headers));

}
  ?>