<?php

class SubscribeManager extends Manager {

    public function save($user) {
        $bdd = $this->connection();

        $secret = sha1($user->getEmail()).time();
		$secret = sha1($secret).time();

		$req = $bdd->prepare('INSERT INTO users (email, password, secret, username) VALUES (?, ?, ?, ?)');
        $req->execute([$user->getEmail(), $user->getPassword(), $secret, $user->getUsername()]);

        //We get the new userid here to save it on the User object
        $req = $bdd->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$user->getEmail()]);

        while ($res = $req->fetch()) {
            $newUserId = $res['id'];
        }

        $user->setUserId($newUserId);

        return $user;
    }

    public function createSessions($user) {
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['userId'] = $user->getUserId();
        $_SESSION['connect'] = 1;
    }

    public function emailExist($email) {
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