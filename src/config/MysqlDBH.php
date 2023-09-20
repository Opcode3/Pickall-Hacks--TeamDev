<?php
    namespace app\config;

    class MysqlDBH implements DatabaseHandler{
        
        // private $username = "giembs11_st_mary_root"; //'root';
        // private $host = "127.0.0.1"; //'127.0.0.1';
        // private $password = "4]zPTVt4Y5.Q"; //'123';
        // private $dbname = "giembs11_st_mary_db"; //'db_cn_001';
        // private $charset = 'utf8mb4';

        
        private $username = 'root';
        private $host = '127.0.0.1';
        private $password = "";
        private $dbname = "pickall_db";
        private $charset = 'utf8mb4';

        private $connectionString;

        function __construct()
        {
            try {
                $dsn = "mysql:host=$this->host;charset=$this->charset;dbname=$this->dbname";
                $this->connectionString = new \PDO($dsn, $this->username, $this->password);
            } catch (\Exception $ex) {
                echo('Unable to access server...');
            }   
        }

        function connection()
        {
           return $this->connectionString;
        }
    }
?>