<?php

namespace util;

class Autocarga
{
    public static function registra_autocarga()
    {
        if( !spl_autoload_register([self::class, "autocarga"]) ) echo "Error en autocarga.";
    }

    public static function autocarga( string $clase )
    {
        $nombre_depurado = str_replace("\\", "/", $clase);
        $ruta = $_SERVER['DOCUMENT_ROOT'] . "/" . $nombre_depurado . ".php";
        if( !file_exists($ruta) ) echo "Error en la carga de $nombre_depurado.";
        require_once($ruta);
    }
}

?>