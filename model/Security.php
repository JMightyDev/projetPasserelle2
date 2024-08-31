<?php

class Security {
    static function encrypt($password) {
        return sha1($_ENV['SALT'].sha1($_ENV['SALT'].$password.$_ENV['SALT']).$_ENV['SALT']);
    }
}