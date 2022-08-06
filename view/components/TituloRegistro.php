<h2 class="d-inline" id="tituloRegistro"></h2>

<!-- verificar si viene el campo cliente -->
<?php
    if(isset($almacenar->cliente) && isset($almacenar->personal))
    {
        echo "<h2 class='d-inline page-header text-capitalize' id='subtituloRegistro'>". ($almacenar->cliente) . "</h2>";
    }
    else
    {
        echo "<h2 class='d-inline page-header text-capitalize' id='subtituloRegistro'>" . ($almacenar->id!= null ? $almacenar->apellido . ' ' . $almacenar->nombre : '') . "</h2>";
    }
?>

<script>
    let controlador = new URLSearchParams(document.location.search).get("controller");
    // $("#tituloRegistro").text(`${controlador} - `);
    if($("#subtituloRegistro")[0].textContent.trim() == ""){
        $("#subtituloRegistro").text(`Nuevo ${controlador}`);
    }
</script>