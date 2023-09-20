<?php
    namespace app\config;
    
    class PasswordConfig{

        public static function decodePassword(string $password, string $hash): bool{
            return password_verify($password, $hash);
        }

        public static function encodePassword(string $password){
            $hash = password_hash($password, PASSWORD_BCRYPT);
            return $hash;
        }

    }

?>