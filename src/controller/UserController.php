<?php

namespace app\controller;

use app\requests\UserRequest;
use app\requests\UserUpdateRequest;
use app\response\Response;
use app\services\UserService;
use Exception;

    class UserController{

        private $userService;

        function __construct()
        {
            $this->userService = new UserService();
        }

        function fetchAllUsers(){
            return $this->userService->getUsers();
        }

        function registerUser(array $userRequest){
            return $this->userService->setNewUser($userRequest);
        } 

        function loginUser($username, $password){
            return $this->userService->userAuthenticationByEmail($username, $password);
        }

    }

?>