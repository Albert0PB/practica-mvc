<?php
namespace exra621\orm;

use exra621\entidad\RegistroAsistente;
use PDOException;
use PDO;

class ORMRegistro {

    protected const TABLA = "registro_asistente";
    protected const PK = "id";

    private PDO $pdo;

    public function __construct() {
        $dsn = "mysql:host=192.168.12.71;dbname=examen";
        $usuario = "examen";
        $clave = "usuario";
        $opciones = [
            PDO::ATTR_CASE => PDO::CASE_LOWER,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $this->pdo = new PDO($dsn, $usuario, $clave, $opciones);
    }

    public function insertar( RegistroAsistente $registro ): bool {
        $datos = $registro->toArray();

        try{
            $stmt = $this->pdo->prepare("INSERT INTO registro_asistente (id, email, fecha_inscripcion, actividad) 
                                         VALUES (:id, :email, :fecha_inscripcion, :actividad)");

            $stmt->bindValue(":id", $datos['id']);
            $stmt->bindValue(":email", $datos['email']);
            $stmt->bindValue(":fecha_inscripcion", $datos['fecha_inscripcion']);
            $stmt->bindValue(":actividad", $datos['actividad']);


            if( $stmt->execute() && $stmt->rowCount() === 1 )
                return true;
        }
        catch( PDOException $pdoe ) {
            echo $pdoe->getMessage();
            exit($pdoe->getCode());
        }

        return false;
    }

    public function listar( string $email ): array {
        $registros = [];

        $sql = "SELECT * FROM registro_asistente WHERE email = :email";
        
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":email", $email);

            if( $stmt->execute() ) {
                $registros = $stmt->fetchAll();
            }
        }
        catch( PDOException $pdoe ) {
            echo $pdoe->getMessage();
            exit($pdoe->getCode());
        }

        return $registros;
    }

}

?>