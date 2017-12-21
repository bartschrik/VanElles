<?php

class User {

    private $_db;

    private $_user;
    private $_loggedin = false;

    private $_super_admin = 1;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
        //Check session/ cookie
        if(isset($_SESSION['user'])) {
            $this->login(null, null, $_SESSION['user']['hash']);
        } elseif (isset($_COOKIE['remember']) && $_COOKIE['remember'] != null) {
            $this->login(null, null, $_COOKIE['remember']);
        }
    }

    public function login($email = null, $pass = null, $hash = null, $remember = null, $gebruikersnaam = null)
    {
        if($email && $pass) {
            try {
                $query = $this->_db->prepare('SELECT * FROM user u JOIN admin a ON u.user_id = a.user_id WHERE email=:email AND verwijderd=0;');
                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->execute();
                if($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $submitted_pass = sha1($user['salt'] . $pass);
                    if($submitted_pass == $user['wachtwoord']) {
                        $this->_user = $user;
                        $_SESSION['user'] = $user;
                        $this->_loggedin = true;

                        if(hasContent($remember)) {
                            setcookie( "remember", $user['hash'], strtotime( '+30 days' ) );
                        }

                        die(header('Location: dashboard.php'));
                    }
                }
                return 3;
            } catch (PDOException $e) {
                return 2;
            }
        } elseif ($gebruikersnaam && $pass) {
            try {
                $query = $this->_db->prepare('SELECT * FROM user u JOIN admin a ON u.user_id = a.user_id WHERE gebruikersnaam=:gebruikersnaam AND verwijderd=0;');
                $query->bindValue(":gebruikersnaam", $gebruikersnaam, PDO::PARAM_STR);
                $query->execute();
                if($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $submitted_pass = sha1($user['salt'] . $pass);
                    if($submitted_pass == $user['wachtwoord']) {
                        $this->_user = $user;
                        $_SESSION['user'] = $user;
                        $this->_loggedin = true;

                        if(hasContent($remember)) {
                            setcookie( "remember", $user['hash'], strtotime( '+30 days' ) );
                        }

                        die(header('Location: dashboard.php'));
                    }
                }
                return 3;
            } catch (PDOException $e) {
                return 2;
            }
        } elseif ($hash) {
            try {
                $query = $this->_db->prepare('SELECT * FROM user u JOIN admin a ON u.user_id = a.user_id WHERE hash = :hash AND verwijderd=0;');
                $query->bindValue(":hash", $hash, PDO::PARAM_STR);
                $query->execute();

                if($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $this->_user = $user;
                    $_SESSION['user'] = $user;
                    $this->_loggedin = true;
                    return $user['user_id'];
                }
                return 3;
            } catch (PDOexception $e) {
                return 2;
            }
        }
        return 1;
    }

    public function regiser($email, $voornaam, $tussenvoegsel, $achternaam, $telefoon, $city, $address, $zipcode, $role = 2, $geboorte, $gebruikersnaam, $wachtwoord) {
        try {
            if($gebruikersnaam == null || $gebruikersnaam == '') {
                $query = $this->_db->prepare('
                    INSERT INTO user (`email`, `first_name`, `insertion`, `last_name`, `phonenumber`, `city`, `address`, `zipcode`, `role`, `birthday`)
                    VALUES (:email, :voornaam, :tussenvoegsel, :achternaam, :telefoon, :city, :address, :zipcode, :role, :geboorte);
                ');

                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->bindValue(":voornaam", $voornaam, PDO::PARAM_STR);
                $query->bindValue(":tussenvoegsel", $tussenvoegsel, PDO::PARAM_STR);
                $query->bindValue(":achternaam", $achternaam, PDO::PARAM_STR);
                $query->bindValue(":telefoon", $telefoon, PDO::PARAM_STR);
                $query->bindValue(":city", $city, PDO::PARAM_STR);
                $query->bindValue(":address", $address, PDO::PARAM_STR);
                $query->bindValue(":zipcode", $zipcode, PDO::PARAM_STR);
                $query->bindValue(":role", $role, PDO::PARAM_STR);
                $query->bindValue(":geboorte", $geboorte, PDO::PARAM_STR);
            } else {
                $query = $this->_db->prepare('
                    INSERT INTO user (`email`, `first_name`, `insertion`, `last_name`, `phonenumber`, `city`, `address`, `zipcode`, `role`, `birthday`)
                    VALUES (:email, :voornaam, :tussenvoegsel, :achternaam, :telefoon, :city, :address, :zipcode, :role, :geboorte);
                    
                    INSERT INTO admin (`user_id`, `gebruikersnaam`, `wachtwoord`, `salt`, `hash`)
                    VALUES (LAST_INSERT_ID(), :gebruikersnaam, :wachtwoord, :salt, :hash);
                ');

                $query->bindValue(":email", $email, PDO::PARAM_STR);
                $query->bindValue(":voornaam", $voornaam, PDO::PARAM_STR);
                $query->bindValue(":tussenvoegsel", $tussenvoegsel, PDO::PARAM_STR);
                $query->bindValue(":achternaam", $achternaam, PDO::PARAM_STR);
                $query->bindValue(":telefoon", $telefoon, PDO::PARAM_STR);
                $query->bindValue(":city", $city, PDO::PARAM_STR);
                $query->bindValue(":address", $address, PDO::PARAM_STR);
                $query->bindValue(":zipcode", $zipcode, PDO::PARAM_STR);
                $query->bindValue(":role", $role, PDO::PARAM_STR);
                $query->bindValue(":geboorte", $geboorte, PDO::PARAM_STR);

                $an = "1234567890!@#$%^&*()qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
                $su = strlen($an) - 1;
                $randomdi1 = '';
                for ($i = 1; $i <= 50; $i++) {
                    $randomdi1 .= substr($an, rand(0, $su), 1);
                }
                $randomdi2 = '';
                for ($i = 1; $i <= 50; $i++) {
                    $randomdi2 .= substr($an, rand(0, $su), 1);
                }

                $hash1 = sha1(time().$randomdi1.$gebruikersnaam);
                $hash2 = sha1(time().$randomdi2.$gebruikersnaam);

                $query->bindValue(":gebruikersnaam", $gebruikersnaam, PDO::PARAM_STR);
                $query->bindValue(":wachtwoord", sha1($hash2.$wachtwoord), PDO::PARAM_STR);
                $query->bindValue(":hash", $hash1, PDO::PARAM_STR);
                $query->bindValue(":salt", $hash2, PDO::PARAM_STR);
            }

            if($query->execute()) {
                return true;
            } else {
                print_r($query->errorInfo());
                return false;
            }
        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($email, $voornaam, $tussenvoegsel, $achternaam, $telefoon, $city, $address, $zipcode, $role = 2, $geboorte, $user_id, $gebruikersnaam, $wachtwoord) {
        try {
            if($role == 2) {
                $this->updateUser($email, $voornaam, $tussenvoegsel, $achternaam, $telefoon, $city, $address, $zipcode, $role, $geboorte, $user_id);
                $this->delAdmin($user_id);
            } else {
                $this->updateUser($email, $voornaam, $tussenvoegsel, $achternaam, $telefoon, $city, $address, $zipcode, $role, $geboorte, $user_id);

                //checkadmin
                if($this->checkAdmin($user_id)) {
                    if($wachtwoord) {
                        $this->updateAdmin($user_id, $wachtwoord, $gebruikersnaam);
                    }
                } else {
                    $this->insertAdmin($user_id, $gebruikersnaam, $wachtwoord);
                }
            }
            return true;
        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function checkAdmin($user_id) {
        try {
            $checkAdmin = $this->_db->prepare('
                SELECT user_id FROM admin WHERE user_id = :id;
            ');
            $checkAdmin->bindValue(":id", $user_id, PDO::PARAM_STR);
            if($checkAdmin->execute()) {
                if($checkAdmin->rowCount() > 0) {
                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function updateUser($email, $voornaam, $tussenvoegsel, $achternaam, $telefoon, $city, $address, $zipcode, $role = 2, $geboorte, $user_id) {
        //Update User
        try {
            $upDateUser = $this->_db->prepare('
                UPDATE user
                SET email = :email, first_name = :voornaam, insertion = :tussenvoegsel, last_name = :achternaam, phonenumber = :telefoon, city = :city, address = :address, zipcode = :zipcode, role = :role, birthday = :geboorte
                WHERE user_id = :id;
            ');
            $upDateUser->bindValue(":email", $email, PDO::PARAM_STR);
            $upDateUser->bindValue(":voornaam", $voornaam, PDO::PARAM_STR);
            $upDateUser->bindValue(":tussenvoegsel", $tussenvoegsel, PDO::PARAM_STR);
            $upDateUser->bindValue(":achternaam", $achternaam, PDO::PARAM_STR);
            $upDateUser->bindValue(":telefoon", $telefoon, PDO::PARAM_STR);
            $upDateUser->bindValue(":city", $city, PDO::PARAM_STR);
            $upDateUser->bindValue(":address", $address, PDO::PARAM_STR);
            $upDateUser->bindValue(":zipcode", $zipcode, PDO::PARAM_STR);
            $upDateUser->bindValue(":role", $role, PDO::PARAM_STR);
            $upDateUser->bindValue(":geboorte", $geboorte, PDO::PARAM_STR);
            $upDateUser->bindValue(":id", $user_id, PDO::PARAM_STR);
            if($upDateUser->execute()) {
                return true;
            }
            //var_dump($query->errorInfo());
            return false;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    private function delAdmin($user_id) {
        try {
            $delAdmin = $this->_db->prepare('
                DELETE FROM admin WHERE user_id = :id AND user_id !=:sa
            ');
            $delAdmin->bindValue(":id", $user_id, PDO::PARAM_STR);
            $delAdmin->bindValue(":sa", $this->_super_admin, PDO::PARAM_STR);
            if($delAdmin->execute()) {
                return true;
            }
            //var_dump($query->errorInfo());
            return false;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    private function updateAdmin($user_id, $wachtwoord, $gebruikersnaam) {
        try {
            $updateAdmin = $this->_db->prepare('
                UPDATE admin
                SET wachtwoord = :wachtwoord, salt = :salt, hash = :hash
                WHERE user_id = :id;
            ');

            $an = "1234567890!@#$%^&*()qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
            $su = strlen($an) - 1;
            $randomdi1 = '';
            for ($i = 1; $i <= 50; $i++) {
                $randomdi1 .= substr($an, rand(0, $su), 1);
            }
            $randomdi2 = '';
            for ($i = 1; $i <= 50; $i++) {
                $randomdi2 .= substr($an, rand(0, $su), 1);
            }

            $hash1 = sha1(time().$randomdi1.$gebruikersnaam);
            $hash2 = sha1(time().$randomdi2.$gebruikersnaam);

            $updateAdmin->bindValue(":wachtwoord", sha1($hash2.$wachtwoord), PDO::PARAM_STR);
            $updateAdmin->bindValue(":hash", $hash1, PDO::PARAM_STR);
            $updateAdmin->bindValue(":salt", $hash2, PDO::PARAM_STR);
            $updateAdmin->bindValue(":id", $user_id, PDO::PARAM_STR);

            if($updateAdmin->execute()) {
                return true;
            }
            //var_dump($query->errorInfo());
            return false;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    private function insertAdmin($user_id, $gebruikersnaam, $wachtwoord) {
        try {
            $updateAdmin = $this->_db->prepare('
                INSERT INTO admin (user_id, gebruikersnaam, wachtwoord, salt, hash)
                VALUES (:id, :gebruikersnaam, :wachtwoord, :salt, :hash);
            ');

            $an = "1234567890!@#$%^&*()qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
            $su = strlen($an) - 1;
            $randomdi1 = '';
            for ($i = 1; $i <= 50; $i++) {
                $randomdi1 .= substr($an, rand(0, $su), 1);
            }
            $randomdi2 = '';
            for ($i = 1; $i <= 50; $i++) {
                $randomdi2 .= substr($an, rand(0, $su), 1);
            }

            $hash1 = sha1(time().$randomdi1.$gebruikersnaam);
            $hash2 = sha1(time().$randomdi2.$gebruikersnaam);

            $updateAdmin->bindValue(":wachtwoord", sha1($hash2.$wachtwoord), PDO::PARAM_STR);
            $updateAdmin->bindValue(":hash", $hash1, PDO::PARAM_STR);
            $updateAdmin->bindValue(":salt", $hash2, PDO::PARAM_STR);
            $updateAdmin->bindValue(":id", $user_id, PDO::PARAM_STR);
            $updateAdmin->bindValue(":gebruikersnaam", $gebruikersnaam, PDO::PARAM_STR);

            if($updateAdmin->execute()) {
                return true;
            }
            //var_dump($query->errorInfo());
            return false;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getUserName() {
        return $this->_user['first_name'].' '.$this->_user['insertion'].' '.$this->_user['last_name'];
    }

    public function isLoggedIn() {
        return $this->_loggedin;
    }

    public function getAllUsersMin($page = 1, $rowspPage = 10) {
        try {
            $offset = ($page - 1) * $rowspPage;

            $query = $this->_db->prepare('
                    SELECT u.user_id, u.first_name, u.insertion, u.last_name, u.email, a.gebruikersnaam, r.role_name
                    FROM user u
                    LEFT JOIN admin a ON u.user_id = a.user_id
                    JOIN role r ON u.role = r.role
                    WHERE verwijderd = 0
                    AND u.user_id != :sa
                    ORDER BY u.role ASC, u.user_id ASC
                    LIMIT :lim
                    OFFSET :off;
                    SELECT COUNT(*) aantal FROM user;
                ');
            $query->bindValue(":lim", (int) $rowspPage, PDO::PARAM_INT);
            $query->bindValue(":off", (int) $offset, PDO::PARAM_INT);
            $query->bindValue(":sa", $this->_super_admin, PDO::PARAM_INT);
            $query2 = $this->_db->prepare('
                SELECT COUNT(*) FROM user WHERE verwijderd = 0;
            ');

            if($query->execute()) {
                $query = $query->fetchAll();
                if($query2->execute()) {
                    $query2 = $query2->fetch()[0];
                    return ["values" => $query, "aantal" => $query2];
                } else {
                    var_dump($query2->errorInfo());
                    return ["values" => $query->fetchAll(), "aantal" => false];
                }
            } else {
                var_dump($query->errorInfo());
                return false;
            }
        } catch (PDOexception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteUser($userid) {
        try {
            $query = $this->_db->prepare('
                SELECT role FROM user WHERE user_id = :id;
            ');
            $query->bindValue(":id", $userid);
            if($query->execute()) {
                if($query->fetch()[0] == 1) {
                    return "<div class='feedback error'><p>Je kan geen admin verwijderen.</p></div>";
                } else {
                    $query = $this->_db->prepare('
                        UPDATE user SET verwijderd = 1 WHERE user_id = :id AND user_id != :sa;
                    ');
                    $query->bindValue(":id", $userid);
                    $query->bindValue(":sa", $this->_super_admin);
                    if($query->execute()) {
                        return "<div class='feedback success'><p>De gebruiker is succesvol verwijderd.</p></div>";
                    } else {
                        return "<div class='feedback error'><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>";
                    }
                }
            } else {
                return "<div class='feedback error'><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>";
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return "<div class='feedback error'><p>Er is iets mis gegaan, probeer het later opnieuw.</p></div>";
        }
    }

    public function getRoles() {
        try {
            $query = $this->_db->prepare('SELECT * FROM role ORDER BY role DESC');
            if($query->execute()) {
                if($query->rowCount() > 0) {
                    return $content = $query->fetchAll();
                }
            }
            return false;
        } catch (PDOexception $e) {
            return false;
        }
    }

    public function getUserById($data) {
        try {
            $query = $this->_db->prepare('
                SELECT * FROM user u
                LEFT JOIN admin a ON u.user_id = a.user_id
                WHERE u.user_id = :id
            ');
            $query->bindValue(":id", $data, PDO::PARAM_STR);
            if($query->execute()) {
                if($query->rowCount() > 0) {
                    return $content = $query->fetchAll();
                }
            }
            return false;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }
}