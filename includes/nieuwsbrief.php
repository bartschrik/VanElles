<?php

function nieuwsbrief($email){
    ?>
    <link href="<?php echo constant("local_url"); ?>admin/classes/connection.class.php" />
<?php
        $db = new Connection();
        $db = $db->databaseConnection();

        if (isset($_POST["nb"])) {
            if (empty($_POST["email"])) {
                print("Vul a.u.b. alle velden in");
            } else {
                try {
                    $email = $_POST["email"];

                    //query: check of email in user bestaat en selecteer id
                    $query = $db->prepare("SELECT user_id FROM user WHERE email = :email");
                    $query->bindValue(":email", $email);
                    $query->execute();
                    $last_id = $query->fetch()['user_id'];

                    if($last_id) {
                        //Zoja: update user info van bestaade user
                        $query = $db->prepare("UPDATE user SET newsletter = :newsletter WHERE user_id = :userid");
                        $query->bindValue(":newsletter", 1);
                        $query->bindValue(":userid", $last_id);
                    } else {
                        //insert nieuw user en insert contact
                        $query = $db->prepare("INSERT INTO user (email) VALUES (:email)");
                        $query->bindValue(":email", $email);
                        $last_id = $db->lastInsertId();
                    }


                    if ($query->execute()) {
                        echo "<script>alert('Dank u voor het inschijven voor de nieuwsbrief.');</script>";

                    } else {
                        //var_dump($query->errorInfo());
                        echo "<script>alert('Sorry er is iets fout gegaan, probeer het later nog een keer.');</script>";
                    }
                } catch (PDOException $e) {
                    //echo $e->getMessage();
                }
            }
        }
        return true;

}