<?php
    require_once "model/cliente.model.php";
    class ClienteController
    {
        private $model;

        // CONSTRUCTOR
        public function __CONSTRUCT()
        {
            $this->model = Cliente::getInstancia();
        }

        // INDEX
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
            require_once "view/cliente/cliente.view.php";   
        }

        // CRUD
        public function Crud()
        {
            $almacenar = Cliente::getInstancia();

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
            require_once "view/cliente/cliente-editar.view.php";

            // dar foco al txtDni cuando el usuario puso dni duplicado para que vuelva a escribirlo
            if(isset($_COOKIE["datos"])){ echo "<script> $('#txtDni').focus().addClass('border-danger'); </script>"; }
        }

        // GUARDAR
        public function Guardar()
        {
            $almacenar = Cliente::getInstancia();

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
            if(isset($almacenar->telefono)){setcookie("telefono" , $almacenar->telefono , time() + (60*10)); }
            
            if($almacenar->id > 0)
            {
                $this->model->Actualizar($almacenar);
                echo "<script>alert('Cliente Actualizado con Exito')</script>";
                header("Refresh:1; index.php?controller=Cliente" , true , 303);
            }
            else
            {
                $clienteEncontrado = $this->model->ObtnerPorDni($_REQUEST["dni"]);

                if(empty($clienteEncontrado) == 1)
                {
                    $this->model->Registrar($almacenar);
                    echo "<script>alert('Cliente Registrado con Exito')</script>";
                    header("Refresh:1; index.php?controller=Cliente" , true , 303);
                }
                else
                {
                    echo "<script>alert('Ya existe un cliente con ese dni')</script>";
                    header("Refresh:1; index.php?controller=Cliente&accion=Crud" , true , 303);
                }
            }
        }

        // ELIMINAR
        public function Eliminar()
        {
            require_once "model/trabajo.model.php";
            $trabajo = Trabajo::getInstancia();
            $trabajo->EliminarTrabajosCliente($_REQUEST["id"]);
            
            $this->model->Eliminar($_REQUEST["id"]);
            echo "<script>alert('Cliente eliminado')</script>";
            header("Refresh:1; index.php?controller=Cliente");
        }


        // FILTRAR
        public function Filtrar()
        {
            $almacenar = Cliente::getInstancia();

            $almacenar->termino = strtolower($_REQUEST["termino"]);
            $almacenar->filtrar = true;
            $this->model->Filtrar($almacenar->termino);
            require_once "view/menu.view.php";
            require_once "view/cliente/cliente.view.php";
        }

        // VER DETALLE
        public function VerDetalle()
        {
            $almacenar = Cliente::getInstancia();
            
            $almacenar = $this->model->ObtenerPorId($_REQUEST["id"]);
            require_once "view/menu.view.php";
            require_once "view/components/formularioDetalleClientePersonal.php";
        }
    }
?>