<?php
    namespace Main;

    class MySql{

        private static $pdo;

        public static function connect(){
            if(self::$pdo == null){
                try {
                    self::$pdo = new \PDO('mysql:host=localhost;dbname=southnetwork', 'southnetwork','15082005@Joao',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    echo 'Erro ao conectar';
                    error_log($e->getMessage());
                }
            }
            return self::$pdo;
        }

    }

?>