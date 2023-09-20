<?php

    namespace app\response;

    class Response{
        static function json($data, int $status = 404){
            return json_encode([ "message" => $data, "status_code" => $status]);
        }
    }