var USU_ID = $('#usu_idX').val();
var ROL_ID = $('#ROL_IDx').val();
function init(){
    $("#solicitud_form").on("submit",function(e){
        guardaryeditar(e);
    });
}



$(document).ready(function(){

    $('#del_id').select2();
    $('#vehi_id').select2();

    $("#usu_id").val(USU_ID);


    console.log($('#usu_id').val());

    $.post("../../controller/delegacion.php?op=listado",function(data){
        $("#del_id").html(data);
    });

    $.post("../../controller/usuario.php?op=mostrar",{USU_ID:USU_ID},function(data){
        
        data=JSON.parse(data);
        console.log(data.DEL_ID);
        $('#del_id').val(data.DEL_ID).trigger('change');  
    });

    $.post("../../controller/vehiculo.php?op=mostrar_placa",{USU_ID:USU_ID},function(data){
        $("#vehi_id").html(data);
    });

});



function guardaryeditar(e){
    e.preventDefault();

    if($('#fileElem').val().length == 0 || $('#vehi_id').val() == 0){

        swal.fire({
            title:'Solicitud',
            text: 'Por favor llenar todos los campos',
            icon: 'error'
        });
    }else {
        /* TODO: Array del form solicitud */
        var formData = new FormData($("#solicitud_form")[0]);
        /* TODO: validamos si los campos tienen informacion antes de guardar */
        var totalfiles = $('#fileElem').val().length;
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
            /* TODO: Guardar solicitud */
        $.ajax({
            url: "../../controller/solicitud.php?op=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data);
                data = JSON.parse(data);
                
                console.log(data[0].SOL_ID);

                /* TODO: Limpiar campos */
                $('#vehi_id').val('').trigger('change');
                $('#sol_monto').val('');


                $.post("../../controller/email.php?op=nueva_solicitud", {SOL_ID : data[0].SOL_ID}, function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                });
                

                /* Notificacion */
                //$.post("../../controller/notificacion.php?op=solicitud_abierto", {tick_id : data[0].tick_id}, function (data) {

                //});
            }   
        });

        swal.fire({
            title:'Nueva Solicitud',
            text: 'Nueva Solicitud Registrada Correctamente',
            icon: 'success',
            
        });

    }
   
}

init();