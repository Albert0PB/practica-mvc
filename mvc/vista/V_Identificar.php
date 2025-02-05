<?php

namespace mvc\vista;

class V_Identificar extends Vista
{
    public function genera_salida(array $datos)
    {
        $this->inicio_html("Registro de asistentes y actividades");
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Fecha inscripción</th>
            <th>Actividad</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach( $datos as $registro )
{
?>
<tr>
    <td><?=$registro['id']?></td>
    <td><?=$registro['email']?></td>
    <td><?=$registro['fecha_inscripcion']?></td>
    <td><?=$registro['actividad']?></td>
</tr>
<?php
}
?>
    </tbody>
</table>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <fieldset>
        <legend>Introducir registro</legend>

        <label for="actividad">Actividad</label>
        <input type="text" name="actividad" id="actividad" required>
    </fieldset>
    <input type="hidden" name="email" id="email" value="<?=$_SESSION['email']?>">
    <input type="hidden" name="fecha_inscripcion" id="fecha_inscripcion" value="<?=date("Y-m-d")?>">
    <input type="hidden" name="idp" id="idp" value="Registrar">
    <input type="submit" value="Enviar">
</form>

<?php
    $this->fin_html();
    }
}

?>