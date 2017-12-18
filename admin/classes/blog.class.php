<?php

class blog
{

    private $_db;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }

    public function getAllblog()
    {
        try {
            $query = $this->_db->prepare('
                   SELECT *
                   FROM blog
                ');

            if ($query->execute()) {
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

    public function deleteBlog($blog_id)
    {
        try {
            $query = $this->_db->prepare('
                DELETE FROM blog
                WHERE blog_id = :id;
            ');
            $query->bindValue(":id", $blog_id);
            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function deleteIns($blog_id)
    {
        try {
            $query = $this->_db->prepare('
                DELETE FROM inschrijvingen
                WHERE blog_id = :id;
            ');
            $query->bindValue(":id", $blog_id);
            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function saveBlog($data, $img, $userid)
    {
        try {
            if ($_POST['activiteit'] == "0") {
                $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

                $todir = 'images/blog/';

                if (!!$img['tmp_name']) {
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
                        header("refresh:2;url=blog_up.php");
                        exit;
                    }
                }

                $query = $this->_db->prepare('
                INSERT INTO `blog` (`user_id` ,`title`, `subtitle`, `inhoud` ,`korte_inhoud`, `beschrijving`, `kernwoorden`, `img_name`, `activiteit`) 
                VALUES (:user_id, :title, :subtitle, :inhoud, :korte_inhoud, :beschrijving, :kernwoorden, :img_name, :activiteit);
            ');

                $query->bindValue(":user_id", $userid);
                $query->bindValue(":title", $data['titel']);
                $query->bindValue(":subtitle", $data['subtitel']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korte_inhoud", $data['korte_inhoud']);
                $query->bindValue(":beschrijving", $data['seobeschrijving']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":img_name", $newfilename);
                $query->bindValue(":activiteit", $data['activiteit']);

                if ($query->execute()) {
                    return true;
                    die(header('Location: blog_admin.php'));
                } else {
                    var_dump($query->errorInfo());
                    var_dump($data);
                    return false;
                }

            } else {
                $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

                $todir = 'images/blog/';

                if (!!$img['tmp_name']) {
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
                        header("refresh:2;url=blog_up.php");
                        exit;
                    }
                }

                $query = $this->_db->prepare('
                            INSERT INTO `blog` (`user_id` ,`title`, `subtitle`, `inhoud`, `korte_inhoud`, `beschrijving`, `kernwoorden`, `img_name`, `activiteit`, `inschrijving`, `inschrijving_aantal`, `datum`)
                            VALUES (:user_id, :title, :subtitle, :inhoud, :korte_inhoud, :beschrijving, :kernwoorden, :img_name, :activiteit, :inschrijving, :maxdeeln, :datum);
                        ');

                $query->bindValue(":user_id", $userid);
                $query->bindValue(":title", $data['titel']);
                $query->bindValue(":subtitle", $data['subtitel']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korte_inhoud", $data['korte_inhoud']);
                $query->bindValue(":beschrijving", $data['seobeschrijving']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":img_name", $newfilename);
                $query->bindValue(":activiteit", $data['activiteit']);
                $query->bindValue(":inschrijving", $data['inschrijven']);
                $query->bindValue(":maxdeeln", $data['maxdeeln']);
                $query->bindValue(":datum", $data['actidatum']);

                if ($query->execute()) {
                    return true;
                    die(header('Location: blog_admin.php'));
                } else {
                    var_dump($query->errorInfo());
                    var_dump($data);
                    return false;
                }
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }

    }

    public function updateBlog($data, $img, $blog_id)
    {
        try {
            if ($_POST['activiteit'] == "1") {
                $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

                $todir = 'images/blog/';

                if (!!$img['tmp_name']) {
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
                        header("refresh:2;url=blog_up.php");
                        exit;
                    }
                }
                $query = $this->_db->prepare('
                UPDATE `blog` 
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `korte_inhoud`= :korte_inhoud, `beschrijving` = :beschrijving, `kernwoorden` = :kernwoorden, `img_name`=:img_name, `activiteit` = :activiteit, `inschrijving` = :inschrijving, `datum` = :datum
                WHERE `blog_id` = :blog_id;
            ');
                $query->bindValue(":blog_id", $blog_id);
                $query->bindValue(":title", $data['titel']);
                $query->bindValue(":subtitle", $data['subtitel']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korte_inhoud", $data['korte_inhoud']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":beschrijving", $data['seobeschrijving']);
                $query->bindValue(":img_name", $newfilename);
                $query->bindValue(":activiteit", $data['activiteit']);
                $query->bindValue(":inschrijving", $data['inschrijven']);
                $query->bindValue(":maxdeeln", $data['maxdeeln']);
                $query->bindValue(":datum", $data['actidatum']);
                if ($query->execute()) {
                    return true;
                } else {
                    var_dump($query->errorInfo());
                    return false;
                }
            } else {
                $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

                $todir = 'images/blog/';

                if (!!$img['tmp_name']) {
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
                        header("refresh:2;url=blog_up.php");
                        exit;
                    }
                }
                $query = $this->_db->prepare('
                UPDATE `blog` 
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `korte_inhoud`= :korte_inhoud, `beschrijving` = :beschrijving, `kernwoorden` = :kernwoorden, `img_name`=:img_name, `activiteit` = :activiteit
                WHERE `blog_id` = :blog_id;
            ');
                $query->bindValue(":blog_id", $blog_id);
                $query->bindValue(":title", $data['titel']);
                $query->bindValue(":subtitle", $data['subtitel']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korte_inhoud", $data['korte_inhoud']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":beschrijving", $data['seobeschrijving']);
                $query->bindValue(":img_name", $newfilename);
                $query->bindValue(":activiteit", $data['activiteit']);

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

    public function getBlogById($blog_id)
    {
        try {
            $query = $this->_db->prepare('
                    SELECT * FROM blog
                    WHERE blog_id = :id;
                ');
            $query->bindValue(":id", $blog_id);

            if ($query->execute()) {
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

    public function getDeelnemers($blog_id)
    {
        try {
            $query = $this->_db->prepare('
                    SELECT COUNT(blog_id)
                    FROM inschrijvingen
                    WHERE blog_id = :id
                ');
            $query->bindValue(":id", $blog_id);

            if ($query->execute()) {
                return $content = $query->fetch()[0];
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