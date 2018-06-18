
$( function() {

    $("#beneficiario").change(function(){
        $.get("../model/registrar_pago.php", { idbeneficiario: $(this).val() }, function(data) {
            $("#moduloAbonado").empty();
            $("#moduloAbonado").html(data);
        });
    });


    
});