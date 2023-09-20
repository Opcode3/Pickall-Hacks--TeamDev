<?php

    namespace app\requests;

use app\helper\Validation;

    class UserUpdateRequest{

        private $data;
        private $validationStatus = false;

        function __construct(array $userInfo)
        {
            $this->validation($userInfo);   
        }

        private function validation(array $user){
            if(
                count($user) == 8 &&
                Validation::isEmail($user["email_address"]) &&
                Validation::isSize($user["slug"], 0) &&
                Validation::isSize($user["bitcoin"], 0) &&
                Validation::isSize($user["eth"], 0) &&
                Validation::isSize($user["ultra"], 0) &&
                Validation::isSize($user["bnb"], 0) &&
                Validation::isSize($user["usdt"], 0) &&
                Validation::isSize($user["password"], 0)
            ){
                $this->data["user_email"] = $user["email_address"];
                $this->data["user_slug"] = $user["slug"];
                $this->data["user_bitcoin"] = $user["bitcoin"];
                $this->data["user_eth"] = $user["eth"];
                $this->data["user_bnb"] = $user["bnb"];
                $this->data["user_ultra"] = $user["ultra"];
                $this->data["user_usdt"] = $user["usdt"];
                $this->data["user_password"] = $user["password"];
                $this->validationStatus = true;
            }
        }

        function isValid(): bool{
            return $this->validationStatus;
        }

        function get():array { return $this->data;}

    }

?>