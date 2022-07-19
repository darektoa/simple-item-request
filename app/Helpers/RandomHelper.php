<?php

namespace App\Helpers;

class RandomHelper{
    static public function code($length=8) {
        $code   = random_bytes($length/2);
        $code   = bin2hex($code);
        
        return $code;
    }
}