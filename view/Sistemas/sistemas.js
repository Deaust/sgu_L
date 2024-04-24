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
}

$(document).on("click","#btnnuevo",function(){
    $("#usu_id").val(USU_ID);

    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    $('#mantenimiento').modal('show');
});

$(document).ready(function(){
    listardatatable();
});

function listardatatable(){
    tabla=$('#table_data_sistemas').dataTable({
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
                url: '../../controller/sistema.php?op=listar',
                type : "post",
                dataType : "json",
                data:{},
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

function guardaryeditar(e){        
    e.preventDefault();
    $('#mantenimiento').modal('hide');
    loader();
    var formData = new FormData($("#mantenimiento_form")[0]);
    $.ajax({
        url:"../../controller/sistema.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            hideloader();
            $('#mantenimiento').modal('show');

            $('#table_data_sistemas').DataTable().ajax.reload();            

            swal.fire({
                title:'Tajeta',
                text: 'Registro Confirmado',
                icon: 'success'
            });
        }
    });
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