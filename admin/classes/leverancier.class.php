<?php

/**
 * Class leverancier - Alle functionaliteit wat betrekking heeft op de leverancier.
 */
class leverancier {

    private $_db;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }

    public function getAlllev() {
        try {
            $query = $this->_db->prepare('
                    SELECT lev_id, naam, korte_inhoud
                    FROM leveranciers
                ');

            if($query->execute()) {
                return $content = $query->fetchAll();
            } else {
                // var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOexception $e) {
           // echo $e->getMessage();
            return false;
        }
    }


    public function saveLev($data, $img) {
        try {

            $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

            $todir = 'images/leverancier/';
            //var_dump($logonaam);


            if (!!$img['tmp_name']) {
                //var_dump($logonaam);
                $temp = explode(".", $img["name"]);
                $date = new DateTime();
                $date = $date->format('Y-m-d H:i:s');
                $hash1 = sha1($date);
                $newfilename = $hash1 . '.' . end($temp);


                if (in_array(end($temp), $allow)) {
                    if (move_uploaded_file($img['tmp_name'], $todir . $newfilename)) {

                    }
                } else {
                    echo "De extentie is niet toegestaan, toegestaan is: (.jpg/.jpeg/.png/.gif.)<br />";
                    header("refresh:2;url=leverancier_toevoegen.php");
                    exit;
                }
            }


            $query = $this->_db->prepare('
                INSERT INTO `leveranciers` (`naam`, `inhoud`, `korte_inhoud`, `logo`, `description`, `kernwoorden`) 
                VALUES (:naam, :inhoud, :korteinhoud, :logo, :seoinhoud, :seokernwoorden);
            ');
            $query->bindValue(":naam", $data['naam']);
            $query->bindValue(":inhoud", $data['inhoud']);
            $query->bindValue(":korteinhoud", $data['korteinhoud']);
            $query->bindValue(":logo", $newfilename);
            $query->bindValue(":seokernwoorden", $data['seokernwoorden']);
            $query->bindValue(":seoinhoud", $data['seoinhoud']);

            if($query->execute()) {
                return true;
                die(header('Location: leverancier_overzicht.php'));
            } else {
                var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }

    }

    public function updateLev($data, $img, $lev_id) {
        try {
            if ($img['error'] == 0) {
                $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

                $todir = 'images/leverancier/';
                //var_dump($logonaam);


                if (!!$img['tmp_name']) {
                    //var_dump($logonaam);
                    $temp = explode(".", $img["name"]);
                    $date = new DateTime();
                    $date = $date->format('Y-m-d H:i:s');
                    $hash1 = sha1($date);
                    $newfilename = $hash1 . '.' . end($temp);

                    if (in_array(end($temp), $allow)) {
                        if (move_uploaded_file($img['tmp_name'], $todir . $newfilename)) {

                        }
                    } else {
                        echo "De extentie is niet toegestaan, toegestaan is: (.jpg/.jpeg/.png/.gif.)<br />";
                        header("refresh:2;url=leverancier_toevoegen.php");
                        exit;
                    }
                }


                $query = $this->_db->prepare('
                UPDATE `leveranciers` 
                SET `naam` = :naam, `inhoud` = :inhoud, `korte_inhoud` = :korteinhoud, `logo` = :logo, `description` = :description, `kernwoorden` = :kernwoorden 
                WHERE `lev_id` = :lev_id;
            ');
                $query->bindValue(":naam", $data['naam']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korteinhoud", $data['korteinhoud']);
                $query->bindValue(":logo", $newfilename);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":description", $data['seoinhoud']);
                $query->bindValue(":lev_id", $lev_id);
                if ($query->execute()) {
                    return true;
                } else {
                    var_dump($query->errorInfo());
                    return false;
                }
            } else {
                $query = $this->_db->prepare('
                UPDATE `leveranciers` 
                SET `naam` = :naam, `inhoud` = :inhoud, `korte_inhoud` = :korteinhoud, `description` = :description, `kernwoorden` = :kernwoorden 
                WHERE `lev_id` = :lev_id;
            ');
                $query->bindValue(":naam", $data['naam']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korteinhoud", $data['korteinhoud']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":description", $data['seoinhoud']);
                $query->bindValue(":lev_id", $lev_id);
                if ($query->execute()) {
                    return true;
                } else {
                    var_dump($query->errorInfo());
                    return false;
                }
            }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
        }
    }

    public function deleteLev($lev_id) {
        try {
            $query = $this->_db->prepare('
                DELETE FROM leveranciers
                WHERE lev_id = :id
            ');
            $query->bindValue(":id", $lev_id);
            if($query->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function getLeverancierById($lev_id) {
        try {
            $query = $this->_db->prepare('
                    SELECT * FROM leveranciers
                    WHERE lev_id = :id;
                ');
            $query->bindValue(":id", $lev_id);

            if($query->execute()) {
                return $content = $query->fetchAll()[0];
            } else {
                //echo $query->errorInfo();
                return false;
            }
        } catch (PDOexception $e) {
            //echo $e->getMessage();
            return false;
        }
    }





}