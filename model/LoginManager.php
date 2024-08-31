<?php

require_once('Manager.php');

class LoginManager extends Manager {

    private function getUser($email, $pwd) {
        $bdd = $this->connection();
        $requete = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $requete->execute([$email]);
        while ($user = $requete->fetch()) {
            if ($user['password'] == $pwd) {
                return $user;
            }
        }
        return false;
    } 

    public function autoConnect($secret) {
        $bdd = $this->connection();
        $req = $bdd->prepare('SELECT COUNT(*) AS nb FROM users WHERE secret = ?');
        $req->execute([$secret]);
        while ($res = $req->fetch()) {
            if ($res['nb'] == 1) {
                $req2 = $bdd->prepare('SELECT * FROM users WHERE secret = ?');
                $req2->execute([$secret]);
                while ($user = $req2->fetch()) {
                    $_SESSION['connect'] = 1;
                    $_SESSION['email'] = $user['email'];
                    return true;
                }
            }
        }
        return false;
    }

    public function connect($email, $pwd) {
        //Check if user (email) exist
        if (!$this->emailExist($email)) {
            return false;
        }
        
        //Check if password match & get secret
        $user = $this->getUser($email, $pwd);
        if ($user != false) {
            $_SESSION['connect'] = 1;
            $_SESSION['email']  = $user['email'];
            $_SESSION['userId'] = $user['id'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            $_SESSION['username'] = $user['username'];
            if (isset($_POST['autoconnect'])) {
                setcookie('autoconnect', $user['secret'], time() + 365*24*3600, '/', null, false, true);
            }
            return true;
        } else {
            return false;
        }
    }

    public function emailExist($email) {
        // Retourne true si l'email existe, false dans le cas contraire.
        $bdd = $this->connection();
        $req = $bdd->prepare('SELECT COUNT(*) AS nb FROM users WHERE email = ?');
        $req->execute([$email]);
        while ($res = $req->fetch()) {
            if ($res['nb'] == 0) {
                return false;
            }
            return true;
        }
    }

}