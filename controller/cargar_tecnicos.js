/**
 * Created by PCV on 20/4/2018.
 */
$( function () {

        $.get("../model/cargar_tecnicos.php", {}, function(data) {
            
            $("#tecnicos").html(data);
        });

});
