<?php

    namespace app\requests;
    use app\helper\Validation;

    class UserRequest{

        private $data;
        private $validationStatus = false;

        function __construct(array $userInfo)
        {
            $this->validation($userInfo);   
        }

        private function validation(array $user){
            if(
                count($user) == 4 &&
                Validation::isSize($user["username"], 5) &&
                Validation::isEmail($user["email"]) &&
                Validation::isSize($user["password"], 5) &&
                (Validation::isSize($user["referredBy"], 5) || $user["referredBy"] == "nil" )
            ){
                $this->data["user_username"] = $user["username"];
                $this->data["user_email"] = $user["email"];
                $this->data["user_password"] = $user["password"];
                $this->data["referral_referredby"] = $user["referredBy"];
                $this->validationStatus = true;
            }
        }

        function isValid(): bool{
            return $this->validationStatus;
        }

        function get():array { return $this->data;}

    }

?>