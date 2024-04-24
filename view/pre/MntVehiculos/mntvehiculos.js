function init(){
    $("#mantenimiento_form").on("submit",function(e){
        guardaryeditar(e);
    });

    $("#modalasignardel").on("submit",function(e){
        guardarasignardel(e);
    });

    $("#modalasignarusu").on("submit",function(e){
        guardarasignarusu(e);
    });
}

// ASIGNACIONES

    function asignardel(VEHI_ID){
        $('#dir_id_asig_tar').select2({ dropdownParent: $('#modalasignardel')});

        $('#del_id_asig').select2({ dropdownParent: $('#modalasignardel')});
       

        $('#vehi_id_del').val(VEHI_ID);

         /* listar direcciones */
         $.post("../../controller/direccion.php?op=listado",function(data){
            $("#dir_id_asig_tar").html(data);
        });

        /* listar delegaciones */
        $("#dir_id_asig_tar").change(function(){
            $("#dir_id_asig_tar").each(function(){
                dir_id = $(this).val();  

                $.post("../../controller/delegacion.php?op=combo",{dir_id:dir_id},function(data){
                    $("#del_id_asig").html(data);
                });

            });
        });

        $('#mdltitulodel').html('Asignar Delegacion');
        $("#modalasignardel").modal('show') 
    }

    function asignarusu(VEHI_ID){

        $('#dir_id_asig').select2({ dropdownParent: $('#modalasignarusu')});
        $('#del_id_asig_usu').select2({ dropdownParent: $('#modalasignarusu')});
        $('#usu_id_asig').select2({ dropdownParent: $('#modalasignarusu')});

        $('#vehi_id_usu').val(VEHI_ID);


        /* listar direcciones */
        $.post("../../controller/direccion.php?op=listado",function(data){
            $("#dir_id_asig").html(data);
        });

        /* listar delegaciones */
        $("#dir_id_asig").change(function(){
            $("#dir_id_asig").each(function(){
                dir_id = $(this).val();  

                $.post("../../controller/delegacion.php?op=combo",{dir_id:dir_id},function(data){
                    $("#del_id_asig_usu").html(data);
                });

            
                    /* listado de usuarios */
                $("#del_id_asig_usu").change(function(){
                    $("#del_id_asig_usu").each(function(){
                        del_id_usu = $(this).val(); 
                        $.post("../../controller/usuario.php?op=combo",{del_id_usu:del_id_usu},function(data){
                            $("#usu_id_asig").html(data);
                        });
                    });
                });
            });
        });



        $('#mdltitulousu').html('Asignar Usuario');
        $("#modalasignarusu").modal('show') 
    }

    // ASIGNACIONES GUARDAR

    function guardarasignarusu(e){
        e.preventDefault();
        var formData = new FormData($("#asig_form_usu")[0]);
        if($('#del_id').val()==0){
            swal.fire({
                title:'Campos incorrectos',
                text: 'Registro Revise que todos los campos esten llenados',
                icon: 'error'
            });
        }else{
            $.ajax({
                url:"../../controller/asignacion.php?op=asignacion_usuario",
                type:"POST",
                data:formData,
                contentType:false,
                processData:false,
                success:function(data){
                    console.log(data);

                    $.ajax({
                        url:"../../controller/vehiculo.php?op=asignacion_usuario",
                        type:"POST",
                        data:formData,
                        contentType:false,
                        processData:false,
                        success:function(data){
                            $('#table_data').DataTable().ajax.reload();
                            $('#modalasignarusu').modal('hide');
                
                            swal.fire({
                                title:'Asignacion de Usuario',
                                text: 'Asignación Realizada',
                                icon: 'success'
                            });
                        }
                    });
                }
            });

        }

    }

    function guardarasignardel(e){
        e.preventDefault();
        var formData = new FormData($("#asig_form_del")[0]);

        $.ajax({
            url:"../../controller/asignacion.php?op=asignacion_delegacion",
            type:"POST",
            data:formData,
            contentType:false,
            processData:false,
            success:function(data){
                console.log(data);

                $.ajax({
                    url:"../../controller/vehiculo.php?op=asignacion_delegacion",
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    success:function(data){
                        $('#table_data').DataTable().ajax.reload();
                        $('#modalasignardel').modal('hide');
            
                        swal.fire({
                            title:'Asignacion de Delegacion',
                            text: 'Asignación Realizada',
                            icon: 'success'
                        });
                    }
                });
            }
        });

    }

    function guardarasignartar(e){
        e.preventDefault();
        var formData = new FormData($("#asig_form_tar")[0]);
        $.ajax({
            url:"../../controller/asignacion.php?op=asignacion_tarjeta",
            type:"POST",
            data:formData,
            contentType:false,
            processData:false,
            success:function(data){

                $.ajax({
                    url:"../../controller/vehiculo.php?op=asignacion_tarjeta",
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    success:function(data){
                        $('#table_data').DataTable().ajax.reload();
                        $('#modalasignartar').modal('hide');
            
                        swal.fire({
                            title:'Asignacion de Tarjeta',
                            text: 'Asignación Realizada',
                            icon: 'success'
                        });
                    }
                });
            }
        });

    }

/* LISTAR TABLA */

$(document).ready(function(){

    $('#dir_id').select2({ dropdownParent: $('#modalasignarusu')});

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
            url:"../../controller/vehiculo.php?op=listar",
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
function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#mantenimiento_form")[0]);

    $.ajax({
        url:"../../controller/vehiculo.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#table_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            swal.fire({
                title:'Vehiculo',
                text: 'Registro Confirmado',
                icon: 'success'
            });
        }
    });


}

function editar(VEHI_ID){
    $.post("../../controller/vehiculo.php?op=mostrar",{VEHI_ID:VEHI_ID},function(data){
        data=JSON.parse(data);
        
        $('#vehi_id_editar').val(data.VEHI_ID)
        $('#vehi_marca').val(data.VEHI_MARCA)
        $('#vehi_tipo').val(data.VEHI_TIPO)
        $('#vehi_modelo').val(data.VEHI_MODELO)
        $('#vehi_placas').val(data.VEHI_PLACAS)
        $('#vehi_ns').val(data.VEHI_NS)
        $('#vehi_color').val(data.VEHI_COLOR)
        

        
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show')
}

function eliminar(VEHI_ID){
    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/vehiculo.php?op=eliminar",{VEHI_ID:VEHI_ID},function(data){
            });

            $('#table_data').DataTable().ajax.reload();

            swal.fire({
                title:'Vehiculo',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });
}

$(document).on("click","#btnnuevo",function(){

    $('#vehi_id').val('')
    $('#vehi_marca').val('')
    $('#vehi_tipo').val('')
    $('#vehi_modelo').val('')
    $('#vehi_placas').val('')
    $('#vehi_ns').val('')
    $('#vehi_color').val('')

    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    $('#modalmantenimiento').modal('show');
});

init();