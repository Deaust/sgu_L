var usu_id = $('#USU_IDx').val();




$(document).ready(function(){
    $.post("../../controller/notificacion.php?op=listarnotificaciones", { usu_id : usu_id }, function (data) {
        $('#lblnotificaciones').html(data);
        var not_id = $('#NOT_IDx').val();
        var tick_id = $('#TICK_IDx').val();
        

        $(document).on("click","#btnnotificacion", function(){

            console.log(not_id);

                window.open('../../view/DetalleTicket/?ID='+ tick_id +'');  
            
                $.post("../../controller/notificacion.php?op=vista", {not_id : not_id}, function (data) {
            
                });

                window.location.reload();
            });
    }); 
});




