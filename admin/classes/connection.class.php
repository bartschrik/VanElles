<?php

class Connection {

    private $_db;

    /**
     * Start database connectie
     * @return PDO
     */
    public function databaseConnection() {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=vanelles', 'root', '');
            return $this->_db;
        } catch (PDOException $e) {
            echo "<h3>Let op</h3>Er is helaas een probleem met het verbinden van de server, probeer het later nog eens.";
            exit;
        }
    }

}