<div class="align-items-center d-flex flex-row justify-content-between">
    <input type="text" name="termino" autocomplete="off" placeholder="Buscar . . ." id="cajaBuscar" class="form-control w-100 text-capitalize" value="<?php echo isset($almacenar->termino)? $almacenar->termino: "";?>">
    <a href="" class="border btn btn-primary ms-3 w-50" id="btnBuscar">Buscar</a>
    <a href="?controller=Cliente" class="border btn btn-secondary ms-3 w-50" id="btnVerTodos">Ver Todos</a>
</div>

<script>
    $(document).ready(function(){

        // obtener el controlador
        let controlador = new URLSearchParams(document.location.search).get("controller");

        // seteando el href de verTodos con el controlador correspondiente
        $("#btnVerTodos").attr("href" , `?controller=${controlador}`)

        // creacion de variable termino en caso de filtrar y asignación del termino a buscar
        let termino = "";
        
        $("#cajaBuscar").change(function(){
            termino = $("#cajaBuscar")[0].value;
        })

        // evento click en boton buscar
        $("#btnBuscar").click(function(){
            if(termino != "")
            {
                $("#btnBuscar").attr("href" , `?controller=${controlador}&accion=Filtrar&termino=${termino}`); // se filtra en caso que haya algun termino
            }
            else
            {
                $("#btnBuscar").attr("href" , `?controller=${controlador}`); // no se filtra en caso de que no haya termino
            }
        })
    })
</script>
