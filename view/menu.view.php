<?php
    require_once "model/cliente.model.php";
    require_once "model/personal.model.php";

     $cliente = Cliente::getInstancia();
     $clientesEncontrados = $cliente->Listar();

     $personal = Personal::getInstancia();
     $personalEncontrados = $personal->Listar();

    
    $mostrar = "";
    
    if(empty($personalEncontrados) == 0 && empty($clientesEncontrados) == 0)
    {
      
        $mostrar = true;
    }
    else
    {
        
        $mostrar = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Peluqueria Jose</title>

    <style>
        body{
            display: flex;
            flex-direction: row;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        #menu{
            height: 100vh;
            width: 300px;
            min-width: 300px;
            min-height: 300px;
        }
    </style>
</head>
<body>
    <div id="menu" class="ms-1 text-center">
        <div class="border border-ligth h-100 rounded">
            <a href="./index.php" class="text-white text-decoration-none">
                <div class="border-bottom bg-dark fw-bold text-white py-5 text-center">
                    Inicio
                </div>
            </a>

            <div class="list-group list-group-flush">
                <a href="?controller=Cliente" class="fw-bold list-group-item list-group-item-action list-group-item-ligth p-3" id="tabCliente">Clientes</a>
                <a href="?controller=Personal" class="fw-bold list-group-item list-group-item-action list-group-item-ligth p-3" id="tabPersonal">Personal</a>
                <a href="?controller=Trabajo" class=" list-group-item list-group-item-action list-group-item-ligth p-3 <?php echo($mostrar)? "enabled fw-bold" : "disabled" ;?>" id="tabTrabajo" title="hola">Trabajos</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            let controlador = new URLSearchParams(document.location.search).get("controller");
            if(controlador != " ")
            {
                $(`#tab${controlador}`).addClass('bg-secondary text-white');
            }
        })
    </script>
</body>
</html>