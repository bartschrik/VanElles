<?php

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
                    SELECT lev_id, naam
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
            $logonaam = $img;
            //var_dump($img);

            $allow = array("jpg", "jpeg", "gif", "png", "PNG");

            $todir = 'images/leverancier/';
            //var_dump($logonaam);

            if (!empty($img['error'])) {
               // var_dump($logonaam);
                echo "Selecteer een afbeelding a.u.b.<br>";
                header("refresh:2;url=leverancier_overzicht.php");
                exit;
            } else {
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
            }

            $query = $this->_db->prepare('
                INSERT INTO `leveranciers` (`naam`, `inhoud`, `logo`, `description`, `kernwoorden`) 
                VALUES (:naam, :inhoud, :logo, :seoinhoud, :seokernwoorden);
            ');
            $query->bindValue(":naam", $data['naam']);
            $query->bindValue(":inhoud", $data['inhoud']);
            $query->bindValue(":logo", $newfilename);
            $query->bindValue(":seokernwoorden", $data['seokernwoorden']);
            $query->bindValue(":seoinhoud", $data['seoinhoud']);

            if($query->execute()) {
                return true;
            } else {
                var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }

    }

    public function updatePage($data, $page_id) {
        try {
            $query = $this->_db->prepare('
                UPDATE `page` 
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `description` = :description, `kernwoorden` = :kernwoorden, `active` = :active, `Module_id` = :module 
                WHERE `id` = :pageid;
            ');
            $query->bindValue(":title", $data['titel']);
            $query->bindValue(":subtitle", $data['subtitel']);
            $query->bindValue(":inhoud", $data['inhoud']);
            $query->bindValue(":module", $data['module']);
            $query->bindValue(":active", $data['actief']);
            $query->bindValue(":kernwoorden", $data['seokernwoorden']);
            $query->bindValue(":description", $data['seoinhoud']);
            $query->bindValue(":pageid", $page_id);
            if($query->execute()) {
                return true;
            } else {
                var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deletePagina($id) {
        try {
            $query = $this->_db->prepare('
                DELETE FROM page
                WHERE id = :id
            ');
            $query->bindValue(":id", $id);
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




}