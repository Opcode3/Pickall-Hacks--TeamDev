<?php

    namespace app\services;

use app\config\MysqlDBH;
use app\config\PasswordConfig;
use app\model\User;
use app\response\Response;
use app\services\impl\UserServiceImpl;
use Roles;

    class UserService implements UserServiceImpl{

        private $model;

        function __construct() 
        {
            $mysqlConnector = new MysqlDBH();
            $this->model = new User($mysqlConnector);
        }

        function setNewUser(array $data): string 
        {
            $email = $data["user_email"];
            $password = $data["user_password"];
            $response = $this->model->createNewUser($data);
            if(is_bool($response)){
                if($response){
                    return Response::json("New User registration was successful!", 201);
                }
                return Response::json("An error was encountered while trying to register user details!", 500);
            }
            return Response::json("The user detail already exist in our system!", 302);
        }

        function userAuthenticationByEmail(string $username, string $password): string{
            $response = $this->model->findUserByEmail($username);
            if(count($response) > 5){
                $passwordHash = $response["user_password"];
                if(PasswordConfig::decodePassword($password, $passwordHash)){
                    return Response::json($response, 200);
                }
                return Response::json("Your password is not recognized!", 403);
            }
            return Response::json("Your username is not recognized!", 403);
        }

        function getUsersCount(): int
        {
            $response = $this->model->findAllUser();
            return count($response);
        }

        function getUsers(): string
        {
            $response = $this->model->findAllUser();
            return Response::json($response, 200);
        }
    }

?>