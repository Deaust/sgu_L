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
function activador(){
    catalogos=["Clasificacion","Color","Delegacion","Departamento","Direccion","EstadoFisico","Estatus","Marca","Material","Proveedor","Puesto","TipoBien","TipoRecurso"];

    var caja=[];
    for (var i in catalogos){
        a = document.getElementById("s"+catalogos[i]+"")
        if (a.checked == true){
            caja.push(catalogos[i]);
            
        } else {
        }
        
    }  

    $.post("../../controller/catalogo.php?op=listado",{catalogo:caja},function(data){
        $("#catalogos").html(data);
        for (var i in caja){
            listarcatalogos(caja[i]);
        } 
    });

    

  
};

function listarcatalogos(caja){
    console.log(caja);
    tabla=$('#tabla_'+caja+'').dataTable({
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
                url: '../../controller/catalogo.php?op=listar_catalogos',
                type : "post",
                dataType : "json",
                data:{catalogo:caja},
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

$(document).ready(function(){

    $.post("../../controller/catalogo.php?op=listado_activadores",function(data){
        $("#activadores").html(data);
    });
});

init();