<?php
session_start();

require_once( $_SERVER['DOCUMENT_ROOT'] . "/exra621/util/Html.php");
require_once( $_SERVER['DOCUMENT_ROOT'] . "/exra621/orm/ORMRegistro.php");
require_once( $_SERVER['DOCUMENT_ROOT'] . "/exra621/entidad/RegistroAsistente.php");
use util\Html;
use exra621\orm\ORMRegistro;
use exra621\entidad\RegistroAsistente;

// Es una pena que no me haya estudiado la autocarga

define("ACTIVIDADES", [
    "gns3" => "Simulador de red GNS3",
    "ftp" => "Configuración de cortafuegos FTP",
    "dock" => "Despliegue rápido con Docker"
]);

try{
    $orm_registro = new ORMRegistro();
}
catch( PDOException $pdoe ) {
    echo $pdoe->getMessage();
    exit($pdoe->getCode());
}

Html::inicio("Registro", ["/exra621/estilos/general.css", "/exra621/estilos/formulario.css", "/exra621/estilos/tablas.css"]);

if( $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['operacion'] == "registrar") {

    try{
        $fecha = $_POST['fecha'] ? $_POST['fecha'] : date("Y-m-d", time() + 3600*24*15);

        if( !array_key_exists($_POST['actividad'], ACTIVIDADES) )
            throw new Exception("Actividad no válida", 1001);
        $actividad = $_POST['actividad'];

    }
    catch( Exception $e ) {
        echo $e->getMessage();
        exit($e->getCode());
    }

    $registro = new RegistroAsistente([
        "id" => null,
        "email" => $_SESSION['email'],
        "fecha_inscripcion" => $fecha,
        "actividad" => $actividad
    ]);

    $orm_registro->insertar($registro);

}
elseif( $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['operacion'] == "inicio" ) {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $_SESSION['email'] = $email;
}

$registros = $orm_registro->listar($_SESSION['email']);


?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <fieldset>
        <legend>Nuevo registro</legend>

        <label for="fecha">Fecha inscripción</label>
        <input type="date" name="fecha" id="fecha">
        
        <label for="actividad">Actividad</label>
        <select name="actividad" id="actividad" size="1" required>
            <option value="gns3">Simulador de red GNS3</option>
            <option value="ftp">Configuración de cortafuegos FTP</option>
            <option value="dock">Despliegue rápido con Docker</option>
        </select>
    </fieldset>
    <input type="hidden" name="operacion" id="operacion" value="registrar">
    <input type="submit" value="Añadir registro">
</form>

<table>
    <thead>
        <th>ID</th>
        <th>Email</th>
        <th>Fecha inscripción</th>
        <th>Actividad</th>
    </thead>
    <tbody>
<?php
foreach( $registros as $registro ) {
    echo <<<ROW
        <tr>
            <td>{$registro['id']}</td>
            <td>{$registro['email']}</td>
            <td>{$registro['fecha_inscripcion']}</td>
            <td>{$registro['actividad']}</td>
        </tr>
    ROW;
}


?>
    </tbody>
</table>

<form action="inicio.php" method="post">
    <input type="hidden" name="operacion" id="operacion" value="cerrar">
    <input type="submit" value="Cerrar sesión">
</form>

<?php
Html::fin();

?>