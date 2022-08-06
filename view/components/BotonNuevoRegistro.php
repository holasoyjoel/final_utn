<style>
    #btnAgregar{
        position: absolute;
        top: 90%;
        left: 90%;
    }
</style>

<a href="" id="btnAgregar" class="btn btn-primary "></a>

<script>
        let controlador = new URLSearchParams(document.location.search).get("controller");
        $("#btnAgregar").text(`Nuevo ${controlador}`)
                        .attr("href" , `?controller=${controlador}&accion=Crud`);
</script>
