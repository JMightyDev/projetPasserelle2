<?php

class Manager {
    protected function connection() {
        try {
            $host       = getenv('DB_HOST');
            $dbname     = getenv('DB_NAME');
            $login      = getenv('DB_USER');
            $password   = getenv('DB_PASSWORD');
            $port       = getenv('DB_PORT');
            $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;port=$port", $login, $password);
        }
        catch(Exception $e) {
            die('Error : '.$e->getMessage());
        }
        return $bdd;
    }
}