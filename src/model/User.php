<?php

namespace app\model;

use app\config\DatabaseHandler;
use app\config\PasswordConfig;

    class User extends BaseModel{

        private $table_name = 'users_tb';

        function __construct(DatabaseHandler $databaseHandler)
        {
            parent::__construct($databaseHandler);
        }

        function createNewUser(array $payload){

            if( $this->isUserExist($payload["user_email"]) ){
                $hashedPassword = PasswordConfig::encodePassword($payload["user_password"]);
                $payload["user_password"] = $hashedPassword;
                $sql = "INSERT INTO $this->table_name(user_slug, user_first_name, user_last_name, user_email, user_phone_number, user_gender, user_password)
                         VALUES(:user_slug, :user_firstName, :user_lastName, :user_email, :user_phoneNumber, :user_gender, :user_password)";
                $response = $this->insert($sql, $payload, "user_slug");
                return $response;
            }
            return "exist";
        }


        function findUserBySlug(string $slug ): array{
            $sql = "SELECT * FROM $this->table_name WHERE user_slug=?";
            $response = $this->fetch($sql, [$slug]);
            return $response;
        }

        function updateUserPassword(int $id, string $password){
            $passwordHash = PasswordConfig::encodePassword($password);
 
            $sql = "UPDATE $this->table_name SET 
                user_password = :user_password, updatedAt = :updatedAt WHERE user_id = :user_id";

            $data = ['user_password' => $passwordHash, 'user_id' => $id];
            return ($this->update($sql, $data));
         }

         function findUserByEmail(string $email): array{
            $sql = "SELECT * FROM $this->table_name WHERE user_email=?";
            $response = $this->fetch($sql, [$email]);
            return $response;
         }


         function updateUserProfile(array $updateUser){
 
            $sql = "UPDATE $this->table_name SET 
                    user_email = :user_email, user_first_name = :user_firstName, user_last_name = :user_lastName,
                    user_phone_number = :user_phoneNumber, user_gender = :user_gender, updatedAt = :updatedAt 
                    WHERE user_slug = :user_slug";
 
             if($this->update($sql, $updateUser)){
                 return $this->findUserByEmail($updateUser["user_email"]);
             }
             return false;
         }
                
        function findAllUser(): array{
            $sql = "SELECT * FROM $this->table_name";
            $response = $this->fetchMany($sql);
            return $response;
        }
        
        function modifyUserStatus(int $userId, int $status){
            $sql = "UPDATE $this->table_name SET user_status = :user_status, updatedAt = :updatedAt WHERE user_id = :user_id";
            return $this->update($sql, ['user_id' => $userId, 'user_status' => $status]);
        }

        // check for user
        private function isUserExist($email){
            $sql = "SELECT user_slug from $this->table_name WHERE user_email=?";
            $stmt = $this->query($sql, [$email]);
            return $stmt->rowCount() == 0; 
        }
       
    }

?>
