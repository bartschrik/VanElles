<?php

class Page {

    private $_db;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }

    public function getAllMin($active = 1) {
        try {
            $query = $this->_db->prepare('
                    SELECT p.id id, pagetitle, active, first_name, insertion, last_name, m.naam module
                    FROM page p
                    JOIN user u ON p.user_id = u.user_id
                    JOIN Module m ON p.Module_id = m.id
                    WHERE active = :active;
                ');
            $query->bindValue(":active", $active);

            if($query->execute()) {
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

    public function getModule() {
        try {
            $query = $this->_db->prepare('SELECT * FROM module');
            $query->execute();
            if($query->rowCount() < 1) {
                return 1;
            }

            return $content = $query->fetchAll();

        } catch (PDOexception $e) {
            return 2;
        }
    }

    public function savePage($data, $user_id) {
        try {
            $query = $this->_db->prepare('
                INSERT INTO `page` (`pagetitle`, `title`, `subtitle`, `inhoud`, `description`, `kernwoorden`, `active`, `datum`, `image`, `Module_id`, `user_id`) 
                VALUES (:paginatitel, :titel, :subtitel, :inhoud, :seoinhoud, :seokernwoorden, :actief, :datum, null, :module, :user_id);
            ');
            $query->bindValue(":paginatitel", $data['paginatitel']);
            $query->bindValue(":titel", $data['titel']);
            $query->bindValue(":subtitel", $data['subtitel']);
            $query->bindValue(":inhoud", $data['inhoud']);
            $query->bindValue(":module", $data['module']);
            $query->bindValue(":actief", $data['actief']);
            $query->bindValue(":seokernwoorden", $data['seokernwoorden']);
            $query->bindValue(":seoinhoud", $data['seoinhoud']);
            $query->bindValue(":datum", date('Y-m-d H:i:s'));
            $query->bindValue(":user_id", $user_id);
            if($query->execute())
                return true;
            return false;
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

    public function getPageById($id) {
        try {
            $query = $this->_db->prepare('
                    SELECT * FROM page
                    WHERE id = :id;
                ');
            $query->bindValue(":id", $id);

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

    public function getPageByUrl($url) {
        try {
            $query = $this->_db->prepare('
                    SELECT pagetitle, title, subtitle, inhoud, description, kernwoorden, path
                    FROM page p
                    JOIN Module m ON p.Module_id = m.id
                    WHERE active = 1 AND url = :url;
                ');
            $query->bindValue(":url", $url);

            if($query->execute()) {
                if($query->rowCount() > 0) {
                    return $content = $query->fetchAll()[0];
                } else {
                    return false;
                }
            } else {
                //echo $query->errorInfo();
                return false;
            }
        } catch (PDOexception $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function getMenuItems() {
        try {
            $query = $this->_db->prepare('
                    SELECT pagetitle, url FROM page
                    WHERE active = 1;
                ');

            if($query->execute()) {
                return $content = $query->fetchAll();
            } else {
                //echo $query->errorInfo();
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

}