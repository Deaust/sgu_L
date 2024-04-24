<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Catalogo.php");
    /* TODO: Inicializando clase */
    $catalogo = new Catalogo();

   switch($_GET["op"]){

        case "listado";            

            if(isset($_POST["catalogo"]) == 0){
                ?>
                    <div class="col-lg-6" id="eTipoRecurso">
                        <div class="card-header">
                            <h4 id="titulo_Color">Hola</h4>
                        </div>
                    </div> 
                <?php
            }else{
                $catalogos = count($_POST["catalogo"]);
                for ($index = 0; $index < $catalogos; $index++) {

                    if ($_POST["catalogo"][$index] ===   "Delegacion"){
    
                        ?>
                            <div class="col-lg-12" id="eDelegacion">
                                <div class="card-header">
                                    <h4 id="titulo_Color">Delegacion</h4>
                                </div>
                                <!-- <div class="card-header">
                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>                                                                                               
                                </div> -->
                                <div class="card-body">    
                                    <table id="tabla_Delegacion" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">CLAVE</th>
                                                <th style="width: 20%;">NOMBRE</th>
                                                <th style="width: 20%;">SIGLA</th>
                                                <th style="width: 20%;">OFICIALIA</th>
                                                <th style="width: 20%;">FECHA DE<br>CREACION</th>
                                                <!-- <th style="width: 10%;">EDITAR</th>
                                                <th style="width: 10%;">BORRAR</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        <?php
                    }else if($_POST["catalogo"][$index] === "Departamento"){
                        ?>
                            <div class="col-lg-6" id="eDepartamento">
                                <div class="card-header">
                                    <h4 id="titulo_Color">Departamento</h4>
                                </div>
                                <!-- <div class="card-header">
                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>                                                                                               
                                </div> -->
                                <div class="card-body">    
                                    <table id="tabla_Departamento" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 26.6%;">DIRECCION</th>
                                                <th style="width: 26.6%;">NOMBRE</th>
                                                <th style="width: 26.6%;">FECHA DE<br>CREACION</th>
                                                <!-- <th style="width: 10%;">EDITAR</th>
                                                <th style="width: 10%;">BORRAR</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        <?php
                    }else if($_POST["catalogo"][$index] === "TipoBien"){
                        ?>
                            <div class="col-lg-6" id="eTipoBien">
                                <div class="card-header">
                                    <h4 id="titulo_Color">Tipo Bien</h4>
                                </div>
                                <!-- <div class="card-header">
                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>                                                                                               
                                </div> -->
                                <div class="card-body">    
                                    <table id="tabla_TipoBien" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 26.6%;">CLASIFICACION</th>
                                                <th style="width: 26.6%;">NOMBRE</th>
                                                <th style="width: 26.6%;">FECHA DE<br>CREACION</th>
                                                <!-- <th style="width: 10%;">EDITAR</th>
                                                <th style="width: 10%;">BORRAR</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        <?php
                    }else if($catalogos == NULL){
                        ?>
                            <div class="col-lg-6" id="eTipoRecurso">
                                <div class="card-header">
                                    <h4 id="titulo_Color">Tipo Recurso</h4>
                                </div>
                                <!-- <div class="card-header">
                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>                                                                                               
                                </div> -->
                                <div class="card-body">    
                                    <table id="tabla_TipoRecurso" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 26.6%;">CLASIFICACION</th>
                                                <th style="width: 26.6%;">NOMBRE</th>
                                                <th style="width: 26.6%;">FECHA DE<br>CREACION</th>
                                                <!-- <th style="width: 10%;">EDITAR</th>
                                                <th style="width: 10%;">BORRAR</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        <?php
                    }else{
                        ?>
                            <div class="col-lg-6" id="e<?php echo $_POST["catalogo"][$index]?>">
                                <div class="card-header">
                                    <h4 id="titulo_Color"><?php echo $_POST["catalogo"][$index]?></h4>
                                </div>
                                <!-- <div class="card-header">
                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>                                                                                               
                                </div> -->
                                <div class="card-body">    
                                    <table id="tabla_<?php echo $_POST["catalogo"][$index]?>" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%;">NOMBRE</th>
                                                <th style="width: 40%;">FECHA DE<br>CREACION</th>
                                                <!-- <th style="width: 10%;">EDITAR</th>
                                                <th style="width: 10%;">BORRAR</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        <?php
                    }
                }
            }           
                    
            break;

        case "listado_activadores";
                $datos=["Clasificacion","Color","Delegacion","Departamento","Direccion","EstadoFisico","Estatus","Marca","Material","Proveedor","Puesto","TipoBien","TipoRecurso"];
                ?><ul><?php
                foreach($datos as $row){
                    $key = array_search($row, $datos);
                    ?>
                        <li class="form-check form-switch form-switch-lg  col-lg-12" dir="ltr">
                            <label class="form-check-label fs-5" for="s<?php echo $row ?>"><?php echo $row ?></label>
                            <input type="checkbox" class="form-check-input" id="s<?php echo $row ?>" onclick="activador()">
                        </li>
                    <?php
                }
                ?></ul><?php
            break;
        case "listar_catalogos";

                if ($_POST["catalogo"] ===   "Delegacion"){
                    $datos=$catalogo->listar_general($_POST["catalogo"]);
                    $data= Array();
                    foreach($datos as $row){
                        $sub_array = array();
                        $sub_array[] = $row["CLAVE"];
                        $sub_array[] = $row["NOMBRE"];
                        $sub_array[] = $row["SIGLA"];                        
                        $sub_array[] = $row["OFICIALIA"];
                        $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                       /*  $sub_array[] = '<button type="button" onClick="detalle'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="  ri-edit-2-line"></i></button>';
                        $sub_array[] = '<button type="button" onClick="eliminar'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="  ri-delete-bin-5-line"></i></button>'; */
                        $data[] = $sub_array;
                    
                    }
                }else if($_POST["catalogo"] === "Departamento"){
                    $datos=$catalogo->listar_general($_POST["catalogo"]);
                    $data= Array();
                    foreach($datos as $row){
                        $sub_array = array();
                        $sub_array[] = $row["DIRECCION"];
                        $sub_array[] = $row["NOMBRE"];
                        $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                       /*  $sub_array[] = '<button type="button" onClick="detalle'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="  ri-edit-2-line"></i></button>';
                        $sub_array[] = '<button type="button" onClick="eliminar'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="  ri-delete-bin-5-line"></i></button>'; */
                        $data[] = $sub_array;
                    
                    }
                }else if($_POST["catalogo"] === "TipoBien"){
                    $datos=$catalogo->listar_general($_POST["catalogo"]);
                    $data= Array();
                    foreach($datos as $row){
                        $sub_array = array();
                        $sub_array[] = $row["CLASIFICACION"];
                        $sub_array[] = $row["NOMBRE"];
                        $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                       /*  $sub_array[] = '<button type="button" onClick="detalle'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="  ri-edit-2-line"></i></button>';
                        $sub_array[] = '<button type="button" onClick="eliminar'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="  ri-delete-bin-5-line"></i></button>'; */
                        $data[] = $sub_array;
                    
                    }
                }else {

                    $datos=$catalogo->listar_general($_POST["catalogo"]);
                    $data= Array();
                    foreach($datos as $row){
                        $sub_array = array();
                        $sub_array[] = $row["NOMBRE"];
                        $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                       /*  $sub_array[] = '<button type="button" onClick="detalle'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="  ri-edit-2-line"></i></button>';
                        $sub_array[] = '<button type="button" onClick="eliminar'.$_POST["catalogo"].'('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="  ri-delete-bin-5-line"></i></button>'; */
                        $data[] = $sub_array;
                    
                    }
                }

                

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
            break;
        
    }
?>
