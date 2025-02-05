<?php
/*
Peticiones
----------

Main            =>  formulario con correo del usuario; idp "Identificar",
                    Si ya existe sesión, se destruye.
Identificar     =>  se muestran los registros existentes en una tabla y 
un formulario para ingresar datos de nuevo registro 
con idp "Registrar".

Registrar       =>  se recogen los datos y se insertan a la db. Formulario 
para volver a inicio y "desidentificar al usuario". idp 
"Main"
*/

require_once($_SERVER['DOCUMENT_ROOT'] . "/util/Autocarga.php");

use util\Autocarga;
use mvc\controlador\Controlador;

Autocarga::registra_autocarga();

$controlador = new Controlador();

$controlador->gestiona_peticion();

?>


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