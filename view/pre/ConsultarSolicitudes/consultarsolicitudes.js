var USU_ID = $('#USU_IDx').val();
var ROL_ID = $('#ROL_IDx').val();
var DEL_ID = $('#DEL_IDx').val();
var DIR_ID = $('#DIR_IDx').val();


console.log(ROL_ID);



function init(){
    $("#aut_monto").on("submit",function(e){
        autorizar(e);
        //insertar_autorizacion(e);
    });

}

// ASIGNACIONES

    function detalle(SOL_ID){

        $('#sol_idX').val(SOL_ID) 
        

        $('#dir_id_asig_tar').select2({ dropdownParent: $('#modalasignardel')});

        $('#del_id_asig').select2({ dropdownParent: $('#modalasignardel')});
       
        $.post("../../controller/solicitud.php?op=imagen", {SOL_ID:SOL_ID}, function (data) {
            $('#imagen').html(data);
        }); 

        $.post("../../controller/solicitud.php?op=auto_monto_mod", {SOL_ID:SOL_ID}, function (data) {
            $('#aut_monto').html(data);
            $('#sol_idX').val(SOL_ID)
        }); 

        $.post("../../controller/solicitud.php?op=listar_sol_det",{SOL_ID:SOL_ID},function(data){
            data=JSON.parse(data);

            $('#tar_numero_info').html(data.TARJETA) 
            $('#tar_saldo_info').html(data.SALDO_TARJETA) 
            $('#vehi_placa_info').html(data.PLACAS)  
            $('#placas_info').html(data.PLACAS)   
            $('#ns_info').html(data.NS) 
            $('#sol_no').html(data.SOL_NO)   
            $('#del_info').html(data.DELEGACION)   
            $('#usu_info').html(data.USUARIO)   
            $('#monto_info').html(data.SOL_MONTO) 
            
            $('#marca_info').html(data.MARCA) 
            $('#modelo_info').html(data.MODELO) 
            $('#anno_info').html(data.AÑO) 
            $('#color_info').html(data.COLOR) 
            $('#monto_aut_info').html(data.MONTO_AUTORIZADO)  
                       

        });

        $('#mdltitulosol').html('Detalle de Solicitud');
        $("#modaldetallesol").modal('show') 
    }

/* LISTAR TABLA */


$(document).ready(function(){

 

    $('#dir_id').select2({ dropdownParent: $('#modalasignarusu')});

    
    $('#data_table_1').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
        ],
        "ajax":{
            url:"../../controller/solicitud.php?op=listar_1",
            type:"post",
            data:{USU_ID:USU_ID},
            

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
        },
    });

    $('#data_table_2').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
        ],
        "ajax":{
            url:"../../controller/solicitud.php?op=listar_2",
            type:"post",
            data:{DEL_ID:DEL_ID},

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
        },
    });

    $('#data_table_3').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
        ],
        "ajax":{
            url:"../../controller/solicitud.php?op=listar_3",
            type:"post",
            data:{DIR_ID:DIR_ID},

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
        },
    });

    $('#data_table_4').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
        ],
        "ajax":{
            url:"../../controller/solicitud.php?op=listar_4",
            type:"post",

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
        },
    }); 
    

});


// GENERAL
function autorizar(e,sol_id_2){
    e.preventDefault();
    var sol_id_2 = $('#sol_idX').val();
    console.log(sol_id_2);
    var formData = new FormData($("#aut_monto")[0]);

    $.ajax({
        url:"../../controller/solicitud.php?op=autorizacion",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            data = JSON.parse(data);
            console.log(data);
            console.log(data[0].AUT_ID);
            
            $.post("../../controller/solicitud.php?op=solicitud_autorizada", {SOL_ID:sol_id_2}, function (data) {
                $('#modaldetallesol').modal('hide');
                $('#data_table_4').DataTable().ajax.reload();
                
                swal.fire({
                    title:'Autorizacion',
                    text: 'Autorizacion Confirmada',
                    icon: 'success'
                });

            });  
            $.post("../../controller/email.php?op=autorizar_solicitud", {AUT_ID:data[0].AUT_ID}, function (data) {              
                console.log(data);
            });            
        }
    });
}


init();