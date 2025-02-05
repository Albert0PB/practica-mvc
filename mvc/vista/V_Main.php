<?php

namespace mvc\vista;

class V_Main extends Vista
{
    public function genera_salida( ?array $datos )
    {
        $this->inicio_html("Inicio");
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <fieldset>
        <legend>Main</legend>
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" required size="50">
    </fieldset>
    <input type="hidden" name="idp" id="idp" value="Identificar">
    <input type="submit" value="Enviar">
</form>

<?php
        $this->fin_html();
    }
}

?>