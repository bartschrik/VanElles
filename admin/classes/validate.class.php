<?php

class Validate {

    private $_errors = [];

    public function __construct($items)
    {
        //Item[0] = De naam van het veld of value
        //Item[1] = De value
        //Item[2] = De rules in een array
        //Rule[0] = De rule
        //Rule[1] = De parameter van de rule, kan leeg zijn
        foreach ($items as $item) {
            $rules = explode('|', $item[2]);
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                switch ($rule[0]) {
                    case 'required':
                        $item[1] = trim($item[1]);
                        if(!$this->required($item[1])) {
                            $this->addError($item[0], ucfirst($item[0]) . " is een verplicht veld.");
                        }
                        break;
                    case 'min':
                        $item[1] = trim($item[1]);
                        if($this->min_length($item[1], $rule[1])) {
                            $this->addError($item[0], "Het $item[0] moet bestaan uit minimaal $rule[1] characters.");
                        }
                        break;
                    case 'max':
                        $item[1] = trim($item[1]);
                        if($this->max_length($item[1], $rule[1])) {
                            $this->addError($item[0], "Het $item[0] mag maximaal $rule[1] characters bevatten.");
                        }
                        break;
                    case 'email':
                        $item[1] = trim($item[1]);
                        if($this->email($item[1])) {
                            $this->addError($item[0], "Dit is geen geldig e-mail adres.");
                        }
                        break;
                    case 'num':
                        $item[1] = trim($item[1]);
                        if($this->numeric($item[1])) {
                            $this->addError($item[0], ucfirst($item[0] . " is niet numeric."));
                        }
                        break;
                    case 'uni':
                        if(!$this->unique($item[1], $rule[1], $rule[2])) {
                            $this->addError($item[0], ucfirst($item[0] . " bestaat al in onze database."));
                        }
                        break;
                    case 'imgrequired':
                        if(!$this->imgrequired($item[1])) {
                            $this->addError($item[0], ucfirst($item[0] . " is een verplicht veld."));
                        }
                        break;
                    case 'validphoto':
                        if(!$this->validPhoto($item[1])) {
                            $this->addError($item[0], ucfirst($item[0] . " is geen geldige invoer."));
                        }
                        break;
                    case 'requiredsel':
                        if(!$this->requiredsel($item[1])) {
                            $this->addError($item[0], ucfirst($item[0] . " is een verplicht veld."));
                        }
                        break;
                }
            }
        }
    }

    public function min_length($value, $param)
    {
        return (strlen($value) < $param);
    }

    public function max_length($value, $param)
    {
        return (strlen($value) > $param);
    }

    public function email($value)
    {
        if($value) {
            return !filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }

    public function required($value)
    {
        return (strlen($value) !== 0);
    }

    public function requiredsel($value)
    {
        if($value == 0) {
            return false;
        }
        return true;
    }

    public function numeric($value)
    {
        return !(is_numeric($value));
    }

    private function unique($value, $table, $colom) {
        $db = new Connection();
        $db = $db->databaseConnection();

        $query = $db->prepare("SELECT * FROM $table WHERE $colom = :val;");
        $query->bindValue(":val", $value, PDO::PARAM_STR);
        if($query->execute()) {
            if($query->rowCount() > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            print_r($query->errorInfo());
            return false;
        }
    }

    private function addError($key, $value) {
        if(key_exists($key, $this->_errors)) {
            array_push($this->_errors[$key], $value);
        } else {
            $this->_errors[$key] = [$value];
        }
    }

    public function imgrequired($data) {
        return ($data['error'] === UPLOAD_ERR_OK);
    }

    public function validPhoto($data) {
        if(is_array($data["tmp_name"])) {
            foreach ($data["tmp_name"] as $key=>$tmp_name) {

                if($data['error'][$key] !== UPLOAD_ERR_NO_FILE) {
                    $filename = strtolower($data['name'][$key]);
                    $filetype = strtolower($data['type'][$key]);

                    //check if contain php and kill it
                    $pos = strpos($filename,'php');
                    if(!($pos === false)) {
                        return false;
                    }

                    //get the file ext
                    $file_ext = strrchr($filename, '.');

                    //check if its allowed or not
                    $whitelist = array(".jpg",".jpeg",".gif",".png");
                    if (!(in_array($file_ext, $whitelist))) {
                        return false;
                    }


                    //check upload type
                    $pos = strpos($filetype,'image');
                    if($pos === false) {
                        return false;
                    }
                    $imageinfo = getimagesize($data['tmp_name'][$key]);
                    if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg'&& $imageinfo['mime']      != 'image/jpg'&& $imageinfo['mime'] != 'image/png') {
                        return false;
                    }
                }

            }
        } else {
            if($data['error'] !== UPLOAD_ERR_NO_FILE) {
                $filename = strtolower($data['name']);
                $filetype = strtolower($data['type']);

                //check if contain php and kill it
                $pos = strpos($filename,'php');
                if(!($pos === false)) {
                    return false;
                }

                //get the file ext
                $file_ext = strrchr($filename, '.');

                //check if its allowed or not
                $whitelist = array(".jpg",".jpeg",".gif",".png");
                if (!(in_array($file_ext, $whitelist))) {
                    return false;
                }


                //check upload type
                $pos = strpos($filetype,'image');
                if($pos === false) {
                    return false;
                }
                $imageinfo = getimagesize($data['tmp_name']);
                if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg'&& $imageinfo['mime']      != 'image/jpg'&& $imageinfo['mime'] != 'image/png') {
                    return false;
                }
            }
        }
        return true;
    }

    public function getErrors() {
        return $this->_errors;
    }

    public function isPassed() {
        if(empty($this->_errors))
            return true;
        return false;
    }
}