$( function() {


    $("#tecnico1").click(function(){
        $.get("../model/cargar_modulos.php", { idTecnico: 1}, function(data) {
            //alert(data);
            $("#modulos").empty();
            $("#modulos").html(data);
        });
    });

});