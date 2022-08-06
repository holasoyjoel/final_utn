<div class="alert alert-warning d-none" id="cartelSinRegistros"></div>

<script type="module">
    let controlador = new URLSearchParams(document.location.search).get("controller");    
    let textoSinRegistros = `NO HAY REGISTROS DE ${controlador.toUpperCase()}S`;
    if(controlador == "Personal"){textoSinRegistros = `NO HAY REGISTROS DE ${controlador.toUpperCase()}ES`}

    // en caso de que se haga filtrado en el controlador Cliente
    if(controlador != "Personal")
    {   
        if($("#cajaBuscar")[0].value) { textoSinRegistros += ` CON TERMINO  " ${$("#cajaBuscar")[0].value} "`; }
    }
    
    $("#cartelSinRegistros").text(textoSinRegistros);

    // mostrar/ocultar cartel de sin registro
    if($("tr").length - 1 == 0)
    {
        $("table").addClass("d-none");
        $("#cartelSinRegistros").removeClass("d-none");
    }
    else
    {
        $("table").removeClass("d-none");
        $("#cartelSinRegistros").addClass("d-none");
    }    
</script>