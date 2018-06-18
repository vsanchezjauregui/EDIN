/**
 * Created by PCV on 20/4/2018.
 */
$( function() {

    $("#canton").change(function(){
        $.get("../model/llenar_distritos.php", { provincia: $("#provincia").val(), canton: $(this).val() }, function(data) {
            //alert(data);
            $("#distrito").empty();
            $("#distrito").html(data);
        });
    });
    $("#provincia").change(function(){
        $.get("../model/llenar_cantones.php", { provincia: $(this).val() }, function(data) {
            $("#canton").empty();
            $("#canton").html(data);
        });
    });
});
