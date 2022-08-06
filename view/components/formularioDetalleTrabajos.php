<?php
    require_once "model/cliente.model.php";
    require_once "model/personal.model.php";
    $cliente = Cliente::getInstancia();
    $personal = Personal::getInstancia();
?>

<style>
    #textoCopiado{
        position: absolute;
        top: 46%;
        left: 73%;
    }
</style>
<div class="container mt-2 ms-5 text-center">
    
    <!-- TITULO -->
    <div class="bg-light mb-3 shadow-sm">
        <?php require_once "view/components/TituloRegistro.php";?>
    </div>
    
    
    <!-- RUTA SEGUIMIENTO -->
    <ol class="breadcrumb">
        <?php require_once "view/components/RutaSeguimiento.php";?>
    </ol>
    
    
    <!-- FORMULARIO -->
    <div class="border mx-auto mt-5  p-5 rounded shadow w-75 border-success border-2">
        <form action="" class="d-flex flex-column" enctype="multipart/form-data" id="formulario" method="POST">
            
            <!-- ID OCULTO -->
            <input type="hidden" name="id" value="<?php echo $almacenar->id;?>" disabled>
            
            <!-- CLIENTE -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="idCliente">Cliente</label>
                <input type="text" class="d-inline-block form-control ms-5 shadow-sm text-capitalize w-50" value="<?php echo $almacenar->cliente;?>" disabled>
            </div>
            
            <!-- PERSONAL -->
            <div class="d-flex form-group justify-content-around mb-3">
            <label for="idPersonal">Personal</label>
                <input type="text" class="d-inline-block form-control ms-4 shadow-sm text-capitalize w-50" value="<?php echo $almacenar->personal;?>" disabled>
            </div>
            
            <!-- TITULO -->
            <div class="d-flex form-group justify-content-around mb-3 ms-2">
                <label for="titulo">Titulo</label>
                <input type="text" class="d-inline-block form-control ms-4 shadow-sm text-capitalize w-50" value="<?php echo $almacenar->titulo;?>" disabled>
            </div>
            
            <!-- DESCRIPCION -->
            <span class="text-success fw-bold w-25 d-none" id="textoCopiado">¡COPIADO!</span>
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control ms-4 me-2 w-50" cols="20" rows="5" style="resize: none;" readonly><?php echo $almacenar->descripcion; ?></textarea>
            </div>
            
            <!-- Fecha -->
            <div class="d-flex form-group justify-content-around mb-5">
                <label for="fecha">Fecha</label>
                <input class="form-control ms-4 w-50" type="datetime" id="txtFechaTrabajo" value="<?php echo $almacenar->fecha;?>" disabled>
            </div>
            
           
            

            <!-- BOTON GUARDAR Y CANCELAR -->
            <div>
                <td> <a href="?controller=Trabajo&accion=Crud&id=<?php echo $almacenar->id;?>" id="btnEditar" class="btn btn-warning">Editar</a> </td>
                <a href="?controller=Trabajo" class="btn btn-danger mx-5"> Cancelar </a>
            </div>

        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        let [year , month , day] = $("#txtFechaTrabajo")[0].value.split("-");
        $("#txtFechaTrabajo").val(`${day}-${month}-${year}`);
        $("textarea").click(function(){
            let area = $(this);
            area.select().addClass("border-success border-2 shadow-none")

            $("#textoCopiado").removeClass("d-none");
            
            setInterval(function(){
                area.removeClass("border-success border-2")
                $("#textoCopiado").addClass("d-none");
            },500)
            
            console.log("texto copiado")
            document.execCommand("copy")
        })
    })
</script>