

<div class="border mt-1 ms-5 pt-2 p-3 text-center w-75">
    
    <!-- TITULO Y CAJAS DE FILTRO -->
    <div class="d-flex flex-row justify-content-around">
        <?php require_once "view/components/TituloYContadorPrincipal.php";?>
        <?php require_once "view/components/Filtrado.php";?>
    </div>

    <!-- BOTON NUEVO CLIENTE -->
    <?php require_once "view/components/BotonNuevoRegistro.php";?>

    <br><br><br>

    <!-- TABLA DE INFORMACION -->
    <table class="table table-hover text-capitalize">

        <thead>
            <tr>
                <th style="width:200px;">Cliente</th>
                <th style="width:200px;">Personal</th>
                <th style="width:200px;">Fecha</th>
                <th style="width:200px;">Trabajo</th>
                <th style="width:60px;"></th>
                <th style="width:60px;"></th>
            </tr>
        </thead>

        <tbody>
            <!-- COMPLETAR RELLENADO DE TABLA -->
            <?php foreach(isset($almacenar->filtrar)? ($this->model->Filtrar($almacenar->termino)) : ($this->model->Listar()) as $t):?>
                <tr>
                    <td><?php echo $t->cliente;?></td>
                    <td><?php echo $t->personal;?></td>
                    <td name="fechaTrabajo"><?php echo $t->fecha;?></td>
                    <td><?php echo $t->titulo;?></td>
                    
                    <td> <a href="?controller=Trabajo&accion=VerDetalle&id=<?php echo $t->id;?>" id="btnEditar" class="btn btn-success">Ver</a> </td>                
                    <td>
                        <a 
                            href="?controller=Trabajo&accion=Eliminar&id=<?php echo $t->id;?>" 
                            id="btnEditar"
                            onclick="javascript:return confirm('¿Seguro de eliminar este registro?')"
                            class="btn btn-danger "
                        >
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
        
    </table>

    <!-- CARTEL DE NO HAY REGISTRO -->
    <?php require_once "view/components/CartelTablaSinRegistros.php";?>

    <script>
        $(document).ready(function(){

            // FORMATENADO LA FORMA EN QUE SE VE LA FECHA
            $("td[name='fechaTrabajo']").map(function(indice , elemento){
                let [year , month , day] = elemento.textContent.split("-");
                elemento.textContent = (`${day}-${month}-${year}`);
            })
        })
    </script>
</div>


<script>
    localStorage.setItem("ruta" , "Trabajos");
</script>