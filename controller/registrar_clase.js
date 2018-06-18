
$( function() {
    $.get("../model/llenar_combo_tecnicos.php", {}, function(data) {
        $("#tecnico").html(data);
    });
    $.get("../model/llenar_combo_modulos_abiertos.php", { idtecnico: 1}, function(data) {
        $("#modulo").empty();
        $("#modulo").html(data);
    });
    $("#modulo").change(function(){
        $.get("../model/llenar_combo_matriculados.php", { idmodulo: $("#modulo").val()}, function(data) {
            $("#matriculados").innerHTML = '';
            $("#matriculados").html(data);
        });
    });


    $("#tecnico").change(function(){
        $.get("../model/llenar_combo_modulos_abiertos.php", { idtecnico: $(this).val() }, function(data) {
            $("#modulo").empty();
            $("#modulo").html(data);
        });
    });



    
});