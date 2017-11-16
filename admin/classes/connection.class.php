<?php

class Connection {

    private $_db;

    public function databaseConnection() {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=vanelles', 'root', '');
            return $this->_db;
        } catch (PDOException $e) {
            echo "<h3>Let op</h3>Er is helaas een probleem met het verbinden van de server, probeer het later nog eens.";
            exit;
        }
    }

    public function createTables() {
        $this->_db = $this->databaseConnection();

        $msg = ['done' => [], 'error' => []];
        $query = $this->_db->prepare('
            CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(250) NOT NULL,
  `achternaam` varchar(250) NOT NULL,
  `gebruikersnaam` varchar(255) NOT NULL,
  `wachtwoord` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `rank` int(1) NOT NULL DEFAULT \'1\',
  `hash` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`);
  ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;
  INSERT INTO `user` (`id`, `voornaam`, `achternaam`, `gebruikersnaam`, `wachtwoord`, `email`, `rank`, `hash`, `salt`) VALUES
(0, \'Admin\', \'KBS\', \'admin\', \'daec7747c22df563deac8027abc9d1f3af3ebbb3\', \'nick@twesq.com\', 1, \'60fa7364549a0d19f0d6cfc5c05a5d962dc0483a\', \'00c52199eb6b3c4d086f71e082205ebbb11a4943\');
        ');

        if($query->execute()) {
            array_push($msg['done'], "User Table");
        } else {
            array_push($msg['error'], "User Table");
        }
        return $msg;
    }

}