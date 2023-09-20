<?php

use app\controller\UserController;
use app\requests\UserRequest;
use app\response\Response;

require dirname(__DIR__)."../../../vendor/autoload.php";
// echo json_encode(array("name" => "Emmanuel Emeka", "url" => dirname(__DIR__)."/../vendor/autoload.php"));

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $method_type = $_SERVER['REQUEST_METHOD'];
    $request_body = file_get_contents('php://input');


    if($method_type == 'POST'){ 
        $request_data = json_decode($request_body, true);
            if(is_array($request_data) && count($request_data) === 6){
                $userController = new UserController();
                // No request validation inserted
                // echo "Success";
                echo $userController->registerUser($request_data);
            }else{
                echo Response::json("Your request parameter is not sent correctly. Try sending a username and password!", 400);
            }
    }else{
        echo Response::json("You are not authorized to access this endpoint!", 403);
    }
