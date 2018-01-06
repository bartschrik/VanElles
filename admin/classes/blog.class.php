<?php

class blog
{

    private $_db;

    /**
     * blog constructor.
     * Maak een database connectie via de connection class
     */
    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }

    /**
     * Selecteer alle blog post in de database
     * Return is false of de content uit de database
     */
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

    /**
     * Verwijderen van een specifieke blog,
     * Parameter is het blog id, deze wordt dus ook verwijderd.
     * @param $blog_id
     * @return bool
     */
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

    /**
     * Verwijderen van een specifieke inschrijving van een activiteit.
     * Parameter is het inschrijving id, deze wordt dus ook verwijderd.
     * @param $blog_id
     * @return bool
     */
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

    /**
     * Verwijderen van een specifieke inschrijving van een activiteit.
     * Parameter is het inschrijving id, deze wordt dus ook verwijderd.
     * @param $inschijving_id
     * @return bool
     */
    public function deleteInsch($inschijving_id)
    {
        try {
            $query = $this->_db->prepare('
                DELETE FROM inschrijvingen
                WHERE inschijving_id = :id;
            ');
            $query->bindValue(":id", $inschijving_id);
            if ($query->execute()) {
                return true;
            } else {
                //var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    /**
     * Opslaan van een blog post inclusief het verwerken van de afbeelding
     * @param $data
     * @param $img
     * @param $userid
     * @return bool
     */
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
                VALUES (:user_id, :title, :subtitle, :inhoud, :korteinhoud, :beschrijving, :kernwoorden, :img_name, :activiteit);
            ');

                $query->bindValue(":user_id", $userid);
                $query->bindValue(":title", $data['titel']);
                $query->bindValue(":subtitle", $data['subtitel']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korteinhoud", $data['korteinhoud']);
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
                            VALUES (:user_id, :title, :subtitle, :inhoud, :korteinhoud, :beschrijving, :kernwoorden, :img_name, :activiteit, :inschrijving, :maxdeeln, :datum);
                        ');

                $query->bindValue(":user_id", $userid);
                $query->bindValue(":title", $data['titel']);
                $query->bindValue(":subtitle", $data['subtitel']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korteinhoud", $data['korteinhoud']);
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

    /**
     * Updaten van een blog post, inclusief het verwerken van de afbeelding
     * @param $data
     * @param $img
     * @param $blog_id
     * @return bool
     */
    public function updateBlog($data, $img, $blog_id)
    {
        try {
            if ($img['error'] == 0) {
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
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `korte_inhoud`= :korteinhoud, `beschrijving` = :beschrijving, `kernwoorden` = :kernwoorden, `img_name`=:img_name, `activiteit` = :activiteit, `inschrijving` = :inschrijving,  `inschrijving_aantal` = :maxdeeln, `datum` = :datum
                WHERE `blog_id` = :blog_id;
            ');
                    $query->bindValue(":blog_id", $blog_id);
                    $query->bindValue(":title", $data['titel']);
                    $query->bindValue(":subtitle", $data['subtitel']);
                    $query->bindValue(":inhoud", $data['inhoud']);
                    $query->bindValue(":korteinhoud", $data['korteinhoud']);
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
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `korte_inhoud`= :korteinhoud, `beschrijving` = :beschrijving, `kernwoorden` = :kernwoorden, `img_name`=:img_name, `activiteit` = :activiteit
                WHERE `blog_id` = :blog_id;
            ');
                    $query->bindValue(":blog_id", $blog_id);
                    $query->bindValue(":title", $data['titel']);
                    $query->bindValue(":subtitle", $data['subtitel']);
                    $query->bindValue(":inhoud", $data['inhoud']);
                    $query->bindValue(":korteinhoud", $data['korteinhoud']);
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
            } else {
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
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `korte_inhoud`= :korteinhoud, `beschrijving` = :beschrijving, `kernwoorden` = :kernwoorden, `activiteit` = :activiteit, `inschrijving` = :inschrijving, `inschrijving_aantal` = :maxdeeln ,`datum` = :datum
                WHERE `blog_id` = :blog_id;
            ');
                    $query->bindValue(":blog_id", $blog_id);
                    $query->bindValue(":title", $data['titel']);
                    $query->bindValue(":subtitle", $data['subtitel']);
                    $query->bindValue(":inhoud", $data['inhoud']);
                    $query->bindValue(":korteinhoud", $data['korteinhoud']);
                    $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                    $query->bindValue(":beschrijving", $data['seobeschrijving']);
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
                SET `title` = :title, `subtitle` = :subtitle, `inhoud` = :inhoud, `korte_inhoud`= :korteinhoud, `beschrijving` = :beschrijving, `kernwoorden` = :kernwoorden, `activiteit` = :activiteit
                WHERE `blog_id` = :blog_id;
            ');
                    $query->bindValue(":blog_id", $blog_id);
                    $query->bindValue(":title", $data['titel']);
                    $query->bindValue(":subtitle", $data['subtitel']);
                    $query->bindValue(":inhoud", $data['inhoud']);
                    $query->bindValue(":korteinhoud", $data['korteinhoud']);
                    $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                    $query->bindValue(":beschrijving", $data['seobeschrijving']);
                    $query->bindValue(":activiteit", $data['activiteit']);

                    if ($query->execute()) {
                        return true;
                    } else {
                        var_dump($query->errorInfo());
                        return false;
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Selecteren van een specifieke blog post,
     * selecteren gebeurt via het blog id
     */
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

    /**
     * Selecteer alle deelnemers van een specifieke blog post
     * @param $blog_id
     * @return bool | array
     */
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

    public function getDeelnOver($blog_id)
    {
        try {
            $query = $this->_db->prepare('
                    SELECT U.user_id, U.email, U.first_name, U.insertion, U.last_name, I.inschijving_id
                    FROM user U
                    JOIN Inschrijvingen I ON U.user_id = I.user_id
                    WHERE I.blog_id = :id
                ');
            $query->bindValue(":id", $blog_id);

            if ($query->execute()) {
                return ["values" => $query->fetchAll()];
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