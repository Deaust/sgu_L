function init(){
    $("#mantenimiento_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);
    if($('#del_id').val()==0){
        swal.fire({
            title:'Campos incorrectos',
            text: 'Registro Revise que todos los campos esten llenados',
            icon: 'error'
        });
    }else{
        $.ajax({
            url:"../../controller/usuario.php?op=guardaryeditar",
            type:"POST",
            data:formData,
            contentType:false,
            processData:false,
            success:function(data){
                $('#table_data').DataTable().ajax.reload();
                $('#modalmantenimiento').modal('hide');
    
                swal.fire({
                    title:'Usuario',
                    text: 'Registro Confirmado',
                    icon: 'success'
                });
            }
        });
    }

}

$(document).ready(function(){

    $('#dir_id').select2({ dropdownParent: $('#modalmantenimiento')});
    $('#del_id').select2({ dropdownParent: $('#modalmantenimiento')});

    $.post("../../controller/direccion.php?op=listado",function(data){
        $("#dir_id").html(data);
    });

    $("#dir_id").change(function(){
        $("#dir_id").each(function(){
            dir_id = $(this).val();  

            $.post("../../controller/delegacion.php?op=combo",{dir_id:dir_id},function(data){
                $("#del_id").html(data);
            });
        });
    });

    

    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
        ],
        "ajax":{
            url:"../../controller/usuario.php?op=listar",
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

function editar(USU_ID){
    $.post("../../controller/usuario.php?op=mostrar",{USU_ID:USU_ID},function(data){
        data=JSON.parse(data);
        $('#dir_id').val(data.DIR_ID).trigger('change');
        $('#del_id').val(data.DEL_ID).trigger('change');
        $('#rol_id').val(data.ROL_ID).trigger('change');
        $('#usu_id').val(data.USU_ID);
        $('#usu_nom').val(data.USU_NOM);
        $('#usu_ape').val(data.USU_APE);
        $('#usu_correo').val(data.USU_CORREO);
        $('#usu_pass').val(data.USU_PASS);
        

        
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show')
}

function eliminar(usu_id){
    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/usuario.php?op=eliminar",{usu_id:usu_id},function(data){
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title:'Usuario',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });
}

$(document).on("click","#btnnuevo",function(){

    $('#dir_id').val('0').trigger('change');
    $('#dir_id').val('0').trigger('change');
    $('#rol_id').val('0').trigger('change');
    $('#usu_id').val('')
    $('#usu_nom').val('')
    $('#usu_ape').val('')
    $('#usu_correo').val('')
    $('#usu_pass').val('')
    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    $('#modalmantenimiento').modal('show');
});

init();