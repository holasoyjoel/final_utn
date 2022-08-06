<?php

    class Personal
    {
        public $pdo;
        public $id;
        public $nombre;
        public $apellido;
        public $dni;
        public $sexo;
        public $telefono;
        public $direccion;
        private static $instanciaPersonal = null;

        public function __CONSTRUCT()
        {
            try
            {
                $instanciaDb = DataBase::getInstancia();
                $this->pdo = $instanciaDb->Conectar();
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        
        // SINGLETON
        public static function getInstancia(){
            if(!self::$instanciaPersonal){
                self::$instanciaPersonal = new Personal();
            }

            return self::$instanciaPersonal;
        }


        // LISTAR
        public function Listar()
        {
            try
            {
                $query = $this->pdo->prepare("SELECT * FROM Personales ORDER BY apellido ASC");
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);       
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // OBTENER POR ID
        public function ObtenerPorId($id)
        {
            try
            {
                $query = $this->pdo->prepare("SELECT * FROM Personales WHERE id = ?");
                $query->execute(array($id));
                return $query->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }


            // OBTENER POR DNI
        public function ObtnerPorDni($dni)
        {
            try
            {
                $query = $this->pdo->prepare("SELECT * FROM Personales WHERE dni = ?");
                $query->execute(array($dni));
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // ELIMINAR
        public function Eliminar($id)
        {
            try
            {
                $query = $this->pdo->prepare("DELETE FROM Personales WHERE id = ?");
                $query->execute(array($id));
                echo "<script>alert('Personal eliminado')</script>";

            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // ACTUALIZAR
        public function Actualizar($datos)
        {
            try
            {
                $sql = "UPDATE Personales SET
                        nombre = ?,
                        apellido = ?,
                        dni = ?,
                        sexo = ?,
                        telefono = ?,
                        direccion = ?
                        WHERE id = ?";
                $query = $this->pdo->prepare($sql);
                $query->execute(array(
                    $datos->nombre,
                    $datos->apellido,
                    $datos->dni,
                    $datos->sexo,
                    $datos->telefono,
                    $datos->direccion,
                    $datos->id
                ));
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // REGISTRAR
        public function Registrar(Personal $datos)
        {
            try
            {
                $sql = "INSERT INTO Personales(nombre , apellido , dni , sexo , telefono , direccion) VALUES(? , ? , ? , ? , ? , ?)";
                $query = $this->pdo->prepare($sql);
                $query->execute(array(
                    $datos->nombre,
                    $datos->apellido,
                    $datos->dni,
                    $datos->sexo,
                    $datos->telefono,
                    $datos->direccion
                ));
            }
            catch(Exception $e)
            {
                die ($e->getMessage());
            }
        }

    }
?>