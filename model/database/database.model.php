<?php
    class DataBase {
        private static $instance = null;
        private $pdo;

        protected  function __CONSTRUCT(){
            $this->pdo = new PDO("mysql:host=localhost;dbname=proyecto_peluqueria;charset=utf8" , "root" , "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }

        public static function getInstancia(){
            if(!self::$instance)
            {
                self::$instance = new DataBase();
            }
            return self::$instance;
        }

        public function Conectar(){
            return $this->pdo;
        }
    }
?>