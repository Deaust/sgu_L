var USU_ID = $('#USU_IDx').val();

function loader(){
    $("#loader").modal('show') 
};

function hideloader(){
    $("#loader").modal('hide') 
};

function init(){
    $("#mantenimiento_form").on("submit",function(e){
        guardaryeditar(e);
    });
    $("#baja_form").on("submit",function(e){
        baja(e);
    });
    $("#sistema_form").on("submit",function(e){
        guardarsistema(e);
    });  
}

function inactivosfuncion(){  
    var checkBox = document.getElementById("inactivos");
    
    if (checkBox.checked == true){
        var inactivos=0;
    } else {
        var inactivos=1;
    }

    filtrar(inactivos);

};

function filtrar(inactivos){
    limpiar();
    var delegacion= $('#delegacion').val();
    var departamento= $('#departamento').val();
    var cargo= $('#cargo').val();
    var fech_crea_1= $('#fech_crea_1').val();
    var fech_crea_2= $('#fech_crea_2').val();

    listardatatable(delegacion,departamento,cargo,fech_crea_1,fech_crea_2,inactivos);   
};

$(document).on("click","#btnnuevo",function(){
    $("#usu_id").val(USU_ID);

    $('#delegacion_modal').select2({ dropdownParent: $('#mantenimiento')});
    $('#departamento_modal').select2({ dropdownParent: $('#mantenimiento')});
    $('#cargo_modal').select2({ dropdownParent: $('#mantenimiento')});

    $.post("../../controller/delegacion.php?op=listado",function(data){
        $("#delegacion_modal").html(data);
    });

    $.post("../../controller/departamento.php?op=listado",function(data){
        $("#departamento_modal").html(data);
    });

    $.post("../../controller/cargo.php?op=listado",function(data){
        $("#cargo_modal").html(data);
    });

    $('#vehi_id').val('')
    $('#vehi_marca').val('')
    $('#vehi_tipo').val('')
    $('#vehi_modelo').val('')
    $('#vehi_placas').val('')
    $('#vehi_ns').val('')
    $('#vehi_color').val('')

    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    $('#mantenimiento').modal('show');
});

$(document).on("click","#btnfiltrar", function(){
    var checkBox = document.getElementById("inactivos");
    
    if (checkBox.checked == true){
        var inactivos=0;
    } else {
        var inactivos=1;
    }

   filtrar(inactivos); 
});

$(document).on("click","#btntodo", function(){
    limpiar();
    var checkBox = document.getElementById("inactivos");
    
    if (checkBox.checked == true){
        var inactivos=0;
    } else {
        var inactivos=1;
    }
    
    $('#delegacion').val('').trigger('change');
    $('#departamento').val('').trigger('change');
    $('#cargo').val('').trigger('change');
    $('#fech_crea_1').val('').trigger('change');
    $('#fech_crea_2').val('').trigger('change');
    
    listardatatable('','','','','',inactivos);
});

$(document).ready(function(){


    $('#delegacion').select2();
    $('#departamento').select2();
    $('#cargo').select2();

    $.post("../../controller/delegacion.php?op=listado",function(data){
        $("#delegacion").html(data);
    });

    $.post("../../controller/departamento.php?op=listado",function(data){
        $("#departamento").html(data);
    });

    $.post("../../controller/cargo.php?op=listado",function(data){
        $("#cargo").html(data);
    });

    var checkBox = document.getElementById("inactivos");
    
    if (checkBox.checked == true){
        var inactivos=0;
    } else {
        var inactivos=1;
    }

    filtrar(inactivos);
});

function listardatatable(delegacion,departamento,cargo,fech_crea_1,fech_crea_2,inactivos){
    tabla=$('#table_data_personal').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                ],
        "ajax":{
                url: '../../controller/usuario.php?op=listar_filtros',
                type : "post",
                dataType : "json",
                data:{delegacion:delegacion,departamento:departamento,cargo:cargo,fech_crea_1:fech_crea_1,fech_crea_2:fech_crea_2,inactivos:inactivos},
                error: function(e){
                console.log(e.responseText);
                }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
                },
                "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
        }     
    }).DataTable().ajax.reload();
};

function limpiar(){
    $('#table_data_personal').html(
           "<table id='table_general_det' class='table table-bordered dt-responsive nowrap table-striped align-middle' style='width:100%'>"+
                "<thead>"+
                    "<tr>"+
                        "<th style'width: 5%'>ID</th>"+
                        "<th style'width: 10%'>DELEGACION</th>"+
                        "<th style'width: 10%'>DEPARTAMENTO</th>"+
                        "<th style'width: 10%'>CARGO</th>"+
                        "<th style'width: 20%'>NOMBRE</th>"+
                        "<th style'width: 10%'>NUMERO DE<br>EXPEDIENTE</th>"+
                        "<th style'width: 10%'>FECHA DE ALTA</th>"+
                        "<th style'width: 10%'>ESTADO</th>"+
                        "<th style'width: 5%'>DETALLE</th>"+
                    "</tr>"+
                "</thead>"+
                "<tbody>"+
                "</tbody>"+
           "</table>"
    );
};

function guardaryeditar(e){
    
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    $.ajax({
        url:"../../controller/usuario.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#mantenimiento').modal('hide');

            $('#table_data_personal').DataTable().ajax.reload();            

            swal.fire({
                title:'Tajeta',
                text: 'Registro Confirmado',
                icon: 'success'
            });
        }
    });
};

function guardarsistema(e){
    $('#detalle').modal('hide');
    loader();
    var ID = $('#usu_id_personal').val();
    e.preventDefault();
    var formData = new FormData($("#sistema_form")[0]);
    $.ajax({
        url:"../../controller/usuario.php?op=guardarsistema",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            hideloader();

            swal.fire({
                title:"Registro!",
                text:"Registro realizado con éxito",
                icon: "success",
                confirmButtonText : "OK",
                showCancelButton : false,
                cancelButtonText: "No",
            }).then((result)=>{
                if (result.value){
                    detalle(ID);
                    $('#usu_id_in').val('')  
                    $('#usu_id_personal').val('') 
                    $('#delegacion_sistema').val('').trigger('change');   
                    $('#nombre_sistema').val('')   
                    $('#pass_sistema').val('') 
                }
            });
        }
    });
};

function guardarresguardosistema(e,ID,USU){
    e.preventDefault();
    $('#detalle').modal('hide');
    loader();    
    var formData = new FormData($("#resguardo_sistema_form_"+ID+"")[0]);
    formData.append("files[]", $('#fileElem-'+ID+'')[0].files[0]);
    $.ajax({
        url: "../../controller/resguardo.php?op=insertar_sistema",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(){

            swal.fire({
                title:"Registro!",
                text:"Registro realizado con éxito",
                icon: "success",
                confirmButtonText : "OK",
                showCancelButton : false,
                cancelButtonText: "No",
            }).then((result)=>{
                if (result.value){
                    hideloader();
                    detalle(USU);
                }
            });
        }
    }); 
    
     
};

function resguardo(ID){

    $.post("../../controller/usuario.php?op=listar_resguardos", { ID: ID}, function (data) {
        $('#resguardobody').html(data);
    });
};

function resguardosistema(ID,USU){
    $("#resguardo_sistema_form_"+ID+"").on("submit",function(e){
        guardarresguardosistema(e,ID,USU);
    });
};

function detalle(ID){
    $('#delegacion_sistema').select2({ dropdownParent: $('#detalle')});

    $.post("../../controller/sistema.php?op=listado", function (data) {
        $('#delegacion_sistema').html(data);
    }); 

    $('#usu_id_in').val(USU_ID);
    $('#usu_id_personal').val(ID);

    $.post("../../controller/usuario.php?op=listar_usuario_detalle",{ID:ID},function(data){
        data=JSON.parse(data);
             
        $('#nombre_detalle').html(data.NOMBRE)  
        $('#delegacion_detalle').html(data.DELEGACION) 
        $('#departamento_detalle').html(data.DEPARTAMENTO)   
        $('#expediente_detalle').html(data.EXPEDIENTE)   
        $('#estado_detalle').html(data.ESTADO)   
        $('#alta_detalle').html(data.ALTA)          

    });

    tableusuarios(ID);
    resguardo(ID);


    $('#mdltitulosol').html('Detalle de Usuario');
    $('#detalle').modal('show'); 
};

function tableusuarios(ID){
    tabla=$('#table_sistemas').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                ],
        "ajax":{
                url: '../../controller/usuario.php?op=listar_sistemas',
                type : "post",
                dataType : "json",
                data:{usuario:ID},
                error: function(e){
                console.log(e.responseText);
                }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
                },
                "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
        }     
    }).DataTable().ajax.reload();
};

function baja(e){
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    $.ajax({
        url:"../../controller/usuario.php?op=baja",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            
        }
    });
}

init();