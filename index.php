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
                    para volver a inicio y "desidentificar al usuario" o 
                    para volver a "identificar". idp "Main"
*/

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/util/Autocarga.php");

use util\Autocarga;
use mvc\controlador\Controlador;

Autocarga::registra_autocarga();

$controlador = new Controlador();

$controlador->gestiona_peticion();

?>
