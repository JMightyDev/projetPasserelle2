<?php

class Manager {
    protected function connection() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=projet_passerelle_2;charset=utf8', 'root', '');
        }
        catch(Exception $e) {
            die('Error : '.$e->getMessage());
        }
        return $bdd;
    }
}