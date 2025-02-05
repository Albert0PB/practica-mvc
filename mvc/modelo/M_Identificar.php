<?php

namespace mvc\modelo;

require_once($_SERVER['DOCUMENT_ROOT'] . "/orm/ORMRegistro.php");

use Exception;
use orm\ORMRegistro;

class M_Identificar implements Modelo
{
    public function despacha()
    {
        session_start();

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if( !$email )
            throw new Exception("$email no es un correo electrónico válido.");
        $_SESSION['email'] = $email;

        $orm_registro = new ORMRegistro();
        return $orm_registro->getAll();
    }
}

?>