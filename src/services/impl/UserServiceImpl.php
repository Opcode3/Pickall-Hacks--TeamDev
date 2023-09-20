<?php

    namespace app\services\impl;
    
    interface UserServiceImpl{

        function setNewUser(array $data): string;
        function userAuthenticationByEmail(string $email, string $password): string;
    }

?>