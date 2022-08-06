<?php
    require_once "model/cliente.model.php";
    require_once "model/personal.model.php";
    $cliente = Cliente::getInstancia();
    $personal = Personal::getInstancia();
?>
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
    <div class="border mx-auto mt-5  p-5 rounded shadow w-75 <?php echo !isset($almacenar->id) ? 'border-primary' : 'border-warning'  ;?>"">
        <form action="?controller=Trabajo&accion=Guardar" class="d-flex flex-column" enctype="multipart/form-data" id="formulario" method="POST">

            <!-- ID OCULTO -->
            <input type="hidden" name="id" value="<?php echo $almacenar->id;?>">

            <!-- CLIENTE -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="idCliente">Clientes</label>
                <select autofocus class="form-select ms-5 text-capitalize w-50" id='selectCliente' name="idCliente">
                    <?php foreach($cliente->Listar() as $c): ?>
                        <?php
                            if($almacenar->cliente == ($c->apellido . " " . $c->nombre))
                            {
                                echo "<option class='optionCliente' selected value='". $c->id ."'>" . $c->apellido . " " . $c->nombre . "</option>";
                            }
                            else
                            {

                                echo "<option class='optionCliente' value='". $c->id ."'>" . $c->apellido . " " . $c->nombre . "</option>";
                            }
                           
                            ?>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- PERSONAL -->
            <div class="d-flex form-group justify-content-around mb-3">
            <label for="idPersonal">Personales</label>
                <select autofocus class="form-select ms-4 text-capitalize w-50" id='selectCliente' name="idPersonal">
                    <?php foreach($personal->Listar() as $p): ?>
                        <?php
                            if($almacenar->personal == ($p->apellido . " " . $p->nombre))
                            {
                                echo '<option class="optionPersonal" selected value="'.$p->id.'">'.$p->apellido . ' ' . $p->nombre .'</option>';
                            }
                            else
                            {
                                echo '<option class="optionPersonal" value="'.$p->id.'">'.$p->apellido . ' ' . $p->nombre .'</option>';
                            }
                        ?>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- TITULO -->
            <div class="d-flex form-group justify-content-around mb-3 ms-2">
                <label for="titulo">Titulo</label>
                <input autofocus autocomplete="off" type="text" name="titulo"  class="d-inline-block form-control ms-4 shadow-sm text-capitalize w-50" id="txtTitulo" maxlength="50"  placeholder="Ingrese titulo del trabajo" value="<?php echo $almacenar->titulo;?>">
            </div>
            
            <!-- DESCRIPCION -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="descripcion">Descripcion</label>
                <textarea autocomplete="off" class="form-control ms-4 me-2 w-50" cols="20" id="txtDescripcion" maxlength="1000" minlength="3" name="descripcion" rows="5" style="resize: none;"><?php echo $almacenar->descripcion; ?></textarea>
            </div>
            
            <!-- Fecha -->
            <div class="d-flex form-group justify-content-around mb-3">
                <label for="fecha">Fecha</label>
                <input class="form-control ms-4 w-50" type="datetime" name="fecha" id="txtFechaTrabajo" value="<?php echo $almacenar->fecha;?>" readonly>
            </div>
            
           
            

            <!-- BOTON GUARDAR Y CANCELAR -->
            <div>
                <button class="btn btn-success mx-5"> Guardar </button>
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
            if(validarCampos()){
                reformatearFecha($("#txtFechaTrabajo")[0].value);
                return;
            }
            event.preventDefault();    
        })


        // FUNCION VALIDAR CAMPOS
        function validarCampos(){
            let camposValidos = false;
            let spanCamposObligatorios = $("#camposObligatorios");

            let txtTitulo = $("#txtTitulo")[0];
            let txtDescripcion = $("#txtDescripcion")[0];
            

            if(txtTitulo.value)
            {
                $("#txtTitulo").removeClass("border-danger");
                if(txtDescripcion.value)
                {
                    $("#txtDescripcion").removeClass("border-danger");
                   camposValidos = true;
                }
                else
                {
                    $("#txtDescripcion").addClass("border-danger").focus();
                    spanCamposObligatorios.text("DESCRIPCION");
                }
            }
            else
            {
                $("#txtTitulo").addClass("border-danger").focus();
                spanCamposObligatorios.text("TITULO");
            }
            
            // MOSTRAR CARTEL DE ALERTA CAMPOS OBLIGATORIO
            if(!camposValidos)
            {
                $("#cartelCamposIncompletos").removeClass("d-none");
                setTimeout(function(){
                    $("#cartelCamposIncompletos").addClass("d-none");
                }, 3000);
            }
            
            return camposValidos;
        }



         // ESTABLECIENDO COMO SE VERA LA FECHA TRABAJO
         
         if(!$("#txtFechaTrabajo")[0].value)
         {
            //  en caso que no venga una fecha , le establecemos la fecha del sistema (formato: dd-mm-yyyy)
            let fechaSistema = new Date();
            $("#txtFechaTrabajo").val(`${fechaSistema.getDate()}-${(fechaSistema.getMonth()+1)}-${fechaSistema.getFullYear()}`);

        }
        else
        {
            // en caso que venga una fecha (formato: yyy-mm-dd) lo formateamos a formato dd-mm-yyyy 
            let [year , month , day] = $("#txtFechaTrabajo")[0].value.split("-");
            $("#txtFechaTrabajo").val(`${day}-${month}-${year}`);
        }


        function reformatearFecha(fecha)
        {
            let [day , month , year] = fecha.split("-");
            $("#txtFechaTrabajo").val(`${year}-${month}-${day}`);
        }


         // volver a la pagina anterior al hacer cancelar
         $("#btnCancelar").click(function(){
            window.history.back();
        })
    })
</script>



