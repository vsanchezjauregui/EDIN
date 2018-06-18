<?php
    $cumpleanos = new DateTime("1990-01-01");
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);
    echo $annos->y;
 ?>