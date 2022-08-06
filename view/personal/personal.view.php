

<div class="border mt-1 ms-5 pt-2 p-3 text-center w-75">
    
    <!-- TITULO Y CAJAS DE FILTRO -->
    <div class="d-flex flex-row justify-content-around">
        <?php require_once "view/components/TituloYContadorPrincipal.php";?>
    </div>

    <!-- BOTON NUEVO CLIENTE -->
    <?php require_once "view/components/BotonNuevoRegistro.php";?>

    <br><br><br>

    <!-- TABLA DE INFORMACION -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width:200px;">Apellido y Nombre</th>
                <th style="width:200px;">Dni</th>
                <th style="width:200px;">Telefono</th>
                <th style="width:60px;"></th>
                <th style="width:60px;"></th>
            </tr>
        </thead>

        <tbody>

            
            <?php foreach($this->model->Listar() as $registro): ?>
                <tr>
                    <td> <?php echo $registro->apellido . " " . $registro->nombre;?></a> </td>

                    <td> <?php echo $registro->dni;?> </td>

                    <td> <?php echo $registro->telefono != null ? $registro->telefono : "- - - - - -" ;?> </td>

                    <td> <a href="?controller=Personal&accion=VerDetalle&id=<?php echo $registro->id;?>" id="btnEditar" class="btn btn-success">Ver</a> </td>
                    <td>
                        <a 
                            href="?controller=Personal&accion=Eliminar&id=<?php echo $registro->id;?>" 
                            id="btnEditar"
                            onclick="javascript:return confirm('Se eliminara al Personal y sus trabajos realizados. ¿Seguro de eliminar?')"
                            class="btn btn-danger"
                        >
                            Eliminar
                        </a>
                    </td>
            
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- CARTEL DE NO HAY REGISTRO -->
    <?php require_once "view/components/CartelTablaSinRegistros.php";?>
</div>

