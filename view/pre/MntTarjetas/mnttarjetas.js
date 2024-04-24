function init(){
    $("#mantenimiento_form").on("submit",function(e){
        guardaryeditar(e);
    });

    $("#traspasos_form").on("submit",function(e){
        guardartraspaso(e);
    });

    $("#recargas_form").on("submit",function(e){
        guardarrecarga(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    $.ajax({
        url:"../../controller/tarjeta.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            swal.fire({
                title:'Tajeta',
                text: 'Registro Confirmado',
                icon: 'success'
            });
        }
    });
}

function guardartraspaso(e){
    e.preventDefault();
    var formData = new FormData($("#traspasos_form")[0]);
    $.ajax({
        url:"../../controller/tarjeta.php?op=traspaso",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            console.log(data);
            $('#table_data').DataTable().ajax.reload();
            $('#traspasos_form').modal('hide');

            swal.fire({
                title:'Tajeta',
                text: 'Traspaso Confirmado',
                icon: 'success'
            });
        }
    });
}

function guardarrecarga(e){
    e.preventDefault();
    var formData = new FormData($("#recargas_form")[0]);
    $.ajax({
        url:"../../controller/tarjeta.php?op=recarga",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            console.log(data);
            $('#table_data').DataTable().ajax.reload();
            $('#recargas').modal('hide');

            swal.fire({
                title:'Recarga',
                text: 'Recarga Realizada',
                icon: 'success'
            });
        }
    });

}

$(document).ready(function(){

    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            /* 'pdfHtml5' */

        ],
        "ajax":{
            url:"../../controller/tarjeta.php?op=listar_v",
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

    $('#tar_ori').select2({ dropdownParent: $('#traspasos')});
    $('#tar_dest').select2({ dropdownParent: $('#traspasos')});

    $.post("../../controller/tarjeta.php?op=listado",function(data){
        $("#tar_ori").html(data);
    });
    $.post("../../controller/tarjeta.php?op=listado",function(data){
        $("#tar_dest").html(data);
    });


});


function eliminar(tar_id){
    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/tarjeta.php?op=eliminar",{tar_id:tar_id},function(data){
                console.log(data);
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title:'Tarjeta',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });
}

function historico(TAR_ID){

    tar_id=TAR_ID;

    $('#tar_idx').val(TAR_ID);


    $('#mdltitulodel').html('Historico de movimientos');
    $("#historico").modal('show')
    
    $('#table_data_historico').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',

        ],
        "ajax":{
            url:"../../controller/tarjeta.php?op=listar_mov",
            type:"post",
            data: {tar_id:tar_id}
            
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 5,
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

    $('#table_data_traspasos').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',

        ],
        "ajax":{
            url:"../../controller/tarjeta.php?op=listar_tras",
            type:"post",
            data: {tar_id:tar_id}
            
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 5,
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

   
}

function recarga(TAR_ID){


    $('#tar_id_re').val(TAR_ID);


    $('#lbltitulo_recarga').html('Recarga');
    $("#recargas").modal('show')
    

   
}

$(document).on("click","#btnnuevo",function(){
    $('#mov_id').val('');
    $('#tar_numero').val('');
    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    $('#modalmantenimiento').modal('show');
});

$(document).on("click","#btntraspaso",function(){
    $('#mov_id').val('');
    $('#tar_ori').val('').trigger('change');
    $('#tar_dest').val('').trigger('change');
    $('#mov_monto_trans').val('');
    $('#lbltitulo_traspaso').html('Nuevo Traspaso');
    $("#traspasos_form")[0].reset();
    $('#traspasos').modal('show');
});


init();