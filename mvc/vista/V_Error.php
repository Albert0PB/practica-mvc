<?php

namespace mvc\vista;

class V_Error extends Vista
{
    public function genera_salida(array $datos)
    {
        $this->inicio_html("¡Error!");
?>
<h3>Error <?=$datos['codigo']?></h3>
<p>"<?=$datos['mensaje']?>"</p>
<br>
<br>
<h2>Lanzado desde:</h2>
<p>Archivo: "<?=$datos['archivo']?>"</p>
<p>Línea: "<?=$datos['linea']?>"</p>
<p>Traza completa: "<?=$datos['traza']?>"</p>
<?php
        $this->fin_html();
    }
}

?>