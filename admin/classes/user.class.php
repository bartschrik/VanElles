<?php

class User {

    private $_db;

    private $_user;
    private $_loggedin = false;

    public function __construct()
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->databaseConnection();
        //Check session/ cookie
        if(isset($_SESSION['user'])) {
            $this->_user = $_SESSION['user'];
            $this->_loggedin = true;
        } elseif (isset($_COOKIE['remember']) && $_COOKIE['remember'] != null) {
            $this->login(null, null, $_COOKIE['remember']);
        }
    }

    public function login($email = null, $pass = null, $hash = null, $remember = null, $gebruikersnaam = null)
    {
        if($email && $pass) {
            try {
                $query = $this->_db->prepare('SELECT * FROM user u JOIN admin a ON u.user_id = a.user_id WHERE email=:email;');
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
                    return 3;
                }
            } catch (PDOException $e) {
                return 2;
            }
        } elseif ($gebruikersnaam && $pass) {
            try {
                $query = $this->_db->prepare('SELECT * FROM user u JOIN admin a ON u.user_id = a.user_id WHERE gebruikersnaam=:gebruikersnaam;');
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
                    return 3;
                }
            } catch (PDOException $e) {
                return 2;
            }
        } elseif ($hash) {
            try {
                $query = $this->_db->prepare('SELECT * FROM user u JOIN admin a ON u.user_id = a.user_id WHERE hash = :hash');
                $query->bindValue(":hash", $hash, PDO::PARAM_STR);
                $query->execute();

                if($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $this->_user = $user;
                    $_SESSION['user'] = $user;
                    $this->_loggedin = true;
                    return $user['id'];
                }
                return 3;
            } catch (PDOexception $e) {
                return 2;
            }
        }
        return 1;
    }

    public function regiser($email, $voornaam, $tussenvoegsel, $achternaam, $telefoon, $city, $address, $zipcode, $role = 2, $gebruikersnaam, $wachtwoord) {
        try {
            if($gebruikersnaam == null || $gebruikersnaam == '') {
                $query = $this->_db->prepare('
                    INSERT INTO user (`email`, `first_name`, `insertion`, `last_name`, `phonenumber`, `city`, `address`, `zipcode`, `role`)
                    VALUES (:email, :voornaam, :tussenvoegsel, :achternaam, :telefoon, :city, :address, :zipcode, :role);
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
            } else {
                $query = $this->_db->prepare('
                    INSERT INTO user (`email`, `first_name`, `insertion`, `last_name`, `phonenumber`, `city`, `address`, `zipcode`, `role`)
                    VALUES (:email, :voornaam, :tussenvoegsel, :achternaam, :telefoon, :city, :address, :zipcode, :role);
                    
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

                $hash1 = sha1(time().$randomdi1.$email);
                $hash2 = sha1(time().$randomdi2.$email);

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
}