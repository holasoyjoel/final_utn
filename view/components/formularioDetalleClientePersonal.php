
<div class="container mt-2 ms-5 text-center">
    
    <!-- TITULO -->
    <div class="bg-light mb-3 shadow-sm">
        <h2 class="text-capitalize"><?php echo $almacenar->apellido . " " . $almacenar->nombre?></h2>
    </div>
    
    
    <!-- RUTA SEGUIMIENTO -->
    <ol class="breadcrumb">
        <?php require_once "view/components/RutaSeguimiento.php";?>
    </ol>


    <!-- FORMULARIO -->
    <div class="border mx-auto mt-5  p-5 rounded shadow w-75 border-success border-2">
        <form action="" class="d-flex flex-column" enctype="multipart/form-data" id="formulario" method="POST">

            <!-- ID OCULTO -->
            <input type="hidden" name="id" id="txtId" value="<?php echo $almacenar->id;?>" disabled>

            <!-- APELLIDO -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="apellido">
                    Apellido
                </label>
                <input type="text"  class="d-inline-block form-control shadow-sm text-capitalize w-75" value="<?php echo $almacenar->apellido;?>" disabled>
            </div>
            
            <!-- NOMBRE -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="nombre">
                    Nombre
                </label>
                <input type="text" class="d-inline-block form-control shadow-sm text-capitalize w-75" value="<?php echo $almacenar->nombre;?>" disabled>
            </div>
            
            <!-- DNI -->
            <div class="d-flex form-group justify-content-around mb-3 ms-2">
                <label for="dni">Dni</label>
                <input type="text" class="d-inline-block form-control shadow-sm text-capitalize w-75" value="<?php echo $almacenar->dni;?>" disabled>
            </div>
            
            <!-- SEXO -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="Sexo">Sexo</label>
                <select class="d-inline-block form-control ms-4 shadow-sm w-75" disabled>
                    <option <?php echo $almacenar->sexo == 'm' ? 'selected' : ''; ?> value="m">Masculino</option>
                    <option <?php echo $almacenar->sexo == 'f' ? 'selected' : ''; ?> value="f">Femenino</option>
                </select>
            </div>
            
            <!-- TELEFONO -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="telefono">
                    Telefono
                </label>
                <input  type="text" class="d-inline-block form-control shadow-sm text-capitalize w-75" id="txtTelefono" placeholder="- - - -" value="<?php echo $almacenar->telefono;?>" disabled>
            </div>
            
            <!-- DIRECCION -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="telefono">
                    Direccion
                </label>
                <input type="text" class="d-inline-block form-control shadow-sm text-capitalize w-75"  value="<?php echo $almacenar->direccion;?>" disabled>
            </div>
            

            <!-- BOTON GUARDAR Y CANCELAR -->
            <div>
                 <td> <a href="" id="btnEditar" class="btn btn-warning">Editar</a> </td>
                <a href="" class="btn btn-danger mx-5" id="btnCancelar"> Cancelar </a>
            </div>

        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        let controlador = new URLSearchParams(document.location.search).get("controller");
        let id = $("#txtId")[0].value;
        $("#btnEditar").attr("href" , `?controller=${controlador}&accion=Crud&id=${id}`)

        $("#btnCancelar").attr("href" , `?controller=${controlador}`)
    })
</script>