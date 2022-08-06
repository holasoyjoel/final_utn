<?php
    require_once "./model/database/database.model.php";
    require_once "./controller/menu.controller.php";

    if(!isset($_REQUEST["controller"])){
        
        $controller = new MenuController();
        call_user_func(array($controller , "Index"));

    }
    else{

        $controller = strtolower($_REQUEST["controller"]); // se guarda y se formatea el controllador obtenido
        $accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "Index"; // se asigna la acción pasada por REQUEST o en caso de no haber acción se guarda la acción Index

        require_once "controller/$controller.controller.php"; // llama al controlador que se capturo de REQUEST
        $controller = ucwords($controller)."Controller"; // formateo con el nombre de la clase del controllador ej: NombreController
        $controller = new $controller(); // se hace instancia de la clase del controlador NombreController

        call_user_func(array($controller , $accion));
    }

?>