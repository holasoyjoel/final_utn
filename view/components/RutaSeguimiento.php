<li>
    <a href="" id="rutaPrincipal" class="text-decoration-none me-2"></a> 
    <?php
        if(isset($almacenar->cliente) && isset($almacenar->personal))
        {
            echo "<span id='rutaSecundaria' class='sm-1  text-capitalize '></span>";
            echo "<span id='rutaTerciaria' class='sm-1 ms-1 text-capitalize'>". ($almacenar->cliente) . "</span>";
        }
        else
        {
            echo "<span id='rutaSecundaria' class='sm-1  text-capitalize '></span>";
            echo "<span id='rutaTerciaria' class='sm-1 ms-1 text-capitalize'>". ($almacenar->id != null ? $almacenar->apellido . ' ' . $almacenar->nombre : '') . "</span>";
        }
    ?>
</li>

<script>
    $(document).ready(function(){

        let controlador = new URLSearchParams(document.location.search).get("controller");
        let accion = new URLSearchParams(document.location.search).get("accion");
        let id = new URLSearchParams(document.location.search).get("id");

        // formate de ruta principal
        $("#rutaPrincipal").text(`${controlador}s`).attr("href" , `?controller=${controlador}`);
        if(controlador == "Personal"){$("#tituloPagina").text($("#rutaPrincipal").text(`${controlador}es`).attr("href" , `?controller=${controlador}`))}
        

        // formateo ruta secundaria
        if(id)
        {
            if(accion == "Crud")
            {
                $("#rutaSecundaria").text(`${$("#rutaSecundaria")[0].innerHTML} | Editar |`)
            }
            else
            {
                $("#rutaSecundaria").text(`${$("#rutaSecundaria")[0].innerHTML} | Detalles |`)
            }
        }

        // formateo de ruta terciaria
        if($("#rutaTerciaria")[0].textContent.trim() == ""){
            $("#rutaTerciaria").text(`| Nuevos ${controlador}`); // la variable controlador ya existe en el contexto
        }
        
    })
</script>