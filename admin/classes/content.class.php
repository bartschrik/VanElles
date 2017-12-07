<?php

class Content
{

    private $_db;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }

    public function getOneRandomReview()
    {
        try {
            $query = $this->_db->prepare('
                    SELECT * FROM review JOIN user ON review.user_id=user.user_id WHERE active=1 ORDER BY RAND() LIMIT 1;
                ');

            if ($query->execute()) {
                if ($query->rowCount() > 0) {
                    return $content = $query->fetchAll()[0];
                } else {
                    return false;
                }
            } else {
                echo $query->errorInfo();
                return false;
            }
        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
?>