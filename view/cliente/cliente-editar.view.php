
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
    <div class="border mx-auto mt-5  p-5 rounded shadow w-75 <?php echo !isset($almacenar->id) ? 'border-primary border-2' : 'border-warning border-2'  ;?>"">
        <form action="?controller=Cliente&accion=Guardar" class="d-flex flex-column" enctype="multipart/form-data" id="formulario" method="POST">

            <!-- ID OCULTO -->
            <input type="hidden" name="id" value="<?php echo $almacenar->id;?>">

            <!-- APELLIDO -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="apellido">
                    Apellido
                </label>
                <input autofocus autocomplete="off" type="text" name="apellido" class="d-inline-block form-control shadow-sm text-capitalize w-75" id="txtApellido" maxlength="50" minlength="3" placeholder="Ingrese su apellido" value="<?php echo $almacenar->apellido;?>">
            </div>
            
            <!-- NOMBRE -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="nombre">
                    Nombre
                </label>
                <input autofocus autocomplete="off" type="text" name="nombre" class="d-inline-block form-control shadow-sm text-capitalize w-75" id="txtNombre" maxlength="50" minlength="3" placeholder="Ingrese su nombre" value="<?php echo $almacenar->nombre;?>">
            </div>
            
            <!-- DNI -->
            <div class="d-flex form-group justify-content-around mb-3 ms-2">
                <label for="dni">Dni</label>
                <input autofocus autocomplete="off" type="text" name="dni"  class="d-inline-block form-control shadow-sm text-capitalize w-75" id="txtDni" minlength="8" maxlength="8" pattern="[0-9]+" placeholder="Ingrese su dni" value="<?php echo $almacenar->dni;?>" <?php echo $almacenar->dni!=null? "readonly" : "";?>>
            </div>
            
            <!-- SEXO -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="Sexo">Sexo</label>
                <select class="d-inline-block form-control ms-4 shadow-sm w-75" name="sexo">
                    <option <?php echo $almacenar->sexo == 'm' ? 'selected' : ''; ?> value="m">Masculino</option>
                    <option <?php echo $almacenar->sexo == 'f' ? 'selected' : ''; ?> value="f">Femenino</option>
                </select>
            </div>
            
            <!-- TELEFONO -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="telefono">
                    Telefono
                </label>
                <input autofocus autocomplete="off" type="text" name="telefono" class="d-inline-block form-control shadow-sm text-capitalize w-75" id="txtTelefono" maxlength="50" placeholder="- - - -" value="<?php echo $almacenar->telefono;?>">
            </div>
            
            <!-- DIRECCION -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="telefono">
                    Direccion
                </label>
                <input autofocus autocomplete="off" type="text" name="direccion" class="d-inline-block form-control shadow-sm text-capitalize w-75" id="txtDireccion" maxlength="100" minlength="3" placeholder="Ingrese su direccion" value="<?php echo $almacenar->direccion;?>">
            </div>
            

            <!-- BOTON GUARDAR Y CANCELAR -->
            <div>
                <button class="btn btn-success mx-5"> Guardar </button>
                <!-- <a href="?controller=Cliente" class="btn btn-danger mx-5"> Cancelar </a> -->
                <a id="btnCancelar" class="btn btn-danger mx-5"> Cancelar </a>
            </div>

            <!-- CARTEL DE CAMPOS INCOMPLETOS -->
            <div class="alert alert-danger d-none mt-5" id="cartelCamposIncompletos">
                DEBES COMPLETAR
                <span id="camposObligatorios"></span>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("form").submit(function(event){
            if(validarCampos() == true)
            {
                return this.validate();
            }
            else
            {
                event.preventDefault();
            }
        })


        // FUNCION VALIDAR CAMPOS
        function validarCampos(){
            let camposValidos = false;
            let spanCamposObligatorios = $("#camposObligatorios");

            let txtApellido = $("#txtApellido")[0];
            let txtNombre = $("#txtNombre")[0];
            let txtDni = $("#txtDni")[0];
            let txtDireccion = $("#txtDireccion")[0];
            

            if(txtApellido.value)
            {
                $("#txtApellido").removeClass("border-danger");
                if(txtNombre.value)
                {
                    $("#txtNombre").removeClass("border-danger");
                    if(txtDni.value)
                    {
                        $("#txtDni").removeClass("border-danger");
                        if(txtDireccion.value)
                        {
                            $("#txtDireccion").removeClass("border-danger");
                            camposValidos = true;
                        }
                        else
                        {
                            $("#txtDireccion").addClass("border-danger").focus();
                            spanCamposObligatorios.text("DIRECCION");
                        }
                    }
                    else
                    {
                        $("#txtDni").addClass("border-danger").focus();
                        spanCamposObligatorios.text("DNI");
                    }
                }
                else
                {
                    $("#txtNombre").addClass("border-danger").focus();
                    spanCamposObligatorios.text("NOMBRE");
                }
            }
            else
            {
                $("#txtApellido").addClass("border-danger").focus();
                spanCamposObligatorios.text("APELLIDO");
            }
            
            // MOSTRAR CARTEL DE ALERTA CAMPOS OBLIGATORIO
            if(camposValidos == false)
            {
                console.log("entro a alerta")
                $("#cartelCamposIncompletos").removeClass("d-none");
                setTimeout(function(){
                    $("#cartelCamposIncompletos").addClass("d-none");
                }, 3000);
            }
            
            return camposValidos;
        }


        // volver a la pagina anterior al hacer cancelar
        $("#btnCancelar").click(function(){
            window.history.back();
        })
    })
</script>



