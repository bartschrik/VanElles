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
                        if(!$this->required($item[1])) {
                            $this->addError($item[0], ucfirst($item[0]) . " is een verplicht veld.");
                        }
                        break;
                    case 'min':
                        if($this->min_length($item[1], $rule[1])) {
                            $this->addError($item[0], "Het $item[0] moet bestaan uit minimaal $rule[1] characters.");
                        }
                        break;
                    case 'max':
                        if($this->max_length($item[1], $rule[1])) {
                            $this->addError($item[0], "Het $item[0] mag maximaal $rule[1] characters bevatten.");
                        }
                        break;
                    case 'email':
                        if($this->email($item[1])) {
                            $this->addError($item[0], "Dit is geen geldig e-mail adres.");
                        }
                        break;
                    case 'num':
                        if($this->numeric($item[1])) {
                            $this->addError($item[0], ucfirst($item[0] . " is niet numeric."));
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
        return !filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function required($value)
    {
        return (strlen($value) !== 0);
    }

    public function numeric($value)
    {
        return !(is_numeric($value));
    }

    private function addError($key, $value) {
        $this->_errors[$key] = $value;
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