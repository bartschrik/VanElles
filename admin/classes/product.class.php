<?php

class product {

    private $_db;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
    }


    public function getAllproduct($uitgelicht = 0)
    {
        try {
            $query = $this->_db->prepare('
                    SELECT product.product_id, product.naam, product.korte_inhoud, leveranciers.naam, product.webshop_url
                    FROM leveranciers AS leveranciers
                    JOIN product AS product
                    ON leveranciers.lev_id=product.lev_id
                    WHERE uitgelicht = :uitgelicht
                ');
            $query->bindValue(":uitgelicht", $uitgelicht);

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

    public function productuitlicht($data)
    {
        try {
            $query = $this->_db->prepare('
                UPDATE `product` 
                SET `uitgelicht` = 1
                WHERE `product_id` = :product_id;
            ');
            $query->bindValue(":product_id", $data);

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

    public function productinuitlicht($data)
    {
        try {
            $query = $this->_db->prepare('
                UPDATE `product` 
                SET `uitgelicht` = 0
                WHERE `product_id` = :product_id;
            ');
            $query->bindValue(":product_id", $data);

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


    public function saveProduct($data, $img) {
        try {

            $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

            $todir = 'images/product/';
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
                    header("refresh:2;url=product_toevoegen.php");
                    exit;
                }
            }


            $query = $this->_db->prepare('
                INSERT INTO `product` (`naam`, `inhoud`, `korte_inhoud`, `images`, `webshop_url`, `description`, `kernwoorden`, `lev_id`) 
                VALUES (:naam, :inhoud, :korteinhoud, :foto, :url,  :seoinhoud, :seokernwoorden, :lev_id);
            ');
            $query->bindValue(":naam", $data['naam']);
            $query->bindValue(":inhoud", $data['inhoud']);
            $query->bindValue(":korteinhoud", $data['korteinhoud']);
            $query->bindValue(":foto", $newfilename);
            $query->bindValue(":url", $data['url']);
            $query->bindValue(":seokernwoorden", $data['seokernwoorden']);
            $query->bindValue(":seoinhoud", $data['seoinhoud']);
            $query->bindValue(":lev_id", $data['Leverancier']);

            if($query->execute()) {
                return true;
                die(header('Location: product_overzicht.php'));
            } else {
                var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }

    }

    public function updateProduct($data, $img, $product_id) {
        try {
            if ($img['error'] == 0) {
                $allow = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");

                $todir = 'images/product/';
               // var_dump($newfilename);


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
                        header("refresh:2;url=product_bewerken.php");
                        exit;
                    }
                }


                $query = $this->_db->prepare('
                UPDATE `product` 
                SET `naam` = :naam, `inhoud` = :inhoud, `korte_inhoud` = :korteinhoud, `images` = :images, `webshop_url` = :url, `description` = :description, `kernwoorden` = :kernwoorden, `lev_id` = :lev_id  
                WHERE `product_id` = :product_id;
            ');
                $query->bindValue(":naam", $data['naam']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korteinhoud", $data['korteinhoud']);
                $query->bindValue(":images", $newfilename);
                $query->bindValue(":url", $data['url']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":description", $data['seoinhoud']);
                $query->bindValue(":lev_id", $data['leverancier']);
                $query->bindValue(":product_id", $product_id);
                if ($query->execute()) {
                    return true;
                } else {
                    var_dump($query->errorInfo());
                    return false;
                }
            } else {
                $query = $this->_db->prepare('
                UPDATE `product` 
                SET `naam` = :naam, `inhoud` = :inhoud, `korte_inhoud` = :korteinhoud, `webshop_url` = :url, `description` = :description, `kernwoorden` = :kernwoorden, `lev_id` = :lev_id  
                WHERE `product_id` = :product_id;
            ');
                $query->bindValue(":naam", $data['naam']);
                $query->bindValue(":inhoud", $data['inhoud']);
                $query->bindValue(":korteinhoud", $data['korteinhoud']);
                $query->bindValue(":url", $data['url']);
                $query->bindValue(":kernwoorden", $data['seokernwoorden']);
                $query->bindValue(":description", $data['seoinhoud']);
                $query->bindValue(":lev_id", $data['leverancier']);
                $query->bindValue(":product_id", $product_id);
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

    public function deleteProduct($product_id) {
        try {
            $query = $this->_db->prepare('
                DELETE FROM product
                WHERE product_id = :id
            ');
            $query->bindValue(":id", $product_id);
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

    public function getLev() {
        try {
            $query = $this->_db->prepare('SELECT * FROM leveranciers');
            $query->execute();
            if($query->rowCount() < 1) {
                return 1;
            }

            return $content = $query->fetchAll();

        } catch (PDOexception $e) {
            return 2;
        }
    }

    public function getProductById($product_id) {
        try {
            $query = $this->_db->prepare('
                    SELECT * FROM product
                    WHERE product_id = :id;
                ');
            $query->bindValue(":id", $product_id);

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

    public function getProductlevById($lev_id) {
        try {
            $query = $this->_db->prepare('
                    SELECT naam FROM leverancier
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