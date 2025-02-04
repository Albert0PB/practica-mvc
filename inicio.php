<?php
session_start();

if( $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['operacion'] == "cerrar" ) {
    $params = session_get_cookie_params();
    
    setcookie(session_name(), '', time() - 420, $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"]);

    session_unset();
    session_destroy();

}

require_once( $_SERVER['DOCUMENT_ROOT'] . "/exra621/util/Html.php");
use util\Html;

Html::inicio("Inicio sesión", ["/exra621/estilos/general.css", "/enra621/estilos/formulario.css"]);
?>

<form action="registro.php" method="post">
    <fieldset>
        <legend>Inicio de sesión</legend>

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" required size="100">
    </fieldset>
    <input type="hidden" name="operacion" id="operacion" value="inicio">
    <input type="submit" value="Enviar">
</form>

<?php
Html::fin();

?>