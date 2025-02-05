<?php

namespace mvc\controlador;

use Exception;

class Controlador
{
    protected array $peticiones_validas;

    public function __construct()
    {
        $this->peticiones_validas = [
            "Main" => [
                "modelo" => "\\modelo\\M_Main",
                "vista" => "\\vista\\V_Main"
            ],
            "Identificar" => [
                "modelo" => "\\modelo\\M_Identificar",
                "vista" => "\\vista\\V_Identificar"
            ],
            "Registrar" => [
                "modelo" => "\\modelo\\M_Registrar",
                "vista" => "\\vista\\V_Registrar"
            ]
        ];
    }

    public function gestiona_peticion()
    {
        $idp = $_GET['idp'] ?? $_POST['idp'] ?? "Main";
        $idp = filter_var($idp, FILTER_SANITIZE_SPECIAL_CHARS);

        if( !array_key_exists($idp, $this->peticiones_validas) ) 
            throw new Exception("La peticion $idp no existe.");

        $clase_modelo = $this->peticiones_validas[$idp]['modelo'];
        $clase_vista = $this->peticiones_validas[$idp]['vista'];

        if( !class_exists($clase_modelo) )
            throw new Exception("La clase modelo $clase_modelo no existe.");
        if( !class_exists($clase_vista) )
            throw new Exception("La clase vista $clase_vista no existe.");

        $modelo = new $clase_modelo();
        $datos = $modelo->despacha();

        $vista = new $clase_vista();
        $vista->genera_salida($datos);
    }
}

?>