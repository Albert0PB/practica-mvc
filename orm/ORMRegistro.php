<?php

namespace orm;

require_once($_SERVER['DOCUMENT_ROOT'] . "/entidad/RegistroAsistente.php");
use entidad\RegistroAsistente;
use Exception;
use PDO;

class ORMRegistro
{
    protected string $tabla = "registro";
    protected string $pk = "id";
    protected PDO $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=dbregistros";
        $usuario = "usuario";
        $clave = "usuario";
        $opciones = [
            PDO::ATTR_CASE => PDO::CASE_LOWER,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];    

        $this->pdo = new PDO($dsn, $usuario, $clave, $opciones);
    }

    public function get( string $id )
    {
        $sql = "SELECT id, email, fecha_inscripcion, actividad 
                FROM registro_asistente 
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("id", $id);

        if( $stmt->execute() )
        {
            $registro = new RegistroAsistente($stmt->fetch());
            return $registro;
        }
        else throw new Exception("Error en la ejecución de la consulta 'get'.");

    }

    public function getAll()
    {
        $sql = "SELECT id, email, fecha_inscripcion, actividad
                FROM registro_asistente";

        $stmt = $this->pdo->query($sql);

        $registros = [];
        if( $stmt->execute() )
        {
            foreach( $stmt->fetch() as $registro )
                array_push($registros, new RegistroAsistente($registro));
            
        }
        return $registros;
    }

    public function insert( array $datos )
    {
        $sql = "INSERT INTO registro_asistente (id, email, fecha_inscripcion, actividad)
                VALUES (:id, :email, :fecha_inscripcion, :actividad)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("id", $datos['id']);
        $stmt->bindValue("email", $datos['email']);
        $stmt->bindValue("fecha_inscripcion", $datos['fecha_inscripcion']);
        $stmt->bindValue("actividad", $datos['actividad']);

        if( $stmt->execute() ) return true;
        return false;
    }

    public function update( array $datos )
    {
        $sql = "UPDATE TABLE registro_asistente
                SET id = :id, email = :email, fecha_inscripcion = :fecha_inscripcion, actividad = :actividad";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("id", $datos['id']);
        $stmt->bindValue("email", $datos['email']);
        $stmt->bindValue("fecha_inscripcion", $datos['fecha_inscripcion']);
        $stmt->bindValue("actividad", $datos['actividad']);

        if( $stmt->execute() ) return true;
        return false;
    }

    public function delete( string $id )
    {
        $sql = "DELETE FROM registro_asistente
                WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam("id", $id);

        if( $stmt->execute() ) return true;
        return false;
    }
}

?>