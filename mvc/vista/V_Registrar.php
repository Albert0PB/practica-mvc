<?php

namespace mvc\vista;

class V_Registrar extends Vista
{
    public function genera_salida( ?array $datos )
    {
        $this->inicio_html("Registro realizado.");
?>
<h3>Registro realizado</h3>
<p>Su registro se ha realizado con éxito</p>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <input type="hidden" name="idp" id="idp" value="Main">
    <input type="submit" value="Volver a Inicio">
</form>

<?php
        $this->fin_html();
    }
}

?>