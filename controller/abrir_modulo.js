
$( function() {
    $.get("../model/llenar_combo_tecnicos.php", {}, function(data) {
        $("#tecnico").html(data);
    });
    $.get("../model/llenar_combo_modulos.php", { idtecnico: 1}, function(data) {
        $("#modulo").empty();
        $("#modulo").html(data);
    });

    $("#tecnico").change(function(){
        $.get("../model/llenar_combo_modulos.php", { idtecnico: $(this).val() }, function(data) {
            $("#modulo").empty();
            $("#modulo").html(data);
        });
    });

    $('#seleccionar_matriculados').on('click', function() {
        var clicked = new Array();
        $('input[type=checkbox]:checked').each(function() {
            clicked.push($(this).val());
        });

        $.get("../controller/seleccionados.php", { seleccionados: clicked }, function(data) {
            $("#matriculados").empty();
            $("#matriculados").html(data);
        });

    });


});