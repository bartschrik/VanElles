<?php

class recensie
{

    private $_db;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }

    public function getAllrecensie($active = 0)
    {
        try {
            $query = $this->_db->prepare('
                    SELECT r.review_id, r.quote, r.rating, u.first_name, r.active
                    FROM review r
                    JOIN user u ON r.user_id = u.user_id
                    WHERE active = :active;
                ');
            $query->bindValue(":active", $active);

            if ($query->execute()) {
                return $content = $query->fetchAll();
            } else {
                //echo $query->errorInfo();
                return false;
            }
        } catch (PDOexception $e) {
            //echo $e->getMessage();
            return false;
        }
    }


    public function acceprecensie($data)
    {
        try {
            $query = $this->_db->prepare('
                UPDATE `review` 
                SET `active` = 1
                WHERE `review_id` = :review_id;
            ');
            $query->bindValue(":review_id", $data);

            if ($query->execute()) {
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

    public function deleteRecensie($review_id)
    {
        try {
            $query = $this->_db->prepare('
                DELETE FROM review
                WHERE review_id = :review_id
            ');
            $query->bindValue(":review_id", $review_id);
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
}
?>
