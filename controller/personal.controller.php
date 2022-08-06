<?php
    require_once "model/personal.model.php";

    class PersonalController
    {
        private $model;

        public function __CONSTRUCT()
        {
            $this->model = Personal::getInstancia();
        }

        public function Index()
        {
            // vaciando cookies
            setcookie("datos" , "" ,time()+(60*10));
            setcookie("nombre" , "" ,time()+(60*10));
            setcookie("apellido" , "" ,time()+(60*10));
            setcookie("sexo" , "" ,time()+(60*10));
            setcookie("telefono" , "" ,time()+(60*10));
            setcookie("direccion" , "" ,time()+(60*10));

            // llamar a las vistas
            require_once "view/menu.view.php";
            require_once "view/personal/personal.view.php";   
        }

        public function Crud()
        {
            $almacenar = Personal::getInstancia();
            
            if(isset($_REQUEST["id"]))
            {
                $almacenar = $this->model->ObtenerPorId($_REQUEST["id"]);
            }
           else
           {
               if(isset($_COOKIE["datos"]))
               {
                   // pasando datos de las cookies por $almacenar
                   $almacenar->nombre = $_COOKIE["nombre"];
                   $almacenar->apellido = $_COOKIE["apellido"];
                   $almacenar->sexo = $_COOKIE["sexo"];
                   $almacenar->telefono = isset($_COOKIE["telefono"]) ? $_COOKIE["telefono"] : "";
                   $almacenar->direccion = $_COOKIE["direccion"];
                }
            }
            require_once "view/menu.view.php";
            require_once "view/personal/personal-editar.view.php";

            // dar foco al txtDni cuando el usuario puso dni duplicado para que vuelva a escribirlo
            if(isset($_COOKIE["datos"]))
            {
                echo "<script>
                    $('#txtDni').focus().addClass('border-danger');
                </script>";
            }
        }

        public function Guardar()
        {
            $almacenar = Personal::getInstancia();

            $almacenar->id = $_REQUEST["id"];
            $almacenar->nombre = strtolower($_REQUEST["nombre"]);
            $almacenar->apellido = strtolower($_REQUEST["apellido"]);
            $almacenar->dni = strtolower($_REQUEST["dni"]);
            $almacenar->sexo = strtolower($_REQUEST["sexo"]);
            $almacenar->telefono = strtolower($_REQUEST["telefono"]);
            $almacenar->direccion = strtolower($_REQUEST["direccion"]);

            // guardar datos temporalmente en cookies
            setcookie("datos" , true , time() + (60*10));
            setcookie("nombre" , $almacenar->nombre , time() + (60*10));
            setcookie("apellido" , $almacenar->apellido , time() + (60*10));
            setcookie("sexo" , $almacenar->sexo , time() + (60*10));
            setcookie("direccion" , $almacenar->direccion , time() + (60*10));
            if(isset($almacenar->telefono)){ setcookie("telefono" , $almacenar->telefono , time() + (60*10)); }


            if($almacenar->id > 0)
            {
                $this->model->Actualizar($almacenar);
                echo "<script>alert('Personal actualizado con exito')</script>";
                header("Refresh:1; index.php?controller=Personal" , true , 303);
            }
            else
            {
                $personalEncontrado = $this->model->ObtnerPorDni($_REQUEST["dni"]);
                if(empty($personalEncontrado) == 1)
                {
                    $this->model->Registrar($almacenar);
                    echo "<script>alert('Personal registrado con exito')</script>";
                    header("Refresh:1; index.php?controller=Personal" , true , 303);
                }
                else
                {
                    echo "<script>alert('Ya existe un personal con ese dni')</script>";
                    header("Refresh:1; index.php?controller=Personal&accion=Crud" , true , 303);
                }
            }
        }
        
        
        public function Eliminar()
        {
            require_once "model/trabajo.model.php";
            $trabajo = Trabajo::getInstancia();
            $trabajo->EliminarTrabajosPersonal($_REQUEST["id"]);
            
            $this->model->Eliminar($_REQUEST["id"]);
            header("Refresh:1; index.php?controller=Personal");
        }


        public function VerDetalle()
        {
            
            $almacenar = Personal::getInstancia();
            $almacenar = $this->model->ObtenerPorId($_REQUEST["id"]);
            require_once "view/menu.view.php";
            require_once "view/components/formularioDetalleClientePersonal.php";
        }
    }
?>