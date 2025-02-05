<?php

namespace mvc\modelo;

require_once($_SERVER['DOCUMENT_ROOT'] . "/orm/ORMRegistro.php");

use orm\ORMRegistro;

class M_Registrar implements Modelo
{
    public function despacha()
    {
        $actividad = filter_input(INPUT_POST, "actividad", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $fecha_inscripcion = filter_input(INPUT_POST, "fecha_inscripcion", FILTER_SANITIZE_SPECIAL_CHARS);

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $orm_registro = new ORMRegistro();

        $orm_registro->insert([
            "email" => $email,
            "actividad" => $actividad,
            "fecha_inscripcion" => $fecha_inscripcion
        ]);

        return null;
    }
}

?>