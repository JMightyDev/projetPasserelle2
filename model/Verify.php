<?php

class Verify {
  
    static function isValidEmail($email) {
        // Retourne true si l'email est valide, false dans le cas contraire.
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
