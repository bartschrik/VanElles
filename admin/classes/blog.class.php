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
                    SELECT blog_id, title
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

    public function deleteBlog($lev_id)
    {
        try {
            $query = $this->_db->prepare('
                DELETE FROM blog
                WHERE blog_id = :id
            ');
            $query->bindValue(":id", $lev_id);
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