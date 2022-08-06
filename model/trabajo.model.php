<?php

    class Trabajo 
    {
        public $pdo;
        public $id;
        public $idCliente;
        public $idPersonal;
        public $titulo;
        public $descripcion;
        public $fecha;
        private static $instanciaTrabajo = null;

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
            if(!self::$instanciaTrabajo){
                self::$instanciaTrabajo = new Trabajo();
            }

            return self::$instanciaTrabajo;
        }

        // LISTAR
        public function Listar()
        {
            try
            {
                $query = $this->pdo->prepare("SELECT CONCAT(c.apellido , ' ' , c.nombre) as 'cliente' , CONCAT(p.apellido , ' ' , p.nombre) as 'personal' , t.id , t.titulo , t.descripcion , t.fecha FROM Trabajos as t INNER JOIN Clientes as c ON t.idCliente = c.id INNER JOIN Personales as p ON t.idPersonal = p.id ORDER BY fecha DESC");
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);       
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }


        // OBTENER POR IDTrabajo
        public function ObtenerPorIdTrabajo($id)
        {
            try
            {
                $query = $this->pdo->prepare("SELECT * FROM Trabajos WHERE id = ?");
                $query->execute(array($id));
                return $query->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // Obtener Por idTrabajo (detalle de trabajo)
        public function ObtenerDetalleTrabajo($id)
        {
            try
            {
                $query = $this->pdo->prepare("SELECT CONCAT(c.apellido , ' ' , c.nombre) as 'cliente' , CONCAT(p.apellido , ' ' , p.nombre) as 'personal' , t.id , t.titulo , t.descripcion , t.fecha FROM Trabajos as t INNER JOIN Clientes as c ON t.idCliente = c.id INNER JOIN Personales as p ON t.idPersonal = p.id WHERE t.id = ?");
                $query->execute(array($id));
                return $query->fetch(PDO::FETCH_OBJ);       
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
       
        // ELIMINAR TRABAJO
        public function Eliminar($id)
        {
            try
            {
                $query = $this->pdo->prepare("DELETE FROM Trabajos WHERE id = ?");
                $query->execute(array($id));
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // ELIMINAR TODOS LOS TRABAJOS DE UN CLIENTE
        public function EliminarTrabajosCliente($id)
        {
            try
            {
                $query = $this->pdo->prepare("DELETE FROM Trabajos WHERE idCliente = ?");
                $query->execute(array($id));
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // ELIMINAR TODOS LOS TRABAJOS DE UN PERSONAL
        public function EliminarTrabajosPersonal($id)
        {
            try
            {
                $query = $this->pdo->prepare("DELETE FROM Trabajos WHERE idPersonal = ?");
                $query->execute(array($id));
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
                $sql = "UPDATE Trabajos SET
                        idCliente = ?,
                        idPersonal = ?,
                        titulo = ?,
                        descripcion = ?
                        WHERE id = ?";
                $query = $this->pdo->prepare($sql);
                $query->execute(array(
                    $datos->idCliente,
                    $datos->idPersonal,
                    $datos->titulo,
                    $datos->descripcion,
                    $datos->id
                ));
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

        // REGISTRAR
        public function Registrar(Trabajo $datos)
        {
            try
            {
                $sql = "INSERT INTO Trabajos(idCliente , idPersonal , titulo , descripcion , fecha) VALUES(? , ? , ? , ? , ?)";
                $query = $this->pdo->prepare($sql);
                $query->execute(array(
                    $datos->idCliente,
                    $datos->idPersonal,
                    $datos->titulo,
                    $datos->descripcion,
                    $datos->fecha,
                ));
            }
            catch(Exception $e)
            {
                die ($e->getMessage());
            }
        }


         // FILTRAR
         public function Filtrar($termino)
         {
             try
             {
                 $query = $this->pdo->prepare("SELECT CONCAT(c.apellido , ' ' , c.nombre) as 'cliente' , CONCAT(p.apellido , ' ' , p.nombre) as 'personal' , t.id , t.titulo , t.descripcion , t.fecha FROM Trabajos as t INNER JOIN Clientes as c ON t.idCliente = c.id INNER JOIN Personales as p ON t.idPersonal = p.id  WHERE  (c.nombre LIKE '$termino%' OR c.apellido LIKE '$termino%' OR CONCAT(c.apellido,' ' , c.nombre) LIKE '$termino%') OR (p.nombre LIKE '$termino%' OR p.apellido LIKE '$termino%' OR CONCAT(p.apellido,' ' , p.nombre) LIKE '$termino%') ORDER BY fecha DESC");
                 $query->execute();
                 return $query->fetchAll(PDO::FETCH_OBJ);       
             }
             catch(Exception $e)
             {
                 die($e->getMessage());
             }
         }
    }
?>