<?php

    namespace app\requests;

use app\helper\Validation;

    class PlanRequest{

        private $data;
        private $validationStatus = false;

        function __construct(array $planInfo)
        {
            $this->validation($planInfo);   
        }

        private function validation(array $plan){
            if(
                count($plan) == 4 &&
                Validation::isSize($plan["title"], 4) &&
                Validation::isSize($plan["description"], 4) &&
                Validation::isNumber((int) $plan["min_amount"]) &&
                Validation::isNumber((int) $plan["max_amount"])

            ){
                $this->data["plan_title"] = $plan["title"];
                $this->data["plan_description"] = $plan["description"];
                $this->data["plan_min_amount"] = $plan["min_amount"];
                $this->data["plan_max_amount"] = $plan["max_amount"];
                $this->validationStatus = true;
            }
        }

        function isValid(): bool{
            return $this->validationStatus;
        }

        function get():array { return $this->data;}

    }

?>