$( function () {

        $.get("../model/listar_beneficiarios.php", {}, function(data) {
            
            $("#tabla_beneficiarios").html(data);
        });

});
