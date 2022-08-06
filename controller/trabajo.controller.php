<?php
    require_once "model/trabajo.model.php";

    class TrabajoController
    {
        private $model;

        public function __CONSTRUCT()
        {
            $this->model = Trabajo::getInstancia();
        }

        public function Index()
        {            
            require_once "view/menu.view.php";
            require_once "view/trabajo/trabajo.view.php";   
        }

        public function Crud()
        {
            $almacenar = Trabajo::getInstancia();
            if(isset($_REQUEST["id"]))
            {
                // $almacenar = $this->model->ObtenerPorIdTrabajo($_REQUEST["id"]);
                $almacenar = $this->model->ObtenerDetalleTrabajo($_REQUEST["id"]);
            }
           
            require_once "view/menu.view.php";
            require_once "view/trabajo/trabajo-editar.view.php";

        }

        public function Guardar()
        {
            $almacenar = Trabajo::getInstancia();
            $almacenar->id = $_REQUEST["id"];
            $almacenar->idCliente = strtolower($_REQUEST["idCliente"]);
            $almacenar->idPersonal = strtolower($_REQUEST["idPersonal"]);
            $almacenar->titulo = strtolower($_REQUEST["titulo"]);
            $almacenar->descripcion = strtolower($_REQUEST["descripcion"]);
            $almacenar->fecha = strtolower($_REQUEST["fecha"]);


            if($almacenar->id > 0)
            {
                $this->model->Actualizar($almacenar);
                echo "<script>alert('Trabajo Actualizado con Exito')</script>";
                header("Refresh:1; index.php?controller=Trabajo" , true , 303);
            }
            else
            {
                $this->model->Registrar($almacenar);
                echo "<script>alert('Trabajo Registrado con Exito')</script>";
                header("Refresh:1; index.php?controller=Trabajo" , true , 303);
            }
        }


        public function Eliminar()
        {
            $this->model->Eliminar($_REQUEST["id"]);
            echo "<script>alert('Trabajo eliminado')</script>";
            header("Refresh:1; index.php?controller=Trabajo");
        }

        public function Filtrar()
        {
            $almacenar = Trabajo::getInstancia();
            $almacenar->termino = strtolower($_REQUEST["termino"]);
            $almacenar->filtrar = true;
            $this->model->Filtrar($almacenar->termino);
            require_once "view/menu.view.php";
            require_once "view/trabajo/trabajo.view.php";
        }

        public function VerDetalle()
        {
            $almacenar = Trabajo::getInstancia();
            $almacenar = $this->model->ObtenerDetalleTrabajo($_REQUEST["id"]);
            require_once "view/menu.view.php";
            require_once "view/components/formularioDetalleTrabajos.php";
        }
    }
?>