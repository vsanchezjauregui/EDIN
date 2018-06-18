$( function() {


    $('#agregar_participacion').on('click', function() {

        var alianza = $("#alianza").val();
        var participacion = $("#participacion").val();

        $.get("../controller/agregar_participacion.php", { alianza: alianza, participacion : participacion}, function(data) {
        	
        	$("#participaciones_creadas").html(data);
        });

    });

});