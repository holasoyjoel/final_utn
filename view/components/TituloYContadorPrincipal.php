<style>
    h2 , span {
        font-weight: bold;
        font-size: 2rem;
    }
</style>

<div>
    <h2 class="page-header d-inline" id="tituloPagina"></h2>
    <span id="cantidadRegistros"></span>
</div>

<script>
    $(document).ready(function(){

        let controlador = new URLSearchParams(document.location.search).get("controller");
        
        $("#tituloPagina").text(`${controlador}s`)
        if(controlador == "Personal"){$("#tituloPagina").text(`${controlador}es `)}
        $("#cantidadRegistros").text(`( ${$("tr").length - 1} ) `);
    })
</script>