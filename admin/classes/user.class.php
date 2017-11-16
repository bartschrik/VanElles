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
                $query = $this->_db->prepare('SELECT * FROM user WHERE email=:email;');
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
                $query = $this->_db->prepare('SELECT * FROM user WHERE gebruikersnaam=:gebruikersnaam;');
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
                $query = $this->_db->prepare('SELECT * FROM user WHERE hash = :hash');
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

    public function regiser($voornaam, $achternaam, $email, $wachtwoord, $gebruikersnaam) {
        try {
            $query = $this->_db->prepare('
                INSERT INTO `user`(`voornaam`, `achternaam`, `wachtwoord`, `gebruikersnaam`, `email`, `hash`, `salt`) 
                VALUES (:voornaam,:achternaam,:wachtwoord,:gebruikersnaam,:email,:hash,:salt)
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

            $hash1 = sha1(time().$randomdi1.$email);
            $hash2 = sha1(time().$randomdi2.$email);

            $query->bindValue(":voornaam", $voornaam, PDO::PARAM_STR);
            $query->bindValue(":achternaam", $achternaam, PDO::PARAM_STR);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->bindValue(":wachtwoord", sha1($hash2.$wachtwoord), PDO::PARAM_STR);
            $query->bindValue(":gebruikersnaam", $gebruikersnaam, PDO::PARAM_STR);
            $query->bindValue(":hash", $hash1, PDO::PARAM_STR);
            $query->bindValue(":salt", $hash2, PDO::PARAM_STR);

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

    public function isLoggedIn() {
        return $this->_loggedin;
    }
}