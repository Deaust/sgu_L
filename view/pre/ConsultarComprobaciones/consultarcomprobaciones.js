var USU_ID = $('#USU_IDx').val();
var ROL_ID = $('#ROL_IDx').val();
var DEL_ID = $('#DEL_IDx').val();
var DIR_ID = $('#DIR_IDx').val();





function init(){
    $("#aut_monto").on("submit",function(e){
        autorizar(e);
        //insertar_autorizacion(e);
    });

    $("#comprobacion_form").on("submit",function(e){
        guardar(e);
        //insertar_autorizacion(e);
    });

}

function listardetalle(SOL_ID){
    $('#descripcion').summernote({
        dropdownParent: $('#modaldetallecomp'),
        height: 100,
        lang: "es-ES",
        popover:{
            image: [],
            link: [],
            air: []
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    }); 

   //SOLICITUD
    $.post("../../controller/solicitud.php?op=imagen", {SOL_ID:SOL_ID}, function (data) {
        $('#imagen').html(data);
    }); 

    $.post("../../controller/solicitud.php?op=listar_sol_det",{SOL_ID:SOL_ID},function(data){
        data=JSON.parse(data);

        if(ROL_ID==6){
             
            $('#tar_numero_info').html(data.TARJETA) 
            $('#tarjeta_id').val(data.TARJETA_ID) 
            $('#tar_saldo_info').html(data.SALDO_TARJETA) 
            $('#vehi_placa_info').html(data.PLACAS)  
            $('#placas_info').html(data.PLACAS)  
            $('#sol_no').html(data.SOL_NO)   
            $('#del_info').html(data.DELEGACION)   
            $('#usu_info').html(data.USUARIO)   
            $('#monto_info').html(data.SOL_MONTO) 
            $('#monto_aut_info').html(data.MONTO_AUTORIZADO) 
            
            $('#marca_info').html(data.MARCA) 
            $('#modelo_info').html(data.MODELO) 
            $('#anno_info').html(data.AÑO) 
            $('#color_info').html(data.COLOR) 
            $('#ns_info').html(data.NS) 
        }else{
             
            $('#sol_no').html(data.SOL_NO)  
            $('#vehi_placa_info').html(data.PLACAS) 
            $('#placas_info').html(data.PLACAS)   
            $('#del_info').html(data.DELEGACION)   
            $('#usu_info').html(data.USUARIO)   
            $('#monto_info').html(data.SOL_MONTO) 
            
            $('#marca_info').html(data.MARCA) 
            $('#modelo_info').html(data.MODELO) 
            $('#anno_info').html(data.AÑO) 
            $('#color_info').html(data.COLOR) 
            $('#monto_aut_info').html(data.MONTO_AUTORIZADO)  
        };

        
                   

    });


    //COMPROBACION
    $.post("../../controller/comprobacion.php?op=imagenes", {SOL_ID:SOL_ID}, function (data) {
        $('#imagenes').html(data);
    }); 

    $.post("../../controller/comprobacion.php?op=listar_comp_det",{SOL_ID:SOL_ID},function(data){
        data=JSON.parse(data);

        $('#info_estado').html(data.ESTADO)
        $('#comp_idX').val(data.COMP_ID)

        if (data.ESTADO_ID == 1){
            /* TODO: Ocultamos panel de detalle */
            $('#pnldetalle').hide();
        }
            
        $('#info_ki').html(data.KM_I)
        $('#info_kf').html(data.KM_F)
        $('#info_ticket').html(data.TICKET)
        $('#info_precio').html(data.PRECIO) 
        $('#info_tipo').html(data.TIPO)
        $('#info_litros').html(data.LITROS)
        $('#info_fecha').html(data.FECHA)

        $('#info_monto').html(data.MONTO)
        $('#gasto_tar').val(data.MONTO_S)

        var COMP_ID = $('#comp_idX').val();

        $.post("../../controller/comprobacion.php?op=listardetalle", { COMP_ID: COMP_ID}, function (data) {
            $('#lbldetalle').html(data);
        });       

    });
}

// COMPROBACIONES

    function detalle(SOL_ID){

        listardetalle(SOL_ID);

        


        $('#modaldetallecomp').on("click","#btnenviar", function(){
            var COMP_ID = $('#comp_idX').val();
            var USU_ID = $('#USU_IDx').val();
            var DESCRIPCION = $('#descripcion').val();

        
            /* TODO:Validamos si el summernote esta vacio antes de guardar */
            if ($('#descripcion').summernote('isEmpty')){
                swal.fire("Advertencia!", "Falta Descripción", "warning");
            }else{
                var formData = new FormData();
                formData.append('COMP_ID',COMP_ID);
                formData.append('USU_ID',USU_ID);
                formData.append('DESCRIPCION',DESCRIPCION);
                formData.append("files[]", $('#fileElem')[0].files[0]);
        
                /* TODO:Insertar detalle */
                $.ajax({
                    url: "../../controller/comprobacion.php?op=insertcomentario",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        data = JSON.parse(data);
                        console.log(data);
                        console.log(data[0].COM_ID);

                        listardetalle(SOL_ID);

                        /* TODO: Alerta de Confirmacion */
                        $.post("../../controller/email.php?op=insert_comentario", {COM_ID : data[0].COM_ID}, function (data) {
                
                        });
                        
                        /* TODO: Limpiar inputfile */
                        $('#fileElem').val('');
                        $('#descripcion').summernote('reset');
                        swal.fire("Correcto!", "Registrado Correctamente", "success");
                        
                    }
                });                
            }
        });

        $('#modaldetallecomp').on("click","#btnautorizar", function(){

            swal.fire({
                title:"Autorizacion!",
                text:"Desea Autorizar?",
                icon: "success",
                confirmButtonText : "Si",
                showCancelButton : true,
                cancelButtonText: "No",
            }).then((result)=>{

                var GASTO = $('#gasto_tar').val();
                var TARJETA = $('#tarjeta_id').val();

                if (result.value){
                    var COMP_ID = $('#comp_idX').val();                  

                    var formData = new FormData();
                    formData.append('COMP_ID',COMP_ID);
                    $.ajax({
                        url: "../../controller/comprobacion.php?op=autorizacion",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){

                            $.post("../../controller/comprobacion.php?op=comprobacion_autorizada", {SOL_ID:SOL_ID}, function (data) {
                                $('#modaldetallecomp').modal('hide');
                                $('#data_table_4').DataTable().ajax.reload();
                                
                                listardetalle(SOL_ID);

                                $.post("../../controller/email.php?op=autorizar_comprobacion", {SOL_ID:SOL_ID}, function (data) {              
                                    console.log(data);
                                }); 

                                swal.fire({
                                    title:'Autorizacion',
                                    text: 'Autorizacion Confirmada',
                                    icon: 'success'
                                });
                
                            }); 

                            $.post("../../controller/tarjeta.php?op=gasto", {GASTO:GASTO,TARJETA:TARJETA,SOL_ID:SOL_ID}, function (data) {
                                                
                            });

                            $.post("../../controller/email.php?op=autorizar_comprobacion", {SOL_ID:SOL_ID}, function (data) {              
                                console.log(data);
                            }); 

                            

                            /* $.post("../../controller/email.php?op=ticket_detalle", {tick_id : tick_id}, function (data) {
            
                             }); */

                            
                            
                        }
                    });                  
                        
                }
            });
        });
        


        $('#mdltitulosol').html('Detalle de Comprobación');
        $("#modaldetallecomp").modal('show') 
    }

    function nueva(SOL_ID){

       
        $('#sol_idX').val(SOL_ID) 


        $('#mdltitulonueva').html('Nueva Comprobación');
        $("#modalnuevacomp").modal('show') 
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
            url:"../../controller/comprobacion.php?op=listar_1",
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
            url:"../../controller/comprobacion.php?op=listar_2",
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
            url:"../../controller/comprobacion.php?op=listar_3",
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
            url:"../../controller/comprobacion.php?op=listar_4",
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


function guardar(e){
    e.preventDefault();

   if($('#tarjeta').val().length == 0 ||
    $('#camioneta').val().length == 0 ||
    $('#bomba').val().length == 0 ||
    $('#compra').val().length == 0 ||
    $('#odo_i').val().length == 0 ||
    $('#odo_f').val().length == 0 ||
    $('#placa').val().length == 0){

        swal.fire({
            title:'Autorizacion',
            text: 'Hay campos vacios',
            icon: 'error'
        });
    }else{
        /* TODO: Array del form solicitud */
        var formData = new FormData($("#comprobacion_form")[0]);

        formData.append("tarjeta[]", $('#tarjeta')[0].files);
        formData.append("camioneta[]", $('#camioneta')[0].files);
        formData.append("bomba[]", $('#bomba')[0].files);
        formData.append("compra[]", $('#compra')[0].files);
        formData.append("odo_i[]", $('#odo_i')[0].files);
        formData.append("odo_f[]", $('#odo_f')[0].files);
        formData.append("placa[]", $('#placa')[0].files);
        
            /* TODO: Guardar solicitud */
        $.ajax({
            url: "../../controller/comprobacion.php?op=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                data = JSON.parse(data);
                console.log(data);
                console.log(data[0].COMP_ID);

                
                $('#modalnuevacomp').modal('hide');
                $('#table_data_1').DataTable().ajax.reload();
                $('#table_data_4').DataTable().ajax.reload();

                /* TODO: Limpiar campos */


                swal.fire({
                    title:'Nueva Comprobacion',
                    text: 'Nueva Comprobacion Registrada Correctamente',
                    icon: 'success',
                    
                });

                
                $.post("../../controller/email.php?op=nueva_comprobacion", {COMP_ID : data[0].COMP_ID}, function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                    
                });

                window.location.reload();


                /* Notificacion */
                //$.post("../../controller/notificacion.php?op=solicitud_abierto", {tick_id : data[0].tick_id}, function (data) {

                //});

                
            }

            
        });
    }

    
   
}



init();