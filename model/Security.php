<?php

class Security {
    static function encrypt($password) {
        return sha1("a123".sha1("b456".$password."c789")."d123");
    }
}