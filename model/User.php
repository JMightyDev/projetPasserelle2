<?php

class User extends Manager {
    
    private $_email;
    private $_password;
    private $_username;
    private $_userId;

    public function getEmail() {
        return $this->_email;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function getUserId() {
        return $this->_userId;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function setPassword($password) {
        $this->_password = Security::encrypt($password);
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function setUserId($userId) {
        $this->_userId = $userId;
    }

    public function __construct($email, $password, $username) {
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setUsername($username);
    }

}